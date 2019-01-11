<div id="top">
	{$header}
	<!--<a href="register.php?action=reg" class="user">注册</a>
	<a href="register.php?action=login" class="user">登录</a>-->
	<script src="js/text_adver.js" type="text/javascript" charset="utf-8"></script>
</div>
<div id="header">
	<h1><a href="###">瓢城Web俱乐部</a></h1>
	<div class="adver">
		<!--<a href="###"><img src="image/adv.png" alt="广告图"/></a>-->
		<script src="js/header_adver.js" type="text/javascript" charset="utf-8"></script>
	</div>
</div>
<div id="nav">
	<ul>
		<li><a href="./">首页</a></li>
		{if $FrontNav}
		{foreach $FrontNav(key,value)}
		<li><a href="list.php?id={@value->id}">{@value->nav_name}</a></li>
		{/foreach}
		{/if}
		
	</ul>
</div>
<div id="search">
	<form action="search.php" method="get" target="_blank">
		<select name="type">
			<option selected="selected" value="1">按标题</option>
			<option value="2">按关键字</option>
		</select>
		<input type="text" class="text" name="inputkeyword" />
		<input type="submit" class="submit" value="搜索"/>
	</form>
	<strong>TAG标签：</strong>
	<ul>
		<li><a href="###">平板(26)</a></li>
		<li><a href="###">数码(43)</a></li>
		<li><a href="###">音乐(52)</a></li>
		<li><a href="###">体育(56)</a></li>
		<li><a href="###">直播(6)</a></li>
		<li><a href="###">基金(26)</a></li>
		<li><a href="###">美女(55)</a></li>
		<li><a href="###">生活(33)</a></li>
		<li><a href="###">红酒(39)</a></li>
		<li><a href="###">烹饪(16)</a></li>
	</ul>
</div>