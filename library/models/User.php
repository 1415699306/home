<?php
/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $register_time
 * @property string $group_id
 * @property integer $status
 * @property string $mtime
 */
class User extends CActiveRecord
{   
    const DEFAULT_GROUP = 1;
    public $web_site;
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>128),
			array('password', 'length', 'max'=>64),
			array('email', 'length', 'max'=>1024),
			array('register_time, group_id, mtime', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, authitem, username, password, email, register_time, group_id, status, mtime', 'safe', 'on'=>'search'),
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
            'userProfile' => array(self::HAS_ONE, 'UserProfile', 'user_id'),
            'assign' => array(self::HAS_ONE,'UserMangerAssign','user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => '用户名称',
			'password' => '用户密码',
			'email' => '电子邮箱',
			'register_time' => '注册时间',
			'group_id' => '用户组',
            'authitem'=> '角色',
			'status' => '用户状态',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
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

    /**
     * 用户密码效验
     * 
     * @param type $password
     * @return string res
     */
    public function validatePassword($password)
    {
        return $this->hashPassword($password)===$this->password;
    }

    /**
     * hash
     * 
     * @param string $password
     * @return string
     */
    public function hashPassword($password)
    {
        return hash('sha256',Yii::app()->params['loginCodeKey'].$password);
    }
    
    /**
     * static function get hashPassword
     * 
     * @param string $password
     * @return string hash passowrd
     */
    public static function getHashPassword($password)
    {
        return hash('sha256',Yii::app()->params['loginCodeKey'].$password);
    }
    
    public function delete() 
    {
        throw new CHttpException(403,'禁止删除用户!');
        return parent::delete();
    }
    
    public static function getAvatar($uid,$size='big')
    {
        return "http://quanzi.lfeel.com/uc_server/avatar.php?uid={$uid}&size={$size}";
    }
}