<?php
class DreamController  extends BController{
    
    const AUDIT = '2';
    const CANCEL = '-1';
    const OFFLINE = '-2';
    const ONLINE = '3';

    public function actions() 
    {
        return array(
            'advertising'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'index',
                'app_id'=>BaseApp::DREAM,
                'category'=>141,
            ),
            'advcreate'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'create',
                'app_id'=>BaseApp::DREAM,
                'category'=>141,
            ),
            'advertisingupdate'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'update',
                'app_id'=>BaseApp::DREAM,
                'category'=>141,
            ),
            'advertisingdelete'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'delete',
                'app_id'=>BaseApp::DREAM,
                'category'=>141,
            ),
            'advertisingview'=>array(
                'class'=>'AdvertisingActions',
                'method'=>'view',
                'app_id'=>BaseApp::DREAM,
                'category'=>141,
            ),
            
            'slide'=>array(
                'class'=>'SlideActions',
                'method'=>'index',
                'app_id'=>BaseApp::DREAM,
                 'category'=>143,
            ),
            'slidecreate'=>array(
                'class'=>'SlideActions',
                'method'=>'create',
                'app_id'=>BaseApp::DREAM,
                'category'=>143,
            ),
            'slideupdate'=>array(
                'class'=>'SlideActions',
                'method'=>'update',
                'app_id'=>BaseApp::DREAM,
                 'category'=>143,
            ),
            'slidedelete'=>array(
                'class'=>'SlideActions',
                'method'=>'delete',
                'app_id'=>BaseApp::DREAM,
                 'category'=>143,
            ),
            'slideview'=>array(
                'class'=>'SlideActions',
                'method'=>'view',
                'app_id'=>BaseApp::DREAM,
                 'category'=>143,
            ),
        );
    }
    
    public function actionIndex($act=null)
    {         
        switch ($act){
            case 'order' : $model = $this->_getOrder();break;
            case 'pledges' : $model = $this->_getPledges();break;
            case 'draw' : $model = $this->_getDraw();break;
            default : $model = $this->_getIndex();
        }
        $this->render('index',array('model'=>$model));
    }
    
    private function _getOrder()
    {
        $id = Yii::app()->request->getParam('id',0);
        if(0 < $id)
        {
            $model = Dream::model()->findByPk($id);
        }
        else
        {
            $model = new PublicOrder('search');
            $model->unsetAttributes();
            if(isset($_GET['PublicOrder']))
                $model->attributes = $_GET['PublicOrder'];
        }

        return $model;
    }
    
    private function _getPledges()
    {   
        $model = new DreamPledges('search');
        $model->unsetAttributes();
        if(isset($_GET['DreamPledges']))
            $model->attributes = $_GET['DreamPledges'];
        return $model;
    }


    private function _getIndex()
    {
        $model = new Dream('search');
        $model->unsetAttributes();
        if(isset($_GET['Dream']))
            $model->attributes = $_GET['Dream'];
        return $model;
    }
    
    private function _getDraw()
    { 
        $model = new Draw('search');
        $model->unsetAttributes();
        if(isset($_GET['Draw']))
            $model->attributes = $_GET['Draw'];  
        return $model;
    }
    
    public function actionView($id)
    {
        $model = Dream::model()->findByPk($id);
        $this->render('view',array('model'=>$model));
    }
    
    public function actionAudit($id)
    {
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(400,'非法请求!');
        $model = $this->loadModel($id);
        if(empty($model->dreamPledges))Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'-2','msg'=>'项目回报为空不能通过审核!')));
        if($model->status > '1')throw new CHttpException(400,'非法请求!');
        $model->status = self::AUDIT;
        $model->status_time = time();
        if($model->save())
        {
            $notify = new NotifyService($model->id,self::AUDIT);
            $notify->attach(new DreamServer());
            $notify->setLog();
            Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1','msg'=>'提交成功!')));
        }
        else
            Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'0','msg'=>'提交失败!')));
    }
    
    public function actionCancel()
    {
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(400,'非法请求!');
        $model = $this->loadModel($_POST['id']);
        $model->status = self::CANCEL;
        if($model->save())
        {
            $notify = new NotifyService($model->id,self::CANCEL,$_POST['msg']);
            $notify->attach(new DreamServer());
            $notify->setLog();
            Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1','msg'=>'提交成功!')));
        }
        else
            Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'0','msg'=>'提交失败!')));
       
    }
    
    public function actionOnline()
    {
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(400,'非法请求!');
        $model = $this->loadModel($_POST['id']);
        if($model->status == self::ONLINE || $model->status < '1')throw new CHttpException(400,'非法请求!');
        if(empty($model->dreamPledges))Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'-2','msg'=>'项目回报为空不能通过审核!')));
        $model->status = self::ONLINE;
        $model->status_time = time();
        if($model->save())
        {
            $notify = new NotifyService($model->id,self::ONLINE,'系统平台操作上线');
            $notify->attach(new DreamServer());
            $notify->setLog();
            Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1','msg'=>'提交成功!')));
        }
        else
            Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'0','msg'=>'提交失败!')));
    }
    
    public function actionOffLine()
    {
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(400,'非法请求!');
        $model = $this->loadModel($_POST['id']);
        $model->status = self::OFFLINE;
        $model->status_time = 0;
        if($model->save())
        {
            $notify = new NotifyService($model->id,self::OFFLINE,$_POST['msg']);
            $notify->attach(new DreamServer());
            $notify->setLog();
            Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1','msg'=>'提交成功!')));
        }
        else
            Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'0','msg'=>'提交失败!')));
    }
    
    public function actionRecommand($id)
    {
        $model = $this->loadModel($id);
        if($model->recommand > 0 && $model->status < 1)throw new CHttpException(400,'数据不符合推荐规范!');
        $model->recommand = 1;
        if($model->save())
        {
            $notify = new NotifyService($model->id,self::OFFLINE,'项目被推荐了!');
            $notify->attach(new DreamServer());
            $notify->setLog();
            Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1','msg'=>'提交成功!')));
        }
        else
            Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'0','msg'=>'提交失败!')));
            
    }
    
    public function actionUnRecommand($id)
    {
        $model = $this->loadModel($id);
        if(1 > $model->recommand && $model->status < 1)throw new CHttpException(400,'数据不符合推荐规范!');
        $model->recommand = 0;
        if($model->save())
        {
            $notify = new NotifyService($model->id,self::OFFLINE,'项目被取消推荐了!');
            $notify->attach(new DreamServer());
            $notify->setLog();
            Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1','msg'=>'提交成功!')));
        }
        else
            Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'0','msg'=>'提交失败!')));
            
    }
    
    public function actionPledge($id)
    {
        $model = DreamPledges::model()->findByPk($id);
        $this->render('pledge',array('model'=>$model));
    }
    
    protected function loadModel($id)
    {
        $model = Dream::model()->with('dreamPledges')->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'数据不存在!');
        else
            return $model;
    }
    
     public function actionConfirm($id)
    {
        $model = $this->_loadModel($id);
        if($model->status > 1)throw new CHttpException(400,'数据不符合推荐规范!');
        $model->status = 1;
        if($model->save(false)){
           Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1','msg'=>'提交成功!')));
        }
        else
            Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'0','msg'=>'提交失败!')));
    }
    
    public function actionUnConfirm($id)
    {
        $model = $this->_loadModel($id);
        if($model->status > 1)throw new CHttpException(400,'数据不符合推荐规范!');
        $model->status = 0;
        if($model->save(false))
        {
            Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1','msg'=>'提交成功!')));
        } else{
            Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'0','msg'=>'提交失败!')));
        }
    }
     
     protected function _loadModel($id)
    {
        $model = Draw::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'数据不存在!');
        else
            return $model;
    }
}

