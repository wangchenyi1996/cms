<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>main</title>
		<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
		<script src="../js/leval.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body id="main">
		<div class="map">
			管理首页 &gt;&gt; 等级管理&gt;&gt; <strong id="title">{$title}</strong>
		</div>
		<ol>
			<li><a href="leval.php?action=show" class="selected">等级列表</a></li>
			<li><a href="leval.php?action=add">新增等级</a></li>
			{if $update}
				<li><a href="leval.php?action=update&id={$id}">修改等级</a></li>
			{/if}
		</ol>
		
		{if $show}
		<table cellspacing="0">
			<tr><th>编号</th><th>等级名称</th><th>等级描述</th><th>操作</th></tr>
			{foreach $AllLeval(key,value)}
			<tr>
				<td>{@value->id}</td>
				<td>{@value->leval_name}</td>
				<td>{@value->leval_info}</td>
				<td><a href="leval.php?action=update&id={@value->id}">修改</a> | 
					<a href="leval.php?action=delete&id={@value->id}" onclick="return confirm('你确定要删除等级吗')?true:false">删除</a></td>
			</tr>
			{/foreach}
		</table>
		<p class="center">[<a href="leval.php?action=add">新增等级</a>]</p>
		{/if}	
		
		{if $add}
		<form method="post" name="add">
			<table cellspacing="0" class="left">
				<tr><td>等级： <input type="text" name="leval_name" class="text"/>（等级名称的长度必须在2~20位之间）</td></tr>
				<tr><td><textarea name="leval_info"></textarea>（等级描述不得大于200位）</td></tr>
				<tr>
					<td>
						<input type="submit" name="send" value="新增等级" class="submit leval" onclick="return checkAddForm();"/>
						[<a href="leval.php?action=show">返回列表</a>]
					</td>
				</tr>
			</table>
		</form>
		{/if}
		
		{if $update}
		<form method="post" name="update">
			<input type="hidden" name="id" value="{$id}" />
			<table cellspacing="0" class="left">
				<tr><td>等级： <input type="text" name="leval_name" class="text" value="{$leval_name}"/></td></tr>
				<tr><td><textarea name="leval_info">{$leval_info}</textarea></td></tr>
				<tr>
					<td>
						<input type="submit" name="send" value="修改等级" class="submit leval" onclick="checkUpdateForm();"/>
						[<a href="leval.php?action=show">返回列表</a>]
					</td>
				</tr>
			</table>
		</form>	
		
		{/if}
		
	</body>
</html>