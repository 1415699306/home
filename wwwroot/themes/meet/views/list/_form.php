<div class="form">
     <h2>我要报名</h2>
     <?php $form = $this->beginWidget('CActiveForm', array(
         'id'=>'sign-form',
         'enableAjaxValidation'=>false,
         'enableClientValidation'=>true,
             'clientOptions'=>array(
                 'validateOnSubmit'=>true,
             ),
     )); ?>
     <div class="row">
         <?php echo $form->labelEx($sign,'user_name'); ?>
         <?php echo $form->textField($sign,'user_name'); ?>
         <?php echo $form->error($sign,'user_name'); ?>
     </div>
    <div class="row">
         <?php echo $form->labelEx($sign,'company'); ?>
         <?php echo $form->textField($sign,'company'); ?>
         <?php echo $form->error($sign,'company'); ?>
     </div>
     <div class="row">
         <?php echo $form->labelEx($sign,'address'); ?>
         <?php echo $form->textField($sign,'address'); ?>
         <?php echo $form->error($sign,'address'); ?>
     </div>
     <div class="row">
         <?php echo $form->labelEx($sign,'phone'); ?>
         <?php echo $form->textField($sign,'phone'); ?>
         <?php echo $form->error($sign,'phone'); ?>
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
<div class="rows">
 <?php echo CHtml::submitButton('我要报名',array('class'=>'button')); ?>
</div>
<?php $this->endWidget(); ?>
</div>