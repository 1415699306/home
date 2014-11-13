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
                    <h1><?php echo CHtml::link(CHtml::encode($val['title']),$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?></h1>
                    <?php echo CHtml::link($val['title'],$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('target'=>'_blank','class'=>'imgArea','img_url'=>Storage::getImageBySize($val['track_id'],'article','4_3','thumb')));?>
                    <p class='Top_text'><?php echo CHtml::encode(Helper::truncate_utf8(!empty($val['discription'])?$val['discription']:'暂无数据',20));?></p>
                </div>
				
                <div class='mainTop_text'>
                        <?php else:?>
                      <ul class='mainTop_list'>
                       <?php echo CHtml::link($val['title'],$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('target'=>'_blank','img_url'=>Storage::getImageBySize($val['track_id'],'article','4_3','thumb')));?>
                        <li><b><?php echo CHtml::link(CHtml::encode($val['title']),$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?></b></li>                 
                            <?php foreach(Article::getArticle(2,$key) as $v):?>
                                <li><?php echo CHtml::link(Helper::truncate_utf8(Chtml::encode($v['title']),10),$this->createUrl('/celebrity/list/view',array('id'=>$v['id'])),array('target'=>'_blank'));?></li>                 
                            <?php endforeach;?> 
                    </ul>
                    <?php endif;?>
                  <?php endforeach;?> 
                </div>
                
                <div class='Top_news'>
                	<span>新闻轮播：</span>
                    <ul id="scrollnews">
                    	<?php foreach($ariticle as $key): ?>
                    	<li><?php echo CHtml::encode(Helper::truncate_utf8($key['title'],20));?></li>
                        <?php endforeach;?>
                    </ul>
               </div>
            </div> 
        </div>
      
        
      <div class='center topbanner' id="temp1">
            <div class='banner' id="box3_b1">
                <a href="http://www.lfeel.com/investment/default/107.html" target="_blank" img_url="../images/shouye/1.jpg"></a>
            </div>
            <div class='banner' id="box3_b2" style="display:none">
                 <a href="http://www.lfeel.com/life/list/view/747.html" target="_blank" img_url="../images/shouye/2.jpg"></a>
            </div>
            <div class='banner' id="box3_b3" style="display:none">
                 <a href="http://www.lfeel.com/trade/list/view/27.html" target="_blank" img_url="../images/shouye/3.jpg"></a>
            </div>
            <div class='banner' id="box3_b4" style="display:none">
                <a href="http://www.lfeel.com/celebrity/list/view/332.html" target="_blank" img_url="../images/shouye/4.jpg"></a>
            </div>
        
          <div class='bannerBottom'>
          	<ul class='bannerBottom_list'>
            	<li id="box3_a1"  onmousemove="box3(1)">
                    <div class='pic_list'>
                        <a href="http://www.lfeel.com/investment/default/107.html" target="_blank" img_url="../images/shouye/1-1.jpg"></a>
                    </div>   
                </li>
				<li  id="box3_a2"  onmousemove="box3(2)">
                    <div class='pic_list'>
                        <a href="http://www.lfeel.com/life/list/view/747.html" target="_blank" img_url="../images/shouye/2-2.jpg"></a>
                    </div>
                </li>
            	<li id="box3_a3"  onmousemove="box3(3)">
                    <div class='pic_list'>
                        <a href="http://www.lfeel.com/trade/list/view/27.html" target="_blank" img_url="../images/shouye/3-3.jpg"></a>
                    </div>
                </li>
                <li id="box3_a4"  onmousemove="box3(4)">
                    <div class='pic_list'>
                        <a href="http://www.lfeel.com/celebrity/list/view/332.html" target="_blank" img_url="../images/shouye/4-4.jpg"></a>
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
                        <h1><?php echo CHtml::link(CHtml::encode($val['title']),$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?></h1>
                        <?php echo CHtml::link($val['title'],$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('target'=>'_blank','class'=>'imgArea','img_url'=>Storage::getImageBySize($val['track_id'],'article','4_3','thumb')));?>
                        <?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($val['discription'],30,false)),$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('discription'=>$val['discription'],'target'=>'_blank'));?>
               		</div>	
                </li>
                <?php else:?>
                <li>
					<div class="bd">
						<h1>
							<?php echo CHtml::link(CHtml::encode($val['title']),$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?>
						</h1>
						<div class="news_info">
							<?php echo CHtml::link($val['title'],$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('target'=>'_blank','class'=>'imgArea','img_url'=>Storage::getImageBySize($val['track_id'],'article','4_3','thumb')));?>
							<?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($val['discription'],30,false)),$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('discription'=>$val['discription'],'target'=>'_blank'));?>
						</div>
					</div>
				</li>
                <?php endif;?>
               <?php endforeach;?> 
            </ul>
        </div>
       </div>
    </div>
         
        <div class="advertising">
            <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::ARTICLE,'res_id'=>120,'type'=>1,'width'=>309,'height'=>111));?>
        </div>
        
  </div>
	<div class='bigdiv'>
    	<div class='leftfloat'>
        	<div class='subtitle'></div>
            <ul class='MemberTab'>
           	  <h2>
                	<a href="#" class='imgArea' img_url="../images/image/hy_1.jpg"></a><br>
              </h2>
              <li><b>康宜华</b></li>
              <li>华瑞国际集团董事长</li>
              <li><p>20年中，华瑞从单纯的进出口业务公司，丰富成了以贸易为先导，以工厂为基础的外贸加工企业。</p></li>
            </ul> 
           <div id="scrollbox" class="bx_wrap">     
              <div class="bx_container">
                <ul class='MemberList' id="MemberList">
                    <li>
                        <img src="../images/image/hy_5.jpg" alt="" />
                    	<p>边书平</p>
                        <p>董事长</p>
                    </li>
                    <li>
                        <img src="../images/image/hy_4.jpg" alt="" />
                        <p>冯仑</p>
                        <p>董事长</p>
                    </li>
                    <li>
                       <img src="../images/image/hy_3.jpg" alt="" />
                        <p>李开复</p>
                        <p>首席执行官</p>
                    </li>
                    <li>
                        <img src="../images/image/hy_2.jpg" alt="" />
                        <p>董文标</p>
                        <p>银行董事长</p>
                    </li>
                </ul>  
            </div>
           </div>
                <div class='member_bar'>
                    <a href="#" img_url="../images/image/member_bar.jpg"></a>
          </div>
            <div class='member_btn'>
            	<a href="http://quanzi.lfeel.com/member.php?mod=register" target="_blank"></a>
            </div>  
      		</div>
          
    	<div class='center'>
        	<div class='DiscussTitle'>
                <h1>浙江高考作文题被指存在错误，你怎么看？</h1>
            </div>
            <div class='Discuss'>
                <div class='DiscussLeft'>
                    <p>完全不应该，高考应是严谨神圣的，太搞笑了，如果这不是题干而是考生的回答，那一分没有。为何待人苛刻待己宽容，自己都出错还考别人。</p>
                    <span class='support'>支持数：409 </span>
                </div>
                <div class='DiscussRight'>
                    <p>出错的是题目中的作者国籍，不影响考试，吐槽一下就可以了，其实有几个考生会去重视这个，出完考场就不记得题目了，他们重视的是成绩。</p>
                    <span class='against'>支持数： 250</span>
                </div>
             </div>
            
            <div  class="bd" id="bd">
             <ul class="slideshow" id="demo">
                 <?php foreach($people as $key):?>
             	<li class="li_2">
                   <div class='floatLeft'><?php echo CHtml::link($key['title'],$this->createUrl('/celebrity/list/view',array('id'=>$key['id'])),array('target'=>'_blank','img_url'=>$key['track_id'],'celebrity','4_3','thumb'));?></div>    
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
                    <a href="" img_url="../images/image/meeting_1.jpg"></a>
					<p class='last'>主题：<b>香港珠宝首饰展览会</b></p>
                    <p class='last'>地点：香港会议展览中心</p>
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
            <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::ARTICLE,'res_id'=>121,'type'=>1,'width'=>907,'height'=>85));?>
        </div>
        <div class='wrapRight'>
            <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::ARTICLE,'res_id'=>122,'type'=>1,'width'=>306,'height'=>85));?>
        </div>
