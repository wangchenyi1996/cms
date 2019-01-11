<?php
	error_reporting(0);
	require substr(dirname(__FILE__),0,-6).'/init.inc.php';
	global $_tpl;
	$_content=new ContentAction($_tpl);//入口
	$_content->_action();
	$_tpl->display('content.tpl');
	
?>