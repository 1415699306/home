<?php

class WebUser extends CWebUser
{ 
    public function __get($name)
    {
        return parent::__get($name);
    }
    
    public function login($identity, $duration) 
    {			
        parent::login($identity, $duration);       
    }
    
    public function afterLogout() 
    {
        Yii::app()->session->clear();
        Yii::app()->session->destroy();
        return parent::afterLogout();
    }
}
