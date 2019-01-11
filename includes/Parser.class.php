<?php
	//模板解析类
	class Parser{
		//字段 保存模板
		private $tpl;
		
		//接收模板文件
		public function __construct($_tpl_file){
			if(!$this->tpl=file_get_contents($_tpl_file)){
				exit('ERROR：模板文件读取错误');
			}
		}
		
		//解析变量
		private function parvar(){
			$_patten='/\{\$([\w]+)\}/';
			if(preg_match($_patten,$this->tpl)){
				$this->tpl=preg_replace($_patten,"<?php echo \$this->vars['$1'];?>",$this->tpl);
			}
		}
		
		//解析if语句
		private function parif(){
			$_patten_if='/\{if\s+\$([\w]+)\}/';
			$_patten_endif='/\{\/if\}/';
			$_patten_else='/\{else\}/';
			
			if(preg_match($_patten_if,$this->tpl)){
				if(preg_match($_patten_endif,$this->tpl)){
					$this->tpl=preg_replace($_patten_if,"<?php if(\$this->vars['$1']){?>",$this->tpl);
					$this->tpl=preg_replace($_patten_endif,"<?php } ?>",$this->tpl);
					if(preg_match($_patten_else,$this->tpl)){
						$this->tpl=preg_replace($_patten_else,"<?php }else{ ?>",$this->tpl);
					}
						
				}else{
					exit('ERROR：if语句没有关闭');
				}
			}
		}
		
		//解析foreach语句
		private function parForeach(){
			$_pattenStart='/\{foreach\s+\$([\w]+)\(([\w]+),([\w]+)\)\}/';
			$_foreach='/\{\/foreach\}/';
			$_pattenVar='/\{@([\w]+)([\w\-\>]*)\}/';
			if(preg_match($_pattenStart,$this->tpl)){
				if(preg_match($_foreach,$this->tpl)){
					$this->tpl=preg_replace($_pattenStart,"<?php foreach(\$this->vars['$1'] as \$$2=>\$$3){?>",$this->tpl);
					$this->tpl=preg_replace($_foreach,"<?php } ?>",$this->tpl);
					if(preg_match($_pattenVar,$this->tpl)){
						$this->tpl=preg_replace($_pattenVar,"<?php echo \$$1$2 ?>",$this->tpl);
					}
				}else{
					exit('ERROR：foreach语句没有关闭');
				}
			}
		}
		
		//解析for循环
		private function parFor(){
			$_pattenStart='/\{for\s+\@([\w\-\>]+)\(([\w]+),([\w]+)\)\}/';
			$_for='/\{\/for\}/';
			$_pattenVar='/\{@([\w]+)([\w\-\>]*)\}/';
			if(preg_match($_pattenStart,$this->tpl)){
				if(preg_match($_for,$this->tpl)){
					$this->tpl=preg_replace($_pattenStart,"<?php foreach(\$$1 as \$$2=>\$$3){?>",$this->tpl);
					$this->tpl=preg_replace($_for,"<?php } ?>",$this->tpl);
					if(preg_match($_pattenVar,$this->tpl)){
						$this->tpl=preg_replace($_pattenVar,"<?php echo \$$1$2 ?>",$this->tpl);
					}
				}else{
					exit('ERROR：for语句没有关闭');
				}
			}
		}
		
		//php注释
		private function parCommon(){
			$_patten='/\{#\}(.*)\{#\}/';
			if(preg_match($_patten,$this->tpl)){
				$this->tpl=preg_replace($_patten,"<?php /* $1 */?>",$this->tpl);
			}
		}
		
		//解析include
		private function parinclude(){
			$_patten='/\{include\s+file=(\"|\')([\w\.\-\/]+)(\"|\')\}/';
			if(preg_match($_patten,$this->tpl,$_file)){
				if(!file_exists($_file[2])||empty($_file)){//$_file[2]='test.php'
					exit('ERROR：包含文件出错！');
				}
				$this->tpl=preg_replace($_patten,"<?php include '$2';?>",$this->tpl);
			}
		}
		
		//解析系统变量
		private function parConfig(){
			$_patten='/<!--\{([\w]+)\}-->/';
			if(preg_match($_patten,$this->tpl)){
				$this->tpl=preg_replace($_patten,"<?php echo \$this->_config['$1'];?>",$this->tpl);
			}
		}
		
		//对外公共方法
		public function compile($_par_file){
			//解析模板文件
			$this->parvar();
			$this->parif();
			$this->parCommon();
			$this->parForeach();
			$this->parFor();
			$this->parinclude();
			$this->parConfig();
			//生成编译文件
			if(!file_put_contents($_par_file,$this->tpl)){
				exit('ERROR：编译文件错误');
			}
		}
		
	}
?>