<?php
/*
 * 首页资讯
 */
class NewsController extends BController
{
    public function actionIndex()
    {
        $model=new News('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['News']))
            $model->attributes=$_GET['News'];
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
        $model = new News();
        $model->aip = 1;
        $model->recommend = 0;
        if(isset($_POST['News']))
        {
            $model->attributes = $_POST['News'];
            $title = $model->title;
            if($model->aip == '7'){
                $module = lcfirst(BaseApp::getModelName($model->aip));
                $sql = "select id,title,category_id from `$module` where title='$title'";
                $tid = Yii::app()->db->createCommand($sql)->queryAll(); 
                if(empty($tid)) throw new CHttpException(404,'信息不存在!'); 
                $cid = $tid['0']['category_id'];
                $tid=$tid['0']['id'];
                $model->res_id = $tid;
                $model->category_id = $cid;
              $model->link = '/life/list/view/'."$tid";
            }elseif($model->aip == '8'){
                $module = lcfirst(BaseApp::getModelName($model->aip));
                if($module == 'celebrityPainted'){
                    $module = 'celebrity_painted';
                }
                $sql = "select id,title,category_id,discription from `$module` where title='$title'";
                $tid = Yii::app()->db->createCommand($sql)->queryAll(); 
                if(empty($tid)) throw new CHttpException(404,'信息不存在!'); 
                $cid = $tid['0']['category_id'];
                $model->discription=$tid['0']['discription'];
                $tid=$tid['0']['id'];
                $model->res_id = $tid;
                $model->category_id = $cid;
                $model->link = '/celebrity/list/view/'."$tid";
            }elseif($model->aip == '9'){
                $module = lcfirst(BaseApp::getModelName($model->aip));
                $sql = "select id,title,category_id,discription,professor from `$module` where title='$title'";
                $tid = Yii::app()->db->createCommand($sql)->queryAll();
                if(empty($tid)) throw new CHttpException(404,'信息不存在!'); 
                $cid = $tid['0']['category_id'];
                $model->discription = $tid['0']['discription'];
                $model->professor = $tid['0']['professor'];
                $tid=$tid['0']['id'];
                $model->res_id = $tid;
                $model->category_id = $cid;
                $model->link = '/study/list/view/'."$tid";
            }elseif($model->aip == '1'){
                $module = lcfirst(BaseApp::getModelName($model->aip));
                $sql = "select id,name,category_id,discription,unit,maney,contacts,address from `$module` where name='$title'";
                $tid = Yii::app()->db->createCommand($sql)->queryAll();
                if(empty($tid)) throw new CHttpException(404,'信息不存在!'); 
                $cid = $tid['0']['category_id'];
                $model->discription = $tid['0']['discription'];$model->unit= $tid['0']['unit'];$model->maney= $tid['0']['maney'];
                $model->contacts = $tid['0']['contacts']; $model->address = $tid['0']['address'];
                $tid=$tid['0']['id'];
                $model->res_id = $tid;
                $model->category_id = $cid;
                $model->link = '/investment/default/'."$tid";
            }
            if($model->save())
            { 
                if(!empty($_POST['News']['thumb']))
                {                                             
                     Storage::saveByStorage(BaseApp::NEWS,$model->id,$_POST['News']['thumb'],Storage::getFileExt($_POST['News']['thumb']));

                }  
                $this->redirect($this->createUrl('/news/view',array('id'=>$model->id)));
            }else{
                    Helper::showMsg('系统消息','信息添加失败!',DIRECTORY_SEPARATOR.'./'.'news');
            }  
               
        }
        $this->render('create',array(
            'model'=>$model,
        ));
    }
    
    
    /**
     * 更新信息
     */
    public function actionUpdate($id)
    {
       
        $model = $this->loadModel($id);        
        if(isset($_POST['News']))
        {
            $thumb = !empty($model->thumbs->track_id) ? true : false;
            $model->attributes = $_POST['News'];
            $title = $model->title; 
            if($model->aip == '7'){
                $module = lcfirst(BaseApp::getModelName($model->aip));
                $sql = "select id,title,category_id from `$module` where title='$title'";
                $tid = Yii::app()->db->createCommand($sql)->queryAll();
                if(empty($tid)) throw new CHttpException(404,'信息不存在!'); 
                $cid = $tid['0']['category_id'];
                $tid=$tid['0']['id'];
                $model->res_id = $tid;
                $model->category_id = $cid;
              $model->link = '/life/list/view/'."$tid";
            }elseif($model->aip == '8'){
                $module = lcfirst(BaseApp::getModelName($model->aip));
                if($module == 'celebrityPainted'){
                    $module = 'celebrity_painted';
                }
                $sql = "select id,title,category_id,discription from `$module` where title='$title'";
                $tid = Yii::app()->db->createCommand($sql)->queryAll();
                if(empty($tid)) throw new CHttpException(404,'信息不存在!'); 
                $cid = $tid['0']['category_id'];
                $model->discription=$tid['0']['discription'];
                $tid=$tid['0']['id'];
                $model->res_id = $tid;
                $model->category_id = $cid;
                $model->link = '/celebrity/list/view/'."$tid";
            }elseif($model->aip == '9'){
                $module = lcfirst(BaseApp::getModelName($model->aip));
                $sql = "select id,title,category_id,discription,professor from `$module` where title='$title'";
                $tid = Yii::app()->db->createCommand($sql)->queryAll();
                if(empty($tid)) throw new CHttpException(404,'信息不存在!'); 
                $cid = $tid['0']['category_id'];
                $model->discription = $tid['0']['discription'];
                $model->professor = $tid['0']['professor'];
                $tid=$tid['0']['id'];
                $model->res_id = $tid;
                $model->category_id = $cid;
                $model->link = '/study/list/view/'."$tid";
            }elseif($model->aip == '1'){
                $module = lcfirst(BaseApp::getModelName($model->aip));
                $sql = "select id,name,category_id,discription,unit,maney,contacts,address from `$module` where name='$title'";
                $tid = Yii::app()->db->createCommand($sql)->queryAll(); 
                if(empty($tid)) throw new CHttpException(404,'信息不存在!'); 
                $cid = $tid['0']['category_id'];
                $model->discription = $tid['0']['discription'];$model->unit= $tid['0']['unit'];$model->maney= $tid['0']['maney'];
                $model->contacts = $tid['0']['contacts']; $model->address = $tid['0']['address'];
                $tid=$tid['0']['id'];
                $model->res_id = $tid;
                $model->category_id = $cid;
                $model->link = '/investment/default/'."$tid";
            }
            if($model->validate())
            {
                if($model->save())
                {  
                    if(isset($_POST['News']['thumb']))
                    {
                        if($thumb)
                        {
                            /*处理旧缩略图*/
                            Storage::deleteImageBySize('news', $model->thumbs->track_id);
                        }
                         /*如果有附件就上传到storage*/                                          
                        Storage::saveByStorage(BaseApp::NEWS,$model->id,$_POST['News']['thumb'],Storage::getFileExt($_POST['News']['thumb']));
                        
                    }
                    $this->redirect($this->createUrl('/news/view',array('id'=>$model->id)));
                }
            }
            else
                 Helper::showMsg('系统消息','信息更新失败!',DIRECTORY_SEPARATOR.'./'.'news');
        }
        $this->render('update',array(
            'model'=>$model,
        ));
    }
    
    /**
     * 查看信息
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
     * 删除信息
     * 
     * @param PRIMARY $id
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        if(Yii::app()->request->isAjaxRequest)
            Yii::app ()->end(CJSON::encode(array('success'=>true)));
        else
            Helper::showMsg('系统消息','文章删除成功!',DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'news');
    }
    
    /**
     * 读取信息模型对象
     * 
     * @param PRIMARY $id
     * @throws CHttpException
     * @return $object
     */
    public function loadModel($id)
    {
        $model = News::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'页面不存在!');
        else
            return $model;
    }
    
}

