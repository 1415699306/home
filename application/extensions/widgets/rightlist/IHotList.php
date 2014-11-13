<?php

class IHotList extends CWidget{
    
    public $title;
    public $app_id;
    public $model;
    public function run()
    {
        $owner = $this->getOwner();
        (string)$className = $this->model;
//        $model = Yii::app()->redis->get(__CLASS__,$this->app_id,__CLASS__);
//        if($model===false)
//        {
            $table =  $className::model()->tableName();
            $model = Yii::app()->db->createCommand("select a.app_id as cid,b.id as id,b.title,c.track_id,c.app_id,c.res_id from `public_count` as a, `{$table}` as b, `storage` as c where a.app_id = :app_id and a.res_id = b.id and c.res_id = b.id and c.app_id = :app_id order by a.id desc limit 10")->bindValues(array(':app_id'=>$this->app_id))->queryAll();       
            Yii::app()->redis->setex(__CLASS__,$this->app_id,__CLASS__,CJSON::encode($model),86400);
//        }else{
//            $model = CJSON::decode($model,true);
//        }
        $html ="<div class='content'><h3><em>{$this->title}</em></h3><ul>";
        foreach($model as $key=>$val){
            if($key < 1)
                $html .= CHtml::link(CHtml::image(Storage::getImageBySize($val['track_id'],$owner->module->id,'16_9','thumb'),$val['title'],array('width'=>260,'height'=>140)));
            else
                $html .= CHtml::tag('li').CHtml::link($val['title'],Yii::app()->createUrl('/'.$owner->module->id.'/'.$owner->id.'/'.$owner->action->id,array('id'=>$val['id'])),array('title'=>$val['title'])).CHtml::closeTag('li');   
        }
        $html .= '</ul></div>';
        echo $html;
    }
}
