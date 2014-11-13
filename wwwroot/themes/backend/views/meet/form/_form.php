<?php
$js = Yii::app()->getClientScript();
$js->registerScriptFile('/js/date/WdatePicker.js');
?>
<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'meet-form',
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
    <?php echo $form->dropDownList($model,'category_id',$category); ?>
    <?php echo $form->textField($model,'title',array('size'=>'60','maxlength'=>'128')); ?>
    <?php echo $form->error($model,'title'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'theme_name'); ?>
    <?php echo $form->textField($model,'theme_name',array('size'=>'60','maxlength'=>'128')); ?>
    <?php echo $form->error($model,'theme_name'); ?>
</div>
</div>
<div class="content target">
<h5>基本设置</h5>
<div class="row">
    <?php echo $form->labelEx($model,'people_number'); ?>
    <?php echo $form->textField($model,'people_number'); ?>
    <?php echo $form->error($model,'people_number'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'start_time'); ?>
    <?php echo $form->textField($model,'start_time',array('class'=>'Wdate','size'=>20,'maxlength'=>80,'onclick'=>"WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'%y-%M-%d'})",'value'=>!$model->isNewRecord ? date('Y-m-d',$model->start_time) : '')); ?>
    <?php echo $form->error($model,'start_time'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'off_time'); ?>
    <?php echo $form->textField($model,'off_time',array('class'=>'Wdate','size'=>20,'maxlength'=>80,'onclick'=>"WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'%y-%M-%d'})",'value'=>!$model->isNewRecord ? date('Y-m-d',$model->off_time) : '')); ?>
    <?php echo $form->error($model,'off_time'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'locale'); ?>
    <?php echo $form->textField($model,'locale'); ?>
    <?php echo $form->error($model,'locale'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'discription'); ?>
    <?php echo $form->textArea($model,'discription',array('rows'=>'5','cols'=>'50','maxlength'=>'1024')); ?>
    <?php echo $form->error($model,'discription'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'status'); ?>
    <?php echo $form->RadioButtonList($model,'status',array('0'=>'开','1'=>'关'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
    <?php echo $form->error($model,'status'); ?>
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
</div>
<div class="content target">
<h5>文章内容</h5>
<div class="row">
    <?php echo $form->labelEx($model->meetContent,'content'); ?>
<?php $this->widget('ext.widgets.baiduEdit.IBaiduEdit',array('model'=>$model->meetContent,'form'=>$form,'attribute'=>'content','value'=>$newContent));?>
    <?php echo $form->error($model->meetContent,'content'); ?>
</div>
</div>
<!--<div class="content target">
<div class="row">
    <label>已报名</label>
    <div class="eminentList">
        <?php if(!$model->isNewRecord && !empty($relation)):?>
        <?php foreach ($relation as $data):?>
        <ul id='eminent_<?php echo $data->eminentPerson->id;?>'>
            <li><img src='<?php echo $data->eminentPerson->avatarImage->track_id;?>' alt='<?php echo $data->eminentPerson->name;?>' width='50' height='50'></li>
            <span><input type='hidden' name='EminentRelation[<?php echo $data->eminentPerson->id;?>]'/><em><?php echo $data->eminentPerson->name;?></em></span>
        </ul>
        <?php endforeach;?>
    <?php else:?>
        <p>数据未添加</p>
    <?php endif;?>
    </div>
</div>
</div>
<div class="content target">
<div class="row">
    <label>添加名人</label>
    <div class="list" style="position: relative;z-index: 300;">
        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'pager'=>array('header'=>false),
            'itemView'=>'_eminentlist',   // refers to the partial view named '_post'
            'viewData'=>array('model'=>$model),
        ));
        ?>
    </div>
</div>
</div>-->
    <div class="content">
    <h5>缩略图设置</h5>
    <div class="row thumb_body">
        <?php $this->widget('ext.widgets.cut.ICutThumb',array('app_id'=>BaseApp::MEET,'model'=>$model,'folder'=>'meet','ext'=>'thumb','thumb'=>!empty($model->thumbs->track_id) ? $model->thumbs->track_id : null));?>  
    </div>
    </div>
        <div class="row button">
            <?php echo CHtml::submitButton('提交',array('class'=>'button action-create')); ?>
            <?php echo CHtml::button('展开全部',array('id'=>'show'));?>
        </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
$(document).ready(function(){   
    $("#eminent").live('click',function(){
        var src = $(this).parents().find('img').attr('src');
        var alt = $(this).parents().find('img').attr('alt');
        var val = $(this).attr('value');      
        var len = $('.eminentList ul').length;
        if($(this).attr("checked")==='checked'){
            var data = "<ul id='eminent_"+val+"'><li><img src='"+src+"' alt='"+alt+"' width='50' height='50'></li><span><input type='hidden' name='EminentRelation["+val+"]'/><em>"+alt+"</em></span></ul>";
            $('.eminentList').append(data);
            if(len === 0){
                $('.eminentList p').remove();
            }
        }else{
            $('#eminent_'+val+'').remove();         
            if(len-1 === 0){
                 $('.eminentList').append('<p>数据未添加</p>');
            }
        }
    });
});
$('#setSource').click(function(){
    $('#source').val('http://www.lfeel.com');
});
$('#show').click(function(){
   $('.target').show(); 
});
</script>
<style>
.row label{width:80px;float: left;}
.form h5, .form h3{border-bottom: 1px dotted #ccc;font-size: 14px;padding: 5px;text-shadow: 0px 1px 0px #fff;background: #bae7ff;}
.form h3{background:#e7e7e7;padding: 0px 3px;}
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
.list-view {overflow: hidden;display: block;border-top: 1px dotted #ccc;width: 74.2%;float: left;border: 1px solid #ccc;padding: 5px;}
.list-view .items ul, .eminentList ul
{float: left;width: 90px;height: 120px;text-align: center;font-size: 12px;padding:5px 0;margin:0 7px;}
.list-view .items ul li{margin: 2px;width: 100px;height: 100px;}
.list-view .items ul li img, .eminentList ul li img
{width: 90px;height: 100px;border:1px solid #ccc;padding: 1px;}
.eminentList {overflow: hidden;padding: 5px;width: 74.2%;border: 1px solid #ccc;}
.eminentList em, .list-view em{color:#000;}
.list-view a{font-size: 14px;padding-left:0;text-decoration: none;background: none;border: none;}
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