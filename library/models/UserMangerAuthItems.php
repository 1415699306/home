<?php

/**
 * This is the model class for table "user_manger_authItems".
 *
 * The followings are the available columns in table 'user_manger_authItems':
 * @property string $id
 * @property string $type
 * @property string $role_id
 * @property string $authItems
 */
class UserMangerAuthItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserMangerAuthItems the static model class
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
		return 'user_manger_authItems';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_id, controller, type, authItems', 'required'),
			array('role_id', 'length', 'max'=>11),
			array('authItems', 'length', 'max'=>2048),
            array('controller', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, controller, type, role_id, authItems', 'safe', 'on'=>'search'),
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
            'role'=>array(self::BELONGS_TO,'UserMangerRole','role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'role_id' => 'Role',
			'authItems' => 'Auth Items',
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
		$criteria->compare('role_id',$this->role_id,true);
		$criteria->compare('authItems',$this->authItems,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    /**
     * 配置前端
     * 
     * @param string $key
     * @param maxid $action
     * @return array
     */
    public static function getControllerName($key,$action=null)
    {
        $params = array(
                'Site'=>array('controllerName'=>'首页','actions'=>array('Index'=>'首页','Error'=>'出错页面','Login'=>'登录','Logout'=>'退出','Register'=>'注册')),
                'Usercenter'=>array('controllerName'=>'用户中心','actions'=>array('Index'=>'首页','Avatar'=>'修改头像','Password'=>'修改密码','Profile'=>'修改用户资料')),
            );        
        return self::resultName($params, $key, $action);
    }
    
    /**
     * 配置后端
     * 
     * @param string $key
     * @param maxid $action
     * @return array
     */
    public static function getModuleName($key,$action=null)
    {
        $key = strtolower($key);
        $params = array(
                'default'=>array('controllerName'=>'首页','actions'=>array('index'=>'后台首页')),
                'article'=>array('controllerName'=>'资讯','actions'=>array('index'=>'资讯首页','create'=>'添加','update'=>'更新','view'=>'查看','delete'=>'删除')),
                'global'=>array('controllerName'=>'基本设置','actions'=>array('index'=>'基本设置首页','announcement'=>'系统公告','announcementcreate'=>'添加公告','announcementupdate'=>'更新公告','announcementview'=>'查看公告','announcementdelete'=>'删除公告')),
                'investment'=>array('controllerName'=>'招商管理','actions'=>array('index'=>'招商管理首页','create'=>'开发模式','beforce'=>'模板模式(1)','save'=>'模板模式(2)','update'=>'更新','view'=>'查看','delete'=>'删除')),
                'user'=>array('controllerName'=>'用户管理','actions'=>array('index'=>'用户管理首页','competence'=>'用户权限','audit'=>'审核用户','view'=>'查看','deleterole'=>'删除角色','authitem'=>'角色权限设置')),
                'meet'=>array('controllerName'=>'乐聚荟','actions'=>array('index'=>'乐聚荟首页','create'=>'添加','update'=>'更新','view'=>'查看','delete'=>'删除','eminent'=>'名人管理','eminentdelete'=>'名人删除','eminentcreate'=>'名人添加')),
                'celebrity'=>array('controllerName'=>'名人绘','actions'=>array('index'=>'名人绘首页')),
                'study'=>array('controllerName'=>'慧学习','actions'=>array('index'=>'慧学习首页')),
            );
            return self::resultName($params, $key, $action);
    }
    
    
    /**
     * 结果返回处理
     * 
     * @param type $params
     * @param type $key
     * @param type $action
     * @return type
     */
    public static function resultName($params,$key,$action)
    {
         if($action === null)
            return array_key_exists($key, $params) ? $params[$key]['controllerName'] : $key;
        else
            return array_key_exists($key, $params) ? (isset($params[$key]['actions'][$action])?$params[$key]['actions'][$action]:$action) : $action;
    }
    
    /**
     * 组装父亲关系URL
     * 
     * @param int $id parent_id
     */
    public static function getParents($id)
    {
        (string)$return = '';
        if(1 < $id)
        {
            $model = UserMangerRole::model()->findByPk($id);                                  
            $return = CHtml::tag('em').(Yii::app()->user->id === $model->id || Yii::app()->user->name === Yii::app()->getModule('backend')->adminName ? CHtml::link($model->name,$model->id) : $model->name).CHtml::closeTag('em');
        }
        return $return;
    }
    
    /**
     * 检查用户角色控制器权限
     * 
     * @param string $controller
     * @return boolean
     */
    public static function checkController($controller)
    {
        if(Yii::app()->user->name === $this->adminName)return true;     
        $manger = new CuserManger();     
        return $manger->checkController((string)$controller);
    }
        

    
    
    /**
     * 检查角色动作权限用户角色设置专用
     * 
     * @param string $controller
     * @param strgin $action
     * @return boolean
     */
    public static function checkBox($action,$authItems,$controller)
    {       
        if(!empty($authItems['backend'][strtolower($controller['name'])]) && array_key_exists($action['name'],array_flip($authItems['backend'][strtolower($controller['name'])]["data"])))
            return 1;
        else
            return 0;
    }
}