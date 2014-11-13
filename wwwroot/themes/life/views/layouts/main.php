<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php 
    $js = Yii::app()->getClientScript();
    $js->registerCoreScript('jquery');
    $js->registerCssFile('/css/common.css');
?>
</head>
<body class="bg">
<?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'header');?>
<?php $this->widget('ext.yiiwidget.XCBreadcrumbs', array(
    'htmlOptions'=>array('class'=>'nav_link'),
    'homeLink'=>CHtml::link('乐荟首页',Yii::app()->createUrl('/site')),
    'links'=>$this->breadcrumbs,            
    ));
?>
<?php echo $content; ?>
<?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'footer');?>
</body>
</html>
