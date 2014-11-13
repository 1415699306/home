<div class="message" id='message'>
    <div class="content topbar">
        <h3><span><i></i>联系方法<em></em></span></h3>
        <div class="call">
            <p><label>联系人：</label><?php echo CHtml::encode($model->contacts);?></p>
            <p><label>联系热线：</label><?php echo CHtml::encode($model->tel);?></p>
            <p><label>联系地址：</label><?php echo CHtml::encode($model->address);?></p>
            <p><label>联系邮箱：</label><?php echo CHtml::encode($model->email);?></p>
            <p><label>公司网址：</label><?php echo CHtml::encode($model->website);?></p>
        </div>
        <div class="form">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id'=>'advisory-form',
                'enableAjaxValidation'=>false,
                'enableClientValidation'=>true,
                'htmlOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            ));?>
            <div class="row">
                <?php echo $form->labelEx($advisory,'name'); ?>
                <?php echo $form->textField($advisory,'name',array('size'=>'40','maxlength'=>'128')); ?>
                <?php echo $form->error($advisory,'name'); ?>
                <em>您的真实姓名</em>
            </div>
            <div class="row">
                <?php echo $form->labelEx($advisory,'phone'); ?>
                <?php echo $form->textField($advisory,'phone',array('size'=>'40','maxlength'=>'11')); ?>
                <?php echo $form->error($advisory,'phone'); ?>
                <em>以便回访</em>
            </div>
            <div class="row">
                <?php echo $form->labelEx($advisory,'tel'); ?>
                <?php echo $form->textField($advisory,'tel',array('size'=>'40','maxlength'=>'16')); ?>
                <?php echo $form->error($advisory,'tel'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($advisory,'address'); ?>
                <?php echo $form->textField($advisory,'address',array('size'=>'40','maxlength'=>'128')); ?>
                <?php echo $form->error($advisory,'address'); ?>
                 <em>请详细填写</em>
            </div>
            <div class="row">
                <?php echo $form->labelEx($advisory,'qq'); ?>
                <?php echo $form->textField($advisory,'qq',array('size'=>'40','maxlength'=>'16')); ?>
                <?php echo $form->error($advisory,'qq'); ?>
                 <em>在线沟通</em>
            </div>
            <div class="row">
                <?php echo $form->labelEx($advisory,'email'); ?>
                <?php echo $form->textField($advisory,'email',array('size'=>'40','maxlength'=>'128')); ?>
                <?php echo $form->error($advisory,'email'); ?>
                 <em>收取电子资料</em>
            </div>
            <div class="row">
                <?php echo $form->labelEx($advisory,'return_time'); ?>
                <?php echo $form->textField($advisory,'return_time',array('class'=>'Wdate','size'=>40,'maxlength'=>11,'onclick'=>"WdatePicker({dateFmt:'yyyy-MM-dd'})")); ?>
                <?php echo $form->error($advisory,'return_time'); ?>
                 <em>请选择回访时间</em>
            </div>
            <div class="row">
                <?php echo $form->labelEx($advisory,'content'); ?>
                <?php echo $form->textArea($advisory,'content',array('maxlength'=>'1024','rows'=>'5','cols'=>'41')); ?>
                <?php echo $form->error($advisory,'content'); ?>
                 <em>想了解什么?</em>
            </div>
            <div class="row">
                <?php echo CHtml::submitButton('提交',array('class'=>'submit'));?>
                <?php echo CHtml::resetButton('重填',array('class'=>'reset'));?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<script>
$('#advisory-form').submit(function(){
    var that = $(this);
    var error = $(this).find('div.error'); 
    var required = $(this).find('span.required');
    var success = $(this).find('div.success');
    if(error.length === 0 && success.length >= required.length){
        var form = new globals.Person('#advisory-form input,#advisory-form textarea');   
        var data = form.getArray();
        $.ajax({
            type: "POST",
            url: "/investment/default/index",
            dataType:'json',
            data: data,
            success: function(msg){
              if(msg.code == '1'){
                  that.hide();
                  $('.form').html('提交成功!');
              }else if(msg.code == '-1'){
                  alert('今天您已提交过问题了!请不要重复提交!');
              }
            }
         });        
    }else{
        alert('请填写表单再提交');
    }
    return false;
});
</script>