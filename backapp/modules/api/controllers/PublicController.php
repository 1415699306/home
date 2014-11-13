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
        PublicComment::model()->getDbConnection()->createCommand($sql)->bindValues(array(':app'=>$appId,':id'=>$id,':pid'=>$parentId,':uid'=>Yii::app()->user->id,':st'=>0,':name'=>Yii::app()->user->name,':con'=>$commant,':ct'=>$time,':mt'=>$time))->execute();
        if(0 < PublicComment::model()->getDbConnection()->getLastInsertID())
            Yii::app()->end (CJSON::encode(array('success'=>true,'code'=>'1','msg'=>'提交成功!审核后方可显示!')));
        else
            Yii::app()->end (CJSON::encode(array('success'=>false,'code'=>'-1','msg'=>'提交失败!')));
    }
    
    public function actionUploadCount()
    {
        $res_id = (int)Yii::app()->request->getParam('t',0);
        $app_id = (int)Yii::app()->request->getParam('app',0);
        $token  = (string)Yii::app()->request->getParam('YII_CSRF_TOKEN',0);
        if($app_id === 0 || $res_id ===0 || $token != Yii::app()->request->getCsrfToken())return;
        $count = PublicCount::model()->getDbConnection()->createCommand("select app_id,res_id from `public_count` where `app_id` =:app_id and `res_id`=:res_id")->bindValues(array(':app_id'=>$app_id,':res_id'=>$res_id))->queryRow();
        if($count === false)
            $sql = "insert into `public_count` set `count`=1,`app_id`=:app_id, `res_id`=:res_id";
        else
            $sql = "UPDATE `public_count` SET  `count` = count+'1' WHERE app_id=:app_id and res_id=:res_id";
        PublicCount::model()->getDbConnection()->createCommand($sql)->bindValues(array(':app_id'=>$app_id,':res_id'=>$res_id))->execute();
    }
    
}

