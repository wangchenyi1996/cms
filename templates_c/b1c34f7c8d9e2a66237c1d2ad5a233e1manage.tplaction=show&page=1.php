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
			管理首页 &gt;&gt; 管理员管理&gt;&gt; <strong id="title"><?php echo $this->vars['title'];?></strong>
		</div>
		<ol>
			<li><a href="manage.php?action=show" class="selected">管理员列表</a></li>
			<li><a href="manage.php?action=add">新增管理员</a></li>
			<?php if($this->vars['update']){?>
				<li><a href="manage.php?action=update&id=<?php echo $this->vars['id'];?>">修改管理员</a></li>
			<?php } ?>
		</ol>
		
		<?php if($this->vars['show']){?>
		<table cellspacing="0">
			<tr><th>编号</th><th>用户名</th><th>等级</th><th>登录次数</th><th>最近登录ip</th><th>最后登录时间</th><th>操作</th></tr>
			<?php foreach($this->vars['AllManage'] as $key=>$value){?>
			<tr>
				<td><?php echo $value->id ?></td>
				<td><?php echo $value->admin_user ?></td>
				<td><?php echo $value->leval_name ?></td>
				<td><?php echo $value->login_count ?></td>
				<td><?php echo $value->last_ip ?></td>
				<td><?php echo $value->last_time ?></td>
				<td><a href="manage.php?action=update&id=<?php echo $value->id ?>">修改</a> | 
					<a href="manage.php?action=delete&id=<?php echo $value->id ?>" onclick="return confirm('你确定要删除管理员吗')?true:false">删除</a></td>
			</tr>
			<?php } ?>
		</table>
		<div id="page">
			<?php echo $this->vars['page'];?>
		</div>
		<?php } ?>	
		
		<?php if($this->vars['add']){?>
		<form method="post" name="add">
			<table cellspacing="0" class="left">
				<tr><td>用 户 名&nbsp;： <input type="text" name="admin_user" class="text"/>（*长度在2~20位之间）</td></tr>
				<tr><td>密 &nbsp;    &nbsp;&nbsp;码&nbsp;： <input type="password" name="admin_pass" class="text"/>（*长度不得小于6位）</td></tr>
				<tr><td>确认密码：<input type="password" name="admin_notpass" class="text"/>（*必须同密码一致）</td></tr>
				<tr><td>等  &nbsp;&nbsp; 级&nbsp;&nbsp;： <select name="leval">
							<?php foreach($this->vars['AllLeval'] as $key=>$value){?>
							<option value="<?php echo $value->id ?>"><?php echo $value->leval_name ?></option>
							<?php } ?>
							</select>
				</td></tr>
				<tr>
					<td>
						<input type="submit" name="send" value="新增管理员" class="submit" onclick="return checkAddForm();"/>
						[<a href="manage.php?action=show">返回列表</a>]
					</td>
				</tr>
			</table>
		</form>
		<?php } ?>
		
		<?php if($this->vars['update']){?>
			<form method="post" name="update">
			<input type="hidden" value="<?php echo $this->vars['id'];?>" name="id" />
			<input type="hidden" value="<?php echo $this->vars['leval'];?>" id="leval" />
			<input type="hidden" value="<?php echo $this->vars['admin_pass'];?>" name="pass" />
			<table cellspacing="0" class="left">
				<tr><td>用户名： <input type="text" readonly="readonly" name="admin_user" class="text" value="<?php echo $this->vars['admin_user'];?>"/></td></tr>
				<tr><td>密    &nbsp;码&nbsp;： <input type="password" name="admin_pass" class="text"/>（*留空，则不修改。）</td></tr>
				<tr><td>等  &nbsp;级&nbsp;： <select name="leval">
							<?php foreach($this->vars['AllLeval'] as $key=>$value){?>
							<option value="<?php echo $value->id ?>"><?php echo $value->leval_name ?></option>
							<?php } ?>
							</select>
				</td></tr>
				<tr>
					<td>
						<input type="submit" name="send" value="修改管理员" class="submit" onclick="return checkUpdateForm();"/>
						[<a href="manage.php?action=show">返回列表</a>]
					</td>
				</tr>
			</table>
		</form>
		<?php } ?>
		
	</body>
</html>