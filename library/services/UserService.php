<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserService
 *
 * @author Administrator
 */
class UserService {
    
    public function __construct() 
    {
        Yii::import('application.vendors.*');
        require_once 'ucenter.php';
    }
    
    public static function getUserName($uid)
    {
        $model = self::getUserProfile($uid);
        if(empty($model))
            return null;
        else
             return isset($model['realname'])?$model['realname']:null;        
    }
    
    public  function getAvatar($uid,$size='big')
    {
        return sprintf(QUANZI_URL."/uc_server/avatar.php?uid=%s&size=%s",$uid,$size);
    }
    
    public static function getUserProfile($uid)
    {       
        $auoth = new AuthCode();
        $token = $auoth->auth('bbs13Abc24a9RKSx83FBAPAPx');
        $request = sprintf("http://quanzi.lfeel.com/api/user.php?uid=%s&token=%s",$uid,urlencode($token));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2);
        $res=curl_exec($ch);
        curl_close($ch);
        if($res===null)
            return array();
        else
            return CJSON::decode($res,true);
    }
}