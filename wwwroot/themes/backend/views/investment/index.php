<?php
$this->breadcrumbs=array(
    '企政通管理',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
    if($('#Investment_name').val()==''){
        $('#Investment_name').next('span.error').show();
        $('#Investment_name').next('span.error').text('搜索标题不能为空!');
        return false;
    }else{
        $('#Investment_name').next('span.error').hide();
    }
    $('#Investment-grid').yiiGridView('update', {
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
        'id'=>'Investment-grid',
        'pager'=>array('cssFile'=>false,'header'=>false),
        'columns'=>array(
            'id',
            'name',
            'status'=>array(
                'name'=>'status',
                'value'=>'$data->status == "0" ? "正常" : "关闭"',
            ),
            'recommand'=>array(
                'name'=>'recommand',
                'value'=>'$data->recommand == "0" ? "否" : "是"',
            ),
            'channel_recommand'=>array(
                'name'=>'channel_recommand',
                'value'=>'$data->channel_recommand == "0" ? "否" : "是"',
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
        <?php echo CHtml::form('/backend/investment/beforce','GET');?>
        <?php echo CHtml::radioButtonList('id',1, array('1'=>'开发模式','2'=>'模板模式'),array('separator'=>'','template'=>'<li>{input}{label}</li>'));?>
        <?php echo CHtml::submitButton('添加',array('class'=>'submit'));?>
        <?php echo CHtml::endForm();?>
    </div>
</div>
<style>
    .row span li input{float: left;}
</style>