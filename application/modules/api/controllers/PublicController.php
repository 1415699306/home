<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PublicController
 *
 * @author martin
 */
class PublicController extends CController{
    
    public function __construct() 
    {
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(403,'403');
    }
    
    public function actionCommant()
    {        
        if(Yii::app()->user->isGuest)Yii::app()->end (CJSON::encode(array('success'=>false,'code'=>'-2','msg'=>'提交失败,请先登录!')));            
        $id = (int)Yii::app()->request->getParam('t',0);
        $appId = (int)Yii::app()->request->getParam('app',0);
        $parentId = (int)Yii::app()->request->getParam('p',0);
        $commant = (string)Yii::app()->request->getParam('content');
        $time = time();
        if($commant === null || $appId === 0 || $id === 0)Yii::app()->end (CJSON::encode(array('success'=>false,'code'=>'-1')));
        $sql = "insert into `public_comment` set `app_id`=:app ,`res_id`=:id ,`parent_id`=:pid ,`user_id`=:uid ,`status`=:st ,`username`=:name ,`content`=:con ,`ctime`=:ct ,`mtime`=:mt";
        Yii::app()->db->createCommand($sql)->bindValues(array(':app'=>$appId,':id'=>$id,':pid'=>$parentId,':uid'=>Yii::app()->user->id,':st'=>0,':name'=>Yii::app()->user->name,':con'=>$commant,':ct'=>$time,':mt'=>$time))->execute();
        if(0 < Yii::app()->db->getLastInsertID())
            Yii::app()->end (CJSON::encode(array('success'=>true,'code'=>'1','msg'=>'提交成功!审核后方可显示!')));
        else
            Yii::app()->end (CJSON::encode(array('success'=>false,'code'=>'-1','msg'=>'提交失败!')));
    }
    
    public function actionUploadCount()
    {
        $res_id = (int)Yii::app()->request->getParam('t',0);
        $app_id = (int)Yii::app()->request->getParam('app',0);
        $token  = (string)Yii::app()->request->getParam('YII_CSRF_TOKEN',0);
        $this->_check($res_id, $app_id, $token);
        $count = Yii::app()->db->createCommand("select app_id,res_id from `public_count` where `app_id` =:app_id and `res_id`=:res_id")->bindValues(array(':app_id'=>$app_id,':res_id'=>$res_id))->queryRow();
        if($count === false)
            $sql = "insert into `public_count` set `count`=1,`app_id`=:app_id, `res_id`=:res_id";
        else
            $sql = "UPDATE `public_count` SET  `count` = count+'1' WHERE app_id=:app_id and res_id=:res_id";
        Yii::app()->db->createCommand($sql)->bindValues(array(':app_id'=>$app_id,':res_id'=>$res_id))->execute();
    }
    
    public function actionAttention()
    {
        $res_id = (int)Yii::app()->request->getParam('rid',0);
        $app_id = (int)Yii::app()->request->getParam('aid',0);
        $token  = (string)Yii::app()->request->getParam('YII_CSRF_TOKEN',0);
        $this->_check($res_id, $app_id, $token);
        if(Yii::app()->user->isGuest)Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'-2','msg'=>'提交失败,请先登录!')));
        $count = Yii::app()->db->createCommand('select count(id) from `public_attention` where res_id = :rid and app_id = :aid and user_id = :uid')->bindValues(array(':rid'=>$res_id,':aid'=>$app_id,':uid'=>Yii::app()->user->id))->queryRow();
        if($count["count(id)"] == '0')
        {
            Yii::app()->db->createCommand('insert into `public_attention` set `res_id` = :rid,`app_id` = :aid,`user_id` = :uid,`ctime`=:time,`mtime`=:time')->bindValues(array(':rid'=>$res_id,':aid'=>$app_id,':uid'=>Yii::app()->user->id,':time'=>time()))->execute();
            if(0 < Yii::app()->db->getLastInsertID())
                Yii::app()->end (CJSON::encode(array('success'=>true,'code'=>'1','msg'=>'提交成功!')));
            else
                Yii::app()->end (CJSON::encode(array('success'=>false,'code'=>'0','msg'=>'提交失败!')));
        }else{
            Yii::app()->end (CJSON::encode(array('success'=>false,'code'=>'-1','msg'=>'您已提交过啦,不能重复提交!')));           
        }
        
    }
    
    private function _check($res_id,$app_id,$token){
        if($app_id === 0 || $res_id ===0 || $token != Yii::app()->request->getCsrfToken())
            throw new CHttpException(403,'非法操作');
    }
    
}

