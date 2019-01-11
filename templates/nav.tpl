<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>main</title>
		<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
		<script src="../js/nav.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body id="main">
		<div class="map">
			内容管理 &gt;&gt; 设置网站导航&gt;&gt; <strong id="title">{$title}</strong>
		</div>
		<ol>
			<li><a href="nav.php?action=show" class="selected">导航列表</a></li>
			<li><a href="nav.php?action=add">新增导航</a></li>
			{if $update}
				<li><a href="nav.php?action=update&id={$id}">修改导航</a></li>
			{/if}
			
			{if $addchild}
				<li><a href="nav.php?action=addchild&id={$id}">新增子导航</a></li>
			{/if}
			
			{if $showchild}
				<li><a href="nav.php?action=showchild&id={$id}">子导航列表</a></li>
			{/if}
		</ol>
		
		{if $show}
		<form action="nav.php?action=sort" method="post">
		<table cellspacing="0">
			<tr><th>编号</th><th>导航名称</th><th>导航描述</th><th>子类</th><th>操作</th><th>排序</th></tr>
			{if $AllNav}
			{foreach $AllNav(key,value)}
			<tr>
				<td>{@value->id}</td>
				<td>{@value->nav_name}</td>
				<td>{@value->nav_info}</td>
				<td><a href="nav.php?action=showchild&id={@value->id}">查看</a> | 
					<a href="nav.php?action=addchild&id={@value->id}">增加子类</a></td>
				<td><a href="nav.php?action=update&id={@value->id}">修改</a> | 
					<a href="nav.php?action=delete&id={@value->id}" onclick="return confirm('你确定要删除这个导航吗')?true:false">删除</a></td>
				<td><input type="text" name="sort[{@value->id}]" value="{@value->sort}" class="text sort"/></td>
			
			{/foreach}
			{else}
			<tr><td colspan="6">对不起，没有任何数据！</td></tr>
			{/if}
			<tr><td></td><td></td><td></td><td></td><td></td><td colspan="6"><input type="submit" value="排序" name="send" style="cursor: pointer;"/></td></tr>
		</table>
		</form>
		<div id="page">
			{$page}
		</div>
		{/if}	
		
		{if $add}
		<form method="post" name="add">
			<input type="hidden" name="pid" value="0" />
			<table cellspacing="0" class="left">
				<tr><td>导航： <input type="text" name="nav_name" class="text"/>（导航名称的长度必须在2~20位之间）</td></tr>
				<tr><td><textarea name="nav_info"></textarea>（导航描述不得大于200位）</td></tr>
				<tr>
					<td>
						<input type="submit" name="send" value="新增导航" class="submit leval" onclick="return checkForm();"/>
						[<a href="nav.php?action=show">返回列表</a>]
					</td>
				</tr>
			</table>
		</form>
		{/if}
		
		{if $update}
		<form method="post" name="add">
			<input type="hidden" name="id" value="{$id}" />
			<table cellspacing="0" class="left">
				<tr><td>导航： <input type="text" name="nav_name" class="text" value="{$nav_name}"/></td></tr>
				<tr><td><textarea name="nav_info">{$nav_info}</textarea></td></tr>
				<tr>
					<td>
						<input type="submit" name="send" value="修改导航" class="submit leval" onclick="checkForm();"/>
						[<a href="nav.php?action=show">返回列表</a>]
					</td>
				</tr>
			</table>
		</form>	
		
		{/if}
		
		{if $addchild}
		<form method="post" name="add">
			<input type="hidden" name="pid" value="{$id}" />
			<table cellspacing="0" class="left">
				<tr><td>上级导航：<strong>{$prev_name}</strong></td></tr>
				<tr><td>导航： <input type="text" name="nav_name" class="text"/>（子导航名称的长度必须在2~20位之间）</td></tr>
				<tr><td><textarea name="nav_info"></textarea>（子导航描述不得大于200位）</td></tr>
				<tr>
					<td>
						<input type="submit" name="send" value="新增子导航" class="submit leval" onclick="return checkForm();"/>
						[<a href="nav.php?action=showchild">返回列表</a>]
					</td>
				</tr>
			</table>
		</form>
		{/if}
		
		{if $showchild}
		<table cellspacing="0">
			<tr><th>编号</th><th>导航名称</th><th>导航描述</th><th>操作</th></tr>
			{if $AllChildNav}
			{foreach $AllChildNav(key,value)}
			<tr>
				<td>{@value->id}</td>
				<td>{@value->nav_name}</td>
				<td>{@value->nav_info}</td>
				<td><a href="nav.php?action=update&id={@value->id}">修改</a> | 
					<a href="nav.php?action=delete&id={@value->id}" onclick="return confirm('你确定要删除这个导航吗')?true:false">删除</a></td>
			</tr>
			{/foreach}
			{else}
			<tr><td colspan="4">对不起，没有任何数据！</td></tr>
			{/if}
			<tr><td colspan="4">本类隶属于--<strong>{$prev_name}</strong>     
				&nbsp;[<a href="nav.php?action=addchild&id={$id}">增加本类</a>]&nbsp;
				[<a href="nav.php?action=show">返回列表</a>]</td></tr>
		</table>
		
		<div id="page">
			{$page}
		</div>
		{/if}	
	</body>
</html>