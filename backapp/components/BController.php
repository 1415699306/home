<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BController
 * 后台基类
 * @author Administrator
 */
define('BACKEND_URL','backend');
define('PUBLIC_VIEW', THEME_PATH.DIRECTORY_SEPARATOR.'backend'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'public');
class BController extends CController{
    /**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	//public $layout='webroot.themes.backend.views.layouts.backend'; 
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
    public function init()
    {
        Yii::app()->getClientScript()->registerCoreScript('jquery');
    }
    
	public function filters() 
	{
        return array( 'accessControl',);
	}
	
	public function accessRules()
	{
        $action = (string)$this->getActions();
		return array(
            array('allow',
                'actions'=>array('captcha'),
                'users'=>array('*'),               
			),	
			array('allow',
                'actions'=>array("{$action}"),
                'users'=>array('@'),  
                'expression'=>array($this,'isBackendManger'),
			),	
            array(
                'allow',
                'actions'=>array('login','logout'),
                'users'=>array('*'),
            ),
			array('deny',
                'users'=>array('*'),
			),
		);
	}
    
    public function getActions()
    {             
        return Yii::app()->controller->action->id;
    }
    
    public function getController()
    {
        return Yii::app()->controller->id;
    }
    
    public function isBackendManger()
    {
        if(Yii::app()->user->name != Yii::app()->params['adminName']){
            $userManger = new CuserManger();
            if(!$userManger->testAssign())
                return false;
            if($userManger->checkRole(Yii::app()->controller, Yii::app()->controller->action) === false && Yii::app()->user->name !=  Yii::app()->params['adminName'])
                return false;
            else
                return true;
        }else{
            return true;
        }
    }
}
