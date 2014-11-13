<?php
$this->breadcrumbs=array(
    '广告添加',
);
?>
<div class="inner">
<?php $this->renderPartial(Advertising::getViewPath().DIRECTORY_SEPARATOR.'_form',array('model'=>$model,'category'=>$category));?>
</div>