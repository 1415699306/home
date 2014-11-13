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
                <?php foreach($ariticle as $key=>$val):?>
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
                	<span class="scrollnews">焦点轮播：</span>
                    <div id="scrollnews">
                        <ul id="scrollnews">
                            <?php foreach($ariticle as $key): ?>
                            <li><?php echo CHtml::encode(Helper::truncate_utf8($key['title'],18));?></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
               </div>
            </div> 
        </div>
      
      <div class='center topbanner' id="temp1">
            <div class='banner' id="box3_b1">
                <a href="http://www.lfeel.com/life/list/view/2124.html" target="_blank" img_url="../images/shouye/1.jpg"></a>
            </div>
            <div class='banner' id="box3_b2" style="display:none">
                 <a href="http://www.lfeel.com/life/list/view/2114.html" target="_blank" img_url="../images/shouye/2.jpg"></a>
            </div>
            <div class='banner' id="box3_b3" style="display:none">
                 <a href="http://www.lfeel.com/life/list/view/2115.html" target="_blank" img_url="../images/shouye/3.jpg"></a>
            </div>
            <div class='banner' id="box3_b4" style="display:none">
                <a href="http://www.lfeel.com/life/list/view/2128.html" target="_blank" img_url="../images/shouye/4.jpg"></a>
            </div>
        
          <div class='bannerBottom'>
          	<ul class='bannerBottom_list'>
            	<li id="box3_a1"  onmousemove="box3(1)">
                    <div class='pic_list'>
                        <a href="http://www.lfeel.com/life/list/view/2124.html" target="_blank" img_url="../images/shouye/1-1.jpg"></a>
                    </div>   
                </li>
				<li  id="box3_a2"  onmousemove="box3(2)">
                    <div class='pic_list'>
                        <a href="http://www.lfeel.com/life/list/view/2114.html" target="_blank" img_url="../images/shouye/2-2.jpg"></a>
                    </div>
                </li>
            	<li id="box3_a3"  onmousemove="box3(3)">
                    <div class='pic_list'>
                        <a href="http://www.lfeel.com/life/list/view/2115.html" target="_blank" img_url="../images/shouye/3-3.jpg"></a>
                    </div>
                </li>
                <li id="box3_a4"  onmousemove="box3(4)">
                    <div class='pic_list'>
                        <a href="http://www.lfeel.com/life/list/view/2128.html" target="_blank" img_url="../images/shouye/4-4.jpg"></a>
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
                 <?php foreach($watch as $key=>$val):?>
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
              <li><b>唐俊京</b></li>
              <li>总裁</li>
              <li><p>广州卓越教育机构创办人</p></li>
            </ul> 
           <div id="scrollbox" class="bx_wrap">     
              <div class="bx_container">
                <ul class='MemberList' id="MemberList">
                    <li>
                        <a href="http://quanzi.lfeel.com/" target="_blank"><img src="../images/image/hy_2.jpg" alt="" /></a>
                    	<p>黄浩明</p>
                        <p>副理事长</p>
                    </li>
                    <li>
                        <a href="http://quanzi.lfeel.com/" target="_blank"><img src="../images/image/hy_3.jpg" alt="" /></a>
                        <p>陈业文</p>
                        <p>董事长</p>
                    </li>
                    <li>
                       <a href="http://quanzi.lfeel.com/" target="_blank"><img src="../images/image/hy_4.jpg" alt="" /></a>
                        <p>胡恃琿</p>
                        <p>董事长</p>
                    </li>
                    <li>
                        <a href="http://quanzi.lfeel.com/" target="_blank"><img src="../images/image/hy_5.jpg" alt="" /></a>
                        <p>金清杨</p>
                        <p>创始人</p>
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
                <h1>你觉2014年三套放假方案合理吗？ </h1>
            </div>
            <div class='Discuss'>
                <div class='DiscussLeft'>
                    <p>不合理，到时候又是调休又是一大堆的埋怨。春节过年，应该是阖家欢乐的时候，就放7天假，远地方的都有两三天在路上过了，哪有时间陪家人！不满！</p>
                    <span class='support'>支持数：1050</span>
                </div>
                <div class='DiscussRight'>
                    <p>合理，不管哪套都行，固定了就行。国家安排基本上没我们什么事，春节假期可以适当延长，不过国外圣诞节也是放假7天，加上年假春节基本上有半个月假，影响不大。</p>
                    <span class='against'>支持数：177</span>
                </div>
             </div>
            
            <div  class="bd" id="bd">
             <ul class="slideshow" id="demo">
                 <?php foreach($people as $key):?>
             	<li class="li_2">
                   <div class='floatLeft'>
                       <?php echo CHtml::link(CHtml::image(Storage::getImageBySize($key['track_id'],'celebrity','4_3','thumb'),$key['title'],array('width'=>100,'height'=>80)),$this->createUrl('/celebrity/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?>
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
                    <a id="img_url" href="http://quanzi.lfeel.com/member.php?mod=logging&action=login" img_url="../images/image/meeting_1.jpg"></a>
					<p class='last'>主题：<b>2013中国广州国际绿色建筑与节能展览会  </b></p>
                    <p class='last'>地点：广州保利世贸展览馆</p>
                   <!-- <p class='last'>时间：2013.7.7</p>-->
                  <p class='last'>距报名结束还有　<span class='bg' id="day"></span>　天　<span class='bg' id="hour"></span>　时　<span class='bg' id="minute"></span>　分</p>
                    
                    <div class='meetingButtom'>
                        <a href="http://quanzi.lfeel.com/member.php?mod=logging&action=login" class="buttom" target="_blank" >活动提醒</a>
                        <a href="http://quanzi.lfeel.com/member.php?mod=logging&action=login" class="buttom buttom2" target="_blank">我要报名</a>
                    </div>
                </div>
 <div class='meetingBottom'>
       	<ul class='meetingBottomLeft'>
                    	<li>逛社区</li>
                        <li>听杂谈</li>
                        <li>说说话</li>
                    </ul>
                    <ul class='meetingBottomRight'>
                    	<li><a href="/html/view/id/temp_15" target="_blank">内地医保基金结余超7000亿</a></li>
                        <li><a href="/html/view/id/temp_16" target="_blank">院士驳斥转基因食品风险说</a></li>
                        <li><a href="/html/view/id/temp_17" target="_blank">阿里造势“余额宝二代”</a></li>
                        <li><a href="/html/view/id/temp_18" target="_blank">比特币：被政策叫停的可能性不大</a></li>
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
					<?php foreach($interview as $key):?>
                        <div class="slideItem">   
                            <a id="img_url" href="<?php echo $key['link'];?>"  img_title="<?php echo $key['title']?>" img_url="<?php echo Storage::getImageBySize($key['track_id'],'news','9_16','thumb');?>" target="_blank"></a>
                        </div>
                    <?php endforeach;?>
			</div> 
		   
			<div class="nextButton"></div><div class="prevButton"></div>
			<div class="buttonNav">
				 <?php foreach($interview as $key):?>
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
               
                <?php foreach($course as $key):?>
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
                        <?php foreach($cour as $key=>$val):?>
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
                            <?php foreach($story as $key=>$val):?>
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
					<?php foreach($gover as $val):?>
                        <div class="slideItem">   
                            <a id="img_url" href="<?php echo $val['link'];?>"  img_title="<?php echo $val['title']?>" img_url="<?php echo Storage::getImageBySize($val['track_id'],'news','9_16','thumb');?>" target="_blank"></a>
                        </div>
                    <?php endforeach;?>
			</div> 
		   
			<div class="nextButton"></div><div class="prevButton"></div>
			<div class="buttonNav">
				 <?php foreach($gover as $val):?>
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
                <?php foreach($industrial as $key):?>
                <ul class='centerside_list'>
                    <li>
                        <a id="img_url" href="<?php echo $this->createUrl('/investment/default',array('id'=>$key['id']));?>" img_title="<?php echo $key['title']?>" img_url="<?php echo Storage::getImageBySize($key['thumb'],'investment','4_3','thumb');?>"></a>
                    </li>
                    <p class='text-indent'>
                        <?php echo CHtml::link(CHtml::encode($key['title']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['title'],'target'=>'_blank'));?>
                    </p>
                </ul>
                <?php endforeach;?>
            </div>   
         
         
             <div class="centerside" id="box1_b2" style="display:none">
                 <?php foreach($agricultural as $key):?>
                <ul class='centerside_list'>
                    <li>
                        <a id="img_url" href="<?php echo $this->createUrl('/investment/default',array('id'=>$key['id']));?>" img_title="<?php echo $key['title']?>" img_url="<?php echo Storage::getImageBySize($key['thumb'],'investment','4_3','thumb');?>"></a>
                    </li>
                    <p class='text-indent'>
                       <?php echo CHtml::link(CHtml::encode($key['title']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['title'],'target'=>'_blank'));?>
                    </p>
                </ul>
                 <?php endforeach;?>
            </div>
         
            <div class="centerside" id="box1_b3" style="display:none">
                 <?php foreach($tourism as $key):?>
                <ul class='centerside_list'>
                    <li>
                         <a id="img_url" href="<?php echo $this->createUrl('/investment/default',array('id'=>$key['id']));?>" img_title="<?php echo $key['title']?>" img_url="<?php echo Storage::getImageBySize($key['thumb'],'investment','4_3','thumb');?>"></a>
                    </li>
                    <p class='text-indent'>
                        <?php echo CHtml::link(CHtml::encode($key['title']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['title'],'target'=>'_blank'));?>
                    </p>
                </ul>
                 <?php endforeach;?>
            </div>
         
            <div class="centerside" id="box1_b4" style="display:none">
                 <?php foreach($estate as $key):?>
                <ul class='centerside_list'>
                    <li>
                         <a id="img_url" href="<?php echo $this->createUrl('/investment/default',array('id'=>$key['id']));?>" img_title="<?php echo $key['title']?>" img_url="<?php echo Storage::getImageBySize($key['thumb'],'investment','4_3','thumb');?>"></a>
                    </li>
                    <p class='text-indent'>
                        <?php echo CHtml::link(CHtml::encode($key['title']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['title'],'target'=>'_blank'));?>
                    </p>
                </ul>
                 <?php endforeach;?>
            </div>
         
            <div class="centerside" id="box1_b5" style="display:none">
                 <?php foreach($park as $key):?>
                <ul class='centerside_list'>
                    <li>
                         <a id="img_url" href="<?php echo $this->createUrl('/investment/default',array('id'=>$key['id']));?>" img_title="<?php echo $key['title']?>" img_url="<?php echo Storage::getImageBySize($key['thumb'],'investment','4_3','thumb');?>"></a>
                    </li>
                    <p class='text-indent'>
                        <?php echo CHtml::link(CHtml::encode($key['title']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['title'],'target'=>'_blank'));?>
                    </p>
                </ul>
                 <?php endforeach;?>
            </div>
         
            <div class="centerside" id="box1_b6" style="display:none">
                 <?php foreach($other as $key):?>
                <ul class='centerside_list'>
                    <li>
                         <a id="img_url" href="<?php echo $this->createUrl('/investment/default',array('id'=>$key['id']));?>" img_title="<?php echo $key['title']?>" img_url="<?php echo Storage::getImageBySize($key['thumb'],'investment','4_3','thumb');?>"></a>
                    </li>
                    <p class='text-indent'>
                        <?php echo CHtml::link(CHtml::encode($key['title']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['title'],'target'=>'_blank'));?>
                    </p>
                </ul>
                 <?php endforeach;?>
            </div>
       
         
         
         
    </div> 
        
     <div class='rightdiv'>
     	<div class='subtitle' style="margin-top:20px;"><em class="title_bg eight"></em><?php echo CHtml::link('更多',$this->createUrl('/trade/list/category',array('id'=>'64')),array('target'=>'_blank'));?></div>
        
        <div class='Right_sidebar_1'>
             <?php foreach($newswire as $key=>$val):?>
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
                <?php foreach($business as $key):?>
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
                    <?php foreach($category as $key):?> 
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
                       <?php foreach($news as $key):?>
                       <li>  
                           <a href="<?php echo $key['link'];?>" target="_blank"><?php echo $key['title'];?></a>
                       </li>   
                       <?php endforeach;?>
                   </ul>
               </div>
          </div>
            
         <div class='centerside_pic' id="bestShow">
          	<ul class='centerside_pic_list' >
                <?php foreach($jewelry as $key): ?>
            	<li class="piclist_1">
                   <a href="<?php echo $key['link'];?>" class="imgArea sytle adv_pic" target="_blank">
                        <img src="<?php echo Storage::getImageBySize($key['track_id'],'news','4_3','thumb');?>" class="image">
                    </a>  
                    <div class="lazy_content"> 
                        <div class='pic_text pic_text_1'>
                                <ul class='mainTitle mainTitle_3'>
                                    <li><?php echo CHtml::encode(Helper::truncate_utf8($key['title'],5,false));?></li>
                                    <li class='gf_text'><?php echo CHtml::encode($key['title']);?></li>
                                   
                                </ul>
                        </div>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>
            <div class="centerbtn" ><span class='center' >名贵珠宝 </span></div>
         </div>
         
            <?php foreach($category as $key):?>
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
                                <li class='gf_text'><?php echo CHtml::encode($v['title']);?></li>
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
        	<div class='submit'><a>更多</a><em class="title_bg nine"></em>
            <i class='TopRight double'></i>
            <i class='TopLeft double'></i>
            
            </div> 
            
            
            <div class='rightdivContent'>
                <div style="overflow:hidden; width: 261px; padding:0 25px; text-align:center;">
                  <ul class='rightpic_list'>
                      <li>
                          <a href="/celebrity/default/entre" target="_blank" img_url="../images/shouye/logo_1.jpg"></a>
                          <p style="color:#444;"><a href="/celebrity/default/entre" target="_blank">南方企业家</a></p>
                      </li>
                  </ul>
                <ul class='rightpic_list lr'>
                      <li>
                          <a img_url="../images/shouye/logo_2.jpg"></a>
                          <p style="color:#444;">睿一策划</p>
                      </li>
                </ul>
                <ul class='rightpic_list'>
                      <li>
                          <a href="http://quanzi.lfeel.com/forum.php?mod=group&fid=84"target="_blank"img_url="../images/shouye/logo_3.jpg"></a>
                          <p><a href="http://quanzi.lfeel.com/forum.php?mod=group&fid=84"target="_blank"title="广东省江苏商会">广东省江苏商会</a></p>
                      </li>
                </ul>
                <ul class='rightpic_list lr'>
                      <li>
                          <a href="http://quanzi.lfeel.com/forum.php?mod=group&fid=170"target="_blank"img_url="../images/shouye/logo_4.jpg"></a>
                          <p><a href="http://quanzi.lfeel.com/forum.php?mod=group&fid=170"target="_blank" title="广东省河北商会">广东省河北商会</a></p>
                      </li>
                </ul>
                <ul class='rightpic_list'>
                      <li>
                          <a href="http://quanzi.lfeel.com/forum.php?mod=group&fid=88"target="_blank"img_url="../images/shouye/logo_5.jpg"></a>
                          <p><a href="http://quanzi.lfeel.com/forum.php?mod=group&fid=88"target="_blank"title="新疆维吾尔自治区安徽企业联合会">新疆维吾尔自治区安徽企业联合会</a></p>
                      </li>
                </ul>
                <ul class='rightpic_list lr'>
                      <li>
                          <a href="http://quanzi.lfeel.com/forum.php?mod=group&fid=85"target="_blank"img_url="../images/shouye/logo_6.jpg"></a>
                          <p><a href="http://quanzi.lfeel.com/forum.php?mod=group&fid=85"target="_blank"title="广东金银珠宝玉器商会">广东金银珠宝玉器商会</a></p>
                      </li>
                </ul>
                <ul class='rightpic_list '>
                      <li>
                          <a href="http://quanzi.lfeel.com/forum.php?mod=group&fid=87"target="_blank"img_url="../images/shouye/logo_7.jpg"></a>
                          <p><a href="http://quanzi.lfeel.com/forum.php?mod=group&fid=87"target="_blank"title="江西省广东商会">江西省广东商会</a></p>
                      </li>
                  </ul>
                  <ul class='rightpic_list lr'>
                      <li>
                          <a href="http://quanzi.lfeel.com/forum.php?mod=group&fid=81" target="_blank" img_url="../images/shouye/logo_8.jpg"></a>
                          <p><a href="http://quanzi.lfeel.com/forum.php?mod=group&fid=81" target="_blank"title="安徽省江苏商会" >安徽省江苏商会</a></p>
                      </li>
                  </ul>
                </div>
            </div>
        </div> 
      <script>
          $(function(){
                first = $("#bestShow").html();
          }); 
          function change_tab_con(clickId,typeShowId){ 
                var id = '#con_'+clickId;
                if(id === '#con_bestId28'){
                    $("#bestShow").html(first);
                }
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
            <a id="img_url" href="http://shop.lfeel.com/index.php?act=show_store&id=17" img_title="www" target="_blank" img_url="../images/image/ind_17.jpg"></a>
        </div>
        <div class='bottompic'><a id="img_url" href="http://shop.lfeel.com/" img_title="www" target="_blank" img_url="../images/image/ind_13.jpg"></a><a href="http://shop.lfeel.com/" target="_blank"><img src="../images/image/pin.jpg" /></a></div>
        
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
           <?php if($this->beginCache('brand',array('duration'=>3600))) { ?>
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
            <?php $this->endCache(); } ?>
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
        <strong>一个人的史诗纪录电影—《西藏生命歌》</strong>
        <p>一部浪漫的纪录电影一部严肃的艺术电影。二十岁小伙坚持两年，倾己之力打造。<span><a href="http://quanzi.lfeel.com/member.php?mod=logging&action=login" target="_blank">浏览全文>></a></span></p>
        </div>
    </div>
    <div class='center' style="margin: 10px 0 0 10px;">
        	<div class='mainbox'>
            	<h1><img src="../images/image/ind_16.jpg" alt="" /></h1>
                <h3>一个人的史诗纪录电影—《西藏生命歌》</h3>
                <span>项目发起人</span>
                <dl class='inbox'>
                	<dt>
                        <img src="../images/image/ind_44.jpg" alt="" />
                    </dt>
                    <dd>胡田净沙</dd>
                    <dd>发起时间：2013/11/19</dd>
                    <dd>支持的项目：4</dd>
                    <dd>发起的项目：1</dd>
                </dl>
                <div class='inbox_text'>
                <p>《西藏生命歌》这是一部很“美”的电影。美在风土，美在安静的思考。</p>
<p>它以故事为载体，讲述并探讨了一个叫做扎西顿珠的西藏人的死亡。</p>
<p>我从一位藏族老人那里听来一个故事。一个在幻觉里看到万佛朝拜的藏北牧人，不自觉地走出了雪山，踏上数年的西藏旅程，而最终消失在这片高原上，再也没有回家。他的行踪与思考，至今成为了一个迷，也变成一首永恒的生命歌。</p>
<p>扎西是浪漫的，是能为一汪小湖发呆的牧人，不懂犹豫，不会算计。他在我心中，就象征着西藏史诗式的生命状态。</p>
<p>2012年初，影片的剧本，导演，摄影，与音乐概念已基本成熟。</p>
<p>从2012年6月开拍至2013年9月，我已同助手进藏近十次，拍摄了3TB左右的原始风景与民族素材，完成了多半的拍摄任务。</p>
    </div>
     </div>
        </div>
  	</div>
    <div class="rightdiv">
     	<div class="subtitle" style=" margin-top:20px;"><em class="title_bg eleven"></em><?php echo CHtml::link('更多',$this->createUrl('/community/list/category',array('id'=>'74')),array('target'=>'_blank'));?></div>
        <div class="Right_sidebar_1">
           
            <?php foreach($comunity as $key=>$val):?>
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
div.list{float: right; margin-top:25px;}
span img{vertical-align: middle;}
 .img_url {border: 1px solid #efefef;float: left;margin-right: 9px;display: inline;}
.scrollnews{height: 40px;line-height: 40px;color: #f0f0f0;text-align: center;float: left;padding-left: 5px;}
.image{width:286px;height:249px;}
</style>
