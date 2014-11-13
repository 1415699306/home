<?php

/**
 * This is the model class for table "user_profile".
 *
 * The followings are the available columns in table 'user_profile':
 * @property string $id
 * @property string $user_id
 * @property string $logintime
 * @property string $avatar
 * @property integer $gender
 * @property string $birthday
 * @property integer $province
 * @property integer $city
 * @property string $phone
 * @property string $qq
 * @property string $company
 * @property string $profile
 * @property integer $integral
 * @property string $sign_time
 */
class UserProfile extends CActiveRecord
{
    private $strong_pattern = '/(1[3-8])[123569]{1}\d{8}|15[1235689]\d{8}|188\d{8}/';
    public $email;
    public $avatar_small = '/images/user/avatar_small.gif';
    public $avatar_min = '/images/user/avatar_min.gif';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserProfile the static model class
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
		return 'user_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('gender, province, city, integral ,phone, qq', 'numerical', 'integerOnly'=>true),
			array('user_id, logintime, birthday, sign_time', 'length', 'max'=>11),
            array('email', 'checkEmail'),
            array('email', 'email'),
			array('avatar, profile', 'length', 'max'=>1024),
			array('phone, company', 'length', 'max'=>128),
            array('phone','checkPhoneNumber'),
			array('qq', 'length', 'max'=>32),           
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, logintime, avatar, gender, birthday, province, city, phone, qq, company, profile, integral, sign_time', 'safe', 'on'=>'search'),
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
            'user'=>array(self::BELONGS_TO,'User','user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => '用户ID',
			'logintime' => '最后登录时间',
			'avatar' => '用户头像',
			'gender' => '性别',
			'birthday' => '生日',
			'province' => '省',
			'city' => '市',
			'phone' => '助理电话',
			'qq' => 'QQ',
            'duties'=>'公司职务',
            'sername'=>'助理名称',
			'company' => '公司',
			'profile' => '个人简介',
			'integral' => '积分',
			'sign_time' => '签到时间',
            'trade'=>'所属行业',
            'turnover'=>'企业上市年度营业额',
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
		$criteria->compare('logintime',$this->logintime,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('province',$this->province);
		$criteria->compare('city',$this->city);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('profile',$this->profile,true);
		$criteria->compare('integral',$this->integral);
		$criteria->compare('sign_time',$this->sign_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function beforeSave()
    {
        if($this->isNewRecord){
            $this->logintime = time();
        }
        $this->birthday = strtotime($this->birthday,time());
        return parent::beforeSave();
    }
    
    public function afterFind()
    {       
        if(0 < strlen($this->avatar)){
            if(preg_match_all('/^\/.*?\/.*?\/(.*?)\/(.*?)\/(.*?)\/(.*?)\.(.*?)/iU',$this->avatar, $matchesarray)){
                $folder = DIRECTORY_SEPARATOR.$matchesarray[1][0].DIRECTORY_SEPARATOR.$matchesarray[2][0].DIRECTORY_SEPARATOR.$matchesarray[3][0];                           
                $big = WEB_PATH.$route = $this->avatar;                           
                $this->avatar_small = DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'user'.$folder.DIRECTORY_SEPARATOR.$matchesarray[4][0].'_small.'.$matchesarray[5][0];                       
                $this->avatar_min = DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'user'.$folder.DIRECTORY_SEPARATOR.$matchesarray[4][0].'_min.'.$matchesarray[5][0];
            }
        }else{
            $this->avatar = '/images/user/avatar.gif';
        }
        return parent::afterFind();
    }
    
    /**
     * 检查手机号码
     */
    public function checkPhoneNumber()
    {
        if(!$this->isNewRecord && Yii::app()->controller->action->id != 'flashUploadAvatar'){
            if(!preg_match($this->strong_pattern, $this->phone))
                $this->addError('phone','手机号码格式不正确!');
        }
    }
    
    /**
     * 检查email可用性
     */
    public function checkEmail()
    {
        if(!$this->isNewRecord && Yii::app()->controller->action->id != 'flashUploadAvatar'){
            $id = Yii::app()->user->id;
            $criteria = new CDbCriteria();
            $criteria->condition = 'email=:email';
            $criteria->addCondition("id != '{$id}'");
            $criteria->params = array(':email'=>$this->email);
            $model = User::model()->find($criteria);
            if(!empty($model))
                $this->addError('email','邮箱已被注册!');
            if(empty($this->email))
                $this->addError('email','邮箱不能为空!');
        }
    }
    
    public function behaviors(){
		return array(
			'CSafeContentBehavor' => array(
				'class' => 'ext.behaviors.CSafeContentBehavior',
				'attributes' => array('profile','company'),
			),
		);
	}

}