<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>CMS内容管理系统</title>
		<link rel="stylesheet" type="text/css" href="style/base.css"/>
		<link rel="stylesheet" type="text/css" href="style/feedback.css"/>
		<script src="js/details.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
	{include file='header.inc.php'}
		<div id="feedback">
			<h2>评论列表</h2>
			<h3>{$titlec}</h3>
			<p class="info">{$info}　<a href="details.php?id={$id}" target="_blank">[详情]</a></p>
			
			{if $HotThreeComment}
			{foreach $HotThreeComment(key,value)}
				<dl>
					<dt><img src="image/1.jpg"/></dt>
					<dd><em>{@value->date}发表</em><span style="color: #06f;">{@value->user}</span><img src="image/hot.gif" alt="热"/></dd>
					<dd class="info">（{@value->manner}） {@value->content}</dd>
					<dd class="button">
					<a href="feedback.php?cid={@value->cid}&id={@value->id}&type=sustain" target="_blank">[{@value->sustain}]支持</a> 
					<a href="feedback.php?cid={@value->cid}&id={@value->id}&type=oppose" target="_blank">[{@value->oppose}]反对</a> 
					</dd>
				</dl>
			{/foreach}
			{else}
				<dl>
					<dd>此文档没有任何评论</dd>
				</dl>
			{/if}
			
			<h4>最新评论</h4>
			{if $AllComment}
			{foreach $AllComment(key,value)}
				<dl>
					<dt><img src="image/1.jpg"/></dt>
					<dd><em>{@value->date}发表</em><span style="color: #06f;">{@value->user}</span></dd>
					<dd class="info">（{@value->manner}） {@value->content}</dd>
					<dd class="button">
					<a href="feedback.php?cid={@value->cid}&id={@value->id}&type=sustain" target="_blank">[{@value->sustain}]支持</a> 
					<a href="feedback.php?cid={@value->cid}&id={@value->id}&type=oppose" target="_blank">[{@value->oppose}]反对</a> 
					</dd>
				</dl>
			{/foreach}
			{else}
				<dl>
					<dd>此文档没有任何评论</dd>
				</dl>
			{/if}
			<div id="page">{$page}</div>
			
		</div>
		<div id="sidebar">
			<h2>热评文档总排行</h2>
			{if $TwentyComment}
			{foreach $TwentyComment(key,value)}
			<ul>
				<li><em>08-13</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
			</ul>
			{/foreach}
			{/if}
		</div>
		
		<div class="d5">
			<form action="feedback.php?cid={$cid}" method="post" name="comment" target="_blank">
				<p style="position: relative;top: -5px;">您对本文的看法：<input type="radio" name="manner" value="1"/> 支持
							  <input type="radio" name="manner" value="0"/> 中立
							  <input type="radio" name="manner" value="-1"/> 反对
				</p>
				<p class="red">请不要发表关于政治、反动、色情等评论</p>
				<p><textarea name="content"></textarea></p>
				<p>
				验 证 码  ：<input type="text" class="text" name="code" />　
				<img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code"/>　
					<input type="submit" name="send" value="提交评论" class="submit" onclick="return checkComment();"/>
				</p>
			</form>
		</div>	
	{include file="footer.inc.php"}
	</body>
</html>
