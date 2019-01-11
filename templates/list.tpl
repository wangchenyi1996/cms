<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>CMS内容管理系统</title>
		<link rel="stylesheet" type="text/css" href="style/base.css"/>
		<link rel="stylesheet" type="text/css" href="style/list.css"/>
	</head>
	<body>
	{include file='header.inc.php'}
	<div id="list">
		<h2>当前位置 &gt; {$nav}</h2>
		{if $AllListContent}
		{foreach $AllListContent(key,value)}
		<dl>
			<dt><a href="details.php?id={@value->id}" target="_blank">
				<img src="{@value->thumbnail}" alt="{@value->title}"/></a></dt>
			<dd>[<strong>{@value->nav_name}</strong>] 
				<a href="details.php?id={@value->id}" target="_blank">{@value->title}......</a>
			</dd>
			<dd>日期：{@value->date}  点击量：{@value->count}次   关键字：[{@value->keyword}]</dd>
			<dd>{@value->info}......</dd>
		</dl>
		{/foreach}
		{else}
		<p style="padding: 20px;text-align: center;border-bottom: #CCCCCC dashed 1px;">该类下没有数据</p>
		{/if}
		<div id="page">
			{$page}
		</div>
	</div>
	<div id="sidebar">
		<div class="nav">
			<h2>子栏目列表</h2>
			{if $childnav}
			{foreach $childnav(key,value)}
			<strong><a href="list.php?id={@value->id}">{@value->nav_name}</a></strong>
			{/foreach}
			{else}
			<span>该栏目没有子类</span>
			{/if}
		</div>
		
		<div class="right">
			<h2>本月本类推荐</h2>
			{if $MonthNavRec}
			{foreach $MonthNavRec(key,value)}
			<ul>
				<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}. . .</a></li>
			</ul>
			{/foreach}
			{/if}
		</div>
		
		<div class="right">
			<h2>本月本类热点</h2>
			{if $MonthNavHot}
			{foreach $MonthNavHot(key,value)}
			<ul>
				<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}. . .</a></li>
			</ul>
			{/foreach}
			{/if}
		</div>
		
		<div class="right">
			<h2>本月本类图文</h2>
			{if $MonthNavImg}
			{foreach $MonthNavImg(key,value)}
			<ul>
				<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}. . .</a></li>
			</ul>
			{/foreach}
			{/if}

		</div>
	</div>
	{include file="footer.inc.php"}
	</body>
</html>
