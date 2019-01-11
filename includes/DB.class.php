<?php
	//数据库连接类
	class DB{
		
		//获取对象句柄
		static public function getDB(){
			$_mysqli=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
			if(mysqli_connect_errno()){
				echo '数据库连接错误,错误代码'.mysqli_connect_error();//判断数据库是否链接正确
			}
			$_mysqli->set_charset('utf8');//设置编码集
			return $_mysqli;//返回句柄
		}
		
		//清理
		static public function unDB(&$_result,&$_db){
			if(is_object($_result)){
				$_result->free();//清理结果集
				$_result=null;//销毁结果集对象
			}
			if(is_object($_db)){
				$_db->close();//关闭数据库
				$_db=null;	//销毁对象句柄
			}
		}
	}
?>