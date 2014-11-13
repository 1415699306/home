<?php
use application\modules\usercenter\components\Controller;

class ProjectsController extends Controller{
    
    public function filters()
    {
        return array(
                'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
                array(
                'allow',
                'actions'=>array('index','create','pledges','deletepledges','update','submit','attention','support','delete','attention','support'),
                        'users'=>array('@'),
                ),
                array('deny',
                        'users'=>array('*'),
                ),
        );
    }
    
    public function actionIndex($cid = 0)
    {
        $uid = Yii::app()->user->id;
        $criteria = new CDbCriteria();
        $criteria->condition = 'user_id = :uid';
        $criteria->order = 'id desc';
        $criteria->params = array(':uid'=>$uid);
        $dreams = Dream::model()->findAll($criteria);
        $criteria->addCondition('app_id='.BaseApp::DREAM);
        $render = $supports = array();
        if(empty($supports)){
              $render = array('dreams'=>$dreams,'supports'=>$supports);
        }
      
        if(empty($dreams)){
            $discoverys = array('discoverys'=>$this->_loadRand($cid));
            $render = array_merge($discoverys,$render);
        }  
        $this->render('index',$render);
    }
    
    private function _loadRand($cid)
    {       
        $criteria = new CDbCriteria();
        $criteria->condition = 'status > 2';
        if(0 < $cid)
        {
            $criteria->addCondition('category_id=:cid');
        }
        $criteria->params = array(':cid'=>$cid);
        $criteria->limit = 3;
        $criteria->order = 'rand()';
        return  Dream::model()->findAll($criteria);
    }
    
    
   public function actionCreate()
   {
        $newContent = null;
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = 124;
        $category = $component->getParent();
        $model = new Dream('create');
        $model->title = '不超过32个字!';
        $model->discription = '不超过75个字!';
        $model->money = '不少于500元!';
        $model->day = '15-16天';
        //$model->video = '(可选)输入视频地址(支持优酷、土豆、酷六、新浪视频)';
        $model->dreamContent = new DreamContent();
        $model->dreamContent->content="<strong>关于我</strong><p>向支持者介绍一下你自己，以及你与所发起的项目之间的背景。这样有助于拉近你与支持者之间的距离。建议不超过100字。</p><br /><br /><strong>我想要做什么</strong><p>以视频、图文并茂的方式简洁生动地说明你的项目，让大家一目了然，这会决定是否将你的项目描述继续看下去。建议不超过300字。</p><br /><br /><strong>为什么需要你的支持</strong><p>这是加分项。说说你的项目不同寻常的特色、资金用途、以及大家支持你的理由。这会让更多人能够支持你，不超过200个汉字。</p><br /><br /><strong>我的承诺与回报</strong><p>让大家感到你对待项目的认真程度，鞭策你将项目执行最终成功。同时向大家展示一下你为支持者准备的回报，来吸引更多人支持你。</p><br /><br />";
        if(isset($_POST['Dream'],$_POST['DreamContent']))
        {   
            $model->attributes = $_POST['Dream'];
            $model->dreamContent->attributes = $_POST['DreamContent'];
            if($model->validate())
            {
                $uid = Yii::app()->user->id;
                $connection = Yii::app()->db;
                $transaction=$connection->beginTransaction();
                try
                {
                    $purifier = new CHtmlPurifier;
                    $params = $_POST['Dream'];
                    $content = $_POST['DreamContent'];
                    $cid = (int)$params['category_id'];
                    $title = $purifier->purify((string)$params['title']);
                    $province = (int)$params['province'];
                    $city = (int)$params['city'];
                    $discription = $purifier->purify((string)$params['discription']);
                    $video = (string)($params['video']== '(可选)输入视频地址(支持优酷、土豆、酷六、新浪视频)' ? null : $params['video']);
                    $money = (int)$params['money'];
                    $day = (string)$params['day'];
                    $dream="insert into `dream` set `user_id`=:uid,`category_id`=:cid,`title`=:title,`province`=:province,`city`=:city,`discription`=:discription,`video`=:video,`money`=:money,`day`=:day,`ctime`=:time,`mtime`=:time";
                    $connection->createCommand($dream)->bindValues(array(':uid'=>$uid,':cid'=>$cid,'title'=>$title,':province'=>$province,':city'=>$city,':discription'=>$discription,':video'=>$video,':money'=>$money,':day'=>$day,':time'=>time()))->execute();
                    $dream_id=$connection->getLastInsertID();
                    $contents = $purifier->purify($content['content']);
                    $connection->createCommand("insert into `dream_content` set `dream_id`=:dream_id,`content`=:content")->bindValues(array(':dream_id'=>(int)$dream_id,':content'=>$contents))->execute();
                    $transaction->commit();    
                    DreamLog::setLog($dream_id,0);
                    if(!empty($_POST['Dream']['thumb']))
                        Storage::saveByStorage(BaseApp::DREAM,$dream_id,$_POST['Dream']['thumb'],Storage::getFileExt($_POST['Dream']['thumb']));
                    $this->redirect($this->createUrl('/usercenter/projects/pledges',array('id'=>$dream_id)));
                }
                catch(Exception $e)
                {
                    Yii::log('ID:'.Yii::app()->user->id.'用户发布梦想秀失败:'.$e,'info','system.site.dream');
                    $transaction->rollBack();
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
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = 124;
        $category = $component->getParent();
        $model = $this->loadModel($id);
        if(1 < $model->status)throw new CHttpException(400,'Sorry!项目处于上线状态,不能编辑!');
        //$model->video = empty($model->video)?'(可选)输入视频地址(支持优酷、土豆、酷六、新浪视频)':$model->video;
        $model->thumb = !empty($model->thumbs->track_id)?$model->thumbs->track_id : null;
        if(isset($_POST['Dream'],$_POST['DreamContent']))
        {
            $model->attributes = $_POST['Dream'];
            $model->dreamContent->attributes = $_POST['DreamContent'];
            if($model->validate() && $model->dreamContent->validate()){
                if($model->save(false) && $model->dreamContent->save()){
                    if(isset($_POST['Dream']['next']))
                        $this->redirect($this->createUrl('/usercenter/projects/pledges',array('id'=>$id)));
                    else
                        Yii::app()->user->setFlash('projects','保存成功!');
                }
            }
        }
        $this->render('update',array(
            'model'=>$model,
            'category'=>$category,
        ));
   }
   
   public function actionDelete($id)
   {
       $model = $this->loadModel($id);
       if(1 < $model->status)throw new CHttpException(400,'Sorry!项目处于上线状态,不能编辑!');
       if($model->delete())
           Helper::showMsg ('系统消息', '删除成功',$this->createUrl('/usercenter/projects/index'));
   }
   
   public function actionPledges($id)
   {       
       $dream = $this->loadModel($id);       
       $pid = (int)Yii::app()->request->getParam('pid',0);
       $model = new DreamPledges();
       $order =  DreamPledges::model()->findAll("dream_id='{$id}'");
       if(0 < $pid)
       {
           $model = DreamPledges::model()->findByPk($pid);
           if($model===null || $model->dream_id !=$id)throw new CHttpException(404,'信息不存在!');
           $model->places_button = (0 < $model->places ? 1 : 0 ); 
        }
       if(isset($_POST['DreamPledges']))
       {          
           $_POST['DreamPledges']['dream_id'] = $id;
           $model->attributes = $_POST['DreamPledges'];
           if($model->save())
           {
                $model->refresh();
                $this->redirect($this->createUrl('/usercenter/projects/pledges',array('id'=>$id)));
           }
       }
       $this->render('pledges',array(
           'model'=>$model,
           'order'=>$order,
           'dream'=>$dream,
       ));
   }  
   
   public function actionSubmit($id)
   {
       $dream = $this->loadModel($id);
       if(1 < $dream->status)throw new CHttpException(400,'Sorry!项目处于上线状态,不能编辑!');
       $model = DreamSubmit::model()->findByAttributes(array('dream_id'=>$id));
       if($model === null)$model = new DreamSubmit();
       if(isset($_POST['Dream']['audit']))
       {
           $dream->status = '0';
           if($dream->validate() && $dream->save())
           {
               DreamLog::setLog($id, 2);
               $this->redirect($this->createUrl('/usercenter/projects/submit',array('id'=>$id)));
           }
       }
       if(isset($_POST['Dream'],$_POST['DreamSubmit']))
       {
           $dream->status = '1';
           $dream->day = $_POST['Dream']['day'];
           $dream->money = $_POST['Dream']['money'];
           $model->attributes = $_POST['DreamSubmit'];
            if($dream->save() && $model->save())
            {
                DreamLog::setLog($id, 1);
                Yii::app()->user->setFlash('submit','保存成功!');
            }          
       }
       $this->render('submit',array(
           'dream'=>$dream,
           'model'=>$model,
       ));
   }
   
   protected function loadModel($id)
   {
       $model = Dream::model()->findByPk($id);
       if($model ===null || $model->user_id != Yii::app()->user->id)
           throw new CHttpException(404,'信息不存在!');
       else
           return $model;
   }


   public function actionDeletePledges($id)
   {
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(403,'非法操作');
        $model = DreamPledges::model()->findByPk($id);
        if($model===null || $model->dream->user_id != Yii::app()->user->id)
            throw new CHttpException(404,'信息不存在!');
        else
        {
            if($model->dream->user_id !=Yii::app()->user->id)throw new CHttpException(403,'非法操作!');
            if($model->delete())
                Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1')));
            else
                Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'0')));
        }
    }
    
    
    
