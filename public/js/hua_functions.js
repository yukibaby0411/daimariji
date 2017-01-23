/*
 * http://love.hackerzhou.me
 */

// variables
//全局变量，寄语书写速度
write_seed=50;

var $win = $(window);
var clientWidth = $win.width();
var clientHeight = $win.height();

$(window).resize(function() {
	/*
    var newWidth = $win.width();
    var newHeight = $win.height();
    if (newWidth != clientWidth && newHeight != clientHeight) {
        location.replace(location);
    }
    */
});

(function($) {
	$.fn.typewriters = function() {
		this.each(function() {
			var $ele = $(this), str = $ele.html(), progress = 0;
			$ele.html('');
			var timer = setInterval(function() {
				var current = str.substr(progress, 1);
				if (current == '<') {
					progress = str.indexOf('>', progress) + 1;
				} else {
					progress++;
				}
				$ele.html(str.substring(0, progress) + (progress & 1 ? '_' : ''));
				if (progress >= str.length) {
					clearInterval(timer);
				}
			}, write_seed);
		});
		return this;
	};
})(jQuery);

function timeElapse(date){
	var current = Date();
	var seconds = (Date.parse(current) - Date.parse(date)) / 1000;
	var days = Math.floor(seconds / (3600 * 24));

	var year = Math.floor(days / 360);
	days = days % 360;

	var month = Math.floor(days / 30);
	days = days % 30;

	seconds = seconds % (3600 * 24);
	var hours = Math.floor(seconds / 3600);

	seconds = seconds % 3600;
	var minutes = Math.floor(seconds / 60);

	seconds = seconds % 60;

	var result = "<span class=\"digit\">" + year + "</span> 年 <span class=\"digit\">" + month + "</span> 个月 <span class=\"digit\">" + days + "</span> 天 <span class=\"digit\">" + hours + "</span> 小时 <span class=\"digit\">" + minutes + "</span> 分钟 <span class=\"digit\">" + seconds + "</span> 秒";
	$("#clock").html(result);
}
