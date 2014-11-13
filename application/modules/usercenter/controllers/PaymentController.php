<?php
use application\components\Controller;

class PaymentController extends Controller{
    
    public function actionDream($id,$pledge)
    {
        if(Yii::app()->user->isGuest)$this->redirect(Yii::app()->user->loginUrl);
        $count = DreamPledges::model()->countByAttributes(array('dream_id'=>$id,'id'=>$pledge));
        //$payCount = PublicPayment::model()->countByAttributes(array('res_id'=>$pledge,'app_id'=>BaseApp::DREAM,'user_id'=>Yii::app()->user->id));
        //if(0 < $payCount)throw new CHttpException(403,'非法访问!');
        //if($count === '0')throw new CHttpException(403,'非法访问!');
        $dream = Dream::model()->findByPk($id);
        if($dream ->status < 3 || $dream->status == 4 || $count === '0')throw new CHttpException(403,'非法访问!');
        $order = Helper::getOrderNumber();
        $value = CJSON::encode(array('id'=>$id,'pledge'=>$pledge,'app_id'=>BaseApp::DREAM,'order'=>$order));
        $session = new CHttpSession();
        $session->open();
        $session->add('payment_pay', $value);
        $this->redirect($this->createUrl('/usercenter/payment/dreampay',array('order'=>$order)));
    } 
    
    public function actionDreamPay()
    {
        $uid = Yii::app()->user->id;
        $order = Yii::app()->request->getParam('order',0);
        $params = $this->_checkOrder($order);
        $model = $this->loadPledge($params['pledge']);
        if($model->dream->status < 3)throw new CHttpException(403,'非法访问!');
        $address = PublicDeliveryAddress::model()->findAll("user_id={$uid}");
        $this->render('dreampay',array(
            'model'=>$model,
            'address'=>$address,
        ));
    }
    
