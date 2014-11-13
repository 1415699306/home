<?php
$this->breadcrumbs=array(
    '商机汇更新',
);
?>
<div class="inner"> 
    <?php $this->renderPartial('form/_form',array('model'=>$model,'category'=>$category,'newContent'=>$newContent));?>
</div>