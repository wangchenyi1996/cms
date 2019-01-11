//创建数组，包含5组文字广告
var text=[];
text[1]={
	'title':'新浪进军微博大战',
	'link':'http://www.sina.com'
};

text[2]={
	'title':'腾讯开始团购系统',
	'link':'http://www.qq.com'
};

text[3]={
	'title':'百度开始人工智能',
	'link':'http://www.baidu.com'
};

text[4]={
	'title':'淘宝开始发展农村电商',
	'link':'http://www.taobao.com'
};

text[5]={
	'title':'阿里巴巴发展云计算、大数据',
	'link':'http://alibaba.com'
};

var i=Math.floor(Math.random()*5+1);
document.write('<a href="'+text[i].link+'" target="_blank" class="adv" title="'+text[i].title+'">'+text[i].title+'</a>');
