<?php
$this->breadcrumbs=array(
    '基本设置'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'global',
	'系统公告管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'global'.DIRECTORY_SEPARATOR.'announcement',
    '更新公告 - '.$model->title,
);
?>
<div class="inner"> 
    <?php $this->renderPartial('form/_announcementForm',array('model'=>$model,'newContent'=>$newContent));?>
</div>