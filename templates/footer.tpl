<div id="link">
	<h2><span><a href="friendlink.php?action=frontshow" target="_blank">所有链接</a> | 
			  <a href="friendlink.php?action=frontadd" target="_blank">申请加入</a>
		</span>友情链接</h2>
	<ul>
		{if $text}
		{foreach $text(key,value)}
		<li><a href="{@value->weburl}" target="_blank">{@value->webname}</a></li>
		{/foreach}
		{/if}
		
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
		{if $logo}
		{foreach $logo(key,value)}
		<dd><a href="{@value->weburl}" target="_blank"><img src="{@value->logourl}"/></a></dd>
		{/foreach}
		{/if}
		
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
	<p>Powered by <span>YC60.COM</span> (C) 2017-2018  </p>
	<p>Copyright (C) 2017-2018 YC60CMS. <span>版权@王强所有</p>
</div>