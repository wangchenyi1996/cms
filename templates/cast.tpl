<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>CMS内容管理系统</title>
		<link rel="stylesheet" type="text/css" href="style/base.css"/>
		<link rel="stylesheet" type="text/css" href="style/cast.css"/>
	</head>
	<body>
	{include file='header.inc.php'}
	<div id="cast">
		<h2>调查投票</h2>
		<table cellspacing="1">
			<caption>{$VoteTitle}</caption>
			<tr><th>投票项目</th><th>图示比例</th><th>百分比</th><th>得票数</th></tr>
			{if $VoteItem}
			{foreach $VoteItem(key,value)}
			<tr><td>{@value->title}</td><td style="text-align: left;"width="{$_width}px"><img src="image/b{@value->picnum}.jpg" style="width: {@value->picwidth}px;height: 21px;"/></td><td>{@value->percent}</td><td>{@value->count}</td></tr>
			{/foreach}
			{/if}
		</table>
	</div>
	
	{include file="footer.inc.php"}
	</body>
</html>
