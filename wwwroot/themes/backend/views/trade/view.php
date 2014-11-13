<?php
$this->breadcrumbs=array(
	'商机汇管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'life',
    '查看商机汇 - '.$model->title
);
?>
<div class="inner"> 
    <?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'title',
        'highlighted'=>array(
            'name'=>'highlighted',
            'value'=>$model->highlighted == '0' ? '否' : '是',
        ),
        'status'=>array(
            'name'=>'status',
            'value'=>$model->status == '0' ? '正常' : '关闭',
        ),
        'type'=>array(
            'name'=>'type',
            'value'=>$model->type == '0' ? '文字' : '图片',
        ),
         'content'=>array(
            'name'=>'文章内容',
            'value'=>$model->tradeContent->content,
            'type'=>'RAW',
        ),
        'start_time'=>array(
            'name'=>'start_time',
            'value'=>!empty($model->ctime) ? '<font color=red>'.date('Y-m-d H:i:s',$model->start_time).'</font>' : '没有设定',
            'type'=>'RAW',
        ),
        'stop_time'=>array(
            'name'=>'stop_time',
            'value'=>!empty($model->ctime) ? '<font color=red>'.date('Y-m-d H:i:s',$model->stop_time).'</font>' : '没有设定',
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
        'min_thumb'=>array(
            'name'=>'min_img',
            'value'=>CHtml::image($model->min_thumb),
            'type'=>'RAW',
        ),
        'big_thumb'=>array(
            'name'=>'big_img',
            'value'=>CHtml::image($model->big_thumb),
            'type'=>'RAW',
        ),
    ),
));
?>
</div>
