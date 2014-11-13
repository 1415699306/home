<?php
$this->breadcrumbs=array(
    '企政通管理问题管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'investment',
    '管理列表',
);
?>
<div class="inner">
    <div class="noitce">
        <h3>温馨提示:</h3>
        <p>当鼠标悬停在【留言】的时候完整的信息就会显示出来。</p>
    </div>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$model->Search(BaseApp::INVESTMENT),
        'id'=>'Advisory-grid',
        'filter'=>$model,
        'pager'=>array('cssFile'=>false,'header'=>false),
        'columns'=>array(
            'id',
            'name',
            'phone',
            'tel'=>array(
                'name'=>'tel',
                'value'=>'!empty($data->tel) ? $data->tel : "未填写"',
            ),
            'address',
            'qq'=>array(
                'name'=>'qq',
                'value'=>'!empty($data->qq) ? $data->qq : "未填写"',
            ),
            'email'=>array(
                'name'=>'email',
                'value'=>'!empty($data->email) ? $data->email : "未填写"',
            ),
            'return_time'=>array(
                'name'=>'return_time',
                'value'=>'date("Y-m-d",$data->return_time)',
                'filter'=>false,
            ),
            'content'=>array(
                'name'=>'content',
                'value'=>'CHtml::tag("span",array("title"=>$data->content)).Helper::truncate_utf8($data->content,10).CHtml::closeTag("span")',
                'type'=>'RAW',
                'filter'=>false,
            ),          
            'ctime'=>array(
                'name'=>'ctime',
                'value'=>'date("Y-m-d",$data->ctime)',
                'filter'=>false,
            ),
            array(            // display a column with "view", "update" and "delete" buttons
                'class'=>'CButtonColumn',
                'header'=>'操作',
                'template'=>'{delete}',
                'deleteButtonUrl'=>'Yii::app()->createUrl("/backend/investment/deleteadvisory",array("id"=>$data->id))',               
            ),
        ),
    ));
    ?>    
</div>
<style>
.inner .noitce{border: 1px solid #ccc;margin-bottom: 10px;padding: 5px;border-radius: 5px;-webkit-box-shadow: 0 0 8px rgba(0,0,0,0.3);-moz-box-shadow: 0 0 8px rgba(0,0,0,0.3);box-shadow: 0 0 8px rgba(0,0,0,0.3);}
</style>