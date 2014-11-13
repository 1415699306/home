<?php
$this->breadcrumbs=array(
	'公益行管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'life',
    '查看公益行 - '.$model->title
);
?>
<div class="inner"> 
    <?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'title',
        'thumb'=>array(
            'name'=>'thumb',
            'value'=>!empty($model->thumbs->track_id) ? CHtml::image(Storage::getImageBySize($model->thumbs->track_id,'community','16_9','thumb')) : '未设置',
            'type'=>'RAW',
        ),
        'status'=>array(
            'name'=>'status',
            'value'=>$model->status == '0' ? '正常' : '关闭',
        ),
        'discription'=>array(
            'name'=>'discription',
            'value'=>$model->discription,
        ),
         'content'=>array(
            'name'=>'文章内容',
            'value'=>$model->communityContent->content,
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
