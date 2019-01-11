<?php
	class FeedBackAction extends Action{
		
		//构造方法初始化
		public function __construct(&$_tpl){
			parent::__construct($_tpl);
		}
		//执行方法
		public function _action(){
			$this->addComment();
			$this->setCount();
			$this->showComment();
		}
		
		//新增一条评论
		public function addComment(){
			if(isset($_POST['send'])){
				if(Validate::checkNull($_POST['content'])){
					Tool::alertClose('评论内容不能为空！');
				}
				if(Validate::checkLength($_POST['content'],250,'max')){
					Tool::alertClose('评论内容大于250位！');
				}
				if(Validate::checkLength($_POST['code'],4,'equals')) Tool::alertClose('验证码必须为4位！');
				if(Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code'])) Tool::alertClose('验证码不正确！');
				parent::__construct($this->_tpl,new CommentModel());
				if(isset($_COOKIE['user'])){
					//if($this->_model->addComment()){
					$this->_model->user='会员';
				}else{
					$this->_model->user='游客';
				}
				$this->_model->manner=$_POST['manner'];	
				$this->_model->content=$_POST['content'];	
				$this->_model->cid=$_GET['cid'];	
				$this->_model->addComment()?Tool::alertLocation('新增评论成功！','feedback.php?cid='.$this->_model->cid):Tool::alertBack('新增评论失败！');	
			}
		}
		//显示评论
		public function showComment(){
			if(isset($_GET['cid'])){
				parent::__construct($this->_tpl,new CommentModel());
				$this->_model->cid=$_GET['cid'];
				
				$_content=new ContentModel();
				$_content->id=$_GET['cid'];
				
				$_page=new Page($this->_model->getCommentTotal(),ARTICLE_SIZE);
				$this->_model->limit=$_page->limit;
				$this->_tpl->assign('page',$_page->showpage());
				$_object=$this->_model->getAllComment();
				
				$_object2=$this->_model->getHotThreeComment();
				$_object3=$_content->getHotTwentyComment();
				foreach($_object2 as $_value){
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
				
				$this->_tpl->assign('titlec',$_content->getOneContent()->title);
				$this->_tpl->assign('info',$_content->getOneContent()->info);
				$this->_tpl->assign('id',$_content->getOneContent()->id);
				
				$this->_tpl->assign('cid',$this->_model->cid);
				$this->_tpl->assign('AllComment',$_object);
				
				$this->_tpl->assign('HotThreeComment',$_object2);
				$this->_tpl->assign('TwentyComment',$_object3);
			}else{
				Tool::alertBack('非法操作！');	
			}
		}
		//支持率与反对率
		private function setCount(){
			if(isset($_GET['cid'])&&isset($_GET['id'])&&isset($_GET['type'])){
				parent::__construct($this->_tpl,new CommentModel());
				$this->_model->id=$_GET['id'];
				if(!$this->_model->getOneComment())Tool::alertBack('不存在此评论！');	
				if($_GET['type']=='sustain'){
					$this->_model->setSustain()?Tool::alertLocation('支持成功！','feedback.php?cid='.$_GET['cid']):Tool::alertLocation('支持失败！','feedback.php?cid='.$_GET['cid']);
				}
				if($_GET['type']=='oppose'){
					$this->_model->setOppose()?Tool::alertLocation('反对成功！','feedback.php?cid='.$_GET['cid']):Tool::alertLocation('反对失败！','feedback.php?cid='.$_GET['cid']);
				}
				
			}
			
		}
				
	}
?>