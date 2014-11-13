
;(function($){
	$.fn.picPlay = function (options) {
		var defaultVal = {
			shape : "fade",
			time : 2000,
			speed : 500,
			setEvent : "mouseover",
			autoPlay : true,
			playEndFn : null,
			buFn : false,
			buShape : "1"
		}
	//复制defaultVal的值
	var oval = $.extend(defaultVal,options); 
	
	//fAttr()是属性列表，实例化后.getAttr("要查询的值")调用
	function fAttr(){
		this.fnVal = new Function ("name","return name");
		this.imgIndex = 0;
	}
	var attrList = new fAttr;
	this.getAttr = function (valNmae){
		return attrList[attrList.fnVal(valNmae)];
	}
	
	return this.each(function () {
		var $Obj = $(this);
		var $picView = $Obj.find(".J-pic-view:eq(0)");
		var $viewLi = $picView.children().eq(0);
		var $liNum = $picView.children();
		$liNum.css({float:"left"});
		var nPicWrapW = $viewLi.outerWidth();
		var nPicWrapH = $viewLi.height();
		var $view = $Obj.find(".J-pic-view");
		var $eventObj = $Obj.find(".J-pic-bu").children();
		//实例化"自动播放"，目的是拿到正在播放对象:oAutoPlay.autoObj
		var oAutoPlay = new autoPlay();
		$picView.wrap('<div class="J-pic-wrap"></div>');
		var oPicWrap = $Obj.find(".J-pic-wrap"); 
		$picView.css({"position":"relative"})
		oPicWrap[0].style.overflow = "hidden";
		oPicWrap[0].style.width = nPicWrapW + "px";
		oPicWrap[0].style.height = nPicWrapH + "px";
		
		
		//左右滚动模式
		function rollLr(){
			//生成一个包裹层和其样式
			$picView[0].style.width = (nPicWrapW*$liNum.length+100) + "px";
			var _buShape = oval.buShape;
			//图片左右滚动方法
			this.ac = function (num){
				//autoPlay函数模式
				if (typeof num == "number"){
					attrList.imgIndex = num;
					_play();
				}
				//按钮模式
				else {
					function _buShape_01($obj){
						attrList.imgIndex = $obj.index();	
					}
					
					function _buShape_02($obj){//console.log($obj.index())
						if ($obj.index() == 0){
							attrList.imgIndex = attrList.imgIndex - 1;
							if (attrList.imgIndex < 0 ){attrList.imgIndex = $liNum.length -1  }
						}
						else {
							attrList.imgIndex = attrList.imgIndex + 1;
							if (attrList.imgIndex >= $liNum.length ){attrList.imgIndex = 0;}
						}
					}
					clearInterval(oAutoPlay.autoObj);
					delPicBu();
					switch(oval.buShape){
						case("1") : _buShape_01($(this)) ; break;
						case("2") : _buShape_02($(this)) ; break;
					}
					_play(cerPicBu);
				}
				
				function _play(fn){
					try{oval.buFn()}
					catch(e){}
					if (fn){fn();}
					$view.stop();
					$view.animate({"left" : -nPicWrapW*attrList.imgIndex},oval.speed,"swing")
				}
			}
		};
		
		
		//渐隐模式
		function fade(){
			oPicWrap[0].style.width = nPicWrapW + "px";
			$liNum.css("position","absolute");
			var nOpNum = $liNum.length;
			var i = 0 , 
				l = nOpNum ,
				nZidext = 0,
				i2 = $liNum.length;
			for (i; i<l; i++){
				$liNum.eq(i).css("z-index",i2);
				i2--;	
			}
			
			this.ac = function (num){
				//autoPlay函数模式
				if (typeof num == "number"){
					attrList.imgIndex = num;
					//console.log(attrList.imgIndex +" " + $(this).index())
					_play();
				}
				//按钮模式
				else {
					function _buShape_01($obj){
						attrList.imgIndex = $obj.index();	
					}
					
					function _buShape_02($obj){//console.log($obj.index())
						if ($obj.index() == 0){
							attrList.imgIndex = attrList.imgIndex - 1;
							if (attrList.imgIndex < 0 ){
								attrList.imgIndex = $liNum.length - 1;
							}
						}
						else {
							attrList.imgIndex = attrList.imgIndex + 1;
							if (attrList.imgIndex >= $liNum.length ){attrList.imgIndex = 0;}
						}
					}
					clearInterval(oAutoPlay.autoObj);
					delPicBu();
					switch(oval.buShape){
						case("1") : _buShape_01($(this)) ; break;
						case("2") : _buShape_02($(this)) ; break;
					}
					_play(cerPicBu);
				}
				
				function _play(fn){
					try{oval.buFn()}
					catch(e){}
					var _opObj = $liNum.eq(attrList.imgIndex);
					$liNum.eq(nZidext).css("z-index",nOpNum);
					$liNum.eq(attrList.imgIndex).css("z-index",nOpNum - 1);
					$liNum.eq(nZidext).stop().animate({"opacity" : 0}, oval.speed, function(){
						if (fn){fn();}
						nZidext = attrList.imgIndex
						$liNum.css("z-index","1");
						$liNum.eq(attrList.imgIndex).css("z-index",nOpNum);
						setTimeout(function(){$liNum.css("opacity",1)},30);
						
					})
				}
			}		
		}
		
		
		//变量int是shape模式的实例，按需实例化oval.shape，它将是全局流通
		var int = new function(){};
		switch (oval.shape){
			case("roll-lr") : int = new rollLr; break;
			case("fade") : int = new fade; break;
		}
		
		
		//自动播放函数
		function autoPlay(index){
			if (oval.autoPlay){
				if (typeof index == "undefined"){
					var num = 1 ;
				}
				else { 
					var num = index;
					clearInterval(oAutoPlay.autoObj);
				}
				this.autoObj = setInterval(function() {//console.log("ken")
					if (num >= $liNum.length  ){num = 0}
					int.ac(num);
					num++;
					
				},oval.time);
			}
			else {autoPlay = null;}
		}

		
		//按钮绑定函数
		function cerPicBu() {
			var _setEvent = oval.setEvent;
			function _picBU(){
				$eventObj.bind(_setEvent,int.ac);
			}
			_picBU();
		}
		//初始化时执行了一次按钮绑定
		cerPicBu();
		
		
		//按钮解绑函数
		function delPicBu() {
			$Obj.find(".J-pic-bu").children().unbind(oval.setEvent);	
		}
		
		
		//下面是绑定一个mouseout事件，这个是要加入了自动播放功能才会绑定。
		if (oval.autoPlay){$eventObj.bind("mouseout",function(){
			setTimeout(function (){
				oAutoPlay = new autoPlay(attrList.imgIndex);//alert(attrList.imgIndex)
			},30)
			
		});
		}
	})
	}
})(jQuery)