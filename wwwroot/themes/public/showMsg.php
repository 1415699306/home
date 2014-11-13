<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title><?php echo $title;?></title>
<base target='_self' />
</head>
<body>
<div id="main">
	<div class="wrap">
		<div class="box" id="showbox">
			<div class="box-main">
			<h4 class="f-tit"><?php echo $title; ?></h4>
				<div class='content'>
					<p><?php echo $msg; ?></p>
					<p><?php echo $jumpmsg; ?></p>
				</div>
			<div class="copyright">copyright <a href='http://lfeel.com'>lfeel.com</a></div>
		</div>
	</div>
</div>
</div>
<style>
body{background:#ccc;}
.box{background:#fff;border:5px solid #fff;width:500px;height:200px;border-radius:5px;position: absolute;}
.box .f-tit{background:#2c2c2c;padding:5px;color:#fff;margin:0;}
.box .content{text-align:center;height:125px;font-size: 14px;text-shadow: 0px 1px 0px #D1D1D1;}
.box .copyright{text-align:center;background:#A6B6C3;color:#fff;padding:5px 0;}
.box p{margin-top:20px;}
</style>
<script lang='javascript'>
var pgo=0;
function JumpUrl(){
    if(pgo==0){
        location='<?php echo $gourl?>'; pgo=1;
    }
}
(function ($) {
    $.fn.vAlign = function () {
        return this.each(function (i) {
            var h = $(this).height();
            var oh = $(this).outerHeight();
            var mt = (h + (oh - h)) / 2;
			var w = $(this).width();
			var ow = $(this).outerWidth();	
			var ml = (w + (ow - w)) / 2;	
            $(this).css("margin-top", "-" + mt + "px");
            $(this).css("top", "50%");
            $(this).css("position", "absolute");
			$(this).css("margin-left", "-" + ml + "px");
			$(this).css("left", "50%");
        });
    };
})(jQuery);
$("#showbox").vAlign();
<?php echo $jstmp; ?>
</script>
</body>
</html>


