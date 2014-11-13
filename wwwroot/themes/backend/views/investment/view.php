<?php
$this->breadcrumbs=array(
    '企政通管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'investment',
    '项目查看 - '.$model->name,
);
?>
<div class="inner">
<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'name',
        'type'=>array(
            'name'=>'type',
            'value'=>$model->type == '0' ? '模板类型' : '编程类型',
        ),
        'status'=>array(
            'name'=>'status',
            'value'=>$model->status == '0' ? '正常' : '关闭',
        ),
        'deadline'=>array(
            'name'=>'deadline',
            'value'=>!empty($model->deadline) ? date('Y-m-d',$model->deadline) : '没有设定',
        ),
        'message'=>array(
            'name'=>'message',
            'value'=>$model->message == '0' ? '开启' : '关闭',
        ),
        'discription',
        'contacts',
        'tel',
        'address',
        'email',
        'website',
        'seo_keyword',
        'seo_discription',        
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
<?php echo CHtml::link('查看详细页面',$this->createUrl('/investment/list',array('id'=>$model->id)),array('target'=>'_blank'));?>
</div>