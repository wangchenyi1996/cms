<?php
	//模型基类
	class model{
		//执行多条SQL语句
		public function multi($_sql){
			$_db=DB::getDB();
			$_db->multi_query($_sql);
			DB::unDB($_result=null,$_db);
			return true;
		}
		
		//或取下一个增值id
		public function nextid($_table){
			$_sql="SHOW TABLE STATUS LIKE '$_table'";
			$_object=$this->One($_sql);
			return $_object->Auto_increment;	
		}
		
		//查找总记录数模型
		protected function total($_sql){
			$_db=DB::getDB();
			$_result=$_db->query($_sql);
			$_total=$_result->fetch_row();	
			DB::unDB($_result,$_db);
			return $_total[0];
		}
		
		//增删改模型
		protected function aud($_sql){
			$_db=DB::getDB();
			
			$_db->query($_sql);
			$_affected_rows=$_db->affected_rows;
			DB::unDB($_result=null,$_db);
			return $_affected_rows;
		}
		
		//查找单个管理员模型
		protected function One($_sql){
			$_db=DB::getDB();
			
			$_result=$_db->query($_sql);
			$_objects=$_result->fetch_object();
			DB::unDB($_result,$_db);
			return Tool::htmlString($_objects);
		}
		
		//查找所有管理员模型
		protected function all($_sql){
			$_db=DB::getDB();
			
			$_result=$_db->query($_sql);
			$_html=array();
			while(!!$_objects=$_result->fetch_object()){
				$_html[]=$_objects;
			}
			DB::unDB($_result,$_db);
			return Tool::htmlString($_html);
		}
	}
?>