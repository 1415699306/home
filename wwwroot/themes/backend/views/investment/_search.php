<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'GET',
    'id'=>'PostSearch',
)); ?>
<div class="row">
    <?php echo $form->label($model,'status'); ?>
    <?php  echo $form->dropDownList($model,'status',array('0'=>'开启','1'=>'关闭'),array('empty'=>'请选择')); ?>
</div>
<div class="row">
    <?php echo $form->label($model,'name'); ?>
    <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>80)); ?>
    <span class="error"></span>
</div>
<div class="button">
    <span style="float: left;"><?php echo CHtml::submitButton('搜索',array('class'=>'button search')); ?></span><span style="float: left;"><?php echo CHtml::link('重置','javascript:void(0);',array('class'=>'button','onclick'=>'function load(){window.location = window.location}load();'));?></span>
</div>
<?php $this->endWidget(); ?>
