<?php $this->pageTitle=Yii::app()->name.'_中国领先的企业家门户平台'?>
<?php 
$js = Yii::app()->getClientScript();
$js->registerCssFile(Yii::app()->theme->baseUrl.'/css/basic.css');
?>
<!--中间主体内容 -->
<div class='main'>
	<div class='bigdiv'>
    	<div class='leftfloat leftfloat_bg'> 
            <div class='titile'>
               <em class="title_bg one"></em>
              <i class='TopR'></i>  
              <i class='TopL'></i>      	
            </div>
            <div class='mainTop_leftM'>
                <?php foreach(Article::getAri('2','0','4') as $key=>$val):?>
                     <?php if($key < 1):?>
                <div class='Headlines'>
                    <h1>
                        <?php echo CHtml::link(Helper::truncate_utf8(Chtml::encode($val['title']),12,false),$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?>
                    </h1>       
                    <span id="img_url" class="img_url" link_href="<?php echo $this->createUrl('/article/list/view',array('id'=>$val['id']));?>" img_title="<?php echo $val['title']?>" img_url="<?php echo Storage::getImageBySize($val['track_id'],'article','4_3','thumb');?>"></span>
                    <p class='Top_text'><?php echo CHtml::encode(Helper::truncate_utf8(!empty($val['discription'])?$val['discription']:'暂无数据',60));?></p>
                </div>
				
                <div class='mainTop_text'>
                        <?php else:?>
                      <ul class='mainTop_list'>  
                            <?php echo CHtml::link($val['title'],$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('target'=>'_blank','img_url'=>Storage::getImageBySize($val['track_id'],'article','4_3','thumb')));?>
                        <li><b><?php echo CHtml::link(Helper::truncate_utf8(Chtml::encode($val['title']),12,false),$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?></b></li>                 
                            <?php foreach(Article::getArticle(2,$key) as $v):?>
                                <li><?php echo CHtml::link(Helper::truncate_utf8(Chtml::encode($v['title']),12,false),$this->createUrl('/article/list/view',array('id'=>$v['id'])),array('target'=>'_blank'));?></li>                 
                            <?php endforeach;?> 
                    </ul>
                    <?php endif;?>
                  <?php endforeach;?> 
                </div>
                
                <div class='Top_news'>
                	<span class="scrollnews">新闻轮播：</span>
                    <div id="scrollnews">
                        <ul id="scrollnews">
                            <?php foreach(Article::getAri('2','0','4') as $key): ?>
                            <li><?php echo CHtml::encode(Helper::truncate_utf8($key['title'],18));?></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
               </div>
            </div> 
        </div>
      
      <div class='center topbanner' id="temp1">
            <div class='banner' id="box3_b1">
                <a href="http://www.lfeel.com/trade/list/view/41.html" target="_blank" img_url="../images/shouye/1.jpg"></a>
            </div>
            <div class='banner' id="box3_b2" style="display:none">
                 <a href="http://www.lfeel.com/life/list/view/1202.html" target="_blank" img_url="../images/shouye/2.jpg"></a>
            </div>
            <div class='banner' id="box3_b3" style="display:none">
                 <a href="http://www.lfeel.com/study/list/view/566.html" target="_blank" img_url="../images/shouye/3.jpg"></a>
            </div>
            <div class='banner' id="box3_b4" style="display:none">
                <a href="http://www.lfeel.com/meet/list/sign/45.html" target="_blank" img_url="../images/shouye/4.jpg"></a>
            </div>
        
          <div class='bannerBottom'>
          	<ul class='bannerBottom_list'>
            	<li id="box3_a1"  onmousemove="box3(1)">
                    <div class='pic_list'>
                        <a href="http://www.lfeel.com/trade/list/view/41.html" target="_blank" img_url="../images/shouye/1-1.jpg"></a>
                    </div>   
                </li>
				<li  id="box3_a2"  onmousemove="box3(2)">
                    <div class='pic_list'>
                        <a href="http://www.lfeel.com/life/list/view/1202.html" target="_blank" img_url="../images/shouye/2-2.jpg"></a>
                    </div>
                </li>
            	<li id="box3_a3"  onmousemove="box3(3)">
                    <div class='pic_list'>
                        <a href="http://www.lfeel.com/study/list/view/566.html" target="_blank" img_url="../images/shouye/3-3.jpg"></a>
                    </div>
                </li>
                <li id="box3_a4"  onmousemove="box3(4)">
                    <div class='pic_list'>
                        <a href="http://www.lfeel.com/meet/list/sign/45.html" target="_blank" img_url="../images/shouye/4-4.jpg"></a>
                    </div>
                </li>
            </ul> 
          </div>

     </div>
      
        
	 
      <div class='rightdiv'>
      	<div class='rightAikanTitle'><em class="title_bg two"></em></div>
        <div class='rightAikanTab'>
        	<p>1小时前</p> 
            <div class='rightAikanText bd' style="height:297px;">
        	<ul class='rightAikanText_list'>
                 <?php foreach(Article::getAri('3','0','8') as $key=>$val):?>
                     <?php if($key < 1):?>
            	<li class='tall'>
                    <div class='bd' id="newhead">
                        <h1><?php echo CHtml::link(Helper::truncate_utf8(Chtml::encode($val['title']),18,false),$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?></h1>
                        <?php echo CHtml::link(Helper::truncate_utf8($val['title'],18,false),$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('target'=>'_blank','class'=>'imgArea','img_url'=>Storage::getImageBySize($val['track_id'],'article','4_3','thumb')));?>
                        <?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($val['discription'],40)),$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('discription'=>$val['discription'],'target'=>'_blank','class'=>'txtArea'));?>
               		</div>	
                </li>
                <?php else:?>
                <li>
					<div class="bd">
						<h1>
							<?php echo CHtml::link(Helper::truncate_utf8(Chtml::encode($val['title']),18,false),$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?>
						</h1>
						<div class="news_info">
							<?php echo CHtml::link(Helper::truncate_utf8($val['title'],18,false),$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('target'=>'_blank','class'=>'imgArea','img_url'=>Storage::getImageBySize($val['track_id'],'article','4_3','thumb')));?>
							<?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($val['discription'],40)),$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('discription'=>$val['discription'],'target'=>'_blank','class'=>'txtArea
'));?>
						</div>
					</div>
				</li>
                <?php endif;?>
               <?php endforeach;?> 
            </ul>
        </div>
       </div>
    </div> 
            <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::ARTICLE,'res_id'=>113,'type'=>1,'width'=>309,'height'=>111));?>
  </div>
	<div class='bigdiv'>
    	<div class='leftfloat'>
        	<div class='subtitle'></div>
            <ul class='MemberTab'>
           	  <h2>
                	<a href="http://quanzi.lfeel.com/" class='imgArea' img_url="../images/image/hy_1.jpg"></a><br>
              </h2>
              <li><b>康宜华</b></li>
              <li>华瑞国际集团董事长</li>
              <li><p>20年中，华瑞从单纯的进出口业务公司，丰富成了以贸易为先导，以工厂为基础的外贸加工企业。</p></li>
            </ul> 
           <div id="scrollbox" class="bx_wrap">     
              <div class="bx_container">
                <ul class='MemberList' id="MemberList">
                    <li>
                        <a href="http://quanzi.lfeel.com/" target="_blank"><img src="../images/image/hy_5.jpg" alt="" /></a>
                    	<p>边书平</p>
                        <p>董事长</p>
                    </li>
                    <li>
                        <a href="http://quanzi.lfeel.com/" target="_blank"><img src="../images/image/hy_4.jpg" alt="" /></a>
                        <p>冯仑</p>
                        <p>董事长</p>
                    </li>
                    <li>
                       <a href="http://quanzi.lfeel.com/" target="_blank"><img src="../images/image/hy_3.jpg" alt="" /></a>
                        <p>李开复</p>
                        <p>首席执行官</p>
                    </li>
                    <li>
                        <a href="http://quanzi.lfeel.com/" target="_blank"><img src="../images/image/hy_2.jpg" alt="" /></a>
                        <p>董文标</p>
                        <p>银行董事长</p>
                    </li>
                </ul>  
            </div>
           </div>
                <div class='member_bar'>
                    <a id="img_url" href="http://quanzi.lfeel.com/" img_url="../images/image/member_bar.jpg"></a>
          </div>
            <div class='member_btn'>
            	<a href="http://quanzi.lfeel.com/member.php?mod=register" target="_blank"></a>
            </div>  
      		</div>
          
    	<div class='center'>
        	<div class='DiscussTitle'>
                <h1>你认为应该禁播《大漠谣》吗？</h1>
            </div>
            <div class='Discuss'>
                <div class='DiscussLeft'>
                    <p>大漠谣前半部有辱民族但是却极为好看，什么是历史？后人怎么评论我们？日本学生永远不知曾经的真实历史。但是还是应该禁播的，毕竟西部已经够乱了，这剧情的确很不妥当。</p>
                    <span class='support'>支持数：5291 </span>
                </div>
                <div class='DiscussRight'>
                    <p>不应该这个虽然会给青少年带来误导，但哪一部剧不会啊？ 杨家将、金庸写的小说神马的，不都不是历史真实吗？凭什么这些都能播。《大漠谣》就不能啊？你歧视啊！
