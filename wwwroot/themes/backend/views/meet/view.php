<?php
$this->breadcrumbs=array(
    '乐聚会管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'meet',
    '查看 - '.$model->title,
);
?>
<div class="inner">
    <h3>主体内容</h3>
    <?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'title',
        'thumb'=>array(
            'name'=>'thumb',
            'value'=>!empty($model->thumbs->track_id) ? CHtml::image(Storage::getImageBySize($model->thumbs->track_id,'meet','16_9','thumb'),$model->title) : '未设置',
            'type'=>'RAW',
        ),
        'status'=>array(
            'name'=>'status',
            'value'=>$model->status == '0' ? '正常' : '关闭',
        ),
        'discription',
        'category_id'=>array(
            'name'=>'category_id',
            'value'=>$model->categorys->name,
        ),
        'theme_name',
        'start_time'=>array(
            'name'=>'start_time',
            'value'=>!empty($model->ctime) ? date('Y-m-d',$model->ctime) : '没有设定',
        ),
        'off_time'=>array(
            'name'=>'off_time',
            'value'=>!empty($model->ctime) ? date('Y-m-d',$model->ctime) : '没有设定',
        ),
        'locale',
        'ctime'=>array(
            'name'=>'ctime',
            'value'=>!empty($model->ctime) ? date('Y-m-d',$model->ctime) : '没有设定',
        ),
        'mtime'=>array(
            'name'=>'mtime',
            'value'=>!empty($model->mtime) ? date('Y-m-d',$model->mtime) : '没有设定',
        ),
    ),
));
?>
<!--<div class="eminentRelations">  
    <h3>已报名名人</h3>
    <div class="content">
    <?php foreach($model->eminentRelations as $key):?>
    <ul>
        <li><?php echo CHtml::image($key->eminentPerson->avatarImage->track_id,$key->eminentPerson->name);?></li>
        <p><?php echo $key->eminentPerson->name;?></p>
    </ul>
    <?php endforeach;?>
    </div>
</div>-->
</div>
<style>
.eminentRelations{margin-top: 10px;padding: 2px;}
.eminentRelations .content{border:1px solid red;clear: both;overflow: hidden;}
.eminentRelations ul{float: left;text-align: center;font-size: 12px;padding: 5px 0;}
.eminentRelations ul li{float: left;width: 80px;}
.eminentRelations ul li img{width: 40px;height: 40px;}
</style>