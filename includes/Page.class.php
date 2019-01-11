<?php
	//分页类
	class Page{
		private $total;	//总记录数
		private $limit;
		private $pagesize;//每页显示多少条数据
		private $page;		//获取当前页码
		private $pagenum;		//总页码(3页，还是几页)
		private $url;		//URL
		private $bothnum;		//两边保持数字分页的数目
		
		public function __construct($_total,$_pagesize){
			$this->total=$_total;
			$this->pagesize=$_pagesize;
			$this->pagenum=ceil($this->total/$this->pagesize);
			$this->page=$this->setPage();
			$this->limit="LIMIT ".($this->page-1)*$this->pagesize.",$this->pagesize";
			$this->url=$this->setUrl();
		}
		//获取当前页码
		private function setPage(){
			if(!empty($_GET['page'])){
				if($_GET['page']>0){
					if($_GET['page']>$this->pagenum){
						return $this->pagenum;
					}else{
						return $_GET['page'];
					}
				}else{
					return 1;
				}
			}else{
				return 1;
			}
		}
		//获取地址
		private function setUrl(){
			$_url=$_SERVER['REQUEST_URI'];
			$_par=parse_url($_url);
			if(isset($_par['query'])){
				parse_str($_par['query'],$_query);
				unset($_query['page']);
				$_url=$_par['path'].'?'.http_build_query($_query);
			}
			return $_url;
		}
		
		
		//数字目录第一页 第二页。。。
		private function pageList(){
			for($i=1;$i<=$this->pagenum;$i++){
				$_pagelist.=' <a href="'.$this->url.'&page='.$i.'">'.$i.'</a> ';
			}
			return $_pagelist;
		}
		
		
		//首页
		private function first(){
			return ' <a href="'.$this->url.'">首页</a>';
		}
		
		//上一页
		private function prev(){
			if($this->page==1){
				return '<span class="disabled">上一页</span>';
			}
			return ' <a href="'.$this->url.'&page='.($this->page-1).'">上一页</a>';
		}
		
		//下一页
		private function next(){
			if($this->page==$this->pagenum){
				return '<span class="disabled">下一页</span>';
			}
			return ' <a href="'.$this->url.'&page='.($this->page+1).'">下一页</a>';
		}
		
		//尾页
		private function last(){
			return ' <a href="'.$this->url.'&page='.$this->pagenum.'">尾页</a>';
		}
		
		//拦截器__set()
		public function __set($_key,$_value){
			$this->$_key=$_value;
		}
		//拦截器__get()
		public function __get($_key){
			return $this->$_key;
		}
		
		//分页信息
		public function showpage(){
			//return $this->total;	//17
			//return $this->pagesize;	//6
			//return $this->limit;	//LIMIT 0,6
			//return $this->page;
			//return $this->pagenum;
			
			$_page.=$this->first();
			$_page.=$this->pageList();
			$_page.=$this->last();
			$_page.=$this->prev();
			$_page.=$this->next();
			return $_page;
		}
	}
?>