</p>
                    <span class='against'>支持数： 9545</span>
                </div>
             </div>
            
            <div  class="bd" id="bd">
             <ul class="slideshow" id="demo">
                 <?php foreach(CelebrityPainted::getCele('57','0','3') as $key):?>
             	<li class="li_2">
                   <div class='floatLeft'>
                       <a id="img_url" href="<?php echo $this->createUrl('/celebrity/list/view',array('id'=>$key['id']));?>" img_title="<?php echo $key['title']?>" img_url="<?php echo Storage::getImageBySize($key['track_id'],'celebrity','4_3','thumb');?>"></a>
                   </div>    
                   <div class='testimonials-font'>
                          <blockquote><?php echo CHtml::encode(Helper::truncate_utf8(!empty($key['discription'])?$key['discription']:'暂无数据',100));?></blockquote>
                    <em>——<?php echo CHtml::encode(Helper::truncate_utf8(!empty($key['guests'])?$key['guests']:'暂无数据',10));?></em>       
                   </div>
        		</li>
                <?php endforeach;?>    
             </ul>
            </div>

    </div>
    <div class='rightdiv leftfloat_bg' style="height:278px;">
            	<div class='title'>
            		<em class="title_bg four"></em>
                     <i class='TopR'></i>  
              		 <i class='TopL'></i>
                </div>
                <div class='meetingContent'>
                    <a id="img_url" href="http://www.lfeel.com/meet/list/sign/45.html" img_url="../images/image/meeting_1.jpg"></a>
					<p class='last'>主题：<b>2013广州国际服装节暨广州时装周</b></p>
                    <p class='last'>地点：广州国际会展中心</p>
                   <!-- <p class='last'>时间：2013.7.7</p>-->
                    <p class='last'>距报名结束还有　<span class='bg' id="day"></span>　天　<span class='bg' id="hour"></span>　时　<span class='bg' id="minute"></span>　分</p>
                    
                    <div class='meetingButtom'>
                        <a href="http://quanzi.lfeel.com/member.php?mod=logging&action=login" class="buttom" target="_blank" >活动提醒</a>
                        <a href="http://www.lfeel.com/meet/list/sign/45.html" class="buttom buttom2" target="_blank">我要报名</a>
                    </div>
                </div>
 <div class='meetingBottom'>
       	<ul class='meetingBottomLeft'>
                    	<li>逛社区</li>
                        <li>听杂谈</li>
                        <li>说说话</li>
                    </ul>
                    <ul class='meetingBottomRight'>
                    	<li><a href="/html/view/id/temp_15" target="_blank">风青杨：中国顶尖人才流失为何世界第一？</a></li>
                        <li><a href="/html/view/id/temp_16" target="_blank">富人纷纷移民或是因为提前看到了危机</a></li>
                        <li><a href="/html/view/id/temp_17" target="_blank">普京高调离婚意味着什么？</a></li>
                        <li><a href="/html/view/id/temp_18" target="_blank">我们要学会原谅厦门公交爆炸嫌犯！</a></li>
                    </ul>
                </div>
        </div>               
    </div>
    <div class='wrap_banner'>
    	<div class='wrapLeft'>
            <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::ARTICLE,'res_id'=>114,'type'=>1,'width'=>907,'height'=>85));?>
        </div>
        <div class='wrapRight'>
            <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::ARTICLE,'res_id'=>115,'type'=>1,'width'=>306,'height'=>85));?>
        </div>
