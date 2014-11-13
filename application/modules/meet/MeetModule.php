<?php
define('MEET_URL','meet');
class MeetModule extends CWebModule
{
	public function init()
	{
        $this->setImport(array(
			'meet.components.*',
		));
        $path = Yii::getPathOfAlias('webroot');
		Yii::app()->setTheme(MEET_URL);
		$this->setViewPath($path.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.MEET_URL.DIRECTORY_SEPARATOR.'views');
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
