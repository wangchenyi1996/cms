<?php
	class SearchAction extends Action{
		//构造方法初始化
		public function __construct(&$_tpl){
			parent::__construct($_tpl,new ContentModel());
		}
		//执行
		public function _action(){
			$this->searchTitle();
			$this->searchKeyword();
			$this->searchTag();
		}
		
		//按照标题搜索
		public function searchTitle(){
			if($_GET['type']==1){
				if(empty($_GET['inputkeyword'])) Tool::alertBack('搜索关键字不得为空！');
				$this->_model->inputkeyword=$_GET['inputkeyword'];
				$_page=new Page($this->_model->searchTitleContentTotal(),PAGE_SIZE);	
				$this->_model->limit=$_page->limit;
				$_object=$this->_model->searchTitleContent();
				Tool::subStr($_object,'info',100,'utf-8');
				Tool::subStr($_object,'title',30,'utf-8');
				if($_object){
					foreach($_object as $_value){
						$_value->title=str_replace($this->_model->inputkeyword,'<span style="color:red">'.$this->_model->inputkeyword.'</span>',$_value->title);
					}
				}
				$this->_tpl->assign('SearchContent',$_object);
				$this->_tpl->assign('page',$_page->showpage());
			}
		}
		
		//按照关键字搜索
		public function searchKeyword(){
			if($_GET['type']==2){
				if(empty($_GET['inputkeyword'])) Tool::alertBack('搜索关键字不得为空！');
				$this->_model->inputkeyword=$_GET['inputkeyword'];
				$_page=new Page($this->_model->searchKeywordContentTotal(),PAGE_SIZE);	
				$this->_model->limit=$_page->limit;
				$_object=$this->_model->searchKeywordContent();
				Tool::subStr($_object,'info',100,'utf-8');
				Tool::subStr($_object,'title',30,'utf-8');
				if($_object){
					foreach($_object as $_value){
						$_value->keyword=str_replace($this->_model->inputkeyword,'<span style="color:red">'.$this->_model->inputkeyword.'</span>',$_value->keyword);
					}
				}
				$this->_tpl->assign('SearchContent',$_object);
				$this->_tpl->assign('page',$_page->showpage());
			}
		}
		
		//按照tag标签搜索
		public function searchTag(){
			if($_GET['type']==3){
				
			}
		}
		
		
	}
?>