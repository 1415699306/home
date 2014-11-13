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
           	  <div class='subtitle'>充值信息</div>
   	  </div>
        <div class='bigDiv'>   
               <div class='row'>
               	 <label>订单号：</label> 
                 <p><?php echo CHtml::encode($model['order_id']);?></p>
               </div>
               <div class='row'>
               	 <label>充值金额：</label> 
                 <p><?php echo CHtml::encode($model['money']);?></p>
               </div>    
        </div>
      <?php 
        $p0_Cmd="Buy";
        $p1_MerId="10001126856";
        $p2_Order=$model->order_id;
        $p3_Amt=$model->money;
        $p4_Cur="CNY";
        //商品名称
        $p5_Pid="";
        $p6_Pcat="";//种类
        $p7_Pdesc="";//商品介绍
        $p8_Url="";
        $p9_SAF="0";
        $pa_MP="";
        $pd_FrpId=$model->banktype;
        $pr_NeedResponse="1";

        //我们把请求参数一个一个拼接(拼接的时候，顺序很重要!!!!)
        $data="";
        $data=$data.$p0_Cmd;
        $data=$data.$p1_MerId;
        $data=$data.$p2_Order;
        $data=$data.$p3_Amt;
        $data=$data.$p4_Cur;
        $data=$data.$p5_Pid;
        $data=$data.$p6_Pcat;
        $data=$data.$p7_Pdesc;
        $data=$data.$p8_Url;
        $data=$data.$p9_SAF;
        $data=$data.$pa_MP;
        $data=$data.$pd_FrpId;
        $data=$data.$pr_NeedResponse;
      ?>
      
       <form action="https://www.yeepay.com/app-merchant-proxy/node" method="post">
            <input type="hidden" name="p0_Cmd" value="<?php echo $p0_Cmd;?>"/>
            <input type="hidden" name="p1_MerId" value="<?php echo $p1_MerId; ?>"/>
            <input type="hidden" name="p2_Order" value="<?php echo $p2_Order; ?>"/>
            <input type="hidden" name="p3_Amt" value="<?php echo $p3_Amt; ?>"/>
            <input type="hidden" name="p4_Cur" value="<?php echo $p4_Cur;?>"/>
            <input type="hidden" name="p5_Pid" value="<?php echo $p5_Pid?>"/>
            <input type="hidden" name="p6_Pcat" value="<?php echo $p6_Pcat;?>"/>
            <input type="hidden" name="p7_Pdesc" value="<?php echo $p7_Pdesc;?>"/>
            <input type="hidden" name="p8_Url" value="<?php echo $p8_Url;?>"/>
            <input type="hidden" name="p9_SAF" value="<?php echo $p9_SAF;?>"/>
            <input type="hidden" name="pa_MP" value="<?php echo $pa_MP;?>"/>
            <input type="hidden" name="pd_FrpId" value="<?php echo $pd_FrpId;?>"/>
            <input type="hidden" name="pr_NeedResponse" value="<?php echo $pr_NeedResponse;?>"/>
            <input type="hidden" name="hmac" value="<?php echo $hmac;?>"/>
            <input type="submit" class="next" value="确认网上支付" />
        </form>
      </div>
 
