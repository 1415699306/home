<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php $js = Yii::app()->getClientScript(); $js->registerCoreScript('jquery'); $js->registerCssFile('/css/common.css');?>
<?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'header');?>
<?php $js = Yii::app()->clientScript;$js->registerCssFile('/css/view.css');$js->registerScriptFile('/js/fancy/jquery.fancybox.js');$js->registerCssFile('/js/fancy/jquery.fancybox.css');
$this->breadcrumbs=array(
    '商品'=>Yii::app()->createUrl($this->module->id),
    $model->title,
);
?>

<div class="main">
<div class="news_left">
	<div class="news_top">
    	<div class="title">
        	<h1><?php echo CHtml::encode($model->title);?></h1>
            <?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'public_top_list');?>
            <div class="new_content"><?php echo Helper::truncate_utf8(CHtml::encode($model['content']),50);?></div>
            <?php $this->widget('ext.widgets.listpage.IListPage',array('model'=>$model));?>
        </div>
    </div> 
<?php $this->widget('ext.widgets.countupload.ICountUpload',array('app_id'=>BaseApp::SHOP,'res_id'=>$model['id']));?>
<div class="Comment">
<div class="Comment_title"><span></span>网友评论：<i><?php echo PublicComment::getCommantCount(Yii::app()->request->getParam('id'),BaseApp::SHOP);?></i> 人参与评论</div>
    <?php $this->widget('ext.widgets.publicComment.IPbulicCommant',array('id'=>$model->id,'app_id'=>BaseApp::SHOP));?>
 </div>                     
</div>
<div class="content_right">
        <div class="content news"><h3><em>最新发布</em></h3>
            <?php foreach($right as $k=>$v):?>
            <ul>
                <li><span><?php echo ($k+1);?></span><?php echo CHtml::link(CHtml::encode($v->title),$this->createUrl('/shop/list/view',array('id'=>$v->id)));?></li>
            </ul>
            <?php endforeach;?>
        </div>
        <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::TRADE,'res_id'=>70,'type'=>1,'width'=>312));?>
   </div>
</div>
<?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'footer');?>
