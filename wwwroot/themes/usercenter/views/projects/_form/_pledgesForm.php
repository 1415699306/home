<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'pledges-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'focus'=>array($model,'money'),
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
        //'afterValidateAttribute'=>'js:function(form, attribute, data, hasError){alert(attribute)}',
        ),
)); ?>
<div class='row'>
    <?php echo $form->labelEx($model,'money'); ?>
    <?php echo $form->textField($model,'money',array('class'=>'price','maxlength'=>11));?><span class='sign'>元</span>   
    <?php echo $form->error($model,'money'); ?>
</div> 
<div class='row'>
    <?php echo $form->labelEx($model,'discription'); ?>
    <?php echo $form->textArea($model,'discription',array('class'=>'textarea_1'));?>
    <?php echo $form->error($model,'discription'); ?>
</div>
<div class='row'>
    <?php echo $form->labelEx($model,'thumb'); ?>
    <?php
        $this->widget('application.extensions.swfupload.CSwfUpload', array(
            'jsHandlerUrl'=>'/js/swfupload/handler.js', //Relative path
            'id'=>'SWFUpload',
            'postParams'=>array(),
            'config'=>array(
                'use_query_string'=>true,
                'upload_url'=>Yii::app()->createUrl('/api/upload/swfupload',array('res'=>Yii::app()->request->getParam('pid'),'app'=>BaseApp::DREAMPLEDGBES,'folder'=>'dream','ext'=>'thumb','PHPSESSID'=>Yii::app()->session->getSessionId())),
                'file_size_limit'=>'6MB',
                'file_types'=>'*.jpg;*.png;*.gif',
                'file_types_description'=>'Image Files',
                'file_upload_limit'=>3,
                'file_queue_error_handler'=>'js:fileQueueError',
                'file_dialog_complete_handler'=>'js:fileDialogComplete',
                'upload_progress_handler'=>'js:uploadProgress',
                'upload_error_handler'=>'js:uploadError',
                'upload_success_handler'=>'js:uploadSuccess',
                'upload_complete_handler'=>'js:uploadComplete',
                'button_placeholder_id'=>'swfupload',
                'button_width'=>150,
                'button_height'=>20,
                'button_text'=>'<span class="button">'.Yii::t('messageFile', '上传文件').' (最大上传 6 MB)</span>',
                'button_text_style'=>'.button { font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif; font-size: 11pt; text-align: center; }',
                'button_text_top_padding'=>0,
                'button_text_left_padding'=>0,
                'button_window_mode'=>'js:SWFUpload.WINDOW_MODE.TRANSPARENT',
                'button_cursor'=>'js:SWFUpload.CURSOR.HAND',
                ),
            )
        );
        ?>
    <div class="swfupload">
        <span id="swfupload">
        </span>
        <span id='total'></span>
        <div id="pic">
            <?php if(!$model->isNewRecord):?>
            <?php foreach($model->thumbs as $v):?>
            <div>
                <img src="<?php echo Storage::getImageBySize($v->track_id,'dream',null,'thumb');?>" width="65" height="65">
                <a href="javascript:void(0);" title="确定要删除文件?" onclick="deleteThumb(this,'<?php echo $v->track_id;?>');return false;" class="ui-popup-delete">删除</a>
            </div>
            <?php endforeach;?>
            <?php endif;?>
        </div>                       
    </div>
    <?php echo $form->error($model,'thumb'); ?>
</div>
<div class='row'>
    <?php echo $form->labelEx($model,'places_button'); ?>
    <?php echo $form->RadioButtonList($model,'places_button',array('0'=>'否','1'=>'是'),array('separator'=>'','template'=>'<li>{input}{label}</li>','onchange'=>'places_button(this.value)')); ?>
    <?php echo $form->textField($model,'places',array('class'=>'price','maxlength'=>11,'style'=>0 < $model->places ? '' : 'display:none'));?>
    <?php echo $form->error($model,'splaces_button'); ?>
