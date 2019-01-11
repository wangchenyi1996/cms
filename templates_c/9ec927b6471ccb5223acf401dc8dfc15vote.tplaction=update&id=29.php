<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>main</title>
		<link rel="stylesheet" type="text/css" href="../style/admin.css"/>
		<script src="../js/vote.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body id="main">
		<div class="map">
			管理首页 &gt;&gt; 投票管理&gt;&gt; <strong id="title"><?php echo $this->vars['title'];?></strong>
		</div>
		<ol>
			<li><a href="vote.php?action=show" class="selected">投票主题列表</a></li>
			<li><a href="vote.php?action=add">新增投票主题</a></li>
			<?php if($this->vars['showchild']){?>
			<li><a href="vote.php?action=showchild&id=<?php echo $this->vars['id'];?>">投票项目列表</a></li>
			<?php } ?>
			<?php if($this->vars['addchild']){?>
			<li><a href="vote.php?action=addchild&id=<?php echo $this->vars['id'];?>">新增投票项目</a></li>
			<?php } ?>
			<?php if($this->vars['update']){?>
				<li><a href="vote.php?action=update&id=<?php echo $this->vars['id'];?>">修改投票主题</a></li>
			<?php } ?>
		</ol>
		
		<?php if($this->vars['show']){?>
		<table cellspacing="0">
			<tr><th>编号</th><th>主题名称</th><th>投票项目</th><th>是否前台首选</th><th>操作</th></tr>
			<?php foreach($this->vars['AllVote'] as $key=>$value){?>
			<tr>
				<td><?php echo $value->id ?></td>
				<td><?php echo $value->title ?></td>
				<td><a href="vote.php?action=showchild&id=<?php echo $value->id ?>">查看</a>
					| <a href="vote.php?action=addchild&id=<?php echo $value->id ?>">增加项目</a>
				</td>
				<td><?php echo $value->state ?></td>
				<td><a href="vote.php?action=update&id=<?php echo $value->id ?>">修改</a> | 
					<a href="vote.php?action=delete&id=<?php echo $value->id ?>" onclick="return confirm('你确定要删除投票吗')?true:false">删除</a></td>
			</tr>
			<?php } ?>
		</table>
		<div id="page">
			<?php echo $this->vars['page'];?>
		</div>
		<?php } ?>	
		
		<?php if($this->vars['showchild']){?>
		<table cellspacing="0">
			<tr><th>编号</th><th>投票项目</th><th>操作</th></tr>
			<?php foreach($this->vars['AllChildVote'] as $key=>$value){?>
			<tr>
				<td><?php echo $value->id ?></td>
				<td><?php echo $value->title ?></td>
				<td><a href="vote.php?action=update&id=<?php echo $value->id ?>">修改</a> | 
					<a href="vote.php?action=delete&id=<?php echo $value->id ?>" onclick="return confirm('你确定要删除投票吗')?true:false">删除</a></td>
			</tr>
			<?php } ?>
			<tr><td colspan="3">所属主题：<?php echo $this->vars['titlec'];?> <a href="vote.php?action=addchild&id=<?php echo $this->vars['id'];?>">[增加本项目]</a> <a href="vote.php?action=show">[返回列表]</a></td>
				
			</tr>
		</table>
		<div id="page">
			<?php echo $this->vars['page'];?>
		</div>
		<?php } ?>	
		
		<?php if($this->vars['add']){?>
		<form method="post" name="add">
			<table cellspacing="0" class="left">
				<tr><td>主题： <input type="text" name="title" class="text"/>（主题名称的长度必须在2~20位之间）</td></tr>
				<tr><td><textarea name="info"></textarea>（主题描述不得大于200位）</td></tr>
				<tr>
					<td>
						<input type="submit" name="send" value="新增主题" class="submit leval" onclick="return checkAddForm();"/>
						[<a href="?action=show">返回列表</a>]
					</td>
				</tr>
			</table>
		</form>
		<?php } ?>
		
		<?php if($this->vars['addchild']){?>
		<form method="post" name="add">
			<input type="hidden" name="id" value="<?php echo $this->vars['id'];?>" />
			<table cellspacing="0" class="left">
				<tr><td>所属主题： <strong><?php echo $this->vars['titlec'];?></strong></td></tr>
				<tr><td>投票项目： <input type="text" name="title" class="text"/>（投票项目名称的长度必须在2~20位之间）</td></tr>
				<tr><td>　　<textarea name="info"></textarea>（投票项目描述不得大于200位）</td></tr>
				<tr>
					<td>
						　　<input type="submit" name="send" value="新增投票项目" class="submit leval" onclick="return checkAddForm2();"/>
						[<a href="?action=show">返回列表</a>]
					</td>
				</tr>
			</table>
		</form>
		<?php } ?>
		
		<?php if($this->vars['update']){?>
		<form method="post" name="add">
			<input type="hidden" name="id" value="<?php echo $this->vars['id'];?>" />
			<table cellspacing="0" class="left">
				<tr><td>投票主题： <input type="text" name="title" class="text" value="<?php echo $this->vars['titlec'];?>"/></td></tr>
				<tr><td>　　<textarea name="info"><?php echo $this->vars['info'];?></textarea></td></tr>
				<tr>
					<td>
						　　<input type="submit" name="send" value="修改投票主题" class="submit leval" onclick="checkAddForm();"/>
						[<a href="leval.php?action=show">返回列表</a>]
					</td>
				</tr>
			</table>
		</form>	
		
		<?php } ?>
		
	</body>
</html>