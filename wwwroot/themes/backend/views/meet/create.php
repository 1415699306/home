<?php
$this->breadcrumbs=array(
    '乐聚会管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'meet',
    '添加聚会预告',
);
?>
<div class="inner">
    <?php $this->renderPartial('form/_form',array('model'=>$model,'category'=>$category,'dataProvider'=>$dataProvider,'newContent'=>$newContent));?>
</div>
<style>
    .template ul{width: 94px;float: left;margin-right: 5px;}
    .template ul li img{border: 1px solid #ccc; padding:1px;}
    .template ul p{text-align: center;width: 94px;}
</style>