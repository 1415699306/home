<?php $js = Yii::app()->clientScript;$js->registerCssFile('/css/view.css');$js->registerScriptFile('/js/fancy/jquery.fancybox.js');$js->registerCssFile('/js/fancy/jquery.fancybox.css');?>
<?php $this->pageTitle='新闻_'.$model->title.'_乐荟网';?>
<div class="main">
<?php
$this->breadcrumbs=array(
    $model->title,
);
?>
<div class="news_left">
	<div class="news_top">
    	<div class="title">
        	<h1><?php echo CHtml::encode($model->title);?></h1> 
            <?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'public_top_list');?>
            <div class="new_content"><?php echo  BaseApp::pageByContent($model->articleContent->content,$model->articleContent->pages);?></div>
            <?php $this->widget('ext.widgets.listpage.IListPage',array('model'=>$model));?>
        </div>
    </div> 
<?php $this->widget('ext.widgets.read.IRead',array('model'=>$model,'module'=>$this->module->id));?>
<?php $this->widget('ext.widgets.countupload.ICountUpload',array('app_id'=>BaseApp::MATION,'res_id'=>$model['id']));?>
<div class="Comment">
<div class="Comment_title"><span></span>网友评论：<i>20</i> 人参与评论</div>
    <?php $this->widget('ext.widgets.publicComment.IPbulicCommant',array('id'=>$model->id,'app_id'=>BaseApp::MATION));?>
 </div>                     
</div>
<div class="content_right">
        <div class="content news"><h3><em>最新发布</em></h3>
            <?php foreach($right as $k=>$v):?>
            <ul>
                <li><span><?php echo ($k+1);?></span><?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($v['title'],20,false)),$this->createUrl('/article/list/view',array('id'=>$v->id)));?></li>
            </ul>
            <?php endforeach;?>
        </div>
   
   </div>
</div>