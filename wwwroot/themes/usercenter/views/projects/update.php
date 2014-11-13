<?php
$js = Yii::app()->getClientScript();
$js->registerScriptFile('/js/ueditor/ueditor.config.js');
$js->registerScriptFile('/js/ueditor/ueditor.all.min.js');
$js->registerCssFile('/js/ueditor/themes/default/css/ueditor.css');
$default = 0;
?>
<div class='RightDiv'>
<?php  $this->renderPartial('webroot.themes.usercenter.views.projects._form._form',array('model'=>$model,'category'=>$category));?>       
</div> 
