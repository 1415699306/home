/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 弹出层库+方法
 * @author martin QQ:629881438
 */

/**
 * 注册showMsg
 * 
 * @param {type} obj
 * @param {type} title
 * @param {type} content
 * @param {type} width
 * @param {type} height
 * @returns {undefined}
 */
showMsg.Person = function(obj,title,width,height,token,btn){
    this.obj = obj;
    this.title = title;
    this.width = width; 
    this.height = height;  
    this.token = token;
    this.botton_text = btn;
};

/**
 * 注册showMsg确定弹出窗对象
 * @param {type} target
 */
showMsg.Person.prototype.beforce = function(target,content){
    var that = this;
    this.content = content;
    var obj = '#'+this.obj;
    that.close(obj);
    switch(target){
        case 'confrimMsg' : that.confrimMsg(obj); break;
        case 'loginForm'  : that.loginForm(obj); break;
        case 'commantPost' : that.commantPost(obj); break;
        case 'commantEsay' : that.commantEsay(obj);break;
        case 'loading' : that.loading(obj);break;
    }
    $(obj+' .showMsg_botton').click(function(){
        that.callBack(obj);
    }); 
    $(obj+' h3 a').click(function(){
        that.callBack(obj);
    }); 
    $(window).scrollTop($(window).scrollTop()-1).scrollTop($(window).scrollTop()+1);
};

/**
 * 获取半屏顶部距离
 * 
 * @param {type} obj
 * @returns {Number|@exp;@call;$@pro;height@exp;@@call;call;$@call;height@this.height|@exp;@call;$@call;height|@exp;@call;$@pro;height@exp;@@call;call;$@call;height}
 */
showMsg.Person.prototype.setTop = function(obj){
    return ($(window).height()-$(obj).height())/2;
};

/**
 * 获取半屏左部距离
 * @param {type} obj
 * @returns {Number|@exp;@call;$@pro;width@exp;@@call;call;$@call;width|@exp;@call;$@pro;width@exp;@@call;call;$@call;width@this.width|@exp;@call;$@call;width}
 */
showMsg.Person.prototype.setLeft = function(obj){
    return $(window).width()/2 - ($(obj).width()/2); 
};

showMsg.Person.prototype.setId = function(id){
    this.id = id;
};

showMsg.Person.prototype.setAppId = function(app_id){
    this.app_id = app_id;
};

showMsg.Person.prototype.setUserAvatar = function(url){
    this.user_avatar = url;
};

showMsg.Person.prototype.setParentId = function(id){
    this.parent_id = id;
};

showMsg.Person.prototype.setStyle = function(obj){
    var top  = this.setTop(obj);
    var left = this.setLeft(obj);
    this.scroll(obj,top);
    this.move(obj);  
    $(obj).css({'top':top+'px','left':left+'px'});
};

/**
 * 一个简单的弹出提示框
 * 
 * @param {type} obj
 * @returns {undefined}
 */
showMsg.Person.prototype.confrimMsg = function(obj){
    try{
        $(document).mousemove = null;
        var div_box = document.createElement("div");
        div_box.id = this.obj;
        document.body.appendChild(div_box);
        $(div_box).html("<h3><a href='javascript:void(0);' style='text-decoration: none;'>x</a></h3><p>"+this.title+"</p><div class='showMsg_content'>"+this.content+"</div><div class='showMsg_botton'>确定</div>");       
        $(obj).css({'position':'absolute','width':this.width+'px','visibility':'visible','-webkit-box-shadow':'0 0 10px rgba(0,0,0,0.4)','-moz-box-shadow':'0 0 10px rgba(0,0,0,0.4)','box-shadow':'0 0 10px rgba(0,0,0,0.4)','font-family':'"Microsoft yahei",Arial','z-index':'99999','background':'#F8F8F8 url(/images/showMsg/showMsg.gif) 50% 45px no-repeat','text-align':'center','font-weight':'700','text-shadow':'0px 2px 0px #fff','border':'1px solid #ccc'});
        $(obj+' p').css({'font-size':'20px','margin':(60+parseInt(this.height/95))+'px 0 0 0','color':'#000','text-indent':'0'});
        $(obj+' h3').css({'cursor':'move','padding':'8px','text-align':'right','border-bottom':'1px solid #ccc','background':'#fff'});
        $(obj+' h3 a').css({'border':'1px solid #ccc','padding':'0 5px','text-indent':'0em'});
        $(obj+' .showMsg_content').css({'font-size':'16px','height':this.height+'px'});
        $(obj+' .showMsg_botton').css({'cursor':'pointer','color':'#5797f9','text-shadow':'0px 1px 0px #ccc','background':'#fff','padding':'15px 0','font-size':'24px','border-top':'1px solid #ccc'});       
        this.setStyle(obj);
    }catch(e){
        alert(this.content);
        return;
    }
};

