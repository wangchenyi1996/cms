<?php
	require dirname(__FILE__).'/init.inc.php';
	global $_tpl;
	$_friendlink=new FriendLinkAction($_tpl);
	$_friendlink->_action();
	$_tpl->display('friendlink.tpl');
	
?>