<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>CMS内容管理系统</title>
		<link rel="stylesheet" type="text/css" href="style/base.css"/>
		<link rel="stylesheet" type="text/css" href="style/friendlink.css"/>
		<script src="js/link.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
	{include file='header.inc.php'}
	
	{if $frontadd}
	<div id="reg">
		<h2>申请友情链接</h2>
		<form method="post" name="friendlink">
			<input type="hidden" name="state" value="0" />
		<dl>
			<dd>类　　型：<input type="radio" name="type" checked="checked" value="1" onclick="link(1)"/> 文字链接
						<input type="radio" name="type" value="2" onclick="link(2)"/> logo链接
			</dd>
			<dd>网站名称：<input type="text" class="text" name="webname" />　<span style="color: red;">[必填]</span>（*网站名称不大于20位）</dd>
			<dd>网站地址：<input type="text" class="text" name="weburl" />　<span style="color: red;">[必填]</span>（*网站地址不得大于100位）</dd>
			<dd style="display: none;" id="logo">logo地址：<input type="text" class="text" name="logourl" />　<span style="color: red;">[必填]</span>（*LOGO地址不得大于100位）</dd>
			<dd>站长名称：<input type="text" class="text" name="user" /></dd>
			<dd>验  证  码  ：<input type="text" class="text" name="code" />　<span style="color: red;">[必填]</span></dd>
			<dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code"/></dd>
			<dd><input type="submit" class="submit" name="send" value="申请链接" onclick="return checkLink();"/></dd>
		</dl>
		</form>
	</div>
	{/if}
	
	{if $frontshow}
	<div id="reg">
		<h2>所有友情链接</h2>
		<h3>文字连接</h3>
		<div>
			{if $alltext}
			{foreach $alltext(key,value)}
			<a href="{@value->weburl}" target="_blank">{@value->webname}</a>
			{/foreach}
			{/if}
		</div>
		<h3>logo连接</h3>
		<div>
			{if $alllogo}
			{foreach $alllogo(key,value)}
			<a href="{@value->weburl}" target="_blank"><img src="{@value->logourl}"/></a>
			{/foreach}
			{/if}
		</div>
	</div>
	{/if}
	
	{include file="footer.inc.php"}
	</body>
</html>
