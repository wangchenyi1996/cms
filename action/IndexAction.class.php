<?php
	class IndexAction extends Action{
		
		//构造方法初始化
		public function __construct(&$_tpl){
			parent::__construct($_tpl);
		}
		
		//执行
		public function _action(){
			$this->login();
			$this->laterUser();
			$this->showList();
			$this->getVote();
		}
		
		//获取投票
		private function getVote(){
			$_vote=new VoteModel();
			$this->_tpl->assign('VoteTitle',$_vote->getVoteTitle()->title);
			$this->_tpl->assign('VoteItem',$_vote->getVoteItem());
		}
		
		//显示最新推荐 热点 头条的7条数据
		public function showList(){
			parent::__construct($this->_tpl,new ContentModel());
			//获取最新的7条推荐文档
			$_object=$this->_model->getNewRecList();
			if($_object){
				foreach($_object as $_value){
					if(mb_strlen($_value->title,'utf-8')>15){
						$_value->title=mb_substr($_value->title,0,15,'utf-8');
					}
					$_value->date=date('m-d',strtotime($_value->date));
				}
			}
			$this->_tpl->assign('NewRecList',$_object);
			
			//本月热点(点击率)总排行榜
			$_object=$this->_model->getMonthHotList();
			if($_object){
				foreach($_object as $_value){
					if(mb_strlen($_value->title,'utf-8')>15){
						$_value->title=mb_substr($_value->title,0,15,'utf-8');
					}
					$_value->date=date('m-d',strtotime($_value->date));
				}
			}
			$this->_tpl->assign('MonthHotList',$_object);
			
			//获取本月评论总排行榜
			$_object=$this->_model->getMonthCommentList();
			if($_object){
				foreach($_object as $_value){
					if(mb_strlen($_value->title,'utf-8')>15){
						$_value->title=mb_substr($_value->title,0,15,'utf-8');
					}
					$_value->date=date('m-d',strtotime($_value->date));
				}
			}
			$this->_tpl->assign('MonthCommentList',$_object);
			
			//获取最新的4条图文资讯
			$_object=$this->_model->getPicList();
			if($_object){
				foreach($_object as $_value){
					if(mb_strlen($_value->title,'utf-8')>16){
						$_value->title=mb_substr($_value->title,0,18,'utf-8');
					}
					$_value->date=date('m-d',strtotime($_value->date));
				}
			}
			$this->_tpl->assign('PicList',$_object);
			
			//获取最新的10条文档
			$_object=$this->_model->getNewList();
			if($_object){
				foreach($_object as $_value){
					if(mb_strlen($_value->title,'utf-8')>20){
						$_value->title=mb_substr($_value->title,0,25,'utf-8');
					}
					$_value->date=date('m-d',strtotime($_value->date));
				}
			}
			$this->_tpl->assign('NewList',$_object);
			
			//获取最新的1条文档
			$_object=$this->_model->getNewTop();
			if(mb_strlen($_object->title,'utf-8')>20){
				$_object->title=mb_substr($_object->title,0,20,'utf-8');
			}
			if(mb_strlen($_object->info,'utf-8')>50){
				$_object->info=mb_substr($_object->info,0,80,'utf-8');
			}
			$this->_tpl->assign('TopTitle',$_object->title);
			$this->_tpl->assign('info',$_object->info);
			$this->_tpl->assign('TopId',$_object->id);
			
			//获取最新的第二条到第五条头条
			$_object=$this->_model->getNewTopList();
			if($_object){
				foreach($_object as $_value){
					if(mb_strlen($_value->title,'utf-8')>30){
						$_value->title=mb_substr($_value->title,0,30,'utf-8');
					}
					$_value->date=date('m-d',strtotime($_value->date));
				}
			}
			$this->_tpl->assign('NewTopList',$_object);
			
			$_nav=new NavModel();
			$_object=$_nav->getFourNav();
			if($_object){
				$_i=1;
				foreach($_object as $_value){
					if($_i%2==0){
						$_value->class='list right bottom';
					}else{
						$_value->class='list bottom';
					}
					$_i++;
					
					$this->_model->nav=$_value->id;
					$_navList=$this->_model->getNewNavList();
					
					Tool::subStr($_navList,'title',21,'utf-8');
					Tool::objDate($_navList,'date');
					
					$_value->list=$_navList;
					
				}
			}
			
			$this->_tpl->assign('FourNav',$_object);
			
			
		}
		
		//最近登陆会员
		public function laterUser(){
			$_user=new UserModel();
			$this->_tpl->assign('AllLaterUser',$_user->getLaterUser());
		}
		
		//login
		public function login(){
			if(isset($_COOKIE['user'])){
				$this->_tpl->assign('user',$_COOKIE['user']);
				$this->_tpl->assign('face',$_COOKIE['face']);
			}else{
				$this->_tpl->assign('login',true);
			}
		}
				
	}
?>