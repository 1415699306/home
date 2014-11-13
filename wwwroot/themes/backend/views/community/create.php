<?php
$this->breadcrumbs=array(
    '公益行管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'community',
    '添加公益行'
);
?>
<div class="inner"> 
    <?php $this->renderPartial('_form',array('model'=>$model,'category'=>$category,'newContent'=>$newContent));?>
</div>