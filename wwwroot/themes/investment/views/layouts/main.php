<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php $js = Yii::app()->clientScript;$js->registerCoreScript('jquery');$js->registerScriptFile('/js/fancy/jquery.fancybox.js');$js->registerCssFile('/js/fancy/jquery.fancybox.css');$js->registerCssFile('/css/common.css');$js->registerCssFile(Yii::app()->theme->baseUrl.'/css/investment.css');?>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="language" content="zh_CN" />
</head>
<body class="bg">
    <?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'header');?>
<div class="investment">
        <div class="warp">
            <?php echo $content;?>
        </div>      
    </div>
    <?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'footer');?>
</body>
</html>

<style>
.investment .league .content ul li{float: left;margin:0;width: auto!important;width:177px;padding:6px;}
.investment .league .content ul li img{border: 1px solid #ccc;}

</style>