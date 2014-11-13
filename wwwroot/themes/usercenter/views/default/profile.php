<?php
$js = Yii::app()->getClientScript();
$js->registerScriptFile('/js/profile.js');
$js->registerScriptFile('/js/date/WdatePicker.js');
$this->pageTitle=Yii::app()->name . ' - 修改扩展资料';
$this->breadcrumbs=array(
    '用户中心'=>'/usercenter',
	'修改资料',
);
?>
<h1>修改资料 - <?php echo CHtml::encode(Yii::app()->user->name);?></h1>

<?php if(Yii::app()->user->hasFlash('register')):?>
    <?php $this->widget('ext.widgets.note.YNote',array('type'=>'info','text'=>Yii::app()->user->getFlash('register')));?>
<?php endif; ?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'profile-form',  
    'htmlOptions'=>array('name'=>'profile'),
	'enableClientValidation'=>FALSE,
    'enableAjaxValidation'=>TRUE,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,     
	),
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <?php echo $form->labelEx($model,'gender'); ?>
    <?php echo $form->radioButtonList($model,'gender',array('0'=>'男','1'=>'女'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
    <?php echo $form->error($model,'gender'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'birthday'); ?>
    <?php echo $form->textField($model,'birthday',array('class'=>'Wdate','size'=>10,'maxlength'=>128,'onclick'=>"WdatePicker({dateFmt:'yyyy-MM-dd'})",'value'=>$model->isNewRecord ? '' : date('Y-m-d',$model->birthday))); ?>
    <?php echo $form->error($model,'birthday'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'email'); ?>
    <?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>64,'value'=>$model->user->email)); ?>
    <?php echo $form->error($model,'email'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'phone'); ?>
    <?php echo $form->textField($model,'phone',array('size'=>10,'maxlength'=>16)); ?>
    <?php echo $form->error($model,'phone'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'qq'); ?>
    <?php echo $form->textField($model,'qq',array('size'=>10,'maxlength'=>16)); ?>
    <?php echo $form->error($model,'qq'); ?>
</div>

<div class="row">
    <label>城市</label>
    <?php  echo $form->dropDownList($model,'province',array(),array('id'=>'province')); ?>
    <?php  echo $form->dropDownList($model,'city',array(),array('id'=>'city')); ?>
    <SCRIPT language=javascript>InitCitySelect(document.profile.province,document.profile.city);</SCRIPT>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'company'); ?>
    <?php echo $form->textField($model,'company',array('size'=>30,'maxlength'=>128)); ?>
    <?php echo $form->error($model,'company'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'profile'); ?>
    <?php echo $form->textArea($model,'profile',array('rows'=>'10','cols'=>'30')); ?>
    <?php echo $form->error($model,'profile'); ?>
</div>
<div class="row buttons">
    <?php echo CHtml::submitButton('提交'); ?>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">   
 $('#province option').each(function(i){
    if($(this).val()==<?php echo CJavaScript::encode(!empty($model->province)?$model->province:'null');?>){
        $(this).attr('selected','selected');
        FillCitys(g_selCity,<?php echo CJavaScript::encode(!empty($model->province)?$model->province : 'null');?>);
    }
});
$('#city option').each(function(i){
    if($(this).val()==<?php echo CJavaScript::encode(!empty($model->city)?$model->city:'null');?>){
    $(this).attr('selected','selected');
    }
});
</script> 
<style>
    .row{display: block;clear: both;overflow: hidden;}
    .row label{text-align: right; margin-right: 5px;}
    .row label, .row span li label{line-height: 20px;}
    .row label, .row span li, .row span li input{float: left;}
    .row label{width: 80px;}
    .row li{list-style: none;}
    .row span li{width:50px;}
    .row span li label{width: 15px;}
    .row span li input{padding: 0; margin: 2px;}
</style>