</div>  
 <div class='bigdiv'>
            <div class='leftfloat'>
	<div class='subtitle' style="float:none"><em class="title_bg five"></em><a href="/celebrity/list/category/59.html" target="_blank">更多>></a></div>
		<div class="carousel"> 
			<div class="slides">
					<?php foreach($interview as $key):?>
                        <div class="slideItem"> 
                            <?php echo CHtml::link($key['title'],$this->createUrl('/celebrity/list/view',array('id'=>$key['id'])),array('target'=>'_blank','img_url'=>Storage::getImageBySize($key['track_id'],'celebrity','9_16','thumb')));?>
                        </div>
                    <?php endforeach;?>
			</div> 
		   
			<div class="nextButton"></div><div class="prevButton"></div>
			<div class="buttonNav">
				 <?php foreach($interview as $key):?>
                    <div style="text-align: left;" class="bullet">
                            <h5><?php echo CHtml::encode(Helper::truncate_utf8(!empty($key['title'])?$key['title']:'暂无数据',10));?></h5>
                            <p>简介:<?php echo CHtml::encode(Helper::truncate_utf8(!empty($key['discription'])?$key['discription']:'暂无数据',60));?><span><?php echo CHtml::link('浏览全部',$this->createUrl('/celebrity/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></span></p>
                    </div>
                <?php endforeach;?> 
			</div>
		</div> 	
</div>
            
     
            <div class='center' style='_width:578px;'>
        	<div class='subtitle centertitle'><em class="title_bg six"></em><?php echo CHtml::link('更多',$this->createUrl('/study/list/category',array('id'=>'87')),array('target'=>'_blank'));?></div>
            <div class='mainTCenter_Top'>
               
                <?php foreach($course as $key):?>
                <div class='mainTCenter_TopPic'>
                    <?php echo CHtml::link($key['title'],$this->createUrl('/study/list/view',array('id'=>$key['id'])),array('target'=>'_blank','img_url'=>Storage::getImageBySize($key['track_id'],'study','4_3','thumb')));?>
                </div>
                <div class='mainTCenter_TopText'>    
                	<h3>
                        <?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($key['title'],10,false)),$this->createUrl('/study/list/view',array('id'=>$key['id'])),array('title'=>$key['title'],'target'=>'_blank'));?>
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
                            <?php echo CHtml::link($val['title'],$this->createUrl('/study/list/view',array('id'=>$val['id'])),array('target'=>'_blank','img_url'=>Storage::getImageBySize($val['track_id'],'study','4_3','thumb')));?>
                        </li>
                        <?php else:?>
                        <li style=' float:right; padding-right:0;'><?php echo CHtml::link($val['title'],$this->createUrl('/study/list/view',array('id'=>$val['id'])),array('target'=>'_blank','img_url'=>Storage::getImageBySize($val['track_id'],'study','4_3','thumb')));?></li>
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
                                     <?php echo CHtml::link($val['title'],$this->createUrl('/celebrity/list/view',array('id'=>$val['id'])),array('target'=>'_blank','class'=>'imgArea','img_url'=>$val['track_id'],'celebrity','4_3','thumb'));?>
                                    <h3><?php echo CHtml::encode(Helper::truncate_utf8(!empty($val['title'])?$val['title']:'暂无数据',10));?></h3>
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
        <span class='list'>
                <a href="/investment/list/category/21.html" id="box1_a1" class="imgArea float" onmousemove="box1(1)" target="_blank">工业项目</a>/
                <a href="/investment/list/category/22.html" id="box1_a2" class="imgArea float" onmousemove="box1(2)" target="_blank">农业项目</a>/
                <a href="/investment/list/category/23.html" id="box1_a3" class="imgArea float" onmousemove="box1(3)" target="_blank">旅游项目</a>/
                <a href="/investment/list/category/24.html" id="box1_a4" class="imgArea float" onmousemove="box1(4)" target="_blank">地产项目</a>/
                <a href="/investment/list/category/25.html" id="box1_a5" class="imgArea float" onmousemove="box1(5)" target="_blank">园区项目</a>/
                <a href="/investment/list/category/26.html" id="box1_a6" class= "imgArea float" onmousemove="box1(6)" target="_blank">其他项目</a>
            </span>
        <a href="/investment/list.html" target=""><em class='title_1'></em></a>
        </div>
           
             <div class='leftfloat' style="margin-top: 20px;">
			<div class="carousel carouse2"> 
			<div class="slides"> 
					<?php foreach($gover as $key):?>
                        <div class="slideItem"> 
                            <?php echo CHtml::link(CHtml::image(!empty($key['thumb']) ? Storage::getImageBySize($key['thumb'],'investment','9_16','thumb'):'',$key['name'],array('width'=>140,'height'=>180)),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('target'=>'_blank'));?>
                        </div>
                    <?php endforeach;?>
			</div> 
                <div class="nextButton"></div><div class="prevButton" ></div>
			<div class="buttonNav">
                <?php foreach($gover as $key):?>
                    <div style="text-align: left;" class="bullet">
                        <h5><?php echo CHtml::encode(Helper::truncate_utf8(!empty($key['name'])?$key['name']:'暂无数据',10));?></h5>	
                        <p><span>项目介绍：</span><?php echo CHtml::encode(Helper::truncate_utf8(!empty($key['discription'])?$key['discription']:'暂无数据',30));?><?php echo CHtml::link('浏览全部',$this->createUrl('/investment/default',array('id'=>$key['id'])),array('target'=>'_blank'));?></p>
                        <p><span>总投资(万元)：</span><?php echo CHtml::encode(!empty($key['maney'])?$key['maney']:'暂无数据');?></p>
                        <p> <span>项目责任主体：</span><?php echo CHtml::encode(Helper::truncate_utf8(!empty($key['unit'])?$key['unit']:'暂无数据',10,false));?></p>
                        <p> <span>建设地点：</span><?php echo CHtml::encode(Helper::truncate_utf8(!empty($key['address'])?$key['address']:'暂无数据',10,false));?></p>
                    </div>
                <?php endforeach;?>
			</div>
		</div> 
          </div>
        
            <div class="centerside" id="box1_b1">
                <?php foreach($industrial as $key):?>
                <ul class='centerside_list'>
                    <li><?php echo CHtml::link($key['name'],$this->createUrl('/investment/default',array('id'=>$key['id'])),array('target'=>'_blank','img_url'=>Storage::getImageBySize($key['thumb'],'investment','4_3','thumb')));?></li>
                    <p class='text-indent'>
                        <?php echo CHtml::link(CHtml::encode($key['name']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['name'],'target'=>'_blank'));?>
                    </p>
                </ul>
                <?php endforeach;?>
            </div>   
         
         
             <div class="centerside" id="box1_b2" style="display:none">
                 <?php foreach($agricultural as $key):?>
                <ul class='centerside_list'>
                    <li><?php echo CHtml::link($key['name'],$this->createUrl('/investment/default',array('id'=>$key['id'])),array('target'=>'_blank','img_url'=>Storage::getImageBySize($key['thumb'],'investment','4_3','thumb')));?></li>
                    <p class='text-indent'>
                       <?php echo CHtml::link(CHtml::encode($key['name']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['name'],'target'=>'_blank'));?>
                    </p>
                </ul>
                 <?php endforeach;?>
            </div>
         
            <div class="centerside" id="box1_b3" style="display:none">
                 <?php foreach($tourism as $key):?>
                <ul class='centerside_list'>
                    <li><?php echo CHtml::link($key['name'],$this->createUrl('/investment/default',array('id'=>$key['id'])),array('target'=>'_blank','img_url'=>Storage::getImageBySize($key['thumb'],'investment','4_3','thumb')));?></li>
                    <p class='text-indent'>
                        <?php echo CHtml::link(CHtml::encode($key['name']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['name'],'target'=>'_blank'));?>
                    </p>
                </ul>
                 <?php endforeach;?>
            </div>
         
            <div class="centerside" id="box1_b4" style="display:none">
                 <?php foreach($estate as $key):?>
                <ul class='centerside_list'>
                    <li><?php echo CHtml::link($key['name'],$this->createUrl('/investment/default',array('id'=>$key['id'])),array('target'=>'_blank','img_url'=>Storage::getImageBySize($key['thumb'],'investment','4_3','thumb')));?></li>
                    <p class='text-indent'>
                        <?php echo CHtml::link(CHtml::encode($key['name']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['name'],'target'=>'_blank'));?>
                    </p>
                </ul>
                 <?php endforeach;?>
            </div>
         
            <div class="centerside" id="box1_b5" style="display:none">
                 <?php foreach($park as $key):?>
                <ul class='centerside_list'>
                    <li><?php echo CHtml::link($key['name'],$this->createUrl('/investment/default',array('id'=>$key['id'])),array('target'=>'_blank','img_url'=>Storage::getImageBySize($key['thumb'],'investment','4_3','thumb')));?></li>
                    <p class='text-indent'>
                        <?php echo CHtml::link(CHtml::encode($key['name']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['name'],'target'=>'_blank'));?>
                    </p>
                </ul>
                 <?php endforeach;?>
            </div>
         
            <div class="centerside" id="box1_b6" style="display:none">
                 <?php foreach($other as $key):?>
                <ul class='centerside_list'>
                    <li><?php echo CHtml::link($key['name'],$this->createUrl('/investment/default',array('id'=>$key['id'])),array('target'=>'_blank','img_url'=>Storage::getImageBySize($key['thumb'],'investment','4_3','thumb')));?></li>
                    <p class='text-indent'>
                        <?php echo CHtml::link(CHtml::encode($key['name']),$this->createUrl('/investment/default',array('id'=>$key['id'])),array('title'=>$key['name'],'target'=>'_blank'));?>
                    </p>
                </ul>
                 <?php endforeach;?>
            </div>
       
         
         
         
    </div> 
        
     <div class='rightdiv'>
     	<div class='subtitle'><em class="title_bg eight"></em><?php echo CHtml::link('更多',$this->createUrl('/trade/list/category',array('id'=>'64')),array('target'=>'_blank'));?></div>
        
        <div class='Right_sidebar_1'>
             <?php foreach($newswire as $key=>$val):?>
                     <?php if($key < 2):?>
            <ul class='sidebar_list_1'>
                <li>  
                    <?php echo CHtml::link($val['title'],$this->createUrl('/trade/list/view',array('id'=>$val['id'])),array('target'=>'_blank','class'=>'imgArea','img_url'=>$val['min_thumb']));?>
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
            	<li><?php echo CHtml::link($key['title'],$this->createUrl('/trade/list/view',array('id'=>$key['id'])),array('target'=>'_blank','img_url'=>$key['min_thumb']));?></li>
                <?php endforeach;?>
            </ul>
        </div>
  <div class='bigdiv'>
    	<div class='leftdiv'>
        	<div class='bigTitle'>
            	<span class='list'>
                    <a href="javascript:;" id="bestId28" class="imgArea float" onclick="change_tab_con(this.id,'bestShow');">名贵珠宝</a>/
                    <?php foreach($category as $key):?> 
                        <a href="javascript:;"  class="imgArea float" id="bestId<?php echo $key['id'];?>" onclick="change_tab_con(this.id,'bestShow');"><?php echo $key['name'];?></a>/
                    <?php endforeach;?>
                </span>
                <a href="/life.html" target="_blank"><em class='title_2'></em></a>
            </div>
            
            
           <div class='Leftside_pic'>
                
               <?php foreach($beauty as $key=>$val):?>
                     <?php if($key < 1):?>
            	<div class="piclist_position">
                        <?php echo CHtml::link($val['title'],$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('target'=>'_blank','class'=>'imgArea sytle adv_pic','img_url'=>Storage::getImageBySize($val['track_id'],'article','9_16','thumb')));?>
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
                     <?php echo CHtml::link($val['title'],$this->createUrl('/article/list/view',array('id'=>$val['id'])),array('target'=>'_blank','class'=>'imgArea sytle adv_pic','img_url'=>Storage::getImageBySize($val['track_id'],'article','4_3','thumb')));?>
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
                       <li><?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($key['title'],20,false)),$this->createUrl('/article/list/view',array('id'=>$key['id'])),array('title'=>$key['title'],'target'=>'_blank'));?></li>   
                       <?php endforeach;?>
                   </ul>
               </div>
          </div>
            
         <div class='centerside_pic' id="bestShow">
          	<ul class='centerside_pic_list' >
                <?php foreach($jewelry as $key): ?>
            	<li class="piclist_1">
                   <?php echo CHtml::link($key['title'],$this->createUrl('/article/list/view',array('id'=>$key['id'])),array('target'=>'_blank','class'=>'imgArea sytle adv_pic','img_url'=>Storage::getImageBySize($key['track_id'],'article','4_3','thumb')));?>
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
         
            <?php foreach($category as $key):?>
            <?php static $i=0;?> 
         <div class='centerside_pic' id="con_bestId<?php echo $key['id'];?>" style="display:none; float:right;">  
          	<ul class='centerside_pic_list'> 
                <?php foreach(Article::getByCategory($key['id'],4) as $v):?>
            	<li class="piclist_1">
                    <?php echo CHtml::link($v['title'],$this->createUrl('/article/list/view',array('id'=>$v['id'])),array('target'=>'_blank','class'=>'imgArea sytle adv_pic','img_url'=>Storage::getImageBySize($v['track_id'],'article','4_3','thumb')));?>
                    <div class="lazy_content"> 
                        <div class='pic_text pic_text_1'>
                            <ul class='mainTitle mainTitle_3'>
                                <li><?php echo CHtml::encode(Helper::truncate_utf8($v['title'],5,false));?></li>
                                <li class='gf_text' ><?php echo CHtml::encode(Helper::truncate_utf8($v['title'],10,false));?></li>
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
                    <?php foreach($gallery as $key): ?>
                    <div class='rightpic_list'>
                      <?php echo CHtml::link($key['title'],$this->createUrl('/article/list/view',array('id'=>$key['id'])),array('target'=>'_blank','class'=>'imgArea sytle adv_pic','img_url'=>Storage::getImageBySize($key['track_id'],'article','16_9','thumb')));?>
                            <div class="lazy_content"> 
                                <div class='pic_text'>
                                    <ul class='mainTitle mainTitle_5'>
                                         <li><?php echo CHtml::encode(Helper::truncate_utf8($key['title'],5,false));?></li>
                                <li class='gf_text' ><?php echo CHtml::encode(Helper::truncate_utf8($key['title'],10,false));?></li>
                                    </ul>
                                </div>
                            </div>
                    </div>
                    <?php endforeach;?>
                   
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
            <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::ARTICLE,'res_id'=>123,'type'=>1,'width'=>907,'height'=>85));?>
        </div>
        <div class='wrapRight'>
            <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::ARTICLE,'res_id'=>124,'type'=>1,'width'=>306,'height'=>85));?>
        </div>
  </div>
  <div class='bigdiv'>
  	<div class='leftdiv'>
    <div class="bigTitle">
    <span class="list">
            <a href="http://shop.lfeel.com/index.php?act=search&cate_id=185" class="imgArea float" id="box4_a1" onmousemove="box4(1)" target="_blank">潮流服饰</a>/
            <a href="http://shop.lfeel.com/index.php?act=search&cate_id=92" class="imgArea float" id="box4_a2" onmousemove="box4(2)" target="_blank">鞋子箱包</a>/
            <a href="http://shop.lfeel.com/index.php?act=search&cate_id=1" class="imgArea float" id="box4_a3" onmousemove="box4(3)" target="_blank">珠宝饰品</a>/    
            <a href="http://shop.lfeel.com/index.php?act=search&cate_id=90" class="imgArea float" id="box4_a4" onmousemove="box4(4)" target="_blank">休闲食品</a><!--/-->
        </span>
    <a href="http://http://shop.lfeel.com/" target="_blank"><em class='title_3'>    
        </em></a>
    </div>
    <div class='Leftside_pic'>
    	<div class='toppic'><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=88" target="_blank" img_url="../images/image/ind_17.jpg"></a></div>
        <div class='bottompic'><a href="http://shop.lfeel.com/index.php?act=show_store&op=goods_all&id=6" target="_blank" img_url="../images/image/ind_13.jpg"></a><a href="http://shop.lfeel.com/index.php?act=show_store&op=goods_all&id=16" target="_blank"><img src="../images/image/pin.jpg" alt="" /></a></div>
        
    </div>
    
    <!-- 潮流服饰-->   

    <div class='center' style="margin:10px 0 0 10px; position:relative;" id="box4_b1" > 
        <div class='shoppic'>
                <ul class='piclist'>
                    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=123" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/9/2013/04/9_b7c10a17429faf806a2c754a20cbe5bc.jpg_small.jpg"></a></h2>
                    <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=123" target="_blank">线条印花连衣裙CA123</a></i></li>
                    <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">578.00</b></li>
                    <li><span>广东广州</span><b>莫尔斯密码服饰</b></li>
                </ul>
        </div>
        
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=125" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/9/2013/04/9_d0d799e64b199a0312ef1b90dd4f6f99.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=125" target="_blank">线条印花大摆裙裤AD075</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">399.00</b></li>
                <li><span>广东广州</span><b>莫尔斯密码服饰</b></li>
            </ul>
        </div>
        
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=126" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/9/2013/04/9_50208dfa561cb27d03c0307e1c8afcff.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=126" target="_blank">真丝钉珠背心A393</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">399.00</b></li>
                <li><span>广东广州</span><b>莫尔斯密码服饰</b></li>
            </ul>
        </div>
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=128" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/9/2013/04/9_600998cca75015cf5987751d51f908c6.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=128" target="_blank">丝欧根纱透视蕾丝上衣CF257</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">599.00</b></li>
                <li><span>广东广州</span><b>莫尔斯密码服饰</b></li>
            </ul>
        </div>
        
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=143" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/9/2013/05/9_f9d54715156fb9256632ba1a7f02bb28.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=143" target="_blank">结构拼色真丝长上衣BA210</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">599.00</b></li>
                <li><span>广东广州</span><b>莫尔斯密码服饰</b></li>
            </ul>
        </div>
        
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=141" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/9/2013/05/9_c4f8a510dbdebb313fe1d94142e87bbb.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=141" target="_blank">渐变拼色真丝连衣裙AA067</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">799.00</b></li>
                <li><span>广东广州</span><b>莫尔斯密码服饰</b></li>
            </ul>
        </div> 
    </div>
    <!--鞋子箱包 -->
   <div class='center' style="margin:10px 0 0 10px; position:relative;width:570px; float:left;display:none;" id="box4_b2"> 
        <div class='shoppic'>
                <ul class='piclist'>
                    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=147" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/1/2013/05/1_e1895346bb4f42c40fd7cf7f1244b4d1.jpg_small.jpg"></a></h2>
                    <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=147" target="_blank">APPLE手提斜挎包</a></i></li>
                    <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">958.00</b></li>
                    <li><span>广东广州</span><b>Apple箱包旗舰店</b></li>
                </ul>
        </div>
        
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=146" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/1/2013/05/1_bf87fec61ff2f010e36265ee779431f3.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=146" target="_blank">Apple夏季韩版女包</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">588.00</b></li>
                <li><span>广东广州</span><b>Apple箱包旗舰店</b></li>
            </ul>
        </div>
        
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=18" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/1/2013/04/1_803bf69cbd81466fd36c022fe00b6f05.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=18" target="_blank">Apple新款</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">1388.00</b></li>
                <li><span>广东广州</span><b>Apple箱包旗舰店</b></li>
            </ul>
        </div>
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=66" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/1/2013/04/1_a3fdbddee6804c8ecfcc83b2da5c53a4.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=66" target="_blank">Apple韩版新款</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">328.00</b></li>
                <li><span>广东广州</span><b>Apple箱包旗舰店</b></li>
            </ul>
        </div>
        
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=17" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/1/2013/04/1_6503518ff4fff24488f0c327c11b11b6.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=17" target="_blank">APPLE 单肩斜挎包</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">1025.00</b></li>
                <li><span>广东广州</span><b>Apple箱包旗舰店</b></li>
            </ul>
        </div>
        
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=38" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/1/2013/04/1_9e77c6959c25aa17bdde442cc745e4f5.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=38" target="_blank">Apple新款牛皮手拿包</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">1028.00</b></li>
                <li><span>广东广州</span><b>Apple箱包旗舰店</b></li>
            </ul>
        </div> 
    </div>
        
    <!-- 珠宝饰品-->
     <div class='center' style="margin:10px 0 0 10px; position:relative;display:none;" id="box4_b3"> 
        <div class='shoppic'>
                <ul class='piclist'>
                    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=154" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/17/2013/05/17_98fa972456001d96b84816673708928d.jpg_small.jpg"></a></h2>
                    <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=154" target="_blank">耳饰RE21006</a></i></li>
                    <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">468.00</b></li>
                    <li><span>广东广州</span><b>iRUBY时尚饰品</b></li>
                </ul>
        </div>
        
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=169" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/17/2013/05/17_2983b51778643df43e0af2659b259b2a.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=169" target="_blank">耳饰RE25023</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">1338.00</b></li>
                <li><span>广东广州</span><b>iRUBY时尚饰品</b></li>
            </ul>
        </div>
        
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=172" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/17/2013/05/17_85729228f9c42c8d13c840ea216ada00.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=172" target="_blank">耳饰RE28002</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">688.00</b></li>
                <li><span>广东广州</span><b>iRUBY时尚饰品</b></li>
            </ul>
        </div>
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=159" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/17/2013/05/17_11d3f97ea4c3abcaca75897e08985633.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=159" target="_blank">耳饰RE25011</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">738.00</b></li>
                <li><span>广东广州</span><b>iRUBY时尚饰品</b></li>
            </ul>
        </div>
        
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=171" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/17/2013/05/17_84f558e874bfd40261cfe511e38f6209.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=171" target="_blank">耳饰RE25065</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">338.00</b></li>
                <li><span>广东广州</span><b>iRUBY时尚饰品</b></li>
            </ul>
        </div>
        
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=170" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/17/2013/05/17_090a5a4d43c1c4def96e36b422fb713d.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=170" target="_blank">耳饰RE25064</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">368.00</b></li>
                <li><span>广东广州</span><b>iRUBY时尚饰品</b></li>
            </ul>
        </div> 
    </div>
    <!-- 休闲食品--> 
     <div class='center' style="margin:10px 0 0 10px; position:relative;display:none;" id="box4_b4"> 
        <div class='shoppic'>
                <ul class='piclist'>
                    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=139" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/16/2013/04/16_70f23a84bfd87574310215a760ec0a5e.jpg_small.jpg"></a></h2>
                    <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=139" target="_blank">艾伯爵 白中白香槟</a></i></li>
                    <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">98.00</b></li>
                    <li><span>广东广州</span><b>酒村网</b></li>
                </ul>
        </div>
        
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=136" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/16/2013/04/16_cd35b0003fca37ca0937dd47fcff1547.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=136" target="_blank">蜜桃红起泡葡萄酒</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">108.00</b></li>
                <li><span>广东广州</span><b>酒村网</b></li>
            </ul>
        </div>
        
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=132" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/16/2013/04/16_89f3b3ae2061c758410365c3b75436e8.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=132" target="_blank">雍廷雅典半干型起泡葡</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">268.00</b></li>
                <li><span>广东广州</span><b>酒村网</b></li>
            </ul>
        </div>
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=133" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/16/2013/04/16_da2a2233f1fd3b1dab2d65d57e896add.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=133" target="_blank">贝乐德塔红葡萄酒2011</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">209.00</b></li>
                <li><span>广东广州</span><b>酒村网</b></li>
            </ul>
        </div>
        
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=114" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/16/2013/04/16_bdab2df387268f131d8e42b90ecbaa97.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=114" target="_blank">歌兰精品陈年香槟</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">890.00</b></li>
                <li><span>广东广州</span><b>酒村网</b></li>
            </ul>
        </div>
        
        <div class='shoppic'>
            <ul class='piclist'>
           	    <h2><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=111" target="_blank" img_url="http://shop.lfeel.com/upload/store/goods/16/2013/04/16_f391245860833fc926c807d4a3384187.jpg_small.jpg"></a></h2>
                <li><i><a href="http://shop.lfeel.com/index.php?act=goods&goods_id=111" target="_blank">波蒂丝堡2009</a></i></li>
                <li><span>运费：0.00</span>￥<b style="color:#ff6236; font-size:16px; font-weight:bold;">700.00</b></li>
                <li><span>广东广州</span><b>酒村网</b></li>
            </ul>
        </div> 
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
            <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::ARTICLE,'res_id'=>125,'type'=>1,'width'=>907,'height'=>85));?>
        </div>
        <div class='wrapRight'>
            <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::ARTICLE,'res_id'=>126,'type'=>1,'width'=>306,'height'=>85));?>
        </div>
  </div>
  <div class='bigdiv'>
  	<div class='leftdiv'>
    	<div class="bigTitle"><em class='title_4'></em></div>
        <div class="Leftside_pic">
    	<div class="toppic"><img src="../images/image/ind_38.jpg" alt=""><img src="../images/image/ind_40.jpg" alt=""><img src="../images/image/ind_43.jpg" alt=""></div> 
        <div class='toppic_text'>
        <strong>上海长曲姑娘们的亚太杯之梦</strong>
        <p>  我们是上海财经大学的长曲姑娘几年来发展迅速，将要参加6月下旬的亚太杯大赛。我们需要筹集资金作为往返北京车票，住宿，队服费用。<span><a href="http://quanzi.lfeel.com/member.php?mod=logging&action=login" target="_blank">浏览全文>></a></span></p>
        </div>
    </div>
    <div class='center' style="margin: 10px 0 0 10px;">
        	<div class='mainbox'>
            	<h1><img src="../images/image/ind_16.jpg" alt="" /></h1>
                <h3>上海长曲姑娘们的亚太杯之梦</h3>
                <span>项目发起人</span>
                <dl class='inbox'>
                	<dt><a href="#" img_url="../images/image/ind_44.jpg"></a></dt>
                    <dd><b>Toxic</b></dd>
                    <dd>发起时间：2013/05/4</dd>
                    <dd>支持的项目：12</dd>
                    <dd>发起的项目：20</dd>
                </dl>
                <div class='inbox_text'>
                <p>关于我们上海长曲姑娘：</p><p>
   我们是20个热爱长曲的姑娘，从五年前第一次接触长曲，到五年里不断训练推广，今天，我么终于要代表中国参加2013年长曲棍球亚太杯！
如果你还不知道什么是长曲，不知道今年夏天中国终于能派出完整女队参加长曲亚太杯，不知道这根球杆这个小球能承载多大的梦想。那么，请您听听我们的五年故事。
</p>
    </div>
     </div>
        </div>
  	</div>
    <div class="rightdiv">
     	<div class="subtitle"><em class="title_bg eleven"></em><?php echo CHtml::link('更多',$this->createUrl('/community/list/category',array('id'=>'74')),array('target'=>'_blank'));?></div>
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




