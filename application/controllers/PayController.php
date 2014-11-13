<?php
use application\components\Controller;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BayController
 *
 * @author martin
 */
class PayController extends Controller{
    
    public function init()
    {
         Yii::import('application.vendors.alipay.class.*');
    }
    
    /**
     * alipay action
     * @param string $subject 产品名称
     * @param string $body 产品简介
     * @param int $total 产品金额
     */
    public function actionAlipay()
    {
        if(empty($_POST['pay']['trade']) || empty($_POST['pay']['subject']) || empty($_POST['pay']['body']) || empty($_POST['pay']['total']))throw new CHttpException(403,'fail');
        $alipay = Yii::app()->alipay;
        $request = new AlipayDirectRequest();
        $request->out_trade_no = $_POST['pay']['trade'];
        $request->subject = $_POST['pay']['subject'];
        $request->body = $_POST['pay']['body'];
        $request->total_fee = $_POST['pay']['total'];
        $request->anti_phishing_key = $this->query_timestamp($alipay->partner);
        $form = $alipay->buildForm($request);
        Yii::app()->end($form);
    }

    public function actionNotify() 
    {
        $alipay = Yii::app()->alipay;
        if ($alipay->verifyNotify()) {
            $order_id = $_POST['out_trade_no'];
            $order_fee = $_POST['total_fee'];   
            if($_POST['trade_status'] == 'TRADE_FINISHED' || $_POST['trade_status'] == 'TRADE_SUCCESS') 
            {
               PublicOrder::updateOrder($order_id, $order_fee, $_POST['trade_status']);
            }
            else 
            {
                echo "success";
            }
        } 
        else 
        {
            Yii::app()->end("fail");
        }
    }

    public function actionReturn() 
    {
        $trade_status = Yii::app()->request->getParam('trade_status');
        $alipay = Yii::app()->alipay;
        if ($alipay->verifyReturn()) {
            $order_id = $_GET['out_trade_no'];
            $order_fee = $_GET['total_fee'];          
            if($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
                PublicOrder::updateOrder($order_id, $order_fee, '1');
                $this->render('order_ready');
            }
            else
            {
                echo "trade_status=".$trade_status;
            }
        } else {
            Yii::app()->end("fail");
        }
    }
    
    private function query_timestamp($partner) 
    {
        $URL = "https://mapi.alipay.com/gateway.do?service=query_timestamp&partner=".$partner;
        $encrypt_key = "";
        $doc = new DOMDocument();
        if($doc->load($URL))
        {
            $itemEncrypt_key = $doc->getElementsByTagName( "encrypt_key" );
            $encrypt_key = $itemEncrypt_key->item(0)->nodeValue;
            return $encrypt_key;
        }
    }
}
