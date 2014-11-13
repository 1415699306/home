<?php
define('STUDY_URL','study');
class StudyModule extends CWebModule
{
	public function init()
	{
		$this->setImport(array(
			'study.components.*',
		));
        $path = Yii::getPathOfAlias('webroot');
		Yii::app()->setTheme(STUDY_URL);
		$this->setViewPath($path.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.STUDY_URL.DIRECTORY_SEPARATOR.'views');	
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
