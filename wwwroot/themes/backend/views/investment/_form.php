<?php
$js = Yii::app()->getClientScript();
$js->registerScriptFile('/js/date/WdatePicker.js');
$js->registerScriptFile('/js/jcrop/jquery.Jcrop.min.js');
$js->registerScript("#{$this->id}","
    function template(module,id){
        $('.'+module).each(function(){
            if($(this).attr('id')!==id){
                $(this).remove();
            }
        });
    }
");
$js->registerScript("#image","
    $('.listImg span.delete').click(function(){
        var that = $(this);
        var url = that.attr('url');       
        var btnFn = function(){            
            $.ajax({
                type: 'GET',
                url: '/api/upload/delete',
                dataType: 'json',
                data:'route='+url,
                success:function(msg){
                    if(msg.code === '1'){
                        that.parent().remove();
                    }
                }
              });
                easyDialog.close();
                return false;
          };
        easyDialog.open({
          container : {
                header : '确认消息',
                content : '确定要删除此图片吗?',
                yesFn : btnFn,
                noFn : true,
                noText : '关闭',
                overlay : true
          },
          overlay:false
        });
        $('.easyDialog_text').css({'height':'100px','width':'300px','vertical-align':'middle','display':'table-cell','font-size':'14px'});
    });
");
?>
<link rel="stylesheet" href="/js/jcrop/jquery.Jcrop.min.css" type="text/css" />
<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'investment-form',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
        'htmlOptions'=>array(
            'enctype'=>'multipart/form-data',
        ),
    )); ?>
    <h5>项目相关</h5>
    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->dropDownList($model,'category_id',$category); ?>
        <?php echo $form->textField($model,'name',array('size'=>'60','maxlength'=>'128')); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>
	<div class="row">
        <?php echo $form->labelEx($model,'unit'); ?>
        <?php echo $form->textField($model,'unit',array('size'=>'60','maxlength'=>'32')); ?>
        <?php echo $form->error($model,'unit'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'maney'); ?>
        <?php echo $form->textField($model,'maney',array('size'=>'60','maxlength'=>'11')); ?>
        <?php echo $form->error($model,'maney'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'discription'); ?>
        <?php echo $form->textArea($model,'discription',array('rows'=>'5','cols'=>'50','maxlength'=>'1024')); ?>
        <?php echo $form->error($model,'discription'); ?>
    </div>
    <h5>联系方式</h5>
    <div class="row">
        <?php echo $form->labelEx($model,'contacts'); ?>
        <?php echo $form->textField($model,'contacts',array('size'=>'30','maxlength'=>'32')); ?>
        <?php echo $form->error($model,'contacts'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'tel'); ?>
        <?php echo $form->textField($model,'tel',array('size'=>'30','maxlength'=>'16')); ?>
        <?php echo $form->error($model,'tel'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>'30','maxlength'=>'32')); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'address'); ?>
        <?php echo $form->textField($model,'address',array('size'=>'60','maxlength'=>'256')); ?>
        <?php echo $form->error($model,'address'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'website'); ?>
        <?php echo $form->textField($model,'website',array('size'=>'60','maxlength'=>'128')); ?>
        <?php echo $form->error($model,'website'); ?>
    </div>
    <h5>SEO相关</h5>
    <div class="row">
        <?php echo $form->labelEx($model,'seo_keyword'); ?>
        <?php echo $form->textField($model,'seo_keyword',array('size'=>'60','maxlength'=>'128')); ?>
        <?php echo $form->error($model,'seo_keyword'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'seo_discription'); ?>
        <?php echo $form->textArea($model,'seo_discription',array('rows'=>'5','cols'=>'50','maxlength'=>'1024')); ?>
        <?php echo $form->error($model,'seo_discription'); ?>
    </div>
    <h5>附加设置</h5>
    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->radioButtonList($model,'status',array('0'=>'开启','1'=>'关闭'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'message'); ?>
        <?php echo $form->radioButtonList($model,'message',array('0'=>'开启','1'=>'关闭'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
        <?php echo $form->error($model,'message'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'recommand'); ?>
        <?php echo $form->radioButtonList($model,'recommand',array('0'=>'关闭','1'=>'开启'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
        <?php echo $form->error($model,'recommand'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'channel_recommand'); ?>
        <?php echo $form->radioButtonList($model,'channel_recommand',array('0'=>'关闭','1'=>'开启'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
        <?php echo $form->error($model,'channel_recommand'); ?>
    </div>
   
    <div class="row">
        <?php echo $form->labelEx($model,'deadline'); ?>
        <?php echo $form->textField($model,'deadline',array('class'=>'Wdate','size'=>20,'maxlength'=>80,'onclick'=>"WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'%y-%M-%d'})",'value'=>!$model->isNewRecord ? date('Y-m-d',$model->deadline) : '')); ?>
        <?php echo $form->error($model,'deadline'); ?>
    </div>
     <h5>头部横幅图片</h5>
    <div class="row topbar">
        <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                'id'=>'Investment',
                'config'=>array(
                       'action'=>Yii::app()->createUrl('/api/upload/ajaxupload/type/investment/?ext=topbar'),
                       'allowedExtensions'=>array("jpg","jpeg","gif",'png'),
                       'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                       'minSizeLimit'=>1,// minimum file size in bytes
                       'maxConnections'=>1,
                        'multiple'=>true,
                    'onSubmit'=>"js:function(id, fileName){
                             var len = $('.topbar .listImg').length;
                             if(len > 0){
                                 $('.topbar .qq-upload-button').css('background','#ccc');
                                 $('.topbar .qq-upload-button').click(function(){return false;});
                                 $(this).showMsg({title:'系统消息',msg:'超出数量限制'});
                                 return false;
                             }                          
                         }",
                       'onComplete'=>"js:function(id, fileName, responseJSON){
                                $('#Investment').append('<div class=listImg><img src='+responseJSON.image+' /></div>');
                                $('#Investment').append('<input type=hidden name=Investment[top_bar] value='+responseJSON.filename+' />');
                        }",
                       'showMessage'=>"js:function(message){ alert(message); }"
                      ),
            )); ?>        
        <?php echo $form->error($model,'top_bar'); ?>
        <?php if(!$model->isNewRecord && !empty($model->top_bar)):?>
        <div class='listImg'>
            <img src='<?php echo '/'.RESOURCE.'/investment/topbar/'.$model->top_bar;?>' width='320' height='240' />
            <span class="delete" url="<?php echo '/'.RESOURCE.'/investment/topbar/'.$model->top_bar;?>">删除</span>
        </div>
        <?php endif;?>
    </div>
    <h5>缩略图设置</h5>
    <div class="row thumb_body">
        <?php $this->widget('ext.widgets.cut.ICutThumb',array('app_id'=>BaseApp::INVESTMENT,'model'=>$model,'folder'=>'investment','ext'=>'thumb'));?>  
    </div>
    <?php if($model->type==0 && !$model->isNewRecord):?>
        <?php foreach($model->investmentMod as $key):?>
            <?php $params = CJSON::decode($key->attributes['mod']);?>
            <div class="row">
                <?php foreach ($params as $v):?>
                <?php if(isset($v['template_id'])):?>
                <?php $keys = array_keys($params);?>
                <?php $this->renderPartial("module/{$keys[0]}/template",array('params'=>$params));?>
                <?php $js->registerScript("#{$keys[0]}","
                    template('".$keys[0]."','".$v['template_id']."');
                ");?>
                <?php endif;?>
                <?php endforeach;?> 
            </div>
        <?php endforeach;?>
    <?php endif;?>
    <div class="row">
        <?php echo CHtml::submitButton($_GET['id'] == 1 ? '保存' : '下一步');?>
    </div>
    <?php $this->endWidget(); ?>
</div>
<style>
.row label{width:80px;float: left;}
.form h5, .form h3{border-bottom: 1px dotted #ccc;font-size: 14px;padding: 5px;text-shadow: 0px 1px 0px #fff;background: #bae7ff;}
.form h3{background:#e7e7e7;padding: 0px 3px;}
div.row label {float: left;text-align: right;padding-right: 5px;font-size: 12px;font-weight: bold;width: 90px;}
.row label, .row span li label{line-height: 20px;}
.row label, .row span li, .row span li input{float: left;}
.row label{width: 80px;}
.row li{list-style: none;}
.row span li{width:50px;}
.row span li label{width: auto;background: none;}
.row span li label.big_label{width: 35px;background: none;}
.row span li input{padding: 0; margin: 2px;}
.row em{font-size: 12px;line-height: 20px;color: #ccc;}
.qq-upload-button {display: block;width: 80px;padding:0;text-align: center;background: #880000;border-bottom: 1px solid #ddd;color: #fff;}
.qq-upload-list li {margin: 5px;padding: 5px;line-height: 15px;font-size: 12px;float: left;border: 1px solid;}
.qq-upload-list {margin:0;padding: 0;list-style: disc;float: left;width: 100%;}
.qq-uploader {position: relative;width: 100%;margin: 5px 0;}
</style>