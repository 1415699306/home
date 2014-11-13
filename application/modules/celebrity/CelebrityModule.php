<?php
define('CELEBRITY_URL','celebrity');
class CelebrityModule extends CWebModule
{
    public function init()
	{
        $this->setImport(array(
			'celebrity.components.*',
		));
        $path = Yii::getPathOfAlias('webroot');
		Yii::app()->setTheme(CELEBRITY_URL);
		$this->setViewPath($path.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.CELEBRITY_URL.DIRECTORY_SEPARATOR.'views');
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
