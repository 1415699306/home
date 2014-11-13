<?php
$js = Yii::app()->getClientScript();
$js->registerCssFile(Yii::app()->theme->baseUrl."/css/style.css");
?>
<?php $this->pageTitle='乐聚会_'.'乐荟网'.'_中国领先的企业家门户网站';?>
<div class="nav_level"><i class="nav_left_i"></i><a style="font-size: 12px;" href="/meet/list/category/5.html">聚会预告</a><a style="font-size: 12px;" href="/meet/list/category/135.html">演出活动</a><a style="font-size: 12px;" href="/meet/list/category/136.html">过往聚会</a><i class="nav_right_i"></i></div>
<div class="nav_link">您当前所在位置：<a href="/site.html">乐荟首页</a> » <span>乐聚会</span></div>
<div class="max-width" style=" margin-top:5px;">
  <!--banner图-->
  <div class="slide">
<div class="leftbanner">
<div class="bannerImg">
<ul>
    <?php foreach (Slide::getSlide('2', '14', '0', '1') as $key =>$val):?>
	<li id="box3_b0">
    	<div class="bigPic">
        	<div class="banner_pic">
                <a href="<?php echo $val['link']?>"><img src="<?php echo Storage::getImageBySize($val['track_id'],'slide','','thumb',array('width'=>931,'height'=>439));?>" alt="<?php echo $val['name'];?>" /></a>
            </div>
            <div class="banner_text">
            	<h1><?php echo CHtml::encode($val['name']);?></h1>
                <p><?php echo CHtml::encode(Helper::truncate_utf8($val['discription'],150));?><a href="<?php echo $val['link']?>" class="more">[详细]</a></p>
            </div>
        </div>
    </li>
    <?php endforeach;?>
    <?php foreach(Slide::getSlide('2', '14', '1', '3') as $key =>$val):?>
    <li id="box3_b<?php echo ++$key;?>" style="display:none">
    	<div class="bigPic">
        	<div class="banner_pic">
                <a href="<?php echo $val['link']?>"><img src="<?php echo Storage::getImageBySize($val['track_id'],'slide','','thumb',array('width'=>931,'height'=>439));?>" alt="<?php echo $val['name'];?>" /></a>
            </div>
            <div class="banner_text">
            	<h1><?php echo CHtml::encode($val['name']);?></h1>
                <p><?php echo CHtml::encode(Helper::truncate_utf8($val['discription'],150));?><a href="<?php echo $val['link']?>" class="more">[详细]</a></p>
            </div>
        </div>
    </li>
    <?php endforeach;?>
</ul>
</div>
<div class="smallPic">
<div class="smallPic_topbutton" id="up"></div>
<div class="smallPic_list" id="scrollDiv">
	<ul class="bannerBottom_list">
        <?php foreach (Slide::getSlide('2', '14', '0', '1') as $key =>$val):?>
    	<li class="tail" id="box3_a0"  onmousemove="box3(0)">
            <a href="<?php echo $val['link'];?>"><img src="<?php echo Storage::getImageBySize($val['track_id'],'slide','','thumb',array('width'=>135,'height'=>85));?>" alt="<?php echo $val['name'];?>" /></a>
        </li>
        <?php endforeach;?>
        <?php foreach(Slide::getSlide('2', '14', '1', '3') as $key =>$val):?>
        <li id="box3_a<?php echo ++$key;?>"  onmousemove="box3(<?php echo $key;?>);">
            <a href="<?php echo $val['link'];?>"><img src="<?php echo Storage::getImageBySize($val['track_id'],'slide','','thumb',array('width'=>135,'height'=>85));?>" alt="<?php echo $val['name'];?>" /></a>
        </li>
        <?php endforeach;?>
       
     </ul>
</div>
<div class="smallPic_bottombutton" id="down"></div>
</div>
</div>
<div class="rightTitle">
<div class="title"><em class="three"></em></div>


<div class="mainTop_text">
	<div class="celebrity">
    	<?php echo  CHtml::link(CHtml::image(Storage::getImageBySize($notice['track_id'],'meet','4_3','thumb'),$notice['title'],array("width"=>280,"height"=>110)),$this->createUrl("/meet/list/sign",array("id"=>$notice['id'])),array("target"=>"_blank"))
                
                ;?>
        <p class="ro">主题：<b><?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($notice['theme_name']),12,false),$this->createUrl("/meet/list/sign",array("id"=>$notice['id'])),array("target"=>"_blank"));?></b></p>
        <p class="ro">地点：<?php echo CHtml::encode(Helper::truncate_utf8($notice['locale'],9,false));?></p>
         <p class="hidden_id"><?php echo date("Y/m/d H:i:s",$notice['start_time']);?></p>
        <p class="ro">距离调查结束还有：<span class="time" id="day"></span>天<span class="time" id="hour"></span>时<span class="time" id="minute"></span>分</p>
        <?php echo CHtml::link('我要报名',$this->createUrl('/meet/list/sign',array("id"=>$notice['id'])),array('target'=>'_blank','class'=>'btn sign'));?>
        <a href="#" class="btn">活动提醒</a>
    </div>
    <div class="CreateMeet"><p>和大佬面对面交流，倾听同业人员的创业感受，打造自己的学习“圈子”，积累创业所需的人脉资源。</p>
        <a target="_blank" href="javascript:;" id="cratemeet">创建自己的聚会</a>
    </div>
