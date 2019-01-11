<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>main</title>
		<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
		<script src="../js/admin_manage.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body id="main">
		<div class="map">
			管理首页 &gt;&gt; 内容管理&gt;&gt; <strong id="title"><?php echo $this->vars['title'];?></strong>
		</div>
		<ol>
			<li><a href="comment.php?action=show" class="selected">评论列表</a></li>
		</ol>
		
		<?php if($this->vars['CommentList']){?>
		<form method="post" action="?action=states">
		<table cellspacing="0">
			<tr><th>编号</th><th>评论内容</th><th>评论者</th><th>所属文档</th><th>状态</th><th>批审</th><th>操作</th></tr>
			<?php foreach($this->vars['CommentList'] as $key=>$value){?>
			<tr>
				<td><?php echo $value->id ?></td>
				<td title="<?php echo $value->full ?>"><?php echo $value->content ?>...</td>
				<td><?php echo $value->user ?></td>
				<td><a href="../details.php?id=<?php echo $value->cid ?>" target="_blank" title="<?php echo $value->title ?>">查看</a></td>
				<td><?php echo $value->state ?></td>
				<td><input type="text" name="states[<?php echo $value->id ?>]" value="<?php echo $value->num ?>" class="text sort"/></td>
				<td><a href="comment.php?action=delete&id=<?php echo $value->id ?>" onclick="return confirm('你确定要删除评论吗')?true:false">删除</a></td>
			</tr>
			<?php } ?>
			<tr><td></td><td></td><td></td><td></td><td colspan="6"><input type="submit" value="批审" name="send" style="cursor: pointer;"/></td></tr>
		</table>
		<div id="page"><?php echo $this->vars['page'];?></div>
		</form>
		<?php } ?>	
		
	</body>
</html>