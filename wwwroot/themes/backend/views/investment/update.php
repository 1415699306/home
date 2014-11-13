<?php
$this->breadcrumbs=array(
    '企政通管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'investment',
    '更新项目 - '.$model->name,
);
?>
<div class="inner">
    <?php $this->renderPartial('_form',array('model'=>$model,'topbar'=>$topbar,'category'=>$category));?>
</div>