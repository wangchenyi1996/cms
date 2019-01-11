<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>登录cms后台管理系统</title>
		<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
		<script src="../js/admin_login.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<form action="manage.php?action=login" method="post" id="adminLogin" name="login">
			<fieldset id="">
				<legend>登录cms后台管理系统</legend>
				<label>账 &nbsp; &nbsp; 号：<input type="text" name="admin_user" class="text"/></label>
				<label>密 &nbsp; &nbsp; 码：<input type="password" name="admin_pass" class="text"/></label>
				<label>验 证 码：<input type="text" name="code" class="text"/></label>
				<label class="t">输入下图的字符，不区分大小写。</label>
				<label class="yzm"><img src="../config/code.php" onclick="javascript:this.src='../config/code.php?tm='+Math.random();"/></label>
				<input type="submit" value="登录" name="send" class="submit" onclick="return checkLogin();"/>
			</fieldset>
		</form>
	</body>
</html>