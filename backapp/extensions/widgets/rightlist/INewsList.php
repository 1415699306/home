<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InewsList
 *
 * @author martin
 */
class INewsList extends CWidget
{
    public $title;
    public $model;
    public $app_id;
    
    public function run()
    {
        if($this->model === null || $this->app_id === null)return;
        $owner = $this->getOwner();
        $className = $this->model;
        $table = $className::model()->tableName();
        $model = $className::model()->getDbConnection()->createCommand("select a.id,a.title,b.id as bid,b.track_id from `{$table}` as a,`storage` as b where a.id = b.res_id and b.app_id = :pid order by id desc limit 10")->bindValue(':pid',$this->app_id)->queryAll();
        $html  = "<div class='content news'><h3><em>{$this->title}</em></h3><ul>";
        foreach($model as $key=>$val){
            $img = Storage::getImageBySize($val['track_id'],$owner->module->id,'16_9','thumb');
            if($key < 1){
                $html .= CHtml::tag ('li',array('class'=>'news_img')).CHtml::image($img,$val['title'],array('width'=>285,'height'=>127));
                $html .=CHtml::tag ('p').CHtml::link(CHtml::encode($val['title']),$owner->createUrl('/'.$owner->module->id.'/list/view',array('id'=>$val['id'])),array('img_url'=>$img)).CHtml::closeTag('p').CHtml::closeTag('li');          
            }
            else
                $html .= CHtml::tag('li').CHtml::tag ('span').($key+1).CHtml::closeTag('span').CHtml::link(Helper::truncate_utf8(CHtml::encode($val['title']),20),$owner->createUrl('/'.$owner->module->id.'/list/view',array('id'=>$val['id'])),array('img_url'=>$img,'title'=>$val['title'])).CHtml::closeTag('li');
        }
        $html .='</ul></div>';
        echo $html;
    }
}
