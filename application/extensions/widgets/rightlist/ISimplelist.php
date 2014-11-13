<?php

class ISimplelist extends CWidget{
    
    public $title;
    public $model;
    public $category_id;
    public $controller = 'list';
    public $action = 'view';
    public $limit = 10;
    public function run()
    {
        if($this->model === null)return;
        //$model = Yii::app()->redis->get(__CLASS__,$this->model,$this->category_id);
        $module = $this->getOwner()->module->id;
//        if($model === false)
//        {           
            $modelName = (string)$this->model;    
            $criteria = new CDbCriteria();
            $criteria->select = 'title,id,ctime';
            $criteria->condition = 'status = :status';
            $criteria->addCondition('category_id = :cid');
            $criteria->params = array(':status'=>0,':cid'=>$this->category_id);
            $criteria->order = 'id desc';
            $criteria->limit = $this->limit;
            $model = $modelName::model()->findAll($criteria);       
//            Yii::app()->redis->setex(__CLASS__,$this->model,$this->category_id,CJSON::encode($model),86400);
//        }else{
//            $model = CJSON::decode($model,true);
//        }
        $html =  "<div class='content'><h3><span>".CHtml::link('更多',Yii::app()->createUrl('/'.$module.'/'.$this->controller.'/category',array('id'=>$this->category_id)),array('target'=>'_blank'))."</span><em>{$this->title}</em></h3><ul>";
        foreach($model as $key){
            $html .= CHtml::tag('li').CHtml::tag('em',array('class'=>'time')).Helper::time_tran($key['ctime']).CHtml::closeTag('em').CHtml::link(Helper::truncate_utf8(CHtml::encode($key['title']),20),Yii::app()->createUrl('/'.$module.'/'.$this->controller.'/'.$this->action,array('id'=>$key['id'])),array('title'=>$key['title'],'target'=>'_blank')).CHtml::closeTag('li');   
        }
        $html .= '</ul></div>';
        echo $html;
    }
}
