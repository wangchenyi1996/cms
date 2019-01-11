<?php
	//评论实体类
	class CommentModel extends model{
		private $user;
		private $content;
		private $manner;
		private $cid;
		
		private $limit;		//	分页
		private $states;	//批量审核
		
		//拦截器__set()
		public function __set($_key,$_value){
			$this->$_key=$_value;
		}
		//拦截器__get()
		public function __get($_key){
			return $this->$_key;
		}
		
		//删除
		public function deleteComment(){
			$_sql="DELETE FROM cms_comment
						WHERE id='$this->id' LIMIT 1";
			return parent::aud($_sql);		 
		}
		
		//批量审核
		public function setStates(){
			foreach($this->states as $_key=>$_value){
				if($_value>0)$_value=1;
				if($_value<=0)$_value=0;
				$_sql.="UPDATE cms_comment SET state='$_value' WHERE id='$_key';";
			}
			return parent::multi($_sql);
		}
		
		//通过审核
		public function setStateOk(){
			$_sql="UPDATE cms_comment
					SET state=1
					WHERE id='$this->id'
					LIMIT 1";
			return parent::aud($_sql);	
		}
		
		//取消通过审核
		public function setStateCancel(){
			$_sql="UPDATE cms_comment
					SET state=0
					WHERE id='$this->id'
					LIMIT 1";
			return parent::aud($_sql);	
		}
		
		//获取最火的三条评论
		public function getHotThreeComment(){
			$_sql="SELECT id,user,
						  manner,content,
						  cid,sustain,oppose,date
						FROM cms_comment
						WHERE cid='$this->cid'
						ORDER BY sustain+oppose DESC
						LIMIT 0,3
					";
			return parent::all($_sql);	
		}
		
		//获取最新的三条评论
		public function getNewThreeComment(){
			$_sql="SELECT id,user,
						  manner,content,
						  cid,sustain,oppose,date
						FROM cms_comment
						WHERE cid='$this->cid'
						ORDER BY date DESC
						LIMIT 0,3
					";
			return parent::all($_sql);	
		}
		
		//所有评论（后台）
		public function getCommentList(){
			$_sql="SELECT c.id,c.user,c.content,c.cid,
						  c.content full,
						  c.state,
						  c.state num,
						  ct.title
						FROM cms_comment c,
							 cms_content ct
						WHERE c.cid=ct.id
						ORDER BY c.date DESC
						$this->limit
					";
			return parent::all($_sql);	
		}
		
		//所有评论（前台）
		public function getAllComment(){
			$_sql="SELECT id,user,
						  manner,content,
						  cid,sustain,oppose,date
						FROM cms_comment
						WHERE cid='$this->cid'
						ORDER BY date DESC
						$this->limit
					";
			return parent::all($_sql);	
		}
		/*//所有评论
		public function getAllComment(){
			$_sql="SELECT c.user,c.manner,
						  c.content,c.date,
						  u.face
						FROM cms_comment c
						LEFT JOIN cms_user u
						ON c.user=u.user
						WHERE c.cid='$this->cid'
						$this->limit
					";
			return parent::all($_sql);	
		}*/
		
		//新增评论
		public function addComment(){
			$_sql="INSERT INTO cms_comment(
						user,content,manner,cid,
						date
					)
				   VALUES(
				   		'$this->user',
				   		'$this->content',
				   		'$this->manner',
				   		'$this->cid',
				   		NOW()
				   		)";
			return parent::aud($_sql);
		}
		
		//获取所有评论(前台)
		public function getCommentTotal(){
			$_sql="SELECT COUNT(*) 
					FROM cms_comment 
					WHERE cid='$this->cid'
				  ";
			return parent::total($_sql);
		}
		
		//获取所有评论（后台）
		public function getCommentListTotal(){
			$_sql="SELECT COUNT(*) 
					FROM cms_comment 
				  ";
			return parent::total($_sql);
		}
		
		//查找单一评论
		public function getOneComment(){
			$_sql="SELECT id 
					FROM cms_comment 
					WHERE id='$this->id'
					LIMIT 1
				  ";
			return parent::one($_sql);
		}
		
		//支持
		public function setSustain(){
			$_sql="UPDATE cms_comment
						SET sustain=sustain+1
						WHERE id='$this->id'
						LIMIT 1
					";
			return parent::aud($_sql);
		}
		//反对
		public function setOppose(){
			$_sql="UPDATE cms_comment
						SET oppose=oppose+1
						WHERE id='$this->id'
						LIMIT 1
					";
			return parent::aud($_sql);
		}
		
				
	}
?>