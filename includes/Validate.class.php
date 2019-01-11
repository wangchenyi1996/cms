<?php
	class Validate{
		
		//是否为空
		static public function checkNull($_date){
			if(trim($_date)==''){
				return true;
			}
			return false;
		}
		//长度是否一致
		static public function checkLength($_date,$_length,$_flag){
			if($_flag=='min'){
				if(mb_strlen(trim($_date),'utf-8')<$_length){
					return true;
				}
				return false;
			}elseif($_flag=='max'){
				if(mb_strlen(trim($_date),'utf-8')>$_length){
					return true;
				}
				return false;
			}elseif($_flag=='equals'){
				if(mb_strlen(trim($_date),'utf-8')!=$_length) return true;
				return false;
			}else{
				Tool::alertBack('参数传递错误，必须是min,max！');
			}
		}
		//数据是否一致
		static public function checkEquals($_date,$_otherdate){
			if(trim($_date)!=trim($_otherdate)){
				return ture;
			}
			return false;
		}
		//数据是否为数字
		static public function checkNum($_date){
			if(!is_numeric($_date)){
				return true;
			}
			return false;
		}
		//邮箱验证
		static public function checkEmail($_date){
			//参考一个邮箱	abcbbc@163.com
			if(!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/',$_date))return true;
			return false;
		}
		
		
		//session验证
		static public function checkSession(){
			if(!isset($_SESSION['admin'])){
				Tool::alertBack('非法登录！');
			}
		}
		
	}
?>