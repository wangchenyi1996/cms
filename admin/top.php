<?php
	error_reporting(0);
	require substr(dirname(__FILE__),0,-6).'/init.inc.php';
	global $_tpl;
	
	Validate::checkSession();
	
	$_tpl->assign('admin_user',$_SESSION['admin']['admin_user']);
	$_tpl->assign('leval_name',$_SESSION['admin']['leval_name']);
	$_tpl->display('top.tpl');
?>