<style>
/*个人账户样式*/
.FloatLeft .MainDiv .subDiv h1{ color:#444; font-weight:bold; font-size:14px; float:left;}
.FloatLeft .MainDiv .subDiv h1 span{ color:#cc0202;font-family:微软雅黑;}
.FloatLeft .MainDiv .subDiv h1 span i{ font-size:24px; font-style:normal; padding:0 5px;color:#cc0202;}
.FloatLeft .MainDiv .subDiv span.Push_button {width: 70px;height: 22px;background-image: url(/themes/usercenter/images/btn_03.jpg);background-repeat: no-repeat;display: block;text-align: center;line-height: 22px;margin-top: 20px;margin-left: 20px;float: left;cursor: pointer;}
.FloatLeft .MainDiv .ContentTab {width: 699px;background:#F9FEF8;overflow: hidden; border:1px solid #ededed; border-top:none;overflow: hidden;}
.FloatLeft .MainDiv ul li{ overflow:hidden;}
.FloatLeft .MainDiv ul li .ContentTab_title { float:left; width:699px;border-bottom: 1px solid #ededed;border-top: 1px solid #ededed;overflow: hidden;height:50px;line-height:50px;background: #f9fef8; text-indent:16px;font-size: 12px;color: #0d608b;font-weight: bold;}
.FloatLeft .MainDiv ul li .ContentTab_title em.date {color:#717171;font-style: normal;padding-left: 20px;font-weight: normal;}
.FloatLeft .MainDiv ul li .maindiv_1 {width: 166px;color: #0d608b; border-right:1px solid #ededed;}
.FloatLeft .MainDiv ul li .maindiv {float: left;text-align: center;padding: 10px 5px;vertical-align: middle;line-height: 18px; height:120px;}
.FloatLeft .MainDiv ul li .maindiv_2 {width: 210px; border-right:1px solid #ededed;}
.FloatLeft .MainDiv ul li .maindiv_3 {width: 115px;}
.FloatLeft .MainDiv ul li .maindiv_3 i {font-style: normal;color: #cc0202;}
.FloatLeft .MainDiv ul li .maindiv_4 {width: 164px;text-align: left; border-left:1px solid #ededed;}


</style>
</head>
<body>
  <div class='FloatLeft'>
      <div class='MainDiv'>
                   <div class='bigDiv subDiv'>
                          <div class='subtitle'>个人账户</div>
                          <h1>账户余额:<span>￥<i><?php echo $balance < 0 ? 0:$balance;?></i></span>元</h1>    
                          <span class='Push_button'>账号充值</span>    
        </div>
                    <div class='bigDiv subDiv'>
                          <div class='subtitle'>我的付款明细</div>
                          <div class='ContentTab'>
                              <?php if(empty($models)):?><p>暂无数据</p><?php endif;?>
                              <?php foreach($models as $val):?>
                              <ul>
                                <li>
                                <div class='ContentTab_title'>
                                    订单号：<?php echo CHtml::encode($val->order_id);?>
                                    <em class='date'>下单时间：<?php echo date('Y-m-d H:i:s',$val->ctime);?></em>
                                    <em class='date'>订单状态：<?php echo PublicOrder::getStatus($val->trade_status);?></em>
                                </div>
                                    <div class=' maindiv maindiv_1'>
                                        <?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($val->dreamPledge->dream->title),15),$this->createUrl('/dream/projects/view',array('id'=>$val->dreamPledge->dream->id)),array('target'=>'_blank'));?>
                                    </div>
                                    <div class=' maindiv maindiv_2'>回报发放时间：<?php echo CHtml::encode($val->dreamPledge->payback_time);?>天</div>
                                    <div class=' maindiv maindiv_3'>付款：<?php echo CHtml::encode($val->money);?>元</div>
                                    <div class=' maindiv maindiv_4'><?php echo CHtml::encode(Helper::truncate_utf8($val->dreamPledge->dream->discription, 80));?></div>
                                </li>
                              </ul>
                              <?php endforeach;?>
                          </div>
                    </div>
    </div>
  </div>
  <div class='RightFloat'>
            <div class='RightTitle'>使用小帮助</div>
            <div class='RightContent'>
                <h1><em>Q</em>如何充值？</h1>
                <p>A:网民在选择任一银行卡支付通道后立即进入银行网关，银行卡资料全部在银行网关加密页面上填写，无论是支付平台 还是网站都无法看到或了解到任何银行卡资料。网民输入卡资料提交过程全部采用国际通用的SSL或SET及数字证书进行加密传输，安全性由银行全 面提供支持和保护，各银行网上支付系统对网上支付的安全提供保障。银行和及商家之间是通过数字签名和加密验证传送信息的，提供层层安全保护。</p>
            </div>
        </div>
</body>
</html>
