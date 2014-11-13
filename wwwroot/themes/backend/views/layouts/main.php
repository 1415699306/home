<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>LeFeel! 管理中心</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php $js = Yii::app()->clientScript;$js->registerCssFile(Yii::app()->theme->baseUrl.'/images/admincp/admincp.css');$js->registerCssFile(Yii::app()->theme->baseUrl.'/css/common.css');$js->registerCssFile('/js/dialog/easydialog.css');$js->registerScriptFile('/js/dialog/easydialog.min.js');$js->registerScriptFile(Yii::app()->theme->baseUrl.'/js/yii_common.js');?>
</head>
<body style="margin: 0px" scroll="no">
<table cellpadding="0" cellspacing="0" width="100%" height="100%">
  <tr>
    <td colspan="2" height="90">
          <?php echo $this->renderPartial('webroot.themes.backend.views.layouts.header');?>          
    </td>
  </tr>
  <tr>
    <td valign="top" width="160" class="menutd">
        <?php echo $this->renderPartial('webroot.themes.backend.views.layouts.sidebar'); ?>
    </td>
    <td valign="top" width="100%" class="mask"><?php echo $content;?></td>
  </tr>
</table>
<?php echo $this->renderPartial('webroot.themes.backend.views.layouts.footer'); ?>
</body>
</html>
<script>

function menuControl(setting){
	this.id =  setting.id;
	this.target = setting.target;
	this.ready = function(){
		$('#'+this.id).parent().parent('li').addClass('navon');		
	};
}
function showMap(){
	var target = $('#cpmap_menu');
	target.show();
	target.css({'position':'fixed','z-index':'9999999'});
}


$(document).ready(function(){
    var top = $(window).height()/2 - $('#cpmap_menu').height()/2;
    var left = $(window).width()/2 - $('#cpmap_menu').width()/2; 
    $('#cpmap_menu').css({'top':top+'px','left':left+'px'});
	var menu = new menuControl({'id':<?php echo CJavaScript::encode(Yii::app()->controller->id);?>,'target':$('#leftmenu ul')});
	menu.ready();
});
</script>
<style>
.cside h3{background:url(/images/map.png) 5px 5px no-repeat;}
.cslist {float: left;padding: 0 5px 5px 0;margin: 0 15px 0 5px;}
.cslist h3{text-indent: 1.0em;background: url(/themes/backend/images/admincp/icons-13x13.png) no-repeat;background-position: 0 -265px;}
.cslist li {padding: 4px 30px 4px 15px;text-align: left;margin-right: 5px;background: url(/themes/backend/images/admincp/icons-13x13.png) no-repeat;background-position: 0 -80px;}
.cslist li a {display: block;padding:0;}
.search-button{font-size: 12px;}
.inner{display: block;overflow:hidden;clear: both;text-align: left}
.grid-view TABLE.items{_width:97%;}
.menutd{min-height:800px;width: 160px;vertical-align:top;}
#cpmap_menu{top:35%;}
/*分页*/
ul.yiiPager {font-size: 11px;border: 0;margin: 10px 0; line-height: 100%;display: block;clear: both;overflow: hidden;padding: 15px 2px;}
ul.yiiPager li {display:inline;}
ul.yiiPager a:link{border:1px solid #c3c4ba;-moz-border-radius:2px;-webkit-border-radius:2px;border-radius:2px;margin-right:5px;padding:6px;min-width:15px;text-align:center;background:#dddddd;background-image:url("/images/button-background.png");color:#111111;}
ul.yiiPager a:visited {border:1px solid #c3c4ba;border-radius:2px;margin-right:5px;padding:6px 8px;min-width:15px;text-align:center;}
ul.yiiPager .page a {font-weight:normal;padding:6px 10px;}
ul.yiiPager a:hover {border:1px solid #818171;-webkit-box-shadow:0 0 4px rgba(0,0,0,0.3);-moz-box-shadow:0 0 4px rgba(0,0,0,0.3);box-shadow:0 0 4px rgba(0,0,0,0.3);}
ul.yiiPager .selected a { background:#261f1f;color:white;border:1px solid #261f1f;padding:6px 10px;}
</style>