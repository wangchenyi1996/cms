<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>main</title>
		<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
		<script src="../js/admin_content.js" type="text/javascript" charset="utf-8"></script>
		<script src="../ckeditor/ckeditor.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body id="main">
		
		<div class="map">
			内容首页 &gt;&gt; 查看文档列表&gt;&gt; <strong id="title">{$title}</strong>
		</div>
		<ol>
			<li><a href="content.php?action=show" class="selected">文档列表</a></li>
			<li><a href="content.php?action=add">新增文档</a></li>
			{if $update}
				<li><a href="content.php?action=update&id={$id}">修改文档</a></li>
			{/if}
		</ol>
		{if $show}
		<table cellspacing="0">
			<tr><th>编号</th><th>标题</th><th>属性</th><th>文档类别</th><th>浏览次数</th><th>文档发布时间</th><th>操作</th></tr>
			{if $SearchContent}
			{foreach $SearchContent(key,value)}
			<tr>
				<td>{@value->id}</td>
				<td><a href="../details.php?id={@value->id}" target="_blank">{@value->title}</a></td>
				<td>{@value->attr}</td>
				<td><a href="?action=show&nav={@value->nav}" target="_blank">{@value->nav_name}</a></td>
				<td>{@value->count}</td>
				<td>{@value->date}</td>
				<td><a href="content.php?action=update&id={@value->id}" target="_blank">修改</a> | 
					<a href="content.php?action=delete&id={@value->id}" onclick="return confirm('你确定要删除这篇文档吗')?true:false">删除</a></td>
			</tr>
			{/foreach}
			{else}
			<tr><td colspan="7">对不起，没有任何数据！</td></tr>
			{/if}
		</table>
		<form action="?" method="get">
			<div id="page">
				{$page}
				<input type="hidden" name="action" value="show" />
				<select name="nav" class="select">
					<option value="0">默认全部</option>
					{$nav}
				</select>
				<input type="submit" value="查询" class="submit"/>
			</div>
		</form>
		{/if}	
		
		{if $add}
		<form action="content.php?action=add" method="post" name="content">
		<table cellspacing="0" class="content">
			<tr style="background: #EEF3F7;"><td><strong>发布一条新文档</strong></td></tr>
			<tr><td>文档标题： <input type="text" name="title" class="text"><span class="red"> [必填]</span>
		（*标题长度在2~50之间）</td></tr>
			<tr><td>栏 &nbsp;&nbsp;&nbsp;&nbsp; 目 ： <select name="nav">
						<option style="padding: 0;" value="">请选择一个栏目类别</option>{$nav}
				</select> <span class="red">[必选]</span></td>
			</tr>
			<tr><td>定义属性：
				<input type="checkbox" name="attr[]" value="头条"> 头条  &nbsp;
				<input type="checkbox" name="attr[]" value="推荐"> 推荐  &nbsp;
				<input type="checkbox" name="attr[]" value="加粗"> 加粗  &nbsp;
				<input type="checkbox" name="attr[]" value="跳转"> 跳转 &nbsp;
				</td>
			</tr>
			<tr><td>TAG标签： <input type="text" name="tag" class="text">（*每个标签用，隔开，长度不能超过<span class="red">30位</span>）</td></tr>
			<tr><td>关&nbsp;键&nbsp;字 ： <input type="text" name="keyword" class="text">（*关键字长度不能超过<span class="red">30位</span>）</td></tr>
			<tr><td>缩 略 图 ： <input type="text" name="thumbnail" class="text" readonly="readonly">
					<input type="button" value="上传缩略图" onclick="centerWindow('../templates/upfile.html','upfile','500','200')"/>
					<img name="pic" style="display: none;"/>  （*缩略图必须是<span class="red">jpg、png、gif格式</span>）
			</td>
			</tr>
			<tr><td>文章来源：<input type="text" name="source" class="text"> （*文章来源长度不能超过<span class="red">20位</span>）</td></tr>
			<tr><td>作 &nbsp;&nbsp;&nbsp;&nbsp; 者 ：<input type="text" name="author" class="text" value="{$author}"> （*作者名称长度不能超过<span class="red">10位</span>）</td></tr>
			<tr><td><span class="middle">内容摘要：</span>
			<textarea name="info"></textarea>  （*内容简介不能超过<span class="red">200位）</span>
			</td></tr>
			<tr class="ckeditor"><td>
				<textarea id="TextArea1" class="ckeditor" name="content"></textarea>
			</td></tr>
			
			<tr><td>评论选项：<input type="radio" name="commend" value="1" checked="checked"> 允许评论   
						   <input type="radio" name="commend" value="0"> 禁止评论&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
					浏览次数：<input type="text" name="count" class="text small" value="100">
			</td></tr>	
			<tr><td>文档排序：<select name="sort">
							<option value="0">默认排序</option>
							<option value="1">置顶一天</option>
							<option value="2">置顶一周</option>
							<option value="3">制顶一月</option>
							<option value="4">制顶一年</option>
						</select>
					消费金币：<input type="text" name="gold" class="text small" value="100">
			</td></tr>	
			<tr><td>阅读权限：<select name="readlimit">
							<option value="0">开放浏览</option>
							<option value="1">初级会员</option>
							<option value="2">中级会员</option>
							<option value="3">高级会员</option>
							<option value="4">VIP会员</option>
					</select>
					标题颜色：<select name="color">
							<option value="">默认颜色</option>
							<option value="red" style="color: red;">红色</option>
							<option value="green" style="color: green;">绿色</option>
							<option value="blue" style="color: blue;">蓝色</option>
					</select>
			</td></tr>	
			<tr><td><input type="submit" value="发布文档" name="send" onclick="return checkAddContent();">  
					<input type="reset" value="重置">
			</td></tr>
			<tr><td></td></tr>
		</table>
		</form>
		{/if}
		
		{if $update}
		<form action="content.php?action=update" method="post" name="content">
			<input type="hidden" name="id" value="{$id}" />
		<table cellspacing="0" class="content">
			<tr style="background: #EEF3F7;"><td><strong>发布一条新文档</strong></td></tr>
			<tr><td>文档标题： <input type="text" name="title" class="text" value="{$titlec}"><span class="red"> [必填]</span>
		（*标题长度在2~50之间）</td></tr>
			<tr><td>栏 &nbsp;&nbsp;&nbsp;&nbsp; 目 ： <select name="nav">
						<option style="padding: 0;" value="">请选择一个栏目类别</option>
						{$nav}
				</select> <span class="red">[必选]</span></td>
			</tr>
			<tr><td>定义属性：{$attr}</td></tr>
			<tr><td>TAG标签： <input type="text" name="tag" class="text" value="{$tag}">（*每个标签用，隔开，长度不能超过<span class="red">30位</span>）</td></tr>
			<tr><td>关&nbsp;键&nbsp;字 ： <input type="text" name="keyword" class="text" value="{$keyword}">（*关键字长度不能超过<span class="red">30位</span>）</td></tr>
			<tr><td>缩 略 图 ： <input type="text" value="{$thumbnail}" name="thumbnail" class="text" readonly="readonly">
					<input type="button" value="上传缩略图" onclick="centerWindow('../templates/upfile.html','upfile','500','200')"/>
					<img src="{$thumbnail}" name="pic" style="display: block;"/>  （*缩略图必须是<span class="red">jpg、png、gif格式</span>）
			</td>
			</tr>
			<tr><td>文章来源：<input type="text" name="source" class="text" value="{$source}"> （*文章来源长度不能超过<span class="red">20位</span>）</td></tr>
			<tr><td>作 &nbsp;&nbsp;&nbsp;&nbsp; 者 ：<input type="text" name="author" class="text" value="{$author}"> （*作者名称长度不能超过<span class="red">10位</span>）</td></tr>
			<tr><td><span class="middle">内容摘要：</span>
			<textarea name="info">{$info}</textarea>  （*内容简介不能超过<span class="red">200位）</span>
			</td></tr>
			<tr class="ckeditor"><td>
				<textarea id="TextArea1" class="ckeditor" name="content">{$content}</textarea>
			</td></tr>
			
			<tr><td>评论选项：{$commend}	
					浏览次数：<input type="text" name="count" class="text small" value="{$count}">
			</td></tr>	
			<tr><td>文档排序：<select name="sort">{$sort}</select>
					消费金币：<input type="text" name="gold" class="text small" value="{$gold}">
			</td></tr>	
			<tr><td>阅读权限：<select name="readlimit">{$readlimit}</select>
					标题颜色：<select name="color">{$color}</select>
			</td></tr>	
			<tr><td><input type="submit" value="修改文档" name="send" onclick="return checkAddContent();">  
					<input type="reset" value="重置">
			</td></tr>
			<tr><td></td></tr>
		</table>
		</form>
		{/if}
		
	</body>
</html>