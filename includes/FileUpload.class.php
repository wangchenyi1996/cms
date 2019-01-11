<?php
	//上传文件类
	class FileUpload{
		private $error;	//错误代码
		private $type;	//设置图片类型
		private $path;	//目录路径
		private $typeArr=array('image/gif','image/jpeg','image/pjpeg','image/jpg','image/png','image/x-png');
		private $today;	//今天目录
		private $name;	//源文件名
		private $tmp;	//临时文件
		private $linkpath;	//链接路径
		private $linktoday;	//当天时间--相对
		
		public function __construct($_file){
			$this->error=$_FILES[$_file]['error'];
			$this->type=$_FILES[$_file]['type'];
			$this->path=ROOT_PATH.UPDIR;
			$this->linktoday=date('Ymd').'/';
			$this->today=$this->path.$this->linktoday;
			$this->name=$_FILES[$_file]['name'];
			$this->tmp=$_FILES[$_file]['tmp_name'];
			echo $this->tmp;
			
			$this->checkError();
			$this->checkType();
			$this->checkPath();
			$this->moveUpload();
			
		}
		//验证错误类型
		private function checkError(){
			if(!empty($this->error)){
				switch($this->error){
					case 1:
						Tool::alertBack('上传的文件超过了php.ini中upload_max_filesize限制');
						break;
					case 2:
						Tool::alertBack('上传的文件的大小超过了html表单中max_file_size限制');
						break;
					case 3:
						Tool::alertBack("文件只有部分被上传");
						break;
					case 4:
						Tool::alertBack("没有文件被上传");
						break;
					default:
						Tool::alertBack("未知错误");
						break;
				}
			}
		}
		//验证类型
		private function checkType(){
			if(!in_array($this->type,$this->typeArr)){
				Tool::alertBack("上传图片类型不正确！");
			}
		}
		//验证目录
		private function checkPath(){
			if(!is_dir($this->path)||!is_writeable($this->path)){
				if(!mkdir($this->path)){
					Tool::alertBack("主目录创建失败");
				}
			}
			if(!is_dir($this->today)||!is_writeable($this->today)){
				if(!mkdir($this->today)){
					Tool::alertBack("子目录创建失败");
				}
			}
		}
		//获取图片的后缀
		private function setNewName(){
			$_nameArr=explode('.',$this->name);
			$_postfix=$_nameArr[count($_nameArr)-1];
			$_newname=date('YmdHis').mt_rand(100,1000).'.'.$_postfix;
			$this->linkpath=UPDIR.$this->linktoday.$_newname;
			return $this->today.$_newname;
		}
		//将临时文件移到文件目录中
		private function moveUpload(){
			if(is_uploaded_file($this->tmp)){
				if(!move_uploaded_file($this->tmp,$this->setNewName())){
					Tool::alertBack("上传失败");
				}
			}else{
				Tool::alertBack("临时文件");
			}
		}
		//返回路径
		public function getPath(){
			$_path=$_SERVER['SCRIPT_NAME'];
			$_dir=dirname(dirname($_path));
			if($_dir=='\\')$_dir='/';
			$this->linkpath=$_dir.$this->linkpath;
			return $this->linkpath;
		}
	}
?>