</div> 
 <div class='row'>
    <?php echo $form->labelEx($model,'mailing'); ?>
    <?php echo $form->RadioButtonList($model,'mailing',array('0'=>'否','1'=>'快递','2'=>'平邮'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
    <?php echo $form->error($model,'mailing'); ?>
</div> 
<div class='row free_shipping'>
    <?php echo $form->labelEx($model,'free_shipping'); ?>
    <?php echo $form->RadioButtonList($model,'free_shipping',array('0'=>'否','1'=>'大陆包邮'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
    <?php echo $form->error($model,'free_shipping'); ?>
</div> 
 <div class='row'>
   
    <?php echo $form->labelEx($model,'payback_time'); ?> <span class='sum'>项目成功结束后预计</span>
    <?php echo $form->textField($model,'payback_time',array('class'=>'price over','maxlength'=>11));?> <span class='sign'>天</span> 
    <?php echo $form->error($model,'payback_time'); ?>
      
</div> 
<div class=" row buttom end">
    <?php if(!$model->isNewRecord):?>
    <input type="submit" value="保存" class="save"><span><?php echo CHtml::link('取消更改',$this->createUrl('/usercenter/projects/pledges',array('id'=>Yii::app()->request->getParam('id',0))));?></span> 
    <?php else:?>
    <input type="submit" value="保存，下一步" class="next"><span><a href='javascript:void(0);' id='cancel'>取消添加</a></span>  
    <?php endif;?>
</div>
<?php $this->endWidget();?>
<script>
$('#create').click(function(){
    $('.form').slideDown();
    $('.BottomEnd').slideUp();
    $('#DreamPledges_money').focus();
});
$('#cancel').click(function(){
    $('.BottomEnd').slideDown();
    $('.form').slideUp();
});
function places_button(val){
    var target = $('#DreamPledges_places');
    if(val === '1'){
        target.show();
    }else{
        target.val('');
        target.hide();
    }
}
SWFUpload.prototype.uploadComplete = function (file) {
	file = this.unescapeFilePostParams(file);
    this.queueEvent("upload_complete_handler", file);
};
SWFUpload.prototype.uploadProgress = function (file, bytesComplete, bytesTotal) {
    try {
	file = this.unescapeFilePostParams(file);
	this.queueEvent("upload_progress_handler", [file, bytesComplete, bytesTotal]);
    $('#total').html('上传进度：'+bytesComplete/bytesTotal*100+'%');
    } catch (ex) {
		alert(ex);
	}
};
SWFUpload.prototype.uploadSuccess=function(file,data){
    msg = eval(data);
    if(msg[0].success==='1'){
        $('#pic').append('<div><input type="hidden" name="DreamPledges[thumb][]" value="'+msg[0].filename+'"/><img src="'+msg[0].path+'" width="65" height="65"><a href="javascript:void(0);" title="确定要删除文件?" onclick="deleteThumb(this,\''+msg[0].filename+'\');return false;" class="ui-popup-delete">删除</a></div>');
        /*if($('#pic img').length === 3){
            this.setButtonDisabled(true);
        }else{
            this.setButtonDisabled(false);
        }*/
        document.getElementById(this.customSettings.uploadButtonId).disabled = true;
    }else{
        $('#total').html('文件上传失败,请重新上传');
    }
};

SWFUpload.prototype.fileQueueError=function(file,code,message){
    if(code === -100){
        alert('文件一次上传数量超出限制!,一次只能上传'+message+'个文件');
    }
};
function deleteThumb(that,obj){
    if(confirm('确定要删除文件?')){
        $.ajax({
        type: "GET",
        url: "/api/upload/deletethumb",
        dataType: "json",
        data:"name="+obj+'&folder=dream&ext=thumb&app=<?php echo BaseApp::DREAMPLEDGBES;?>&res=<?php echo Yii::app()->request->getParam('pid',0);?>',
        success:function(xhr){
            if(xhr.code==='1'){
                $(that).parent().remove();
            }
        }
      });
    }
}
$('#deleteByOrder').live('click',function(){
    var id = $(this).attr('pid');
    var that = $(this);
    if(confirm('确定要删除此记录吗?')){
            $.ajax({
            type: "GET",
            url: "/usercenter/projects/deletepledges",
            dataType: "json",
            data:'id='+id,
            success:function(xhr){
                if(xhr.code==='1'){
                   that.parent().parent().remove();
                }
            }
      });
    }
    return false;
});
</script>