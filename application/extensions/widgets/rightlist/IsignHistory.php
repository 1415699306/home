<?php

class IsignHistory extends CWidget{
    public $title;
    public $model;
    public $app_id;
    
    public function run()
    {
        if($this->model === null || $this->app_id === null)return;
        $time = time();
        $owner = $this->getOwner();
        $className = $this->model;
        $table = $className::model()->tableName();
        $model = Yii::app()->db->createCommand("select a.id,a.title,a.start_time,a.locale,a.top_bar,a.people_number,b.id as bid,b.track_id from `{$table}` as a,`storage` as b where a.id = b.res_id  and a.off_time < :time and b.app_id = :pid order by id desc limit 10")->bindValues(array(':pid'=>$this->app_id,':time'=>$time))->queryAll();
        $html  = "<div class='content news'><h3><em>{$this->title}</em></h3><ul>";
        foreach($model as $key=>$val){
            $img = Meet::getTopBar($val['top_bar']);
            if($key < 3){
                $html .= CHtml::tag ('li',array('class'=>'sign_img')).CHtml::image($img,$val['title'],array('width'=>90,'height'=>90));
                $html .=CHtml::tag ('p').CHtml::link(Helper::truncate_utf8(CHtml::encode($val['title']),12),$owner->createUrl('/'.$owner->module->id.'/list/sign',array('id'=>$val['id'])),array('img_url'=>$img,'title'=>$val['title'])).CHtml::closeTag('p').CHtml::closeTag('li');                     
                $html .=CHtml::tag('p').'时间:'.date('Y-m-d',$val['start_time']).CHtml::closeTag('p');
                $html .=CHtml::tag('p').'地点:'.$val['locale'].CHtml::closeTag('p');
                $html .=CHtml::tag('p').'人数:参与仅限'.$val['people_number'].'人'.CHtml::closeTag('p');
            }
            else
                $html .= CHtml::tag('li').CHtml::tag ('span').($key+1).CHtml::closeTag('span').CHtml::link(CHtml::encode($val['title']),$owner->createUrl('/'.$owner->module->id.'/list/sign',array('id'=>$val['id'])),array('img_url'=>$img)).CHtml::closeTag('li');
        }
        $html .='</ul></div>';
        echo $html;
    }
}
