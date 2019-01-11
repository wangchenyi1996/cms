<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>CMS内容管理系统</title>
		<link rel="stylesheet" type="text/css" href="style/base.css"/>
		<link rel="stylesheet" type="text/css" href="style/index.css"/>
		<script src="js/reg.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery-1.11.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/lunbotu.js" type="text/javascript"></script>
		<style type="text/css">
			.img{
				position: absolute;
			}
			.menu{
				position: absolute;
				top: 380px;
				left: 300px;
			}
			.menu-item{
				width: 10px;
				height: 10px;
				float: left;
				background-color:moccasin;
				color: antiquewhite;
				text-align: center;
				line-height: 30px;
				border-radius: 50%;
				margin-right: 10px;
				cursor: pointer;
				
			}
			.bg{
				background-color: orangered;
			}
			
		</style>
	</head>
	<body>
	{include file='header.inc.php'}
		<div id="user">
			{if $login}
			<h2>会员登录</h2>
			<form action="register.php?action=login" method="post" name="login">
				<label>用户名：&nbsp;<input type="text" name="user" class="text"/></label>
				<label>密   &nbsp;&nbsp;码： <input type="password" name="pass" class="text"/></label>
				<label class="yzm">验证码： <input type="text" name="code" class="text code"/></label>
				<img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code"/>
				<p>
					<input type="submit" name="send" value="登录" class="submit" onclick="return checkLogin();"/>
					<a href="register.php?action=reg">注册会员</a>
					<a href="###">忘记密码</a>
				</p>
			</form>
			{else}
			<h2>会员信息</h2>
			<div class="a">您好,<strong>{$user}! </strong>欢迎光临</div>
			<div class="b">
				<img src="image/{$face}" alt="{$user}"/>
				<a href="###">个人中心</a>
				<a href="###">我的评论</a>
				<a href="register.php?action=logout">退出</a>
			</div>
			{/if}
			<h3>最近登录会员 <span>--------------------------------</span></h3>
			{if $AllLaterUser}
			{foreach $AllLaterUser(key,value)}
			<dl>
				<dt><img src="image/{@value->face}" alt="{@value->user}" /></dt>
				<dd>{@value->user}</dd>
			</dl>
			{/foreach}
			{/if}
		</div>
		
		<div id="news">
			<h3><a href="details.php?id={$TopId}" target="_blank">{$TopTitle}...</a></h3>
			<p>核心提示： {$info}...[<a href="details.php?id={$TopId}" target="_blank">查看全文</a>]
			</p>
			<p class="link">
				{if $NewTopList}
				{foreach $NewTopList(key,value)}
				<a href="details.php?id={@value->id}" target="_blank">{@value->title}. . .</a>
				{/foreach}
				{/if}
			</p>
			<ul>
				{if $NewList}
				{foreach $NewList(key,value)}
				  <li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}. . .</a></li>
				{/foreach}
				{/if}
			</ul>
		</div>
		<div id="pic">
			<div class="imgs">	
				<div class="img" ><a href="www.taobao.com"><img src="image/adver_left.png" alt="广告图"/></a></div>
				<div class="img"><a href="www.taobao.com"><img src="image/adv_left2.png" alt="广告图" width="268px" height="193px"/></a></div>
				<div class="img"><a href="www.taobao.com"><img src="image/adv_left3.png" alt="广告图" width="268px" height="193px"/></a></div>
			</div>
			<div class="menu">
				<div class="menu-item bg"></div>
				<div class="menu-item"></div>
				<div class="menu-item"></div>
			</div>
		</div>
		
		<div id="rec">
			<h2>特别推荐</h2>
			<ul>
				{if $NewRecList}
				{foreach $NewRecList(key,value)}
				<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}. . .</a></li>
				{/foreach}
				{/if}
			</ul>
			
		</div>
		
		<div id="sidebar-right">
			<!--<div class="adver"><img src="image/adver2.png"/></div>-->
			<div class="adver"><script src="js/sidebar_adver.js" type="text/javascript" charset="utf-8"></script></div>
			<div class="hot">
				<h2>本月热点</h2>
				<ul>
					{if $MonthHotList}
					{foreach $MonthHotList(key,value)}
					  <li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}. . .</a></li>
					{/foreach}
					{/if}
				</ul>
			</div>
			<div class="comm">
				<h2>本月评论</h2>
				<ul>
					{if $MonthCommentList}
					{foreach $MonthCommentList(key,value)}
					  <li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}. . .</a></li>
					{/foreach}
					{/if}
				</ul>
			</div>
			<div class="vote">
			<h2>调查投票</h2>
			<h3>{$VoteTitle}</h3>
			<form method="post" action="cast.php" target="_blank">
				{if $VoteItem}
				{foreach $VoteItem(key,value)}
				<label><input type="radio" value="{@value->id}" name="vote"/>{@value->title}</label>
				{/foreach}
				{/if}
				<p>
					<input type="submit" value="投票" name="send"/>
					<input type="button" value="查看" onclick="javascript:window.open('cast.php')" />
				</p>
			</form>
			</div>
		</div>
		<div id="picnews">
			<h2>图文资讯</h2>
				{if $PicList}
				{foreach $PicList(key,value)}
				<dl>
				  <dt>
				  	<a href="details.php?id={@value->id}" target="_blank">
				  	<img src="{@value->thumbnail}"/>
				  	</a>
				  </dt>
				  <dd><a href="details.php?id={@value->id}" target="_blank">{@value->title}. . .
				  	</a>
				  </dd>
				 </dl>
				{/foreach}
				{/if}
		</div>
		<div id="newslist">
			{if $FourNav}
			{foreach $FourNav(key,value)}
			<div class="{@value->class}">
				<h2><a href="list.php?id={@value->id}" target="_blank">更多</a>{@value->nav_name}</h2>
				<ul>
					{for @value->list(key,value)}
					<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}. . .</a></li>
					{/for}
				</ul>
			</div>
			{/foreach}
			{/if}
		</div>
		{include file="footer.inc.php"}
	</body>
</html>
