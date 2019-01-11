<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>CMS内容管理系统</title>
		<link rel="stylesheet" type="text/css" href="style/base.css"/>
		<link rel="stylesheet" type="text/css" href="style/cast.css"/>
	</head>
	<body>
	<?php include 'header.inc.php';?>
	<div id="cast">
		<h2>调查投票</h2>
		<table cellspacing="1">
			<caption><?php echo $this->vars['VoteTitle'];?></caption>
			<tr><th>投票项目</th><th>图示比例</th><th>百分比</th><th>得票数</th></tr>
			<?php if($this->vars['VoteItem']){?>
			<?php foreach($this->vars['VoteItem'] as $key=>$value){?>
			<tr><td><?php echo $value->title ?></td><td style="text-align: left;"width="<?php echo $this->vars['_width'];?>px"><img src="image/b<?php echo $value->picnum ?>.jpg" style="width: <?php echo $value->picwidth ?>px;height: 21px;"/></td><td><?php echo $value->percent ?></td><td><?php echo $value->count ?></td></tr>
			<?php } ?>
			<?php } ?>
		</table>
	</div>
	
	<?php include 'footer.inc.php';?>
	</body>
</html>
