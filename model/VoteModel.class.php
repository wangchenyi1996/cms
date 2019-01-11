<?php
	//投票实体类
	class VoteModel extends model{
		private $id;
		private $info;
		private $title;
		private $vid;
		private $count;
		private $state;
		
		
		//拦截器__set()
		public function __set($_key,$_value){
			$this->$_key=$_value;
		}
		//拦截器__get()
		public function __get($_key){
			return $this->$_key;
		}
		
		//获取总票数
		public function getVoteSum(){
			$_sql="SELECT SUM(count) c FROM cms_vote
						  WHERE vid=(SELECT id FROM cms_vote WHERE state=1 LIMIT 1)";
			return parent::One($_sql);	
		}
		
		//累计投票
		public function setCount(){
			$_sql="UPDATE cms_vote
						SET count=count+1
						WHERE id='$this->id'";
			return parent::aud($_sql);	
		}
		
		//获取首选项
		public function getVoteItem(){
			$_sql="SELECT id,title,count
						  FROM cms_vote
						  WHERE vid=(SELECT id FROM cms_vote WHERE state=1 LIMIT 1)";
			return parent::all($_sql);	
		}
		
		//获取首选标题
		public function getVoteTitle(){
			$_sql="SELECT title
						  FROM cms_vote
						  WHERE state=1
						LIMIT 1";
			return parent::One($_sql);	
		}
		
		//确定投票首选
		public function setStateOk(){
			$_sql="UPDATE cms_vote
					SET state=1
					WHERE id='$this->id'
					LIMIT 1";
			return parent::aud($_sql);	
		}
		//取消首选
		public function setStateCancel(){
			$_sql="UPDATE cms_vote
					SET state=0
					WHERE state=1
					LIMIT 1";
			return parent::aud($_sql);	
		}
		
		//查询单个
		public function getOneVote(){
			$_sql="SELECT id,title,info
						  FROM cms_vote
						  WHERE id='$this->id'
						LIMIT 1";
			return parent::One($_sql);	
		}
		
		//获取投票项目总记录数
		public function getChildVoteTotal(){
			$_sql="SELECT COUNT(*) 
					FROM cms_vote
					WHERE vid='$this->id'";
			return parent::total($_sql);
		}
		
		//查询所有投票项目
		public function getAllChildVote(){
			$_sql="SELECT id,title
						FROM cms_vote
						WHERE vid='$this->id'
					";
			return parent::all($_sql);	
		}
		
		//获取投票总记录数
		public function getVoteTotal(){
			$_sql="SELECT COUNT(*) 
					FROM cms_vote
					WHERE vid=0";
			return parent::total($_sql);
		}
		
		//查询所有投票
		public function getAllVote(){
			$_sql="SELECT id,title,state
						FROM cms_vote
						WHERE vid=0
						ORDER BY date ASC
						$this->limit
					";
			return parent::all($_sql);	
		}
		
		//新增
		public function addVote(){
			$_sql="INSERT INTO cms_vote(
						title,info,vid,date
					)
				   VALUES(
				   		'$this->title',
				   		'$this->info',
				   		'$this->vid',
				   		Now()
				   		)";
			return parent::aud($_sql);
		}
		
		//删除
		public function deleteVote(){
			$_sql="DELETE FROM cms_vote
						WHERE id='$this->id' 
								OR vid='$this->id'";
			return parent::aud($_sql);		 
		}
		
		//修改
		public function updateVote(){
			$_sql="UPDATE cms_vote
						SET title='$this->title',
							info='$this->info'
						WHERE id='$this->id' LIMIT 1 ";
			return parent::aud($_sql);	 
		}
		
	}
?>