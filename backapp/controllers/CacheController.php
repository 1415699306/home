<?php
class CacheController extends BController{
    
    public function actionIndex(){
        $xml = simplexml_load_file(ROOT_PATH.'/backapp/xml/system/cache.xml');
        
        $model = array();
        foreach ($xml AS $item=>$val){
            $model[$item]['label'] = $val->label;
            $model[$item]['target'] = $val->target;         
        }
        $this->render('index',array(
            'model'=>$model,
        ));
    }
    
    public function actionClear($app_id,$res_id,$prefix)
    {
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(403,'非法访问!');
        $res_id = explode(',',$res_id);
        if(count(1 < $res_id))
        {
            foreach($res_id as $key)
            {
                Yii::app()->redis->delete($prefix.'_'.$app_id.'_'.$key);
            }
        }
        if($res_id[0]==='true')
        {
            $modelName = BaseApp::getModelName($app_id);
            $categorys = $this->_getCategoryId($modelName);
            foreach ($categorys as $key){
                Yii::app()->redis->delete($prefix.'_'.$app_id.'_'.$key);
            }
        }else{
            Yii::app()->redis->delete($prefix.'_'.$app_id.'_'.$res_id[0]);
        }
        Yii::app()->end(CJSON::encode(array('success'=>'true','code'=>'1')));
    }
    
    public function actionClearOrder($prefix)
    {       
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(403,'非法访问!');
        $appId = BaseApp::getConst();
        foreach($appId as $key){
            Yii::app()->redis->delete($prefix.'_'.$key.'_'.$prefix);
        }
        Yii::app()->end(CJSON::encode(array('success'=>'true','code'=>'1')));
    }
    
    private function _getCategoryId($modelNmae)
    {
        $res = array();
        $parent = Yii::app()->db->createCommand("select lft,rgt from `category` where `category_name`=:name")->bindValue(':name',$modelNmae)->queryRow();
        $ids = Yii::app()->db->createCommand("select id from `category` where lft BETWEEN :left AND :right")->bindValues(array(':left'=>$parent['lft'],':right'=>$parent['rgt']))->queryAll();
        foreach($ids as $key){
            $res[] = $key['id'];
        }
        return $res;
    }
}
