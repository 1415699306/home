<?php
$this->breadcrumbs=array(
	 '乐聚会管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'meet',
     '聚会报名'
);
Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
    $('#meet-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
");
?>
<div class="inner"> 
    <?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
    <div class="search-form" style="display:none">
    <?php $this->renderPartial('form/_signSearch',array('model'=>$model,)); ?>
    </div>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$model->Search(),
        'id'=>'meet-sign-grid',
        'pager'=>array('cssFile'=>false,'header'=>false),
        'columns'=>array(
            'id',
            'meet'=>array(
                'name'=>'meet',
                'value'=>'$data->meet->title',
            ),
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
                'value'=>'date("Y-m-d",$data->ctime)',
            ),
            array(            // display a column with "view", "update" and "delete" buttons
                'class'=>'CButtonColumn',
                'header'=>'操作',
                'viewButtonUrl'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/meet/signview",array("id"=>$data->id))',
                'updateButtonUrl'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/meet/signupdate",array("id"=>$data->id))',
                'deleteButtonUrl'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/meet/signdelete",array("id"=>$data->id))',
            ),
        ),
    ));
    ?> 
</div>