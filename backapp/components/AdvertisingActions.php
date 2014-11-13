<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdvertisingManger
 *
 * @author martin
 */
class AdvertisingActions extends CAction{
    
    public $method = 'index';
    public $app_id;
    public $view;
    public $category;
    
    public function index()
    {
        $model = new Advertising('search');
        $model->unsetAttributes();
        if(isset($_GET['Advertising']))
            $model->attributes = $_GET['Advertising'];
        $this->controller->render($this->view.DIRECTORY_SEPARATOR.'index',array(
            'model'=>$model,
        ));
    }
    
    public function create()
    {
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = $this->category;//设置父亲ID
        $category = $component->getParent();//获取分类数组
        $model = new Advertising();
        $model->type = $model->status = 0;
        if(isset($_POST['Advertising']))
        {
            $_POST['Advertising']['app_id'] = $this->app_id;
            $model->attributes = $_POST['Advertising'];
            if($model->save())
            {              
                /*如果有附件就上传到storage*/
                if(isset($_POST['Advertising']['thumb']))
                {                                             
                    Storage::saveByStorage(BaseApp::ADVERTISING, $model->id ,$_POST['Advertising']['thumb'],Storage::getFileExt($_POST['Advertising']['thumb']));  
                    //Storage::cutThumbsOnly($_POST,'advertising','thumb');
                    Storage::cutThumbByOne($_POST['Advertising']['thumb'],'advertising',64,38);
                }
                $this->controller->redirect(Yii::app()->createUrl($this->controller->id.'/advertisingview',array('id'=>$model->id)));               
            }
        }
        $this->controller->render($this->view.DIRECTORY_SEPARATOR.'create',array(
            'model'=>$model,
            'category'=>$category,
        ));
    }
    
    public function update()
    {
        $id = (int)Yii::app()->request->getParam('id');
        $model = $this->loadModel($id);
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = $this->category;//设置父亲ID
        $category = $component->getParent();//获取分类数组
        if(isset($_POST['Advertising']))
        {          
            $thumb = !empty($model->thumbs->track_id) ? true : false;
            $model->attributes = $_POST['Advertising']; 
            if($model->save())
            {                                           
                /*如果有附件就上传到storage*/
                if(isset($_POST['Advertising']['thumb']))
                {
                    if($thumb)
                    {
                        /*处理旧缩略图*/
                        Storage::deleteImageBySize('article', $model->thumbs->track_id);
                    }
                     /*如果有附件就上传到storage*/                                          
                    Storage::saveByStorage(BaseApp::ADVERTISING, $model->id ,$_POST['Advertising']['thumb'],Storage::getFileExt($_POST['Advertising']['thumb']));  
                    //Storage::cutThumbsOnly($_POST,'advertising','thumb');
                    Storage::cutThumbByOne($_POST['Advertising']['thumb'],'advertising',64,38);
                }
                $this->controller->redirect(Yii::app()->createUrl($this->controller->id.'/advertisingview',array('id'=>$model->id)));
            }                      
        }
        
        $this->controller->render($this->view.DIRECTORY_SEPARATOR.'update',array(
            'model'=>$model,
            'category'=>$category,
        ));
    }
    
    public function view()
    {
        $id = (int)Yii::app()->request->getParam('id');
        $model = $this->loadModel($id);
        $this->controller->render($this->view.DIRECTORY_SEPARATOR.'view',array(
            'model'=>$model,
        ));
    }
    
    public function delete()
    {
        if(!Yii::app()->request->isAjaxRequest)
            throw new CHttpException(403,'非法访问!');       
        $id = (int)Yii::app()->request->getParam('id');
        $model = $this->loadModel($id);
        if($model->delete())
            Yii::app ()->end (array('success'=>true,'code'=>'1','msg'=>'删除成功'));
        else
            Yii::app ()->end (array('success'=>true,'code'=>'-1','msg'=>'删除失败'));
    }
    
    protected function loadModel($id)
    {
        $model = Advertising::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'信息不存在!');
        else
            return $model;
    }

    public function run()
    {
        if($this->app_id === null)
            throw new CHttpException(403,'app_id未定义!');
        if($this->category === null)
            throw new CHttpException(403,'category未定义!');
        $this->view = THEME_PATH.DIRECTORY_SEPARATOR.'backend'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'advertising';
        if(method_exists($this, $this->method))
            $this->{$this->method}();
        else
            throw new CHttpException(403,'控制器不存在!');
    }
}