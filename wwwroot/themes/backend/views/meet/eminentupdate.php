<?php
$this->breadcrumbs=array(
    '乐聚会管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'meet',
    '名人管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'eminent',
    '更新名人 - '.$model->name,
);
?>
<div class="inner">
    <?php $this->renderPartial('form/_eminentform',array('model'=>$model));?>
</div>
<style>
    .template ul{width: 94px;float: left;margin-right: 5px;}
    .template ul li img{border: 1px solid #ccc; padding:1px;}
    .template ul p{text-align: center;width: 94px;}
</style>