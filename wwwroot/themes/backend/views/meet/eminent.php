<?php
$this->breadcrumbs=array(
    '乐聚会管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'meet',
	'名人管理'
);
Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
    $('#eminent-grid').yiiGridView('update', {
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
    <?php $this->renderPartial('_eminentsearch',array('model'=>$model,)); ?>
    </div>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$model->Search(),
        'id'=>'eminent-grid',
        'pager'=>array('cssFile'=>false,'header'=>false),
        'columns'=>array(
            'id',
            'name',
            'avatar'=>array(
                'name'=>'avatar',
                'value'=>'!empty($data->avatarImage->track_id)? CHtml::image($data->avatarImage->track_id,$data->name,array("width"=>"20","height"=>"20")) : ""',
                'type'=>'RAW',
            ),
            array(            // display a column with "view", "update" and "delete" buttons
                'class'=>'CButtonColumn',
                'header'=>'操作',
                'template'=>'{update}{delete}',               
                'updateButtonUrl'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/meet/eminentupdate",array("id"=>$data->id))',
                'deleteButtonUrl'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/meet/eminentdelete",array("id"=>$data->id))',
            ),
        ),
    ));
    ?> 
    <div class="row button">
        <?php echo CHtml::link('添加',$this->createUrl('meet/eminentcreate')); ?>
    </div>
</div>