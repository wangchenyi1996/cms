<?php
	//等级实体类
	class LevalModel extends model{
		private $id;
		private $leval_info;
		private $leval_name;
		//拦截器__set()
		public function __set($_key,$_value){
			$this->$_key=$_value;
		}
		//拦截器__get()
		public function __get($_key){
			return $this->$_key;
		}
		
		//查询单个
		public function getOneLeval(){
			$_sql="SELECT id,leval_name,leval_info
						  FROM cms_leval
						  WHERE id='$this->id' OR leval_name='$this->leval_name'
						LIMIT 1";
			return parent::One($_sql);	
		}
		//查询所有
		public function getAllLeval(){
			$_sql="SELECT id,leval_name,leval_info
						  FROM  cms_leval 
						ORDER BY id ASC	
					";
			return parent::all($_sql);	
		}
		//新增
		public function addLeval(){
			$_sql="INSERT INTO cms_leval(
						leval_name,leval_info
					)
				   VALUES(
				   		'$this->leval_name',
				   		'$this->leval_info'
				   		)";
			return parent::aud($_sql);
		}
		//修改
		public function updateLeval(){
			$_sql="UPDATE cms_leval
						SET leval_name='$this->leval_name',
							leval_info='$this->leval_info'
						WHERE id='$this->id' LIMIT 1 ";
			return parent::aud($_sql);	 
		}
		//删除
		public function deleteLeval(){
			$_sql="DELETE FROM cms_leval
						WHERE id='$this->id' LIMIT 1 ";
			return parent::aud($_sql);		 
		}
	}
?>