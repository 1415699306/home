<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'eminent-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'htmlOptions'=>array(
        'validateOnSubmit'=>true,
        'enctype'=>'multipart/form-data',
    ),
)); ?>
<div class="row">
    <?php echo $form->labelEx($model,'name'); ?>
    <?php echo $form->textField($model,'name'); ?>
    <?php echo $form->error($model,'name'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'avatar'); ?>
    <?php echo $form->fileField($model,'avatar'); ?>
    <?php echo $form->error($model,'avatar'); ?>
</div>
<div class="row">
    <?php echo CHtml::submitButton($model->isNewRecord ? '保存' : '更新');?>
</div>
<?php $this->endWidget(); ?>
