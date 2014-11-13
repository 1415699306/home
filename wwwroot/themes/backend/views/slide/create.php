<?php
$this->breadcrumbs=array(
    '幻灯片添加',
);
?>
<div class="inner">
<?php $this->renderPartial(Slide::getViewPath().DIRECTORY_SEPARATOR.'_form',array('model'=>$model,'category'=>$category));?>
</div>