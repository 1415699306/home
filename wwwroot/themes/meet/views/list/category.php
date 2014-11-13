<?php
$js = Yii::app()->getClientScript();
$js->registerCssFile(Yii::app()->theme->baseUrl."/css/style.css");
?>
<?php $this->pageTitle='乐聚会_'.'乐荟网'.'_中国领先的企业家门户网站';?>
<div class="nav_level"><i class="nav_left_i"></i><a style="font-size: 12px;" href="/meet/list/category/5.html">聚会预告</a><a style="font-size: 12px;" href="/meet/list/category/135.html">演出活动</a><a style="font-size: 12px;" href="/meet/list/category/136.html">过往聚会</a><i class="nav_right_i"></i></div>
<div class="nav_link">您当前所在位置：<a href="/site.html">乐荟首页</a> » <span>乐聚会</span></div>
  <!--banner图-->
<div class="MeetContent">
  <!--聚会活动-->
<div class="Meet">
 <?php if(empty($model)):?>暂无数据<?php endif;?>
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
 
 
 $(function(){
  $(".personList li:first-child").addClass("current");
   $(".personList li h2>a").mouseover(function(){
       $(this).parent("h2").parent("li").addClass("current");
       $(this).parent("h2").siblings(".personList").show();
       $(this).parent("h2").parent("li").siblings("li").find(".personList").hide(); 
       $(this).parent("h2").parent("li").siblings("li").removeClass("current");
    });
})
  </script>


