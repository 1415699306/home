/* 
 *Yii常规操作ajax扩展库
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *@author martin
 */
;(function($){
    $.fn.listDisplayShow = function(){
        $(this).addClass('addstyle');
        $(this).siblings('em').removeClass('addstyle');
        var id = parseInt($(this).attr('id'));
        var target = $(this).parent().parent().parent().children('#site_show_'+id);
        target.css('display','block');
        target.siblings('ul').css('display','none');
    };
    
    $.fn.showMsg=function(content,width,height,size){
        easyDialog.open({
          container : {
                header : content.title,
                content : content.msg,
                yesFn : false,
                noFn : true,
                noText : '关闭',
                overlay : true
          },
          overlay:false
        });
        $('.easyDialog_text').css({'height':height+'px','width':width+'px','vertical-align':'middle','display':'table-cell','font-size':size});
    };
    
    $.fn.showLoginForm = function(){		
        var form = $(this).loginForm();
        var msg={"title":"欢迎登录Yiibase网站","msg":form};	
        $(this).showMsg(msg);  
        $(this).login();
    };
    
    $.fn.loginForm = function(){      
        var qq = '<a style="line-height:28px;float:left;margin-left:3px;" href="/oauth/login.html"><img src="/images/oauth/Connect_logo_3.png"></a>';
        var form = '';
        form +='<div><form id="table-form">';
        form +='<h5>通过网站账号登录!</h5>';
        form += '<div style="margin: 5px;"><label style="width:30px;margin-right:5px;">用户名称</label><input style="width:190px;" id="LoginForm_username" type="text" name="LoginForm[username]" /></div>';
        form += '<div style="margin: 5px;"><label style="width:30px;margin-right:5px;">用户密码</label><input style="width:190px;" id="LoginForm_password" type="password" name="LoginForm[password]" /></div>';
        form += '<label">记住登录</label><input id="LoginForm_rememberMe" type="checkbox" value="1" name="LoginForm[rememberMe]" /><span style="margin-left:5px;"><a href="/login/setpassword">忘记密码?</a></span>';
        form += '<div><input type="submit" class="submit" value="确定" /><input type="button" class="cancel" value="取消" onclick="$(this).showMsgClose();"/></div>';
        form +='</form></div>';
        form +=0 < $('#oauth_pass').length ? '<div class="login-oauth"><h5>完善信息</h5><li style="font-size:12px;margin:2px 0;line-height:20px;color:red;text-align:left;padding: 8px 0px 0 8px;">尊敬的用户,欢迎您光临Yiibase网站,您已通过第三方授权登录本网站,但你还没有完善网站信息,请先注册本站账号并进行绑定,如已有账号可直接登录,并到个人中心进行绑定即可,从此您即可享受本站提供的用户会员服务!感谢您对我们的支持!</li></div>':'<div class="login-oauth"><h5>通过第三方授权登录!</h5><li>'+qq+'</li></div>';
        form +='<div id="login_error"></div>';
        return form;
    };
    
    $.fn.showMsgClose=function(){
       easyDialog.close();
    };
    
    $.fn.login = function(){
        $('#table-form').submit(function(){		
            var username = $('#LoginForm_username').val();
            var password = $('#LoginForm_password').val();
            var remembme = $('#LoginForm_rememberMe').val();
            var data = 'LoginForm[username]=' + username + '&LoginForm[password]=' + password + '&LoginForm[rememberMe]=' + remembme;
            var error = $('#login_error');
            $.ajax({
                    type: "POST",
                    url: "/login/login",
                    data: data,
                    dataType: 'json',
                    success: function(msg) {
                        if (msg.success === true) {
                            error.show();
                            error.css({"background":"url(/images/save.png) no-repeat","background-position":" 0 5px"});
                            error.html('登录成功!');
                            window.location.href = window.location;
                        } else {
                            var showname = msg.username;
                            var showpassword = msg.password;
                            if (showname === undefined) {
                                    showname = '';
                            }
                            if (showpassword === undefined) {
                                    showpassword = '';
                            }
                            error.show();
                            error.css({"background":"url(/images/delete.png) no-repeat","background-position":" 0 5px"});
                            error.html(showname + showpassword);
                        }
                    }
            });
            return false;
        });		
    };
        
    $.fn.getArray = function(id){
        var data = new Array();
        $('#'+id).each(function(i){
            data[i] = $(this).attr('name')+'='+$(this).val();
        });
        return  data.join('&');
    };
    
    $.fn.AjaxPost = function(id,url,data){
            var option = $.extend({
                type:'POST',
                url:url,
                data:data,
                success:function(msg){
                    $.fn.ajaxUpdate(id,$.fn.getUrl(id));
                    alert(msg);
                }
            },option||{});
            $.ajax(option);
    };
        
    $.fn.ajaxUpdate = function(id,url){
        //$('#'+id).addClass($.fn.settings.loadingClass);
        var option = $.extend({
                type:'GET',
                url:url,
                success:function(data){
                        $('#'+id).replaceWith($('#'+id,data)).serialize();
                       // $('#'+id).removeClass($.fn.settings.loadingClass);
                        //$('.'+$.fn.settings.page_asc).removeClass($.fn.settings.page_static);
                        $('.'+$.fn.settings.page_desc).removeClass($.fn.settings.page_static);
                }
        },option || {});
        $.ajax(option);
    };
    
    $.fn.getUrl = function(id){
		var url = $('#'+id+' .selected a').attr('href');
		var num = $('#'+id+' .selected').text();
		var len = $.fn.getUrl.checkLen(id); 
		if(url === undefined){
			return window.location;
		}else if(1 < len){
			return url;
		}else{		
			return url.replace(/[2-9]/g,--num);
		}
	};
    
    $.fn.getUrl.checkLen = function(id){
		return len = $('#'+id).find('.rows').length;
	};
})(jQuery);
