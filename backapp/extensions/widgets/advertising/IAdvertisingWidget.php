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
    private $_html;
    public function init()
    {
        $model = $this->_loadModel();
        if($model === null)return;
        $this->_html = CHtml::tag ('div',array('id'=>'advertising')).CHtml::tag ('ul');
        foreach ($model as $key)
        {
            if($this->type == 0)
                $this->_html .= CHtml::tag ('li').CHtml::link($key->name,$key->link). CHtml::closeTag ('li');
            else
                $this->_html .= CHtml::tag ('li').CHtml::link(CHtml::image('/'.RESOURCE.'/advertising/thumb/'.$key->thumbs->track_id,$key->name,array('width'=>$this->width)),$key->link,array('target'=>'_blank')). CHtml::closeTag ('li');
        }  
        $this->_html .= CHtml::closeTag ('ul').CHtml::closeTag ('div');
        return parent::init();
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
        return Advertising::model()->together(false)->findAll($criteria);
    }
    
    public function run() 
    {
        echo $this->_html;
        return parent::run();
    }
}
