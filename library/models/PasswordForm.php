<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PasswordForm
 * 修改用户基本场景
 * @author Administrator
 */
class PasswordForm extends CFormModel{
    
    private $strong_pattern = '/^(?=.*\d(?=.*\d))(?=.*[a-zA-Z](?=.*[a-zA-Z])).{5,}$/';
    public $password;
    public $againpassword;
    
    public function rules()
	{
		return array(
			// username and password are required
			array('password, againpassword', 'required'),
            array('againpassword', 'checkPassword'),        
            array('password','checkString'),
			array('password, againpassword', 'length', 'max'=>64),
		);
	}
    
    /**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
            'password'=>'密码',
            'againpassword'=>'确认密码',
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
    
}

