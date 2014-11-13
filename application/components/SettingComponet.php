<?php

class SettingComponet extends CComponent{
    
    public $base;
    
    public function init()
    {
        $this->_getData();
    }

    private function _getData()
    {
        /*$model = Yii::app()->cache->get('global_setting');
        if($model === false){
            $model = Setting::model()->getDbConnection()->createCommand("select * from `setting`")->queryAll();
            Yii::app()->cache->add('global_setting',$model,86400);
        }
        foreach($model as $key){
            $this->base->{$key['name']} = $key['value'];
        }*/
    }
}