<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle);?></title>
<?php
$js = Yii::app()->getClientScript();$js->registerCoreScript('jquery');
?>
</head>
<body>
<div class="wrap">
    <div class="header">
        <h2><?php echo CHtml::link(CHtml::image('/images/login/logo.jpg','首页'),$this->createUrl('/site'))?></h2>
        <span>服务电话：400-840-6688</span>
    </div>
    <div class="main">
        <?php echo $content; ?>
    </div> 
</div> 
    <div class="footer">
        <div class="footer_list">
                <li class="pic1"></li>
                <li class="pic2"></li>
                <li class="pic3"></li>
                <li class="pic4"></li>
                <li class="pic5"></li>
                <li class="pic6"></li>
        </div>
       <div class="link"><a href="/site">网站首页</a><a href="/html/view/id/temp_27">网站介绍</a><a href="/html/view/id/temp_31">隐私政策</a><a href="/html/view/id/temp_28">联系我们</a></div>
      <p style="color:#717171;font-size:12px;">版权声明：所有图片均受著作权保护，未经许可不得使用，不得转载、摘编。  广州乐荟网络科技有限公司版权所有 @ 2005-2013  粤ICP备13024867号</p>
    </div>
</body>
</html>