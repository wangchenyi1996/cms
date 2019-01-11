var sidebar=[];
sidebar[1]={
	'title':'新浪进军微博大战',
	'pic':'image/sidebar1.png',
	'link':'http://www.sina.com'
};

sidebar[2]={
	'title':'百度开始人工智能',
	'pic':'image/sidebar2.png',
	'link':'http://www.baidu.com'
};

sidebar[3]={
	'title':'阿里巴巴发展云计算、大数据',
	'pic':'image/sidebar3.png',
	'link':'http://www.alibaba.com'
};


var i=Math.floor(Math.random()*3+1);
document.write('<a href="'+sidebar[i].link+'" target="_blank"><img src="'+sidebar[i].pic+'"></a>');
