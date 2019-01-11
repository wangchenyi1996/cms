<?php
	class VoteAction extends Action{
		
		//构造方法初始化
		public function __construct(&$_tpl){
			parent::__construct($_tpl,new VoteModel());
			
		}
		
		public function _action(){
			switch($_GET['action']){
				case 'show':
					$this->show();
					break;
				case 'showchild':
					$this->showchild();
					break;
				case 'add':
					$this->add();
					break;
				case 'addchild':
					$this->addchild();
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
			$_page=new Page($this->_model->getVoteTotal(),PAGE_SIZE);	
			$this->_model->limit=$_page->limit;
			
			$this->_tpl->assign('show',true);
			$this->_tpl->assign('title','主题列表');
			$_object=$this->_model->getAllVote();
			if($_object){
				foreach($_object as $_value){
					if(empty($_value->state)){
						$_value->state='<span style="color:red">[否]</span> | <a href="vote.php?action=state&type=ok&id='.$_value->id.'">确定</a>';
					}else{
						$_value->state='<span style="color:green">[是]</span>';
					}
				}
			}
			$this->_tpl->assign('AllVote',$_object);
			$this->_tpl->assign('page',$_page->showpage());
		}
		private function state(){
			if(isset($_GET['id'])){
			  $this->_model->id=$_GET['id'];
			  if(!$this->_model->getOneVote())Tool::alertBack('不存在此投票！');
			  if($_GET['type']=='ok'){
			  	$this->_model->setStateCancel();
			  	if($this->_model->setStateOk()){
			  		Tool::alertBack('设置投票成功！');
			  	}else{
			  		Tool::alertBack('设置投票失败！');
			  	}
			  }else{
				Tool::alertBack('非法操作！');
			  }
			}
		}
		
		//showchild
		private function showchild(){
			if(isset($_GET['id'])){
				$this->_model->id=$_GET['id'];
				$_vote=$this->_model->getOneVote();
				if(!$_vote)Tool::alertBack('不存在此主题！');
				
				$_page=new Page($this->_model->getChildVoteTotal(),PAGE_SIZE);	
				$this->_model->limit=$_page->limit;
				$this->_tpl->assign('id',$_vote->id);
				$this->_tpl->assign('titlec',$_vote->title);
				$this->_tpl->assign('showchild',true);
				$this->_tpl->assign('title','投票项目列表');
				$this->_tpl->assign('AllChildVote',$this->_model->getAllChildVote());
				$this->_tpl->assign('page',$_page->showpage());
				
			}
		}
		//add
		private function add(){
			if(isset($_POST['send'])){
				$this->setAdd();
				if($this->_model->addVote()){
					Tool::alertLocation('新增主题成功！','?action=show');
				}else{
					Tool::alertBack('很遗憾，新增主题失败！');
				}
			}
			$this->_tpl->assign('add',true);
			$this->_tpl->assign('title','新增投票主题');
		}
		//新增投票项目
		private function addchild(){
			if(isset($_POST['send'])){
				$this->_model->vid=$_POST['id'];
				$this->setAdd();
				if($this->_model->addVote()){
					Tool::alertLocation('新增投票项目成功！','?action=showchild&id='.$this->_model->vid);
				}else{
					Tool::alertBack('很遗憾，新增投票项目失败！');
				}
			}
			if(isset($_GET['id'])){
				$this->_model->id=$_GET['id'];
				$_vote=$this->_model->getOneVote();
				if(!$_vote)Tool::alertBack('不存在此主题！');
				$this->_tpl->assign('addchild',true);
				$this->_tpl->assign('title','新增投票项目');
				$this->_tpl->assign('id',$_vote->id);
				$this->_tpl->assign('titlec',$_vote->title);
			}else{
				Tool::alertBack('非法操作！');
			}
		}
		//getadd
		public function setAdd(){
			if(Validate::checkNull($_POST['title'])){
				Tool::alertBack('标题名称不能为空！');
			}
			if(Validate::checkLength($_POST['title'],2,'min')){
				Tool::alertBack('标题名称不能小于2位！');
			}
			if(Validate::checkLength($_POST['title'],20,'max')){
				Tool::alertBack('标题名称不能大于20位！');
			}
			if(Validate::checkLength($_POST['info'],200,'max')){
				Tool::alertBack('描述不能大于200位！');
			}
			$this->_model->title=$_POST['title'];
			$this->_model->info=$_POST['info'];
		}
		
		//update
		private function update(){
			if(isset($_POST['send'])){
				$this->_model->id=$_GET['id'];
				$this->setAdd();
				$this->_model->updateVote()?Tool::alertLocation('修改成功！','vote.php?action=show'):Tool::alertBack('很遗憾，修改失败！');
			}
			if(isset($_GET['id'])){
				$this->_model->id=$_GET['id'];
				$_vote=$this->_model->getOneVote();
				if(!$_vote)Tool::alertBack('不存在此主题！');
				$this->_tpl->assign('id',$_vote->id);
				$this->_tpl->assign('titlec',$_vote->title);
				$this->_tpl->assign('info',$_vote->info);
				$this->_tpl->assign('update',true);
				$this->_tpl->assign('title','修改投票主题');
			}else{
				Tool::alertBack('非法操作！');
			}
		}
		
		//delete
		private function delete(){
			if(isset($_GET['id'])){
				$this->_model->id=$_GET['id'];
				$this->_model->deleteVote()?Tool::alertLocation('删除投票成功！','vote.php?action=show'):Tool::alertBack('很遗憾，删除投票失败！');
			}else{
				Tool::alertBack('非法操作！');
			}
		}
		
		
		
	}
?>