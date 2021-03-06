<?php
$this->breadcrumbs=array(
    '幻灯片管理',
);
?>

<div class="inner">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$model->search($this->getAction('slide')->app_id),
        'pager'=>array(
            'header'=>false,
        ),
        'columns'=>array(
            'id',
            'name',
            'res_id'=>array(
                'name'=>'res_id',
                'value'=>'$data->categorys->name',
            ),
            'status'=>array(
                'name'=>'status',
                'value'=>'$data->status=="1"?"关闭":"开启"',
            ),
            'start_time'=>array(
                'name'=>'start_time',
                'value'=>'date("Y-m-d",$data->start_time)',
            ),
            'off_time'=>array(
                'name'=>'off_time',
                'value'=>'date("Y-m-d",$data->off_time)',
            ),
            array(
                'class'=>'CButtonColumn',
                'viewButtonUrl'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/'.$this->id.'/slideview",array("id"=>$data->id))',
                'updateButtonUrl'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/'.$this->id.'/slideupdate",array("id"=>$data->id))',
                'deleteButtonUrl'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/'.$this->id.'/slidedelete",array("id"=>$data->id))',
            ),
        ),
    ));
    ?>
    <div class="row button">
        <?php echo CHtml::link('添加',$this->createUrl('slidecreate'));?>
    </div>
</div>
