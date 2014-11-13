<?php
$this->breadcrumbs=array(
    '企政通管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'investment',
    '第一步->选择模板',
);
?>
<div class="inner">
    <div class="template">
        <?php (int)$i = 1;?>
        <?php foreach($path as $key=>$img):?>
        <ul>
            <li><?php echo CHtml::image($img,$key);?></li>
            <p><?php echo CHtml::link(Investment::getTemplateName($key+1),$this->createUrl('create',array('type'=>$i)));?></p>
        </ul>
        <?php ++$i;?>
        <?php endforeach; ?>
    </div>       
</div>
<style>
    .template ul{width: 94px;float: left;margin-right: 5px;}
    .template ul li img{border: 1px solid #ccc; padding:1px;}
    .template ul p{text-align: center;width: 94px;}
</style>