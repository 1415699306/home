<?php

/**
 * This is the model class for table "public_comment".
 *
 * The followings are the available columns in table 'public_comment':
 * @property string $id
 * @property integer $app_id
 * @property integer $res_id
 * @property integer $parent_id
 * @property integer $user_id
 * @property integer $status
 * @property string $username
 * @property string $content
 * @property string $ctime
 * @property string $mtime
 */
class PublicComment extends CActiveRecord
{
    const STATUS = 0;

    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PublicComment the static model class
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
		return 'public_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_id, res_id, parent_id, content', 'required'),
			array('app_id, res_id, parent_id, user_id, status', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>32),
			array('content', 'length', 'max'=>1024),
			array('ctime, mtime', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, app_id, res_id, parent_id, user_id, status, username, content, ctime, mtime', 'safe', 'on'=>'search'),
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
            'user' =>array(self::BELONGS_TO, 'User', 'user_id'),
			'userProfile'=>array(self::BELONGS_TO, 'UserProfile','user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'app_id' => '应用ID',
			'res_id' => '资源ID',
			'parent_id' => '发表',
			'user_id' => '用户ID',
			'status' => '状态',
			'username' => '用户名称',
			'content' => '内容',
			'ctime' => 'Ctime',
			'mtime' => 'Mtime',
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
		$criteria->compare('app_id',$this->app_id);
		$criteria->compare('res_id',$this->res_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('ctime',$this->ctime,true);
		$criteria->compare('mtime',$this->mtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'id desc',
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
		));
	}
    
    public function behaviors(){
        return array(
            'CSafeContentBehavor' => array(
                'class' => 'ext.behaviors.CSafeContentBehavior',
                'attributes' => array('content'),
            ),
        );
    }
    
    public function beforeSave() 
    {
        $time = time();
        if($this->isNewRecord)
        {
            $this->user_id = Yii::app()->user->id;
            $this->username = Yii::app()->user->name;
            $this->ctime = $time;
            $this->status = self::STATUS;
        }
        $this->mtime = $time;
    }
    
    public function afterDelete() 
    {
        self::model()->deleteAllByAttributes(array('parent_id'=>$this->id));
        return parent::afterDelete();
    }
    
    public static function getCommantCount($id,$app_id)
    {
        return PublicComment::model()->countByAttributes(array('res_id'=>$id,'app_id'=>$app_id));
    }
    
    public static function getCountByPercentage($app_id)
    {
        $count = self::model()->countByAttributes(array('app_id'=>$app_id));
        $total = self::model()->count();
        return @ceil($count/$total*100);
    }
    
    public static function getCountByApp($app_id)
    {
        return self::model()->countByAttributes(array('app_id'=>$app_id));
    }
    
    
    public static function getComment($id)
    {
        $id = (int)Yii::app()->request->getParam('id',$id);
        $sql = "select username,content,id,parent_id from `public_comment` where parent_id=:id";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':id'=>(int)$id))->queryAll();
        return $model;
    }
}