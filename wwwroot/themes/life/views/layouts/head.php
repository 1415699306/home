<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php 
    $js = Yii::app()->getClientScript();
    $js->registerCoreScript('jquery');
    $js->registerCssFile(Yii::app()->theme->baseUrl.'/css/basic.css');
?>
</head>
<body class="bg">
<div class="stick">
	<div class="wrap max-width">
    	<div class="wrap-right">
            <?php if(Yii::app()->user->isGuest):?>
                <?php echo CHtml::link('登录',$this->createUrl('/site/login'),array('class'=>'login text-center font-while block'))?>
            <?php else:?>
            <?php echo CHtml::link(Yii::app()->user->name,'#',array('class'=>'login text-center font-while block'))?>
            <?php endif;?>
            <a href="#" class="message iconpng"></a>
            <a href="#" class="personal iconpng"></a>
        </div>
    	<!--<div class="wrap-left"><a href="#" class="set-index">设为首页</a>
            <a href="#">加到桌面</a>
        </div>-->
    </div>	
</div>
<div class="top_nav">
	<ul class="nav_list">
    	<h3>LOGO</h3>
    	<li class="home"><img src="<?php echo  Yii::app()->theme->baseurl.'/images/home.gif'?>" alt=""/><a href="/site">首页</a></li>
    	    <!--二级导航-->
            <?php $this->widget('ext.widgets.navlevel.INavLevel',array('type'=>1));?>
    </ul>
</div>
    <?php echo $content; ?>
</body>
</html>