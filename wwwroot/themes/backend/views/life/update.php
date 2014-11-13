<?php
$this->breadcrumbs=array(
    '奢生活管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'life',
    '更新奢生活 - '.$model->title,
);
?>
<div class="inner"> 
    <?php $this->renderPartial('_form',array('model'=>$model,'category'=>$category,'newContent'=>$newContent));?>
</div>