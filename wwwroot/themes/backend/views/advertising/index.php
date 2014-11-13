<?php
$this->breadcrumbs=array(
    '广告管理',
);
?>
<div class="inner">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$model->search($this->getAction('advertising')->app_id),
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
            'type'=>array(
                'name'=>'type',
                'value'=>'$data->type=="1"?"文字":"图片"',
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
                'viewButtonUrl'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/'.$this->id.'/advertisingview",array("id"=>$data->id))',
                'updateButtonUrl'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/'.$this->id.'/advertisingupdate",array("id"=>$data->id))',
                'deleteButtonUrl'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/'.$this->id.'/advertisingdelete",array("id"=>$data->id))',
            ),
        ),
    ));
    ?>
    <div class="row button">
        <?php echo CHtml::link('添加',$this->createUrl('advcreate'));?>
    </div>
</div>
