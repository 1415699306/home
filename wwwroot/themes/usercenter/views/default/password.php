<?php
$this->pageTitle=Yii::app()->name . ' - 修改用户基本资料';
$this->breadcrumbs=array(
    '用户中心'=>'/usercenter',
	'修改用户基本资料',
);
?>
<h1>修改用户基本资料 - <?php echo CHtml::encode(Yii::app()->user->name);?></h1>
<?php if(Yii::app()->user->hasFlash('register')):?>
    <?php $this->widget('ext.widgets.note.YNote',array('type'=>'info','text'=>Yii::app()->user->getFlash('register')));?>
<?php endif; ?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'password-form',
	'enableClientValidation'=>FALSE,
    'enableAjaxValidation'=>TRUE,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<div class="row">
    <?php echo $form->labelEx($model,'password'); ?>
    <?php echo $form->passwordField($model,'password',array('autocomplete'=>'off')); ?>
    <?php echo $form->error($model,'password'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'againpassword'); ?>
    <?php echo $form->passwordField($model,'againpassword',array('autocomplete'=>'off')); ?>
    <?php echo $form->error($model,'againpassword'); ?>
</div>   

    
<div class="row buttons">
    <?php echo CHtml::submitButton('提交'); ?>
</div>
<?php $this->endWidget(); ?>
</div>
