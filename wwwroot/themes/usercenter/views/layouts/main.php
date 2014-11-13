<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php 
    $js = Yii::app()->getClientScript();
    $js->registerCoreScript('jquery');
    $js->registerCssFile('/css/common.css','all');
    $js->registerCssFile(Yii::app()->theme->baseUrl.'/css/common.css','all');
    $js->registerScriptFile(Yii::app()->theme->baseUrl.'/js/common.js');
?>
</head>
<body class="bg">
<div class="ui-background"></div>
<?php  $this->renderPartial('webroot.themes.usercenter.public.header');?>
<div class='main main_1'>
<?php $this->widget('ext.yiiwidget.XCBreadcrumbs', array(
    'htmlOptions'=>array('class'=>'nav_link'),
    'homeLink'=>CHtml::link('乐荟首页','/site'),
    'links'=>$this->breadcrumbs,            
    ));
?>
    <?php  $this->renderPartial('webroot.themes.usercenter.public.sidebar');?>
<?php echo $content; ?>
</div>
<?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'footer');?> 

</body>
</html>