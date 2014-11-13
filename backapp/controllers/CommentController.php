<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentController
 *
 * @author martin
 */
class CommentController extends BController{
    
    public function actionIndex()
    {
        $model = new PublicComment('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['PublicComment']))
            $model->attributes=$_GET['PublicComment'];
        $this->render('index',array(
            'model'=>$model,
        ));
    }
    
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        if(Yii::app()->request->isAjaxRequest && $model->delete())
            Yii::app()->end(CJSON::encode(array('success'=>true)));
        else
            throw new CHttpException(403,'删除失败!');
            
    }
    
    public function actionAudit($id)
    {
        if(Yii::app()->request->isAjaxRequest && 0 < PublicComment::model()->updateByPk($id,array('status'=>'1')))
            Yii::app()->end(CJSON::encode(array('success'=>true)));
        else
            throw new CHttpException(403,'审核失败!');
    }
    
    protected function loadModel($id)
    {
        $model = PublicComment::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'信息不存在!');
        else
            return $model;
    }
}