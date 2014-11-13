<?php
$this->breadcrumbs=array(
    '乐聚荟'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'meet',
    '查看广告 - '.$model->name
);
?>
<div class="inner"> 
    <?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'name',
        'thumb'=>array(
            'name'=>'thumb',
            'value'=>!empty($model->thumbs->track_id) ? CHtml::image(Storage::getImageBySize($model->thumbs->track_id,'advertising','16_9','thumb'),$model->name) : '未设置',
            'type'=>'RAW',
        ),
        'type'=>array(
            'name'=>'type',
            'value'=>$model->status == '0' ? '文字' : '图片',
        ),
        'status'=>array(
            'name'=>'status',
            'value'=>$model->status == '0' ? '正常' : '关闭',
        ),
        'discription'=>array(
            'name'=>'discription',
            'value'=>$model->discription,
        ),
        'start_time'=>array(
                'name'=>'start_time',
                'value'=>date("Y-m-d",$model->start_time),
            ),
        'off_time'=>array(
            'name'=>'off_time',
            'value'=>date("Y-m-d",$model->off_time),
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