</div>  
 <div class='bigdiv'>
            <div class='leftfloat'>
	<div class='subtitle' style="float:none"><em class="title_bg five"></em><a href="/celebrity/list/category/59.html" target="_blank">更多>></a></div>
		<div class="carousel"> 
			<div class="slides">
					<?php foreach(News::getNew('59','0','4') as $key):?>
                        <div class="slideItem">   
                            <a id="img_url" href="<?php echo $key['link'];?>"  img_title="<?php echo $key['title']?>" img_url="<?php echo Storage::getImageBySize($key['track_id'],'news','9_16','thumb');?>" target="_blank"></a>
                        </div>
                    <?php endforeach;?>
			</div> 
		   
			<div class="nextButton"></div><div class="prevButton"></div>
			<div class="buttonNav">
				 <?php foreach(News::getNew('59','0','4') as $key):?>
                    <div style="text-align: left;" class="bullet">
                            <h5><a href="<?php echo $key['link'];?>" target="_blank"><?php echo CHtml::encode(Helper::truncate_utf8(!empty($key['title'])?$key['title']:'暂无数据',12));?></a></h5>
                            <p>简介:<?php echo CHtml::encode(Helper::truncate_utf8(!empty($key['discription'])?$key['discription']:'暂无数据',60));?><span><a href="<?php echo $key['link'];?>" target="_blank">浏览全部</a></span></p>
                    </div>
                <?php endforeach;?> 
			</div>
		</div> 	
