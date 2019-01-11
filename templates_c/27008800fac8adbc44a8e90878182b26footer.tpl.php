<div id="link">
	<h2><span><a href="friendlink.php?action=frontshow" target="_blank">所有链接</a> | 
			  <a href="friendlink.php?action=frontadd" target="_blank">申请加入</a>
		</span>友情链接</h2>
	<ul>
		<?php if($this->vars['text']){?>
		<?php foreach($this->vars['text'] as $key=>$value){?>
		<li><a href="<?php echo $value->weburl ?>" target="_blank"><?php echo $value->webname ?></a></li>
		<?php } ?>
		<?php } ?>
		
		<!--<li><a href="###">新华网</a></li>
		<li><a href="###">央视网</a></li>
		<li><a href="###">腾讯网</a></li>
		<li><a href="###">中国日报</a></li>
		<li><a href="###">搜狐视频</a></li>
		<li><a href="###">优酷视频</a></li>
		<li><a href="###">中国青年网</a></li>
		<li><a href="###">新浪新闻</a></li>
		<li><a href="###">凤凰网</a></li>
		<li><a href="###">中国经济网</a></li>
		<li><a href="###">网易考拉</a></li>
		<li><a href="###">淘宝网</a></li>
		<li><a href="###">当当网</a></li>-->
		
	</ul>
	<dl>
		<?php if($this->vars['logo']){?>
		<?php foreach($this->vars['logo'] as $key=>$value){?>
		<dd><a href="<?php echo $value->weburl ?>" target="_blank"><img src="<?php echo $value->logourl ?>"/></a></dd>
		<?php } ?>
		<?php } ?>
		
		<!--<dd><a href="###" target="_blank"><img src="image/tencent.png"/></a></dd>
		<dd><a href="###" target="_blank"><img src="image/163.png"/></a></dd>
		<dd><a href="###" target="_blank"><img src="image/sina.png"/></a></dd>
		<dd><a href="###" target="_blank"><img src="image/yanshi.png"/></a></dd>
		<dd><a href="###" target="_blank"><img src="image/21cn.png"/></a></dd>
		<dd><a href="###" target="_blank"><img src="image/china.png"/></a></dd>
		<dd><a href="###" target="_blank"><img src="image/news.png"/></a></dd>
		<dd><a href="###" target="_blank"><img src="image/fenghuang.png"/></a></dd>-->
	</dl>
</div>

<div id="footer">
	<p>Powered by <span>YC60.COM</span> (C) 2004-2011 DesDev Inc. </p>
	<p>Copyright (C) 2004-2011 YC60CMS. <span>瓢城Web俱乐部</span> 版权所有</p>
</div>