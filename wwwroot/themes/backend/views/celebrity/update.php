<?php
$this->breadcrumbs=array(
    '名人绘管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'celebrity',
    '更新名人绘 - '.$model->title,
);
?>
<div class="inner"> 
    <?php $this->renderPartial('_form',array('model'=>$model,'category'=>$category,'newContent'=>$newContent));?>
</div>