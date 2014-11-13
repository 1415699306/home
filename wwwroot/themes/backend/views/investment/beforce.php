<?php
$this->breadcrumbs=array(
    '企政通管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'investment',
    '第二步->添加主要内容',
);
?>
<div class="inner">
    <h6><?php echo $_GET['id'] == 1 ? '开发模式' : '模板模式';?></h6>
    <?php $this->renderPartial('_form',array('model'=>$model,'topbar'=>$topbar,'category'=>$category));?>
</div>
