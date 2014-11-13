<?php
$this->breadcrumbs=array(
	'乐聚荟管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'meet',
    '乐聚荟报名管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.'/meet/sign',
    '查看乐聚荟报名 - '.$model->company
);
?>
<div class="inner"> 
    <?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'user_name',
        'phone',
        'tel',
        'address',
        'company',
        'job',
        'number',
        'email',
        'ctime'=>array(
            'name'=>'ctime',
            'value'=>!empty($model->ctime) ? date('Y-m-d',$model->ctime) : '没有设定',
        ),
    ),
));
?>
</div>
