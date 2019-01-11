<?php
	class RegisterAction extends Action{
		
		//构造方法初始化
		public function __construct(&$_tpl){
			parent::__construct($_tpl);
		}
		//执行
		public function _action(){
			switch($_GET['action']){
				case 'login':
					$this->login();
					break;
				case 'reg':
					$this->reg();
					break;
				case 'logout':
					$this->logout();
					break;
				default:
					Tool::alertBack('非法操作！');
			}	
		}
		
		//退出logout
		private function logout(){
			setcookie('user','',time()-1);
			//header('Location:./');
			header('Location:register.php?action=login');
		}
		
		//注册页面
		private function reg(){
			if(isset($_POST['send'])){
				parent::__construct($this->_tpl,new UserModel());
				if(Validate::checkNull($_POST['user'])){
					Tool::alertBack('用户名不能为空！');
				}
				if(Validate::checkLength($_POST['user'],2,'min')){
					Tool::alertBack('用户名不能小于2位！');
				}
				if(Validate::checkLength($_POST['user'],20,'max')){
					Tool::alertBack('用户名不能大于20位！');
				}
				if(Validate::checkNull($_POST['pass'])){
					Tool::alertBack('密码不能为空！');
				}
				if(Validate::checkLength($_POST['pass'],6,'min')){
					Tool::alertBack('密码不能小于6位！');
				}
				if(Validate::checkEquals($_POST['pass'],$_POST['notpass'])){
					Tool::alertBack('两次密码输入不一致！');
				}
				if(Validate::checkNull($_POST['email'])){
					Tool::alertBack('电子邮件不能为空！');
				}
				if(Validate::checkEmail($_POST['email'])){
					Tool::alertBack('电子邮件格式不正确！');
				}
				if(!Validate::checkNull($_POST['question'])&&!Validate::checkNull($_POST['answer'])){
					$this->_model->question=$_POST['question'];	
					$this->_model->answer=$_POST['answer'];	
				}
				if(Validate::checkLength($_POST['code'],4,'equals')) Tool::alertBack('验证码必须为4位！');
				if(Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code'])) Tool::alertBack('验证码不正确！');
				
				$this->_model->user=$_POST['user'];	
				$this->_model->pass=sha1($_POST['pass']);	
				$this->_model->email=$_POST['email'];	
				$this->_model->face=$_POST['face'];	
				$this->_model->time=time();	
				if($this->_model->checkUser())Tool::alertBack('用户名重复！');
				if($this->_model->checkEmail())Tool::alertBack('邮箱重复！');
				
				//$this->_model->addUser()?Tool::alertLocation('注册成功！','./'):Tool::alertBack('注册失败！');
				if($_user=$this->_model->addUser()){
					setcookie('user',$_user->user);
					setcookie('face',$_user->face);
					Tool::alertLocation('注册成功！','./');
				}else{
					Tool::alertBack('注册失败！');
				}
				
			}
			$this->_tpl->assign('reg',true);
			$this->_tpl->assign('OptionFace',range(1,20));
		}
		//登录
		private function login(){
			if(isset($_POST['send'])){
				parent::__construct($this->_tpl,new UserModel());
			    if(Validate::checkNull($_POST['user'])){
					Tool::alertBack('用户名不能为空！');
				}
				if(Validate::checkLength($_POST['user'],2,'min')){
					Tool::alertBack('用户名不能小于2位！');
				}
				if(Validate::checkLength($_POST['user'],20,'max')){
					Tool::alertBack('用户名不能大于20位！');
				}
				if(Validate::checkNull($_POST['pass'])){
					Tool::alertBack('密码不能为空！');
				}
				if(Validate::checkLength($_POST['pass'],6,'min')){
					Tool::alertBack('密码不能小于6位！');
				}
				if(Validate::checkLength($_POST['code'],4,'equals')) Tool::alertBack('验证码必须为4位！');
				if(Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code'])) Tool::alertBack('验证码不正确！');
				
				$this->_model->user=$_POST['user'];	
				$this->_model->pass=sha1($_POST['pass']);	
				if($_user=$this->_model->checkLogin()){	//生成cookie
					setcookie('user',$_user->user,time()+$_POST['time']);
					setcookie('face',$_user->face,time()+$_POST['time']);
					
					$this->_model->id=$_user->id;
					$this->_model->time=time();
					$this->_model->setLaterUser();
					//$_cookie=new Cookie('user',$this->_model->user,time()+$_POST['time']);
					//$_cookie->setCookie();
					header('Location:./');
				}else{
					Tool::alertBack('用户名或密码错误！');
				}
			}
			$this->_tpl->assign('login',true);
		}
		
		
	}
?>