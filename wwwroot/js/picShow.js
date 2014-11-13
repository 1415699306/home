$(document).ready(function(){function e(e,t){function n(){clearTimeout(s),r++,r>i-1&&(r=0),$(".select_btn li").removeClass("current"),$(".picshow_img li").hide(),$(".picshow_tx li").hide().eq(r).slideDown(400),$(".select_btn li").eq(r).addClass("current"),$(".picshow_img li").eq(r).show(),s=setTimeout(n,t)}var t=t?t:2e3,r=0,i=$(".picshow_img li").size(),s;$(".select_btn li").removeClass("current"),$(".picshow_img li").hide(),$(".picshow_tx li").hide().eq(0).show(),$(".select_btn li").eq(0).addClass("current"),$(".picshow_img li").eq(0).show(),s=setTimeout(n,t),$(".picshow").hover(function(){clearTimeout(s)},function(){s=setTimeout(n,t)}),$(".select_btn li").hover(function(){var e=$(".select_btn li").index($(this));return e==r?!1:(r=e,$(".select_btn li").removeClass("current"),$(".picshow_img li").hide(),$(".picshow_tx li").hide().eq(r).slideDown(100),$(".select_btn li").eq(r).addClass("current"),$(".picshow_img li").eq(r).show(),!1)})}$(".gallery").length&&(e(),$(".h_sns").find("img").hover(function(){$(this).fadeTo(200,.5)},function(){$(this).fadeTo(100,1)}))})
 jQuery(function($){
    new lazy($('.view li a'),'img_url','121','68');
    new lazy($('.picList li a'),'img_url','150','84');
    new lazy($('.picleftshow li a'),'img_url','615','345');
    new lazy($('.picView li a'),'img_url','100','56');
    new lazy($('.banner  a'),'img_url','1000','406');
    
});