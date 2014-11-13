<?php 
    $js = Yii::app()->getClientScript();
    $js->registerCssFile(Yii::app()->theme->baseUrl.'/css/gx.css');
?>

<div class="gxy_banner">
    <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::COMMUNITY,'res_id'=>85,'type'=>1,'width'=>1250));?>
</div>
<div class="content_left">
    <div class="content">
        <h3><?php echo Category::getTitleName(Yii::app()->request->getParam('id'));?></h3>
        <?php if(empty($model)):?><p>暂无数据</p><?php endif;?>
        <div class="img_list">
            <?php foreach($model as $key):?>
            <div class="img_list_body">
                <h2><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($key['track_id'],'community','4_3','thumb'),$key['title'],array('width'=>200,'height'=>180)),$this->createUrl('/community/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></h2>
                <h5><?php echo CHtml::link(CHtml::encode($key['title']),$this->createUrl('/community/list/view',array('id'=>$key['id'])),array('title'=>$key['title'],'target'=>'_blank'));?></h5>
                <i><?php echo date('Y-m-d',$key['ctime']);?></i>
                <p><?php echo CHtml::encode($key['discription']);?></p>
            </div>
            <?php endforeach;?>
        </div>
        <?php $this->widget('CLinkPager', array(
            'pages' => $pages,
            'header'=>false,
        )) ?>
    </div>
</div>
<style>
.box .nav .mid a {
display: block;
float: left;
width: 90px;
_width: 100px;
height: 52px;
border-left: 1px solid #2f3640;
border-right: 1px solid #0b0e13;
color: #fff;
text-align: center;
line-height: 52px;
font-size: 14px;
text-decoration: none;}
</style>