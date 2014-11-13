<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IBaiduEdit
 * 百度编辑器widget
 * @author martin
 */
class IBaiduEdit extends CInputWidget
{
    public $debug=false;
    public $model;
    public $form;
    public $value;
    public $attribute;
	public $htmlOptions;	 
    public $toolbars;   
    public $initialContent = '';
    public $initialFrameWidth = 'auto';
	public $initialFrameHeight = 400;
	public function init()
	{
		if($this->toolbars === null)
			$this->toolbars = "'fullscreen','source', '|', 'undo', 'redo', '|',
					'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch','autotypeset', '|',
					'blockquote', '|', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist','selectall', 'cleardoc', '|', 'customstyle',
					'paragraph', '|','rowspacingtop', 'rowspacingbottom','lineheight', '|','fontfamily', 'fontsize', '|',
					'directionalityltr', 'directionalityrtl', '|', '', 'indent', '|',
					'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify',
					'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright',
					'imagecenter', '|', 'insertimage','pagebreak', '|',
					'horizontal', 'date', 'time', '|',
					'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', '|',
					'searchreplace'";
	}
	
    public function run() 
    {
		list($name, $id) = $this->resolveNameID();
		$imagePath = HOME_URL.DIRECTORY_SEPARATOR;
        $token = Yii::app()->request->getCsrfToken();
        $url ="/api/upload/editor/?YII_CSRF_TOKEN={$token}";
        $js = Yii::app()->getClientScript();
        $baseDir = dirname(__FILE__);
        $assets = Yii::app()->getAssetManager()->publish($baseDir.DIRECTORY_SEPARATOR.'ueditor');
		$jsFile = $this->debug ? 'ueditor_all.js' : 'ueditor_all_min.js';
		$js->registerScriptFile($assets.'/' . $jsFile,  CClientScript::POS_HEAD);
		$js->registerScriptFile($assets.'/ueditor_config.js',  CClientScript::POS_HEAD);
        $js->registerCssFile($assets.'/themes/default/css/ueditor.css');
        $js->registerScript("#{$id}","
             var editor = new baidu.editor.ui.Editor({
             pageBreakTag:'#pages#',
             enterTag:'p',
             initialContent:'{$this->initialContent}',
             initialFrameWidth : '{$this->initialFrameWidth}',
             initialFrameHeight:'{$this->initialFrameHeight}',
			 listDefaultPaddingLeft:'0',
			 imagePath:'{$imagePath}',
             imageUrl:'{$url}',
             wordCount:false,
             elementPathEnabled:false,
             'UEDITOR_HOME_URL':'{$assets}/',
		     toolbars:[[{$this->toolbars}]]
            });
            editor.render('{$id}');
        ",  CClientScript::POS_END);
		
		if($this->hasModel()) {
			$html = CHtml::activeTextArea($this->model, $this->attribute, $this->htmlOptions);
		} else {
			$html = CHtml::textArea($name, $this->value, $this->htmlOptions);
		}
		echo $html;       
    }
}
