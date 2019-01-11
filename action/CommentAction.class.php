<?php
	class CommentAction extends Action{
		
		//构造方法初始化
		public function __construct(&$_tpl){
			parent::__construct($_tpl,new CommentModel());
			
		}
		
		public function _action(){
			switch($_GET['action']){
				case 'show':
					$this->show();
					break;
				case 'delete':
					$this->delete();
					break;
				case 'state':
					$this->state();
					break;
				case 'states':
					$this->states();
					break;
				default:
					Tool::alertBack('非法操作！');
			}
		}
		//show
		private function show(){
			$_page=new Page($this->_model->getCommentListTotal(),PAGE_SIZE);	
			$this->_model->limit=$_page->limit;
		
			$this->_tpl->assign('show',true);
			$this->_tpl->assign('title','文档评论列表');
			
			$_object=$this->_model->getCommentList();	
			if($_object){
				foreach($_object as $_value){
					if(empty($_value->state)){
						$_value->state='<span style="color:red;">[未审核]</span> | <a href="comment.php?action=state&type=ok&id='.$_value->id.'">通过</a>';
					}else{
						$_value->state='<span style="color:green;">[已审核]</span> | <a href="comment.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
					}
				}
			}
			
			Tool::subStr($_object,'content',25,'utf-8');	
			$this->_tpl->assign('CommentList',$_object);
			$this->_tpl->assign('page',$_page->showpage());
		}
		
		//delete
		private function delete(){
			if(isset($_GET['id'])){
				$this->_model->id=$_GET['id'];
				$this->_model->deleteComment()?Tool::alertBack('删除评论成功！'):Tool::alertBack('很遗憾，删除评论失败！');
			}else{
				Tool::alertBack('非法操作！');
			}
		}
		
		//state（单个）审核
		private function state(){
			if(isset($_GET['id'])){
			  $this->_model->id=$_GET['id'];
			  if(!$this->_model->getOneComment())Tool::alertBack('不存在此评论！');
			  if($_GET['type']=='ok'){
			  	if($this->_model->setStateOk()){
			  		Tool::alertBack('审核成功！');
			  	}else{
			  		Tool::alertBack('审核失败！');
			  	}
			  }elseif($_GET['type']=='cancel'){
			  	if($this->_model->setStateCancel()){
			  		Tool::alertBack('取消审核成功！');
			  	}else{
			  		Tool::alertBack('取消审核失败！');
			  	}
			  }else{
				Tool::alertBack('非法操作！');
			  }
			}else{
				Tool::alertBack('非法操作！');
			}
		}
		//批量审核states
		public function states(){
			if(isset($_POST['send'])){
				$this->_model->states=$_POST['states'];
				if($this->_model->setStates()){
					Tool::alertBack('批量审核成功');
				}
			}
		}
		
		
	}
?>