<?php $js = Yii::app()->clientScript;$js->registerCssFile('/css/view.css');$js->registerScriptFile('/js/fancy/jquery.fancybox.js');$js->registerCssFile('/js/fancy/jquery.fancybox.css');?>
<?php $this->pageTitle='公益行_'.$model->title.'_乐荟网';?>
<div class="main">
<?php
$this->breadcrumbs=array(
    '公益行'=>DIRECTORY_SEPARATOR.$this->module->id,
    $model->title,
);
?>
<div class="news_left">
	<div class="news_top">
    	<div class="title">
        	<h1><?php echo CHtml::encode($model->title);?></h1>
            <?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'public_top_list');?>
            <div class="new_content"><?php echo  BaseApp::pageByContent($model->communityContent->content,$model->communityContent->pages);?></div>
            <?php $this->widget('ext.widgets.listpage.IListPage',array('model'=>$model));?>
        </div>
    </div> 
<?php $this->widget('ext.widgets.recommand.IRcommand',array('model'=>$model));?>
<?php $this->widget('ext.widgets.read.IRead',array('model'=>$model,'module'=>$this->module->id));?>
<?php $this->widget('ext.widgets.countupload.ICountUpload',array('app_id'=>BaseApp::COMMUNITY,'res_id'=>$model['id']));?>
<div class="Comment">
<div class="Comment_title"><span></span>网友评论：<i>20</i> 人参与评论</div>
    <?php $this->widget('ext.widgets.publicComment.IPbulicCommant',array('id'=>$model->id,'app_id'=>BaseApp::COMMUNITY));?>
 </div>                  
</div>
    <div class="content_right">
        <?php $this->widget('ext.widgets.rightlist.INewsList',array('model'=>'Community','title'=>'最新发布','app_id'=>BaseApp::COMMUNITY));?>
        <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::COMMUNITY,'res_id'=>71,'type'=>1,'width'=>312));?>   
   </div>
</div>
 <?php $this->widget('ext.oauth.oauthLogin',array('itemView'=>'medium_login','back_url'=>Yii::app()->homeUrl));?>
    <style>
        .auth-login-yii{display:none;}
     </style>

    