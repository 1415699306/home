<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApiModule
 *
 * @author Administrator
 */
class ApiModule extends CWebModule{
    
    public function init()
	{
		$this->setImport(array(
			'api.components.*',
			'api.controllers.*',
			'api.modules.*',
		));
	}
    
    public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{				
			return true;
		}
		else
			return false;
	}
}