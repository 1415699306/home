<?php
class MeetController extends BController{
    
    public function actions() 
    {
        return array(
            'captcha'=>array(
				'class'=>'CCaptchaAction',
                    'backColor'=>0x2040A0, 
                    'foreColor'=>0xFFFFFF,
                    'minLength'=>4, 
                    'maxLength'=>6, 
                    'height'=>40,
                    'width'=>80,
                    'padding'=>3,
                    'transparent'=>false, 
			),
            'advertising'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'index',
                'app_id'=>BaseApp::MEET,
                'category'=>9,
            ),
            'advcreate'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'create',
                'app_id'=>BaseApp::MEET,
                'category'=>9,
            ),
            'advertisingupdate'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'update',
                'app_id'=>BaseApp::MEET,
                'category'=>9,
            ),
            'advertisingdelete'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'delete',
                'app_id'=>BaseApp::MEET,
                'category'=>9,
            ),
            'advertisingview'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'view',
                'app_id'=>BaseApp::MEET,
                'category'=>9,
            ),
            
            'slide'=>array(
                'class'=>'SlideActions',
                'method'=>'index',
                'app_id'=>BaseApp::MEET,
                 'category'=>13,
            ),
            'slidecreate'=>array(
                'class'=>'SlideActions',
                'method'=>'create',
                'app_id'=>BaseApp::MEET,
                'category'=>13,
            ),
            'slideupdate'=>array(
                'class'=>'SlideActions',
                'method'=>'update',
                'app_id'=>BaseApp::MEET,
                 'category'=>13,
            ),
            'slidedelete'=>array(
                'class'=>'SlideActions',
                'method'=>'delete',
                'app_id'=>BaseApp::MEET,
                 'category'=>13,
            ),
            'slideview'=>array(
                'class'=>'SlideActions',
                'method'=>'view',
                'app_id'=>BaseApp::MEET,
                 'category'=>13,
            ),
        );
    }
    
  
    public function actionIndex()
    {
        $model = new Meet('search');
        $model->unsetAttributes();
        if(isset($_GET['Meet']))
            $model->attributes = $_GET['Meet'];
        $this->render('index',array(
                'model'=>$model
            ));
    }
    
  
    public function actionCreate()
    {
        $topbar = $this->_getTopBarImage();
        $model = new Meet();
        $model->recommand  = $model->channel_recommand = $model->index_recommand = $model->mode = 0;
        $model->meetContent = new MeetContent();
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = 4;
        $category = $component->getParent();
        if(isset($_POST['Meet'],$_POST['MeetContent']))
        {                              
            $model->attributes = $_POST['Meet'];
            $model->meetContent->attributes = $_POST['MeetContent'];
            if($model->validate() &&  $model->meetContent->validate() && $model->save(false))
            {  
                if($_POST['Meet']['off_time']<$_POST['Meet']['trailer_time']){
                    $model->mode = 2;
                 }elseif ($_POST['Meet']['start_time']<$_POST['Meet']['trailer_time'] && $_POST['Meet']['off_time']>$_POST['Meet']['trailer_time']) {
                    $model->mode = 1;
                }elseif($_POST['Meet']['start_time']>$_POST['Meet']['trailer_time']){
                    $model->mode = 0;
                }
                $_POST['MeetContent']['meet_id'] = $model->id;
                $model->meetContent->attributes = $_POST['MeetContent'];
                if($model->meetContent->save())
                {
                     Tags::saveByTags($model->tags, BaseApp::MEET, $model->id);
                    if(isset($_POST['Meet']['thumb']))
                    {                                             
                        Storage::saveByStorage(BaseApp::MEET, $model->id ,$_POST['Meet']['thumb'],Storage::getFileExt($_POST['Meet']['thumb']));  
                    }
                    $this->redirect($this->createUrl('/meet/view',array('id'=>$model->id)));
                }
                else
                {
                    Meet::model()->findByPk($model->id)->delete();
                    Helper::showMsg('系统消息','添加失败!','/meet/index');
                }
            }
        }
        $this->render('create',array(
            'model'=>$model,
            'topbar'=>$topbar,
            'category'=>$category,
        ));
    }
    
    
    
    private function _getTopBarImage()
    {
        $path = RESOURCE_PATH.DIRECTORY_SEPARATOR.'meet'.DIRECTORY_SEPARATOR.'topbar';
        $return = $resault = array();
        $handle = opendir($path);
        if ($handle)
        {
            while (false !== ($file = readdir($handle))) 
            {
                if ($file != "."&&$file != "..")
                {
                    $return[] = $file;
                }
            }
            closedir($handle);
            foreach($return as $res)
            {
                $resPath = HOME_URL.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'meet'.DIRECTORY_SEPARATOR.'topbar'.DIRECTORY_SEPARATOR.$res; 
                $file = $path.DIRECTORY_SEPARATOR.$res;
                if(is_file($file))
                {
                    $resault[] = $resPath;
                }
            }
        }
        return $resault;
    }
    
   
    public function actionView($id)
    {
        $model = Meet::model()->with(array('eminentRelations','eminentRelations.eminentPerson'))->findByPk($id);
        $this->render('view',array(
            'model'=>$model,
         ));
    }
    
   
    public function actionUpdate($id)
    {
        $model = Meet::model()->findByPk($id);  
        $topbar = $this->_getTopBarImage();
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = 4;
        $category = $component->getParent();
        if(isset($_POST['Meet'],$_POST['MeetContent']))
        {
             $old = $model->meetContent->content;
             $thumb = !empty($model->thumbs->track_id) ? true : false;
             $model->attributes = $_POST['Meet'];
             $model->meetContent->attributes = $_POST['MeetContent'];
             if($model->validate() && $model->meetContent->validate())
             {
                 if($_POST['Meet']['off_time']<$_POST['Meet']['trailer_time']){
                    $model->mode = 2;
                 }elseif ($_POST['Meet']['start_time']<$_POST['Meet']['trailer_time'] && $_POST['Meet']['off_time']>$_POST['Meet']['trailer_time']) {
                    $model->mode = 1;
                }elseif($_POST['Meet']['start_time']>$_POST['Meet']['trailer_time']){
                    $model->mode = 0;
                }
                ResourcesHelper::updateContentFile($model->meetContent->content, $old); 
                if($model->save() && $model->meetContent->save())
                {
                    Tags::updateByTags($model->tags, BaseApp::MEET, $model->id);
                    if(isset($_POST['Meet']['thumb']))
                    {
                        if($thumb)
                        {
                            Storage::deleteImageBySize('meet', $model->thumbs->track_id);
                        }
                        Storage::saveByStorage(BaseApp::MEET, $model->id ,$_POST['Meet']['thumb'],Storage::getFileExt($_POST['Meet']['thumb']));              
                    }
                    $this->redirect($this->createUrl('/meet/view',array('id'=>$model->id)));
                }
             }
        }
        $this->render('update',array(
            'model'=>$model,
            'topbar'=>$topbar,
            'category'=>$category,
        ));
    }
    
    
    public function actionDelete($id)
    {
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(403,'非法访问!');
        $model = Meet::model()->findByPk($id);
        if(!empty($model))
        {
            if($model->delete())
                Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>1)));
        }
        else
            throw new CHttpException(404,'数据不存在!');
    }
    
    
    public function actionEminent()
    {
        $model = new EminentPerson('search');
         $model->unsetAttributes();  
        if(isset($_GET['EminentPerson']))
            $model->attributes=$_GET['EminentPerson'];
        $this->render('eminent',array(
            'model'=>$model,
        ));
    }
    
    
    public function actionEminentDelete($id)
    {
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(403,'非法访问!');             
        $count = EminentRelation::model()->countByAttributes(array('eminent_id'=>$id));
        if(0 < $count)
            throw new CHttpException(403,'数据被调用中,不能删除!');
        $model = EminentPerson::model()->findByPk($id);
        if(!empty($model)){
            if($model->delete())
                Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1')));
        }
        else
            throw new CHttpException(404,'数据不存在!');
            
    }
    
   
    public function actionEminentCreate()
    {
        $model = new EminentPerson('create');
        if(isset($_POST['EminentPerson'])){
            $model->attributes = $_POST['EminentPerson'];
            $model->avatar=CUploadedFile::getInstance($model,'avatar');
            if($model->save())
            {
                if(!empty($model->avatar->tempName))
                {
                   
                        $file = Yii::createComponent('FileComponent');
                        $file->route = 'eminent';
                        $file->temp_name = $model->avatar->tempName;
                        $file->file_name = $model->avatar->name;
                        $file->extName  = $model->avatar->extensionName;
                        $res = $file->upload('thumb');
                        if(!empty($res)){
                            Storage::saveByStorage(BaseApp::EMINENTPERSON, $model->id ,$res['file_path'],$res['file_name'],$model->avatar->extensionName);
                        }
                    
                }
                $this->redirect($this->createUrl('/meet/eminent',array('id'=>$model->id)));
            }           
        }
        $this->render('eminentcreate',array(
            'model'=>$model,
        ));
    }
    
    
    public function actionEminentUpdate($id)
    {
        $model = EminentPerson::model()->findByPk($id);
        if(isset($_POST['EminentPerson']))
        {
            $model->attributes = $_POST['EminentPerson'];
            $model->avatar=CUploadedFile::getInstance($model,'avatar');
            if($model->save())
            {
                if(!empty($model->avatar->tempName))
                {
                    if(!empty($model->avatarImage->track_id))
                        Storage::deleteByFile(BaseApp::EMINENTPERSON,$model->id,$model->avatarImage->track_id);
                    $file = Yii::createComponent('FileComponent');
                    $file->route = 'eminent';
                    $file->temp_name = $model->avatar->tempName;
                    $file->file_name = $model->avatar->name;
                    $file->extName  = $model->avatar->extensionName;
                    $res = $file->upload('thumb');
                    if(!empty($res)){
                        Storage::saveByStorage(BaseApp::EMINENTPERSON, $model->id ,$res['file_path'],$res['file_name'],$model->avatar->extensionName);
                    }
                }
                $this->redirect($this->createUrl('/meet/eminent',array('id'=>$model->id)));
            }           
        }
        $this->render('eminentupdate',array(
            'model'=>$model,
        ));
    }
    
    
    public function actionSign()
    {
        $model = new MeetSign('serach');
        $model->unsetAttributes();
        if(isset($_GET['MeetSign']))
           $model->attributes = $_GET['MeetSign'];
        $this->render('sign',array(
            'model'=>$model,
        ));
    }
    
 
    public function actionSignView($id)
    {
        $model = MeetSign::model()->findByPk($id);
        if($model === null) throw new CHttpException(404,'信息不存在!');
            $this->render('signview',
            array(
                'model'=>$model,
            ));
    }
    
   
    public function actionSignDelete($id)
    {
        $model = MeetSign::model()->findByPk($id);
        if($model === null) throw new CHttpException(404,'信息不存在!');
        $model->delete();
    }
    
   
    public function actionSignUpdate($id)
    {
        $model = MeetSign::model()->findByPk($id);
        if($model === null) throw new CHttpException(404,'信息不存在!');
        if(isset($_POST['MeetSign']))
        {
            $model->attributes = $_POST['MeetSign'];
            if($model->save())
                $this->redirect($this->createUrl('/meet/signview',array('id'=>$model->id)));               
        }
        $this->render('signupdate',array(
            'sign'=>$model,
        ));
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
    
   
    public function actionEmail()
    {
        $model = new Email('');
        $model->unsetAttributes();  
        if(isset($_GET['Email']))
            $model->attributes=$_GET['Email'];
        $this->render('email',array(
            'model'=>$model,
        ));
    }
    
   
    public function actionEmailUpdate($id)
    {
        
        $model = Email::model()->findByPk($id);
        if(isset($_POST['Email']))
        {
            $message = "{$_POST['Email']['content']}";
            $mailer = Yii::createComponent("application.extensions.mailer.EMailer");
            $mailer->Host = "smtp.qq.com";
            $mailer->IsSMTP();
            $mailer->SMTPAuth = true;
            $mailer->From = "940954280@qq.com";        
            $mailer->AddReplyTo("{$_POST['Email']['email']}");
            $mailer->AddAddress("{$_POST['Email']['email']}"); 
            $mailer->FromName = "测试";   
            $mailer->Username = "940954280@qq.com";    
            $mailer->Password = "lhhwoaiwojia*";    
            $mailer->SMTPDebug = true;   
            $mailer->CharSet = 'UTF-8';
            $mailer->ContentType = 'text/html';
            $mailer->Subject = Yii::t("demo", "Yii rulez!");
            $mailer->Body = $message;
            $model->attributes = $_POST['Email'];
             if($model->validate())
             {
               
                if($model->save())
                {
                    $mailer->Send();
                    $this->redirect($this->createUrl('/meet/email'));
                }
             }
        }
        $this->render('emailupdate',array(
            'model'=>$model,
        ));
    }
    
    
    public function actionEmailDelete($id)
    {
        $this->emailModel($id)->delete();
        if(Yii::app()->request->isAjaxRequest)
            Yii::app ()->end(CJSON::encode(array('success'=>true)));
        else
            Helper::showMsg('系统消息','邮箱删除成功!',DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'email');
    }
    
    public function emailModel($id)
    {
        $model = Email::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'页面不存在!');
        else
            return $model;
    }
    
    
}
