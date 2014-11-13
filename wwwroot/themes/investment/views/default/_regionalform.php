<div class="subtitleC">
               <div class="feedback">
                   <div class="title"><em></em>在线留言</div>
                  <?php $form = $this->beginWidget('CActiveForm', array(
                        'id'=>'regional-form',
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
                        </div>
                        <div class="row">
                            <?php echo $form->labelEx($advisory,'phone'); ?>
                            <?php echo $form->textField($advisory,'phone',array('size'=>'40','maxlength'=>'11')); ?>
                            <?php echo $form->error($advisory,'phone'); ?>              
                        </div>
                        <div class="row">
                            <?php echo $form->labelEx($advisory,'qq'); ?>
                            <?php echo $form->textField($advisory,'qq',array('size'=>'40','maxlength'=>'16')); ?>
                            <?php echo $form->error($advisory,'qq'); ?>               
                        </div>
                        <div class="row">
                           <?php echo $form->labelEx($advisory,'content'); ?>
                            <?php echo $form->textArea($advisory,'content',array('maxlength'=>'1024','rows'=>'5','cols'=>'41')); ?>
                            <?php echo $form->error($advisory,'content'); ?>              
                        </div>
                        <div class="row">
                            <label></label> <button class="submit" name="yt0">提交留言</button>
                        </div>
               <?php $this->endWidget(); ?>
               </div>
    
    
               
