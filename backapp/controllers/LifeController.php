<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LifeController
 * 奢生活管理
 * @author martin
 */
class LifeController extends BController{
    
    public function actions() 
    {
        return array(
            'advertising'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'index',
                'app_id'=>BaseApp::LIFE,
                'category'=>30,
            ),
            'advcreate'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'create',
                'app_id'=>BaseApp::LIFE,
                'category'=>30,
            ),
            'advertisingupdate'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'update',
                'app_id'=>BaseApp::LIFE,
                'category'=>30,
            ),
            'advertisingdelete'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'delete',
                'app_id'=>BaseApp::LIFE,
                'category'=>30,
            ),
            'advertisingview'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'view',
                'app_id'=>BaseApp::LIFE,
                'category'=>30,
            ),
            
            'slide'=>array(
                'class'=>'SlideActions',
                'method'=>'index',
                'app_id'=>BaseApp::LIFE,
                 'category'=>35,
            ),
            'slidecreate'=>array(
                'class'=>'SlideActions',
                'method'=>'create',
                'app_id'=>BaseApp::LIFE,
                'category'=>35,
            ),
            'slideupdate'=>array(
                'class'=>'SlideActions',
                'method'=>'update',
                'app_id'=>BaseApp::LIFE,
                 'category'=>35,
            ),
            'slidedelete'=>array(
                'class'=>'SlideActions',
                'method'=>'delete',
                'app_id'=>BaseApp::LIFE,
                 'category'=>35,
            ),
            'slideview'=>array(
                'class'=>'SlideActions',
                'method'=>'view',
                'app_id'=>BaseApp::LIFE,
                 'category'=>35,
            ),
        );
    }
    /**
     * 奢生活管理首页
     */
    public function actionIndex()
    {
        $model=new Life('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Life']))
            $model->attributes=$_GET['Life'];
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
        $model = new Life(); 
        $model->recommand  = $model->channel_recommand =$model->index_recommand= 0;
        /*实例化附加表模型并附对象到主表的关联表属性*/
        $model->lifeContent = new LifeContent();
        /*载入分类组件*/
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = 27;//设置父亲ID
        $category = $component->getParent();//获取分类数组
        /*保存文章数据*/
        if(isset($_POST['Life'],$_POST['LifeContent']))
        {
            $model->attributes = $_POST['Life'];         
            $model->lifeContent->attributes = $_POST['LifeContent']; 
            if($model->validate() && $model->lifeContent->validate() && $model->save(false))
            {
                $_POST['LifeContent']['life_id'] = $model->id;
                $model->lifeContent->attributes = $_POST['LifeContent'];
                if($model->lifeContent->save())
                {
                    /*保存标签*/
                    Tags::saveByTags($model->tags, BaseApp::LIFE, $model->id);
                   /*如果有附件就上传到storage*/
                    if(isset($_POST['Life']['thumb']))
                    {            
                        Storage::saveByStorage(BaseApp::LIFE, $model->id ,$_POST['Life']['thumb'],Storage::getFileExt($_POST['Life']['thumb']));  
                        Storage::cutThumbsOnly($_POST,'life','thumb');
                        $path = RESOURCE_PATH.DIRECTORY_SEPARATOR.'life'.DIRECTORY_SEPARATOR.'thumb';
                        $target = $path.DIRECTORY_SEPARATOR.'life_'.$_POST['Life']['thumb'];
                        Storage::resize($path.DIRECTORY_SEPARATOR.$_POST['Life']['thumb'],$target,'190','320');
                    }
                    $this->redirect($this->createUrl('/life/view',array('id'=>$model->id)));
                }
                else
                {
                    /*如果附加表验证保存失败,删除主表记录*/
                    Life::model()->findByPk($model->id)->delete();
                    Helper::showMsg('系统消息','文章添加失败!',DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'life');
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
        if(Yii::app()->user->id != $model->user_id && Yii::app()->user->id != 1 && Yii::app()->user->id != 4) throw new CHttpException(403,'非法访问');
        $component = Yii::createComponent('CategoryComponent');
        $component->id = 27;
        if(isset($_POST['Life'],$_POST['LifeContent']))
        {
            $old = $model->lifeContent->content;
            $thumb = !empty($model->thumbs->track_id) ? true : false;
            $model->attributes = $_POST['Life'];
            $model->lifeContent->attributes = $_POST['LifeContent'];
            if($model->validate() && $model->lifeContent->validate())
            {
                /*处理文章被删除的图片*/
                ResourcesHelper::updateContentFile($model->lifeContent->content, $old);    
                if($model->save() && $model->lifeContent->save())
                {
                    /*更新标签*/
                    Tags::updateByTags($model->tags, BaseApp::LIFE, $model->id);
                    if(isset($_POST['Life']['thumb']))
                    {
                        if($thumb)
                        {
                            /*处理旧缩略图*/
                            Storage::deleteImageBySize('life', $model->thumbs->track_id);
                        }
                         /*如果有附件就上传到storage*/                                          
                        Storage::saveByStorage(BaseApp::LIFE, $model->id ,$_POST['Life']['thumb'],Storage::getFileExt($_POST['Life']['thumb']));  
                        Storage::cutThumbsOnly($_POST,'life','thumb');
                        $path = RESOURCE_PATH.DIRECTORY_SEPARATOR.'life'.DIRECTORY_SEPARATOR.'thumb';
                        $target = $path.DIRECTORY_SEPARATOR.'life_'.$_POST['Life']['thumb'];
                        Storage::resize($path.DIRECTORY_SEPARATOR.$_POST['Life']['thumb'],$target,'320','190');
                        
                    }
                   $this->redirect($this->createUrl('/life/view',array('id'=>$model->id)));
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
        if(Yii::app()->user->id != $model->user_id && Yii::app()->user->id != 1 && Yii::app()->user->id != 4)  throw new CHttpException(403,'非法访问');          
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
        $model = $this->loadModel($id);
        if(Yii::app()->user->id != $model->user_id && Yii::app()->user->id != 1 && Yii::app()->user->id != 4)throw new CHttpException(403,'非法访问');
        $model->delete();
        if(Yii::app()->request->isAjaxRequest)
            Yii::app ()->end(CJSON::encode(array('success'=>true)));
        else
            Helper::showMsg('系统消息','文章删除成功!',DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'life');
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
        $model = Life::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'页面不存在!');
        else
            return $model;
    }
    
    
    /**
     * 内容审核
     */
    public function actionAudit($id,$type)
    {
         if(!Yii::app()->request->isAjaxRequest)
            throw new CHttpException(403,'非法访问');
        $id = (int)$id;
        $type = (int)$type;
        $msg = $type == 0 ? '审核' : '黑名单';
        $model = $this->loadModel($id);
        $model->status = $type;
        if($model->save())
            Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1','msg'=>"用户{$msg}操作成功!")));
        else
            Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'0','msg'=>"用户{$msg}失败!")));   
    }
}