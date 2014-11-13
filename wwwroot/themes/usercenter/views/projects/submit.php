<?php
$js = Yii::app()->getClientScript();
$js->registerCssFile(Yii::app()->theme->baseUrl.'/css/submit.css');
?>
<div class='RightDiv'>
  <div class='MainDiv'>
       	  <div class='bigDiv borline'>
          	  <span class='Preview'><?php echo CHtml::link('预览',$this->createUrl('/dream/projects/view',array('id'=>$dream->id)),array('target'=>'_blank'));?></span>
           	  <div class='subtitle'><?php echo CHtml::encode($dream->title);?> / 项目管理</div>
              <h3>梦想状态</h3>
                    <?php echo CHtml::image(Yii::app()->theme->baseUrl.'/images/Personal_03.jpg');?>
                     <p class='title'><b>准备提交审核</b></p>
                     <p>提示：提交审核后点名时间将在3个工作日内完成审核，</p>
                     <p><i>请留意站内通知以及你的邮箱。</i>审核通过后，你的项目将会立即上线！</p>             
      </div>
        <div class='bigDiv'>     
            <?php if(Yii::app()->user->hasFlash('submit')):?>
                <div class="ui-flash ui-flash-success"><a href="#close" title="关闭" class="ui-flash-close">关闭</a>保存成功</div>
            <?php endif;?>
            <?php $form = $this->beginWidget('CActiveForm', array(
                    'id'=>'submit-form',
                    'enableAjaxValidation'=>false,
                    'enableClientValidation'=>true,
                        'htmlOptions'=>array(
                            'validateOnSubmit'=>true,
                        ),
                )); ?>
            <?php if($dream->status === '0'):?>
            <p>填写项目筹资目标（必填）</p>
              <div class='row'>
                  <?php echo $form->labelEx($dream,'money'); ?>
                  <?php echo $form->textField($dream,'money',array('class'=>'price'));?><span class='sign'>元</span>
                  <?php echo $form->error($dream,'money'); ?>
              </div> 
                <div class='row'>
                  <?php echo $form->labelEx($dream,'day'); ?>
                  <?php echo $form->textField($dream,'day',array('class'=>'price'));?><span class='sign'>天</span> 
                  <?php echo $form->error($dream,'day'); ?>  
              </div> 
             <p>填写你的姓名及联系方式（必填）</p>
             <div class='row'>
                  <?php echo $form->labelEx($model,'name'); ?>
                  <?php echo $form->textField($model,'name',array('class'=>'name'));?>
                  <?php echo $form->error($model,'name'); ?>  
            </div> 
              <div class='row'>
                  <?php echo $form->labelEx($model,'age'); ?>
                  <?php echo $form->RadioButtonList($model,'age',array('0'=>'男','1'=>'女'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
                  <?php echo $form->error($model,'age'); ?>
              </div> 
              <div class='row'>
                  <?php echo $form->labelEx($model,'phone'); ?>
                  <?php echo $form->textField($model,'phone',array('class'=>'name'));?>
                  <?php echo $form->error($model,'phone'); ?>  
              </div> 
              <div class='row'>
                  <?php echo $form->labelEx($model,'qq'); ?>
                  <?php echo $form->textField($model,'qq',array('class'=>'name'));?>
                  <?php echo $form->error($model,'qq'); ?>  
              </div> 
              <div class='buttom end'>
                  <input  type="submit" value="提交审核" class="next"/>
              </div>
            <?php else:?>      
             <div class='buttom end'>
                <input  type="submit" value="撤回审核" class="save" name='Dream[audit]'/>
             </div>
             <?php endif;?>
             <?php $this->endWidget(); ?>
              <p>项目日志</p>
              <?php foreach ($dream->logs as $log):?>
                <p><em><?php echo date('Y-m-d h:i:s',$log->ctime);?></em><span><?php echo DreamLog::getLog($log->log_id);?><?php echo !empty($log->reason) ? ' - <span style="color:red;">【原因:'.$log->reason.'】</span>':'';?></span></p>
              <?php endforeach;?>
        </div>
  </div>
</div>
<script type="text/javascript">
jQuery(function($){
    $('#submit-form').submit(function(){
        var doSubmit = true;
        var name = $('#DreamSubmit_name').val();
        var phone = $('#DreamSubmit_phone').val();
        var qq = $('#DreamSubmit_qq').val();
        if(name === ''|| phone ===''|| qq===''){
            doSubmit = false;
        }
        return doSubmit;
    });
});
</script>