    public function actionAlipay($order,$address)
    {
        if($address === null)Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'0','msg'=>'收货地址不能为空!')));
        $uid = Yii::app()->user->id;
        $time = time();     
        $params = $this->_checkOrder($order);      
        $pledge = $this->loadPledge($params['pledge']);
        if($pledge->dream->status < 3)throw new CHttpException(403,'非法访问!');
        $form = $this->_bindForm($params['order'],$pledge->dream->title,$pledge->dream->discription,$pledge->money);
        Yii::app()->db->createCommand("INSERT INTO  `public_order` set `user_id`=:uid,`order_id`=:order,`app_id`=:aid,`res_id`=:rid,`money`=:money,`address`=:add,`ctime`=:time,`mtime`=:time")->bindValues(array(':uid'=>$uid,':order'=>$order,':aid'=>$params['app_id'],'rid'=>$params['pledge'],'money'=>$pledge->money,':add'=>$address,':time'=>$time))->execute();
        if(0 < Yii::app()->db->getLastInsertID()){
            Yii::app()->end($form);
        }else{
            Yii::app()->end('提交失败!');
        }
    }


    
    public function actionAccount()
    {
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(400,'提交有误!');
        $uid = Yii::app()->user->id;
        $time = time();
        $money = UserAccount::getBalance();
        $addess = (int)Yii::app()->request->getParam('address',0);
        if($addess === 0)Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'0','msg'=>'收货地址不能为空!')));
        $order = Yii::app()->request->getParam('order');
        $params = $this->_checkOrder($order);
        $pledge = $this->loadPledge($params['pledge']);
        if($pledge->dream->status < 3)throw new CHttpException(403,'非法访问!');
        if($money < $pledge->money)Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'0','msg'=>'账号余额不足!请充值!')));
        $moneyRes = $money-$pledge->money;
        $connection = Yii::app()->db;
        $transaction=$connection->beginTransaction();
        try
        {
           $connection->createCommand("INSERT INTO  `public_order` set `user_id`=:uid,`order_id`=:order,`app_id`=:aid,`res_id`=:rid,`money`=:money,`total_fee`=:money,`trade_status`='1',`ctime`=:time,`mtime`=:time")->bindValues(array(':uid'=>$uid,':order'=>$order,':aid'=>$params['app_id'],'rid'=>$params['pledge'],'money'=>$pledge->money,':time'=>$time))->execute();
           $order_id = $connection->getLastInsertID();
           $connection->createCommand("UPDATE `user_account` SET  `money` = :money WHERE `user_id`=:uid")->bindValues(array(':money'=>$moneyRes,':uid'=>$uid))->execute();
           $connection->createCommand("INSERT INTO  `user_consumer_records` set `user_id`=:uid,`order_id`=:order,`ctime`=:time,`mtime`=:time")->bindValues(array(':uid'=>$uid,':order'=>$order_id,':time'=>$time))->execute();
           $connection->createCommand("INSERT INTO  `public_order_address` set `user_id`=:uid,`order_id`=:order_id,`address_id`=:address,`ctime`=:time,`mtime`=:time")->bindValues(array(':uid'=>$uid,':address'=>$addess,':order_id'=>$order_id,':time'=>$time))->execute();           
           $transaction->commit();
        }
        catch(Exception $e)
        {
           $transaction->rollBack();
        }
        PublicCount::setCount(BaseApp::DREAMPLEDGBES,$params['pledge']);
        DreamCount::setCount($pledge->dream->id,$pledge->money);
        $session = new CHttpSession();
        $session->open();
        $session->remove('payment_pay');
        Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'1','msg'=>'支付成功!')));
    }
    
        
    public function actionAddress($type=0)
    {
        if(!Yii::app()->request->isAjaxRequest && !isset($_POST['PublicDeliveryAddress']))throw new CHttpException(403,'非法提交!');
        if(0 < $type){
            $model = PublicDeliveryAddress::model()->findByAttributes(array('user_id'=>Yii::app()->user->id,'id'=>$type));
            if($model === null)Yii::app()->end('提交有误!');
        }else{
            $model = new PublicDeliveryAddress();
        }
        $model->attributes = $_POST['PublicDeliveryAddress'];
        if($model->validate() && $model->save())
            Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1'))); 
        else
            Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'0'))); 
    }
    
    public function actionAddressDelete()
    {
        if(!Yii::app()->request->isAjaxRequest && !isset($_POST['id']))throw new CHttpException(403,'非法提交!');
        $model = PublicDeliveryAddress::model()->findByAttributes(array('user_id'=>Yii::app()->user->id,'id'=>(int)$_POST['id']));
        if($model === null)Yii::app()->end('提交有误!');
        if($model->delete())
            Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1'))); 
        else
            Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'0'))); 
    }
    
    protected function loadPledge($pledge)
    {
        $model = DreamPledges::model()->with('dream')->findByPk($pledge);
        if($model === null)
            throw new CHttpException(403,'订单数据有误!');
        else
            return $model;
    }


    private function _checkOrder($order)
    {
        $session = new CHttpSession();
        $session->open();
        $json = $session->get('payment_pay');
        if(empty($order) || empty($json))Helper::showMsg ('系统消息', '订单已失效,请重新提交!');
        $params = CJSON::decode($json);
        if($params['order']!=$order)throw new CHttpException(403,'非法访问!');
        return $params;
    }
    
    private function _bindForm($trade,$subject,$body,$tatal)
    {
        $html = CHtml::form('/pay/alipay','POST',array('id'=>'alipaysubmit'));
        $html.= CHtml::hiddenField('pay[trade]',$trade);
        $html.= CHtml::hiddenField('pay[subject]',$subject);
        $html.= CHtml::hiddenField('pay[body]',$body);
        $html.= CHtml::hiddenField('pay[total]',$tatal);
        $html.= "<script>document.forms['alipaysubmit'].submit();</script>";
        return $html;
    }
}

