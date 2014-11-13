<?php
$this->breadcrumbs=array(
    '慧学习管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'study',
    '更新慧学习 - '.$model->title,
);
?>
<div class="inner"> 
    <?php $this->renderPartial('_form',array('model'=>$model,'category'=>$category,'newContent'=>$newContent));?>
</div>