</div>
</div>
</div>
<div class="MeetContent">
<!--聚会活动-->
<div class="Meet">
<div class="title"><em class="one"></em></div>
<div class="text_list">
   <?php foreach($res as $key):?>
                <a href="<?php echo $key['url'];?>"><?php echo $key['name'];?></a>
   <?php endforeach;?>
</div>


<?php foreach($model as $val):?>
<div class="Meet_item ">
	<div class="MeetPic">
        <div class="Meet_leftPic">
           <?php echo CHtml::link(CHtml::image( Storage::getImageBySize($val['track_id'],'meet','4_3','thumb'),$val['title'],array("width"=>654,"height"=>196)),$this->createUrl("/meet/list/sign",array("id"=>$val['id'])),array("target"=>"_blank"));?>
            <span><?php echo CHtml::encode($val['theme_name']);?></span>
        </div><?php echo Meet::getSta($val['id']);?>
    </div>
    <div class="Meet_right">
        	<div class="col"><div class="rightText"><?php echo date("Y/m/d",$val['start_time']);?></div><span class="leftText">开始时间：</span></div>
            <div class="col"><div class="rightText"><?php echo date("Y/m/d",$val['off_time']);?></div><span class="leftText">结束时间：</span></div>
            <div class="col"><div class="rightText"><?php echo CHtml::encode($val['locale']);?></div> <span class="leftText">活动地点：</span></div>
            <div class="col"><div class="rightText"><?php echo CHtml::encode($val['organizer']);?></div> <span class="leftText">主办方：</span></div>
            <div class="col"><div class="rightText"><?php echo $val['fee'];?></div> <span class="leftText">收费：</span></div>
        <div class="col">
             <?php if($val['off_time'] > time()):?> 
                    <div class="col"><a href="/meet/list/sign/id/<?php echo $val['id']?>" class="join">我要参加</a></div> 
                 <?php else:?>
                    <a href="/meet/list/sign/id/<?php echo $val['id']?>" class="join end">聚会过期</a>
             <?php endif;?> 
        </div>
    </div>
</div>
 <?php endforeach;?>
 <?php $this->widget('CLinkPager', array(
        'pages' => $pages,
        'header'=>false,
    )) ?> 


</div>
<div class="sidebar">
<div class="subscribe">
    <input type="text" class="Email" value="请输入您的电子邮箱!"/>
    <a href="javascript:;"  id="email">订阅</a>
       <div style="display:none"><input type="hidden" value="a429b6c0f4468db23a5661d1682db537fe2672c7" name="YII_CSRF_TOKEN" /></div>  
</div>
<div class="lfeelMeet">
	<div class="title"><em class="one"></em></div>
    <ul class="meetList">
         <?php foreach($full as $key):?>
    	<li>     
            <?php echo CHtml::link(CHtml::image(Meet::getTopBar($key['top_bar']),$key['title'],array("width"=>90,"height"=>90)),$this->createUrl("/meet/list/sign",array("id"=>$key['id'])),array("target"=>"_blank","class"=>"LeftPic"));?>
            <h2><?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($key['title']),10),$this->createUrl("/meet/list/sign",array("id"=>$key['id'])),array("target"=>"_blank"));?></h2>
            <p><?php echo Helper::truncate_utf8(CHtml::encode($key['discription']),25);?></p>
            <span>会议时间：<?php echo date("Y-m-d",$key['start_time']);?></span>
        </li>
        <?php endforeach;?>
    </ul>
