<?php
	class LevalAction extends Action{
		
		//构造方法初始化
		public function __construct(&$_tpl){
			parent::__construct($_tpl,new LevalModel());
			
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
				default:
					Tool::alertBack('非法操作！');
			}
		}
		//show
		private function show(){
			$this->_tpl->assign('show',true);
			$this->_tpl->assign('title','等级列表');
			$this->_tpl->assign('AllLeval',$this->_model->getAllLeval());
		}
		//add
		private function add(){
			if(isset($_POST['send'])){
				if(Validate::checkNull($_POST['leval_name'])){
					Tool::alertBack('等级名称不能为空！');
				}
				if(Validate::checkLength($_POST['leval_name'],2,'min')){
					Tool::alertBack('等级名称不能小于2位！');
				}
				if(Validate::checkLength($_POST['leval_name'],20,'max')){
					Tool::alertBack('等级名称不能大于20位！');
				}
				if(Validate::checkLength($_POST['leval_info'],200,'max')){
					Tool::alertBack('等级描述不能大于200位！');
				}
				$this->_model->leval_name=$_POST['leval_name'];
				
				if($this->_model->getOneLeval()) Tool::alertBack('此等级名称已存在，请换个名称！');
				
				$this->_model->leval_info=$_POST['leval_info'];
				if($this->_model->addLeval()){
					Tool::alertLocation('新增等级成功！','leval.php?action=show');
				}else{
					Tool::alertBack('很遗憾，新增等级失败！');
				}
			}
			$this->_tpl->assign('add',true);
			$this->_tpl->assign('title','新增等级');
		}
		//update
		private function update(){
			if(isset($_POST['send'])){
				if(Validate::checkNull($_POST['leval_name'])){
					Tool::alertBack('等级名称不能为空！');
				}
				if(Validate::checkLength($_POST['leval_name'],2,'min')){
					Tool::alertBack('等级名称不能小于2位！');
				}
				if(Validate::checkLength($_POST['leval_name'],20,'max')){
					Tool::alertBack('等级名称不能大于20位！');
				}
				if(Validate::checkLength($_POST['leval_info'],200,'max')){
					Tool::alertBack('等级描述不能大于200位！');
				}
				
				$this->_model->id=$_POST['id'];
				$this->_model->leval_name=$_POST['leval_name'];
				$this->_model->leval_info=$_POST['leval_info'];
				$this->_model->updateLeval()?Tool::alertLocation('修改等级成功！','leval.php?action=show'):Tool::alertBack('很遗憾，修改等级失败！');
			}
			if(isset($_GET['id'])){
				$this->_model->id=$_GET['id'];
				is_object($this->_model->getOneLeval())?true:Tool::alertBack('等级传值的id有误！');
				$this->_tpl->assign('id',$this->_model->getOneLeval()->id);
				$this->_tpl->assign('leval_name',$this->_model->getOneLeval()->leval_name);
				$this->_tpl->assign('leval_info',$this->_model->getOneLeval()->leval_info);
				$this->_tpl->assign('update',true);
				$this->_tpl->assign('title','修改等级');
			}else{
				Tool::alertBack('id不存在！');
			}
		}
		//delete
		private function delete(){
			if(isset($_GET['id'])){
				$this->_model->id=$_GET['id'];
				$_manage=new manageModel();
				$_manage->_leval=$this->_model->id;
				if($_manage->getOneManage()) Tool::alertBack('此等级已由管理员使用，无法删除，请先删除相关用户！');
				$this->_model->deleteLeval()?Tool::alertLocation('删除等级成功！','leval.php?action=show'):Tool::alertBack('很遗憾，删除等级失败！');
			}else{
				Tool::alertBack('非法操作！');
			}
		}
		
	}
?>