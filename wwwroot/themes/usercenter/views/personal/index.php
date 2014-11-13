<style>
/*个人信息 */
.FloatLeft{ width:701px; float:left; padding-left:36px;}
.FloatLeft .MainDiv .bigDiv .row{ margin:10px 0; overflow:hidden; width:100%;}
.FloatLeft .MainDiv .bigDiv .row label{ height:32px; line-height:32px; float:left; text-align:left; width:70px;}
.FloatLeft .MainDiv .bigDiv .row p{color: #868686;height: 32px;line-height: 32px;float: left;}
.FloatLeft .MainDiv .bigDiv .row.row .btn{width: 72px;background: url(images/btn.jpg) no-repeat;background-position: 0 0;color: #fff; border:none;}
.FloatLeft .MainDiv .bigDiv .row input {height: 25px;line-height: 25px;}
.FloatLeft .MainDiv .bigDiv .buttom{ margin-top:20px;width: 434px; overflow:hidden;}
.FloatLeft .MainDiv .bigDiv .buttom .save {width: 72px;height: 25px;background: url(/themes/usercenter/images/btn.jpg) no-repeat;border: none;cursor: pointer;margin-right: 17px;display: block;float: left; cursor:pointer; color:#fff;}
.bigDiv p{ margin-left:80px;}
.bigDiv .buttom .save{ margin-left:80px;}
.MainDiv .bigDiv p{ color:#717171; height:24px; line-height:24px; font-size:14px; margin:0; padding:0;}
.FloatLeft .MainDiv .bigDiv .end .next{width: 110px;height: 29px;background: url(/themes/usercenter/images/public.jpg) no-repeat;background-position: 0 -90px;border: none;cursor: pointer;display: block;color: #fff;float: left;}
.FloatLeft .MainDiv .bigDiv img {float: left;padding-right: 45px;}
.FloatLeft .MainDiv .bigDiv p.title {color: #268abf;font-size: 18px;font-family: "微软雅黑";padding-bottom: 20px;}
.FloatLeft .MainDiv .bigDiv p i {color: #268abf;font-style: normal;}
.FloatLeft .MainDiv .bigDiv  p {color: #444;font-size: 14px;font-style: normal;line-height: 40px;height:40px;display: block;}

.FloatLeft .MainDiv .bigDiv em{font-style: normal;padding-right: 20px;}
.FloatLeft .MainDiv .bigDiv .row .name{ width:259px; border:1px solid #e5e5e5;}
.Ri_pic{float:left; width:477px; padding-top:70px;}
.Ri_pic .Upload{ width:129px; height:129px; background:#f0f0f0; padding:55px; float:left; margin-right:33px;}
.Ri_pic .Upload .SelectImg{ width:128px; height:49px; background:#828282; color:#fff; font-size:18px; font-family:"微软雅黑"; text-align:center; line-height:49px; cursor:pointer;}
.Ri_pic .Upload .SelectImg span{_margin-top:15px; _margin-left:8px; display:inline-block;}
.Ri_pic .Upload .Webcam{ cursor:pointer; text-align:center; padding:20px 0;}
.main .Ri_pic .Insize{text-align:left; padding-bottom:26px; color:#b5b5b5; width:205px; float:left;}
</style>
</head>
<body>
  <div class='FloatLeft'>
  <div class='MainDiv'>
   	  <div class='bigDiv marbor'>
           	  <div class='subtitle'>个人信息</div>
   	  </div>
      <div class='bigDiv'>
               <div class='row'>
               	 <label>真实姓名：</label> 
                 <p><?php echo CHtml::encode($model['realname']);?></p>
               </div>
               <div class='row'>
               	 <label>邮箱地址：</label> 
                 <p><?php echo CHtml::encode($model['field7']);?></p>
               </div>   
               
        </div>
      </div>
    </div>
 