    public function actionAttention($cid = 0)
    {   
        $uid = Yii::app()->user->id;
        $criteria = new CDbCriteria();
        $criteria->condition = 't.user_id = :uid';
        $criteria->with = 'dream';
        $criteria->params = array(':uid'=>$uid);
        $attention = PublicAttention::model()->findAll($criteria);
        $attention = $discoverys = array();
        if(!$attention){
            $render=array('attention'=>$attention);
        }
        if(empty($attention)){
            $discoverys = array('discoverys'=>$this->_loadRand($cid));
            $render = array_merge($discoverys,$render);
        }
        $this->render('attention',$render);
    }
    
    
    public function actionSupport($cid = 0)
    {
        $uid = Yii::app()->user->id;
        $criteria = new CDbCriteria();
        $criteria->condition = 'user_id = :uid';
        $criteria->order = 'id desc';
        $criteria->params = array(':uid'=>$uid);
        $criteria->addCondition('app_id='.BaseApp::DREAM);
        $supports = PublicOrder::model()->findAll($criteria);
        $supports = $discoverys =array();
        if(!$supports){
            $render= array('supports'=>$supports);
        }
        if(empty($supports)){
            $discoverys = array('discoverys'=>$this->_loadRand($cid));
            $render = array_merge($discoverys,$render);
        }
        $this->render('support',$render);
    }
}

