var header=[];
header[1]={
	'title':'新浪进军微博大战',
	'pic':'image/1.png',
	'link':'http://www.sina.com'
};

header[2]={
	'title':'百度开始人工智能',
	'pic':'image/2.png',
	'link':'http://www.baidu.com'
};

header[3]={
	'title':'阿里巴巴发展云计算、大数据',
	'pic':'image/3.png',
	'link':'http://www.alibaba.com'
};


var i=Math.floor(Math.random()*3+1);
document.write('<a href="'+header[i].link+'" target="_blank"><img src="'+header[i].pic+'"></a>');
