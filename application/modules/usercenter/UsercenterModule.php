<?php
define('USERCENTER_URL','usercenter');
class UsercenterModule extends CWebModule
{
	public function init()
	{
        $this->setImport(array(
			'usercenter.components.*',
		));
        $path = Yii::getPathOfAlias('webroot');
		Yii::app()->setTheme(USERCENTER_URL);
		$this->setViewPath($path.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.USERCENTER_URL.DIRECTORY_SEPARATOR.'views');
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
