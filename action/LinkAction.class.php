<?php
	class LinkAction extends Action{
		//构造方法初始化
		public function __construct(&$_tpl){
			parent::__construct($_tpl,new LinkModel());
			
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
				case 'state':
					$this->state();
					break;
				default:
					Tool::alertBack('非法操作！');
			}
		}
		//show
		private function show(){
			$_page=new Page($this->_model->getLinkTotal(),PAGE_SIZE);	
			$this->_model->limit=$_page->limit;
			$this->_tpl->assign('show',true);
			$this->_tpl->assign('title','友情链接列表');
			
			$_object=$this->_model->getAllLink();
			Tool::subStr($_object,'weburl',20,'utf-8');
			Tool::subStr($_object,'logourl',20,'utf-8');
			if($_object){
				foreach($_object as $_value){
					switch($_value->type){
						case 1:
						$_value->type='文字连接';
						break;
						case 2:
						$_value->type='logo连接';
						break;
					}
					if(empty($_value->state)){
						$_value->state='<span style="color:red">[未审核]</span> | <a href="link.php?action=state&type=ok&id='.$_value->id.'">通过</a>';
					}else{
						$_value->state='<span style="color:green">[通过]</span> | <a href="link.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
					}
				}
			}
			$this->_tpl->assign('AllLink',$_object);
			$this->_tpl->assign('page',$_page->showpage());
		}
		
		private function state(){
			if(isset($_GET['id'])){
			  $this->_model->id=$_GET['id'];
			  if(!$this->_model->getOneLink())Tool::alertBack('不存在此链接！');
			  if($_GET['type']=='ok'){
			  	if($this->_model->setStateOk()){
			  		Tool::alertBack('审核链接成功！');
			  	}else{
			  		Tool::alertBack('审核链接失败！');
			  	}
			  }elseif($_GET['type']=='cancel'){
			  	if($this->_model->setStateCancel()){
			  		Tool::alertBack('取消链接成功！');
			  	}else{
			  		Tool::alertBack('取消链接失败！');
			  	}
			  }else{
				Tool::alertBack('非法操作！');
			  }
			}
		}
		
		//add
		private function add(){
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
				$this->_model->webname=$_POST['webname'];
				$this->_model->weburl=$_POST['weburl'];
				$this->_model->logourl=$_POST['logourl'];
				$this->_model->user=$_POST['user'];
				$this->_model->type=$_POST['type'];
				$this->_model->state=$_POST['state'];
				$this->_model->addLink()?Tool::alertLocation('新增友情链接成功','link.php?action=show'):Tool::alertBack('很遗憾新增链接失败');
			}
			$this->_tpl->assign('add',true);
			$this->_tpl->assign('title','新增友情链接');
		}
		//update
		private function update(){
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
				$this->_model->id=$_POST['id'];
				$this->_model->webname=$_POST['webname'];
				$this->_model->weburl=$_POST['weburl'];
				$this->_model->logourl=$_POST['logourl'];
				$this->_model->user=$_POST['user'];
				$this->_model->type=$_POST['type'];
				$this->_model->state=$_POST['state'];
				
				$this->_model->updateLink()?Tool::alertLocation('修改友情链接成功','link.php?action=show'):Tool::alertBack('很遗憾修改链接失败');
			}
			if(isset($_GET['id'])){
				$this->_model->id=$_GET['id'];
				$_link=$this->_model->getOneLink();
				if(!$_link)Tool::alertBack('不存在此链接！');
				$this->_tpl->assign('webname',$_link->webname);
				$this->_tpl->assign('weburl',$_link->weburl);
				$this->_tpl->assign('logourl',$_link->logourl);
				$this->_tpl->assign('user',$_link->user);
				$this->_tpl->assign('type',$_link->type);
				$this->_tpl->assign('state',$_link->state);
				$this->_tpl->assign('update',true);
				$this->_tpl->assign('title','修改申请连接');
			}else{
				Tool::alertBack('非法操作！');
			}
		}
		//delete
		private function delete(){
			if(isset($_GET['id'])){
				$this->_model->id=$_GET['id'];
				$this->_model->deleteLink()?Tool::alertLocation('删除申请连接成功！','link.php?action=show'):Tool::alertBack('很遗憾，删除失败！');
			}else{
				Tool::alertBack('非法操作！');
			}
		}
		
	}
?>