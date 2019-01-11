<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>CMS内容管理系统</title>
		<link rel="stylesheet" type="text/css" href="style/base.css"/>
		<link rel="stylesheet" type="text/css" href="style/details.css"/>
		<script src="js/details.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
	<?php include 'header.inc.php';?>
	<div id="details">
		<h2>当前位置 &gt; <?php echo $this->vars['nav'];?></h2>
		<h3><?php echo $this->vars['titlec'];?></h3>
		<div class="d1">
			时间：<?php echo $this->vars['date'];?>&nbsp;&nbsp;来源：<?php echo $this->vars['source'];?>&nbsp;&nbsp;作者：<?php echo $this->vars['author'];?>&nbsp;&nbsp;点击量：<?php echo $this->vars['count'];?>次 
		</div>
		<div class="d2"><?php echo $this->vars['info'];?></div>
		<div class="d3"><?php echo $this->vars['content'];?></div>	
		<div class="d4">tag标签：<?php echo $this->vars['tag'];?></div>	
		<div class="d6">
			<h2><a href="feedback.php?cid=<?php echo $this->vars['id'];?>" target="_blank">已有<span style="color: red;"><?php echo $this->vars['comment'];?></span>人参与评论</a>最新评论</h2>
			
			<?php if($this->vars['NewThreeComment']){?>
			<?php foreach($this->vars['NewThreeComment'] as $key=>$value){?>
			<dl>
				<dt><img src="image/1.jpg"/></dt>
				<dd><em><?php echo $value->date ?>发表</em><span style="color: #06f;"><?php echo $value->user ?></span></dd>
				<dd class="info">（<?php echo $value->manner ?>） <?php echo $value->content ?></dd>
				<dd class="button">
					<a style="cursor: pointer;" href="feedback.php?cid=<?php echo $value->cid ?>&id=<?php echo $value->id ?>&type=sustain" target="_blank">[<?php echo $value->sustain ?>]支持</a> 
					<a href="feedback.php?cid=<?php echo $value->cid ?>&id=<?php echo $value->id ?>&type=oppose" target="_blank">[<?php echo $value->oppose ?>]反对</a> 
				</dd>
			</dl>
			<?php } ?>
			<?php }else{ ?>
				<dl>
					<dd>此文档没有任何评论</dd>
				</dl>
			<?php } ?>
				
		</div>	
		<div class="d5">
			<form action="feedback.php?cid=<?php echo $this->vars['id'];?>" target="_blank" method="post" name="comment">
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
		
	</div>
	<div id="sidebar">
		<div class="right">
			<h2>本类推荐</h2>
			<ul>
				<li><em>08-13</em><a href="###">菲律宾海军首次装备导弹...</a></li>
				<li><em>08-14</em><a href="###">印称“印藏边境警察部队”...</a></li>
				<li><em>08-15</em><a href="###">港台这两个组织结盟 扬言要“...”</a></li>
				<li><em>08-16</em><a href="###">解放军运8绕飞令台湾紧张 或...</a></li>
				<li><em>08-17</em><a href="###">台湾盛传解放军运8靠近...</a></li>
				<li><em>08-18</em><a href="###">台媒警示蔡英文：大陆会观察...</a></li>
				<li><em>08-19</em><a href="###">大陆国产航母海试 台军称要加速...</a></li>
				<li><em>08-20</em><a href="###">中国国产航母舰长公开亮相 ...</a></li>
				<li><em>08-21</em><a href="###">台军：大陆军机在台海以海战...</a></li>
			</ul>
		</div>
		<div class="right">
			<h2>本类热点</h2>
			<ul>
				<li><em>08-13</em><a href="###">菲律宾海军首次装备导弹...</a></li>
				<li><em>08-14</em><a href="###">印称“印藏边境警察部队”...</a></li>
				<li><em>08-15</em><a href="###">港台这两个组织结盟 扬言要“武力...”</a></li>
				<li><em>08-16</em><a href="###">解放军运8绕飞令台湾紧张 或...</a></li>
				<li><em>08-17</em><a href="###">台湾盛传解放军运8靠近...</a></li>
				<li><em>08-18</em><a href="###">台媒警示蔡英文：大陆会观察...</a></li>
				<li><em>08-19</em><a href="###">大陆国产航母海试 台军称要加速...</a></li>
				<li><em>08-20</em><a href="###">中国国产航母舰长公开亮相 ...</a></li>
				<li><em>08-21</em><a href="###">台军：大陆军机在台海以海战...</a></li>
			</ul>
		</div>
		<div class="right">
			<h2>本类图文</h2>
			<ul>
				<li><em>08-13</em><a href="###">菲律宾海军首次装备导弹...</a></li>
				<li><em>08-14</em><a href="###">印称“印藏边境警察部队”...</a></li>
				<li><em>08-15</em><a href="###">港台这两个组织结盟 扬言要“武力...”</a></li>
				<li><em>08-16</em><a href="###">解放军运8绕飞令台湾紧张 或...</a></li>
				<li><em>08-17</em><a href="###">台湾盛传解放军运8靠近...</a></li>
				<li><em>08-18</em><a href="###">台媒警示蔡英文：大陆会观察...</a></li>
				<li><em>08-19</em><a href="###">大陆国产航母海试 台军称要加速...</a></li>
				<li><em>08-20</em><a href="###">中国国产航母舰长公开亮相 ...</a></li>
				<li><em>08-21</em><a href="###">台军：大陆军机在台海以海战...</a></li>
			</ul>
		</div>
	</div>
	<?php include 'footer.inc.php';?>
	</body>
</html>
