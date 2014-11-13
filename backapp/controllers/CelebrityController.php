<?php


class CelebrityController extends BController
{
    public function actions() 
    {
        return array(
            'advertising'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'index',
                'app_id'=>BaseApp::CELEBRITY,
                'category'=>52,
            ),
            'advcreate'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'create',
                'app_id'=>BaseApp::CELEBRITY,
                'category'=>52,
            ),
            'advertisingupdate'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'update',
                'app_id'=>BaseApp::CELEBRITY,
                'category'=>52,
            ),
            'advertisingdelete'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'delete',
                'app_id'=>BaseApp::CELEBRITY,
                'category'=>52,
            ),
            'advertisingview'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'view',
                'app_id'=>BaseApp::CELEBRITY,
                'category'=>52,
            ),
            
            'slide'=>array(
                'class'=>'SlideActions',
                'method'=>'index',
                'app_id'=>BaseApp::CELEBRITY,
                 'category'=>53,
            ),
            'slidecreate'=>array(
                'class'=>'SlideActions',
                'method'=>'create',
                'app_id'=>BaseApp::CELEBRITY,
                'category'=>53,
            ),
            'slideupdate'=>array(
                'class'=>'SlideActions',
                'method'=>'update',
                'app_id'=>BaseApp::CELEBRITY,
                 'category'=>53,
            ),
            'slidedelete'=>array(
                'class'=>'SlideActions',
                'method'=>'delete',
                'app_id'=>BaseApp::CELEBRITY,
                 'category'=>53,
            ),
            'slideview'=>array(
                'class'=>'SlideActions',
                'method'=>'view',
                'app_id'=>BaseApp::CELEBRITY,
                 'category'=>53,
            ),
        );
    }

    public function actionIndex()
    {
        $model=new Celebrity('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Celebrity']))
            $model->attributes=$_GET['Celebrity'];
        $this->render('index',array(
            'model'=>$model,
        ));
    }
    

  
    public function actionCreate()
    {
        $model = new Celebrity();  
        $model->recommand = $model->channel_recommand = $model->interview_recommand =$model->index_recommand= 0;
       
        $model->celebrityContent = new CelebrityContent();
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = 32;
        $category = $component->getParent();
        if(isset($_POST['Celebrity'],$_POST['CelebrityContent']))
        {
            
            $model->attributes = $_POST['Celebrity'];
            $model->celebrityContent->attributes = $_POST['CelebrityContent'];
            if($model->validate() && $model->celebrityContent->validate() && $model->save(false))
            {
                $_POST['CelebrityContent']['celebrity_id'] = $model->id;
                $model->celebrityContent->attributes = $_POST['CelebrityContent'];
                if($model->celebrityContent->save())
                {
                    Tags::saveByTags($model->tags, BaseApp::CELEBRITY, $model->id);   
                    if(isset($_POST['Celebrity']['thumb']))
                    {                                             
                        Storage::saveByStorage(BaseApp::CELEBRITY, $model->id ,$_POST['Celebrity']['thumb'],Storage::getFileExt($_POST['Celebrity']['thumb']));  
                        Storage::cutThumbsOnly($_POST,'celebrity','thumb');
                    }
                    $this->redirect($this->createUrl('/celebrity/view',array('id'=>$model->id)));
                }
                else
                {
                    Celebrity::model()->findByPk($model->id)->delete();
                    Helper::showMsg('系统消息','文章添加失败!',DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'celebrity');
                }         
            }
        }
        $this->render('create',array(
            'model'=>$model,
            'category'=>$category,
        ));
    }
    
    
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        if(Yii::app()->user->id != $model->user_id && Yii::app()->user->id != 1 && Yii::app()->user->id != 4)throw new CHttpException(403,'非法访问');
        $component = Yii::createComponent('CategoryComponent');
        $component->id = 32;
        if(isset($_POST['Celebrity'],$_POST['CelebrityContent']))
        {
            $old = $model->celebrityContent->content;
            $thumb = !empty($model->thumbs->track_id) ? true : false;
            $model->attributes = $_POST['Celebrity'];
            $model->celebrityContent->attributes = $_POST['CelebrityContent'];
            if($model->validate() && $model->celebrityContent->validate())
            {
                ResourcesHelper::updateContentFile($model->celebrityContent->content, $old);    
                if($model->save() && $model->celebrityContent->save(false))
                {
                    Tags::updateByTags($model->tags, BaseApp::CELEBRITY, $model->id);   
                    if(isset($_POST['Celebrity']['thumb']))
                    {
                        if($thumb)
                        {
                           Storage::deleteImageBySize('celebrity', $model->thumbs->track_id);
                        }
                        Storage::saveByStorage(BaseApp::CELEBRITY, $model->id ,$_POST['Celebrity']['thumb'],Storage::getFileExt($_POST['Celebrity']['thumb']));  
                        Storage::cutThumbsOnly($_POST,'celebrity','thumb'); 
                    }
                   $this->redirect($this->createUrl('/celebrity/view',array('id'=>$model->id)));
                }
            }
        }
        $this->render('update',array(
            'model'=>$model,
            'category'=>$component->getParent(),
        ));
    }
    
    
    public function actionView($id)
    {
		$model = $this->loadModel($id);
        if(Yii::app()->user->id != $model->user_id && Yii::app()->user->id != 1 && Yii::app()->user->id != 4)throw new CHttpException(403,'非法访问');   
        $this->render('view',array(
            'model'=>$model,
        ));
    }
    
    
    public function actionDelete($id)
    {
		$model = $this->loadModel($id);
        if(Yii::app()->user->id != $model->user_id && Yii::app()->user->id != 1 && Yii::app()->user->id != 4)throw new CHttpException(403,'非法访问');
        $model->delete();
        if(Yii::app()->request->isAjaxRequest)
            Yii::app ()->end(CJSON::encode(array('success'=>true)));
        else
            Helper::showMsg('系统消息','文章删除成功!',DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'article');
    }
    
    
    public function loadModel($id)
    {
        $model = Celebrity::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'页面不存在!');
        else
            return $model;
    }
    
    
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