showMsg.Person.prototype.commantEsay = function(obj){
    try{
        $(document).mousemove = null;
        var div_box = document.createElement("div");
        div_box.id = this.obj;
        document.body.appendChild(div_box);
        $(div_box).html("<h3><a href='javascript:void(0);' style='text-decoration: none;'>x</a></h3><div class='showMsg_content'><p>"+this.title+"</p>"+this.content+"</div><div class='showMsg_botton'><span>"+this.botton_text+"</span></div>");       
        $(obj).css({'padding':'10px 5px','position':'absolute','width':this.width+'px','visibility':'visible','-webkit-box-shadow':'0 0 10px rgba(0,0,0,0.4)','-moz-box-shadow':'0 0 10px rgba(0,0,0,0.4)','box-shadow':'0 0 10px rgba(0,0,0,0.4)','font-family':'"Microsoft yahei",Arial','z-index':'99999','background':'#fff','text-align':'float','font-weight':'200','text-shadow':'0px 2px 0px #fff','border':'1px solid #ccc'});
        $(obj+' p').css({'font-size':'16px','color':'#000','text-indent':'0','font-weight':'700','margin':'0 0 5px 0'});
        $(obj+' h3').css({'cursor':'move','padding':'5px','font-size':'14px','text-align':'right'});
        $(obj+' h3 a').css({'border':'1px solid #ccc','padding':'0 5px','text-indent':'0em'});
        $(obj+' .showMsg_content').css({'font-size':'14px','height':this.height+'px','padding':'0 10px'});
        $(obj+' .showMsg_botton span').css({'background':'#374359','color':'#fff','padding':'5px 10px','border-radius':'5px','border':'1px solid ##242c3a'});
        $(obj+' .showMsg_botton').css({'text-align':'center','cursor':'pointer','color':'#5797f9','text-shadow':'0px 1px 0px #ccc','padding':'10px 0','font-size':'16px'});       
        this.setStyle(obj);
    }catch(e){
        alert(this.content);
        return;
    }
};

showMsg.Person.prototype.loading = function(obj){
    try{
        $(document).mousemove = null;
        var div_box = document.createElement("div");
        div_box.id = this.obj;
        document.body.appendChild(div_box);
        $(div_box).html("<h3><a href='javascript:void(0);' style='text-decoration: none;'>x</a></h3><div class='showMsg_content'><p>数据处理中</p><div style='width: 32px;height: 32px;margin: auto;background:url(/images/loading.gif) no-repeat;'></div></div><div class='showMsg_botton'><span>"+this.botton_text+"</span></div>");       
        $(obj).css({'padding':'10px 5px','position':'absolute','width':this.width+'px','visibility':'visible','-webkit-box-shadow':'0 0 10px rgba(0,0,0,0.4)','-moz-box-shadow':'0 0 10px rgba(0,0,0,0.4)','box-shadow':'0 0 10px rgba(0,0,0,0.4)','font-family':'"Microsoft yahei",Arial','z-index':'99999','background':'#fff','text-align':'float','font-weight':'200','text-shadow':'0px 2px 0px #fff','border':'1px solid #ccc'});
        $(obj+' p').css({'font-size':'16px','color':'#000','text-indent':'0','font-weight':'700','margin':'0 0 5px 0'});
        $(obj+' h3').css({'cursor':'move','padding':'5px','font-size':'14px','text-align':'right'});
        $(obj+' h3 a').css({'border':'1px solid #ccc','padding':'0 5px','text-indent':'0em'});
        $(obj+' .showMsg_content').css({'font-size':'14px','height':this.height+'px','padding':'0 10px'});
        $(obj+' .showMsg_botton span').css({'background':'#374359','color':'#fff','padding':'5px 10px','border-radius':'5px','border':'1px solid ##242c3a'});
        $(obj+' .showMsg_botton').css({'text-align':'center','cursor':'pointer','color':'#5797f9','text-shadow':'0px 1px 0px #ccc','padding':'10px 0','font-size':'16px'});       
        this.setStyle(obj);
    }catch(e){
        alert(this.content);
        return;
    }
};

