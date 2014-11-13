<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SettingComponet
 *
 * @author Administrator
 */
class SettingComponet extends CComponent{
    
    /**
     * 读取数据库
     * @var obj
     */
    public $base;
    
    public function init()
    {
        $this->_getData();
    }
    /**
     * 读取数据库数据
     */
    private function _getData()
    {
        /*$model = Yii::app()->cache->get('global_setting');
        if($model === false){
            $model = Setting::model()->getDbConnection()->createCommand("select * from `setting`")->queryAll();
            Yii::app()->cache->add('global_setting',$model,86400);
        }*/
        $model = Setting::model()->getDbConnection()->createCommand("select * from `setting`")->queryAll();
        /*动态附属性到data*/
//        foreach($model as $key){
//            $this->base->{$key['name']} = $key['value'];
//        }
    }
}