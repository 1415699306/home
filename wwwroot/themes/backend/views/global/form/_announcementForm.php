<?php
$js = Yii::app()->getClientScript();
$js->registerScriptFile('/js/ueditor/editor_config.js');
$js->registerScriptFile('/js/ueditor/editor_all_min.js');
$js->registerCssFile('/js/ueditor/themes/default/ueditor.css');
$js->registerScriptFile('/js/date/WdatePicker.js');
?>
<div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'=>'user-form',
            'enableAjaxValidation'=>false,
            'enableClientValidation'=>true,
            'htmlOptions'=>array(
                'validateOnSubmit'=>true,
                ),
        )); ?>
        <div class="row">
            <?php echo $form->labelEx($model,'title'); ?>
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'title'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'content'); ?>
            <?php echo $form->textArea($model,'content',array('id'=>'editor_id','value'=>$newContent)); ?>
            <?php echo $form->error($model,'content'); ?>
        </div>  
        <div class="row">
            <?php echo $form->labelEx($model,'url'); ?>
            <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'url'); ?>
            <em>当连接地址被设置时,系统将优先跳转到指到定页面,详细内容页将会失效!</em>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'expiration_time'); ?>
            <?php echo $form->textField($model,'expiration_time',array('class'=>'Wdate','size'=>20,'maxlength'=>80,'onclick'=>"WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'%y-%M-%d'})",'value'=>!$model->isNewRecord ? date('Y-m-d',$model->expiration_time) : '')); ?>
            <?php echo $form->error($model,'expiration_time'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'type'); ?>
            <?php echo $form->RadioButtonList($model,'type',array('0'=>'前端','1'=>'后台'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
            <?php echo $form->error($model,'type'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo $form->RadioButtonList($model,'status',array('0'=>'开','1'=>'关'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
            <?php echo $form->error($model,'status'); ?>
            <em>如果关闭公告,系统将无视过期时间,公告会被隐藏!</em>
        </div>
        <div class="row button">
            <?php echo CHtml::submitButton('提交',array('class'=>'button action-create')); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
<script type="text/javascript">
    var editor = new baidu.editor.ui.Editor({
        imageUrl:"/api/upload/editor/?YII_CSRF_TOKEN=<?php echo Yii::app()->request->getCsrfToken();?>",
        toolbars:[
            ['fullscreen', 'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch','autotypeset', '|',
                'blockquote', '|', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist','selectall', 'cleardoc', '|', 'customstyle',
                'paragraph', '|','rowspacingtop', 'rowspacingbottom','lineheight', '|','fontfamily', 'fontsize', '|',
                'directionalityltr', 'directionalityrtl', '|', '', 'indent', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|',
                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright',
                'imagecenter', '|', 'insertimage', 'insertvideo','insertframe','pagebreak', '|',
                'horizontal', 'date', 'time', 'spechars','snapscreen', 'wordimage', '|',
                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', '|',
                'searchreplace']
        ]
    });
    editor.render("editor_id");
     $('form').submit(function(){
         var doSubmit = true;
         if(editor.getContent()==''){
             alert('内容和url不能同时为空!');
             $('#edui1').css({"border":"1px solid red"});
            doSubmit = false;
         }
         return doSubmit;
     });
</script>
<style>
div.row label {float: left;text-align: right;padding-right: 5px;font-size: 12px;font-weight: bold;width: 80px;}
.row label, .row span li label{line-height: 20px;}
.row label, .row span li, .row span li input{float: left;}
.row label{width: 80px;}
.row li{list-style: none;}
.row span li{width:50px;}
.row span li label{width: auto;background: none;}
.row span li label.big_label{width: 35px;background: none;}
.row span li input{padding: 0; margin: 2px;}
.row em{font-size: 12px;line-height: 20px;color: #ccc;}
</style>