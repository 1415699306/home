



<?php
$js = Yii::app()->getClientScript();
$js->registerScriptFile('/js/profile.js');
$js->registerCssFile(Yii::app()->theme->baseUrl.'/css/dreampay.css');
$this->pageTitle=Yii::app()->name . ' - 提交订单';
?>
<div class='FloatLeft'>
        <div class='MainDiv' style="width:854px;">
            <div class='bigDiv subDiv'>
                <div class='subtitle caption'><?php echo CHtml::encode($model->dream->title);?></div>
               <h1 style=" font-size:14px;">您支持金额:<span>￥<i><?php echo $model->money;?></i></span>元</h1>
            	<span>回报内容</span>
                <ul class="Report">
                	<li><?php echo CHtml::encode($model->discription);?></li>
                </ul>
                <div class="adrees">
                <span class="title">选择送货地址（必填）</span>
                <div class="center">
                    <?php foreach($address as $key):?>
                <div class="checked">
                    <ul id="address_<?php echo $key->id;?>" class="address_confirm">
                        <li><i>姓名</i><span class="name"><?php echo CHtml::encode($key->name);?></span></li>
                        <li><i>电话</i><span class="phone"><?php echo $key->phone;?></span></li>
                        <li><i>邮编</i><span class="zip_code"><?php echo $key->zip_code;?></span></li>
                        <span class="hidden_id"><?php echo $key->id;?></span>
                        <li class="last"><i>地址</i><span class="province"><?php echo CHtml::hiddenField('province_hide',$key->province,array('class'=>'province_hide'));?><?php echo Params::getProvince($key->province);?></span><span class="city"><?php echo CHtml::hiddenField('city_hide',$key->city,array('class'=>'city_hide'));?><?php echo Params::getCity($key->city);?></span><span class="address"><?php echo CHtml::encode($key->address);?></span></li>
                    </ul>
                <div class="alter">
                    <a href="javascript:void(0);" id="updateAddress" aid="<?php echo $key->id;?>">修改</a> 
                    <a href="javascript:void(0);" id="deleteAddress" aid="<?php echo $key->id;?>">删除</a>
                 </div>
                 </div>
                    <?php endforeach;?>
                    <form id="profile-form" name="profile">
                 <div class="checked">
                <div class="define">
   					<div class="row1"><label class="Forname">姓名</label><input id="edit_name" name="PublicDeliveryAddress[name]" class="inputbox" type="text"></div>
                    <div class="row1"><label class="Forname">电话</label><input id="edit_phone" name="PublicDeliveryAddress[phone]" class="inputbox" type="text"></div>
                    <div class="row1"><label class="Forname">邮编</label><input id="edit_zip_code" name="PublicDeliveryAddress[zip_code]" class="inputbox" type="text"></div>
                    <div class="row1"><label class="Forname">地址</label>
                    <select name="first" class="selected" id="province"><option value="请选择">请选择</option></select>
                    <select name="first" class="selected" id="city"><option value="请选择">请选择</option></select>
                    <SCRIPT language=javascript>InitCitySelect(document.profile.province,document.profile.city);</SCRIPT>
                    <input class="inputbox inputbox_1" id="edit_address" name="PublicDeliveryAddress[address]" type="text">
                  </div>
                </div><div class="alter">
                <input type="submit" value="确定" class="btn" id="create"/>
                <a href="#">新增收货地址</a>
                </div>
                 </div>
                    </form>
					</div>
                    <div class="row1">
                	<span class="title" style=" height:30px; line-height:30px;">备注（选填）</span><input type="text" class="remark"/>
                </div>
                </div>
                
            </div>
            <div class='bigDiv subDiv'>
                <h1 style=" font-size:14px;">账户余额:<span>￥<i><?php echo UserAccount::getBalance();?></i></span>元</h1>
               <div class='row'>
                 <input type="button" value="账户支付" class="btn" id="account">
              </div>
              <div class="choose choose_1">支付宝支付：</div>
              <div class="zfb"></div>
              <div class='row'>
                  <input type="button" value="支付宝支付" class="btn" id="alipay">
              </div>
              <div class='choose'>网银直接支付：</div>
               <ul class='banklist'>
               	<li class='bank_1'><input type="radio" name="bank" value="Merchants" class=' Single_box '/>招商银行</li>
                <li class='bank_2'><input type="radio" name="bank" value="Merchants" class='Single_box '/>工商银行</li>
                <li class='bank_3'><input type="radio" name="bank" value="Merchants" class='Single_box '/>中国建设银行</li>
                <li class='bank_4'><input type="radio" name="bank" value="Merchants" class=' Single_box '/>浦发银行</li>
                <li class='bank_5'><input type="radio" name="bank" value="Merchants" class='Single_box '/>中国农业银行</li>
                <li class='bank_6'><input type="radio" name="bank" value="Merchants" class='Single_box '/>中国民生银行</li>
                <li class='bank_7'><input type="radio" name="bank" value="Merchants" class=' Single_box '/>交通银行</li>
                <li class='bank_8'><input type="radio" name="bank" value="Merchants" class='Single_box '/>中国银行</li>
                <li class='bank_9'><input type="radio" name="bank" value="Merchants" class='Single_box '/>广发银行</li>
                <li class='bank_10'><input type="radio" name="bank" value="Merchants" class=' Single_box '/>兴业银行</li>
                <li class='bank_11'><input type="radio" name="bank" value="Merchants" class='Single_box '/>中国光大银行</li>
                <li class='bank_12'><input type="radio" name="bank" value="Merchants" class='Single_box '/>中兴银行</li>
                 <li class='bank_13'><input type="radio" name="bank" value="Merchants" class='Single_box '/>深圳发展银行</li>
                <li class='bank_14'><input type="radio" name="bank" value="Merchants" class='Single_box '/>平安银行</li>
               </ul>
               <div class="buttom">
                    <input type="submit" value="网银支付" class="save" id="unionpay">
                </div><br />       
        </div>
          </div>
        </div>
