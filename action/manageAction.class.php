<?php
	class manageAction extends Action{
		
		//构造方法初始化
		public function __construct(&$_tpl){
			parent::__construct($_tpl,new manageModel());
			
		}
		
		public function _action(){
			switch($_GET['action']){
				case 'show':
					$this->show();
					break;
				case 'add':
					$this->add();
					break;
				case 'update':
					$this->update();
					break;
				case 'delete':
					$this->delete();
					break;
				case 'login':
					$this->login();
					break;
				case 'logout':
					$this->logout();
					break;
				default:
					Tool::alertBack('非法操作！');
			}
		}
		//login
		private function login(){
			if(isset($_POST['send'])){
				if(Validate::checkLength($_POST['code'],4,'equals')) Tool::alertBack('验证码必须为4位！');
				if(Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code'])) Tool::alertBack('验证码不正确！');
				
				if(Validate::checkNull($_POST['admin_user'])){
					Tool::alertBack('用户名不能为空！');
				}
				if(Validate::checkLength($_POST['admin_user'],2,'min')){
					Tool::alertBack('用户名不能小于2位！');
				}
				if(Validate::checkLength($_POST['admin_user'],20,'max')){
					Tool::alertBack('用户名不能大于20位！');
				}
				if(Validate::checkNull($_POST['admin_pass'])){
					Tool::alertBack('密码不能为空！');
				}
				if(Validate::checkLength($_POST['admin_pass'],6,'min')){
					Tool::alertBack('密码不能小于6位！');
				}
				$this->_model->_admin_user=$_POST['admin_user'];
				$this->_model->_admin_pass=sha1($_POST['admin_pass']);
				
				$_login=$this->_model->getLoginManage();
				if($_login){
					$_SESSION['admin']['admin_user']=$_login->admin_user;
					$_SESSION['admin']['leval_name']=$_login->leval_name;
					Tool::alertLocation(null,'admin.php');
				}else{
					Tool::alertBack('用户名或密码错误！');
				}
			}
		}
		//退出logout
		private function logout(){
			Tool::unSession();
			Tool::alertLocation(null,'admin_login.php');
		}
		
		//show
		private function show(){
			$_page=new Page($this->_model->getManageTotal(),PAGE_SIZE);	//echo $_page->total;
			$this->_model->limit=$_page->limit;
		
			$this->_tpl->assign('show',true);
			$this->_tpl->assign('title','管理员列表');
			$this->_tpl->assign('AllManage',$this->_model->getManage());
			
			$this->_tpl->assign('page',$_page->showpage());
		}
		//add
		private function add(){
			if(isset($_POST['send'])){
				if(Validate::checkNull($_POST['admin_user'])){
					Tool::alertBack('用户名不能为空！');
				}
				if(Validate::checkLength($_POST['admin_user'],2,'min')){
					Tool::alertBack('用户名不能小于2位！');
				}
				if(Validate::checkLength($_POST['admin_user'],20,'max')){
					Tool::alertBack('用户名不能大于20位！');
				}
				
				if(Validate::checkLength($_POST['admin_pass'],6,'min')){
					Tool::alertBack('密码不能小于6位！');
				}
				if(Validate::checkEquals($_POST['admin_pass'],$_POST['admin_notpass'])){
					Tool::alertBack('两次密码输入不一致！');
				}
				$this->_model->_admin_user=$_POST['admin_user'];
				if($this->_model->getOneManage()) Tool::alertBack('此用户已存在，请换个名称！');
				
				$this->_model->_admin_pass=sha1($_POST['admin_pass']);
				$this->_model->_leval=$_POST['leval'];
				if($this->_model->addManage()){
					Tool::alertLocation('新增管理员成功！','manage.php?action=show');
				}else{
					Tool::alertBack('很遗憾，新增管理员失败！');
				}
			}
			$this->_tpl->assign('add',true);
			$this->_tpl->assign('title','新增管理员');
			$_leval=new LevalModel();
			$this->_tpl->assign('AllLeval',$_leval->getAllLeval());
			
			/*$this->_tpl->assign('AllLeval',$this->_model->getAllLeval());*/
		}
		//update
		private function update(){
			if(isset($_POST['send'])){
				$this->_model->id=$_POST['id'];
				
				if(trim($_POST['admin_pass'])==''){
					$this->_model->_admin_pass=$_POST['pass'];
				}else{
					if(Validate::checkLength($_POST['admin_pass'],6,'min')){
						Tool::alertBack('密码不能小于6位！');
					}
					$this->_model->_admin_pass=sha1($_POST['admin_pass']);
				}
				
				$this->_model->_leval=$_POST['leval'];
				$this->_model->updateManage()?Tool::alertLocation('修改管理员成功！','manage.php?action=show'):Tool::alertBack('很遗憾，修改管理员失败！');
			}
			if(isset($_GET['id'])){
				$this->_model->id=$_GET['id'];
				is_object($this->_model->getOneManage())?true:Tool::alertBack('传值的id有误！');
				$this->_tpl->assign('id',$this->_model->getOneManage()->id);
				$this->_tpl->assign('leval',$this->_model->getOneManage()->leval);
				$this->_tpl->assign('admin_user',$this->_model->getOneManage()->admin_user);
				$this->_tpl->assign('admin_pass',$this->_model->getOneManage()->admin_pass);
				$this->_tpl->assign('update',true);
				$this->_tpl->assign('title','修改管理员');
				$_leval=new LevalModel();
				$this->_tpl->assign('AllLeval',$_leval->getAllLeval());
				/*$this->_tpl->assign('AllLeval',$this->_model->getAllLeval());*/
			}else{
				Tool::alertBack('id不存在！');
			}
		}
		//delete
		private function delete(){
			if(isset($_GET['id'])){
				$this->_model->id=$_GET['id'];
				$this->_model->deleteManage()?Tool::alertLocation('删除管理员成功！','manage.php?action=show'):Tool::alertBack('很遗憾，删除管理员失败！');
			}else{
				Tool::alertBack('非法操作！');
			}
		}
		
	}
?>