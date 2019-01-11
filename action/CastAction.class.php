<?php
	class CastAction extends Action{
		
		//构造方法初始化
		public function __construct(&$_tpl){
			parent::__construct($_tpl,new VoteModel());
		}
		//执行
		public function _action(){
			$this->setCount();
			$this->getVote();
		}
		
		//获取投票
		private function getVote(){
			$_vote=new VoteModel();
			$_sum=$_vote->getVoteSum()->c;
			$_width=400;
			$this->_tpl->assign('VoteTitle',$_vote->getVoteTitle()->title);
			$this->_tpl->assign('wdith',$_width);
			$_object=$_vote->getVoteItem();
			if($_object){
				$_i=1;
				foreach($_object as $_value){
					$_value->percent=round($_value->count/$_sum*100,2).'%';
					$_value->picwidth=$_value->count/$_sum*400;
					$_value->picnum=$_i;
					$_i++;
				}
			}
			$this->_tpl->assign('VoteItem',$_object);
		}
		
		//累计
		public function setCount(){
			if(isset($_POST['send'])&&isset($_POST['vote'])){
				$this->_model->id=$_POST['vote'];
				$this->_model->setCount();
				Tool::alertLocation('恭喜累计投票成功，感谢您的参与！','cast.php');
			}
		}
		
		
		
		
	}
?>