<?php
$this->breadcrumbs=array(
	'乐聚荟管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'meet',
    '乐聚荟报名管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.'/meet/sign',
    '更新乐聚荟报名 - '.$sign->company
);
?>
<div class="inner"> 
<div class="form">
     <?php $form = $this->beginWidget('CActiveForm', array(
         'id'=>'sign-form',
         'enableAjaxValidation'=>false,
         'enableClientValidation'=>true,
             'htmlOptions'=>array(
                 'validateOnSubmit'=>true,
             ),
     )); ?>
     <div class="row">
         <?php echo $form->labelEx($sign,'user_name'); ?>
         <?php echo $form->textField($sign,'user_name'); ?>
         <?php echo $form->error($sign,'user_name'); ?>
     </div>
     <div class="row">
         <?php echo $form->labelEx($sign,'phone'); ?>
         <?php echo $form->textField($sign,'phone'); ?>
         <?php echo $form->error($sign,'phone'); ?>
     </div>
     <div class="row">
         <?php echo $form->labelEx($sign,'tel'); ?>
         <?php echo $form->textField($sign,'tel'); ?>
         <?php echo $form->error($sign,'tel'); ?>
     </div>
     <div class="row">
         <?php echo $form->labelEx($sign,'address'); ?>
         <?php echo $form->textField($sign,'address'); ?>
         <?php echo $form->error($sign,'address'); ?>
     </div>
     <div class="row">
         <?php echo $form->labelEx($sign,'company'); ?>
         <?php echo $form->textField($sign,'company'); ?>
         <?php echo $form->error($sign,'company'); ?>
     </div>
     <div class="row">
         <?php echo $form->labelEx($sign,'job'); ?>
         <?php echo $form->textField($sign,'job'); ?>
         <?php echo $form->error($sign,'job'); ?>
     </div>
     <div class="row">
         <?php echo $form->labelEx($sign,'number'); ?>
         <?php echo $form->textField($sign,'number'); ?>
         <?php echo $form->error($sign,'number'); ?>
     </div>
     <div class="row">
         <?php echo $form->labelEx($sign,'email'); ?>
         <?php echo $form->textField($sign,'email'); ?>
         <?php echo $form->error($sign,'email'); ?>
     </div>
    <?php if (extension_loaded('gd')): ?>
<div class="row verifyCode">
 <?php echo $form->labelEx($sign,'verifyCode'); ?>
 <?php echo $form->textField($sign,'verifyCode',array('class'=>'verify','style'=>'width:80px;float: left;margin-right: 5px;')); ?>
 <?php $this->widget('CCaptcha',array('buttonLabel'=>'看不清换一张')); ?>
 <?php echo $form->error($sign,'verifyCode'); ?>
</div>
<?php endif;?>
<div class="rows">
 <?php echo CHtml::submitButton('保存',array('class'=>'button')); ?>
</div>
<?php $this->endWidget(); ?>
</div>
    </div>
<style>
.verifyCode a{border: none;background:none;}
</style>