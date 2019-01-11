<?php
	//友情链接实体类
	class LinkModel extends model{
		private $id;
		private $webname;
		private $weburl;
		private $logourl;
		private $type;
		private $state;
		private $limit;
		
		//拦截器__set()
		public function __set($_key,$_value){
			$this->$_key=$_value;
		}
		//拦截器__get()
		public function __get($_key){
			return $this->$_key;
		}
		
		//显示所有文字链接
		public function getAllTextLink(){
			$_sql="SELECT webname,
						  weburl
						FROM cms_link
						WHERE type=1
						ORDER BY date ASC
					";
			return parent::all($_sql);	
		}
		//显示所有logo链接
		public function getAllLogoLink(){
			$_sql="SELECT webname,
						  weburl,
						  logourl
						FROM cms_link
						WHERE type=2
						ORDER BY date ASC
					";
			return parent::all($_sql);	
		}
		
		//显示前20条文字链接
		public function getTwentyTextLink(){
			$_sql="SELECT webname,
						  weburl
						FROM cms_link
						WHERE type=1
						ORDER BY date ASC
						LIMIT 0,15
					";
			return parent::all($_sql);	
		}
		//显示前9条logo链接
		public function getNineLogoLink(){
			$_sql="SELECT webname,
						  weburl,
						  logourl
						FROM cms_link
						WHERE type=2
						ORDER BY date ASC
						LIMIT 0,9
					";
			return parent::all($_sql);	
		}
		//确定首选
		public function setStateOk(){
			$_sql="UPDATE cms_link
					SET state=1
					WHERE id='$this->id'
					LIMIT 1";
			return parent::aud($_sql);	
		}
		//取消首选
		public function setStateCancel(){
			$_sql="UPDATE cms_link
					SET state=0
					WHERE state=1
					LIMIT 1";
			return parent::aud($_sql);	
		}
		
		//查询单个
		public function getOneLink(){
			$_sql="SELECT id,webname,weburl,logourl,
							user,type,state
						  FROM cms_link
						  WHERE id='$this->id'
						LIMIT 1";
			return parent::One($_sql);	
		}
		
		//获取链接总记录数
		public function getLinkTotal(){
			$_sql="SELECT COUNT(*) 
					FROM cms_link
					";
			return parent::total($_sql);
		}
		
		//查询所有链接
		public function getAllLink(){
			$_sql="SELECT id,webname,
						  weburl,weburl fullweburl,
						  logourl,logourl fulllogourl,
						  user,type,state
						FROM cms_link
						ORDER BY date ASC
						$this->limit
					";
			return parent::all($_sql);	
		}
		
		//删除
		public function deleteLink(){
			$_sql="DELETE FROM cms_link
						WHERE id='$this->id'";
			return parent::aud($_sql);		 
		}
		
		//新增链接
		public function addLink(){
			$_sql="INSERT INTO cms_link(
						webname,weburl,
						logourl,user,
						type,state,
						date
					)
				   VALUES(
				   		'$this->webname',
				   		'$this->weburl',
				   		'$this->logourl',
				   		'$this->user',
				   		'$this->type',
				   		'$this->state',
				   		NOW()
				   		)";
			return parent::aud($_sql);
		}
		
		//修改
		public function updateLink(){
			$_sql="UPDATE cms_link
						SET webname='$this->webname',
							weburl='$this->weburl',
							logourl='$this->logourl',
							user='$this->user',
							type='$this->type',
							state='$this->state'
						WHERE id='$this->id'
					    LIMIT 1 ";
			return parent::aud($_sql);	 
		}
		
		
	}
?>