showMsg.Person.prototype.commantPost = function(obj){
        $(document).mousemove = null;
        var div_box = document.createElement("div");
        var that = this;
        var id = this.id;
        var app_id = this.app_id;
        var token = this.token;
        var avatar = this.user_avatar;
        var pid =  this.parent_id;
        div_box.id = this.obj;
        document.body.appendChild(div_box);
        this.content = "<h6><img src="+avatar+"></h6><textarea name='PublicComment[comment_post]' id='commentPost'></textarea>";
        $(div_box).html("<h3><span>"+this.title+"</span><a href='javascript:void(0);' style='text-decoration: none;'>x</a></h3><div class='showMsg_content'>"+this.content+"</div><div class='submit'>提交</div>");       
        $(obj).css({'position':'absolute','width':this.width+'px','visibility':'visible','-webkit-box-shadow':'0 0 10px rgba(0,0,0,0.4)','-moz-box-shadow':'0 0 10px rgba(0,0,0,0.4)','box-shadow':'0 0 10px rgba(0,0,0,0.4)','font-family':'"Microsoft yahei",Arial','z-index':'99999','background':'#F8F8F8','text-align':'center','font-weight':'700','text-shadow':'0px 2px 0px #fff','border':'1px solid #ccc'});
        $(obj+' h3 span').css({'float':'left','padding':'10px 0','line-height':'0'});
        $(obj+' h3 a').css({'border':'1px solid #ccc','padding':'0 5px','text-indent':'0em'});
        $(obj+' p').css({'font-size':'20px','margin':(60+parseInt(this.height/95))+'px 0 0 0','color':'#000','text-indent':'0'});
        $(obj+' h3').css({'cursor':'move','padding':'8px','text-align':'right','border-bottom':'1px solid #ccc','background':'#fff'});
        $(obj+' .showMsg_content').css({'font-size':'16px','height':this.height+'px'});
        $(obj+' img').css({'float':'left','margin':'20px 0 0 10px','border':'1px solid #ccc','padding':'1px'});
        $(obj+' .submit').css({'width':'100%','float':'left','cursor':'pointer','color':'#5797f9','text-shadow':'0px 1px 0px #ccc','background':'#fff','padding':'5px 0','font-size':'16px','border-top':'1px solid #ccc'});
        $(obj+' #commentPost').css({'width':'400px','height':'100px','margin-top':'20px','border-radius':'5px'});
        this.setStyle(obj);  
         $(obj+' .submit').click(function(){
             var p = new showMsg.Person('showMsg','系统消息','350','100');
             var content = $('#commentPost').val();
             $.ajax({
                type: "POST",
                url:'/api/public/commant',
                dataType:'json',
                data: 'content='+content+'&YII_CSRF_TOKEN='+token+'&t='+id+'&app='+app_id+'&content='+content+'&p='+pid,
                success: function(msg){
                    that.close(obj);
                    if(msg.code === '1'){
                        $('#PublicComment_content').val('');
                        p.beforce('confrimMsg','评论提交成功!审核后显示!');                         
                    }else if(msg.code === '-1'){
                        p.beforce('confrimMsg','提交失败');
                    }else if(msg.code === '-2'){
                        p.beforce('confrimMsg',msg.msg);
                    }
                }
             });
         });
};

