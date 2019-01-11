<?php
	class Action{
		//控制器基类
		protected $_tpl;
		protected $_model;
		protected function __construct(&$_tpl,&$_model=null){
			$this->_tpl=$_tpl;
			$this->_model=$_model;
		}
	}
	
?>