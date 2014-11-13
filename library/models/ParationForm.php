<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 用户场景
 *
 * @author Administrator
 */
class ParationForm extends CFormModel{
    
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
        
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
        
		return array(
            'username'=>'',
            'company'=>'',
            'duties'=>'',
            'email'=>'',   
            'gender'=>'性别',
            'trade'=>'所属行业',
            'turnover'=>'年度业额',
            'sername'=>'',
            'number'=>'',
            'mail'=>'',
            'phone'=>''      
		);
        
         
	}
    
    
    
    /**
     * 检查email可用性
     */
    public function checkEmail()
    {
        $model = UserSchedule::model()->countByAttributes(array('email'=>$this->email));
        if(0 < $model)
            $this->addError('email','邮箱已被注册!');
    }
    
    
    public function checkEail()
    {
        $model = UserSchedule::model()->countByAttributes(array('mail'=>$this->mail));
        if(0 < $model)
            $this->addError('mail','邮箱已被注册!');
    }
    
    
    /**
     * 检查用户名
     */
    public function checkUserName()
    {
        $model = UserSchedule::model()->countByAttributes(array('username'=>$this->username));
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