showMsg.Person.prototype.loginForm = function(obj){
    $(document).mousemove = null;
    var div_box = document.createElement("div");
    var that = this;
    div_box.id = this.obj;
    var token = this.token;
    this.content = '<div class="form"><h5>通过Lfeel用户账号登录</h5><form><div class="row"><label>用户名称:</label><input type="text" id="username" name="LoginForm[username]" /><span class="u_error"></span></div><div class="row"><label>用户密码:</label><input type="password" id="password" name="LoginForm[password]" /><span class="p_error"></span></div><p><input id="rememberme" name="LoginForm[rememberMe]" value="1" type="checkbox">&nbsp;下次自动登录&nbsp;&nbsp;<a href="http://shop.lfeel.com/index.php?act=login&op=forget_password">忘记密码?</a></p><p>没有Lfeel账号?&nbsp;&nbsp;<a href="http://quanzi.lfeel.com/member.php?mod=register">现在注册</a></p></form></div>';
    var oauth = '<div class="oauth"><h5>通过第三方授权登录</h5><a href="javascript:void(0);"><img src="/images/oauth/weibo_login.png" width="120" height="24"></a><a href="javascript:void(0);"><img src="/images/oauth/Connect_logo_3.png" width="120" height="24"></a></div>';
    document.body.appendChild(div_box);
    $(div_box).html("<h3><span>"+this.title+"</span><a href='javascript:void(0);' style='text-decoration: none;'>x</a></h3><div class='showMsg_content'>"+this.content+oauth+"</div><div class='login'>确定登录</div>");
    $(obj).css({'position':'absolute','width':this.width+'px','visibility':'visible','-webkit-box-shadow':'0 0 10px rgba(0,0,0,0.4)','-moz-box-shadow':'0 0 10px rgba(0,0,0,0.4)','box-shadow':'0 0 10px rgba(0,0,0,0.4)','font-family':'"Microsoft yahei",Arial','z-index':'99999','background':'#F8F8F8','text-align':'center','font-weight':'200','text-shadow':'0px 2px 0px #fff','border':'1px solid #ccc'});
    $(obj+' h3').css({'cursor':'move','padding':'8px','text-align':'right','border-bottom':'1px solid #ccc','background':'#fff url("/images/login.jpg") no-repeat','background-position':'5px','text-indent':'1.8em'});
    $(obj+' h3 a').css({'border':'1px solid #ccc','padding':'0 5px','text-indent':'0em'});
    $(obj+' h3 span').css({'float':'left','padding':'10px 0','line-height':'0'});
    $(obj+' .showMsg_content').css({'font-size':'14px','height':this.height+'px','clear':'both'});
    $(obj+' .showMsg_content p').css('margin','10px 0');
    $(obj+' .showMsg_content .form').css({'width':'250px','margin':'10px','height':'180px','border-right':'1px solid #ccc','float':'left'});
    $(obj+' .showMsg_content .oauth').css({'width':'200px','margin':'10px','height':'190px','float':'left'});
    $(obj+' .showMsg_content .oauth a').css({'margin':'10px auto'});
    $(obj+' .showMsg_content .form h5').css({'background-position':'35px 0'});
    $(obj+' .showMsg_content .form .row').css({'margin':'15px 0'});
    $(obj+' .showMsg_content .form .row .p_error,'+obj+' .showMsg_content .form .row .u_error').css({'width':'100%','float':'left','color':'red','text-indent':'1em','height':'20px'});
    $(obj+' .showMsg_content .form .row .u_error').css({'text-indent':'3em'});
    $(obj+' .showMsg_content .form .row label').css({'width':'60px','float':'left','text-align':'right','margin-right':'5px','font-size':'14px'});
    $(obj+' .login').css({'width':'100%','float':'left','cursor':'pointer','color':'#5797f9','text-shadow':'0px 1px 0px #ccc','background':'#fff','padding':'5px 0','font-size':'16px','border-top':'1px solid #ccc'});
    $('#username').blur(function(){$('.u_error').html('');});
    $('#password').blur(function(){$('.p_error').html('');});
    $(obj+' .login').click(function(){
        var username = $('#username').val();
        var password = $('#password').val();
        var rememberme = $('#rememberme').val();
        $.ajax({
            type: "POST",
            url: "/site/login",
            dataType:'json',
            cache:false,
            data: "LoginForm[username]="+username+"&LoginForm[password]="+password+"&LoginForm[rememberMe]="+rememberme+"&YII_CSRF_TOKEN="+token,
            success: function(xhr){
              if(xhr.code==='0'){
                  if(xhr.msg.password!==''){
                      $('.p_error').html(xhr.msg.password);
                  }
                  if(xhr.msg.username!==''){
                      $('.u_error').html(xhr.msg.username);
                  }
              }else if(xhr.code==='1'){
                  that.close(obj);
                  var p = new showMsg.Person('showMsg','系统消息','300','100');
                  p.beforce('confrimMsg','登录成功!');
                  p.callBack = function(){
                        document.write(xhr.callback);
                        that.close(obj);
                   };
              }
            }
         });
    });
    this.setStyle(obj);
};

