<?php
$this->breadcrumbs=array(
    '基本设置'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'global',
	'系统公告管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'global'.DIRECTORY_SEPARATOR.'announcement',
    '查看公告 - '.$model->title
);
?>
<div class="row button">
    <?php echo CHtml::link('修改',$this->createUrl('global/announcementupdate',array('id'=>$model->id))); ?>
</div>
<div class="inner wide form  grid-view farder" id="vi-user-grid-inner"> 
    <?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'title',             // title attribute (in plain text)
        'type'=>array(
            'name'=>'type',
            'value'=>$model->type == '0' ? '前端' : '后台',
        ),
        'expiration_time'=>array(
            'name'=>'expiration_time',
            'value'=>!empty($model->expiration_time) ? date('Y-m-d',$model->expiration_time) : '没有设定',
        ),
        'status'=>array(
            'name'=>'status',
            'value'=>$model->status == '0' ? '开' : '关',
        ),
        'content'=>array(
            'name'=>'content',
            'value'=>$model->content,
            'type'=>'RAW',
        ),
        'ctime'=>array(
            'name'=>'ctime',
            'value'=>!empty($model->ctime) ? date('Y-m-d',$model->ctime) : '没有设定',
        ),
        'mtime'=>array(
            'name'=>'mtime',
            'value'=>!empty($model->mtime) ? date('Y-m-d',$model->mtime) : '没有设定',
        ),
    ),
));
?>
</div>
