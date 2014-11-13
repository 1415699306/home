<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/base.css');?>
<?php if($this->beginCache('cacheName',array('duration'=>3600))){?>
    <div class="content">
        <div class="slide">
            <ul class="Slide-con">
                <li id="box3_b0" style="width:1663px;height: 400px;background: url(/images/shop/ind_01.jpg) no-repeat;">
                    <div class="shopCo">
                        <a href="http://shop.lfeel.com/index.php?act=show_store&id=16"target="_blank"><img src="/images/shop/ind_01_1.jpg" /></a>
                    </div>
                </li>
                <li id="box3_b1" style="width:1663px;height: 400px;background: url(/images/shop/ind_02.jpg) no-repeat;display:none">
                    <div class="shopCo">
                        <a href="http://shop.lfeel.com/index.php?act=goods&goods_id=143"target="_blank"><img src="/images/shop/ind_02_1.jpg" /></a>
                    </div>
                </li>
                <li id="box3_b2" style="width:1663px;height: 400px;background: url(/images/shop/ind_03.jpg) no-repeat;display:none">
                    <div class="shopCo">
                        <a href="http://shop.lfeel.com/index.php?act=show_store&op=goods_all&id=15"target="_blank"><img src="/images/shop/ind_03_1.jpg" /></a>
                    </div>
                </li>
                <li id="box3_b3" style="width:1663px;height: 400px;background: url(/images/shop/ind_04.jpg) no-repeat;display:none">
                    <div class="shopCo">
                        <a href="http://shop.lfeel.com/index.php?act=show_store&id=17"target="_blank"><img src="/images/shop/ind_04_1.jpg" /></a>
                    </div>
                </li>
                <li id="box3_b4" style="width:1663px;height: 400px;background: url(/images/shop/ind_05.jpg) no-repeat;display:none">
                    <div class="shopCo">
                        <a href="http://shop.lfeel.com/index.php?act=goods&goods_id=126" target="_blank"><img src="/images/shop/ind_05_1.jpg" /></a>
                    </div>
                </li>
           </ul>
            <ul class="Slide-nav" id="slidenav">
                <li class="on" id="box3_a0"  onmousemove="box3(0)"><em class="globe_bg">1</em></li>
                <li id="box3_a1"  onmousemove="box3(1);"><em class="globe_bg">2</em></li>
                <li id="box3_a2"  onmousemove="box3(2);"><em class="globe_bg">3</em></li>
                <li id="box3_a3"  onmousemove="box3(3);"><em class="globe_bg">4</em></li>
                <li id="box3_a4"  onmousemove="box3(4);"><em class="globe_bg">5</em></li>
            </ul>
        </div>
        <div class="shopMain shopCo">
                <div class="shopLeft">
                    <!--产品分类 -->
                    
                    <div class="category">
                        <div class="menu"> 
                            <ul>
                                <?php $i=1;?>
                                    <?php foreach($category as $key=>$val):?>
                                <li class="item_<?php echo $key;?>">
                                    <em class="globe_bg"></em>
                                    <h3><i class="globe_bg"></i><?php echo CHtml::encode($val['name']);?></h3>
                                    <p>
                                      <?php $model = Category::getPar($val['id']);?>
                                    <?php foreach($model as $key):?>
                                        <a href="<?php echo $this->createUrl('/shop/list/category',array('id'=>$val['id']));?>" target="_blank"><?php echo CHtml::encode($key['name']);?></a>
                                        <?php endforeach;?>
                                    </p>
                                </li>
                                  <?php ++$i;?>
                            <?php endforeach;?> 
                            </ul>
                        </div>
                    </div>
                    <div class="menuTip">
                        <ul>
                            <li>品酒会</li>
                            <li>积分商城</li>
                            <li>促销活动</li>
                            <li>季度精选</li>
                        </ul>
                    </div>
                    <div class="leftAd"><img src="/images/shop/ind_05_.jpg"/></div>
                    <div class="news">
                        <div class="news_nav">
                            <ul>
                                <li class="current" id="tab_1" onclick="switchTab(1)"><a>最新公告</a></li>
                                 <li id="tab_2" onclick="switchTab(2)"><a>过期公告</a></li>
                            </ul>
                        </div>
                        <div class="news_Content">
                            <ul id="tab_con_1">
                                <?php foreach(Announcement::getList('0') as $val):?>
                              <li class="globe_bg"><a href="/shop/list/detail/id/<?php echo $val['id'];?>"><?php echo CHtml::encode($val['title']);?></a></li>
                                <?php endforeach;?>
                            </ul>
                            <ul id="tab_con_2">
                                <?php foreach(Announcement::getExpire('0') as $val):?>
                              <li class="globe_bg"><a href="/shop/list/detail/id/<?php echo $val['id'];?>"><?php echo CHtml::encode($val['title']);?></a></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            
            <div class="shopRight">
                <ul>
                    <li>
                        <div class="cutdown">
                            <p>还剩<span id="hour"></span>小时<span id="minute"></span>分<span id="second"></span>秒</p>
                        </div>
                        <a href="http://shop.lfeel.com/index.php?act=goods&goods_id=145"target="_blank"><img src="/images/shop/ind_06.jpg"/></a>
                        <div class="Details">
                            <p>Apple/苹果公司 夏日新品女包</p>
                            <p><em>抢购价：</em><i>￥</i><span>488</span><i>.00</i></p>
                        </div>
                    </li>
                    <li>
                        <div class="cutdown">
                            <p>还剩<span id="hour2"></span>小时<span id="minute2"></span>分<span id="second2"></span>秒</p>
                        </div>
                        <a href="http://shop.lfeel.com/index.php?act=goods&goods_id=164"target="_blank"><img src="/images/shop/ind_07.jpg"/></a>
                        <div class="Details">
                            <p>蒙顶山红芽</p>
                            <p><em>抢购价：</em><i>￥</i><span>3580</span><i>.00</i></p>
                        </div>
                    </li>
                    <li>
                        <div class="cutdown">
                            <p>还剩<span id="hour3"></span>小时<span id="minute3"></span>分<span id="second3"></span>秒</p>
                        </div>
                        <a href="http://shop.lfeel.com/index.php?act=goods&goods_id=45"target="_blank"><img src="/images/shop/ind_08.jpg"/></a>
                        <div class="Details">
                            <p>Apple/苹果公司 2013新款 商务包</p>
                            <p><em>抢购价：</em><i>￥</i><span>1588</span><i>.00</i></p>
                        </div>
                    </li>
                    <li class="last">
                        <div class="cutdown">
                            <p>还剩<span id="hour4"></span>小时<span id="minute4"></span>分<span id="second4"></span>秒</p>
                        </div>
                        <a href="http://shop.lfeel.com/index.php?act=goods&goods_id=52"target="_blank"><img src="/images/shop/ind_09.jpg"/></a>
                        <div class="Details">
                            <p>Apple苹果 2013新款时尚女士单肩包</p>
                            <p><em>抢购价：</em><i>￥</i><span>638</span><i>.00</i></p>
                        </div>
                    </li>
                </ul>
            </div>
            
        </div>
        <div class="shopCo">
            <div class="active">
                <div class="title"><span>您可能感兴趣的品牌活动</span></div>
                <div class="active_list">
                    <ul>
                        <li>
                            <a href="http://shop.lfeel.com/index.php?act=show_store&id=1"target="_blank"><img src="/images/shop/ind_26.jpg"/></a>
                            <p>苹果箱包隆重上线<br/><a href="http://shop.lfeel.com/index.php?act=show_store&id=1"target="_blank">点击查看》</a></p>
                            <h2><img src="/images/shop/ind_25.jpg"/></h2>
                        </li>
                        <li class="last">
                            <a href="http://shop.lfeel.com/index.php?act=goods&goods_id=167"target="_blank"><img src="/images/shop/ind_27.jpg"/></a>
                            <p>蒙顶山上茶新款推出<br/><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=167"target="_blank">点击查看》</a></p>
                            <h2><img src="/images/shop/ind_90.jpg"/></h2>
                        </li>
                        <li>
                            <a href="http://shop.lfeel.com/index.php?act=goods&goods_id=121 target="_blank""><img src="/images/shop/ind_28.jpg"/></a>
                            <p>白葡萄酒尊贵上市<br/><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=121" target="_blank">点击查看》</a></p>
                            <h2><img src="/images/shop/ind_91.jpg"/></h2>
                        </li>
                        <li class="last">
                            <a href="http://shop.lfeel.com/index.php?act=show_store&id=9" target="_blank"><img src="/images/shop/ind_29.jpg"/></a>
                            <p>摩尔斯密码新品体验<br/><a href="http://shop.lfeel.com/index.php?act=show_store&id=9" target="_blank">点击查看》</a></p>
                            <h2><img src="/images/shop/ind_92.jpg"/></h2>
                        </li>
                    </ul>
                </div>
                <div class="brand">
                    <ul>
                        <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=9" target="_blank"><img src="/images/shop/ind_94.jpg"/></a></li>
                        <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=6" target="_blank"><img src="/images/shop/ind_95.jpg"/></a></li>
                        <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=17" target="_blank"><img src="/images/shop/ind_96.jpg"/></a></li>
                        <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=16" target="_blank"><img src="/images/shop/ind_97.jpg"/></a></li>
                        <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=15" target="_blank"><img src="/images/shop/ind_98.jpg"/></a></li>
                        <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=11" target="_blank"><img src="/images/shop/ind_99.jpg"/></a></li>
                        <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=1" target="_blank"><img src="/images/shop/ind_100.jpg"/></a></li>
                        <li class="last"><a href="http://shop.lfeel.com/index.php?act=show_store&id=19" target="_blank"><img src="/images/shop/ind_101.jpg"/></a></li>
                    </ul>
                </div>
            </div>
        </div>
        
       
        <div class="floor">
            <div class="floorTop">
                <h3>购物</h3>
                <em><a href="/shop/list/category/143.html"target="_blank"><span>></span>全部商品</a></em>
                    <ul class="floorTop-nav">
                        <li><a href="/shop/list/category/143.html"target="_blank">服装</a></li>
                        <li><a href="/shop/list/category/143.html"target="_blank">鞋类/箱包</a></li>
                        <li><a href="/shop/list/category/143.html"target="_blank">珠宝</a></li>
                        <li><a href="/shop/list/category/143.html"target="_blank">家居百货</a></li>
                        <li><a href="/shop/list/category/143.html"target="_blank">家纺</a></li>
                        <li><a href="/shop/list/category/143.html"target="_blank">电器/数码</a></li>
                    </ul>
            </div>
            <div class="floorCo">
                <div class="floorTab">
                    <div class="floor_logo">
                        <ul>
                            <li><img src="/images/shop/ind__112.jpg"/></li>
                            <li class="logoR"><img src="/images/shop/ind__113.jpg"/></li>
                            <li><img src="/images/shop/ind__114.jpg"/></li>
                            <li class="logoR"><img src="/images/shop/ind__115.jpg"/></li>
                            <li><img src="/images/shop/ind__116.jpg"/></li>
                            <li class="logoR"><img src="/images/shop/ind__117.jpg"/></li>
                            <li><img src="/images/shop/ind__118.jpg"/></li>
                            <li class="logoR"><img src="/images/shop/ind__119.jpg"/></li>
                            <li><img src="/images/shop/ind__120.jpg"/></li>
                            <li class="logoR"><img src="/images/shop/ind__121.jpg"/></li>
                        </ul>
                    </div>
                    <div class="floor_slide" id="J-Slide">
                        <ul class="Slide-con">
                            <?php foreach (Slide::getSlide('16', '180', '0', '6') as $val):?>       
                            <li><a href="<?php echo $val['link']?>"><img src="<?php echo Storage::getImageBySize($val['track_id'],'slide','','thumb',array('width'=>760,'height'=>250));?>" alt="<?php echo $val['name'];?>" /></a></li>
                            <?php endforeach;?>
                            
                         </ul>
                         <ul class="Slide-nav">
                            <li class="on"><em class="globe_bg">1</em></li>
                            <li><em class="globe_bg">2</em></li>
                            <li><em class="globe_bg">3</em></li>
                            <li><em class="globe_bg">4</em></li>
                            <li><em class="globe_bg">5</em></li>
                            <li><em class="globe_bg">6</em></li>
                         </ul>
                    </div>
                    <div class="product">
                        <ul class="productList">
                            <li><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=52"target="_blank"><img src="/images/shop/ind_42.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>新款欧美时尚女士单肩包</h3>
                                        <p>永不褪色的经典</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=1"target="_blank"><img src="/images/shop/ind_43.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>苹果男士皮包</h3>
                                        <p>成功的典范 男士的魅力</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=86"target="_blank"><img src="/images/shop/ind_44.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>圆领拼色文艺范长裙</h3>
                                        <p>文艺范的气质美裙</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=143"target="_blank"><img src="/images/shop/ind_45.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>结构拼色真丝长上衣</h3>
                                        <p>设计感十足 个性不夸张</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=100"target="_blank"><img src="/images/shop/ind_47.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>西藏那曲虫草</h3>
                                        <p>凸显尊贵，商务送礼必备首选</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=82"target="_blank"><img src="/images/shop/ind_48.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>屯河金响开心果</h3>
                                        <p>健康的明智选择</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=138"target="_blank"><img src="/images/shop/ind_49.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>艾思特城堡干红葡萄酒</h3>
                                        <p>口感丰满 回味持久</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=183"target="_blank"><img src="/images/shop/ind_70.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>蒙顶山精选甘露</h3>
                                        <p>留给你的一叶清香</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="sidebar">
                    <div class="sidebar_adv">
                        <a href="http://shop.lfeel.com/"target="_blank"><img src="/images/shop/ind_39.jpg"/></a><a href="http://shop.lfeel.com/index.php?act=boutique&nav_id=12"target="_blank"><img src="/images/shop/ind_40.jpg"/></a>
                    </div>
                    <div class="ranking">
                        <span>一周销售排行榜</span>
                        <ul>
                            <li>
                                <div class="highlight">
                                    <a href="http://shop.lfeel.com/index.php?act=goods&goods_id=55"target="_blank" class="floatImg"><i class="globe_bg"></i><img src="/images/shop/ind_50.jpg"/></a>
                                    <div class="textFloat">
                                        <h3><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=55" target="_blank">新款欧美时尚女士单肩包</a></h3>
                                        <p>欧美大牌气质，优雅自信地展现出自我魅力</p>
                                    </div>
                                </div>
                            </li>
                            <li><em class="dark">2</em><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=83" target="_blank">结构拼色真丝衬衫</a></li>
                            <li><em class="dark">3</em><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=84" target="_blank">衬衫式真丝连衣裙</a></li>
                            <li><em class="dark">4</em><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=88" target="_blank">圈圈领淑女真丝上衣</a></li>
                            <li><em>5</em><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=89" target="_blank">宽松式套头真丝上衣</a></li>
                            <li><em>6</em><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=124" target="_blank">简约透纱长裙</a></li>
                            <li><em>7</em><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=142" target="_blank">花瓣门襟短外套</a></li>
                            <li><em>8</em><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=130" target="_blank">真丝欧根纱透视蕾丝连衣裙</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!--酒店 -->
         <div class="floor">
            <div class="floorTop">
                <h3>酒店</h3>
                <em><a href="/shop/list/category/139.html" target="_blank"><span>></span>全部休闲娱乐</a></em>
                    <ul class="floorTop-nav">
                        <li><a href="/shop/list/category/139.html" target="_blank">经济型酒店</a></li>
                        <li><a href="/shop/list/category/139.html"target="_blank">豪华酒店</a></li>
                        <li><a href="/shop/list/category/139.html"target="_blank">公寓式酒店</a></li>
                        <li><a href="/shop/list/category/139.html"target="_blank">主题酒店</a></li>
                        <li><a href="/shop/list/category/139.html"target="_blank">度假酒店</a></li>
                    </ul>
            </div>
            <div class="floorCo">
                <div class="floorTab">
                    <div class="floor_logo">
                        <ul>
                            <li><img src="/images/shop/ind__122.jpg"/></li>
                            <li class="logoR"><img src="/images/shop/ind__123.jpg"/></li>
                            <li><img src="/images/shop/ind__124.jpg"/></li>
                            <li class="logoR"><img src="/images/shop/ind__125.jpg"/></li>
                            <li><img src="/images/shop/ind__126.jpg"/></li>
                            <li class="logoR"><img src="/images/shop/ind__127.jpg"/></li>
                            <li><img src="/images/shop/ind__128.jpg"/></li>
                            <li class="logoR"><img src="/images/shop/ind__129.jpg"/></li>
                            <li><img src="/images/shop/ind__130.jpg"/></li>
                            <li class="logoR"><img src="/images/shop/ind__131.jpg"/></li>
                        </ul>
                    </div>
                    <div class="floor_slide"id="J-Slide2">
                        <ul class="Slide-con">
                            <?php foreach (Slide::getSlide('16', '181', '0', '6') as $val):?>       
                            <li><a href="<?php echo $val['link']?>"><img src="<?php echo Storage::getImageBySize($val['track_id'],'slide','','thumb',array('width'=>760,'height'=>250));?>" alt="<?php echo $val['name'];?>" /></a></li>
                            <?php endforeach;?>
                         </ul>
                         <ul class="Slide-nav">
                            <li class="on"><em class="globe_bg">1</em></li>
                            <li><em class="globe_bg">2</em></li>
                            <li><em class="globe_bg">3</em></li>
                            <li><em class="globe_bg">4</em></li>
                            <li><em class="globe_bg">5</em></li>
                            <li><em class="globe_bg">6</em></li>
                         </ul>
                    </div>
                    <div class="product">
                        <ul class="productList">
                            <li><a href="http://www.lfeel.com/life/list/view/1935.html"target="_blank"><img src="/images/shop/ind_501.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>SanSen豪宅</h3>
                                        <p>带给你秋高气爽的舒爽快意</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/1977.html"target="_blank"><img src="/images/shop/ind_51.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>英格兰白色别墅</h3>
                                        <p>优雅的乌托邦</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/1911.html"target="_blank"><img src="/images/shop/ind_52.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>雅居乐富春山居</h3>
                                        <p>引领广州豪宅新地标</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/1656.html"target="_blank"><img src="/images/shop/ind_53.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>纽约豪华公寓</h3>
                                        <p>创造了整体的建筑感受</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/1098.html"target="_blank"><img src="/images/shop/ind_54.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>香港超级豪宅</h3>
                                        <p>入则宁静、出则繁华</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/1060.html"target="_blank"><img src="/images/shop/ind_55.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>60层摩天住宅</h3>
                                        <p>浑然一体的艺术雕塑作品</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/1061.html"target="_blank"><img src="/images/shop/ind_56.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>1100 Millecento</h3>
                                        <p>意大利风情与都市现代化的完美结合</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/805.html"target="_blank"><img src="/images/shop/ind_57.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>波士顿“千禧名园”</h3>
                                        <p>一个崭新而充满活力的社区</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="sidebar">
                    <div class="sidebar_adv">
                        <a href="http://www.lfeel.com/life/list/view/1330.html"target="_blank"><img src="/images/shop/ind__111.jpg"/></a><a href="http://www.lfeel.com/life/list/view/1889.html"target="_blank"><img src="/images/shop/ind__111-19.jpg"/></a>
                    </div>
                    <div class="ranking">
                        <span>一周销售排行榜</span>
                        <ul>
                            <li>
                                <div class="highlight">
                                    <a href="http://www.lfeel.com/life/list/view/2057/2.html"target="_blank" class="floatImg"><i class="globe_bg"></i><img src="/images/shop/ind_79.jpg"/></a>
                                    <div class="textFloat">
                                        <h3><a href="http://www.lfeel.com/life/list/view/2057/2.html"target="_blank">Uchigami别墅</a></h3>
                                        <p>建筑与自然环境相融合，景色尽收眼底</p>
                                    </div>
                                </div>
                            </li>
                            <li><em class="dark">2</em>龙湾瑞吉度假酒店</li>
                            <li><em class="dark">3</em>半山半岛洲际度假酒店</li>
                            <li><em class="dark">4</em>外滩英迪格酒店</li>
                            <li><em>5</em>怡亨酒店</li>
                            <li><em>6</em>香港前水警总部酒店</li>
                            <li><em>7</em>广州海航威斯汀酒店</li>
                            <li><em>8</em>澳门银河酒店</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 美食 -->
        
         <div class="floor">
            <div class="floorTop">
                <h3>美食</h3>
                <em><a href="/shop/list/category/141.html"target="_blank"><span>></span>全部美食</a></em>
                    <ul class="floorTop-nav">
                        <li><a href="/shop/list/category/141.html"target="_blank">火锅</a></li>
                        <li><a href="/shop/list/category/141.html"target="_blank">川湘菜</a></li>
                        <li><a href="/shop/list/category/141.html"target="_blank">江浙菜</a></li>
                        <li><a href="/shop/list/category/141.html"target="_blank">粤港菜</a></li>
                        <li><a href="/shop/list/category/141.html"target="_blank">烧烤烤肉</a></li>
                        <li><a href="/shop/list/category/141.html"target="_blank">香锅烤鱼</a></li>
                        <li><a href="/shop/list/category/141.html"target="_blank">海鲜</a></li>
                        <li><a href="/shop/list/category/141.html"target="_blank">西北菜</a></li>
                        <li><a href="/shop/list/category/141.html"target="_blank">鲁菜/北京菜</a></li>
                        <li><a href="/shop/list/category/141.html"target="_blank">东北菜</a></li>
                    </ul>
            </div>
            <div class="floorCo">
                <div class="floorTab">
                    <div class="floor_logo">
                        <ul>
                            <li><img src="/images/shop/ind__132.jpg"/></li>
                            <li class="logoR"><img src="/images/shop/ind__133.jpg"/></li>
                            <li><img src="/images/shop/ind__134.jpg"/></li>
                            <li class="logoR"><img src="/images/shop/ind__135.jpg"/></li>
                            <li><img src="/images/shop/ind__136.jpg"/></li>
                            <li class="logoR"><img src="/images/shop/ind__137.jpg"/></li>
                            <li><img src="/images/shop/ind__138.jpg"/></li>
                            <li class="logoR"><img src="/images/shop/ind__139.jpg"/></li>
                            <li><img src="/images/shop/ind__140.jpg"/></li>
                            <li class="logoR"><img src="/images/shop/ind__141.jpg"/></li>
                        </ul>
                    </div>
                    <div class="floor_slide"id="J-Slide3">
                        <ul class="Slide-con">
                            <?php foreach (Slide::getSlide('16', '182', '0', '6') as $val):?>       
                            <li><a href="<?php echo $val['link']?>"><img src="<?php echo Storage::getImageBySize($val['track_id'],'slide','','thumb',array('width'=>760,'height'=>250));?>" alt="<?php echo $val['name'];?>" /></a></li>
                            <?php endforeach;?>
                         </ul>
                         <ul class="Slide-nav">
                            <li class="on"><em class="globe_bg">1</em></li>
                            <li><em class="globe_bg">2</em></li>
                            <li><em class="globe_bg">3</em></li>
                            <li><em class="globe_bg">4</em></li>
                            <li><em class="globe_bg">5</em></li>
                            <li><em class="globe_bg">6</em></li>
                         </ul>
                    </div>
                    <div class="product">
                        <ul class="productList">
                            <li><a href="http://www.lfeel.com/life/list/view/2047.html"target="_blank"><img src="/images/shop/ind_58.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>鲜美甲鱼汤</h3>
                                        <p>养阴凉血，补肾益肾</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/1875.html"target="_blank"><img src="/images/shop/ind_59.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>上海特色清凉美食</h3>
                                        <p>色香味俱全，打开好胃口</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/1486.html"target="_blank"><img src="/images/shop/ind_60.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>上海璞麗酒店</h3>
                                        <p>呈现全新味蕾享受</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/1442.html"target="_blank"><img src="/images/shop/ind_61.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>Finger Food</h3>
                                        <p>简单、美味，让人不拘束</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/1339.html"target="_blank"><img src="/images/shop/ind_62.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>永利澳门</h3>
                                        <p>为您的味蕾带来新冲击</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/1245.html"target="_blank"><img src="/images/shop/ind_71.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>酩悦香槟</h3>
                                        <p>粉红香槟明媚欢快、精致细腻</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/1101.html"target="_blank"><img src="/images/shop/ind_72.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>总汇三明治</h3>
                                        <p>融合美学及高级食材</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/764.html"target="_blank"><img src="/images/shop/ind_73.jpg"/>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3>英式鸡尾酒</h3>
                                        <p>释放舌尖上的热情</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="sidebar">
                    <div class="sidebar_adv">
                        <a href="http://www.lfeel.com/life/list/view/2066/2.html"target="_blank"><img src="/images/shop/ind_77.jpg"/></a><a href="http://www.lfeel.com/life/list/view/2055.html"target="_blank"><img src="/images/shop/ind_78.jpg"/></a>
                    </div>
                    <div class="ranking">
                        <span>一周销售排行榜</span>
                        <ul>
                            <li>
                                <div class="highlight">
                                    <a href="http://www.lfeel.com/life/list/view/1890.html" target="_blank" class="floatImg"><i class="globe_bg"></i><img src="/images/shop/ind_76.jpg"/></a>
                                    <div class="textFloat">
                                        <h3><a href="http://www.lfeel.com/life/list/view/1890.html"target="_blank">日本时令料理</a></h3>
                                        <p>以精致和时令著称，对于雅洁二字尤其讲究</p>
                                    </div>
                                </div>
                            </li>
                            <li><em class="dark">2</em>西班牙小馆La Yazmira</li>
                            <li><em class="dark">3</em>液氮冰淇淋</li>
                            <li><em class="dark">4</em>波尔多葡萄酒</li>
                            <li><em>5</em><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=121" target="_blank">维诺堤玛贵腐琼瑶浆甜白葡萄酒</a></li>
                            <li><em>6</em><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=107" target="_blank">艾伯爵 白中白香槟</a></li>
                            <li><em>7</em><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=106" target="_blank">马来西亚一级官燕盏</a></li>
                            <li><em>8</em><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=103" target="_blank">特级鳘肚公</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 旅游 -->
         <div class="floor">
            <div class="floorTop">
                <h3>旅游</h3>
                <em><a href="/shop/list/category/142.html"target="_blank"><span>></span>全部旅游</a></em>
                <h2 class="vocation globe_bg"></h2>
                    <ul class="floorTop-nav">
                        <li><a href="/shop/list/category/142.html"target="_blank">国内旅游</a></li>
                        <li><a href="/shop/list/category/142.html"target="_blank">国际旅游</a></li>
                    </ul>
            </div>
            <div class="floorCo">
                <div class="vactionCo">
                         <ul class="productList">
                            <li><a href="http://www.lfeel.com/life/list/view/2061.html"target="_blank"><img src="/images/shop/ind_63.jpg"/>
                                    <div class="proDetails"></div>
                                    <div class="proDetails_text">
                                        <i class="oversea globe_bg"></i>
                                        <h3>加拿大 体验多彩的动感之秋</h3>
                                        <p>加拿大的秋天充满动感与野性，丰富的野生动物带来一部纯天然的纪录片。来，一起去品味一下加拿大秋天的野趣吧。</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/2060.html"target="_blank"><img src="/images/shop/ind_64.jpg"/><i></i>
                                    <div class="proDetails"></div>
                                    <div class="proDetails_text">
                                        <i class="globe_bg"></i>
                                        <h3>拉风自驾 随移动住宅自由旅行</h3>
                                        <p>如果有人告诉你活动住宅和娱乐车有上升的空间，你也许会一边大笑一边摇头，觉得荒谬不已。你有没有想过可以开着车拖着移动住宅自在旅行，一路拉风？</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/2029.html"target="_blank"><img src="/images/shop/ind_65.jpg"/>
                                    <div class="proDetails"></div>
                                    <div class="proDetails_text">
                                        <i class="oversea globe_bg"></i>
                                        <h3>相亲旅游风行 11月艳遇在路上</h3>
                                        <p>刚刚过去的长假中，某相亲网站组织的旅游相亲活动报名火爆。对于单身贵族们来说，旅行不仅可以放松身心还是个“偶遇”的好时机。</p>
                                    </div>
                                </a>
                            </li>
                            <li><a href="http://www.lfeel.com/life/list/view/1937.html"target="_blank"><img src="/images/shop/ind_66.jpg"/>
                                    <div class="proDetails"></div>
                                    <div class="proDetails_text">
                                            <i class="globe_bg"></i>
                                            <h3>全球赏枫计划 9月走起</h3>
                                            <p>公认的全球赏枫季节要从9月下旬开始，色味不同的枫树漫山遍野地红着，这个秋季一起去观枫林盛景吧！</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
	<?php  $this->endCache();}?>
   <script>
