
       <!--头部标签样式  -->
    <div class="header">
        <div class="shopCo">
            <div class="logo">
                <a href="/"><img src="/images/shop/logo.jpg" alt="乐荟LOGO"/></a>
                <div class="city"><h3>广州</h3><a hre="/">[切换城市]</a></div>
            </div>
            <div class="headerBox">
                <div class="siteNav">
                    <div class="sn_login">
                        您好，欢迎来到乐荟！
                        <?php if(Yii::app()->user->isGuest):?>
                                <a href="http://www.lfeel.cn" id="login" class="login text-center font-while block login_top" target="_blank">登录</a>     
                        <?php else:?>
                                <?php echo CHtml::link('退出',$this->createUrl('/site/logout'),array('class'=>'login text-center font-while block login_to'));?>
                        <?php endif;?>
                        [<a href="http://quanzi.lfeel.com/member.php?mod=register" class="red" target="_blank">免费注册</a>] </div> 
                    <div class="sn-quick-menu">
                        <a href="/">我的订单</a>|
                        <a href="/">我的收藏</a>|
                        <a href="/">客户服务</a>|
                        <a href="/">乐荟网</a>
                    </div>
                </div>
                <div class="tip globe_bg fs">微博账号可直接登录</div>
                <div class="shopSearch">
                     <?php echo CHtml::form('/search/index','GET',array('id'=>'search'));?>
                    <div class="search" >
                        <span class="globe_bg"></span><input type="text" value="全场满198元免邮" class="searchBox " name="q"/>
                        <?php echo CHtml::submitButton('搜索',array('class'=>'btn')); ?>
                    </div>
                     <?php echo CHtml::endForm();?>
                    <a class="myLfeel" href="/"><i class="globe_bg"></i><em class="globe_bg"></em>我的乐荟</a>
                    <a class="cart" href="/"><b class="globe_bg">0</b><i class="globe_bg"></i><em class="globe_bg"></em>去购物车结算</a>
                </div>
                <div class="hotsearch">
                    <p> 热门搜索：
                        <?php foreach(Tags::getSearchHot('3') as $key):?>
                            <?php echo CHtml::link($key['name'],$this->createUrl('/search/index',array('q'=>$key['name'])));?>
                        <?php endforeach;?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="nav">
        <div class="shopCo">
            <em class="globe_bg"><a href="/"></a></em>
             <h2 class="categoryHd"><em class="globe_bg left"></em>全部商品分类</h2>
            <ul class="navMenu">
                <li><a href="/">首页</a></li>
                 <?php foreach(Category::getPar('138') as $v):?>
                <li><a href="<?php echo $this->createUrl('/shop/list/category',array('id'=>$v['id']));?>" target="_blank" alt="<?php echo CHtml::encode($v['name']);?>"><?php echo CHtml::encode($v['name']);?></a></li>
                <?php endforeach;?>
            </ul>
        </div> 
    </div>