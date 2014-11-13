<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IAdvertisingWidget
 *
 * @author Administrator
 */
class IAdvertisingWidget extends CWidget{
    
    public $app_id;
    public $res_id;
    public $limit = 1;
    public $type = 0;
    public $width=1250;
    public $height;
    private $_html;
    public function init()
    {
        $key = $this->_loadModel();
        if($key === null)return;
        $this->_html = CHtml::tag ('div',array('id'=>'advertising','class'=>'advertising
            ')).CHtml::tag ('ul');
        
            if($this->type == 0)
                $this->_html .= CHtml::tag ('li').CHtml::link($key->name,$key->link). CHtml::closeTag ('li');
            else{
                if(Yii::app()->controller->id!=='site'){
                    $this->_html .= CHtml::tag ('li').CHtml::link(CHtml::image('/'.RESOURCE.'/advertising/thumb/'.$key->thumbs->track_id,$key->name,array('width'=>$this->width,'height'=>$this->height)),$key->link,array('target'=>'_blank')). CHtml::closeTag ('li');
                }else{
                    $this->_html .= CHtml::tag ('li').CHtml::link($key->name,$key->link,array('target'=>'_blank','id'=>"advertising_{$key->id}",'img_url'=>'/'.RESOURCE.'/advertising/thumb/'.$key->thumbs->track_id)). CHtml::closeTag ('li');
                    $this->_registerScript($key->id);  
                }                
            }
        
        $this->_html .= CHtml::closeTag ('ul').CHtml::closeTag ('div');
    }
    
    private function _registerScript($id)
    {
        $js = Yii::app()->getClientScript();
        $js->registerScript("#{$id}","
                function advertising_{$id}(){
                    var obj = $('#advertising_{$id}');
                    var top = obj.offset().top;     
                    var link = obj.attr('img_url');
                    if($(window).height() > (top-$(window).scrollTop()) && typeof(link)!=='undefined'){
                        obj.html($('<img src='+link+'>').fadeIn('show'));
                        obj.removeAttr('img_url');
                    }
                }
                $(document).ready(function(){advertising_{$id}();});
                $(window).scroll(function(){advertising_{$id}();});
        ");
    }
    
    private function _loadModel()
    {
        $criteria = new CDbCriteria();
        if($this->type == 1){
            $criteria->with = array('thumbs');
        }
        $criteria->condition = 't.app_id = :aid';
        $criteria->addCondition('start_time < :time');
        $criteria->addCondition('off_time > :time');
        $criteria->addCondition("t.res_id='{$this->res_id}'");
        $criteria->params = array(':aid'=>$this->app_id,':status'=>0,':time'=>time());
        $criteria->limit = $this->limit;
        $criteria->order='t.id desc';
        return Advertising::model()->together(false)->find($criteria);
    }
    
    public function run() 
    {
        echo $this->_html;
        return parent::run();
    }
}
