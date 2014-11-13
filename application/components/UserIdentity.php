<?php

class UserIdentity extends CUserIdentity
{
    private $_id;
    public $user;
    const USERSTATUSCLOSE = 0;
    const FILTER = -1;

    public function authenticate()
    {
        Yii::import('application.vendors.*');
        require_once 'ucenter.php';
        if(!empty($this->password)){           
            $db = Yii::app()->ucenter->createCommand("select * from `pre_ucenter_members` where `username` = :username")->bindValues(array(':username'=>strtolower($this->username)))->queryRow();
			$password = md5(md5($this->password).$db['salt']);
            $uid = (int)$db['uid'];
			$username = (string)$db['username'];
			$email = (string)$db['email'];
            if(0 < $uid && $password===$db['password']){
                $this->_id=$uid;
                $this->username=$username;
                $this->errorCode=self::ERROR_NONE;
            }elseif($db===false){
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            }elseif($password !=$db['password']){
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }else{
                $this->errorCode=self::ERROR_NONE;
            }
        }
        else
		{
			$db = Yii::app()->ucenter->createCommand("select * from `pre_ucenter_members` where `username` = :username")->bindValue(':username',strtolower($this->username))->queryRow();
			$uid = (int)$db['uid'];
			$username = (string)$db['username'];
			$email = (string)$db['email'];
            if($uid > 0){
                $this->_id=$uid;
                $this->username=$username;
                $this->errorCode=self::ERROR_NONE;
            }elseif($uid == -1){
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            }elseif($uid == -2){
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }else{
                $this->errorCode=self::ERROR_NONE;
            }
            
		}
        return $this->errorCode==self::ERROR_NONE;
    }
 
    public function getId()
    {
        return $this->_id;
    }
    
    private function _random($length, $numeric = 0) 
    {
        PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
        if($numeric) 
        {
            $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
        } 
        else 
        {
            $hash = '';
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
            $max = strlen($chars) - 1;
            for($i = 0; $i < $length; $i++) {
                $hash .= $chars[mt_rand(0, $max)];
            }
        }
        return $hash;
  }
}