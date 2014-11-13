<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IListPage
 * 上下页widget
 * @author martin
 */
class IListPage extends CWidget{
    
    public $model;
    private $_cassName;
    
    public function init() 
    {
        $this->_cassName = get_class($this->model);
    }
    
    public function _registerHtml()
    {
        $className = $this->_cassName;
        $table = $className::model()->tableName();
        $id = (int)Yii::app()->request->getParam('id',0);
        $nextModel=$className::model()->dbConnection->createCommand("select id,title from `{$table}` where id > :id order by id asc limit 1")->bindValue(':id',$id)->queryRow();
        $prevModel=$className::model()->dbConnection->createCommand("select id,title from `{$table}` where id < :id order by id desc limit 1")->bindValue(':id',$id)->queryRow();
        $prev = !empty($prevModel) ? CHtml::link($prevModel['title'],Yii::app()->createUrl($this->getOwner()->module->id.'/'.$this->controller->id.'/'.$this->controller->action->id,array('id'=>$prevModel['id']))):'没有了';
        $next = !empty($nextModel) ? CHtml::link($nextModel['title'],Yii::app()->createUrl($this->getOwner()->module->id.'/'.$this->controller->id.'/'.$this->controller->action->id,array('id'=>$nextModel['id']))):'没有了';
        $html = '<div class="new_b">';
        $html .= "<div class='new_bL'><p>上一篇:{$prev}</p></div>";
        $html .= "<div class='new_bR'><p>{$next}:下一篇</p></div>";
        $html .='</div>';
        return $html;
    }
    
    public function run()
    {
        echo $this->_registerHtml();
    }
}