<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Simplelist
 * 右栏最新列表
 * @author Administrator
 */
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
        $module = $this->getOwner()->module->id;
        $modelName = (string)$this->model;    
        $criteria = new CDbCriteria();
        $criteria->select = 'title,id';
        $criteria->condition = 'status = :status';
        $criteria->addCondition('category_id = :cid');
        $criteria->params = array(':status'=>0,':cid'=>$this->category_id);
        $criteria->order = 'id desc';
        $criteria->limit = $this->limit;
        $model = $modelName::model()->findAll($criteria);       
        $html =  "<div class='content'><h3><span>".CHtml::link('更多',Yii::app()->createUrl('/'.$module.'/'.$this->controller.'/category',array('id'=>$this->category_id)),array('target'=>'_blank'))."</span><em>{$this->title}</em></h3><ul>";
        foreach($model as $key){
            $html .= CHtml::tag('li').CHtml::link($key->title,Yii::app()->createUrl('/'.$module.'/'.$this->controller.'/'.$this->action,array('id'=>$key->id)),array('title'=>$key->title,'target'=>'_blank')).CHtml::closeTag('li');   
        }
        $html .= '</ul></div>';
        echo $html;
    }
}
