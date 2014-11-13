<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Schedule extends CActiveRecord
{
    
    private $strong_pattern = '/^(?=.*\d(?=.*\d))(?=.*[a-zA-Z](?=.*[a-zA-Z])).{5,}$/';
    private $sum_pattern = '/([0-9]{1,})$/';
    public $username;
    public $email;
    public $gender;
    public $company;
    public $duties;
    public $trade;
    public $turnover;
    public $sername;
    public $number;
    public $phone;
    public $mail;
    public $verifyCode;
    
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'schedule';
	}
    
   public function rules()
	{
		return array(
			// username and password are required
			array( 'username,company,duties,number,trade,turnover,sername,phone', 'required'),
            array('email', 'email'),
            array('username','checkUserName'),
            //array('username','checkUser'),
            array('username','checkUser'),
            array('sername','checkSum'),
            array('email', 'checkEmail'), 
            array('mail','email'), 
            array('phone','MPhoneValidator','message'=>'电话号码不正确!'),
            array('number','MPhoneValidator','message'=>'电话号码不正确!'),
            array('username', 'length', 'max'=>128),
			array('email', 'length', 'max'=>1024),
            array('phone', 'length', 'max'=>15), 
            array('number', 'length', 'max'=>15), 
            array('verifyCode', 'captcha','allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}
    
    public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => '姓名',
            'company'=>'公司名称',
            'duties'=>'公司职务',
            'email'=>'电子邮箱',
            'number'=>'联系电话',
			'register_time' => '注册时间',
		);
	}
    
    
    public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
        $criteria->compare('username', $this->username);
		$criteria->compare('gender',$this->gender,true);
        $criteria->compare('company', $this->company,true);
		$criteria->compare('duties',$this->duties,true);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('trade',$this->trade);
        $criteria->compare('turnover',$this->turnover);
        $criteria->compare('sername',$this->sername);
        $criteria->compare('phone',$this->phone);
        $criteria->compare('mail',$this->mail); 
		$criteria->compare('register_time',$this->register_time,true);

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
    
    /**
     * 检查email可用性
     */
    public function checkEmail()
    {
        $model = Schedule::model()->countByAttributes(array('email'=>$this->email));
        if(0 < $model)
            $this->addError('email','邮箱已被注册!');
    }
    
    
    public function checkEail()
    {
        $model = Schedule::model()->countByAttributes(array('mail'=>$this->mail));
        if(0 < $model)
            $this->addError('mail','邮箱已被注册!');
    }
    
    
    /**
     * 检查用户名
     */
    public function checkUserName()
    {
        $model = Schedule::model()->countByAttributes(array('username'=>$this->username));
        if(0 < $model)
            $this->addError('username','用户名已存在!');
    }
    
    public function checkSum()
    {
        if(preg_match($this->sum_pattern, $this->sername))
            $this->addError('sername','不能为数字');
        
        
    }
    
    public function checkUser()
    {
       if(preg_match($this->sum_pattern, $this->username))
            $this->addError('username','不能为数字');
    }
    
    
}
