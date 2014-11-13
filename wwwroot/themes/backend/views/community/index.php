<?php
$this->breadcrumbs=array(
	'公益行管理',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
    $('#article-grid').yiiGridView('update', {
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
        'id'=>'article-grid',
        'pager'=>array('cssFile'=>false,'header'=>false),
        'columns'=>array(
            'id',
            'title',
            'category_id'=>array(
                'name'=>'category_id',
                'value'=>'$data->category->name',
            ),
            'recommand'=>array(
                'name'=>'recommand',
                'value'=>'$data->recommand == "0" ? "否" : "是"',
            ),
            'channel_recommand'=>array(
                'name'=>'channel_recommand',
                'value'=>'$data->channel_recommand == "0" ? "否" : "是"',
            ),
            'status'=>array(
                'name'=>'status',
                'value'=>'$data->status == "0" ? "正常" : "关闭"',
            ),
            'ctime'=>array(
                'name'=>'ctime',
                'value'=>'date("Y-m-d",$data->ctime)',
            ),
            array(            // display a column with "view", "update" and "delete" buttons
                'class'=>'CButtonColumn',
                'header'=>'操作',
            ),
        ),
    ));
    ?>      
    <div class="row button">
        <?php echo CHtml::link('添加',$this->createUrl('community/create')); ?>
    </div>
</div>