<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of XCJuiProgressBar
 *
 * @author martin
 */
class XCJuiProgressBar extends CJuiProgressBar{
    public function run()
	{
		$id=$this->getId();
		if(isset($this->htmlOptions['id']))
			$id=$this->htmlOptions['id'];
		else
			$this->htmlOptions['id']=$id;

		echo CHtml::openTag($this->tagName,$this->htmlOptions);
        echo CHtml::tag('div',array('class'=>'progress-label')).$this->value.'%'.CHtml::closeTag('div');
		echo CHtml::closeTag($this->tagName);

		$this->options['value']=$this->value;
		$options=CJavaScript::encode($this->options);
		Yii::app()->getClientScript()->registerScript(__CLASS__.'#'.$id,"jQuery('#{$id}').progressbar($options);");
        $this->_regsiterScript($id);
	}
    
    private function _regsiterScript($id)
    {
        $js = Yii::app()->getClientScript();
        $js->registerCss("#{$id}",".ui-progressbar {position: relative;}.progress-label {color:#000;position: absolute;left: 45%;top: 0px;font-weight: bold;text-shadow: 1px 1px 0 #fff;}");
    }
}