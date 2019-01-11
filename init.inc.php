<?php
	session_start();	//开启会话
	//1、设置编码格式
	header('content-type:text/html;charset=utf-8');
	//2、网站根目录
	define('ROOT_PATH',dirname(__FILE__));
	//引入配置信息
	require ROOT_PATH.'/config/profile.inc.php';
	//设置中国时区
	date_default_timezone_set('Asia/Shanghai');
	
	//引入模板类
	require ROOT_PATH.'/includes/Templates.class.php';
	//引入数据库
	require ROOT_PATH.'/includes/DB.class.php';
	//引入工具类
	require ROOT_PATH.'/includes/Tool.class.php';
	//引入验证类
	require ROOT_PATH.'/includes/Validate.class.php';
	//引入分页类
	require ROOT_PATH.'/includes/Page.class.php';
	//引入验证码类
	require ROOT_PATH.'/includes/ValidateCode.class.php';
	//引入上传文件类
	require ROOT_PATH.'/includes/FileUpload.class.php';
	//引入上传图像类
	require ROOT_PATH.'/includes/Image.class.php';

	require ROOT_PATH.'/action/Action.class.php';
	require ROOT_PATH.'/action/manageAction.class.php';
	
	require ROOT_PATH.'/action/LevalAction.class.php';
	//引入导航
	require ROOT_PATH.'/action/NavAction.class.php';
	//引入list列表
	require ROOT_PATH.'/action/ListAction.class.php';
	//引入文档列表
	require ROOT_PATH.'/action/ContentAction.class.php';
	//引入文档详细内容
	require ROOT_PATH.'/action/DetailsAction.class.php';
	//用户注册
	require ROOT_PATH.'/action/RegisterAction.class.php';
	require ROOT_PATH.'/action/IndexAction.class.php';
	
	require ROOT_PATH.'/action/FeedBackAction.class.php';
	
	require ROOT_PATH.'/action/CommentAction.class.php';
	
	require ROOT_PATH.'/action/VoteAction.class.php';
	require ROOT_PATH.'/action/CastAction.class.php';
	require ROOT_PATH.'/action/FriendLinkAction.class.php';
	require ROOT_PATH.'/action/LinkAction.class.php';
	require ROOT_PATH.'/action/SearchAction.class.php';
	
	
	require ROOT_PATH.'/model/model.class.php';
	require ROOT_PATH.'/model/manageModel.class.php';
	require ROOT_PATH.'/model/LevalModel.class.php';
	require ROOT_PATH.'/model/NavModel.class.php';
	require ROOT_PATH.'/model/ContentModel.class.php';
	require ROOT_PATH.'/model/UserModel.class.php';
	require ROOT_PATH.'/model/CommentModel.class.php';
	require ROOT_PATH.'/model/VoteModel.class.php';
	require ROOT_PATH.'/model/LinkModel.class.php';
	
	//自动加载类
	/*function __autoload($_className){
		if(substr($_className,-6)=='action'){
			require ROOT_PATH.'/action/'.$_className.'.class.php';
		}elseif(substr($_className,-5)=='model'){
			require ROOT_PATH.'/model/'.$_className.'.class.php';
		}
	}*/
	
	//实例化模板类
	$_tpl=new Templates();
	
	//初始化
	require 'common.inc.php';
	
?>