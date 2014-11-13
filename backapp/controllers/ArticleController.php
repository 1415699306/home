<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostController
 * 文章管理
 * @author Administrator
 */
class ArticleController extends BController{
    
    public function actions() 
    {
        return array(
            'advertising'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'index',
                'app_id'=>BaseApp::ARTICLE,
                'category'=>12,
            ),
            'advcreate'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'create',
                'app_id'=>BaseApp::ARTICLE,
                'category'=>12,
            ),
            'advertisingupdate'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'update',
                'app_id'=>BaseApp::ARTICLE,
                'category'=>12,
            ),
            'advertisingdelete'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'delete',
                'app_id'=>BaseApp::ARTICLE,
                'category'=>12,
            ),
            'advertisingview'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'view',
                'app_id'=>BaseApp::ARTICLE,
                'category'=>12,
            ),
            
            'slide'=>array(
                'class'=>'SlideActions',
                'method'=>'index',
                'app_id'=>BaseApp::ARTICLE,
                 'category'=>35,
            ),
            'slidecreate'=>array(
                'class'=>'SlideActions',
                'method'=>'create',
                'app_id'=>BaseApp::ARTICLE,
                'category'=>35,
            ),
            'slideupdate'=>array(
                'class'=>'SlideActions',
                'method'=>'update',
                'app_id'=>BaseApp::ARTICLE,
                 'category'=>35,
            ),
            'slidedelete'=>array(
                'class'=>'SlideActions',
                'method'=>'delete',
                'app_id'=>BaseApp::ARTICLE,
                 'category'=>35,
            ),
            'slideview'=>array(
                'class'=>'SlideActions',
                'method'=>'view',
                'app_id'=>BaseApp::ARTICLE,
                 'category'=>35,
            ),
        );
    }
    
    /**
     * 文章管理首页
     */
    public function actionIndex()
    {
        $model=new Article('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Article']))
            $model->attributes=$_GET['Article'];
        $this->render('index',array(
            'model'=>$model,
        ));
    }
    
    /**
     * 保存文章
     */
    public function actionCreate()
    {
        /*实例化主表模型*/
        $model = new Article();
        $model->recommend = 0;
        /*实例化附加表模型并附对象到主表的关联表属性*/
        $model->articleContent = new ArticleContent();
        /*载入分类组件*/
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = 1;//设置父亲ID
        $category = $component->getParent();//获取分类数组
        /*保存文章数据*/
        if(isset($_POST['Article'],$_POST['ArticleContent']))
        {
            $model->attributes = $_POST['Article'];
            $model->articleContent->attributes = $_POST['ArticleContent'];
            if($model->validate() && $model->articleContent->validate() && $model->save())
            {
                $_POST['ArticleContent']['article_id'] = $model->id;
                $model->articleContent->attributes = $_POST['ArticleContent'];
                if($model->articleContent->save())
                {
                    /*如果有附件就上传到storage*/
                     if(!empty($_POST['Article']['thumb']))
                    {                                             
                         Storage::saveByStorage(BaseApp::ARTICLE,$model->id,$_POST['Article']['thumb'],Storage::getFileExt($_POST['Article']['thumb']));
                        
                    }  
                    $this->redirect($this->createUrl('/article/view',array('id'=>$model->id)));
                }
                else
                {
                    /*如果附加表验证保存失败,删除主表记录*/
                    Article::model()->findByPk($model->id)->delete();
                    Helper::showMsg('系统消息','文章添加失败!',DIRECTORY_SEPARATOR.'./'.'article');
                }
            }
        }
        $this->render('create',array(
            'model'=>$model,
            'category'=>$category,
        ));
    }
    
    /**
     * 更新文章
     * 
     * @param PRIMARY $id
     */
    public function actionUpdate($id)
    {      
        $model = $this->loadModel($id);        
        $content = ArticleContent::model()->find("LOWER(article_id)=?",array($id));
        $component = Yii::createComponent('CategoryComponent');
        $component->id = 1;
        if(isset($_POST['Article'],$_POST['ArticleContent']))
        {
            $old = $model->articleContent->content;
            $thumb = !empty($model->thumbs->track_id) ? true : false;
            $model->attributes = $_POST['Article'];
            $model->articleContent->attributes = $_POST['ArticleContent'];
            if($model->validate() && $model->articleContent->validate())
            {
                /*处理文章被删除的图片*/
                ResourcesHelper::updateContentFile($model->articleContent->content, $old); 
                if($model->save() && $model->articleContent->save())
                {  
                    if(isset($_POST['Article']['thumb']))
                    {
                        if($thumb)
                        {
                            /*处理旧缩略图*/
                            Storage::deleteImageBySize('article', $model->thumbs->track_id);
                        }
                         /*如果有附件就上传到storage*/                                          
                        Storage::saveByStorage(BaseApp::ARTICLE,$model->id,$_POST['Article']['thumb'],Storage::getFileExt($_POST['Article']['thumb']));
                        
                    }
                    $this->redirect($this->createUrl('/article/view',array('id'=>$model->id)));
                }
            }
        }
        $this->render('update',array(
            'model'=>$model,
            'category'=>$component->getParent(),
        ));
    }
    
    /**
     * 查看文章
     * 
     * @param PRIMARY $id
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $this->render('view',array(
            'model'=>$model,
        ));
    }
    
    /**
     * 删除文章
     * 
     * @param PRIMARY $id
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        if(Yii::app()->request->isAjaxRequest)
            Yii::app ()->end(CJSON::encode(array('success'=>true)));
        else
            Helper::showMsg('系统消息','文章删除成功!',DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'article');
    }
    
    /**
     * 读取文章模型对象
     * 
     * @param PRIMARY $id
     * @throws CHttpException
     * @return $object
     */
    public function loadModel($id)
    {
        $model = Article::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'页面不存在!');
        else
            return $model;
    }
   
}
