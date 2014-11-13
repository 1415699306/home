<?php
$this->breadcrumbs=array(
    '奢生活管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'study',
    '添加奢生活'
);
?>
<div class="inner"> 
    <?php $this->renderPartial('_form',array('model'=>$model,'category'=>$category,'newContent'=>$newContent));?>
</div>