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
        	<div class="view_1 view_3"></div>
        </div>
		<ul class="form">
             <?php $form = $this->beginWidget('CActiveForm', array(
                'id'=>'end-form',
                'enableAjaxValidation'=>false,
                'enableClientValidation'=>true,
               'htmlOptions'=>array('name'=>'profile'),
                    'enableAjaxValidation'=>false,
                     'enableClientValidation'=>true,
            )); 
            ?>
            <li>
                <div class="success"><h2>聚会创建成功</h2><p>乐荟管理员会在2个工作日审核你的活动内容，并将审核结果通过乐荟邮箱发给你。</p>
                <p>接下来请创建报名表，你也可以日后在活动页面完成。</p></div>
            </li>    
            <li>
                <span class="hidden_id"><?php echo $id;?></span>
              <?php echo CHtml::submitButton('好了，提交',array('class'=>'save','id'=>'update')); ?>
              <?php echo CHtml::submitButton('以后再说',array('class'=>'later')); ?>
            </li>
             <?php $this->endWidget(); ?>
		</ul>
  </div>
</div>
<style>
.hidden_id{display:none;}
</style>
<script>
$('#update').live('click',function(){
       var id = $(".hidden_id").html();
       if(id){
            window.open("http://www.lfeel.com");
       } 
 });
</script>
  

