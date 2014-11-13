<?php
$this->breadcrumbs=array(
    '幻灯片更新',
);
?>
<div class="inner">
<?php $this->renderPartial(Slide::getViewPath().DIRECTORY_SEPARATOR.'_form',array('model'=>$model,'category'=>$category));?>
</div>