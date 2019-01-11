<?php
	error_reporting(0);
	require substr(dirname(__FILE__),0,-6).'/init.inc.php';
	global $_tpl;
	$_vote=new VoteAction($_tpl);//入口
	$_vote->_action();
	$_tpl->display('vote.tpl');
	
?>