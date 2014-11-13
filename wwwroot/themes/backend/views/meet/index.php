<?php
$this->breadcrumbs=array(
	'乐聚会管理'
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
    <?php $this->renderPartial('_search',array('model'=>$model,)); ?>
    </div>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$model->Search(),
        'id'=>'meet-grid',
        'pager'=>array('cssFile'=>false,'header'=>false),
        'columns'=>array(
            'id',
            'title',
            'theme_name',
            'locale',
            'status'=>array(
                'name'=>'status',
                'value'=>'$data->status=="0" ? "正常":"关闭"',
            ),
            'start_time'=>array(
                'name'=>'start_time',
                'value'=>'date("Y-m-d",$data->ctime)',
            ),
            'off_time'=>array(
                'name'=>'off_time',
                'value'=>'date("Y-m-d",$data->off_time)',
            ),
            array(            // display a column with "view", "update" and "delete" buttons
                'class'=>'CButtonColumn',
                'header'=>'操作',
            ),
        ),
    ));
    ?> 
    <div class="row button">
        <?php echo CHtml::link('添加',$this->createUrl('meet/create')); ?>
    </div>
</div>