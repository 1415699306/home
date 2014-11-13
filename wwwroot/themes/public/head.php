<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>
<body class="bg">
<div class="stick">
	<div class="wrap max-width">
    	<div class="wrap-right">
            <?php if(Yii::app()->user->isGuest):?>
                <a href="http://quanzi.lfeel.com" class="login text-center font-while block" target="_blank">登录</a>
            <?php else:?>
                <?php echo CHtml::link('退出',$this->createUrl('/site/logout'),array('class'=>'login text-center font-while block'));?>
            <?php endif;?>
             <a href="http://quanzi.lfeel.com/member.php?mod=register" class="message iconpng" target="_blank"></a>
        </div>
    </div>	
</div>
<div class="top_nav">
	<ul class="nav_list">
    	<h3>LOGO</h3>
    	<li class="home"><img src="/images/search/home.gif" alt=""/><a href="/site">首页</a></li>
    	<li class="home"><a href="/life.html" target="_blank">奢生活</a></li>
        <li class="home"><a href="/investment/list.html" target="_blank">政企通</a></li>
        <li class="home"><a href="http://quanzi.lfeel.com/member.php?mod=logging&action=login" target="_blank">乐聚会</a></li>
        <li class="home"><a href="http://shop.lfeel.com/" target="_blank">品牌购</a></li>
        <li class="home"><a href="/site/login" target="_blank">乐荟圈</a></li>
        <li class="home"><a href="/trade.html" target="_blank">商机汇</a></li>
        <li class="home"><a href="/study.html" target="_blank">慧学习</a></li>
        <li class="home"><a href="/celebrity.html" target="_blank">名人绘</a></li>
        <li class="home"><a href="/community.html" target="_blank">公益行</a></li>
        <li class="home"><a href="/site/login" target="_blank">梦想秀</a></li>
        <li class="home"><a href="/site/login" target="_blank">乐荟社</a></li>
    </ul>
</div>