<?php
	class NavAction extends Action{
		
		//构造方法初始化
		public function __construct(&$_tpl){
			parent::__construct($_tpl,new NavModel());
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
				case 'showchild':
					$this->showchild();
					break;
				case 'addchild':
					$this->addchild();
					break;
				case 'sort':
					$this->sort();
					break;
				default:
					Tool::alertBack('非法操作！');
			}
		}
		//show
		private function show(){
			$_page=new Page($this->_model->getNavTotal(),PAGE_SIZE);	//echo $_page->total;
			$this->_model->limit=$_page->limit;
			$this->_tpl->assign('show',true);
			$this->_tpl->assign('title','导航列表');
			$this->_tpl->assign('AllNav',$this->_model->getAllNav());
			$this->_tpl->assign('page',$_page->showpage());
		}
		//add
		private function add(){
			if(isset($_POST['send'])){
				if(Validate::checkNull($_POST['nav_name'])){
					Tool::alertBack('导航名称不能为空！');
				}
				if(Validate::checkLength($_POST['nav_name'],2,'min')){
					Tool::alertBack('导航名称不能小于2位！');
				}
				if(Validate::checkLength($_POST['nav_name'],20,'max')){
					Tool::alertBack('导航名称不能大于20位！');
				}
				if(Validate::checkLength($_POST['nav_info'],200,'max')){
					Tool::alertBack('导航描述不能大于200位！');
				}
				$this->_model->nav_name=$_POST['nav_name'];
				$this->_model->nav_info=$_POST['nav_info'];
				$this->_model->pid=$_POST['pid'];
				if($this->_model->pid){
					$_returnurl='nav.php?action=showchild&id='.$this->_model->pid;
				}else{
					$_returnurl='nav.php?action=show';
				}
				
				if($this->_model->getOneNav()) Tool::alertBack('此导航名称已存在，请换个名称！');
				if($this->_model->addNav()){
					Tool::alertLocation('新增导航成功！',$_returnurl);
				}else{
					Tool::alertBack('很遗憾，新增导航失败！');
				}
			}
			$this->_tpl->assign('add',true);
			$this->_tpl->assign('title','新增导航');
		}
		//update
		private function update(){
			if(isset($_POST['send'])){
				if(Validate::checkNull($_POST['nav_name'])){
					Tool::alertBack('导航名称不能为空！');
				}
				if(Validate::checkLength($_POST['nav_name'],2,'min')){
					Tool::alertBack('导航名称不能小于2位！');
				}
				if(Validate::checkLength($_POST['nav_name'],20,'max')){
					Tool::alertBack('导航名称不能大于20位！');
				}
				if(Validate::checkLength($_POST['nav_info'],200,'max')){
					Tool::alertBack('导航描述不能大于200位！');
				}
				$this->_model->id=$_POST['id'];
				$this->_model->nav_name=$_POST['nav_name'];
				$this->_model->nav_info=$_POST['nav_info'];
				$this->_model->updateNav()?Tool::alertLocation('修改导航成功！','nav.php?action=show'):Tool::alertBack('很遗憾，修改导航失败！');
			}
			
			if(isset($_GET['id'])){
				$this->_model->id=$_GET['id'];
				is_object($this->_model->getOneNav())?true:Tool::alertBack('导航传值的id有误！');
				$this->_tpl->assign('id',$this->_model->getOneNav()->id);
				$this->_tpl->assign('nav_name',$this->_model->getOneNav()->nav_name);
				$this->_tpl->assign('nav_info',$this->_model->getOneNav()->nav_info);
				$this->_tpl->assign('update',true);
				$this->_tpl->assign('title','修改导航');
			}else{
				Tool::alertBack('id不存在！');
			}
		}
		//delete
		private function delete(){
			if(isset($_GET['id'])){
				$this->_model->id=$_GET['id'];
				$this->_model->deleteNav()?Tool::alertLocation('删除导航成功！','nav.php?action=show'):Tool::alertBack('很遗憾，删除导航失败！');
			}else{
				Tool::alertBack('非法操作！');
			}
		}
		//showchild
		private function showchild(){
			if(isset($_GET['id'])){
				$this->_model->id=$_GET['id'];
				is_object($this->_model->getOneNav())?true:Tool::alertBack('子导航传值的id有误！');
				
				$_page=new Page($this->_model->getNavChildTotal(),PAGE_SIZE);	
				$this->_model->limit=$_page->limit;
				$this->_tpl->assign('id',$this->_model->getOneNav()->id);
				$this->_tpl->assign('showchild',true);
				$this->_tpl->assign('title','子导航列表');
				$this->_tpl->assign('prev_name',$this->_model->getOneNav()->nav_name);
				$this->_tpl->assign('AllChildNav',$this->_model->getAllChildNav());
				$this->_tpl->assign('page',$_page->showpage());
			}
		}
		
		
		//addchild
		private function addchild(){
			if(isset($_GET['id'])){
				if(isset($_POST['send'])){
					$this->add();
				}
				$this->_model->id=$_GET['id'];
				is_object($this->_model->getOneNav())?true:Tool::alertBack('子导航传值的id有误！');
				$this->_tpl->assign('id',$this->_model->getOneNav()->id);
				$this->_tpl->assign('prev_name',$this->_model->getOneNav()->nav_name);
				$this->_tpl->assign('addchild',true);
				$this->_tpl->assign('title','新增子导航');
			}
		}
		//showFront
		public function showFront(){
			$this->_tpl->assign('FrontNav',$this->_model->getFrontNav());
		}
		//sort
		public function sort(){
			if(isset($_POST['send'])){
				$this->_model->sort=$_POST['sort'];
				if($this->_model->setNavSort())
				Tool::alertLocation('排序成功','nav.php?action=show');
			}
		}
		
	}
?>