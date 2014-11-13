<?php 
$js = Yii::app()->clientScript;$js->registerCssFile('/css/view.css');$js->registerScriptFile('/js/fancy/jquery.fancybox.js');$js->registerCssFile('/js/fancy/jquery.fancybox.css'); $this->pageTitle='奢生活_'.$model->title.'_乐荟网';
$this->breadcrumbs=array(
    '奢生活'=>Yii::app()->createUrl($this->module->id),
    $model->category->name=>Yii::app()->createUrl($this->module->id.'/list/category',array('id'=>$model->category->id)),
    $model->title,
);
?>
<div class="main">
<div class="news_left">
	<div class="news_top">
    	<div class="title">
        	<h1><?php echo CHtml::encode($model->title);?></h1>
            <?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'public_top_list');?>
            <div class="new_content"><?php echo  BaseApp::pageByContent($model->lifeContent->content,$model->lifeContent->pages);?></div>
            <?php $this->widget('ext.widgets.listpage.IListPage',array('model'=>$model));?>
        </div>
    </div> 
<?php $this->widget('ext.widgets.recommand.IRcommand',array('model'=>$model));?>
<?php $this->widget('ext.widgets.read.IRead',array('model'=>$model,'module'=>$this->module->id));?>
<?php $this->widget('ext.widgets.countupload.ICountUpload',array('app_id'=>BaseApp::LIFE,'res_id'=>$model['id']));?>
<div class="Comment">
    <div class="Comment_title"><span></span>网友评论：<i><?php echo PublicComment::getCommantCount(Yii::app()->request->getParam('id'),BaseApp::LIFE);?></i> 人参与评论</div>
     <?php $this->widget('ext.widgets.publicComment.IPbulicCommant',array('id'=>$model->id,'app_id'=>BaseApp::LIFE));?>
 </div>                    
</div>
    <div class="content_right">
        <?php $this->widget('ext.widgets.rightlist.INewsList',array('model'=>'Life','title'=>'最新发布','app_id'=>BaseApp::LIFE));?>
        <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::LIFE,'res_id'=>71,'type'=>1,'width'=>312));?>
        <?php $this->widget('ext.widgets.tag.ICloudTags',array('title'=>'云标签','app_id'=>BaseApp::LIFE));?>
   </div>
</div>
