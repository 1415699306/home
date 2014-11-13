<?php
class Email extends CActiveRecord
{   
    const DEFAULT_GROUP = 1;
    public $web_site;
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public function tableName()
	{
		return 'email';
	}

	
	public function rules()
	{
		
		return array(
			array('username, email', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>128),
			array('password', 'length', 'max'=>64),
			array('email', 'length', 'max'=>1024),
			array('register_time, group_id, mtime', 'length', 'max'=>11),
		
			array('id, authitem, username, password, email,content, register_time, group_id, status, mtime', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		
		return array(
            'userProfile' => array(self::HAS_ONE, 'UserProfile', 'user_id'),
            'assign' => array(self::HAS_ONE,'UserMangerAssign','user_id'),
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => '用户名称',
			'password' => '用户密码',
			'email' => '电子邮箱',
            'content' => '内容',
			'register_time' => '注册时间',
			'group_id' => '用户组',
            'authitem'=> '角色',
			'status' => '用户状态',
			'mtime' => '更新时间',
		);
	}

	
	public function search()
	{
		
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
        $criteria->compare('content',$this->email,true);
		$criteria->compare('register_time',$this->register_time,true);
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('status',$this->status);
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
    
    public function beforeSave()
    {
        $time = time();
        if($this->isNewRecord)
        {
            $this->register_time = $time;
            $this->status = (int)Yii::app()->setting->base->register_status;
            $this->password = $this->hashPassword($this->password);
            $this->group_id = self::DEFAULT_GROUP;
        }       
        $this->mtime = $time;
        return parent::beforeSave();
    }
}