<?php
$js = Yii::app()->getClientScript();
$js->registerCssFile(Yii::app()->theme->baseUrl.'/css/tag.css');
$this->pageTitle='云标签_'.Yii::app()->request->getParam('tag').'_乐荟网'
?>
<div class="nav_link">您当前所在位置：<a href="/site.html">乐荟首页</a> » <span>云标签</span></div>
<div class="content_left">
    <div class="content">
        <h3>标签:<?php echo Yii::app()->request->getParam('tag');?></h3>
        <div class="img_list">
            <?php if(empty($models)):?>暂无数据!<?php endif;?>
            <?php foreach($models as $key):?>
            <div class="img_list_body">
                <h5><?php echo CHtml::link(CHtml::encode($key['title']),$this->createUrl('/'.Yii::app()->request->getParam('act').'/list/view',array('id'=>$key['id'])),array('title'=>$key['title'],'target'=>'_blank'));?>- <?php echo Helper::time_tran($key['ctime']);?></h5>
                <p><?php echo CHtml::encode($key['discription']);?></p>
            </div>
            <?php endforeach;?>
            <?php $this->widget('CLinkPager', array(
                'pages' => $pages,
                'header'=>false,
            )) ?>
        </div>
    </div>
</div>
<style>
.box .nav .mid a {display: block;float: left;width: 90px;_width: 100px;height: 52px;border-left: 1px solid #2f3640;border-right: 1px solid #0b0e13;color: #fff;text-align: center;line-height: 52px;font-size: 14px;text-decoration: none;}
</style>