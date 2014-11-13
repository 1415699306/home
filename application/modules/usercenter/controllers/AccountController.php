<?php
use \application\modules\usercenter\components\Controller;

class AccountController extends Controller
{
    
     public function actions()
    {
        return array(
            'flashUploadAvatar'=>array(
                'class'=>'ext.widgets.avatar.uploadCreate',
            ),
        );
    }
    
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
                'actions'=>array('index','charge','draw','view'),
                        'users'=>array('@'),
                ),
                array('deny',
                        'users'=>array('*'),
                ),
        );
    }
    
    public function actionIndex()
    {
        $uid = Yii::app()->user->id;
        $sql1 = "select user_id,money from user_account where user_id='$uid'";
        $account = Yii::app()->db->createCommand($sql1)->queryRow();
        $sql2 = "select sum(money) as sum from public_order where user_id='$uid'";
        $spent = Yii::app()->db->createCommand($sql2)->queryRow();   
        $sp=$spent['sum'];
        $co = $account['money'];
        $balance = $co - $sp;
        $criteria = new CDbCriteria();
        $criteria->with=array('dreamPledge','dreamPledge.dream');
        $criteria->condition = 't.user_id = :uid';
        $criteria->order = 't.id desc' ;
        $criteria->params = array(':uid'=>$uid);
        $models = PublicOrder::model()->findAll($criteria);
        $this->render('index',array('models'=>$models,'balance'=>$balance));
       
    }
    
    /**
     * 账户充值
     */
    public function actionCharge()
    {  
        $model = new Charge();
        $model->order_id = rand(0000000000,9999999999); 
        if(isset($_POST['Charge']))
        {
            $model->attributes = $_POST['Charge'];
           
            if($model->save())
            {   
               $this->redirect($this->createUrl('/usercenter/account/view',array('id'=>$model->id)));
            }else{
                    Helper::showMsg('系统消息','信息添加失败!','./');
            }      
        }
        $this->render('charge',array('model'=>$model));
    }
    
    /**
     * 账户提现
     */
    public function actionDraw()
    {
        $uid = Yii::app()->user->id;
        $sql1 = "select user_id,money from user_account where user_id='$uid'";
        $account = Yii::app()->db->createCommand($sql1)->queryRow();
        $sql2 = "select sum(money) as sum from public_order where user_id='$uid'";
        $spent = Yii::app()->db->createCommand($sql2)->queryRow();   
        $sp=$spent['sum'];
        $co = $account['money'];
        $balance = $co - $sp;
        $model = new Draw();
        $model->status = 0;
        $model->title = '必须与所填支付宝账号的用户姓名一致!';
        $model->phone = '提现过程中如有问题客服可与您取得联系!';
        if(isset($_POST['Draw']))
            {
            $model->attributes = $_POST['Draw'];
            if($model->validate())
            {
                if($model->save())
                {
                    
                    Helper::showMsg('系统消息','提现等待中!','./');
                }
                else
                {
                    Helper::showMsg('系统消息','文章添加失败!','./');
                }
            }
        }
        $this->render('draw',array('model'=>$model,'balance'=>$balance));
    }
    
    
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $p0_Cmd="Buy";
        $p1_MerId="10001126856";
        $p2_Order=$model->order_id;
        $p3_Amt=$model->money;
        $p4_Cur="CNY";
        //商品名称
        $p5_Pid="";
        $p6_Pcat="";//种类
        $p7_Pdesc="";//商品介绍
        $p8_Url="";
        $p9_SAF="0";
        $pa_MP="";
        $pd_FrpId=$model->banktype;
        $pr_NeedResponse="1";

        //我们把请求参数一个一个拼接(拼接的时候，顺序很重要!!!!)
        $data="";
        $data=$data.$p0_Cmd;
        $data=$data.$p1_MerId;
        $data=$data.$p2_Order;
        $data=$data.$p3_Amt;
        $data=$data.$p4_Cur;
        $data=$data.$p5_Pid;
        $data=$data.$p6_Pcat;
        $data=$data.$p7_Pdesc;
        $data=$data.$p8_Url;
        $data=$data.$p9_SAF;
        $data=$data.$pa_MP;
        $data=$data.$pd_FrpId;
        $data=$data.$pr_NeedResponse;
       
        $merchantKey	= "69cl522AV6q613Ii4W6u8K6XuW8vM1N6bFgyv769220IuYe9u37N4y7rI4Pl";
        $hmac=$this->HmacMd5($data,$merchantKey);
        $this->render('view',array(
            'model'=>$model,
            'data'=>$data,
            'hmac'=>$hmac,
        ));
    }
    
    public function loadModel($id)
    {
        $model = Charge::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'页面不存在!');
        else
            return $model;
    }
    
    
    public function HmacMd5($data,$key)
    {
        $key = iconv("GB2312","UTF-8",$key);
        $data = iconv("GB2312","UTF-8",$data);
        $b = 64; // byte length for md5
        if (strlen($key) > $b) {
        $key = pack("H*",md5($key));
        }
        $key = str_pad($key, $b, chr(0x00));
        $ipad = str_pad('', $b, chr(0x36));
        $opad = str_pad('', $b, chr(0x5c));
        $k_ipad = $key ^ $ipad ;
        $k_opad = $key ^ $opad;
        return md5($k_opad . pack("H*",md5($k_ipad . $data)));}

    }