</div>
<div class="pastMeet">
	<div class="title"><em class="one"></em></div>
    <ul class="personList">
         <?php if(empty($old)):?><p>暂无数据</p><?php endif;?>
        <?php foreach($old as $key=>$val):?>
         <?php if($key < 1):?>
    	<li class="current">  
         <h2><?php echo CHtml::link(Helper::truncate_utf8(Chtml::encode($val['title']),10,false),$this->createUrl("/meet/list/sign",array("id"=>$val['id'])),array("title"=>$val['title'],"target"=>"_blank"));?></h2> 
        	<div class="cont_list">
                <?php echo CHtml::link(CHtml::image(Meet::getTopBar($val['top_bar']),$val['title'],array("width"=>60,"height"=>60)),$this->createUrl("/meet/list/sign",array("id"=>$val['id'])),array("target"=>"_blank","class"=>"LeftPic"));?>
                <?php echo Helper::truncate_utf8(CHtml::encode($val['discription']),40);?>
            </div>
        </li>
        <?php else:?>
        <li>
            <h2><?php echo CHtml::link(Helper::truncate_utf8(Chtml::encode($val['title']),10,false),$this->createUrl("/meet/list/sign",array("id"=>$val['id'])),array("title"=>$val['title'],"target"=>"_blank"));?></h2>
 			<div class="cont_list">
                 <?php echo CHtml::link(CHtml::image(Meet::getTopBar($val['top_bar']),$val['title'],array("width"=>60,"height"=>60)),$this->createUrl("/meet/list/sign",array("id"=>$val['id'])),array("target"=>"_blank","class"=>"LeftPic"));?>
                 <?php echo Helper::truncate_utf8(CHtml::encode($val['discription']),40);?>
      </div>
        </li>
         <?php endif;?>
      <?php endforeach;?> 
    </ul>
</div>
</div>
</div>
  <script>
/**
 *时间倒计时 
 */
$(function(){
    var nextime = $(".hidden_id").html();
	countDown(nextime,".ro #day",".ro #hour",".ro #minute");
});

function countDown(time,day_elem,hour_elem,minute_elem,second_elem){
	var end_time = new Date(time).getTime(),
	sys_second = (end_time-new Date().getTime())/1000;
	var timer = setInterval(function(){
		if (sys_second > 0) {
			sys_second -= 1;
			var day = Math.floor((sys_second / 3600) / 24);
			var hour = Math.floor((sys_second / 3600) % 24);
			var minute = Math.floor((sys_second / 60) % 60);
			var second = Math.floor(sys_second % 60);
			day_elem && $(day_elem).text(day);
			$(hour_elem).text(hour<10?"0"+hour:hour);
			$(minute_elem).text(minute<10?"0"+minute:minute);
			$(second_elem).text(second<10?"0"+second:second);
		} else { 
			clearInterval(timer);
		}
	}, 1000);
}



$(function(){
     $('#email').click(function(){
         var email = $(".Email").val();
         var reg_email = /^([\w\.\_]{2,10})@(\w{1,}).([a-z]{2,4})$/;
         var msg = registerMsg();
         if(email === ''){        
             msg.beforce('commantEsay','请输入您的电子邮箱!');
            return false;
        }
         if(email === '请输入您的电子邮箱!'){        
             msg.beforce('commantEsay','请输入您的电子邮箱!');
            return false;
        }
        if(!email.match(reg_email)){
            msg.beforce('commantEsay','请输入正确的电子邮箱!');
            return false;
        }
        $.ajax({
            type:"POST",
            dataType:'json',
            url:"/meet/list/email",
            data: ({'email':email,'YII_CSRF_TOKEN':'<?php echo Yii::app()->request->getCsrfToken();?>'}),
            success: function(xhr){
            var msg = new showMsg.Person('showMsg','系统消息','300','100','null','关闭');
            if(xhr===1){
                  msg.beforce('commantEsay','邮箱订阅成功!');
                  showMsg.Person.prototype.callBack = function(){
                      location.reload();
                  };
            }else{
                msg.beforce('commantEsay','邮箱订阅失败失败!');
            }
          }   
        });
         });
 });
 
 var registerMsg = function(){
        return new showMsg.Person('showMsg','系统消息','300','100','null','关闭');
    };
    
    
     $('#cratemeet').click(function(){
         var msg = registerMsg();
          msg.beforce('commantEsay','您无此权限!');
 });
    
    
    
     function box3(i)
    {
        for(j=0;j<10;j++)  
        {
      if(i==j){
         $("#box3_b"+j).css("display","");
         $("#box3_a"+j).attr("class","tail");
      }
    else
    {
         $("#box3_b"+j).css("display","none");
          $("#box3_a"+j).attr("class","");
      }
     }
    }
    
    $(function(){
     var len = $(".bannerBottom_list > li").length ;
	 var i = 0;
	 var adTimer;
    adTimer = setInterval(function(){
			    box3(i)
				i++;
				if(i==len){
                    i=0;
                }
			  } , 6000);
              
              
 if($.browser.msie && ($.browser.version === "6.0") && !$.support.style) {
                $("#box4_b2").css("display", "none");    
            }
              
});


$(function(){
  $(".personList li:first-child").addClass("current");
   $(".personList li h2>a").mouseover(function(){
       $(this).parent("h2").parent("li").addClass("current");
       $(this).parent("h2").siblings(".personList").show();
       $(this).parent("h2").parent("li").siblings("li").find(".personList").hide(); 
       $(this).parent("h2").parent("li").siblings("li").removeClass("current");
    });
});

  </script>
  <style>
      .hidden_id{display:none;}
</style>

