<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 用户注册场景
 *
 * @author Administrator
 */
include LIBRARY.DIRECTORY_SEPARATOR.'vendors'.DIRECTORY_SEPARATOR.'uc_client'.DIRECTORY_SEPARATOR.'client.php';
class RegisterForm extends CFormModel{
    
    private $strong_pattern = '/^(?=.*\d(?=.*\d))(?=.*[a-zA-Z](?=.*[a-zA-Z])).{5,}$/';
    private $sum_pattern = '/([0-9]{1,})$/';
    public $username;
    public $password;
    public $againpassword; 
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
            array('password','checkString'),
            array('againpassword', 'checkPassword'),     
            array('phone','MPhoneValidator','message'=>'电话号码不正确!'),
            array('number','MPhoneValidator','message'=>'电话号码不正确!'),
            array('username', 'length', 'max'=>128),
			array('password, againpassword', 'length', 'max'=>64),
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
            'password'=>'用户密码',
            'againpassword'=>'确认密码',
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
     * 检查密码一致性
     */
    public function checkPassword()
    {
        if($this->againpassword != $this->password)
            $this->addError('againpassword','两次暂入密码不一致,请重新输入!');

    }
    
    
    /**
     * 检查密码强度
     */
    public function checkString()
    {
        if(!preg_match($this->strong_pattern, $this->password))
            $this->addError('password','密码太简单啦!密码最少6位数并包含数字及英文字母大小写');       
    }
    
    /**
     * 检查email可用性
     */
    public function checkEmail()
    {
        $flag = uc_user_checkemail($this->email);   
        switch($flag)  
        {  
            case -4:  
                $this->addError('email', 'Email 格式有误');  
                break;  
            case -5:  
                $this->addError('email','Email 不允许注册');  
                break;  
            case -6:  
                $this->addError('email','该 Email 已经被注册');  
                break;  
        }  
    }
    
    
    /**
     * 检查用户名
     */
    public function checkUserName()
    {
        $flag = uc_user_checkname($this->username);           
        switch($flag)  
        {  
            case -1:  
                $this->addError('username', '用户名不合法');  
                break;  
            case -2:  
                $this->addError('username','包含不允许注册的词语');  
                break;  
            case -3:  
                $this->addError('username','用户名已经存在');  
                break;  
        }  
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

