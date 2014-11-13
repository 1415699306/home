<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CSwfupload
 *
 * @author Administrator
 */
class CSwfupload extends CWidget
{
	public $postParams=array();
	public $config=array();
    
    public function run()
    {
        $baseDir = dirname(__FILE__);
        $assets = Yii::app()->getAssetManager()->publish($baseDir.DIRECTORY_SEPARATOR.'assets');
        $js = Yii::app()->getClientScript();
        $js->registerScriptFile($assets.'/swfupload.js',  CClientScript::POS_HEAD);
		$js->registerScriptFile($assets.'/handlers.js',  CClientScript::POS_HEAD);
        $js->registerCssFile($assets.'/default.css');
        $postParams = array('YII_CSRF_TOKEN'=>Yii::app()->request->getCsrfToken(),'PHPSESSID'=>Yii::app()->session->getSessionId());
        $params = array('post_params'=> $postParams, 'flash_url'=>$assets.'/swfupload.swf');
		$merge = array_merge($params, $this->config);
		$config = CJavaScript::encode($merge);
		Yii::app()->getClientScript()->registerScript(__CLASS__, "
		var swfu;
			swfu = new SWFUpload($config);
		");
    }
}
