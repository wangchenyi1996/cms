<?php
	class ListAction extends Action{
		
		//构造方法初始化
		public function __construct(&$_tpl){
			parent::__construct($_tpl);
		}
		//执行
		public function _action(){
			$this->getNav();
			$this->getListContent();
			
		}
		//获取前台列表显示
		public function getListContent(){
			if(isset($_GET['id'])){
				parent::__construct($this->_tpl,new ContentModel());
				$this->_model->id=$_GET['id'];
				$_navid=$this->_model->getNavChildId();
				if($_navid){
					$this->_model->nav=Tool::objArrOfStr($_navid,'id');
				}else{
					$this->_model->nav=$this->_model->id;
				}
				$_page=new Page($this->_model->getListContentTotal(),ARTICLE_SIZE);
				$this->_model->limit=$_page->limit;
				$this->_tpl->assign('page',$_page->showpage());
				
				$_object=$this->_model->getListContent();
				if($_object){
					foreach($_object as $_value){
						if(mb_strlen($_value->info,'utf-8')>100){
							$_value->info=mb_substr($_value->info,0,100,'utf-8');
						}
						if(mb_strlen($_value->title,'utf-8')>30){
							$_value->title=mb_substr($_value->title,0,30,'utf-8');
						}
					}
				}
				$this->_tpl->assign('AllListContent',$_object);
				
				//获取文档的总评论量排行榜
				$_object=$this->_model->getMonthNavRec();
				if($_object){
					foreach($_object as $_value){
						if(mb_strlen($_value->title,'utf-8')>14){
							$_value->title=mb_substr($_value->title,0,14,'utf-8');
						}
						$_value->date=date('m-d',strtotime($_value->date));
					}
				}
				$this->_tpl->assign('MonthNavRec',$_object);
				
				//获取本月、本类、热点 排行榜	
				$_object=$this->_model->getMonthNavHot();
				if($_object){
					foreach($_object as $_value){
						if(mb_strlen($_value->title,'utf-8')>14){
							$_value->title=mb_substr($_value->title,0,14,'utf-8');
						}
						$_value->date=date('m-d',strtotime($_value->date));
					}
				}
				$this->_tpl->assign('MonthNavHot',$_object);
				
				//获取本月、图文排行榜	
				$_object=$this->_model->getMonthNavImg();
				if($_object){
					foreach($_object as $_value){
						if(mb_strlen($_value->title,'utf-8')>14){
							$_value->title=mb_substr($_value->title,0,14,'utf-8');
						}
						$_value->date=date('m-d',strtotime($_value->date));
					}
				}
				$this->_tpl->assign('MonthNavImg',$_object);
				
				
			}else{
				Tool::alertBack('非法操作,不存在此id');
			}
		}
		
		//获取前台显示导航
		public function getNav(){
			if(isset($_GET['id'])){
				$_nav=new NavModel();
				$_nav->id=$_GET['id'];
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
			}else{
				Tool::alertBack('非法操作！');
			}
		}
		
		
	}
?>