</div>
<div class="footer_x">
<div class="wrap max-width">
	<div class="x_top">
    	<div class="x_top_titile footer_bg">
        	<a href="/post/help/help/about" target="_blank">公司简介</a>|
            <a href="/post/help/help/contact" target="_blank">联系方法</a>|
            <a href="/post/help/help/recrui" target="_blank">加盟代理</a>|
            <a href="/post/help/help/server" target="_blank">客户服务</a>|
            <a href="/post/help/help/policy" target="_blank">隐私政策</a>|
            <a href="/post/help/help/service" target="_blank">广告服务</a>|
            <a href="/post/help/help/map" target="_blank">网站地图</a>|
            <a href="/post/help/help/feedback" target="_blank">意见反馈</a>|
            <a href="http://net.china.com.cn/index.htm" target="_blank">不良信息举报</a>
           <!-- <a href="#"target="_blank">战略合作</a>   -->

        </div>
		<div class="footer_list">
        	<a href="http://www.itrust.org.cn/" target="_blank" class="pic1"></a>
            <a class="pic2"></a>
            <a href="http://net.china.com.cn/index.htm" target="_blank" class="pic3"></a>
            <a href="http://www.gdnet110.gov.cn/" target="_blank" class="pic4"></a>
            <a href="http://www.ctws.com.cn/" target="_blank" class="pic5"></a>
            <a href="http://www.kxnet.cn/" target="_blank" class="pic6"></a>
        </div>
</div>
    <div class="x_bottom">
    	<div class="bottom_pic">
        	<div class="rightfloat">
                <p><em></em></p>
                <p>广东省通信管理局</p>
                <p><a href="http://gdcainfo.miitbeian.gov.cn/">粤ICP备13024867号</a></p>
            </div>
        </div>
        <div class="bottom_right">
    	版权所有 @乐荟网<br />
        未经授权禁止转载、摘编、复制或建立镜像，如有违反，追究法律责任。<br />
        技术支持与报障：support@lfeel.com<br />
        对本站有任何建议、意见或投诉，请致电400-840-6688<br />
        中国最大的企业家门户平台<br />
      
        <script src="http://s14.cnzz.com/stat.php?id=5549521&web_id=5549521&show=pic" language="JavaScript"></script>
        </div>

</div>
</div>
</div>
<script>
jQuery(function($){
    $('#login').live('click',function(){
		var login = new showMsg.Person('showMsg','登录','540','200',<?php echo CJavaScript::encode(Yii::app()->request->getCsrfToken());?>);
		login.beforce('loginForm','登录!');
		return false;
	});
	var content = $('.main .new_content, .main .new_content p, .main .new_content p span');
	content.css({'font-size':'14px','text-indent':'2em'});
	var text = $('.main .new_content p span');
	var len = text.length;
	for(var i=0;i<len;++i){
		$(text[i]).html($(text[i]).text().trimL());
	}
    $('#search').submit(function(){
        var doSubmit = true;
        if($('#search-input').val()==='请输入关键词'){
            doSubmit = false;
            var p = new showMsg.Person('showMsg','系统消息','300','100');
            p.beforce('confrimMsg','请输入关键词!');
        }
        return doSubmit;
    });
}); 

$(function(){
    $('#login').live('click',function(){
        $("#weibo").attr("href",$("#wei_medium").attr("href"));
        $("#connect").attr("href",$("#qq_medium").attr("href"));
        
	});
});
</script>
