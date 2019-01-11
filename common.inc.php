<?php
	//是否开启缓冲区 前台专用
	define('IS_CACHE',false);
	//判断是否开启缓冲区
	IS_CACHE?ob_start():null;
	
	//模板句柄
	global $_tpl;
	$_nav=new NavAction($_tpl);
	$_nav->showFront();//列出主导航
	
	if(isset($_COOKIE['user'])){
		$_tpl->assign('header',$_COOKIE['user'].',您好！<a href="register.php?action=logout">退出</a>');
	}else{
		$_tpl->assign('header','<a href="register.php?action=reg" class="user">注册</a>
								<a href="register.php?action=login" class="user">登录</a>');
	}
	
	$_link=new FriendLinkAction($_tpl);
	$_link->index();
	
?>