<script>
jQuery(function($){ 
    $("div").removeData("id"); 
    $("div").removeData("confirm_id");
    $("div").data("alipay",true);
    $('#create').click(function(){
        var doSubmit = true;
        var errorMsg = new Array();
        var error = ({'border':'1px solid red'});       
        var success = ({'border':'1px solid green'});
        var name = $('#edit_name');
        var phone =  $('#edit_phone');
        var zip_code = $('#edit_zip_code');
        var address = $('#edit_address');
        var province = $('#province');
        var city = $('#city');
        var reg_number = /^[0-9]*$/;
        var reg_phone = /((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/i;
        var reg_zip_code = /^[0-9]{6,6}$/;
        if(name.val() === ''){        
            name.css(error);
            errorMsg['0']='姓名不能为空!';
            doSubmit = false;
        }else if(name.val().match(reg_number)){
            name.css(error);
            errorMsg['0']='姓名不能为纯数字!';
            doSubmit = false;
        }else{
            name.css(success);
        }
        if(phone.val() === ''){
            phone.css(error);
             errorMsg['1']='电话号码不能为空!';
            doSubmit = false;
        }else if(!phone.val().match(reg_phone)){
            phone.css(error);       
            errorMsg['1']='电话号码格式不正确!';
            doSubmit = false;
        }else{
            phone.css(success);
        }
        if(zip_code.val() === ''){
            zip_code.css(error);
            errorMsg['2']='邮编不能为空!';
            doSubmit = false;
        }else if(!zip_code.val().match(reg_zip_code)){
            zip_code.css(error);       
            errorMsg['2']='邮编格式不正确!';
            doSubmit = false;
        }else{
            zip_code.css(success);
        }
        if(address.val() === ''){
            address.css(error);
            errorMsg['3']='地址不能为空!';
            doSubmit = false;
        }else{
            address.css(success);
        }
        if(province.val() === '000000'){
            province.css(error);
            errorMsg['4']='请选择省份!';
            doSubmit = false;
        }else{
            province.css(success);
        }
        if(province.val() === '000000'){
            city.css(error);
            errorMsg['5']='请选择城市!';
            doSubmit = false;
        }else{
            city.css(success);
        }
        if(doSubmit === true){
            post($("div").data("id"));          
        }else{
            var len = errorMsg.length;
            var content = '';
            for(var i=0;i<len;++i){              
                if(typeof(errorMsg[i])!=='undefined'){
                    content += (i+1)+'.<em style="color:red;font-style: normal;">'+errorMsg[i]+'</em><br \>';
                }
            }
            var p = new showMsg.Person('showMsg','请更正以下错误','300','auto','null','关闭');
            p.beforce('commantEsay',content);
        }
        return false;
        
    });
    
    $('#updateAddress').live('click',function(){
        var btn = $('#create');
        var that = $(this);
        var target = $('#address_'+that.attr('aid')+'');
        var name = $(target).find('.name').html();
        var phone = $(target).find('.phone').html();
        var zip_code = $(target).find('.zip_code').html();
        var address = $(target).find('.address').html();
        var id =  $(target).find('.hidden_id').html();
        var province = $(target).find('.province_hide').val();
        var city = $(target).find('.city_hide').val();
        btn.val('修改');
        $('#edit_name').val(name);
        $('#edit_phone').val(phone);
        $('#edit_zip_code').val(zip_code);
        $('#edit_address').val(address);
        FillCitys(g_selCity,city);
         $('#province option').each(function(i){
            if($(this).val()===province){
                $(this).attr('selected','selected');
                FillCitys(g_selCity,city);
            }
        });
        $("div").data("id",id);
    });
    
    var post = function(id){ 
            var msg = registerMsg();
            $.ajax({
                type: "POST",
                dataType:'json',
                url: getUrl(id),
                data: ({'PublicDeliveryAddress[province]':$('#province').val(),'PublicDeliveryAddress[city]':$('#city').val(),'PublicDeliveryAddress[name]':$('#edit_name').val(),'PublicDeliveryAddress[phone]':$('#edit_phone').val(),'PublicDeliveryAddress[zip_code]':$('#edit_zip_code').val(),'PublicDeliveryAddress[address]':$('#edit_address').val(),'YII_CSRF_TOKEN':'<?php echo Yii::app()->request->getCsrfToken();?>'}),
                beforeSend:function(){
                    msg.beforce('loading');
                },
                success: function(xhr){
                  var msg = new showMsg.Person('showMsg','系统消息','300','100','null','关闭');
                  if(xhr.code==='1'){
                        msg.beforce('commantEsay','保存成功!');
                        showMsg.Person.prototype.callBack = function(){
                            location.reload();
                        };
                  }else{
                      msg.beforce('commantEsay','保存失败!');
                  }
                }
             });
            return false;    
    };
    
    var getUrl=function(id){
        if(0 < id){
            return "/usercenter/payment/address/type/"+id;
        }else{
            return "/usercenter/payment/address";
        };
    };
    
    $('#deleteAddress').live('click',function(){
        var id = $(this).attr('aid');
        var msg = registerMsg();
        if(0 < id){
            $.ajax({
                type: "POST",
                dataType:'json',
                url: "/usercenter/payment/addressdelete",
                data: ({'id':id,'YII_CSRF_TOKEN':'<?php echo Yii::app()->request->getCsrfToken();?>'}),
                beforeSend:function(){
                    msg.beforce('loading','保存成功!');
                },
                success: function(xhr){
                  if(xhr.code==='1'){
                        msg.beforce('commantEsay','删除成功!');
                        showMsg.Person.prototype.callBack = function(){
                            location.reload();
                        };
                  }else{
                      msg.beforce('commantEsay','删除失败!');
                  }
                }
             });
        }
        return false;
    });
    
    $('.address_confirm').click(function(){
        var msg = registerMsg();
        var id = parseInt($(this).find('span.hidden_id').text());
        if(0 < id){
           $("div").data("confirm_id",id);
           $(this).css({'border':'1px solid #1e94f0','background':'#f9fef8 url(/themes/usercenter/images/uic_07.jpg) no-repeat right bottom'}).parent().siblings().find('.address_confirm').css({'border':'1px solid #ccc','background':'#fff'});
        }else{
            msg.beforce('commantEsay','地址选择失败!请重新选择！');
        }
    });
    
    $('#alipay').click(function(){
        var msg = registerMsg();
        var id = $("div").data("confirm_id");      
        var check = $("div").data("alipay");
        if(typeof(id)!=='undefined' && 0 < id){
            if(confirm('确定要进行支付吗?')){
                $("div").data("alipay",false);
                if(check === true){
                    var buy = new showMsg.Person('showMsg','请你在新打开的网银或第三方支付页面上完成付款','590','130','null','关闭');
                    var content = '<div style="margin:10px;">付款后请选择:</div><ul style="margin:10px;overflow:hidden;height:60px;border-bottom:1px solid #ccc;"><li><div class="ui-button ui-button-public"><a href="/usercenter/account">支付成功</a></div><div class="ui-button ui-button-public"><a href="#ui_confirm_popup" class="ui-action-hide">返回重新选择支付方式</a></div></li></ul>';
                    buy.beforce('commantEsay',content,true);
                    window.open('/usercenter/payment/alipay/order/'+<?php echo Yii::app()->request->getParam('order');?>+'/address/'+id);
                }
            }
        }else{
            msg.beforce('commantEsay','请选择地址！');
        }
    });
    
    $('#account').click(function(){ 
        var msg = registerMsg();
        var id = $("div").data("confirm_id");      
        var check = $("div").data("alipay");
        if(typeof(id)!=='undefined' && 0 < id){
            if(confirm('确定要进行支付吗?')){
                $("div").data("alipay",false);
                if(check === true){
                    $.ajax({
                        type: "POST",
                        url: "/usercenter/payment/account",
                        dataType:"json",
                        beforeSend:function(){
                            msg.beforce('loading',true);
                        },
                        data: ({'address':id,'order':'<?php echo Yii::app()->request->getParam('order');?>','YII_CSRF_TOKEN':'<?php echo Yii::app()->request->getCsrfToken();?>'}),
                        success: function(xhr){
                          if(xhr.code==='1'){
                              msg.beforce('commantEsay','支付成功!点击关闭后进入个人账户页面!',true);
                              showMsg.Person.prototype.callBack = function(){
                                 window.location = '/usercenter/account';
                            };
                          }else{
                              msg.beforce('commantEsay',xhr.msg);
                              $("div").data("alipay",true);
                          }
                        }
                     });
                 }
            }
        }else{
            msg.beforce('commantEsay','请选择地址！');
        } 
    });  
    
    var registerMsg = function(){
        return new showMsg.Person('showMsg','系统消息','300','100','null','关闭');
    };
});
</script>
<style>
.subDiv{ width:987px;}
</style>