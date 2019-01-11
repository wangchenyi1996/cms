<?php
	class DetailsAction extends Action{
		
		//构造方法初始化
		public function __construct(&$_tpl){
			parent::__construct($_tpl);
		}
		//执行
		public function _action(){
			$this->getDetails();			
		}
		//获取文档的详细内容
		private function getDetails(){
			if(isset($_GET['id'])){
				parent::__construct($this->_tpl,new ContentModel());
				$this->_model->id=$_GET['id'];
				$this->_model->setContentCount();
				$_content=$this->_model->getOneContent();
				
				$this->_tpl->assign('id',$_content->id);
				$this->_tpl->assign('titlec',$_content->title);
				$this->_tpl->assign('count',$_content->count);
				$this->_tpl->assign('date',$_content->date);
				$this->_tpl->assign('author',$_content->author);
				$this->_tpl->assign('source',$_content->source);
				$this->_tpl->assign('tag',$_content->tag);
				$this->_tpl->assign('info',$_content->info);
				$this->_tpl->assign('content',Tool::unHtml($_content->content));
				$this->getNav($_content->nav);
				
				$_comment=new CommentModel();
				$_comment->cid=$this->_model->id;
				$this->_tpl->assign('comment',$_comment->getCommentTotal());
				
				$_object=$_comment->getNewThreeComment();
				
				foreach($_object as $_value){
					switch($_value->manner){
						case -1:
							$_value->manner='反对';
							break;
						case 0:
							$_value->manner='中立';
							break;
						case 1:
							$_value->manner='支持';
							break;
					}
				}
				$this->_tpl->assign('NewThreeComment',$_object);
			}else{
				Tool::alertBack('非法操作,不存在此id');
			}
		}
		
		//获取前台显示导航
		public function getNav($_id){
			$_nav=new NavModel();
			$_nav->id=$_id;
			if($_nav->getOneNav()){
				//主导航
				if($_nav->getOneNav()->nnav_name) $_nav1='<a href="list.php?id='.$_nav->getOneNav()->iid.'">'.$_nav->getOneNav()->nnav_name.'</a> &gt;';
				$_nav2='<a href="list.php?id='.$_nav->getOneNav()->id.'">'.$_nav->getOneNav()->nav_name.'</a>';
				$this->_tpl->assign('nav',$_nav1.$_nav2);
				//子导航列表
				$this->_tpl->assign('childnav',$_nav->getAllChildFrontNav());
			}else{
				Tool::alertBack('此导航不存在！');
			}
		}
		
	}
?>