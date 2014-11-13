/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * @author martin QQ:629881438
 */
function addScrollEvent(func) {
    var oldonload = window.onscroll;
    if (typeof window.onscroll !== 'function') {
      window.onscroll = func;
    } else {  
      window.onscroll = function() {
        oldonload();
        func();
      };
   }
}

function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload !== 'function') {
    window.onload = func;
  } else {  
    window.onload = function() {
      oldonload();
      func();
    };
  }
}

function lazy(obj,attribute,width,height){
    var len = obj.length;
    var top,link,title,res,href;
	var that = this;
    this.show = function(){		
        for(var i=0;i<len;++i){
            top = $(obj[i]).offset().top;
            link = $(obj[i]).attr(attribute);
            title = $(obj[i]).attr('img_title');
            href = $(obj[i]).attr('link_href');
            if($(window).height() >= (top-$(window).scrollTop()) && typeof(link)!=='undefined'){
                var content = that.content(obj);
                if(typeof(title)!=='undefined' && typeof(href)!=='undefined'){
                    res = '<a href="'+href+'" title="'+title+'" target="_blank"><img src="'+link+'" width="'+width+'" height="'+height+'" alt="'+title+'"></a>';
                }else{
                    res = '<img src="'+link+'" width="'+width+'" height="'+height+'">';
                }
                $(obj[i]).html($(res).fadeIn(1000)).append(content); 
                $(obj[i]).removeAttr(attribute).removeAttr('img_title').removeAttr('link_href');
            }
        }
    };
	this.content = function(obj){
		var content = $(obj).find('.lazy_content').html();
		if(typeof(content)!=='undefined'){
			return content;
		}
	};
    $(window).wresize(this.show); 
    addScrollEvent(this.show);
    addLoadEvent(this.show);
}

function attention(rid,aid,token){
    var that = this;
    this.rid = rid;
    this.aid = aid;
    this.token = token;
    this.postData = function(callback){
        $.ajax({
            type: "POST",
            url: "/api/public/attention",
            dataType:'json',
            data: "rid="+that.rid+'&aid='+that.aid+'&YII_CSRF_TOKEN='+token,
            success: function(xhr){                  
                var p = new showMsg.Person('showMsg','系统消息','300','100','null','关闭');
                if(xhr.code === '1'){
                    callback();
                }
                 showMsg.Person.prototype.callBack = function(){
                   $('#showMsg').remove();  
                 };
                p.beforce('commantEsay',xhr.msg);
            }
         });
    };
}