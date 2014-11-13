<?php $js = Yii::app()->getClientScript();$js->registerScriptFile('/js/profile.js');$js->registerCssFile('/js/swfupload/default.css');$js->registerCssFile(Yii::app()->theme->baseUrl.'/css/index.css');?>
<?php if(Yii::app()->user->hasFlash('projects')):?><div class="ui-flash ui-flash-success"><a href="#close" title="关闭" class="ui-flash-close">关闭</a>保存成功</div><?php endif;?>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'dream-form',
    'htmlOptions'=>array('name'=>'profile'),
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
)); ?>
<div class='MainDiv'>
			<div class="subtitle">发起我的梦想</div>
            <div class='subpage'>
            	<h3>项目文案</h3>
                <div class='row' id='category_id'>
                	<label>选择类别 <span class="required">*</span></label>
                    <?php $i=0;?>
                    <?php foreach($category as $key=>$val):?>
                    <?php if($i==0):?>
                    <?php echo CHtml::hiddenField('Dream[category_id]',(0 < $model->category_id ? $model->category_id : $key),array('id'=>'category_val'));?>
                    <?php endif;?>
                    <a href="#"  class="<?php echo (0 < $model->category_id ? $key == $model->category_id : $i===0) ? 'CheckedOn':'';?>" val='<?php echo $key;?>'><?php echo $val;?></a>
                    <?php ++$i;?>
                    <?php endforeach;?>
                </div>                
                <?php echo CHtml::hiddenField('Dream[thumb]',!empty($model->thumb) ? $model->thumb : null ,array('id'=>'thumb'));?>
                 <div class='row max_height'>
                	<?php echo $form->labelEx($model,'title'); ?>
                    <?php echo $form->textField($model,'title',array('class'=>'ProjectName','maxlength'=>25));?>
                    <p><?php echo $form->error($model,'title'); ?></p>
                </div>
                <div class='row'>
                	<label style="height:20px; line-height:20px;">发起地点 <span class="required" style="height:20px; line-height:20px;">*</span></label>
                    <?php  echo $form->dropDownList($model,'province',array(),array('id'=>'province')); ?>
                    <?php  echo $form->dropDownList($model,'city',array(),array('id'=>'city')); ?>
                    <p><?php echo $form->error($model,'province');?><?php echo $form->error($model,'city');?></p>
                    <SCRIPT language=javascript>InitCitySelect(document.profile.province,document.profile.city);</SCRIPT>
                </div>
                <div class='row test'>
                	<?php echo $form->labelEx($model,'discription'); ?>
                    <?php echo $form->textArea($model,'discription',array('class'=>'textarea_1'));?>
                    <p><?php echo $form->error($model,'discription');?></p>
                </div>
                <div class=' row rows'>
                    <?php echo $form->labelEx($model,'thumb'); ?>   
                    <?php
                        $this->widget('application.extensions.swfupload.CSwfUpload', array(
                            'jsHandlerUrl'=>'/js/swfupload/handler.js', //Relative path
                            'id'=>'SWFUpload',
                            'postParams'=>array(),
                            'config'=>array(
                                'use_query_string'=>true,
                                'upload_url'=>Yii::app()->createUrl('/api/upload/swfuploadreplace',array('res'=>Yii::app()->request->getParam('id',0),'app'=>BaseApp::DREAM,'folder'=>'dream','ext'=>'thumb','PHPSESSID'=>Yii::app()->session->getSessionId())),
                                'file_size_limit'=>'6MB',
                                'file_types'=>'*.jpg;*.png;*.gif',
                                'file_types_description'=>'Image Files',
                                'file_upload_limit'=>1,
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
                    <div class="swfupload"><span id="swfupload"></span><span id='total'></span></div><span style="color:#a0a0a0;">请上传图片尺寸宽265px,高143px。</span>
                </div>
                <div class='row'>
                    <?php echo $form->labelEx($model,'video'); ?>
                    <?php echo $form->textField($model,'video',array('class'=>'ProjectName'));?> <span style="color:#a0a0a0; padding-left:70px;">(可选)输入视频地址(支持优酷、土豆、酷六、新浪视频)</span>
                    <p><?php echo $form->error($model,'video'); ?></p>
                </div>
                <div class='row' style="height:auto;">
                	<label>详细描述 <span class="required">*</span></label>
                    <?php $this->widget('ext.widgets.baiduEdit.IBaiduEdit',array('model'=>$model->dreamContent,'form'=>$form,'attribute'=>'content','toolbars'=>"'bold','autotypeset','insertimage','insertvideo'",'initialFrameWidth'=>'590'));?>
                    </div>
                    <div class='row'>
                    <?php echo $form->labelEx($model,'money'); ?>
                    <?php echo $form->textField($model,'money',array('class'=>'price'));?><span class='sign'>元</span>
                    <p><?php echo $form->error($model,'money'); ?></p>
                	</div>    
                 	<div class='row'>
                    <?php echo $form->labelEx($model,'day'); ?>
                    <?php echo $form->textField($model,'day',array('class'=>'dateOn'));?><span class='sign'>天</span>
                    <p><?php echo $form->error($model,'day'); ?></p> 
                	</div> 
                   <div class='buttom'>
                    <input type="submit" name="Dream[save]" value="保存" class="save"/>
                    <input  type="submit"  name="Dream[next]" value="保存，下一步" class="next"/>
                </div>  
                </div>
                
                <div class='rightfloat'>
        	<div class='listdiv'>
                <div class='listTop'></div>
                <div class='list'>
                    <div class='pic' id='pic'>
                        <?php echo !empty($model->thumb) ? CHtml::image(DIRECTORY_SEPARATOR.RESOURCE.DIRECTORY_SEPARATOR.'dream'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$model->thumb,'',array('width'=>265,'height'=>143)) : '缩略图';?>
                    </div>
                    <p><?php echo $form->error($model,'thumb'); ?></p>
                    <div class='text'>
                      <h2><?php echo !empty($model->title)?$model->title:'项目名称';?></h2>
                        <p><?php echo !empty($model->discription)?$model->discription:'简要说明...';?></p>
                  </div>
                    <div class='view-bar'>
                       <!-- <div class='speed'></div>-->
                    </div>
                    <div class='textList'>
                        <ul class='complete'>
                            <li class='f_size'>0%</li>
                            <li>达到</li>
                        </ul>
                        <ul class='support'>
                            <li><span>¥</span><span class='f_size'>0</span></li>
                            <li>金额</li>
                        </ul>
                        <ul class='date'>
                            <li  class='f_size'><span class='f_size'>0</span>分钟</li>
                            <li>剩余时间</li>
                        </ul>
                 </div>
              </div>
               <div class='listBottom'></div>           
            </div>     
        </div>
           <?php $this->endWidget(); ?>         
    </div>

        

<script type="text/javascript">   
$(document).ready(function(){
     $('#province option').each(function(i){
    if($(this).val()===<?php echo CJavaScript::encode(!empty($model->province)?$model->province:'null');?>){
        $(this).attr('selected','selected');
        FillCitys(g_selCity,<?php echo CJavaScript::encode(!empty($model->province)?$model->province : 'null');?>);
    }
});
$('#city option').each(function(i){
    if($(this).val()===<?php echo CJavaScript::encode(!empty($model->city)?$model->city:'null');?>){
    $(this).attr('selected','selected');
    }
});
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
        $('#pic').html('<img src="'+msg[0].path+'" width="265" height="143">');
        $('#thumb').val(msg[0].filename);
        //this.setButtonDisabled(true);
        document.getElementById(this.customSettings.uploadButtonId).disabled = true;
    }else{
        $('#total').html('文件上传失败,请重新上传');
    }
};
    var check = new checkNull();
    check.setObj('#Dream_day','15-16天');
    check.setObj('#Dream_money','不少于500元!');
    //check.setObj('#Dream_video','(可选)输入视频地址(支持优酷、土豆、酷六、新浪视频)');
    check.setDuObj('#Dream_discription','不超过75个字!','.text p','简要说明...');
    check.setDuObj('#Dream_title','不超过32个字!','.text h2','项目名称');
});
function checkNull(){
    this.setObj = function(obj,text){
        $(obj).click(function(){
            $(this).css('color','#000');
            if($(this).val()===text){
                $(this).val('');
            }
        }).blur(function(){
                if($(this).val() === ''){
                    $(this).val(text);
                    $(this).css('color','#a0a0a0');
                }
        });
    };
    this.setDuObj = function(obj,text,targets,targetxt){
        $(obj).keyup(function(){
            $(this).css('color','#000');
            var text = $(this).val();
            var target = $(targets);
            target.html(text);
            if(text === ''){
                $(this).val(text);
                target.html(targetxt);
        }
    }).click(function(){if($(this).val()===text){$(this).val('');};}).blur(function(){
            if($(this).val() === ''){
                $(this).val(text);
                $(this).css('color','#a0a0a0');
            }
        }); 
    };
}
$('#category_id a').click(function(){
    var target = $(this);
    var setTarget = $('#category_val');
    target.addClass('CheckedOn');
    target.siblings().removeClass('CheckedOn');
    setTarget.val(target.attr('val'));
});
</script> 