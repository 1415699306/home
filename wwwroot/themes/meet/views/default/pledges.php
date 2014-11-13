<?php
$js = Yii::app()->getClientScript();
$js->registerScriptFile('/js/profile.js');
$js->registerScriptFile('/js/date/WdatePicker.js');
$js->registerCssFile(Yii::app()->theme->baseUrl."/css/style.css");
?>
<body class="bg">
<div class="max-width">
<div class="activeContent">
  <div class="activeForm">
    	<div class="title"></div>
        <ul class="Process">
        <li class="Fir_step">1. 填写聚会信息</li>
        <li class="Sec_step">2. 上传聚会海报</li>
        <li class="Thr_step">3. 提交聚会</li>
        </ul>
        <div class="speed">
        	<div class="view_1 view_2"></div>
        </div>
		<ul class="form2">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id'=>'pledges-form',
                'enableAjaxValidation'=>false,
                'enableClientValidation'=>true,
               'htmlOptions'=>array('name'=>'profile'),
                    'enableAjaxValidation'=>false,
                     'enableClientValidation'=>true,
            )); 
            ?>
            <!--
		  <li class="Pic_Bg"></li>-->
           <div class='pic' id='pic'><?php echo !empty($model->thumb) ? CHtml::image(DIRECTORY_SEPARATOR.RESOURCE.DIRECTORY_SEPARATOR.'meet'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$model->thumb,'',array('width'=>374,'height'=>112)) : '';?></div>
          <li class="Text">从你电脑中选择您喜欢的照片：<p>您可以上传JPG、JPEG、GIF、PNG或BMP文件</p></li>
          <li>
              <!--
              <input type="button" class="AddPic" value=""/>-->
            <?php
                        $this->widget('application.extensions.swfupload.CSwfUpload', array(
                            'jsHandlerUrl'=>'/js/swfupload/handler.js', //Relative path
                            'id'=>'SWFUpload',
                            'postParams'=>array(),
                            'config'=>array(
                                'use_query_string'=>true,
                                'upload_url'=>Yii::app()->createUrl('/api/upload/swfupload',array('folder'=>'meet','ext'=>'thumb','PHPSESSID'=>Yii::app()->session->getSessionId())),
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
            <div class="swfupload"><span id="swfupload"></span><span id='total'></div>
          </li>
       	  <li>
            <?php echo CHtml::submitButton('保存聚会海报',array('class'=>'save')); ?>
          </li>
           <?php $this->endWidget(); ?>
		</ul>
  </div>
  <div class="activeText "><h2>如何才能让你的活动更吸引人？</h2><p>用一张适合的图片代表你的活动，即使你没有专业的设计师。</p>
<p>随意拖拽或调整大图中的虚线区域，预览小图即为裁切后的效果。</p>
<p>高宽比为3:2的图片会得到最完整的显示。</p>
</div> 
</div>
<script>
    
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
        $('#pic').html('<img src="'+msg[0].path+'" width="374" height="112">');
        $('#thumb').val(msg[0].filename);
        this.setButtonDisabled(true);
        document.getElementById(this.customSettings.uploadButtonId).disabled = true;
    }else{
        $('#total').html('文件上传失败,请重新上传');
    }
}
</script>
<style>
    .activeContent .activeForm ul.form2 div.pic{ margin:15px 0;width:374px; height:112px; background:#f5f5f5 url(../images/l_03.jpg) no-repeat center;}
#button{ margin:10px 0;width:157px; height:45px; background:url(../images/btn.png) no-repeat; background-position:-296px -112px; border:none; cursor:pointer;}

</style>
