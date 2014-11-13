<?php

/*
 * 首页资讯
 */
class MationController extends BController
{
   
    public function actionIndex()
    {
        $model=new Mation('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Mation']))
            $model->attributes=$_GET['Mation'];
        $this->render('index',array(
            'model'=>$model,
        ));
    }
    
    public function actionCreate()
    {   
         $newContent = null;
        /*实例化主表模型*/
        $model = new Mation(); 
        $model->recommand = 0;
        /*实例化附加表模型并附对象到主表的关联表属性*/
        $model->mationContent = new MationContent();
        /*载入分类组件*/
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = 104;//设置父亲ID
        $category = $component->getParent();//获取分类数组
        /*保存文章数据*/
        if(isset($_POST['Mation'],$_POST['MationContent']))
        {
            $model->attributes = $_POST['Mation'];
            if(!$model->validate())
            {              
                $newContent= $_POST['MationContent']['content'];
            }
            //print_r($_POST['Mation']);exit;
            if($model->save())
            {
                $_POST['MationContent']['mation_id'] = $model->id;
                $model->mationContent->attributes = $_POST['MationContent'];
                if($model->mationContent->save())
                {   
                    /*如果有附件就上传到storage*/
                    if(!empty($_POST['Mation']['thumb']))
                    {                                             
                         Storage::saveByStorage(BaseApp::MATION,$model->id,$_POST['Mation']['thumb'],Storage::getFileExt($_POST['Mation']['thumb']));
                        
                    }  
                    $this->redirect($this->createUrl('/mation/view',array('id'=>$model->id)));
                }
                else
                {
                    /*如果附加表验证保存失败,删除主表记录*/
                    Mation::model()->findByPk($model->id)->delete();
                    Helper::showMsg('系统消息','文章添加失败!',DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.'mation');
                }         
            }
        }
        $this->render('create',array(
            'model'=>$model,
            'category'=>$category,
            'newContent'=>$newContent,
        ));
    }
    
    
    
    public function actionUpdate($id)
    {
        $newContent = null;
        $model = $this->loadModel($id); 
        $content = MationContent::model()->find("LOWER(mation_id)=?",array($id));
        $model->mationContent = $content;
        $component = Yii::createComponent('CategoryComponent');
        $component->id = 104;
        if(isset($_POST['Mation'],$_POST['MationContent']))
        {
            $old = $content->content;
            $thumb = !empty($model->thumbs->track_id) ? true : false;
            $model->attributes = $_POST['Mation'];
            $content->attributes = $_POST['MationContent'];
            if($model->validate() && $content->validate())
            {
                /*处理文章被删除的图片*/
                ResourcesHelper::updateContentFile($content->content, $old); 
                if($model->save() && $content->save())
                {
                    /*更新标签*/
                    Tags::updateByTags($model->tags, BaseApp::MATION, $model->id);   
                    if(isset($_POST['Mation']['thumb']))
                    {
                        if($thumb)
                        {
                            /*处理旧缩略图*/
                            Storage::deleteImageBySize('mation', $model->thumbs->track_id);
                        }
                         /*如果有附件就上传到storage*/                                          
                        Storage::saveByStorage(BaseApp::MATION, $model->id ,$_POST['Mation']['thumb'],Storage::getFileExt($_POST['Mation']['thumb']));  
                        Storage::cutThumbsOnly($_POST,'mation','thumb');
                    }
                   $this->redirect($this->createUrl('/mation/view',array('id'=>$model->id)));
                }
            }
            else
                $newContent= $_POST['MationContent']['content'];
        }
        $this->render('update',array(
            'model'=>$model,
            'category'=>$component->getParent(),
            'newContent'=>$newContent,
        ));
    }
    
    /**
     * 查看新闻
     */
     public function actionView($id)
    {
        $model = $this->loadModel($id);
        $this->render('view',array(
            'model'=>$model,
        ));
    }
    
    
    /**
     * 删除新闻
     */
     public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        if(Yii::app()->request->isAjaxRequest)
            Yii::app ()->end(CJSON::encode(array('success'=>true)));
        else
            Helper::showMsg('系统消息','文章删除成功!',DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'mation');
    }
    
    
    
    /**
     * 读取新闻模型对象
     * 
     * @param PRIMARY $id
     * @throws CHttpException
     * @return $object
     */
    public function loadModel($id)
    {
        $model = Mation::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'页面不存在!');
        else
            return $model;
    }
    
}

