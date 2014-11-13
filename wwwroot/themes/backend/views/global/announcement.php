<?php
$this->breadcrumbs=array(
    '基本设置'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'global',
	'系统公告管理',
);
?>
<div class="inner"> 
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$model->Search(),
        'id'=>'announcement-form',
        'pager'=>array('cssFile'=>false,'header'=>false),
        'columns'=>array(
            'id',
            'title',
            'type'=>array(
                'name'=>'type',
                'value'=>'$data->type == "0" ? "前端" : "后端"',
            ),
            'status'=>array(
                'name'=>'status',
                'value'=>'$data->status == "0" ? "正常" : "关闭"',
            ),
            'ctime'=>array(
                'name'=>'ctime',
                'value'=>'date("Y-m-d",$data->ctime)',
            ),
            'expiration_time'=>array(
                'name'=>'expiration_time',
                'value'=>'date("Y-m-d",$data->expiration_time)',
            ),
            array(            // display a column with "view", "update" and "delete" buttons
                'class'=>'CButtonColumn',
                'header'=>'操作',
                'deleteButtonUrl'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/global/announcementdelete",array("id"=>$data->id))',
                'viewButtonUrl'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/global/announcementview",array("id"=>$data->id))',
                'updateButtonUrl'=>'Yii::app()->createUrl("/'.BACKEND_URL.'/global/announcementupdate",array("id"=>$data->id))',
            ),
        ),
    ));
    ?>      
    <div class="row button">
        <?php echo CHtml::link('添加',$this->createUrl('global/announcementcreate')); ?>
    </div>
</div>