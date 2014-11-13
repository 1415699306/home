<?php
define('INVESTMENT_URL','investment');
class InvestmentModule extends CWebModule
{
	public function init()
	{
		$this->setImport(array(
			'investment.components.*',
		));
        $path = Yii::getPathOfAlias('webroot');
		Yii::app()->setTheme(INVESTMENT_URL);
		$this->setViewPath($path.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.INVESTMENT_URL.DIRECTORY_SEPARATOR.'views');
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