/**
 * 随屏滚动
 * 
 * @param {type} obj
 * @param {type} top
 * @returns {undefined}
 */
showMsg.Person.prototype.scroll = function(obj,top){
    if($.browser.version === '6.0'){
        $(window).scroll( function() {
            $(obj).css('top',$(window).scrollTop()+top+'px');
        });
    }else{
        $(obj).css('position','fixed');
    }
};

/**
 * 注册showMsg关闭对象
 * @param {type} obj
 */
showMsg.Person.prototype.close = function(obj){    
    $(obj).remove();
};

/**
 * 注册showMsg按确定时的回调,此方法可重写
 * @param {type} obj
 */
showMsg.Person.prototype.callBack = function(obj){
     $(obj).remove();
};

/**
 * 拖动效果
 * 
 * @param {type} obj
 * @returns {undefined}
 */
showMsg.Person.prototype.move = function(obj){
    var _move=false;
    var _x,_y;
    $(obj+' h3').click(function(){ 
        }).mousedown(function(e){ 
        _move=true; 
        _x=e.pageX-parseInt($(obj).css("left")); 
        _y=e.pageY-parseInt($(obj).css("top")); 
        $(obj).fadeTo(20, 0.5);
    }); 
    $(document).mousemove(function(e){ 
        if(_move){ 
            var x=e.pageX-_x;
            var y=e.pageY-_y; 
            $(obj).css({top:y,left:x});
        } 
    }).mouseup(function(){ 
        _move=false; 
        $(obj).fadeTo("fast", 1);
        $(document).mousemove = null;
        $(document).mousemove = null;
    }); 
};

showMsg.Person.prototype.goTop = function(){
    var gotop = $('#goTop');
    var left =$('.wrap').offset().left+1250;         
    var top  = ($(window).height()/1.5);
    $(gotop).css({'top':$('body').scrollTop()+top+'px','left':left+'px'});
    if(!$.browser.msie){
        $(gotop).css('width','48px');
    }else{
        window.onscroll = function(){
            $(gotop).css({'top':document.documentElement.scrollTop+top+'px','left':left+'px'});
        };
    }
   $('li.gotop').mouseover(function(){
       $(this).css({'background':'#2d3645 url(/images/gotop.gif) no-repeat','background-position':'-40px 10px'});
   });
   $('li.gotop').mouseout(function(){
      $(this).css({'background':'#fff url(/images/gotop.gif) no-repeat','background-position':'12px 10px'});
   });
    $('li.gotop').click(function(){$(window).scrollTop(0);});
    if($.browser.version > '6.0'){
        $(window).resize(function(){goTop();});
    }  
    $('li.open').click(function(){
        $('li.register').toggle("slow");
        if($(this).html()==='收起'){
            $(this).html('展开');
        }else{
            $(this).html('收起');
        }
    });
};