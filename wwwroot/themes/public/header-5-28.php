<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>乐荟网_中国领先的企业家门户平台</title>
<link rel="stylesheet" href="../css/basic.css" type="text/css" />
<script type="text/jscript">
    function box1(i)
    {
      for(j=1;j<10;j++)  
        {
      if(i==j){
       document.getElementById("box1_b"+j).style.display="";
              }
       else
        {
       document.getElementById("box1_b"+j).style.display="none";
          }
         }

    }
    
    
     function box2(i)
    {
      for(j=1;j<10;j++)  
        {
      if(i==j){
       document.getElementById("box2_b"+j).style.display="";
              }
       else
        {
       document.getElementById("box2_b"+j).style.display="none";
          }
         }

    }
</script>
</head>
<body>
<div class='minnav'>
	<div class='minnavInner'>
    	<div class='minnavLeft'>
            <!--
        	<a href="#" class='home'>设为首页</a>
            <a href="#" class='desk'>加到桌面</a>
            -->
        </div>
        <div class='minnavRight'>
            <?php if(Yii::app()->user->isGuest):?>
        	<a href="http://quanzi.lfeel.com" class='login' target="_blank">登录</a>
            <?php else:?>
            <?php echo CHtml::link('退出',$this->createUrl('/site/logout'),array('class'=>'login'));?>
            <?php endif;?> 
            <a href="http://quanzi.lfeel.com/member.php?mod=register" class='member'>我是成为会员</a>
        	<span>尊贵热线：400-840-6688</span>
        </div>
    </div>
</div>
<div class='head'>
	<div class='headLogo'><img src="../images/image/logo.png" alt="" /></div>
    <div class='headRight'>
        <!--
    	<div class='search'>
       		<div class='select'>网页</div>
            <input type="text" value="请输入关键字" class="checkbox" />
            <input type="submit" value="搜索" class="searchbtn" />
        </div>
        <div class='hotsearch'>
        	<span>热门搜索：</span>
            <a href="#">招商深证TMT50</a>
            <a href="#">长盛电子信息产业</a>
            <a href="#">上投摩根新兴动力</a>
            <a href="#">泰达宏利市值</a>
        </div>
    	-->
    </div>
    <!--<div class='headRight'>
    	<div class='search'>
        	<div class="left iconpng">
                	<div class="active">网页</div>
                </div>
            <div class="mid iconpng">
                	<div class="icon iconpng"></div>
                    <input type="text" value="请输入关键词"/>
                </div>
                <div class="right iconpng">搜索</div>
        </div>
    	<div class="hot-search">
            	<h2>热门搜索：</h2>
                <ul class="list">
                	<li><a href="#">昌盛电子信息产业</a></li>
                    <li><a href="#">昌盛电子信息产业</a></li>
                    <li><a href="#">昌盛电子信息产业</a></li>
                    <li><a href="#">昌盛电业</a></li>
                </ul>
            </div>
    
    </div>-->
</div>

<!--首页导航栏-->
<div class='nav'>
    <div class='nav_list'>
        <h3></h3>
        <div class='nav_demo'>
           <ul class='nav_left'>
               <li><b><?php echo CHtml::link('奢生活',$this->createUrl('/life'));?></b></li>
               <li><?php echo CHtml::link('座驾',$this->createUrl('/life/list/category',array('id'=>29)));?></li>
               <li><?php echo CHtml::link('珠宝',$this->createUrl('/life/list/category',array('id'=>28)));?></li>
               <li><b><?php echo CHtml::link('品牌购','http://shop.lfeel.com/',array('target'=>'_blank'));?></b></li>
               <li><?php echo CHtml::link('名品','http://shop.lfeel.com/index.php?act=famous&nav_id=11',array('target'=>'_blank'));?></li>
               <li><?php echo CHtml::link('荟团','http://shop.lfeel.com/index.php?act=show_groupbuy',array('target'=>'_blank'));?></li>
           </ul>
       </div>
       <em></em>
    </div>
    <div class='nav_list'>
        <em></em>
         <h3 class='investment'></h3>
         <div class='nav_demo'>
            <ul class='nav_left'>
               <li><b><?php echo CHtml::link('政企通',$this->createUrl('/investment/list'));?></b></li>
                <li><?php echo CHtml::link('工业',$this->createUrl('/investment/list/category',array('id'=>21)));?></li>
                <li><?php echo CHtml::link('园区',$this->createUrl('/investment/list/category',array('id'=>25)));?></li>
                <li><b><?php echo CHtml::link('商机汇',$this->createUrl('/trade'));?></b></li>
                <li><?php echo CHtml::link('投资',$this->createUrl('/trade/list/category',array('id'=>65)));?></li>
                <li><?php echo CHtml::link('招商',$this->createUrl('/trade/list/category',array('id'=>64)));?></li>
            </ul>
        </div>               
    </div>
    <div class='nav_list'>
        <em></em>
        <h3 class="celebrity"></h3>
        <div class='nav_demo'>
           <ul class='nav_left'>
               <li><b><?php echo CHtml::link('名人绘',$this->createUrl('/celebrity'));?></b></li>
               <li><?php echo CHtml::link('语录',$this->createUrl('/celebrity/list/category',array('id'=>59)));?></li>
               <li><?php echo CHtml::link('人物',$this->createUrl('/celebrity/list/category',array('id'=>57)));?></li>
               <li><b><?php echo CHtml::link('慧学习',$this->createUrl('/study'));?></b></li>
               <li><?php echo CHtml::link('课程',$this->createUrl('/study/list/category',array('id'=>87)));?></li>
               <li><?php echo CHtml::link('海外',$this->createUrl('/study/list/category',array('id'=>90)));?></li>
           </ul>
       </div>
    </div>
    <div class='nav_list'>
        <em></em>
        <h3 class='interactive'></h3>
        <div class='nav_demo'>
           <ul class='nav_left'>
               <li><b><a href="/site/login" target="_blank">乐荟圈</a></b></li>
                   <li><a href="/site/login"target="_blank">圈子</a></li>
                   <li><a href="/site/login"target="_blank">活动</a></li>
                   <li><b><a href="/site/login"target="_blank">乐聚会</a></b></li>
                   <li><a href="/site/login"target="_blank">交流</a></li>
                   <li><a href="/site/login"target="_blank">聚会</a></li>
           </ul>
       </div>
    </div>
    <div class='nav_list'>
        <em></em>
        <h3 class='transfer'></h3>
        <div class='nav_demo'>
           <ul class='nav_left'>
                   <li><b><?php echo CHtml::link('公益行',$this->createUrl('/community'));?></b></li>
                   <li><?php echo CHtml::link('资讯',$this->createUrl('/community/list/category',array('id'=>74)));?></li>
                   <li><?php echo CHtml::link('求助',$this->createUrl('/community/list/category',array('id'=>83)));?></li>
                   <li><b><?php echo CHtml::link('公益行',$this->createUrl('/dream'));?></b></li>
                   <li><a href="/site/login"target="_blank">科技</a></li>
                   <li><a href="/site/login"target="_blank">旅行</a></li>
           </ul>
       </div>
    </div>
    <div class='nav_list nav_right'>
        <ul class='nav_left nav_right'>
            <li><b><a href="/site/login"target="_blank">乐荟社</a></b></li><br />
            <li><b><a href="/site/login"target="_blank">手机版</a></b></li>
        </ul>
    </div>
</div>