<?php
	//模板类
	class Templates{
		private $_vars=array();//动态的接收变量
		//保存系统变量
		private $_config=array();
		
		//创建一个构造方法，来验证各个目录是否存在
		public function __construct(){
			if(!is_dir(TPL_DIR)|| !is_dir(TPL_C_DIR)|| !is_dir(CACHE)){
				exit('ERROR：模板目录 或 编译目录 或 缓存目录不存在，请手动修改！');
			}
			//保存系统变量
			$_exe=simplexml_load_file(ROOT_PATH.'/config/profile.xml');
			$_tagLib=$_exe->xpath('/root/taglib');
			
			foreach($_tagLib as $_tag){
				$this->_config["$_tag->name"]=$_tag->value;
			}
			//print_r($this->_config);
		}
		
		
		//assign()用于注入变量
		public function assign($_var,$_value){
			/*	$_var用于同步模板里的变量名例如index.php是name，就是index.tpl的{$name}
			 *  $_value表示index.php里的$name的值 也就是‘王强’
			 */
			if(isset($_var)&&!empty($_var)){
				$this->vars[$_var]=$_value;
			}else{
				exit('ERROR：请设置模板变量');
			}
		}
		
		
		//display()载入index.tpl
		public function display($_file){
			//设置模板的路径
			$_tpl_file=TPL_DIR.$_file;
			//判断模板是否存在
			if(!file_exists($_tpl_file)){
				exit('ERROR：模板文件文件不存在！');
			}
			//是否加参数
			if(!empty($_SERVER['QUERY_STRING'])){
				$_file.=$_SERVER['QUERY_STRING'];
			}
			
			//生成编译文件
			$_par_file=TPL_C_DIR.md5($_file).$_file.'.php';
			//缓存文件
			$_cachefile=CACHE.md5($_file).$_file.'.html';
			
			//当第二次运行相同文件的时候直接加载缓存文件，避开编译文件
			if(IS_CACHE){
				//缓存文件和编译文件都要存在
				if(file_exists($_cachefile)&&file_exists($_par_file)){
					//判断模板文件是否修改过--编译文件是否修改过
					if(filemtime($_par_file)>=filemtime($_tpl_file)&&filemtime($_cachefile)>=filemtime($_par_file)){
						//echo '直接执行了缓存文件';
						//载入缓存文件
						include $_cachefile;
						return;
					}
				}
			}
			
			//file_get_contents()函数是用来将文件的内容读入到一个字符串中的首选方法
			//file_put_contents()函数是用来将文件的内容写到一个字符串中的首选方法
			//当编译文件不存在或者模板文件修改过，则生成编译文件
			if(!file_exists($_par_file)||filemtime($_par_file)<filemtime($_tpl_file)){
				//引入模板解析类
				require_once ROOT_PATH.'/includes/Parser.class.php';
				$_parser=new Parser($_tpl_file);//模板文件
				$_parser->compile($_par_file);//编译文件
			}
			//载入编译文件
			include $_par_file;
			if(IS_CACHE){
				//获取缓冲区数据,并且创建缓存文件
				file_put_contents($_cachefile,ob_get_contents());//ob_get_contents();
				//清除了缓冲区，就是清除了编译文件加载的内容。
				ob_end_clean();
				//载入缓存文件
				include $_cachefile;
			}
		}
		//创建create(),用于header 和footer 模板解析使用，而不需要生成缓存文件
		public function create($_file){
			//设置模板的路径
			$_tpl_file=TPL_DIR.$_file;
			//判断模板是否存在
			if(!file_exists($_tpl_file)){
				exit('ERROR：模板文件文件不存在！');
			}
			//生成编译文件
			$_par_file=TPL_C_DIR.md5($_file).$_file.'.php';
			//当编译文件不存在或者模板文件修改过，则生成编译文件
			if(!file_exists($_par_file)||filemtime($_par_file)<filemtime($_tpl_file)){
				//引入模板解析类
				require_once ROOT_PATH.'/includes/Parser.class.php';
				$_parser=new Parser($_tpl_file);//模板文件
				$_parser->compile($_par_file);//编译文件
			}
			//载入编译文件
			include $_par_file;
		}
	}
?>