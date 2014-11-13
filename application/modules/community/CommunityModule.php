<?php
define('COMMUNITY_URL','community');
class CommunityModule extends CWebModule
{
	public function init()
	{
		$this->setImport(array(
			'community.components.*',
		));
        
        $path = Yii::getPathOfAlias('webroot');
		Yii::app()->setTheme(COMMUNITY_URL);
		$this->setViewPath($path.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR.COMMUNITY_URL.DIRECTORY_SEPARATOR.'views');
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
