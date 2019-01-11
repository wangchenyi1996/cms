<?php
	error_reporting(0);
	require substr(dirname(__FILE__),0,-6).'/init.inc.php';
	
	global $_tpl;
	$_manage=new manageAction($_tpl);//入口
	$_manage->_action();
	$_tpl->display('manage.tpl');
	
?>