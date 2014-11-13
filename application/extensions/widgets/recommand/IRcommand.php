<?php

class IRcommand extends CWidget
{   
    public $model;
    public $limit =5;
    public $thumb;
    private $_cassName;
    public function init() 
    {
        $this->_cassName = get_class($this->model);
    }
    
    private function _registerHtml()
    {
        $class = $this->_cassName;
        $criteria = new CDbCriteria();
        $criteria->condition = 'recommand = :rc';
        $criteria->addCondition('status = 0');
        $criteria->params = array(':rc'=>1);
        $criteria->order = 'id desc';
        $criteria->limit = $this->limit;
        $model = $class::model()->findAll($criteria);    
        $html = '<div class="wrap_list"><h3 class="pic_title">推荐阅读</h3>';
        foreach ($model as $key){
            $image  = !empty($key->thumbs) ? Storage::getImageBySize($key->thumbs->track_id,$this->thumb == null ? strtolower($this->_cassName) : $this->thumb,'16_9','thumb'):'';
            $link = Yii::app()->createUrl($this->getOwner()->module->id.'/'.$this->controller->id.'/'.$this->controller->action->id,array('id'=>$key['id']));
            $html .='<dl class="pic_list">'.CHtml::link(CHtml::image($image,CHtml::encode($key->title),array('width'=>150,'height'=>80)),$link,array('title'=>$key->title)).'</dt><dd>'.CHtml::link(CHtml::encode($key->title),$link,array('title'=>$key->title)).'</dd></dl>';
        }
        return $html .='</div>';
    }

    public function run() 
    {
       echo  $this->_registerHtml();
    }
}

