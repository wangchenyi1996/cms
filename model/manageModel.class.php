<?php
	//管理员实体类
	class manageModel extends model{
		
		private $_admin_pass;
		private $_admin_user;
		private $_leval;
		private $id;
		
		private $limit;
		//拦截器__set()
		public function __set($_key,$_value){
			$this->$_key=$_value;
		}
		//拦截器__get()
		public function __get($_key){
			return $this->$_key;
		}
		/*//查询所有的等级
		public function getAllLeval(){
			$_sql="SELECT id,leval_name
						  FROM cms_leval
						  ORDER BY id ASC";
			return parent::all($_sql);
		}*/
		//获取管理员总记录数
		public function getManageTotal(){
			$_sql="SELECT COUNT(*) FROM cms_manage";
			return parent::total($_sql);
		}
		
		//查询登陆管理员
		public function getLoginManage(){
			$_sql="SELECT m.admin_user,l.leval_name
							 FROM cms_manage m,cms_leval l
							 WHERE m.admin_user='$this->_admin_user' 
							 		AND m.admin_pass='$this->_admin_pass'
							 		AND m.leval=l.id
							 LIMIT 1";
			return parent::One($_sql);	
		}
		
		//查询单个管理员
		public function getOneManage(){
			$_sql="SELECT id,admin_user,admin_pass,leval
						  FROM cms_manage 
						  WHERE id='$this->id' 
						  OR admin_user='$this->_admin_user'
						  OR leval='$this->_leval'
						LIMIT 1";
			return parent::One($_sql);	
		}
		//查询所有管理员
		public function getManage(){
			$_sql="SELECT m.id,m.admin_user,
						  m.login_count,
						  m.last_ip,m.last_time,
						  l.leval_name
						  FROM cms_manage m,
						  	   cms_leval l
						  WHERE m.leval=l.id
						ORDER BY m.id ASC	
						$this->limit
					";
			return parent::all($_sql);	
		}
		//新增管理员
		public function addManage(){
			$_sql="INSERT INTO cms_manage(
						admin_user,admin_pass,	
						leval,reg_time
					)
				   VALUES(
				   		'$this->_admin_user',
				   		'$this->_admin_pass',
				   		'$this->_leval',
				   		NOW()
				   		)";
			return parent::aud($_sql);
		}
		//修改管理员
		public function updateManage(){
			$_sql="UPDATE cms_manage
						SET admin_pass='$this->_admin_pass',
							leval='$this->_leval'
						WHERE id='$this->id' LIMIT 1 ";
			return parent::aud($_sql);	 
		}
		//删除管理员
		public function deleteManage(){
			$_sql="DELETE FROM cms_manage
						WHERE id='$this->id' LIMIT 1 ";
			return parent::aud($_sql);		 
		}
	}
?>