</div>
            
     
            <div class='center' style='_width:578px;'>
        	<div class='subtitle centertitle'><em class="title_bg six"></em><a href="/study/list/category/87.html" target="_blank">更多>></a></div>
            <div class='mainTCenter_Top'>
               
                <?php foreach(News::getNew('87','0','1') as $key):?>
                <div class='mainTCenter_TopPic'>  
                    <a id="img_url" href="<?php echo $key['link'];?>" img_title="<?php echo $val['title']?>" img_url="<?php echo Storage::getImageBySize($key['track_id'],'news','4_3','thumb');?>" target="_blank"></a>
                </div>
                <div class='mainTCenter_TopText'>    
                	<h3>  
                        <a href="<?php echo $key['link'];?>" target="_blank"><?php echo Helper::truncate_utf8($key['title'],10,false);?></a>
                    </h3>
                    <p>讲师：<b><?php echo CHtml::encode(!empty($key['professor'])?$key['professor']:'暂无数据');?></b></p>
                    <p>简介：<?php echo CHtml::encode(Helper::truncate_utf8(!empty($key['discription'])?$key['discription']:'暂无数据',70));?></p>
                </div> 
               <?php endforeach;?>
            </div>  
            <div class='mainTCenter_bottom'>
                	<ul class='mainTCenter_list'>
                        <?php foreach(News::getNew('87','1','3') as $key=>$val):?>
                     <?php if($key < 2):?>
                        <li>
                            <a id="img_url" href="<?php echo $val['link'];?>" img_title="<?php echo $val['title']?>" img_url="<?php echo Storage::getImageBySize($val['track_id'],'news','4_3','thumb');?>" target="_blank"></a>
                        </li>
                        <?php else:?>
                        <li style=' float:right; padding-right:0;'><a id="img_url" href="<?php echo $val['link'];?>" img_title="<?php echo $val['title']?>" img_url="<?php echo Storage::getImageBySize($val['track_id'],'news','4_3','thumb');?>" target="_blank"></a></li>
                           <?php endif;?>
                        <?php endforeach;?> 
                    </ul>
           </div>
         
        </div>
            <div class='rightdiv'>
                <div class='subtitle'><em class="title_bg seven"></em><?php echo CHtml::link('更多',$this->createUrl('/celebrity/list/category',array('id'=>'57')),array('target'=>'_blank'));?></div>
               
                <div class='Leftside_text'>
                        <ul class='textlist_2'>
                            <?php foreach(CelebrityPainted::getCele('57','0','8') as $key=>$val):?>
                                <?php if($key < 1):?>
                        	<li class='tall'>
                                 <div class='mainTRight_Tab'>
                                     <?php echo CHtml::link($val['title'],$this->createUrl('/celebrity/list/view',array('id'=>$val['id'])),array('target'=>'_blank','class'=>'imgArea','img_url'=>Storage::getImageBySize($val['track_id'],'celebrity','4_3','thumb')));?>
                                    <h3> <?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($val['title'],13,false)),$this->createUrl('/celebrity/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?></h3> 
                                    <p><?php echo CHtml::encode(Helper::truncate_utf8(!empty($val['discription'])?$val['discription']:'暂无数据',60));?></p>
                                </div>
                            </li>
                            <?php else:?>
                            <li><?php echo CHtml::link(CHtml::encode($val['title']),$this->createUrl('/celebrity/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?></li> 
                            <?php endif;?>
                            <?php endforeach;?>
                        </ul>
                 </div>
                
           </div>
        </div> 
    <div class='bigdiv'>
   	 <div class='leftdiv'>
    	<div class='bigTitle'>
        <div class='list'>
                <a href="/investment/list/category/21.html" id="box1_a1" class="imgArea float" onmousemove="box1(1)" target="_blank">工业项目</a>/
                <a href="/investment/list/category/22.html" id="box1_a2" class="imgArea float" onmousemove="box1(2)" target="_blank">农业项目</a>/
                <a href="/investment/list/category/23.html" id="box1_a3" class="imgArea float" onmousemove="box1(3)" target="_blank">旅游项目</a>/
                <a href="/investment/list/category/24.html" id="box1_a4" class="imgArea float" onmousemove="box1(4)" target="_blank">地产项目</a>/
                <a href="/investment/list/category/25.html" id="box1_a5" class="imgArea float" onmousemove="box1(5)" target="_blank">园区项目</a>/
                <a href="/investment/list/category/26.html" id="box1_a6" class= "imgArea float" onmousemove="box1(6)" target="_blank">其他项目</a>
            </div>
        <a href="/investment/list.html" target="_blank"><em class='title_1'></em></a>
        </div>
           
             <div class='leftfloat' style="margin-top: 20px;">
			<div class="carousel carouse2"> 
			<div class="slides">
					<?php foreach(News::getGove('1','0','4') as $val):?>
                        <div class="slideItem">   
                            <a id="img_url" href="<?php echo $val['link'];?>"  img_title="<?php echo $val['title']?>" img_url="<?php echo Storage::getImageBySize($val['track_id'],'news','9_16','thumb');?>" target="_blank"></a>
                        </div>
                    <?php endforeach;?>
			</div> 
		   
			<div class="nextButton"></div><div class="prevButton"></div>
			<div class="buttonNav">
				 <?php foreach(News::getGove('1','0','4') as $val):?>
                    <div style="text-align: left;" class="bullet">
                            <h5><a href="<?php echo $val['link'];?>" target="_blank"><?php echo CHtml::encode(Helper::truncate_utf8(!empty($val['title'])?$val['title']:'暂无数据',15));?></a></h5>	
                        <p><span>项目介绍：</span><?php echo CHtml::encode(Helper::truncate_utf8(!empty($val['discription'])?$val['discription']:'暂无数据',30));?><a href="<?php echo $val['link'];?>" target="_blank">浏览全部</a></p>
                        <p><span>总投资(万元)：</span><?php echo CHtml::encode(!empty($val['maney'])?$val['maney']:'暂无数据');?></p>
                        <p> <span>项目责任主体：</span><?php echo CHtml::encode(Helper::truncate_utf8(!empty($val['contacts'])?$val['contacts']:'暂无数据',10,false));?></p>
                        <p> <span>建设地点：</span><?php echo CHtml::encode(Helper::truncate_utf8(!empty($val['address'])?$val['address']:'暂无数据',10,false));?></p>
                    </div>
                <?php endforeach;?> 
			</div>
		</div> 	
</div>
        
            <div class="centerside" id="box1_b1">
                <?php foreach(Investment::getGover('21','0','6') as $key):?>
                <ul class='centerside_list'>
                    <li>
                        <a id="img_url" href="<?php echo $this->createUrl('/investment/default',array('id'=>$key['id']));?>" img_title="<?php echo $key['name']?>" img_url="<?php echo Storage::getImageBySize($key['thumb'],'investment','4_3','thumb');?>"></a>
                    </li>
                    <p class='text-indent'>
                        <?php echo CHtml::link(CHtml::encode($key['name']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['name'],'target'=>'_blank'));?>
                    </p>
                </ul>
                <?php endforeach;?>
            </div>   
         
         
             <div class="centerside" id="box1_b2" style="display:none">
                 <?php foreach(Investment::getGover('22','0','6') as $key):?>
                <ul class='centerside_list'>
                    <li>
                        <a id="img_url" href="<?php echo $this->createUrl('/investment/default',array('id'=>$key['id']));?>" img_title="<?php echo $key['name']?>" img_url="<?php echo Storage::getImageBySize($key['thumb'],'investment','4_3','thumb');?>"></a>
                    </li>
                    <p class='text-indent'>
                       <?php echo CHtml::link(CHtml::encode($key['name']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['name'],'target'=>'_blank'));?>
                    </p>
                </ul>
                 <?php endforeach;?>
            </div>
         
            <div class="centerside" id="box1_b3" style="display:none">
                 <?php foreach(Investment::getGover('23','0','6') as $key):?>
                <ul class='centerside_list'>
                    <li>
                         <a id="img_url" href="<?php echo $this->createUrl('/investment/default',array('id'=>$key['id']));?>" img_title="<?php echo $key['name']?>" img_url="<?php echo Storage::getImageBySize($key['thumb'],'investment','4_3','thumb');?>"></a>
                    </li>
                    <p class='text-indent'>
                        <?php echo CHtml::link(CHtml::encode($key['name']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['name'],'target'=>'_blank'));?>
                    </p>
                </ul>
                 <?php endforeach;?>
            </div>
         
            <div class="centerside" id="box1_b4" style="display:none">
                 <?php foreach(Investment::getGover('24','0','6') as $key):?>
                <ul class='centerside_list'>
                    <li>
                         <a id="img_url" href="<?php echo $this->createUrl('/investment/default',array('id'=>$key['id']));?>" img_title="<?php echo $key['name']?>" img_url="<?php echo Storage::getImageBySize($key['thumb'],'investment','4_3','thumb');?>"></a>
                    </li>
                    <p class='text-indent'>
                        <?php echo CHtml::link(CHtml::encode($key['name']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['name'],'target'=>'_blank'));?>
                    </p>
                </ul>
                 <?php endforeach;?>
            </div>
         
            <div class="centerside" id="box1_b5" style="display:none">
                 <?php foreach(Investment::getGover('25','0','6') as $key):?>
                <ul class='centerside_list'>
                    <li>
                         <a id="img_url" href="<?php echo $this->createUrl('/investment/default',array('id'=>$key['id']));?>" img_title="<?php echo $key['name']?>" img_url="<?php echo Storage::getImageBySize($key['thumb'],'investment','4_3','thumb');?>"></a>
                    </li>
                    <p class='text-indent'>
                        <?php echo CHtml::link(CHtml::encode($key['name']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['name'],'target'=>'_blank'));?>
                    </p>
                </ul>
                 <?php endforeach;?>
            </div>
         
            <div class="centerside" id="box1_b6" style="display:none">
                 <?php foreach(Investment::getGover('26','0','6') as $key):?>
                <ul class='centerside_list'>
                    <li>
                         <a id="img_url" href="<?php echo $this->createUrl('/investment/default',array('id'=>$key['id']));?>" img_title="<?php echo $key['name']?>" img_url="<?php echo Storage::getImageBySize($key['thumb'],'investment','4_3','thumb');?>"></a>
                    </li>
                    <p class='text-indent'>
                        <?php echo CHtml::link(CHtml::encode($key['name']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['name'],'target'=>'_blank'));?>
                    </p>
                </ul>
                 <?php endforeach;?>
            </div>
       
         
         
         
    </div> 
        
     <div class='rightdiv'>
     	<div class='subtitle' style="margin-top:20px;"><em class="title_bg eight"></em><?php echo CHtml::link('更多',$this->createUrl('/trade/list/category',array('id'=>'64')),array('target'=>'_blank'));?></div>
        
        <div class='Right_sidebar_1'>
             <?php foreach(Trade::getBusiness('65','1','0','12') as $key=>$val):?>
                     <?php if($key < 2):?>
            <ul class='sidebar_list_1'>
                <li>  
                     <a id="img_url" href="<?php echo $this->createUrl('/trade/list/view',array('id'=>$val['id']));?>" img_title="<?php echo $val['title']?>" img_url="<?php echo $val['min_thumb'];?>" class="imgArea"></a>
                </li>
                <p class="text-indent"><?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($val['title'],15,false)),$this->createUrl('/trade/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?></p>
            </ul>
             <?php else:?>
        </div>
        
        <div class='Leftside_text'> 
        	<ul class='normal'>
               <li><?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($val['title'],30,false)),$this->createUrl('/trade/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?></li> 
                <?php endif;?>
                <?php endforeach;?>
            </ul>
        </div> 
        
        
     </div>
    </div>
  <div class='bigdiv'>
        	<div class='lefttitle'></div>
            <ul class='picshow'>
                <?php foreach(Trade::getBusiness('64','1','0','8') as $key):?>
            	<li>
                    <a id="img_url" href="<?php echo $this->createUrl('/trade/list/view',array('id'=>$key['id']));?>" img_title="<?php echo $key['title']?>" img_url="<?php echo $key['min_thumb'];?>"></a>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
  <div class='bigdiv'>
    	<div class='leftdiv'>
        	<div class='bigTitle'>
            	<div class='list'>
                    <a href="javascript:;" id="bestId28" class="imgArea float" onclick="change_tab_con(this.id,'bestShow');">名贵珠宝</a>/
                    <?php foreach(Category::getGory('27','0','1','7') as $key):?> 
                        <a href="javascript:;"  class="imgArea float" id="bestId<?php echo $key['id'];?>" onclick="change_tab_con(this.id,'bestShow');"><?php echo $key['name'];?></a>/
                    <?php endforeach;?>
                </div>
                <a href="/life.html" target="_blank"><em class='title_2'></em></a>
            </div>
            
            
           <div class='Leftside_pic'>
                
               <?php foreach($beauty as $key=>$val):?>
                     <?php if($key < 1):?>
            	<div class="piclist_position">   
                    <a id="img_url" href="<?php echo $val['link'];?>" img_title="<?php echo $val['title']?>" img_url="<?php echo Storage::getImageBySize($val['track_id'],'news','9_16','thumb');?>" class="imgArea sytle adv_pic" target="_blank"></a>
                    <div class="lazy_content"> 
                    <div class='pic_text'>
                    	<ul class='mainTitle'>
                        	<li><?php echo CHtml::encode(Helper::truncate_utf8($val['title'],5,false));?></li> 
                            <li class='gf_text'><?php echo CHtml::encode(Helper::truncate_utf8($val['title'],10,false));?></li>
                        </ul>
                    </div>
                    </div>
                </div> 
                 <?php else:?>
                <div class='piclist_position_2'>
                     <a id="img_url" href="<?php echo $val['link'];?>" img_title="<?php echo $val['title']?>" img_url="<?php echo Storage::getImageBySize($val['track_id'],'news','4_3','thumb');?>" class="imgArea sytle adv_pic" target="_blank"></a>
                     <div class="lazy_content"> 
                    <div class='pic_text'>
                    	<ul class='mainTitle mainTitle_1'>
                        	<li><?php echo CHtml::encode(Helper::truncate_utf8($val['title'],5,false));?></li>
                            <li class='gf_text'><?php echo CHtml::encode(Helper::truncate_utf8($val['title'],10,false));?></li>
                        </ul>
                    </div>
                     </div>
                </div>
               <?php endif;?>
                <?php endforeach;?>

                <div class='Leftside_text'>
                   <ul class='textlist'>
                       <?php foreach(News::getNew('40','4','8') as $key):?>
                       <li>  
                           <a href="<?php echo $key['link'];?>" target="_blank"><?php echo $key['title'];?></a>
                       </li>   
                       <?php endforeach;?>
                   </ul>
               </div>
          </div>
            
         <div class='centerside_pic' id="bestShow">
          	<ul class='centerside_pic_list' >
                <?php foreach(News::getNew('28','0','4') as $key): ?>
            	<li class="piclist_1">
                    <a id="img_url" href="<?php echo $key['link'];?>" img_title="<?php echo $key['title'];?>" img_url="<?php echo Storage::getImageBySize($key['track_id'],'news','4_3','thumb');?>" class='imgArea sytle adv_pic' target='_blank'></a>  
                    <div class="lazy_content"> 
                        <div class='pic_text pic_text_1'>
                                <ul class='mainTitle mainTitle_3'>
                                    <li><?php echo CHtml::encode(Helper::truncate_utf8($key['title'],5,false));?></li>
                                    <li class='gf_text'><?php echo CHtml::encode(Helper::truncate_utf8($key['title'],10,false));?></li>
                                   
                                </ul>
                        </div>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>
            <div class="centerbtn" ><span class='center' >名贵珠宝 </span></div>
         </div>
         
            <?php foreach(Category::getGory('27','0','1','7') as $key):?>
            <?php static $i=0;?> 
         <div class='centerside_pic' id="con_bestId<?php echo $key['id'];?>" style="display:none; float:right;">  
          	<ul class='centerside_pic_list'> 
                <?php foreach(News::getByCategory($key['id'],4) as $v):?>
            	<li class="piclist_1">
                    <a id="img_url" href="<?php echo $v['link'];?>" img_title="<?php echo $v['title'];?>" img_url="<?php echo Storage::getImageBySize($v['track_id'],'news','4_3','thumb');?>" class="imgArea sytle adv_pic" target="_blank"></a>
                    <div class="lazy_content"> 
                        <div class='pic_text pic_text_1'>
                            <ul class='mainTitle mainTitle_3'>
                                <li><?php echo CHtml::encode(Helper::truncate_utf8($v['title'],5,false));?></li>
                                <li class='gf_text'><?php echo CHtml::encode(Helper::truncate_utf8($v['title'],10,false));?></li>
                            </ul>
                        </div>
                    </div>
               </li>
            	<?php endforeach;?>
            </ul>
            <div class='centerbtn' ><span class='center' ><?php echo CHtml::encode($key['name']);?> </span></div>
         </div>
           <?php ++$i;?>
            <?php endforeach;?> 
            
         <span style="clear:both;"></span>     
            
    </div>
   		<div class='rightdiv rightdiv_bg'>
        	<div class='submit'><?php echo CHtml::link('更多',$this->createUrl('/life/list/category',array('id'=>'48')),array('target'=>'_blank'));?><em class="title_bg nine"></em>
            <i class='TopRight double'></i>
            <i class='TopLeft double'></i>
            
            </div> 
            
            
            <div class='rightdivContent'>
                   
                    <div class='rightpic_list'>
                     <a id="img_url" href="http://www.lfeel.com/life/list/view/1190.html" img_title="www" img_url="../images/shouye/5.jpg"  target='_blank'></a>
                            <div class="lazy_content"> 
                                <div class='pic_text'>
                                    <ul class='mainTitle mainTitle_5'>
                                          <li>吴尊携手美度</li>
                                         <li class='gf_text' >吴尊携手美度 筑腕间长城</li> 
                                    </ul>
                                </div>
                            </div>
                  </div>
                
                
                 <div class='rightpic_list'>
                     <a id="img_url" href="http://www.lfeel.com/life/list/view/1105.html" img_title="www" img_url="../images/shouye/6.jpg"  target='_blank'></a>
                            <div class="lazy_content"> 
                                <div class='pic_text'>
                                    <ul class='mainTitle mainTitle_5'>
                                         <li>2014世界杯</li>
                                        <li class='gf_text' >2014世界杯 巴西旅游全攻略</li>
                                    </ul>
                                </div>
                            </div>
                 </div>
                
                <div class='rightpic_list'>
                     <a id="img_url" href="http://www.lfeel.com/life/list/view/1176.html" img_title="www" img_url="../images/shouye/7.jpg"  target='_blank'></a>
                            <div class="lazy_content"> 
                                <div class='pic_text'>
                                    <ul class='mainTitle mainTitle_5'>
                                         <li>汉诺威马：世界上最好的温血马</li>
                                        <li class='gf_text' >汉诺威马：世界上最好的温血马</li>
                                    </ul>
                                </div>
                            </div>
                </div>
                
                <div class='rightpic_list'>
                     <a id="img_url" href="http://www.lfeel.com/life/list/view/1199.html" img_title="www" img_url="../images/shouye/8.jpg"  target='_blank'></a>
                            <div class="lazy_content"> 
                                <div class='pic_text'>
                                    <ul class='mainTitle mainTitle_5'>    
                                         <li>自驾纵贯澳大利亚</li>
                                        <li class='gf_text' >自驾纵贯澳大利亚 荒野巡礼不同寻常</li>
                                    </ul>
                                </div>
                            </div>
                </div>
                  
                   
            </div>
        </div> 
      <script>
          function change_tab_con(clickId,typeShowId){
                var idHTML=$('#con_'+clickId).html();
                $('#'+typeShowId).html(idHTML);
                $('#'+typeShowId).hide();
                $('#'+typeShowId).slideDown("slow");
           }
      </script>
   
  </div> <div class='wrap_banner'>
        <div class='wrapLeft'>
            <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::ARTICLE,'res_id'=>116,'type'=>1,'width'=>907,'height'=>85));?>
        </div>
        <div class='wrapRight'>
            <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::ARTICLE,'res_id'=>117,'type'=>1,'width'=>306,'height'=>85));?>
        </div>
  </div>
  <div class='bigdiv'>
  	<div class='leftdiv'>
    <div class="bigTitle">
    <div class="list">
            <a href="http://shop.lfeel.com/index.php?act=search&cate_id=185" class="imgArea float" id="box4_a1" onmousemove="box4(1)" target="_blank">潮流服饰</a>/
            <a href="http://shop.lfeel.com/index.php?act=search&cate_id=92" class="imgArea float" id="box4_a2" onmousemove="box4(2)" target="_blank">鞋子箱包</a>/
            <a href="http://shop.lfeel.com/index.php?act=search&cate_id=1" class="imgArea float" id="box4_a3" onmousemove="box4(3)" target="_blank">珠宝饰品</a>/    
            <a href="http://shop.lfeel.com/index.php?act=search&cate_id=90" class="imgArea float" id="box4_a4" onmousemove="box4(4)" target="_blank">休闲食品</a>
    </div>
    <a href="http://shop.lfeel.com/" target="_blank"><em class='title_3'>    
        </em></a>
    </div>      
    <div class='Leftside_pic'>
    	<div class='toppic'>
            <a id="img_url" href="http://shop.lfeel.com/index.php?act=goods&goods_id=88" img_title="www" target="_blank" img_url="../images/image/ind_17.jpg"></a>
        </div>
        <div class='bottompic'><a id="img_url" href="http://shop.lfeel.com/index.php?act=show_store&op=goods_all&id=6" img_title="www" target="_blank" img_url="../images/image/ind_13.jpg"></a><a href="http://shop.lfeel.com/index.php?act=show_store&op=goods_all&id=16" target="_blank"><img src="../images/image/pin.jpg" /></a></div>
        
    </div>
     <!-- 潮流服饰-->   

    <div class='center' style="margin:10px 0 0 10px; position:relative;" id="box4_b1" >
        <?php foreach($fashion as $key):?>
        <div class='shoppic'>
                <ul class='piclist'>
                    <h2><a id="img_url" href="http://shop.lfeel.com/index.php?act=goods&goods_id=<?php echo $key['goods_id'];?>" img_title="<?php echo $key['goods_name']?>" target="_blank" img_url="<?php echo $key['goods_pic'];?>"></a></h2>
                    <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=<?php echo $key['goods_id'];?>" target="_blank"><?php echo CHtml::encode(Helper::truncate_utf8($key['goods_name'],20));?></a></i></li>
                    <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;"><?php echo CHtml::encode($key['goods_price']);?></b></li>
                    <li><span><?php echo CHtml::encode(str_replace('&nbsp;','',$key['goods_localtion']));?></span><b><?php echo CHtml::encode($key['goods_storename']);?></b></li>
                </ul>
        </div>
        <?php endforeach;?>
    </div>
    <!--鞋子箱包 -->
    <div class='center' style="margin:10px 0 0 10px; position:relative;width:570px; float:left;display:none;" id="box4_b2"> 
       
         <?php foreach($bag as $key):?>
        <div class='shoppic'>
                <ul class='piclist'>
                    <h2><a id="img_url" href="http://shop.lfeel.com/index.php?act=goods&goods_id=<?php echo $key['goods_id'];?>" img_title="<?php echo $key['goods_name']?>" target="_blank" img_url="<?php echo $key['goods_pic'];?>"></a></h2>
                    <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=<?php echo $key['goods_id'];?>" target="_blank"><?php echo CHtml::encode(Helper::truncate_utf8($key['goods_name'],10));?></a></i></li>
                    <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;"><?php echo CHtml::encode($key['goods_price']);?></b></li>
                    <li><span><?php echo CHtml::encode(str_replace('&nbsp;','',$key['goods_localtion']));?></span><b><?php echo CHtml::encode($key['goods_storename']);?></b></li>
                </ul>
        </div>
        <?php endforeach;?>
        
       
    </div>
        
    <!-- 珠宝饰品-->
        <div class='center' style="margin:10px 0 0 10px; position:relative;display:none;" id="box4_b3"> 
        <?php foreach($sories as $key):?>
        <div class='shoppic'>
                <ul class='piclist'>
                    <h2><a id="img_url" href="http://shop.lfeel.com/index.php?act=goods&goods_id=<?php echo $key['goods_id'];?>" img_title="<?php echo $key['goods_name']?>" target="_blank" img_url="<?php echo $key['goods_pic'];?>"></a></h2>
                    <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=<?php echo $key['goods_id'];?>" target="_blank"><?php echo CHtml::encode(Helper::truncate_utf8($key['goods_name'],20));?></a></i></li>
                    <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;"><?php echo CHtml::encode($key['goods_price']);?></b></li>
                    <li><span><?php echo CHtml::encode(str_replace('&nbsp;','',$key['goods_localtion']));?></span><b><?php echo CHtml::encode($key['goods_storename']);?></b></li>
                </ul>
        </div>
        <?php endforeach;?>
        
        
    </div>
    <!-- 休闲食品--> 
     <div class='center' style="margin:10px 0 0 10px; position:relative;display:none;" id="box4_b4"> 
        <?php foreach($food as $key):?>
        <div class='shoppic'>
                <ul class='piclist'>
                    <h2><a id="img_url" href="http://shop.lfeel.com/index.php?act=goods&goods_id=<?php echo $key['goods_id'];?>" img_title="<?php echo $key['goods_name']?>" target="_blank" img_url="<?php echo $key['goods_pic'];?>"></a></h2>
                    <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=<?php echo $key['goods_id'];?>" target="_blank"><?php echo CHtml::encode(Helper::truncate_utf8($key['goods_name'],20));?></a></i></li>
                    <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;"><?php echo CHtml::encode($key['goods_price']);?></b></li>
                    <li><span><?php echo CHtml::encode(str_replace('&nbsp;','',$key['goods_localtion']));?></span><b><?php echo CHtml::encode($key['goods_storename']);?></b></li>
                </ul>
        </div>
        <?php endforeach;?>        
    </div>
    
  	</div>
    <div class='rightdiv rightdiv_bg'>
    	<div class="submit"><a href="http://shop.lfeel.com/index.php?act=brand" target="_blank">更多</a><em class="title_bg ten"></em>
        	<i class='TopRight double'></i>
            <i class='TopLeft double'></i>
        </div>
        <div class='rightdivContent rightdivContent_1'>
            <div class='brand'>
                <ul class='brandList'>
                    <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=1" target="_blank" img_url="../images/image/f8d1b51299e768635f917040ddfda053.jpg"></a></li>
                    <p><a href="http://shop.lfeel.com/index.php?act=show_store&id=1" target="_blank">苹果/apple</a></p>
                </ul>
                <ul class='brandList'>
                    <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=6" target="_blank" img_url="../images/image/eb8bc08ce282afe2f2292bff0c3d5bb6.jpg"></a></li>
                    <p><a href="http://shop.lfeel.com/index.php?act=show_store&id=6" target="_blank">中粮集团</a></p>
                </ul>
                <ul class='brandList'>
                    <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=11" target="_blank" img_url="../images/image/34e4a5ea90a65fee11ebab838e562eff.jpg"></a></li>
                    <p><a href="http://shop.lfeel.com/index.php?act=show_store&id=11" target="_blank">《榜上茗》蒙顶山茶</a></p>
                </ul>
                <ul class='brandList'>
                    <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=15" target="_blank" img_url="../images/image/a52bc808310ca7909d88a3e71092f46f.jpg"></a></li>
                    <p><a href="http://shop.lfeel.com/index.php?act=show_store&id=15" target="_blank">云燕上品</a></p>
                </ul>
                <ul class='brandList'>
                    <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=16" target="_blank" img_url="../images/image/9de3ce56cc0892d1f0e79fa575efe052.jpg"></a></li>
                    <p><a href="http://shop.lfeel.com/index.php?act=show_store&id=16" target="_blank">酒村网</a></p>
                </ul>
                <ul class='brandList'>
                    <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=10" target="_blank" img_url="../images/image/ac4998064f45ade6f36bf85f09be04dd.jpg"></a></li>
                    <p><a href="http://shop.lfeel.com/index.php?act=show_store&id=10" target="_blank">梅兰春酒</a></p>
                </ul>
                <ul class='brandList'>
                    <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=9" target="_blank" img_url="../images/image/b12ac1c39f957726d65461cd1267e3fb.jpg"></a></li>
                    <p><a href="http://shop.lfeel.com/index.php?act=show_store&id=9" target="_blank">莫尔斯密码公司</a></p>
                </ul>
                <ul class='brandList'>
                    <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=17" target="_blank" img_url="../images/image/70e427c02da204c264eccb116f9a269b.jpg"></a></li>
                    <p><a href="http://shop.lfeel.com/index.php?act=show_store&id=17" target="_blank">iRUBY时尚饰品总公司</a></p>
                </ul>
                <ul class='brandList'>
                    <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=18" target="_blank" img_url="../images/image/a0cc34ad6a919f11.jpg"></a></li>
                    <p><a href="http://shop.lfeel.com/index.php?act=show_store&id=18" target="_blank">Gucci眼镜</a></p>
                </ul>
                <ul class='brandList'>
                    <li><a href="http://shop.lfeel.com/index.php?act=show_store&id=1" target="_blank" img_url="../images/image/ap_logo.jpg"></a></li>
                    <p><a href="http://shop.lfeel.com/index.php?act=show_store&id=1" target="_blank">苹果/apple</a></p>
                </ul> 
            </div>
         </div>
    </div>
  </div>
    <div class='wrap_banner'>
        <div class='wrapLeft'>
            <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::ARTICLE,'res_id'=>118,'type'=>1,'width'=>907,'height'=>85));?>
        </div>
        <div class='wrapRight'>
            <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::ARTICLE,'res_id'=>119,'type'=>1,'width'=>306,'height'=>85));?>
        </div>
  </div>
  <div class='bigdiv'>
  	<div class='leftdiv'>
    	<div class="bigTitle"><em class='title_4'></em></div>
        <div class="Leftside_pic">
    	<div class="toppic"><img src="../images/image/ind_38.jpg" alt=""><img src="../images/image/ind_40.jpg" alt=""><img src="../images/image/ind_43.jpg" alt=""></div> 
        <div class='toppic_text'>
        <strong>盲人陶艺展</strong>
        <p>  每个人都有自己的理想和追求，都有自己的梦想，只是梦想的大小和层次的不同。我的梦想就是在2013年下半年举办我的个人陶艺作品展，让观众从我的作品中，体会出我在黑暗里重新审视的这个世界，对自我的生存认识，我的呐喊，以及特有的触觉力量感，我的喜怒哀乐。<span><a href="http://quanzi.lfeel.com/member.php?mod=logging&action=login" target="_blank">浏览全文>></a></span></p>
        </div>
    </div>
    <div class='center' style="margin: 10px 0 0 10px;">
        	<div class='mainbox'>
            	<h1><img src="../images/image/ind_16.jpg" alt="" /></h1>
                <h3>盲人陶艺展</h3>
                <span>项目发起人</span>
                <dl class='inbox'>
                	<dt>
                        <img src="../images/image/ind_44.jpg" alt="" />
                    </dt>
                    <dd><b>Toxic</b></dd>
                    <dd>发起时间：2013/06/10</dd>
                    <dd>支持的项目：12</dd>
                    <dd>发起的项目：20</dd>
                </dl>
                <div class='inbox_text'>
                <p>关于我：</p><p>
   大家好，我是廖建明，今年45岁。1990年毕业于清华大学美术学院（原中央工艺美术学院）陶瓷美术设计系，毕业作品曾被美籍华裔科学家李政道先生收藏。毕业的两年后，因患视神经萎缩而双目失明，同时失业、失恋。</p>
   <p>1994年，我以按摩这一技之长走出家门，打工自食其力，几年后回到老家继续按摩生意至今。2001年，我走上了湖南卫视的《玫瑰之约》，我想要寻找我的幸福。2004年，我找到了自己生命的另一半至今，我们幸福快乐的生活。期间有亲人的离世，我痛苦；有很多人的不解，我迷茫；但是我依旧坚持微笑着面对生活。这是我的生活轨迹，而与普通盲人按摩师不同。我痴好陶瓷，还钟情散文、诗歌。我总是在想，用我的文字把生活变成文学，把生命烧成陶瓷。</p>
    </div>
     </div>
        </div>
  	</div>
    <div class="rightdiv">
     	<div class="subtitle" style=" margin-top:20px;"><em class="title_bg eleven"></em><?php echo CHtml::link('更多',$this->createUrl('/community/list/category',array('id'=>'74')),array('target'=>'_blank'));?></div>
        <div class="Right_sidebar_1">
            <?php foreach(Community::getCommunity('74','0','12') as $key=>$val):?>
                     <?php if($key < 2):?>
            <ul class="sidebar_list_1">
                <li>
                    <?php echo CHtml::link($val['title'],$this->createUrl('/community/list/view',array('id'=>$val['id'])),array('target'=>'_blank','img_url'=>Storage::getImageBySize($val['track_id'],'community','16_9','thumb')));?>
                </li>
                <p class='text-indent'>
                     <?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($val['title'],5,false)),$this->createUrl('/community/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?>
                </p>
            </ul>
            <?php else:?>
        </div>
        <div class='Leftside_text'>
        	<ul class='special'>
            	<li>
                    <?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($val['title'],20,false)),$this->createUrl('/community/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?>
                </li>
                 <?php endif;?>
                <?php endforeach;?>
            </ul>
        </div> 
     </div>
  </div>
  </div>

</div>
<!--尾部标签-->

<style>
   .topbanner{height:468px;}
   div.list{/*height: 47px;line-height: 70px;*/float: right; margin-top:25px;}
   span img{vertical-align: middle;}
   .img_url {
border: 1px solid #efefef;
float: left;
margin-right: 9px;
display: inline;
}
.scrollnews{height: 40px;
line-height: 40px;
color: #f0f0f0;
text-align: center;
float: left;
padding-left: 5px;}
</style>
