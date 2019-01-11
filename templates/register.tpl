<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>会员管理</title>
		<link rel="stylesheet" type="text/css" href="style/base.css"/>
		<link rel="stylesheet" type="text/css" href="style/reg.css"/>
		<script src="js/reg.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
	{include file='header.inc.php'}
	{if $reg}
	<div id="reg">
		<h2>会员注册</h2>
		<form action="?action=reg" method="post" name="reg">
		<dl>
			<dd>用 户 名  ：<input type="text" class="text" name="user" />　<span style="color: red;">[必填]</span>（*用户名在2~20位之间）</dd>
			<dd>密　　码：<input type="password" class="text" name="pass" />　<span style="color: red;">[必填]</span>（*密码不得少于6位）</dd>
			<dd>密码确认：<input type="password" class="text" name="notpass" />　<span style="color: red;">[必填]</span>（*确认密码和密码一致）</dd>
			<dd>邮　　箱：<input type="text" class="text" name="email" />　<span style="color: red;">[必填]</span>（*每个邮箱只能注册一次ID）</dd>
			<dd>选择头像：<select name="face" onchange="sface();">
						{foreach $OptionFace(key,value)}
						<option value="{@value}.jpg">{@value}.jpg</option>
						{/foreach}
						</select>
			</dd>
			<dd><img src="image/1.jpg" alt="1.jpg" class="face" name="faceimg"/></dd>
			<dd>安全问题：<select name="question">
						<option value="">没有任何安全问题</option>
						<option value="你的姓名？">你的姓名？</option>
						<option value="你的学校？">你的学校？</option>
						<option value="你的年龄？">你的年龄？</option>
					    </select>
			</dd>
			<dd>问题答案：<input type="text" class="text" name="answer" /></dd>
			<dd>验 证 码  ：<input type="text" class="text" name="code" />　<span style="color: red;">[必填]</span></dd>
			<dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code"/></dd>
			<dd><input type="submit" class="submit" name="send" value="注册会员" onclick="return checkReg();"/></dd>
		</dl>
		</form>
	</div>
	{/if}
	
	{if $login}
	<div id="reg">
		<h2>会员登录</h2>
		<form action="?action=login" method="post" name="login">
		<dl>
			<dd>用 户 名  ：<input type="text" class="text" name="user" />　<span style="color: red;">[必填]</span>（*用户名在2~20位之间）</dd>
			<dd>密　　码：<input type="password" class="text" name="pass" />　<span style="color: red;">[必填]</span>（*密码不得少于6位）</dd>
			<dd>登录保留：<input type="radio" name="time" checked="checked" value="0"/> 不保留 
					   <input type="radio" name="time" value="86400"/> 保留一天 
					   <input type="radio" name="time" value="604800"/> 保留一周 
					   <input type="radio" name="time" value="2592000"/> 保留一月
			</dd>
			<dd>验 证 码  ：<input type="text" class="text" name="code" />　<span style="color: red;">[必填]</span>（*用户名在2~20位之间）</dd>
			<dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code"/></dd>
			<dd><input type="submit" class="submit" name="send" value="登录" onclick="return checkLogin();"/></dd>
		</dl>
		</form>
	</div>
	{/if}
	{include file="footer.inc.php"}
	</body>
</html>