/*首页倒计时*/
$(function(){
   
	countDown("2013/11/01 23:59:59","#hour"," #minute","#second");
	countDown("2013/11/02 23:59:59","#hour2"," #minute2","#second2");
	countDown("2013/11/02 23:59:59","#hour3"," #minute3","#second3");
	countDown("2013/11/02 20:59:59","#hour4"," #minute4","#second4");
});
$(function(){countDown("2013/11/01 23:59:59","#hour"," #minute","#second");countDown("2013/11/02 23:59:59","#hour2"," #minute2","#second2");countDown("2013/11/02 23:59:59","#hour3"," #minute3","#second3");countDown("2013/11/02 20:59:59","#hour4"," #minute4","#second4");});

function countDown(e,t,n,r){var i=(new Date(e)).getTime(),s=(i-(new Date).getTime())/1e3,o=setInterval(function(){if(s>0){s-=1;var e=Math.floor(s/3600/24),i=Math.floor(s/3600%24)+e*24,o=Math.floor(s/60%60),u=Math.floor(s%60);$(t).text(i<10?"0"+i:i),$(n).text(o<10?"0"+o:o),$(r).text(u<10?"0"+u:u)}else $(t).text("0"),$(n).text("0"),$(r).text("0")},1e3)}function box3(e){for(j=0;j<10;j++)e==j?($("#box3_b"+j).css("display",""),$("#box3_a"+j).attr("class","on")):($("#box3_b"+j).css("display","none"),$("#box3_a"+j).attr("class",""))}function switchTab(e){for(var t=1;t<=2;t++)document.getElementById("tab_"+t).className="",document.getElementById("tab_con_"+t).style.display="none";document.getElementById("tab_"+e).className="on",document.getElementById("tab_con_"+e).style.display="block"}$(function(){var e=$("#slidenav > li").length,t=1,n;n=setInterval(function(){box3(t),t++,t==e&&(t=0)},2e3)}),function(){var e=function(t,n,r){if(!(this instanceof e))return new e(t,n,r);var i=document.getElementById(t),s=i.getElementsByTagName("ul");this.jslideList=s[0],this.jslideNums=s[1].children,this.speed=r||2e3,this.picwidth=n||(i.currentStyle?parseFloat(i.currentStyle.width):parseFloat(document.defaultView.getComputedStyle(i,null).width)),this.currentIndex=0,this.distance=this.picwidth,this.currentLeftPos=0,this.runHandle=null,this.len=this.jslideNums.length};e.prototype={bindMouse:function(){var e=this;for(var t=0;t<this.len;t++)this.jslideNums[t].onmouseover=function(t){return function(){e.currentIndex=t,clearInterval(e.runHandle);var n=-1;for(var r=0;r<e.len;r++)e.jslideNums[r].className==="current"&&(n=r),e.jslideNums[r].className=r===t?"on":"";n!=t&&(e.distance=(n-t)*e.picwidth,e.currentLeftPos=-n*e.picwidth,e.transition(e.jslideList,{field:"left",begin:e.currentLeftPos,change:e.distance,ease:e.easeOutCirc}))}}(t),this.jslideNums[t].onmouseout=function(){e.autoRun()}},autoRun:function(){var e=this;this.runHandle=setInterval(function(){e.distance=-e.picwidth;for(var t=0;t<e.len;t++)e.jslideNums[t].className="";e.currentIndex++,e.currentIndex%=5,e.jslideNums[e.currentIndex].className="on",e.currentLeftPos=-(e.currentIndex-1)*e.picwidth,e.currentIndex==0&&(e.distance=(e.len-1)*e.picwidth,e.currentLeftPos=-e.distance),e.transition(e.jslideList,{field:"left",begin:e.currentLeftPos,change:e.distance,ease:e.easeOutCirc})},e.speed)},easeOutCirc:function(e){return Math.sqrt(1-Math.pow(e-1,2))},transition:function(e){e.style.position="relative",e.style.height="250px";var t=arguments[1]||{},n=t.begin,r=t.change,i=t.duration||500,s=t.field,o=t.ftp||50,u=t.onStart||function(){},a=t.onEnd||function(){},f=t.ease,l=n+r,c=(new Date).getTime();u(),function(){setTimeout(function(){var t=(new Date).getTime(),u=t-c,h=f(u/i);e.style[s]=Math.ceil(n+h*r)+"px",i<=u?(e.style[s]=l+"px",a()):setTimeout(arguments.callee,1e3/o)},1e3/o)}()},play:function(){this.bindMouse(),this.autoRun()}},window.JCP_Slide=e}(),$(function(){JCP_Slide("J-Slide").play(),JCP_Slide("J-Slide2").play(),JCP_Slide("J-Slide3").play(),JCP_Slide("J-Slide4").play()})
</script>      