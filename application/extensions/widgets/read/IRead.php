<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IRead
 * 相关,猜您想看的文章widget
 * @author martin
 */
class IRead extends CWidget
{
    public $model;
    public $module;
    public $limit = 7;
    private $_cassName;
    public function init()
    {
        $this->_cassName = get_class($this->model);
    }
    
    private function _registerHtml()
    {
        $className = $this->_cassName;
        $table = $className::model()->tableName();
        $limit = (int)$this->limit;
        $id = (int)Yii::app()->request->getParam('id',0);
        $model=$className::model()->dbConnection->createCommand("select id,title,ctime,category_id from `{$table}` where id !=:id and status = '0' ORDER BY id desc limit {$limit}")->bindParam(':id',$id)->query();
        $rand=$className::model()->dbConnection->createCommand("select id,title,ctime,category_id from `{$table}` where status = '0' ORDER BY rand() limit {$limit}")->query();
        $html = '<div class="pass"><div class="pass_1"><p>相关阅读</p><ul class="pass_list">';
        foreach ($model as $key){
            $html .= CHtml::tag('li').CHtml::tag('span').date('m-d',$key['ctime']).CHtml::closeTag('span').CHtml::link($key['title'],Yii::app()->createUrl($this->getOwner()->module->id.'/'.$this->controller->id.'/'.$this->controller->action->id,array('id'=>$key['id'])),array('title'=>$key['title'])).CHtml::closeTag('li');
        }
        $html .= '</ul></div><div class="pass_1"><p>猜您想看的文章</p><ul class="pass_list right">';
        foreach ($rand as $key){
            $html .= CHtml::tag('li').CHtml::tag('span').date('m-d',$key['ctime']).CHtml::closeTag('span').CHtml::link($key['title'],Yii::app()->createUrl($this->getOwner()->module->id.'/'.$this->controller->id.'/'.$this->controller->action->id,array('id'=>$key['id'])),array('title'=>$key['title'])).CHtml::closeTag('li');
        }      
        $html .= '</ul></div></div>';
        return $html;
    }
    
    public function run()
    {
        echo $this->_registerHtml();
    }
}
