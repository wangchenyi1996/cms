<?php
	error_reporting(0);
	require substr(dirname(__FILE__),0,-6).'/init.inc.php';
	global $_tpl;
	$_leval=new LevalAction($_tpl);//入口
	$_leval->_action();
	$_tpl->display('leval.tpl');
	
?>