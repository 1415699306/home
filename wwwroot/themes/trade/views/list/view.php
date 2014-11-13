<?php $js = Yii::app()->clientScript;$js->registerCssFile('/css/view.css');$js->registerScriptFile('/js/fancy/jquery.fancybox.js');$js->registerCssFile('/js/fancy/jquery.fancybox.css');?>
<?php $this->pageTitle='商机汇_'.$model->title.'_乐荟网';?>
<div class="main">
<?php
$this->breadcrumbs=array(
    '商机汇'=>DIRECTORY_SEPARATOR.$this->module->id,
    $model->title,
);
?>
<div class="news_left">
	<div class="news_top">
    	<div class="title">
        	<h1><?php echo CHtml::encode($model->title);?></h1>
            <?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'public_top_list');?>
            <div class="new_content"><?php echo  BaseApp::pageByContent($model->tradeContent->content,$model->tradeContent->pages);?></div>
            <?php $this->widget('ext.widgets.listpage.IListPage',array('model'=>$model));?>
        </div>
    </div> 
<?php $this->widget('ext.widgets.read.IRead',array('model'=>$model,'module'=>$this->module->id));?>
<?php $this->widget('ext.widgets.countupload.ICountUpload',array('app_id'=>BaseApp::TRADE,'res_id'=>$model['id']));?>
<div class="Comment">
<div class="Comment_title"><span></span>网友评论：<i>20</i> 人参与评论</div>
    <?php $this->widget('ext.widgets.publicComment.IPbulicCommant',array('id'=>$model->id,'app_id'=>BaseApp::TRADE));?>
 </div>                     
</div>
<div class="content_right">
        <div class="content news"><h3><em>最新发布</em></h3>
            <?php foreach($right as $k=>$v):?>
            <ul>
                <li><span><?php echo ($k+1);?></span><?php echo CHtml::link(CHtml::encode($v->title),$this->createUrl('/trade/list/view',array('id'=>$v->id)));?></li>
            </ul>
            <?php endforeach;?>
        </div>
        <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::TRADE,'res_id'=>70,'type'=>1,'width'=>312));?>
   </div>
</div>
