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
        	<div class="view_1"></div>
        </div>
		<ul class="form">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id'=>'meet-form',
                'enableAjaxValidation'=>false,
                'enableClientValidation'=>true,
               'htmlOptions'=>array('name'=>'profile'),
                    'enableAjaxValidation'=>false,
                     'enableClientValidation'=>true,
            )); 
            ?>
              <li>
                  <label>聚会类型</label>
                  <div class="bor">
                      <?php echo $form->dropDownList($model,'category_id',$category,array('onChange'=>'select()')); ?>
                  </div>
              </li>
              <li>
                  <label>聚会标题</label>
                     <?php echo $form->textField($model,'title',array('class'=>'MeetTitle')); ?>
                     <?php echo $form->error($model,'title'); ?>
              </li>
              <li>
              <label>聚会时间</label>
              <div class="example">
                <input type="text" value="聚会日期" class="date"/> 
                    <?php echo $form->textField($model,'start_time',array('class'=>'star','onclick'=>"WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'%y-%M-%d'})",'value'=>is_numeric($model->start_time)?date('Y-m-d',$model->start_time):$model->start_time)); ?>
                <em></em>至
                     <?php echo $form->textField($model,'off_time',array('class'=>'over','onclick'=>"WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'%y-%M-%d'})",'value'=>is_numeric($model->off_time)?date('Y-m-d',$model->off_time):$model->off_time)); ?>
                <em></em>
              </div>
              </li>
              <li>
                <label>聚会地点</label>  
                    <div class="bor">
                      <?php  echo $form->dropDownList($model,'province',array(),array('id'=>'province')); ?>
                    <?php  echo $form->dropDownList($model,'city',array(),array('id'=>'city')); ?>
                       <SCRIPT language=javascript>InitCitySelect(document.province,document.profile.city);</SCRIPT>
                    </div>
                       
            </li>
                <?php echo $form->textField($model,'locale',array('class'=>'adress')); ?>
             <li>
                  <label>聚会详情</label>
                  <?php echo $form->textArea($model,'discription',array('class'=>'Detail')); ?>
                  <?php echo $form->error($model,'discription'); ?>
             </li>
             <li>
                  <label>聚会费用</label>
                  <div class="free">
                    <input type="radio" name="" value="free"/>免费
                  </div>
                  <div class="charge">
                    <input type="radio" checked="checked" value="charge"/>收费
                  </div>
                  <div class="example">
                    <dl>
                        <dt><p class="name">名称 <span>（如：预售票等）</span></p><p class="rate">费用（元）</p></dt>
                        <dd><input type="text" class="appellation"/><input type="text" class="rate" /></dd>
                        <dd><input type="text" class="appellation"/><input type="text" class="rate" /><a href="#" class="close"></a></dd>
                        <a href="#">添加费用</a>
                    </dl>
                  </div>
              </li>
              <li>
                  <label>参加权限</label>
                  <div class="checkbox">
                      <!--
                      <input type="checkbox" class="box"/>只有被邀请的成员才能参加</div>
                      -->
                      
                      <?php echo $form->RadioButtonList($model,'status',array(
                        '0'=>'ok',
                        '1'=>'error',
                        ),array('template'=>'{input} {label}','class'=>'box')); ?>
                      <!--
                  <div class="checkbox m_left">
                      <input type="checkbox" class="box"/>参加者需要提前填写报名表
                  </div>-->
                  </div>
              </li>
              <li>
                  <label>聚会标签</label>
                    <?php echo $form->textField($model,'tags',array('class'=>'MeetTitle')); ?>
              </li>
              <li class="last">
                  <?php echo CHtml::submitButton('保存，下一步',array('class'=>'save')); ?>
              </li>
               <?php $this->endWidget(); ?>
		</ul>
        
        
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
    <div class="activeText">
        <h2>如何才能让你的活动更吸引人？</h2><p>1.标题简单明了</p>
        <p>2.聚会内容和特点介绍详细</p>
        <p>3.聚会海报吸引人眼球</p>
        <p>更重要的是，邀请好友们都来参与！</p>
    </div>
  </div>
<script>
   $(function(){
       $(".form2").css("display","none");
   });     
</script>
