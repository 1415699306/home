<?php

/**
 * This is the model class for table "user_manger_role".
 *
 * The followings are the available columns in table 'user_manger_role':
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property string $parent_id
 * @property string $ctime
 * @property string $mtime
 */
class UserMangerRole extends CActiveRecord
{
    const BACKENDID = 1;
    const SITEID = 0;
    const PARENTID = 0;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserMangerRole the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_manger_role';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
            array('name','checkName'),
			array('name', 'length', 'max'=>128),
			array('parent_id, ctime, mtime, user_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, parent_id, user_id, ctime, mtime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'assigns'=>array(self::HAS_MANY,'UserMangerAssign','role_id'),
            'authItemsBackend'=>array(self::HAS_MANY,'UserMangerAuthItems','role_id','condition'=>'authItemsBackend.type='.self::BACKENDID),
            'authItemsSite'=>array(self::HAS_MANY,'UserMangerAuthItems','role_id','condition'=>'authItemsBackend.type='.self::SITEID),
            'assignCount'=>array(self::STAT,'UserMangerAssign','role_id'),
            'user'=>array(self::BELONGS_TO,'User','user_id'),
            'authItem'=>array(self::HAS_ONE,'UserMangerAuthItems','role_id'),
            'authItems'=>array(self::HAS_MANY,'UserMangerAuthItems','role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '角色名称',
			'parent_id' => '上级角色',
            'user_id'=>'创建用户',
			'ctime' => '添加时间',
			'mtime' => '更新时间',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
        $criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('ctime',$this->ctime,true);
		$criteria->compare('mtime',$this->mtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function beforeSave() 
    {
        $time = time();
        if($this->isNewRecord){
            $this->ctime = $time;
            if($this->parent_id === null)
                $this->parent_id = Yii::app()->user->id;
            $this->user_id = Yii::app()->user->id;
        }
        $this->mtime = $time;
        return parent::beforeSave();
    }
    
    public function afterDelete() 
    {
        UserMangerAuthItems::model()->deleteAllByAttributes(array('role_id'=>$this->id));
        UserMangerAssign::model()->deleteAllByAttributes(array('role_id'=>$this->id));        
        return parent::afterDelete();
    }
    
    /**
     * 检查用户角色是否已存在
     */
    public function checkName()
    {
        $model = self::model()->find('LOWER(name)=?',array($this->name));
        if(!is_null($model))
            $this->addError ('name', '已存在角色!不能重名!');
    }
    
    public function checkAdmin()
    {
        $id = Yii::app()->request->getParam('id');
        $model = UserMangerRole::model()->with('user')->findByPk($id);
        if($model->user->username != Yii::app()->params['adminName'])
            return false;
        else
            return true;
    }
    
    /**
     * 跟据角色主键删除角色
     * 
     * @param type $id
     * @throws CHttpException
     */
    public static function deleteRole($id)
    {
        $model = self::model()->findByAttributes(array('id'=>$id,'user_id'=>Yii::app()->user->id));
        if($model === null)
            throw new CHttpException(404,'信息不存在');
        if($model->delete())
        {
            $parent = self::model()->findAllByAttributes(array('parent_id'=>$model->id));        
            foreach($parent as $key)
            {
                $key->delete();
                Yii::log(Yii::app()->user->id.'删除了id:'.$key->id.'的角色','info','system.backend.role');            
            }
        }
    }
    
    /**
     * 跟据用户ID删除所有角色
     *  
     * @param type $uid
     */
    public static function deleteRoleAll($uid)
    {
        $roles = self::model()->findAllByAttributes(array('user_id'=>$uid));
        foreach($roles as $key)
        {
            if($key->delete())
            {
                $parent = self::model()->findAllByAttributes(array('parent_id'=>$key->id));        
                foreach($parent as $v)
                {
                    $v->delete();
                    Yii::log(Yii::app()->user->id.'删除了id:'.$key->id.'的角色','info','system.backend.role');
                }
            }
        } 
    }
    
    /**
     * 组装下拉菜单更新的角色
     * 
     * @param type $id
     * @return type
     */
    public static function getListData($id)
    {
        $assign = UserMangerAssign::model()->find('LOWER(user_id)=?',array($id));
        $criteria = new CDbCriteria();
        if(!empty($assign))
        {
            
            if(Yii::app()->user->name === Yii::app()->params['adminName'])
            {
                 $criteria->condition = 'id !=:id';
                 $criteria->addCondition('parent_id != :pid');
                 $criteria->addCondition('parent_id < :pid2');
                 $criteria->params = array(':id'=>$assign->role_id,':pid'=>$assign->role_id,':pid2'=>$assign->role_id);
            }
            else
            {
                $criteria->condition = 'id !=:id';
                $criteria->addCondition('user_id = :uid');
                $criteria->params = array(':id'=>$assign->role_id,':uid'=>Yii::app()->user->id);
            }
        }
        else
        {
            if(Yii::app()->user->name != Yii::app()->params['adminName'])
            {
                $criteria->condition = 'user_id = :uid';
                $criteria->params = array(':uid'=>Yii::app()->user->id);
            }
        }
        return UserMangerRole::model()->findAll($criteria);
    }
    
}