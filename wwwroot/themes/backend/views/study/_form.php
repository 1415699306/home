<?php
$js = Yii::app()->getClientScript();
$js->registerScriptFile('/js/date/WdatePicker.js');
?>

<div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'=>'life-form',
            'enableAjaxValidation'=>false,
            'enableClientValidation'=>true,
            'htmlOptions'=>array(
                'validateOnSubmit'=>true,
                'enctype'=>'multipart/form-data',
            ),
        )); ?>
        <div class="content target">
        <h5>基本信息</h5>
        <div class="row">
            <?php echo $form->labelEx($model,'title'); ?>
            <?php echo $form->dropDownList($model,'category_id',$category,array('onChange'=>'select()')); ?>
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'title'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'discription'); ?>
            <?php echo $form->textArea($model,'discription',array('maxlength'=>255,'cols'=>'52','rows'=>'6')); ?>
            <?php echo $form->error($model,'discription'); ?>
        </div>
        <div class="row" id="author">
            <?php echo $form->labelEx($model,'author'); ?>
            <?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>80,'class'=>'author')); ?>
            <?php echo $form->error($model,'author'); ?>
        </div>
        <div class="row" id="press">
            <?php echo $form->labelEx($model,'press'); ?>
            <?php echo $form->textField($model,'press',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'press'); ?>
        </div>
       <div class="row" id="ptime">
        <?php echo $form->labelEx($model,'ptime'); ?>
        <?php echo $form->textField($model,'ptime',array('class'=>'Wdate','size'=>20,'maxlength'=>80,'onclick'=>"WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'%y-%M-%d'})",'value'=>!$model->isNewRecord ? date('Y-m-d',$model->ptime) : '')); ?>
        <?php echo $form->error($model,'ptime'); ?>
       </div>
       <div class="row" id="pages">
            <?php echo $form->labelEx($model,'pages'); ?>
            <?php echo $form->textField($model,'pages',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'pages'); ?>
        </div>
        <div class="row" id="professor">
            <?php echo $form->labelEx($model,'professor'); ?>
            <?php echo $form->textField($model,'professor',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'professor'); ?>
        </div>
       
        <div class="row" id="vidty">
            <?php echo $form->labelEx($model,'vidty'); ?>
            <?php echo $form->textField($model,'vidty',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'vidty'); ?>
        </div>
        <div class="row" id="video_url">
            <?php echo $form->labelEx($model,'video_url'); ?>
            <?php echo $form->textField($model,'video_url',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'video_url'); ?>
        </div>
        <div class="row" id="video">
            <?php echo $form->labelEx($model,'video'); ?>
            <?php echo $form->textField($model,'video',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'video'); ?>
        </div>
         <div class="row" id="country">
            <?php echo $form->labelEx($model,'country'); ?>
            <?php echo $form->textField($model,'country',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'country'); ?>
        </div>
        <div class="row" id="scholl">
            <?php echo $form->labelEx($model,'scholl'); ?>
            <?php echo $form->textField($model,'scholl',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'scholl'); ?>
        </div>
        <div class="row" id="course">
            <?php echo $form->labelEx($model,'course'); ?>
            <?php echo $form->textField($model,'course',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'course'); ?>
        </div>
        <div class="row" id="suitable">
            <?php echo $form->labelEx($model,'suitable'); ?>
            <?php echo $form->textField($model,'suitable',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'suitable'); ?>
        </div>
        <div class="row" id="cost">
            <?php echo $form->labelEx($model,'cost'); ?>
            <?php echo $form->textField($model,'cost',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'cost'); ?>
        </div>
        </div>
        <div class="content target">
        <h5>基本设置</h5>
        <div class="row">
            <?php echo $form->labelEx($model,'source'); ?>
            <?php echo $form->textField($model,'source',array('size'=>60,'maxlength'=>128)); ?>
            <?php echo $form->error($model,'source'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'tags'); ?>
            <?php echo $form->textField($model,'tags',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'tags'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'recommand'); ?>
            <?php echo $form->RadioButtonList($model,'recommand',array('0'=>'否','1'=>'是'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
            <?php echo $form->error($model,'recommand'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'channel_recommand'); ?>
            <?php echo $form->RadioButtonList($model,'channel_recommand',array('0'=>'否','1'=>'是'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
            <?php echo $form->error($model,'channel_recommand'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo $form->RadioButtonList($model,'status',array('0'=>'开','1'=>'关'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
            <?php echo $form->error($model,'status'); ?>
        </div>
        </div>
        <div class="content target">
        <h5>编辑推荐</h5>
        <div class="row">
            <?php echo $form->labelEx($model->studyContent,'content'); ?>
            <?php $this->widget('ext.widgets.baiduEdit.IBaiduEdit',array('model'=>$model->studyContent,'form'=>$form,'attribute'=>'content','value'=>$newContent));?>
            <?php echo $form->error($model->studyContent,'content'); ?>   
        </div> 
        </div> 
        <div class="content">
        <h5>缩略图设置</h5>
        <div class="row thumb_body">
            <?php $this->widget('ext.widgets.cut.ICutThumb',array('app_id'=>BaseApp::STUDY,'model'=>$model,'folder'=>'study','ext'=>'thumb','thumb'=>!empty($model->thumbs->track_id) ? $model->thumbs->track_id : null));?>  
        </div>
        <div class="row button">
            <?php echo CHtml::submitButton('提交',array('class'=>'button action-create')); ?>
            <?php echo CHtml::button('展开全部',array('id'=>'show'));?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
    </div>
<style>
#show{float: left;padding:4px;margin: 6px;}
.form .action-create{cursor: pointer;float: left;padding:5px;border:1px solid #ccc;}
.form .content{margin: 5px 0;}
.row, .form .content{display: block;overflow: hidden;clear: both;}
.form .row label{width:80px;float: left;}
.form h5, .form h3{border-bottom: 1px dotted #ccc;font-size: 14px;padding: 5px;text-shadow: 0px 1px 0px #fff;background: #bae7ff;}
.form h3{background:#e7e7e7;padding: 0px 3px;}
div.row label {float: left;text-align: right;padding-right: 5px;font-size: 12px;font-weight: bold;width: 90px;}
.form .row label, .form .row span li label{line-height: 20px;}
.form .row label, .form .row span li, .form .row span li input{float: left;}
.form .row label{width: 80px;}
.form .row li{list-style: none;}
.form .row span li{width:50px;}
.form .row span li label{width: auto;background: none;}
.form .row span li label.big_label{width: 35px;background: none;}
.form .row span li input{padding: 0; margin: 2px;}
.form .row em{font-size: 12px;line-height: 20px;color: #ccc;}
.qq-upload-button {display: block;width: 80px;padding:0;text-align: center;background: #880000;border-bottom: 1px solid #ddd;color: #fff;top:4px;}
.qq-upload-list li {margin: 5px;padding: 5px;line-height: 15px;font-size: 12px;float: left;border: 1px solid;width: 200px;background: #ccc;}
.qq-upload-list li a{border:none;background: none;}
.submit, .row .row a {border-radius: 5px;cursor: pointer;background:none;background-position: 5px;border: none;padding: 0;text-indent: 1.2em;}
.thumb_body h3{padding: 5px;}
.qq-upload-list {margin:0;padding: 0;list-style: disc;float: left;width: 100%;position: absolute;top:-3px;right: 300px;}
.qq-uploader {position: relative;width: 100%;margin: 5px 0;}
</style>
<script type="text/javascript">
    function select()
    {
        var str = $("#Study_category_id").val();
        if(str === '87'){
            $("#professor").css('display','block');
            $("#vidty").css('display','block');
            $("#video").css('display','block'); 
            $("#video_url").css('display','block'); 
            $("#author").css('display','none');
            $("#press").css('display','none');
            $("#ptime").css('display','none');
            $("#pages").css('display','none');
            $("#scholl").css('display','none');
            $("#course").css('display','none');
            $("#suitable").css('display','none');
            $("#cost").css('display','none');
            $("#country").css('display','none');
              
        }
        
        if(str === '88'){
          $("#author").css('display','block');
          $("#press").css('display','block');
          $("#ptime").css('display','block');
          $("#pages").css('display','block');
          $("#professor").css('display','none');
          $("#vidty").css('display','none');
          $("#video").css('display','none');
          $("#format").css('display','none');
          $("#scholl").css('display','none');
          $("#course").css('display','none');
          $("#suitable").css('display','none');
          $("#cost").css('display','none');
          $("#country").css('display','none');
          $("#video_url").css('display','none');
       }
       
       if(str === '89'){
            $("#professor").css('display','block'); 
            $("#video").css('display','block');
            $("#video_url").css('display','block');
            $("#format").css('display','block');
            $("#vidty").css('display','none');
            $("#author").css('display','none');
            $("#press").css('display','none');
            $("#ptime").css('display','none');
            $("#pages").css('display','none');
            $("#scholl").css('display','none');
            $("#course").css('display','none');
            $("#suitable").css('display','none');
            $("#cost").css('display','none');
            $("#country").css('display','none');
       }
       
       if(str === '90'){
          $("#country").css('display','block');
          $("#scholl").css('display','block');
          $("#course").css('display','block');
          $("#suitable").css('display','block');
          $("#cost").css('display','block');
          $("#author").css('display','none');
          $("#press").css('display','none');
          $("#ptime").css('display','none');
          $("#pages").css('display','none');
          $("#professor").css('display','none');
          $("#vidty").css('display','none');
          $("#video").css('display','none');
          $("#format").css('display','none');
          $("#video_url").css('display','none');
       }
 }    
     $(function(){
          var str = $("#Study_category_id").val();
          if(str == '87'){
                $("#author").css('display','none');
                $("#press").css('display','none');
                $("#ptime").css('display','none');
                $("#pages").css('display','none');
                $("#professor").css('display','block');
                $("#vidty").css('display','block');
                $("#video").css('display','block'); 
                $("#scholl").css('display','none');
                $("#course").css('display','none');
                $("#suitable").css('display','none');
                $("#cost").css('display','none');
                $("#country").css('display','none');
                $("#video_url").css('display','block');
        }
        
        if(str == '88'){
            $("#author").css('display','block');
            $("#press").css('display','block');
            $("#ptime").css('display','block');
            $("#pages").css('display','block');
            $("#professor").css('display','none');
            $("#vidty").css('display','none');
            $("#video").css('display','none');
            $("#format").css('display','none');
            $("#scholl").css('display','none');
            $("#course").css('display','none');
            $("#suitable").css('display','none');
            $("#cost").css('display','none');
            $("#country").css('display','none');
            $("#video_url").css('display','none');
        }
        
        if(str == '89'){
            $("#professor").css('display','block'); 
            $("#video").css('display','block');
            $("#video_url").css('display','block');
            $("#format").css('display','block');
            $("#vidty").css('display','none');
            $("#author").css('display','none');
            $("#press").css('display','none');
            $("#ptime").css('display','none');
            $("#pages").css('display','none');
            $("#scholl").css('display','none');
            $("#course").css('display','none');
            $("#suitable").css('display','none');
            $("#cost").css('display','none');
            $("#country").css('display','none');
            
        }
        
        if(str == '90'){
          $("#country").css('display','block');
          $("#scholl").css('display','block');
          $("#course").css('display','block');
          $("#suitable").css('display','block');
          $("#cost").css('display','block');
          $("#author").css('display','none');
          $("#press").css('display','none');
          $("#ptime").css('display','none');
          $("#pages").css('display','none');
          $("#professor").css('display','none');
          $("#vidty").css('display','none');
          $("#video").css('display','none');
          $("#format").css('display','none');
          $("#video_url").css('display','none');
        }
});
$('#setSource').click(function(){
    $('#source').val('http://www.lfeel.com');
});
$('#show').click(function(){
   $('.target').show(); 
});
</script>