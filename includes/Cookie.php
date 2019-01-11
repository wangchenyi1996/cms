<?php
	class Cookie{
		private $name;
		private $value;
		private $time;
		
		public function  __construct($_name,$_value='',$_time=0){
			$this->name=$_name;
			$this->value=$_value;
			$this->time=$_time;
		}
		//创建cookie
		public function setCookie(){
			setcookie($this->name,$this->value,$this->time);
		}
		
	}
	
?>