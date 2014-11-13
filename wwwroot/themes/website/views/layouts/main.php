<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="baidu-site-verification" content="RGOnShNgCPxaKcH6" />


<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php 
    $js = Yii::app()->getClientScript();
    $js->registerScriptFile(Yii::app()->theme->baseUrl.'/js/index.js');
    $js->registerScriptFile(Yii::app()->theme->baseUrl.'/js/ad.js');
    $js->registerCssFile('/css/common.css');
?>
</head>
<body class="bg">
<?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'header');?>
<?php echo $content; ?>
<?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'footer');?>
</body>
</html>
