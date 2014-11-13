<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ICountUpload
 *
 * @author martin
 */
class ICountUpload extends CWidget
{
    public $res_id;
    public $app_id;
    public $debug=true;
    private $_assetsUrl;
    public function run()
    {
        $this->_registerScripts();        
    }
    
    /**
	 * Registers the necessary scripts.
	 */
	private function _registerScripts()
	{        
        $owner = $this->owner;
        if($this->app_id===null || $this->res_id === null)return;
        $url = $owner->createUrl('/api/public/uploadcount',array('YII_CSRF_TOKEN'=>Yii::app()->request->getCsrfToken(),'t'=>$this->res_id,'app'=>$this->app_id));
        $js = Yii::app()->getClientScript();
        $assetsUrl = $this->_getAssetsUrl();
        $js->registerScriptFile($assetsUrl.'/countupload.js');     
        $js->registerScript("#{$this->id}","
            var url = '{$url}';
            var set = new viewCount(url);
            set.push();
        ");
	}
    
    /**
	* Publishes the module assets path.
	* @return string the base URL that contains all published asset files of Advisory.
	*/
	private function _getAssetsUrl()
	{
		if( $this->_assetsUrl===null )
		{
			$assetsPath = Yii::getPathOfAlias('ext.widgets.countupload.assets');

			// We need to republish the assets if debug mode is enabled.
			if( $this->debug===true )
				$this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath, false, -1, true);
			else
				$this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath);
		}
		return $this->_assetsUrl;
	}
}