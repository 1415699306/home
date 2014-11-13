<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="keyword" />
<meta name="Description" content="discription" />
<title>乐荟网_中国领先的企业家门户平台</title>
</head>
<body>
<?php
Yii::app()->theme = null;
?>
<div class="main">
    <div class="code">
        <h2><?php echo $code; ?></h2>
        <p><?php echo CHtml::encode($message); ?></p>
    </div>
    <div class="link">
        <p class="site"><a href="/site/index"><i></i></a></p>
        <ul>
            <li><?php echo CHtml::link('奢生活',$this->createUrl('/life'));?><em>|</em></li>
            <li><?php echo CHtml::link('政企通',$this->createUrl('/investment'));?><em>|</em></li>
            <li><?php echo CHtml::link('名人绘',$this->createUrl('/celebrity'));?><em>|</em></li>
            <li><?php echo CHtml::link('乐荟圈','http://quanzi.lfeel.com/');?><em>|</em></li>
            <li><?php echo CHtml::link('公益行',$this->createUrl('/community'));?><em>|</em></li>
            <li><?php echo CHtml::link('乐荟社','###');?></li>
        </ul>
        <ul class="btn">
            <li><?php echo CHtml::link('品牌购','http://shop.lfeel.com/');?><em>|</em></li>
            <li><?php echo CHtml::link('商机汇',$this->createUrl('/trade'));?><em>|</em></li>
            <li><?php echo CHtml::link('慧学习',$this->createUrl('/study'));?><em>|</em></li>
            <li><?php echo CHtml::link('乐聚会',$this->createUrl('/meet'));?><em>|</em></li>
            <li><?php echo CHtml::link('梦想秀',$this->createUrl('/dream'));?><em>|</em></li>
            <li><?php echo CHtml::link('手机版','###');?></li>
        </ul>
    </div>
</div>
</body>
</html>
<style>
body{background: #ececec;margin: 0;padding: 0;}
.main {clear: both;overflow: hidden;background: url('/images/error/bar.png') repeat-x;height: 100%;background-position: 0 100px;}
.main .code, .main .link{background: url('/images/error/background.png') no-repeat;}
.main .code{width: 669px;height: 370px;margin:50px auto;}
.main .code h2{font-size: 160px;color: #cc2b2b; font-weight: bold;margin: 0;text-indent: 1em;font-family: arial black;}
.main .code p{float: left;margin: 20px 0px 0 145px!important;margin: 20px 0px 0 75px;font-size: 25px;color: #cc2b2b;font-weight: bold;}
.main .link{width: 669px;height: 330px;margin:20px auto;background-position: 0 -370px;position: relative;z-index: 100;}
.main .link p.site{position: absolute;z-index: 150;top:60px;left:150px;}
.main .link p.site i{width: 220px;height: 60px;float: left;}
.main .link ul{position: absolute;z-index: 150;top: 195px!important;top:205px;left: 100px;width: 433px;font-weight: bold;font-size: 14px;}
.main .link ul.btn{position: absolute;z-index: 150;top: 225px!important;top:235px;left: 100px;width: 433px;}
.main .link ul li{list-style: none;float: left;}
.main .link ul li em{padding:0 9px!important;padding:0 11px;font-style: normal; vertical-align: middle;}
.main .link ul li a{color: #000;text-decoration: none;}
</style>
