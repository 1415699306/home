<?php
define('TRADE_URL','trade');
class TradeModule extends CWebModule
{
	public function init()
	{
        $this->setImport(array(
			'trade.components.*',
		));
        $path = Yii::getPathOfAlias('webroot');
		Yii::app()->setTheme(TRADE_URL);
		$this->setViewPath($path.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.TRADE_URL.DIRECTORY_SEPARATOR.'views');
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
