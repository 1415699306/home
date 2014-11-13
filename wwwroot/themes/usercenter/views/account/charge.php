<style>
/*账号充值*/
.FloatLeft .MainDiv .subDiv h1{ color:#444; font-weight:bold; font-size:14px;}
.FloatLeft .MainDiv .subDiv h1 span{ color:#cc0202;font-family:"微软雅黑";}
.FloatLeft .MainDiv .subDiv h1 span i{color:#cc0202; font-size:30px; font-style:normal; padding:0 5px;}
.FloatLeft .MainDiv .subDiv label{ width:100px; text-align:left;}
.row .btn{width: 72px;background: url(/themes/usercenter/images/public.jpg) no-repeat;background-position: 0 -221px;color: #fff; border:none; cursor:pointer;}
.row input {height: 25px;line-height: 25px;}
.row .Recharge{ margin-right:10px; display:inline; border:1px solid #e5e5e5;}
.FloatLeft .MainDiv .subDiv .Details{ width:699px; border:1px solid #ededed; background:#f9fef8; overflow:hidden; margin-bottom:100px;}
.FloatLeft .MainDiv .subDiv .Details ul.list li{ float:left; height:40px; line-height:40px; text-align:center; border-bottom:1px solid #ededed;}
.FloatLeft .MainDiv .subDiv .Details ul.list li i{ color:#cc0202; font-style:normal;}
.FloatLeft .MainDiv .subDiv .Details ul.list li.bor1{border-right:1px solid #ededed;}
.FloatLeft .MainDiv .subDiv .Details ul.list li.list_1{ width:235px; }
.FloatLeft .MainDiv .subDiv .Details ul.list li.list_2{width:276px;}
.FloatLeft .MainDiv .subDiv .Details ul.list li.list_3{ width:186px;}
.FloatLeft .MainDiv .subDiv  ul.banklist { width:570px;overflow:hidden;}
.FloatLeft .MainDiv .subDiv  ul.banklist li{width:190px; height:27px;float:left;background-image: url(/themes/usercenter/images/bank.jpg); background-repeat:no-repeat; text-indent:-9999px; cursor:pointer; margin:5px 0;}
.FloatLeft .MainDiv .subDiv  ul.banklist li input.Single_box{ float:left; height:27px; line-height:27px;}
.FloatLeft .MainDiv .subDiv  ul.banklist li.bank_1{ background-position:25px 0;}
.FloatLeft .MainDiv .subDiv  ul.banklist li.bank_2{ background-position:25px -140px;}
.FloatLeft .MainDiv .subDiv  ul.banklist li.bank_3{ background-position:25px -280px;}
.FloatLeft .MainDiv .subDiv  ul.banklist li.bank_4{ background-position:25px -112px;}
.FloatLeft .MainDiv .subDiv  ul.banklist li.bank_5{ background-position:25px -168px;}
.FloatLeft .MainDiv .subDiv  ul.banklist li.bank_6{ background-position:25px -28px;}
.FloatLeft .MainDiv .subDiv  ul.banklist li.bank_7{ background-position:25px -308px;}
.FloatLeft .MainDiv .subDiv  ul.banklist li.bank_8{ background-position:25px -56px;}
.FloatLeft .MainDiv .subDiv  ul.banklist li.bank_9{ background-position:25px -196px;}
.FloatLeft .MainDiv .subDiv  ul.banklist li.bank_10{ background-position:25px -224px;}
.FloatLeft .MainDiv .subDiv  ul.banklist li.bank_11{ background-position:25px -336px;}
.FloatLeft .MainDiv .subDiv  ul.banklist li.bank_12{ background-position:25px -84px;}
.FloatLeft .MainDiv .subDiv  ul.banklist li.bank_13{ background-position:25px -364px;}
.FloatLeft .MainDiv .subDiv  ul.banklist li.bank_14{ background-position:25px -252px;}
.FloatLeft .MainDiv .subDiv .buttom{ margin-top:20px;width: 434px;}
.FloatLeft .MainDiv .subDiv .buttom .save {width:56px;height: 25px;background: url(/themes/usercenter/images/public.jpg) no-repeat;background-position: 0 -147px;border: none;cursor: pointer;margin-right: 17px;display: block;float: left; cursor:pointer; color:#ccc;}
.FloatLeft .MainDiv .subDiv .buttom .next{width: 56px;height: 25px;background: url(/themes/usercenter/images/public.jpg) no-repeat;background-position: 0 -121px;color: #fff;border: none; cursor:pointer;}
</style>
    <div class='FloatLeft'>
        <div class='MainDiv'>
            <!--
            <div class='bigDiv subDiv'>
              <div class='subtitle'>账户充值</div>
               <h1>账户余额:<span>￥<i>900.00</i></span>元</h1>
              <div class='row'><label style="width:70px;">充值数额：</label><input type="text" value="" class="Recharge" /><input type="submit" value="充值" class="btn"></div>
            </div>
            -->
            
            <div class='bigDiv subDiv'>
           	  <div class='subtitle'>我的充值明细</div>
			  <div class='Details'>
              	<ul class='list'>
                	<li class='list_1 bor1'>充值时间：2013-05-20 17:51:57</li>
                    <li class='list_2 bor1'>充值金额：100元</li>
                    <li class='list_3'>账户余额：<i>100</i>元</li>
                    <li class='list_1 bor1'>充值时间：2013-05-20 17:51:57</li>
                    <li class='list_2 bor1'>充值金额：100元</li>
                    <li class='list_3'>账户余额：<i>100</i>元</li>
                	<li class='list_1 bor1'>充值时间：2013-05-20 17:51:57</li>
                    <li class='list_2 bor1'>充值金额：100元</li>
                    <li class='list_3'>账户余额：<i>100</i>元</li>

                </ul>
              </div>
              <div class='bigDiv subDiv'>
                <div class='subtitle'>账户充值</div>
                 <h1>账户余额:<span>￥<i>900.00</i></span>元</h1>
              <div class="form">
              <?php $form = $this->beginWidget('CActiveForm', array(
                'enableAjaxValidation'=>true,
                'enableClientValidation'=>true,
                'htmlOptions'=>array(
                    'validateOnSubmit'=>true,
                    'enctype'=>'multipart/form-data',
                ),
            )); 
            ?>
                <div class='row'>
                    <label style="width:70px;">充值数额：</label>
                    <?php echo $form->textField($model,'money',array('class'=>'Recharge')); ?>
                    <?php echo $form->hiddenField($model,'order_id');?>  
                </div>
                </div>
               <h1>付款方式:</h1>
               <label>网银直接支付：</label>
               <ul class='banklist'>
               	<li class='bank_1'>
                    <input type="radio" name="pd_FrpId" value="CMBCHINA-NET" class="Single_box " id="checked"/>招商银行
                </li>
                <li class='bank_2'>
                    <input type="radio" name="pd_FrpId" value="ICBC-NET" class='Single_box '/>工商银行
                </li>
                <li class='bank_3'>
                    <input type="radio" name="pd_FrpId" value="CCB-NET" class='Single_box '/>中国建设银行
                </li>
                <li class='bank_4'>
                    <input type="radio" name="pd_FrpId" value="ABC-NET" class=' Single_box '/>农业银行
                </li>     
               </ul>
               <div class="buttom">
                    <?php echo CHtml::submitButton('充值',array('class'=>'next')); ?>
               </div>
                <?php $this->endWidget(); ?>
          </div>
  
<br />

               
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
<script>
$(function(){
     $("#checked").attr("checked","checked"); 
});
</script>

