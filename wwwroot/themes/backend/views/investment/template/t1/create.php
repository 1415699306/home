<?php
$this->breadcrumbs=array(
    '招商管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'investment',
    '第三步->添加模块',
);
$js = Yii::app()->clientScript;$js->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.validate.min.js');$js->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.metadata.js');
?>

<div class="inner">
    <div  class="modeule">
        <div id="company" class="global">
            <h3>选择公司介绍模块</h3>
            <?php foreach($module['company'] as $key=>$val):?>
            <?php echo CHtml::image($val,$key);?>
            <?php endforeach;?>
        </div>
        <div id="description" class="global">
            <h3>选择项目介绍模块</h3>
            <?php foreach($module['description'] as $key=>$val):?>
            <?php echo CHtml::image($val,$key);?>
            <?php endforeach;?>
        </div>
        <div id="advantage" class="global">
            <h3>选择项目优势模块</h3>
            <?php foreach($module['advantage'] as $key=>$val):?>
            <?php echo CHtml::image($val,$key);?>
            <?php endforeach;?>
        </div>
        <div id="league" class="global">
            <h3>选择项目支持模块</h3>
            <?php foreach($module['league'] as $key=>$val):?>
            <?php echo CHtml::image($val,$key);?>
            <?php endforeach;?>
        </div>
        <div id="introduction" class="global">
            <h3>选择合作介绍模块</h3>
            <?php foreach($module['introduction'] as $key=>$val):?>
            <?php echo CHtml::image($val,$key);?>
            <?php endforeach;?>
        </div>
        <div id="quote" class="global">
            <h3>选择问答模块</h3>
            <?php foreach($module['quote'] as $key=>$val):?>
            <?php echo CHtml::image($val,$key);?>
            <?php endforeach;?>
        </div>
        <div class="button">
            <?php echo CHtml::link('提交','javascript:void(0);',array('class'=>'submit'));?>
        </div>
    </div>
    <div class="display">
        <?php echo CHtml::form('','POST',array('id'=>'signupForm'));?>
        <?php $this->renderPartial('module/company/template');?>
        <?php $this->renderPartial('module/description/template');?>
        <?php $this->renderPartial('module/advantage/template');?>
        <?php $this->renderPartial('module/league/template');?>
        <?php $this->renderPartial('module/introduction/template');?>
        <?php $this->renderPartial('module/quote/template');?>
        <?php echo CHtml::submitButton('保存');?>
        <?php echo CHtml::endForm();?>
    </div>
</div>
<style>
.listImg{width:120px;float:left;text-align: center;}
.listImg img{width:100px; height:60px;border:1px solid #ccc;padding:1px;}
span.error{color: red;font-size: 12px;vertical-align: top;}
.modeule img{width: 280px;height: 150px;border: 1px solid #ccc;padding:1px;cursor: pointer;}
.modeule img:hover{border:1px solid red;}
.button .submit{border: 1px solid #ccc;padding: 5px;display: block;width: 80px;margin: 5px 0;text-align: center;}
.display{display: none;}
div.rows label {float: left;text-align: right;padding-right: 5px;font-size: 12px;font-weight: bold;width: 85px;}
div.global, div.rows{padding: 5px;line-height: 24px;display: block;clear: both;overflow: hidden;}
.MultiFile-label{text-indent: 90px;}
.image{border:1px solid #ccc;margin-bottom: 5px;}
.image img{border: 1px solid #ccc;padding:1px;margin-bottom: 2px;}
.qq-upload-list li {margin: 5px;padding: 5px;line-height: 15px;font-size: 12px;float: left;border: 1px solid;}
.qq-upload-list {margin:0;padding: 0;list-style: disc;float: left;width: 100%;}
.qq-upload-button {display: block;width: 80px;padding:0;text-align: center;background: #880000;border-bottom: 1px solid #ddd;color: #fff;}
.global, .quote, .introduction, .league, .advantage, .company, .description{border: 1px solid #09f;-webkit-box-shadow: inset 0 3px 3px #bae7ff;box-shadow: inset 0 3px 3px #bae7ff;padding:5px;margin-bottom: 5px;}
</style>
<script>
$(document).ready(function(){
   $("#signupForm").validate({errorElement:"span"});
    var ivestments = new ivestment();
    ivestments.removeCache(new Array(<?php echo "'".implode("','",$moduleName)."'";?>));
});
$('.modeule img').click(function(){
    var ivestments = new ivestment();
    var id = $(this).parents().attr('id');
    var val = $(this).attr('alt');
    var border = $(this).attr('style');
    if(typeof border!=="undefined" && border === 'border: 1px solid red;'){
        $(this).css('border','1px solid #ccc');
        ivestments.remove(id,val);
    }else{
        $(this).css('border','1px solid red');
        $(this).siblings('img').css('border','1px solid #ccc');
        ivestments.add(id,val);
    }
});
$('.submit').click(function(){
    var dosubmit = false;
    var ivestments = new ivestment();
    $('div.global img').each(function(){
        var border = $(this).attr('style');
        if(typeof border!=="undefined"){
            dosubmit = true;        
            return false;         
        }
    });
    if(dosubmit){
        ivestments.befoce(new Array(<?php echo "'".implode("','",$moduleName)."'";?>));
    }else{
         $(this).showMsg({'title':'系统消息','msg':'最小选择一个项目!'},'320','100','14');
    }
});

function ivestment(){
    this.add = function(id,val){
        $("div").data(id,val);  
    };
    this.remove = function(id,val){
        $("div").removeData(id,val);  
    };
    this.befoce = function(module){
        $('.modeule').hide();
        $('.display').fadeIn('5000');
        var ivestments = new ivestment();
        len = module.length;
        for(i=0;i<len;++i){
            ivestments.callModule($("div").data(module[i]),module[i]);
        }        
    };   
    this.callModule = function(id,module){
        if(typeof id!=="undefined"){
            var target = $('.display .'+module);
            var len = target.length;
            for(var i=0;i<len;++i){
                if($(target[i]).attr('id')!==id){
                    target[i].remove();
                }
            }
        }else{
            $('.'+module).remove();
        }
    };
    this.removeCache = function(module){
        len = module.length;
        for(i=0;i<len;++i){
                $("div").removeData(module[i]);
        }
    };
}
</script>
