<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ITags
 * 标签调用widget
 * @author Administrator
 */
class ITags extends CWidget
{
    public $res_id;
    public $app_id;
    
    public function run() 
    {
        $model = Yii::app()->db->createCommand("select *,a.id as aid from `tags_relations` as a,`tags` as b where a.res_id = :rid and a.app_id =:aid and a.tag_id = b.id order by b.id desc")->bindValues(array(':aid'=>$this->app_id,':rid'=>  $this->res_id))->queryAll();
        $html = CHtml::tag('div',array('id'=>'tags'));
        $html .= CHtml::tag('ul');
        if(empty($model))return null;
        foreach ($model as $key)
        {
            $html .= CHtml::tag('li').CHtml::link($key['name'],Yii::app()->createUrl('/tag/list/',array('tag'=>$key['name'],'aid'=>$this->app_id,'act'=>!empty($this->getOwner()->module->id)?$this->getOwner()->module->id:Yii::app()->request->getParam('act',null))),array('target'=>'_blank','title'=>$key['name'])).CHtml::closeTag('li');
        }
        $html .=CHtml::closeTag('ul');
        $html .=CHtml::closeTag('div');
        echo $html;
    }
}
