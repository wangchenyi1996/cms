<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>top</title>
		<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
		<script src="../js/admin_top_nav.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body id="top">
		<h1>logo</h1>
		<ul>
			<li><a href="sidebar.php" target="sidebar" id="nav1" onclick="admin_top_nav(1)">首页</a></li>
			<li><a href="sidebar_n.php" target="sidebar" id="nav2" onclick="admin_top_nav(2)">内容</a></li>
			<li><a href="###" id="nav3" target="sidebar" onclick="admin_top_nav(3)">会员</a></li>
			<li><a href="###" id="nav4" target="sidebar" onclick="admin_top_nav(4)">系统设置</a></li>
		</ul>
		<p>
		你好，<strong><?php echo $this->vars['admin_user'];?></strong> [<a href="###"><?php echo $this->vars['leval_name'];?></a>] [<a href="../" target="_blank">去首页</a>] [<a href="manage.php?action=logout" target="_parent">退出</a>]
		</p>
	</body>
</html>