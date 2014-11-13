<style>
/*我的评论*/
.FloatLeft .MainDiv .subDiv ul.feedlist li { padding-bottom:20px; overflow:hidden; _margin-bottom:20px; clear:both; zoom:1;}
.FloatLeft .MainDiv .subDiv ul.feedlist li .imgBlock_img{ width:50px; height:50px; float:left; padding-right:15px;}
.FloatLeft .MainDiv .subDiv ul.feedlist li .imgBlock_img img{ border:none;}
.FloatLeft .MainDiv .subDiv ul.feedlist li .imgBlock_ct{ width:614px; border:1px solid #ededed; float:left; background:#f9f9f9; position:relative; padding:10px; line-height:24px;}
.FloatLeft .MainDiv .subDiv ul.feedlist li .imgBlock_ct .f_nick{ color:#717171;}
.FloatLeft .MainDiv .subDiv ul.feedlist li .imgBlock_ct .f_info{ color:#717171;}
.FloatLeft .MainDiv .subDiv ul.feedlist li .imgBlock_ct i{ font-style:normal;}
.FloatLeft .MainDiv .subDiv ul.feedlist li .imgBlock_ct i.c_tx{ color:#444;}
.FloatLeft .MainDiv .subDiv ul.feedlist li .imgBlock_ct i.f_color{ color:#0d608b;}
.FloatLeft .MainDiv .subDiv ul.feedlist li .imgBlock_ct a.Text_Float{ float:right; color:#0d608b;}
.FloatLeft .MainDiv .subDiv ul.feedlist li .imgBlock_ct a.nickname{ color:#444;}
.FloatLeft .MainDiv .subDiv ul.feedlist li .imgBlock_ct span{ width:8px; height:14px; background:#fff url(/themes/usercenter/images/ping.jpg) no-repeat; float:left; position:absolute;top:10px; left:-8px;}
.FloatLeft .MainDiv .subDiv ul.feedlist li .imgBlock_ct .comments_item{ width:614px; overflow:hidden; border-top:1px solid #ededed; margin-top:10px; display:inline;}
.FloatLeft .MainDiv .subDiv ul.feedlist li .imgBlock_ct .text_input{ width:614px;height:35px;border:1px solid #aac7d4; margin-top:10px; background:#fff;}
.FloatLeft .MainDiv .subDiv ul.feedlist li .imgBlock_ct a.Reply_Text,.Box a.Reply_Text{ width:56px; height:25px; background:url(/themes/usercenter/images/public.jpg) no-repeat; background-position:0 -121px; display:inline-block; float:right; line-height:25px; text-align:center; color:#fff; margin:5px 0;}

/*发私信弹出框*/
.Box{ width:438px; border:3px solid #6f6f6f; overflow:hidden; background:#fff; margin:0 auto;}
.Box span{float:right; cursor:pointer; width:10px; height:10px; background:url(/themes/usercenter/images/close_03.jpg) no-repeat; margin:10px;}
.Box span img{ padding:10px;}
.Box .InnerBox{padding:27px 30px; /*overflow:hidden;*/}
.Box .InnerBox .row{ height:24px; padding:5px 0; position:relative;}
.Box .InnerBox .row_1{ height:90px; /*overflow:hidden;*/}
.Box .InnerBox .row label{letter-spacing:10px; height:24px; line-height:24px; float:left;}
.Box h3{background:#ededed; height:32px; line-height:32px; color:#444; padding-left:14px;}
.Box input.Nickname{ width:143px; height:24px; line-height:24px; border:1px solid #ededed; color:#707070;}
.Box .row span{ float:right; color:#d1d1d1; position:absolute;top:-10px; left:310px;*left:300px;}
.Box .row_1 .textarea{ width:308px; border:1px solid #ededed; height:54px;}

</style>
</head>
<body>
  <div class='FloatLeft'>
      <div class='MainDiv'>
                   <div class='bigDiv subDiv'>
                          <div class='subtitle'>我的评论</div>
              	   </div>
                    <div class='bigDiv subDiv'>
                    	<ul class='feedlist'>
                            <?php if(empty($lists)):?><p>暂无数据</p><?php endif;?>
                            <?php foreach($lists as $v):?>
                            <li>
                                <div class='imgBlock_img'>     
                                </div>
                                <div class='imgBlock_ct'>
                                    <span></span>
                                    <div class='f_nick'>
                                        <a href="#" class='nickname'><?php echo $v['username'];?></a>
                                        回复<a href="#" class="nickname"><?php echo $list['username']?></a>:<i class='c_tx'><?php echo CHtml::encode(Helper::truncate_utf8($v['content'], 80));?></i>
                                 
                                </div>
                                <div class='f_info'>回复我的评论<i class='f_color'><?php echo CHtml::encode(Helper::truncate_utf8($list['content'], 80));?></i> </div>
                                <a href="#" class='Text_Float'>回复</a><?php echo date('Y-m-d H:i:s',$v['ctime']);?>
                                </div>
                            </li>
                             <?php endforeach;?>
						</ul>
                   </div>
    </div>
  </div>
  <div class='RightFloat'>
            <div class='RightTitle'>最近联系人</div>
            <div class='RightContent'>
                <ul class='contact'>
                    <li><a href="#">任志强</a></li>
                    <li><a href="#">任志强</a></li>
                    <li><a href="#">任志强</a></li>
                    <li><a href="#">任志强</a></li>
                    <li><a href="#">任志强</a></li> 
                    <li><a href="#">任志强</a></li> 
       			</ul>
            </div>
        </div>
   

