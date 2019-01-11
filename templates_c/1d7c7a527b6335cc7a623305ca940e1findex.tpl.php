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
	<?php include 'header.inc.php';?>
		<div id="user">
			<?php if($this->vars['login']){?>
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
			<?php }else{ ?>
			<h2>会员信息</h2>
			<div class="a">您好,<strong><?php echo $this->vars['user'];?>! </strong>欢迎光临</div>
			<div class="b">
				<img src="image/<?php echo $this->vars['face'];?>" alt="<?php echo $this->vars['user'];?>"/>
				<a href="###">个人中心</a>
				<a href="###">我的评论</a>
				<a href="register.php?action=logout">退出</a>
			</div>
			<?php } ?>
			<h3>最近登录会员 <span>--------------------------------</span></h3>
			<?php if($this->vars['AllLaterUser']){?>
			<?php foreach($this->vars['AllLaterUser'] as $key=>$value){?>
			<dl>
				<dt><img src="image/<?php echo $value->face ?>" alt="<?php echo $value->user ?>" /></dt>
				<dd><?php echo $value->user ?></dd>
			</dl>
			<?php } ?>
			<?php } ?>
		</div>
		
		<div id="news">
			<h3><a href="details.php?id=<?php echo $this->vars['TopId'];?>" target="_blank"><?php echo $this->vars['TopTitle'];?>...</a></h3>
			<p>核心提示： <?php echo $this->vars['info'];?>...[<a href="details.php?id=<?php echo $this->vars['TopId'];?>" target="_blank">查看全文</a>]
			</p>
			<p class="link">
				<?php if($this->vars['NewTopList']){?>
				<?php foreach($this->vars['NewTopList'] as $key=>$value){?>
				<a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?>. . .</a>
				<?php } ?>
				<?php } ?>
			</p>
			<ul>
				<?php if($this->vars['NewList']){?>
				<?php foreach($this->vars['NewList'] as $key=>$value){?>
				  <li><em><?php echo $value->date ?></em><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?>. . .</a></li>
				<?php } ?>
				<?php } ?>
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
				<?php if($this->vars['NewRecList']){?>
				<?php foreach($this->vars['NewRecList'] as $key=>$value){?>
				<li><em><?php echo $value->date ?></em><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?>. . .</a></li>
				<?php } ?>
				<?php } ?>
			</ul>
			
		</div>
		
		<div id="sidebar-right">
			<!--<div class="adver"><img src="image/adver2.png"/></div>-->
			<div class="adver"><script src="js/sidebar_adver.js" type="text/javascript" charset="utf-8"></script></div>
			<div class="hot">
				<h2>本月热点</h2>
				<ul>
					<?php if($this->vars['MonthHotList']){?>
					<?php foreach($this->vars['MonthHotList'] as $key=>$value){?>
					  <li><em><?php echo $value->date ?></em><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?>. . .</a></li>
					<?php } ?>
					<?php } ?>
				</ul>
			</div>
			<div class="comm">
				<h2>本月评论</h2>
				<ul>
					<?php if($this->vars['MonthCommentList']){?>
					<?php foreach($this->vars['MonthCommentList'] as $key=>$value){?>
					  <li><em><?php echo $value->date ?></em><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?>. . .</a></li>
					<?php } ?>
					<?php } ?>
				</ul>
			</div>
			<div class="vote">
			<h2>调查投票</h2>
			<h3><?php echo $this->vars['VoteTitle'];?></h3>
			<form method="post" action="cast.php" target="_blank">
				<?php if($this->vars['VoteItem']){?>
				<?php foreach($this->vars['VoteItem'] as $key=>$value){?>
				<label><input type="radio" value="<?php echo $value->id ?>" name="vote"/><?php echo $value->title ?></label>
				<?php } ?>
				<?php } ?>
				<p>
					<input type="submit" value="投票" name="send"/>
					<input type="button" value="查看" onclick="javascript:window.open('cast.php')" />
				</p>
			</form>
			</div>
		</div>
		<div id="picnews">
			<h2>图文资讯</h2>
				<?php if($this->vars['PicList']){?>
				<?php foreach($this->vars['PicList'] as $key=>$value){?>
				<dl>
				  <dt>
				  	<a href="details.php?id=<?php echo $value->id ?>" target="_blank">
				  	<img src="<?php echo $value->thumbnail ?>"/>
				  	</a>
				  </dt>
				  <dd><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?>. . .
				  	</a>
				  </dd>
				 </dl>
				<?php } ?>
				<?php } ?>
		</div>
		<div id="newslist">
			<?php if($this->vars['FourNav']){?>
			<?php foreach($this->vars['FourNav'] as $key=>$value){?>
			<div class="<?php echo $value->class ?>">
				<h2><a href="list.php?id=<?php echo $value->id ?>" target="_blank">更多</a><?php echo $value->nav_name ?></h2>
				<ul>
					<?php foreach($value->list as $key=>$value){?>
					<li><em><?php echo $value->date ?></em><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?>. . .</a></li>
					<?php } ?>
				</ul>
			</div>
			<?php } ?>
			<?php } ?>
		</div>
		<?php include 'footer.inc.php';?>
	</body>
</html>
