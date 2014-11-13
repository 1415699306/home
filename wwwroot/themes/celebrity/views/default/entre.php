<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>乐荟网_中国领先的企业家门户平台_南方企业家</title>
<?php
$js = Yii::app()->getClientScript();
$js->registerCoreScript('jquery');
$js->registerScriptFile('/js/jquery.wresize.js');
$js->registerScriptFile('/js/picShow.js');
?>
<style>
*{margin:0;padding:0;color:#161616;}body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,textarea,button,p,blockquote,th,td{margin:0;padding:0;}body{color:#717171;font:12px/1.5,"Simsun",Tahoma,Helvetica,Arial,sans-serif;font-size:12px;}table{border-collapse:collapse;border-spacing:0;}li{list-style:none outside none;}fieldset,img{border:0;}button,input,textarea,select{font-family:inherit;font-size:100%;font-weight:inherit;outline:none;resize:none;color:inherit;}em,cite,i,th{font-style:normal;}th{font-weight:normal;}h1,h2,h3,h4,h5,h6{font-size:100%;}blockquote:before,blockquote:after,q:before,q:after{content:none;}blockquote,q{quotes:none;}a img,input{vertical-align:middle;}a{text-decoration:none;color:#444;line-height:18px;display:inline-block;}a:hover{text-decoration:underline;color:#0d608b;}legend{display:none;}button{cursor:pointer;}textarea{overflow:auto;resize:none;}.bg{width:100%;background:#e3e3e3;}.head{width:100%;height:90px;background:url(/images/entrepreneur/repeat-x.jpg) repeat-x;color:#fff;}.header{width:1000px;margin:0 auto;overflow:hidden;}.header .logo{float:left;width:76px;height:54px;background:url(/images/entrepreneur/globe.png) no-repeat;margin:18px 5px;display:inline;}.header_right{width:914px;float:left;}.header_right p{width:914px;text-align:right;}.header_right a.return{color:#a1a1a1;margin-top:10px;text-align:right;}.header_right .nav{float:right;margin:10px 0;}.header_right .nav a{margin:10px 20px;color:#fff;font-size:14px;font-family:Microsoft YaHei;display:inline;}.header_right .nav a.end{padding-right:0;}.main{margin:0 auto;width:100%;background:url(/images/entrepreneur/banner_bg.jpg) no-repeat top;}.banner{width:1000px;margin:0 auto;padding-left:8px;}.banner img{display:block;text-align:center;}.content{width:967px;margin:0 auto;background:#fff;clear:both;}.intro{width:903px;background:#fff url(/images/entrepreneur/repeat-x.jpg) repeat-x;background-position:0 -93px;overflow:hidden;padding:32px;}.intro .logo{float:left;width:119px;height:85px;background:url(/images/entrepreneur/globe.png) no-repeat;background-position:-376px 0;margin-right:25px;display:inline;}.intro .text p{text-indent:2em;line-height:24px;}.intro .text p strong{font-size:14px;}.gallery{width:937px;overflow:hidden;margin:0 15px;background:#fff url(/images/entrepreneur/repeat-x.jpg) repeat-x;background-position:0 -259px;padding-top:30px;height:348px;}.picShow{float:right;position:relative;}.gallery .select_btn{width:320px;overflow:hidden;float:left;}.gallery ul.picList li{float:left;width:150px;margin:0 8px 1px 0;display:inline;border:1px solid #fff;}.select_btn ul.picList li.current{border:1px solid #920101;}.gallery .picShow{width:617px;float:right;overflow:hidden;position:relative;}.gallery .picShow .picshow_img ul li{width:615px;height:345px;overflow:hidden;}.gallery .picShow .picshow_img ul li img{width:615px;height:345px;display:block;}.gallery .picshow_tx ul li{width:595px;height:60px;background:#000;background:rgba(0,0,0,0.6) none repeat scroll 0 0 !important;padding:10px;position:absolute;bottom:0;left:0;overflow:hidden;filter:Alpha(opacity=60);background:#000;cursor:pointer;}.gallery .picshow_tx ul li h2{font-size:20px;font-family:Microsoft YaHei;color:#fff;}.gallery .picshow_tx ul li p{color:#fff;height:15px;overflow:hidden;margin-top:10px;}.textRead,.subject{width:937px;margin:0 15px;margin-top:12px;overflow:hidden;}.leftText{width:650px;float:left;overflow:hidden;}.leftText .TextTitle{position:relative;border-bottom:4px solid #8b7061;height:53px;width:650px;}.leftText .TextTitle em{position:absolute;width:178px;height:49px;background-color:#fff;background-image:url(/images/entrepreneur/globe.png);background-repeat:no-repeat;background-position:-79px 0;top:14px;z-index:55;}.mainList{padding:0 10px;width:630px;padding-bottom:10px;}.mainList h2{width:48px;height:20px;background:url(/images/entrepreneur/globe.png) no-repeat;background-position:-275px -7px;color:#fff;text-align:center;font-size:12px;margin-top:13px;line-height:15px;}.mainList ul.view li{width:630px;border-bottom:1px dashed #afafb0;overflow:hidden;padding:20px 0;}.mainList ul.view li a.ImgFloat{float:left;border:1px solid #ddd;margin-right:13px;display:inline;}.mainList ul.view li .paragraph{float:right;width:490px;}.mainList ul.view li .paragraph p{text-indent:2em;color:#717171;line-height:22px;height:66px;overflow:hidden;}.mainList ul.view li .paragraph p a.more{color:#ba2636;}.sidebar{float:right;width:273px;}.innovation,.economy{padding-bottom:20px;width:273px;}.innovation .title,.economy .title{width:273px;height:53px;background:url(/images/entrepreneur/globe.png) no-repeat;background-position:-79px -61px;}.innovation .inno_bt,.economy .inno_bt{margin-top:20px;overflow:hidden;width:273px;}.innovation ul.picView,.economy ul.picView{float:right;width:100px;margin-right:10px;display:inline;}.innovation ul.picView li,.economy ul.picView li{width:100px;margin-bottom:10px;}.innovation .inno_bt ul.textList li,.economy .inno_bt ul.textList li{background-image:url(/images/entrepreneur/globe.png);background-color:#fff;background-repeat:no-repeat;background-position:-354px -89px;padding-left:5px;height:24px;line-height:24px;width:155px;}.economy .title{background-position:-79px -123px;}/*乐荟专题*/.subject{border:1px solid #ddd;padding:0 10px;width:915px;text-align:right;color:#717171;line-height:48px;height:48px;}.subject em.title{float:left;width:106px;height:26px;background:url(/images/entrepreneur/globe.png) no-repeat;background-position:-79px -185px;margin-top:10px;}.subject a{margin:0 5px;color:#717171;line-height:48px;}/*尾部*/.footer{width:967px;background:#fff;margin:0 auto;overflow:hidden;padding:20px 0;}.footer .footerNav{margin:0 auto;text-align:center;color:#717171;margin:20px 0;}.footer .footerNav a{margin:0 10px;color:#717171;}.copyright{text-align:center;color:#717171;}
</style>
</head>
<body class="bg">
    <div class="head">
        <div class="header">
        <div class="logo"><a href="#"></a></div>
        <div class="header_right">
           <p><a href="/" class="return">返回官网首页</a></p>
            <div class="nav">
                <?php echo CHtml::link('奢生活',$this->createUrl('/life'));?><?php echo CHtml::link('政企通',$this->createUrl('/investment/list'));?> <?php echo CHtml::link('乐聚会',$this->createUrl('/meet'));?><?php echo CHtml::link('品牌购','http://shop.lfeel.com/',array('target'=>'_blank'));?><a href="http://www.lfeel.cn/" target="_blank">乐荟圈</a><?php echo CHtml::link('商机汇',$this->createUrl('/trade'));?><?php echo CHtml::link('慧学习',$this->createUrl('/study'));?><?php echo CHtml::link('名人绘',$this->createUrl('/celebrity'));?><?php echo CHtml::link('公益行',$this->createUrl('/community'));?><?php echo CHtml::link('梦想秀',$this->createUrl('/dream'));?><a href="http://www.lfeel.cn/" class="end">乐荟社</a>
            </div>
        </div>
        </div>
    </div>
    <div class="main">
    <div class="banner">
		<a><img src="/images/entrepreneur/index_09.jpg" alt="" /></a>
    </div>
    <div class="content">
    <div class="intro">
    	<div class="logo"></div>
        <div class="text">
        	<p><strong>《南方企业家》</strong>杂志是由广东省经济和信息化委员会主管、广东省企业联合会、广东省企业家协会主办的面向国内外公开发行的高端财经杂志，是聚焦华南企业家群体的权威杂志。在中国最具影响力的粤商群体里具有很大影响力。</p>
            <p>作为一个聚焦华南企业及企业家的传媒平台，全新改版的《南方企业家》杂志坚持“关注中国新兴商业力量”的定位，力求成为企业家的朋友、伙伴、同志和助手。这是一本让企业家把生意做得更好，让企业家生活得更快乐的杂志，也是为他们建立的一个更好地服务社会的平台。</p>
        </div>
    </div>
    <div class="gallery">
    <div class="select_btn">
    	<ul class="picList">
            <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=177" img_url="/images/entrepreneur/index_23.jpg" target="_blank"></a></li>
            <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=175" img_url="/images/entrepreneur/index_25.jpg" target="_blank"></a></li>
            <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=210" img_url="/images/entrepreneur/index_31.jpg" target="_blank"></a></li>
            <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=139" img_url="/images/entrepreneur/index_32.jpg" target="_blank"></a></li>
            <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=199" img_url="/images/entrepreneur/index_36.jpg" target="_blank"></a></li>
            <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=165" img_url="/images/entrepreneur/index_37.jpg" target="_blank"></a></li>
            <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=149" img_url="/images/entrepreneur/index_40.jpg" target="_blank"></a></li>
            <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=147" img_url="/images/entrepreneur/index_41.jpg" target="_blank"></a></li>
        </ul>
   </div>
        <div class="picShow">
        	<div class="picshow_img">
            	<ul class="picleftshow">
                    <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=177" img_url="/images/entrepreneur/index_27-01.jpg" target="_blank"></a></li>
                    <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=175" img_url="/images/entrepreneur/index_25-02.jpg" target="_blank"></a></li>
                    <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=210" img_url="/images/entrepreneur/index_31-03.jpg" target="_blank"></a></li>
                    <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=139" img_url="/images/entrepreneur/index_32-04.jpg" target="_blank"></a></li>
                    <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=199" img_url="/images/entrepreneur/index_36-05.jpg" target="_blank"></a></li>
                    <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=165" img_url="/images/entrepreneur/index_37-06.jpg" target="_blank"></a></li>
                    <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=149" img_url="/images/entrepreneur/index_40-07.jpg" target="_blank"></a></li>
                    <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=147" img_url="/images/entrepreneur/index_41-08.jpg" target="_blank"></a></li>    
                </ul>
            </div>
             <div class="picshow_tx">
             <ul>
             	<li>
                	 <h2>宿城聚焦：在长寿之乡追求企业长寿</h2> 
                 	 <p class="gf_text">宿城聚焦：在长寿之乡追求企业长寿宿城区地处江苏省北部，是苏、鲁、豫、皖四省之通衢，属于陇海......</p>
               </li>
             	<li>
                	 <h2>灌云·新印象</h2> 
                 	 <p class="gf_text">灌云·新印象6500年前，这里就有人类繁衍生息，大伊山石棺墓遗址向人们讲述着新石器时代远古文明......</p>
               </li>
             	<li>
                	 <h2>58同城上市前陡然盈利：源于广告费支出大减</h2> 
                 	 <p class="gf_text"> 一名58同城的投资人对《第一财经日报》记者表示，美国政府停摆对58同城的赴美上市进程不......</p>
               </li>
             	<li>
                	 <h2>牛根生：半生商业 半生慈善</h2> 
                 	 <p class="gf_text">蒙牛上市之後，牛根生宣布捐出所有股份，仍让申淑香十分不解。她原本认为牛根生只会捐出.....</p>
               </li>
             	<li>
                	 <h2>代工厂的“抱团模式”联盟网络营销</h2> 
                 	 <p class="gf_text"> 代工厂的通俗解释，就是帮别的品牌做生广加工的工厂或者企业。在人口红利巨大和人民币......</p>
               </li>
             	<li>
                	 <h2>农夫山泉“标准门”：媒体对决还是行标对决？</h2> 
                 	 <p class="gf_text">2013年3月以来，瓶装饮用水生产企业农夫山泉的“标准门”持续发酵。一石激起千层浪，一切.....</p>
               </li>
             	<li>
                	 <h2>BAE公司与丹麦企业拓展国防合作 含为F-35造零件</h2> 
                 	 <p class="gf_text">中新网9月16日电 据中国国防科技信息网报道，9月12日，BAE系统公司与丹麦托马公司宣布签.....</p>
               </li>
             	<li>
                	 <h2>游客不应沦为 企业纠纷的“棋子”</h2> 
                 	 <p class="gf_text">沙钢船务与海航集团经济纠纷“绑架”游客一事在国内引起巨大反响。中国“海娜号”邮轮在.....</p>
               </li>
             </ul>
                 
             </div>
        </div>
    </div>
    <div class="textRead">
        <div class="leftText">
        	<div class="TextTitle">
            	<em></em>
            </div>
            <div class="mainList">
                <h2>宏观</h2>
                <ul class="view">
                	<li>
                    	<a href="http://www.nfqyj.net/?mdl=news&do=view&id=185" target="_blank" class="ImgFloat" img_url="/images/entrepreneur/index_60.jpg" target="_blank"></a>
                	  <div class="paragraph">
                   	    <h3><a href="http://www.nfqyj.net/?mdl=news&do=view&id=185" target="_blank">闽商系房企“新海盗计划”暗流汹涌</a></h3>
                            <p>多年前万科曾针对中海员工制定了名为“海盗”的挖人行动，但让万科没想到的是，如今，新兴的闽商系房企却将“挖人”的目标对准了自己。近日，上海万科总经理陈东彪离职。而在陈东彪离职的背后，一股潜流暗中涌动。近一年多以来，福建籍.....<a href="http://www.nfqyj.net/?mdl=news&do=view&id=185" class="more" target="_blank">[详细]</a></p>
                        </div>
                    </li>
                    <li>
                    	<a href="http://www.nfqyj.net/?mdl=news&do=view&id=183" class="ImgFloat" img_url="/images/entrepreneur/index_67.jpg" target="_blank"></a>
                        <div class="paragraph">
                        	<h3><a href="http://www.nfqyj.net/?mdl=news&do=view&id=183" target="_blank">济南文东商会助推区域知识经济产业</a></h3>
                            <p>为充分发挥文东商会中心城区知识经济发展的优势，山东省济南市历下区工商联文东商会以解决企业需求为目的，以创新工作思路为抓手，以促进企业发展为中心，开展了“三式”服务，重点助推知识经济企业发展，有效推动了区域经济的......<a href="http://www.nfqyj.net/?mdl=news&do=view&id=183" class="more" target="_blank">[详细]</a></p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="mainList">
                <h2>政策</h2>
                <ul class="view">
                	<li>
                    	<a href="http://www.nfqyj.net/?mdl=news&do=view&id=213" class="ImgFloat" img_url="/images/entrepreneur/index_75.jpg" target="_blank"></a>
                        <div class="paragraph">
                        	<h3><a href="http://www.nfqyj.net/?mdl=news&do=view&id=213" target="_blank">白酒行业 寒风之下热流涌动</a></h3>
                            <p>整个行业里的人都在喊难，中国白酒行业发展到底有多难？西凤品昧酒全国品牌运营中心南方大区营销总监黄汉川为《南方企业家》记者讲述的几个事实或许能一探究竟："从去年开始，全国年产500吨以下的小酒厂基本上倒了一大半。”而谈起各.....<a href="http://www.nfqyj.net/?mdl=news&do=view&id=213" class="more" target="_blank">[详细]</a></p>
                        </div>
                    </li>
                    <li>
                    	<a href="http://www.nfqyj.net/?mdl=news&do=view&id=212" class="ImgFloat" img_url="/images/entrepreneur/index_81.jpg" target="_blank"></a>
                        <div class="paragraph">
                        	<h3><a href="http://www.nfqyj.net/?mdl=news&do=view&id=212" target="_blank">价格下滑： 中国锂电产业加速升温</a></h3>
                            <p>近曰，美国特斯拉的一纸财报把远在大洋彼岸的中国同行伙伴们给"惊呆”了。说起特斯拉电动车，其得名于美国天才物理学家及电力工程师尼古拉•特斯拉，他制造的电动车以其产品的先进技术、独特造型、高效加速和良好操控性能赢得了不少...<a href="http://www.nfqyj.net/?mdl=news&do=view&id=212" class="more" target="_blank">[详细]</a></p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="mainList">
                <h2>企业</h2>
                <ul class="view">
                	<li>
                    	<a href="http://www.nfqyj.net/?mdl=news&do=view&id=146" target="_blank" class="ImgFloat" img_url="/images/entrepreneur/index_87.jpg"></a>
                        <div class="paragraph">
                        	<h3><a href="http://www.nfqyj.net/?mdl=news&do=view&id=146" target="_blank">苹果公司透露明确信息：我们不在乎市场份额</a></h3>
                            <p>在发布会前，外界普遍预计该公司将推出低价iPhone，并将借此扩大潜在市场。但苹果公司并没有推出低价iPhone，而是沿用了多年以来的定价策略：iPhone 5c在美国的合约价为99美元，裸机价......<a href="http://www.nfqyj.net/?mdl=news&do=view&id=146" target="_blank" class="more">[详细]</a></p>
                        </div>
                    </li>
                    <li>
                    	<a href="http://www.nfqyj.net/?mdl=news&do=view&id=215" target="_blank" class="ImgFloat" img_url="/images/entrepreneur/index_89.jpg"></a>
                        <div class="paragraph">
                        	<h3><a href="http://www.nfqyj.net/?mdl=news&do=view&id=215" target="_blank">洋品牌遇劫， 中国奶企的春天会不会来</a></h3>
                            <p>过去一个月内，新西兰奶粉出现三次质量问题，先是恒天然"肉毒杆菌”事件、接下来是斯里兰卡政府在新西兰奶粉中检测出了双氰胺、质检总局又在新西兰Westland公司的乳铁蛋白中检出硝酸盐。这次新西兰奶粉事件发生后，消费者对新西兰奶粉.......<a href="http://www.nfqyj.net/?mdl=news&do=view&id=215" target="_blank" class="more">[详细]</a></p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sidebar">
        	<div class="innovation">
            	<div class="title"></div>
                <div class="inno_bt">
                    <ul class="picView">
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=188" img_url="/images/entrepreneur/index_71.jpg" target="_blank"></a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=103" img_url="/images/entrepreneur/index_74.jpg" target="_blank"></a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=198" img_url="/images/entrepreneur/index_76.jpg" target="_blank"></a></li>
                    </ul>
                    <ul class="textList">
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=188" target="_blank">优秀企业家的四种特质</a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=103" target="_blank">白酒“第二阵营”</a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=198" target="_blank">家族企业如何成功“交班”</a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=193" target="_blank">企业家“走出去”</a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=196" target="_blank">懒人经济学：送上门</a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=197" target="_blank">“负面营销”</a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=200" target="_blank">绐苦逼的营销执行官们</a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=133" target="_blank">光伏企业大举融资</a></li>
                    </ul>
               </div>
            </div>
            <div class="economy">
            	<div class="title"></div>
                <div class="inno_bt">
                    <ul class="picView">
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=176" img_url="/images/entrepreneur/index_71-01.jpg" target="_blank"></a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=174" img_url="/images/entrepreneur/index_74-02.jpg" target="_blank"></a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=172" img_url="/images/entrepreneur/index_76-03.jpg" target="_blank"></a></li>
                    </ul>
                    <ul class="textList">
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=53" target="_blank">仁者李楚源</a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=168" target="_blank">郑靖：时尚“辣妈”</a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=169" target="_blank">苏增福：实业是立身之本</a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=144" target="_blank">上市公司重组潮起</a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=96"  target="_blank">民族之责</a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=148" target="_blank">日本企业被指避开</a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=146" target="_blank">苹果公司透露明确信息</a></li>
                        <li><a href="http://www.nfqyj.net/?mdl=news&do=view&id=170" target="_blank">滇中楚雄</a></li>
                    </ul>
               </div>
                
            </div>
            <a><img src="/images/entrepreneur/index_79.jpg" alt="" /></a>
        </div>
    </div>
    <div class="subject">
    	<em class="title"></em>
        <a href="/">乐荟首页</a>|<a href="#">回到顶部</a>
    </div>
    </div>
    <div class="foot">
        <div class="footer">
            <div class="footerNav">
                <a href="/life">奢生活</a>|<a href="/investment/list">政企通</a>|<a href="/meet">乐聚会</a>|<a href="http://shop.lfeel.com/">品牌购</a>|<a href="http://www.lfeel.cn/">乐荟圈</a>|<a href="/trade">商机汇</a>|<a href="/study">慧学习</a>|<a href="/celebrity">名人绘</a>|<a href="/community">公益行</a>|<a href="/dream">梦想秀</a>|<a href="http://www.lfeel.cn">乐荟社</a>
            </div>
            <div class="copyright">版权声明：所有图片均受著作权保护，未经许可不得使用，不得转载、摘编。 广州乐荟科技有限公司版权所有 @ 2005-2013 粤ICP备13024867号</div>
        </div>
    </div>
</div>
</body>
</body>
</html>
