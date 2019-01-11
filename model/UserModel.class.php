<?php
	//会员实体类
	class UserModel extends model{
		private $id;
		private $user;
		private $pass;
		private $email;
		private $question;
		private $answer;
		private $face;
		private $time;
		
		//拦截器__set()
		public function __set($_key,$_value){
			$this->$_key=$_value;
		}
		//拦截器__get()
		public function __get($_key){
			return $this->$_key;
		}
		
		//获取最近6个登录的会员
		public function getLaterUser(){
			$_sql="SELECT user,face
					FROM cms_user
				   	ORDER BY time DESC
				   	LIMIT 0,6";
			return parent::all($_sql);
		}
		
		//更新最近的登录时间戳（登录和注册）
		public function setLaterUser(){
			$_sql="UPDATE cms_user
					SET time='$this->time'
					WHERE id='$this->id'
				   	LIMIT 1";
			return parent::aud($_sql);
		}
		
		//用户名重复
		public function checkUser(){
			$_sql="SELECT id
					FROM cms_user
					WHERE user='$this->user'
				   	LIMIT 1";
			return parent::One($_sql);
		}
		
		//邮箱重复
		public function checkEmail(){
			$_sql="SELECT id
					FROM cms_user
					WHERE email='$this->email'
				   	LIMIT 1";
			return parent::One($_sql);
		}
		
		//检查登录
		public function checkLogin(){
			$_sql="SELECT id,user,pass,face
					FROM cms_user
					WHERE user='$this->user' AND pass='$this->pass'
				   	LIMIT 1";
			return parent::One($_sql);
		}
		
		//新增会员
		public function addUser(){
			$_sql="INSERT INTO cms_user(
						user,pass,email,face,
						question,answer,
						time,date
					)
				   VALUES(
				   		'$this->user',
				   		'$this->pass',
				   		'$this->email',
				   		'$this->face',
				   		'$this->question',
				   		'$this->answer',
				   		'$this->time',
				   		NOW()
				   		)";
			return parent::aud($_sql);
		}
		
		
	}
?>