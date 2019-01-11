<?php
	//数据库配置文件
	define('DB_HOST','localhost');	
	define('DB_USER','root');	
	define('DB_PASS','root');	
	define('DB_NAME','cms');	
	
	//系统配置文件
	define('PAGE_SIZE',10);	//后台内容每页十条数据
	define('ARTICLE_SIZE',5);	//前台内容每页2条数据
	
	define('NAV_SIZE',10);	//主导航在前台显示十条
	
	define('UPDIR','/uploads/');//上传文件目录
	define('MARK',ROOT_PATH.'/image/yc60.png');//水印图片
	
	define('GPC',get_magic_quotes_gpc());	//转义功能是否开启
	
	//模板配置信息
	define('TPL_DIR',ROOT_PATH.'/templates/');//3、模板文件目录
	define('TPL_C_DIR',ROOT_PATH.'/templates_c/');//4、编译文件目录
	define('CACHE',ROOT_PATH.'/cache/');//5、缓存文件目录
?>