<?php
$this->breadcrumbs=array(
    '基本设置'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'global',
	'系统分类管理',
);
?>
<div class="inner"> 
    <?php $this->widget('ext.category.widgets.TreeWidget',array('modelName'=>'Category'));?>
</div>