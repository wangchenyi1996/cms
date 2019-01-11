<?php
	error_reporting(0);
	require substr(dirname(__FILE__),0,-6).'/init.inc.php';
	global $_tpl;
	$_link=new LinkAction($_tpl);//入口
	$_link->_action();
	$_tpl->display('link.tpl');
	
?>