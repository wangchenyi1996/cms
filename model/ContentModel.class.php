<?php
	//内容实体类
	class ContentModel extends model{
		private $id;		//	编号
		private $title;		//	标题
		private $nav;		//	栏目号
		private $attr;		//	属性
		private $tag;		//	标签
		private $keyword;	//	关键字
		private $thumbnail;	//	缩略图
		private $source;	//	文章来源
		private $author;	//	作者
		private $info;		//	简介
		private $content;	//	详细内容
		private $count;		//	浏览次数
		private $commend;	//	评论
		private $gold;		//	消费金币
		private $color;		//	标题颜色
		private $sort;		//	排序
		private $readlimit;	//	阅读权限
		
		private $limit;		//	分页
		
		private $inputkeyword;		//	分页
		
		//拦截器__set()
		public function __set($_key,$_value){
			$this->$_key=$_value;
		}
		//拦截器__get()
		public function __get($_key){
			return $this->$_key;
		}
		
		//获取按照关键字搜索的文档总记录数
		public function searchKeywordContentTotal(){
			$_sql="SELECT COUNT(*) 
					FROM  cms_content c,
						      cms_nav n
					WHERE c.nav=n.id
						AND
						c.keyword LIKE '%$this->inputkeyword%'
				  ";
			return parent::total($_sql);
		}
		//获取按照关键字搜索的文档
		public function searchKeywordContent(){
			$_sql="SELECT c.id,c.title,c.title t,c.nav,c.attr,c.keyword,c.thumbnail,c.info,
						c.count,c.date,
						n.nav_name
						FROM  cms_content c,
						      cms_nav n
						WHERE c.nav=n.id
						    AND
							c.keyword LIKE '%$this->inputkeyword%'
						ORDER BY c.date DESC
							$this->limit
					";
			return parent::all($_sql);	
		}
		
		//获取按照标题搜索的文档总记录数
		public function searchTitleContentTotal(){
			$_sql="SELECT COUNT(*) 
					FROM  cms_content c,
						      cms_nav n
					WHERE c.nav=n.id
						AND
						c.title LIKE '%$this->inputkeyword%'
				  ";
			return parent::total($_sql);
		}
		//获取按照标题搜索的文档
		public function searchTitleContent(){
			$_sql="SELECT c.id,c.title,c.title t,c.nav,c.attr,c.keyword,c.thumbnail,c.info,
						c.count,c.date,
						n.nav_name
						FROM  cms_content c,
						      cms_nav n
						WHERE c.nav=n.id
						    AND
							c.title LIKE '%$this->inputkeyword%'
						ORDER BY c.date DESC
							$this->limit
					";
			return parent::all($_sql);	
		}
		
		
		//获取每个主栏目对应的文档
		public function getNewNavList(){
			$_sql="SELECT id,title,date
						FROM cms_content
						WHERE nav IN (SELECT id FROM cms_nav WHERE pid='$this->nav')
						ORDER BY date DESC
						LIMIT 0,11
					";
			return parent::all($_sql);	
		}
		
		//获取最新的10条文档
		public function getNewList(){
			$_sql="SELECT id,title,date
						FROM cms_content
						ORDER BY date DESC
						LIMIT 0,8
					";
			return parent::all($_sql);	
		}
		
		//获取最新的1条头条
		public function getNewTop(){
			$_sql="SELECT id,title,info
						FROM cms_content
						WHERE attr LIKE '%头条%'
						ORDER BY date DESC
						LIMIT 1
					";
			return parent::One($_sql);	
		}
		//获取最新的第二条到第五条头条
		public function getNewTopList(){
			$_sql="SELECT id,title,info
						FROM cms_content
						WHERE attr LIKE '%头条%'
						ORDER BY date DESC
						LIMIT 1,4
					";
			return parent::all($_sql);	
		}
		
		//获取最新的4条图文资讯
		public function getPicList(){
			$_sql="SELECT id,title,thumbnail
						FROM cms_content
						WHERE 
							thumbnail<>''
						ORDER BY date DESC
						LIMIT 0,4
					";
			return parent::all($_sql);	
		}
		
		//获取本月评论总排行榜
		public function getMonthCommentList(){
			$_sql="SELECT ct.id,ct.title,ct.date
						FROM cms_content ct
						WHERE 
							MONTH(NOW())=DATE_FORMAT(ct.date,'%c') 
						ORDER BY (SELECT count(*) FROM cms_comment c WHERE c.cid=ct.id) DESC
						LIMIT 0,7
					";
			return parent::all($_sql);	
		}
		
		//获取本月热点(点击率)总排行榜
		public function getMonthHotList(){
			$_sql="SELECT id,title,date
						FROM cms_content
						WHERE 
							MONTH(NOW())=DATE_FORMAT(date,'%c') 
						ORDER BY count DESC
						LIMIT 0,7
					";
			return parent::all($_sql);	
		}
		
		//获取最新的7条推荐文档
		public function getNewRecList(){
			$_sql="SELECT id,title,date
						FROM cms_content
						WHERE 
							attr LIKE '%推荐%'
						ORDER BY date DESC
						LIMIT 0,7
					";
			return parent::all($_sql);	
		}
		
		//获取本月、本类、推荐 排行榜
		public function getMonthNavRec(){
			$_sql="SELECT id,title,date
						FROM cms_content
						WHERE 
							attr LIKE '%推荐%'
						AND
							MONTH(NOW())=DATE_FORMAT(date,'%c') 
						AND
							nav IN($this->nav)
						ORDER BY date DESC
						LIMIT 0,10
					";
			return parent::all($_sql);	
		}
		
		//获取本月、本类、热点 排行榜
		public function getMonthNavHot(){
			$_sql="SELECT ct.id,ct.title,ct.date
						FROM cms_content ct
						WHERE 
							MONTH(NOW())=DATE_FORMAT(date,'%c') 
						AND
							ct.nav IN($this->nav)
						ORDER BY (SELECT count(*) FROM cms_comment c WHERE c.cid=ct.id) DESC
						LIMIT 0,10
					";
			return parent::all($_sql);	
		}
		
		//获取本月、图文排行榜
		public function getMonthNavImg(){
			$_sql="SELECT id,title,date
						FROM cms_content
						WHERE 
							MONTH(NOW())=DATE_FORMAT(date,'%c') 
						AND
							nav IN($this->nav)
						ORDER BY date DESC
						LIMIT 0,8
					";
			return parent::all($_sql);	
		}
		
		//获取文档的总评论量排行榜
		public function getHotTwentyComment(){
			$_sql="SELECT ct.id,ct.title
						FROM cms_content ct
						ORDER BY (SELECT count(*) FROM cms_comment c WHERE c.cid=ct.id) DESC
						LIMIT 0,6
					";
			return parent::all($_sql);	
		}
		
		//累积文档的点击量
		public function setContentCount(){
			$_sql="UPDATE cms_content
						SET count=count+1
						WHERE id='$this->id' LIMIT 1 ";
			return parent::aud($_sql);	 
		}
		
		//获取主类下的子类的id
		public function getNavChildId(){
			$_sql="SELECT id
						FROM cms_nav 
						WHERE pid='$this->id'
					";
			return parent::all($_sql);	
		}
		
		//获取文档总记录数
		public function getListContentTotal(){
			$_sql="SELECT COUNT(*) 
					FROM  cms_content c,
						      cms_nav n
					WHERE c.nav=n.id
						AND
						  c.nav IN ($this->nav)
				  ";
			return parent::total($_sql);
		}
		
		//获取文档列表
		public function getListContent(){
			$_sql="SELECT c.id,c.title,c.nav,c.attr,c.keyword,c.thumbnail,c.info,
						c.count,c.date,
						n.nav_name
						FROM  cms_content c,
						      cms_nav n
						WHERE c.nav=n.id
						    AND
							c.nav IN ($this->nav)
						ORDER BY c.date ASC
							$this->limit
					";
			return parent::all($_sql);	
		}
		
		//获取单一的文档内容
		public function getOneContent(){
			$_sql="SELECT id,title,nav,attr,tag,
						  keyword,thumbnail, source,author,
						  info,content,commend,
						  count,gold,sort,readlimit,color,date
					FROM cms_content
					WHERE id='$this->id'
				  ";
			return parent::One($_sql);	
		}
		
		//新增文档内容
		public function addContent(){
			$_sql="INSERT INTO cms_content(
						title,nav,attr,tag,keyword,
						thumbnail,source,author,
						info,content,
						commend,count,gold,
						sort,readlimit,
						color,date
					)
				   VALUES(
				   		'$this->title','$this->nav','$this->attr','$this->tag',
				   		'$this->keyword','$this->thumbnail','$this->source',
				   		'$this->author','$this->info','$this->content','$this->commend',
				   		'$this->count','$this->gold','$this->sort','$this->readlimit',
				   		'$this->color', NOW()
				   		)";
			return parent::aud($_sql);
		}
		//修改文档内容
		public function updateContent(){
			$_sql="UPDATE cms_content
						SET 
						title='$this->title',
						nav='$this->nav',
						attr='$this->attr',
						tag='$this->tag',
						keyword='$this->keyword',
						thumbnail='$this->thumbnail',
						source='$this->source',
						author='$this->author',
						info='$this->info',
						content='$this->content',
						commend='$this->commend',
						count='$this->count',
						gold='$this->gold',
						sort='$this->sort',
						readlimit='$this->readlimit',
						color='$this->color'
						WHERE id='$this->id' LIMIT 1 ";
			return parent::aud($_sql);	 
		}
		//删除文档
		public function deleteContent(){
			$_sql="DELETE FROM cms_content WHERE id='$this->id' LIMIT 1 ";
						
			return parent::aud($_sql);	 
		}
		
		
	}
?>
