<?php
$this->breadcrumbs=array(
   '系统首页',
);
?>
<div class="inner">
    <h3><?php echo Yii::app()->user->name;?> - 欢迎归来</h3>
    <div class="announcement">
        <h5>最新内部系统公告</h5>
        <ul>
        <?php foreach($announcement as $key):?>
            <li>
                <span><?php echo date('Y-m-d',$key->ctime);?></span>
                <?php echo CHtml::link(CHtml::encode($key->title),$this->createUrl(DIRECTORY_SEPARATOR.BACKEND_URL.'/global/announcementview',array('id'=>$key->id)),array('target'=>'_blank'));?>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>