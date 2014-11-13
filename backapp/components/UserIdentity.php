<?php
/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;
    public $user;
    const USERSTATUSCLOSE = 0;
    const FILTER = -1;

    public function authenticate()
    {
        $username=strtolower($this->username);
        $user=User::model()->find('LOWER(username)=?',array($username));
        /*检查用户状态*/       
        if($user===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(!$user->validatePassword($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        elseif($user->status == self::USERSTATUSCLOSE)
            Helper::showMsg('系统消息','您的账户正处于验证状态,尚不能登录本网站!',Yii::app()->homeUrl);
        elseif($user->status == self::FILTER)
            Helper::showMsg('系统消息','您的账户正处于黑名单状态,尚不能登录本网站!',Yii::app()->homeUrl);
        else
        {
            $this->_id=$user->id;
            $this->username=$user->username;
            $this->errorCode=self::ERROR_NONE;
            $this->setUser($user);
                    
        }
        return $this->errorCode==self::ERROR_NONE;
    }
 
    public function getId()
    {
        return $this->_id;
    }
    
    public function getUser()
    {
        return $this->user;
    }
    
    public function setUser(CActiveRecord $user)
    {
        $this->user=$user->attributes;
    }
}