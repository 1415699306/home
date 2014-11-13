/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
        $(function(){  
           $(".name").val("请输入您的真实姓名");
           $(".company").val("请输入您的公司名称");
           $(".position").val("请输入您的公司职务");
           $(".number").val("请输入您的真实手机号，以方便接受乐荟提供服务");
           $(".email").val("请输入您的电子邮箱");
           $(".sername").val("请输入您的真实姓名");
           $(".phone").val("请留下有效电话，以方便我们与之联系");
           $(".mail").val("请输入您的电子邮箱"); 
           $(".name").focus(function(){
                 if($(".name").val() === "请输入您的真实姓名")
                   {
                       $(".name").val("");    
                   }  
           });
           
           $(".company").focus(function(){
               if($(".company").val() === "请输入您的公司名称")
                   {
                       $(".company").val("");    
                   }
                
           });
           $(".position").focus(function(){
                if($(".position").val() === "请输入您的公司职务")
                   {
                       $(".position").val("");    
                   }   
           });
           $(".number").focus(function(){
               if($(".number").val() === "请输入您的真实手机号，以方便接受乐荟提供服务")
                   {
                       $(".number").val("");    
                   }     
           });
           $(".email").focus(function(){
                if($(".email").val() === "请输入您的电子邮箱")
                   {
                       $(".email").val("");    
                   }      
           });
           $(".sername").focus(function(){
               if($(".sername").val()==="请输入您的真实姓名")
                   {
                       $(".sername").val("");    
                   }    
           });
           $(".phone").focus(function(){
               if($(".phone").val() === "请留下有效电话，以方便我们与之联系")
                   {
                       $(".phone").val("");    
                   }     
           });
           $(".mail").focus(function(){
               if($(".mail").val() === "请输入您的电子邮箱")
                   {
                       $(".mail").val("");    
                   }    
           });
           
           
           if ($.browser.msie && ($.browser.version === "7.0")) { 
                $("#yw0_button").attr("href","../css/register.css");
				$(".row").css("*margin-left", "180px");  
			    $(".row").css("display", "inline"); 
				$(".row").css("float","left");
                $("#yw0_button").css("margin-right","150px;");
            }
            else if ($.browser.msie && ($.browser.version === "6.0") && !$.support.style) {
                $("#yw0_button").css("margin-right", "180px");
                $("#yw0_button").attr("href","../css/register.css");
                $(".row").css("margin-left", "180px");
            }
            else if ($.browser.msie && ($.browser.version === "8.0")) {
                $("#yw0_button").css("margin-right", "180px");
                $("#yw0_button").attr("href","../css/register.css");
                $(".row").css("margin-left", "180px");
            }
            else if ($.browser.msie && ($.browser.version === "9.0")) {
                $("#yw0_button").css("margin-right", "180px");
                $("#yw0_button").attr("href","../css/register.css");
                $(".row").css("margin-left", "180px");
            }
            else if (window.navigator.userAgent.toLowerCase().indexOf("360se") >= 1) {
                $("#yw0_button").css("margin-right", "180px");
                $("#yw0_button").attr("href","../css/register.css");
                $(".row").css("margin-left", "180px");
            }
            
              
});
