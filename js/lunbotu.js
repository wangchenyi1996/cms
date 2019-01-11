var i = 0;
var timer;
$(function() {
	$(".img").eq(0).show().siblings().hide();
	$(".menu-item").hover(function() { //鼠标移入
		i = $(this).index(); //下标
		show();
		clearInterval(timer);
	}, function() { //鼠标移出
		timer = setInterval(function() {
			i++;
			if(i == 3) {
				i = 0;
			}

			show();
		}, 2000);
	});
	$(".img").hover(function() { //鼠标移入
		i = $(this).index(); //下标
		show();
		clearInterval(timer);
	}, function() { //鼠标移出
		timer = setInterval(function() {
			i++;
			if(i == 3) {
				i = 0;
			}

			show();
		}, 2500);
	});
	timer = setInterval(function() {
		i++;
		if(i == 3) {
			i = 0;
		}
		show();
	}, 2500);
});

function show() {
	$(".img").eq(i).stop(true).fadeIn(800).siblings().stop(true).fadeOut(800);
	$(".menu-item").eq(i).addClass("bg").siblings().removeClass("bg");
}