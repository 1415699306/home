<?php
define('LIFE_URL','life');
class LifeModule extends CWebModule
{
	public function init()
	{
		$this->setImport(array(
			'life.components.*',
		));
        $path = Yii::getPathOfAlias('webroot');
		Yii::app()->setTheme(LIFE_URL);
		$this->setViewPath($path.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.LIFE_URL.DIRECTORY_SEPARATOR.'views');
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
