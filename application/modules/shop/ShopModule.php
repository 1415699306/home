<?php
define('SHOP_URL','shop');
class ShopModule extends CWebModule
{
	public function init()
	{
        $this->setImport(array(
			'shop.components.*',
		));
        $path = Yii::getPathOfAlias('webroot');
		Yii::app()->setTheme(SHOP_URL);
		$this->setViewPath($path.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.SHOP_URL.DIRECTORY_SEPARATOR.'views');
        $this->registerScript();
	}
    
     public function registerScript()
    {
        $cs = Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');
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
