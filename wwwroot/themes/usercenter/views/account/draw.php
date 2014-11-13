<style>
/*账号充值*/
.errorMessage {
line-height: 30px;
float: left;
padding-left: 25px;
background: url(/themes/usercenter/images/icons-e5243ebf3d910e3b0022fab1ffb63a97.png) no-repeat 5px;
width: 200px;
height: 30px;
}
.MainDiv{ width:auto;}
label{ width:60px; margin-right:15px;}
.subDiv h1{ color:#444; font-weight:bold; font-size:14px;}
.subDiv h1 span{ color:#cc0202; font-family:"微软雅黑";}
.subDiv h1 span i{ color:#cc0202;font-size:30px; font-style:normal; padding:0 5px;}
.row .btn{width: 72px;background: url(/themes/usercenter/images/public.jpg) no-repeat;background-position: 0 -221px;color: #fff; border:none; text-align:center; float:left;}
.row input {cursor: pointer;height: 25px;line-height: 25px;text-align: left;}
.subDiv .Details{ width:699px; border:1px solid #ededed; background:#f9fef8; overflow:hidden; margin-bottom:100px;}
.row span.sign{ line-height:25px;}
.FloatLeft .subDiv .Details ul.list li{ float:left; height:40px; line-height:40px; text-align:center; border-bottom:1px solid #ededed;}
.FloatLeft .subDiv .Details ul.list li i{ color:#cc0202; font-style:normal;}
.FloatLeft .subDiv .Details ul.list li.bor1{border-right:1px solid #ededed;}
.FloatLeft .subDiv .Details ul.list li.list_1{ width:235px; }
.FloatLeft .subDiv .Details ul.list li.list_2{width:276px;}
.FloatLeft .subDiv .Details ul.list li.list_3{ width:186px;}
.FloatLeft .subDiv  ul.banklist { width:570px;overflow:hidden;}
.FloatLeft .subDiv  ul.banklist li{width:190px; height:27px;float:left;background-image: url(/themes/usercenter/images/bank.jpg); background-repeat:no-repeat; text-indent:-9999px; cursor:pointer; margin:5px 0;}
.FloatLeft .subDiv  ul.banklist li input.Single_box{ float:left; height:27px; line-height:27px;}
.FloatLeft .subDiv  ul.banklist li.bank_1{ background-position:25px 0;}
.FloatLeft .subDiv  ul.banklist li.bank_2{ background-position:25px -140px;}
.FloatLeft .subDiv  ul.banklist li.bank_3{ background-position:25px -280px;}
.FloatLeft .subDiv  ul.banklist li.bank_4{ background-position:25px -112px;}
.FloatLeft .subDiv  ul.banklist li.bank_5{ background-position:25px -168px;}
.FloatLeft .subDiv  ul.banklist li.bank_6{ background-position:25px -28px;}
.FloatLeft .subDiv  ul.banklist li.bank_7{ background-position:25px -308px;}
.FloatLeft .subDiv  ul.banklist li.bank_8{ background-position:25px -56px;}
.FloatLeft .subDiv  ul.banklist li.bank_9{ background-position:25px -196px;}
.FloatLeft .subDiv  ul.banklist li.bank_10{ background-position:25px -224px;}
.FloatLeft .subDiv  ul.banklist li.bank_11{ background-position:25px -336px;}
.FloatLeft .subDiv  ul.banklist li.bank_12{ background-position:25px -84px;}
.FloatLeft .subDiv  ul.banklist li.bank_13{ background-position:25px -364px;}
.FloatLeft .subDiv  ul.banklist li.bank_14{ background-position:25px -252px;}
.FloatLeft .subDiv .buttom{clear:both;}
.FloatLeft .subDiv .buttom input.btn{width: 72px; height:25px;background: url(/themes/usercenter/images/public.jpg) no-repeat;background-position: 0 -221px;color: #fff; border:none; text-align:center; float:left;}
.FloatLeft .subDiv .buttom span.sign{ height:26px; line-height:26px;}
.FloatLeft .subDiv .buttom .save {width: 56px;height: 25px;background: url(/themes/usercenter/images/public.jpg) no-repeat;background-position: 0 -147px;border: none;cursor: pointer;margin-right: 17px;display: block;float: left; cursor:pointer;}
.FloatLeft .subDiv .buttom .next{width: 56px;height: 25px;background: url(/themes/usercenter/images/public.jpg) no-repeat;background-position: 0 -121px;color: #fff;border: none; cursor:pointer;}
.FloatLeft .subDiv .choose {float: left;width: 80px;height: 30px;line-height: 30px; clear:both;}
.message{line-height: 30px;float: left;padding-left: 25px;background: url(/themes/usercenter/images/icons-e5243ebf3d910e3b0022fab1ffb63a97.png) no-repeat 5px;width: 200px;height: 30px;}
.success{line-height: 30px;float: left;padding-left: 25px;background: url(/images/ui/ui-background.gif) no-repeat 5px;width: 200px;height: 30px;}
.error{}
</style>
<div class='FloatLeft'>
    <div class='MainDiv'>
        <div class='bigDiv subDiv'>
          <div class='subtitle'>账户提现</div>
           <h1>账户余额:<span>￥<i><?php echo $balance < 0 ? 0:$balance;?></i></span>元</h1>    
        </div>
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
          
          
          <div class="form">
              <?php $form = $this->beginWidget('CActiveForm', array(
                'id'=>'draw-form',
                'enableAjaxValidation'=>false,
                'enableClientValidation'=>true,  
            )); ?>
           <h1>余额提现:</h1>
                <div class="row">
                    <?php echo $form->labelEx($model,'card',array('class'=>'required')); ?>
                    <?php echo $form->textField($model,'card',array('size'=>60,'maxlength'=>80,'class'=>'Bankcard','id'=>'card')); ?>
                    <span id="cd"></span>
                    <?php echo $form->error($model,'card',array('id'=>'message')); ?>
                 </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'title',array('class'=>'required')); ?>
                    <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>80,'class'=>'Bankcard','id'=>'title')); ?>
                    <span class="sign" id="tit"></span>
                    <?php echo $form->error($model,'title',array('id'=>'tle')); ?> 
                                    
                 </div>
                  <div class="row">
                    <?php echo $form->labelEx($model,'money',array('class'=>'required')); ?>
                    <?php echo $form->textField($model,'money',array('size'=>60,'maxlength'=>80,'class'=>'Bankcard','id'=>'money')); ?>
                       <span class="sign" id="mon"></span>
                    <?php echo $form->error($model,'money',array('id'=>'ey')); ?>                   
                 </div>
                 <div class="row">
                    <?php echo $form->labelEx($model,'phone',array('class'=>'required')); ?>
                    <?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>80,'class'=>'Bankcard','id'=>'phone')); ?>
                    <span class="sign" id="pho"></span>
                    <?php echo $form->error($model,'phone',array('id'=>'one')); ?>      
                                   
                 </div>
                 <div class="row">
                     <?php echo $form->labelEx($model,'remark',array('class'=>'required')); ?>
                     <?php echo $form->textArea($model,'remark',array('maxlength'=>255,'cols'=>'52','rows'=>'6','class'=>'textarea_2','id'=>'remark')); ?>
                     <span class="sign" id="mark"></span>
                     <?php echo $form->error($model,'remark',array('id'=>'rmk')); ?>
                 </div>
                <div class="buttom">
                 <?php echo CHtml::submitButton('申请提现',array('class'=>'btn')); ?>
            <span class="sign">您的余额提现将在成功申请后 2-5 个工作日内到帐，每日最多提现2次</span>
            </div>
           <?php $this->endWidget(); ?>
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
<script>
$(function(){
    $("#checked").attr("checked","checked"); 
    var check = new checkNull();
    check.setObj('#title','必须与所填支付宝账号的用户姓名一致!');
    check.setObj('#phone','提现过程中如有问题客服可与您取得联系!');
    
    $(".message").html();
    $("#card").blur(function(){
         var $bank = $("#card").val();
         var patten = new RegExp(/^[1-9]{1}[0-9]{14,19}$/);
         if(!patten.test($bank)){
              $("#cd").attr("class","message");
              $("#cd").html("请输入正确的银行卡号!");
              $("#message").html("");
        }
        if(patten.test($bank)){
            $("#cd").attr("class","success"); 
            $("#cd").html("");
            $("#message").html("");
            $("#message").attr("class","error");
        }
    });
    
    $("#title").blur(function(){
        var $bank = $("#title").val();
        if($bank !== '' && $bank !== '必须与所填支付宝账号的用户姓名一致!'){
            $("#tit").attr("class","success");
            $("#tit").html("");
        }
        if($bank === ''){
            $("#tit").attr("class","errorMessage");
            $("#tit").html("真实姓名 cannot be blank.");
        }
        if($bank === '必须与所填支付宝账号的用户姓名一致!'){
            $("#tle").html("请输入真实姓名!");
        }
    });
    
    $("#money").blur(function(){
        var $bank = $("#money").val();
        if($bank !== ''){
            $("#mon").attr("class","success");
            $("#mon").html("");
            $("#ey").html("");
            $("#message").attr("class","error");
        }
    });
    
    $("#phone").blur(function(){
        var $bank = $("#phone").val();
        if($bank !== ''  && $bank !== '提现过程中如有问题客服可与您取得联系!'){
            $("#pho").attr("class","success");
            $("#ey").attr("class","");
            $("#pho").html("");
            $("#ey").html("");
        }
        var patten = new RegExp(/((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/i);
         if(!patten.test($bank)){
              $("#pho").attr("class","message");
              $("#pho").html("请输入正确电话号码!");
        }
        if(patten.test($bank)){
            $("#pho").attr("class","success"); 
            $("#ey").html("");
            $("#one").html("");
            $("#one").attr("class","error");
        }
    });
    
    $("#remark").blur(function(){
        var $bank = $("#remark").val();
        if($bank !== ''){
            $("#mark").attr("class","success");
            $("#mark").html("");
            $("#rmk").html("");
            $("#rmk").attr("class","error");
        }  
    });
});


function checkNull(){
    this.setObj = function(obj,text){
        $(obj).click(function(){
            $(this).css('color','#000');
            if($(this).val()===text){
                $(this).val('');
            }
        }).blur(function(){
                if($(this).val() === ''){
                    $(this).val(text);
                    $(this).css('color','#a0a0a0');
                }
        });
    };
    this.setDuObj = function(obj,text,targets,targetxt){
        $(obj).keyup(function(){
            $(this).css('color','#000');
            var text = $(this).val();
            var target = $(targets);
            target.html(text);
            if(text === ''){
                $(this).val(text);
                target.html(targetxt);
        }
    }).click(function(){if($(this).val()===text){$(this).val('');};}).blur(function(){
            if($(this).val() === ''){
                $(this).val(text);
                $(this).css('color','#a0a0a0');
            }
        }); 
    };
}
</script>
