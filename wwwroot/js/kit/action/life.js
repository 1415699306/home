function dealWithJSONPData(a) {
	window.loadedData = a;
}
$kit.$(function() {
	var a = 1,
	b = $("#cid").val(),
	c = new $kit.ui.Waterfall({
		container: $kit.el(".kitjs-waterfall-container")[0],
		load: function(c) {
			$(".footer").hide(),
			$kit.io.jsonp({
				url: "/life/default/article/?&Life_page=" + a + "&cid=" + b,
				onSuccess: function() {
                    if(typeof(window.loadedData.photos) !== 'undefined'){
                        a = window.loadedData.photos.page + 1;
                        var b = [];                      
                        $kit.each(window.loadedData.photos.photo,
                        function(a) {
                            a.height = Math.round(120 * Math.random() + 180),
                            b.push($kit.newHTML($kit.tpl(['<div class="kitjs-waterfall" data-id="${id}">', '<a href="${link}" class="image" target="_blank">', '<img width="${width}" height="${heights}" alt="${title}" src="${src}"/>', "</a>", '<p class="description"><strong>${title}</strong></p>', '<p class="description">${discription}</p>', "</div>"].join(""), a)).childNodes[0]);
                        }),
                        c(b),
                        window.timeoutLoading = setTimeout(function() {
                            window.loading && (window.loading.destory(), window.loading = null);
                        },
                        600);
                    }else{
                         window.loading && (window.loading.destory(), window.loading = null);
                    }
                }
			});
		},
		minColCount: 0,
		colWidth: 228
	});
	c.ev({
		ev: "loadData",
		fn: function() {
			window.timeoutLoading && (clearTimeout(window.timeoutLoading), window.timeoutLoading = null),
			null === window.loading && (window.loading = new $kit.ui.SemitransparentLoading);
		}
	}),
	c.ev({
		ev: "resizeBegin",
		fn: function() {
			window.timeoutLoading && (clearTimeout(window.timeoutLoading), window.timeoutLoading = null),
			null === window.loading && (window.loading = new $kit.ui.SemitransparentLoading);
		}
	}),
	c.ev({
		ev: "resizeEnd",
		fn: function() {
			window.timeoutLoading = setTimeout(function() {
				window.loading && (window.loading.destory(), window.loading = null);
			},
			600);
		}
	});
}),
$kit.ui.SemitransparentLoading.defaultConfig = {
	where: null,
	pos: "last",
	what: '<div style="width:40px;height:40px;display:inline-block;*display:inline;*zoom:1;z-index:99999;"></div>',
	img: "/js/kit/loading.png"
};