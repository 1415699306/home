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
class SlideActions extends CAction{
    
    public $method = 'index';
    public $app_id;
    public $view;
    public $category;
    public function index()
    {
        $model = new Slide('search');
        $model->unsetAttributes();
        if(isset($_GET['Slide']))
            $model->attributes = $_GET['Slide'];
        $this->controller->render($this->view.DIRECTORY_SEPARATOR.'index',array(
            'model'=>$model,
        ));
    }
    
    public function create()
    {
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = $this->category;//设置父亲ID
        $category = $component->getParent();//获取分类数组
        $model = new Slide();
        $model->status = 0;
        if(isset($_POST['Slide']))
        {
            $_POST['Slide']['app_id'] = $this->app_id;
            $model->attributes = $_POST['Slide'];
            if($model->save())
            {    
                /*如果有附件就上传到storage*/
                if(isset($_POST['Slide']['thumb']))
                {                                             
                    Storage::saveByStorage(BaseApp::SLIDE, $model->id ,$_POST['Slide']['thumb'],Storage::getFileExt($_POST['Slide']['thumb']));  
                    //Storage::cutThumbsOnly($_POST,'slide','thumb');
                    Storage::cutThumbByOne($_POST['Slide']['thumb'],'slide',70,120);
                }
                Helper::showMsg ('系统消息','添加幻灯片成功!',Yii::app()->createUrl($this->controller->id.'/slide'));
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
        if(isset($_POST['Slide']))
        {            
            $thumb = !empty($model->thumbs->track_id) ? true : false;
            $model->attributes = $_POST['Slide'];            
            if($model->save())
            {                                           
                $model->refresh();
               /*如果有附件就上传到storage*/
                if(isset($_POST['Slide']['thumb']))
                {
                    if($thumb)
                    {
                        /*处理旧缩略图*/
                        Storage::deleteImageBySize('slide', $model->thumbs->track_id);
                    }
                     /*如果有附件就上传到storage*/                                          
                    Storage::saveByStorage(BaseApp::SLIDE, $model->id ,$_POST['Slide']['thumb'],Storage::getFileExt($_POST['Slide']['thumb']));  
                    //Storage::cutThumbsOnly($_POST,'slide','thumb');
                    if(preg_match('/(.*?)\.(\w+)$/iU',$_POST['Slide']['thumb'],$arr))
                    {
                        $route = RESOURCE_PATH.DIRECTORY_SEPARATOR.'slide'.DIRECTORY_SEPARATOR.'thumb';
                        if(is_file($route.DIRECTORY_SEPARATOR.$_POST['Slide']['thumb']))
                        {
                            $target = $route.DIRECTORY_SEPARATOR.$arr[1]."_16_9.".$arr[2];  
                            Storage::resize($route.DIRECTORY_SEPARATOR.$_POST['Slide']['thumb'],$target,70,120);
                        }
                    }

                }
                Helper::showMsg ('系统消息','更新广告成功!',Yii::app()->createUrl($this->controller->id.'/slide'));
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
        $model = Slide::model()->findByPk($id);
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
        $this->view = THEME_PATH.DIRECTORY_SEPARATOR.'backend'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'slide';
        if(method_exists($this, $this->method))
            $this->{$this->method}();
        else
            throw new CHttpException(403,'控制器不存在!');
    }
}