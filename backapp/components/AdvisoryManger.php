<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdvisoryManger
 * 应用留言管理器
 * 
 * @author Administrator
 */
class AdvisoryManger extends CAction
{
    public $limit = 20;
    public $method;
    public $appId;
    public function run() 
    {
        if(!empty($this->method) && method_exists($this, $this->method))
            $this->{$this->method}();
        else
            throw new CHttpException(403,'AdvisoryManger CAction function is not!check set property!');
        
    }
    
    /**
     * 页面列表管理
     * 
     * this view is CGridView by widget
     */
    public function advisory()
    {
        $model=new Advisory('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Advisory']))
            $model->attributes=$_GET['Advisory'];
        $this->controller->render('advisory',array(
            'model'=>$model,
            ));
    }   
    
    /**
     * 删除留言
     * 
     * @param type $id
     * @throws CHttpException
     */
    public function deleteadvisory()
    {
        $id = (int)Yii::app()->request->getParam('id');
        if(!Yii::app()->request->isAjaxRequest)
            throw new CHttpException(403,'非法访问!');
        if($this->loadModel($id)->delete())
            Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1','msg'=>'删除成功!')));      
        else
            Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'-1','msg'=>'删除失败!')));  
    }
    
    /**
     * AR读取数据
     * 
     * @param type $id
     * @return type
     * @throws CHttpException
     */
    protected function loadModel($id)
    {
        if($this->appId === null)
            throw new CHttpException(403,'参数不在正确!');
       $model = Advisory::model()->findByAttributes(array('id'=>$id,'app_id'=>$this->appId));
       if($model === null)
            throw new CHttpException(404,'数据不存在');
       else
           return $model;
    }
}
