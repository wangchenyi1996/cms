<?php
	class FriendLinkAction extends Action{
		
		//构造方法初始化
		public function __construct(&$_tpl){
			parent::__construct($_tpl,new LinkModel());
			
		}
		
		public function _action(){
			switch($_GET['action']){
				case 'frontshow':
					$this->frontshow();
					break;
				case 'frontadd':
					$this->frontadd();
					break;
				default:
					Tool::alertBack('非法操作！');
			}
		}
		
		//index
		public function index(){
			$this->text();
			$this->logo();
		}
		
		//text
		public function text(){
			$this->_tpl->assign('text',$this->_model->getTwentyTextLink());
		}
		
		//img
		public function logo(){
			$this->_tpl->assign('logo',$this->_model->getNineLogoLink());
		}
		
		//frontshow
		public function frontshow(){
			$this->_tpl->assign('frontshow',true);
			$this->_tpl->assign('alltext',$this->_model->getAllTextLink());
			$this->_tpl->assign('alllogo',$this->_model->getAllLogoLink());
		}
		
		//frontadd
		private function frontadd(){
			if(isset($_POST['send'])){
				if(Validate::checkNull($_POST['webname']))Tool::alertBack('网站名称不能为空！');
				if(Validate::checkLength($_POST['webname'],20,'max'))Tool::alertBack('网站名称不能大于20位！');
				if(Validate::checkNull($_POST['weburl']))Tool::alertBack('网站地址不能为空！');
				if(Validate::checkLength($_POST['weburl'],100,'max'))Tool::alertBack('网站地址不能大于100位！');
				if($_POST['type']==2){
					if(Validate::checkNull($_POST['logourl']))Tool::alertBack('LOGO地址不能为空！');
					if(Validate::checkLength($_POST['logourl'],100,'max'))Tool::alertBack('LOGO地址不能大于100位！');
				}
				if(Validate::checkLength($_POST['user'],20,'max'))Tool::alertBack('站长名称不能大于20位！');
				if(Validate::checkLength($_POST['code'],4,'equals')) Tool::alertBack('验证码必须为4位！');
				if(Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code'])) Tool::alertBack('验证码不正确！');
				$this->_model->webname=$_POST['webname'];
				$this->_model->weburl=$_POST['weburl'];
				$this->_model->logourl=$_POST['logourl'];
				$this->_model->user=$_POST['user'];
				$this->_model->type=$_POST['type'];
				$this->_model->state=$_POST['state'];
				$this->_model->addLink()?Tool::alertClose('申请友情链接成功,请等待审核。'):Tool::alertBack('很遗憾申请链接失败');
			}
			$this->_tpl->assign('frontadd',true);
		}
		
		
	}
?>