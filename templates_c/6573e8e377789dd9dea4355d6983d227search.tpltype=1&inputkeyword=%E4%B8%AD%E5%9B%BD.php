<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>CMS内容管理系统</title>
		<link rel="stylesheet" type="text/css" href="style/base.css"/>
		<link rel="stylesheet" type="text/css" href="style/list.css"/>
	</head>
	<body>
	<?php include 'header.inc.php';?>
	<div id="list">
		<h2>当前位置 &gt; 搜索</h2>
		<?php if($this->vars['SearchContent']){?>
		<?php foreach($this->vars['SearchContent'] as $key=>$value){?>
		<dl>
			<dt><a href="details.php?id=<?php echo $value->id ?>" target="_blank">
				<img src="<?php echo $value->thumbnail ?>" alt="<?php echo $value->t ?>"/></a></dt>
			<dd>[<strong><?php echo $value->nav_name ?></strong>] 
				<a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?>......</a>
			</dd>
			<dd>日期：<?php echo $value->date ?> 点击量：<?php echo $value->count ?>次   关键字：[<?php echo $value->keyword ?>]</dd>
			<dd><?php echo $value->info ?>......</dd>
		</dl>
		<?php } ?>
		<?php }else{ ?>
		<p style="padding: 20px;text-align: center;border-bottom: #CCCCCC dashed 1px;">该类下没有数据</p>
		<?php } ?>
		<div id="page">
			<?php echo $this->vars['page'];?>
		</div>
	</div>
	<div id="sidebar">
		<div class="right">
			<h2>本月推荐</h2>
			<?php if($this->vars['MonthNavRec']){?>
			<?php foreach($this->vars['MonthNavRec'] as $key=>$value){?>
			<ul>
				<li><em><?php echo $value->date ?></em><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?>. . .</a></li>
			</ul>
			<?php } ?>
			<?php } ?>
		</div>
		
		<div class="right">
			<h2>本月热点</h2>
			<?php if($this->vars['MonthNavHot']){?>
			<?php foreach($this->vars['MonthNavHot'] as $key=>$value){?>
			<ul>
				<li><em><?php echo $value->date ?></em><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?>. . .</a></li>
			</ul>
			<?php } ?>
			<?php } ?>
		</div>
		
		<div class="right">
			<h2>本月图文</h2>
			<?php if($this->vars['MonthNavImg']){?>
			<?php foreach($this->vars['MonthNavImg'] as $key=>$value){?>
			<ul>
				<li><em><?php echo $value->date ?></em><a href="details.php?id=<?php echo $value->id ?>" target="_blank"><?php echo $value->title ?>. . .</a></li>
			</ul>
			<?php } ?>
			<?php } ?>

		</div>
	</div>
	<?php include 'footer.inc.php';?>
	</body>
</html>
