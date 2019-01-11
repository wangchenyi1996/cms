<?php
	//上传图像类
	class Image{
		private $file;//图片地址
		private $width;//图片宽
		private $height;//图片高
		private $type;//图片类型
		private $img;//源图像
		private $new;//新图像
		
		public function __construct($_file){
			$this->file=$_SERVER["DOCUMENT_ROOT"].$_file;
			list($this->width,$this->height,$this->type)=getimageSize($this->file);
			$this->img=$this->getFromImg($this->file,$this->type);
			
		}
		//ckeditor图像处理
		public function ckeImg(){
			list($_water_width,$_water_height,$_water_type)=getimageSize(MARK);
			$_water=$this->getFromImg(MARK,$_water_type);
			imagecopy($this->img,$_water,5,5,0,0,$_water_width,$_water_height);
			imagepng($this->img,$this->file);
			imagedestroy($this->img);
			imagedestroy($_water);
			
		}
		
		
		//缩略图(百分比)
		public function thumb($_per){
			$_new_width=$this->width*($_per/100);
    		$_new_height=$this->height*($_per/100);
    		$this->new=imagecreatetruecolor($_new_width,$_new_height);
    		imagecopyresampled($this->new,$this->img,0,0,0,0,$_new_width,$_new_height,$this->width,$this->height);
		}
		//等比例缩略图 
		public function thumb1($_new_width,$_new_height){
			if($this->width<$this->height){
		    	$_new_width=($_new_height/$this->height)*$this->width;
		    }else{
		    	$_new_height=($_new_width/$this->width)*$this->height;
		    }
			$this->new=imagecreatetruecolor($_new_width,$_new_height);
    		imagecopyresampled($this->new,$this->img,0,0,0,0,$_new_width,$_new_height,$this->width,$this->height);
		}
		//固定宽和高--扩容--裁剪（最强大，最常用）
		public function thumb2($_new_width,$_new_height){
			//创建一个容器
			$_n_w=$_new_width;
			$_n_h=$_new_height;
			
			//创建一个裁剪点
			$_cut_width=0;
			$_cut_height=0;
			
			if($this->width<$this->height){
		    	$_new_width=($_new_height/$this->height)*$this->width;
		    }else{
		    	$_new_height=($_new_width/$this->width)*$this->height;
		    }
		    //裁剪和扩容
		    if($_new_width<$_n_w){//如果新高度小于新容器高度
		    	$r=$_n_w/$_new_width;//按长度求出等比因子
				$_new_width*=$r;//扩容填充的长度
				$_new_height*=$r;//扩容填充的高度
				$_cut_height=($this->height-$_n_w)/4;
		    }
		    if($_new_height<$_n_h){//如果新高度小于容器高度
		    	$r=$_n_h/$_new_height;//按高度求出等比因子
				$_new_width*=$r;//扩容填充的长度
				$_new_height*=$r;//扩容填充的高度
				$_cut_width=($this->width-$_n_h)/4;
		    }
		    
			$this->new=imagecreatetruecolor($_n_w,$_n_h);
    		imagecopyresampled($this->new,$this->img,0,0,$_cut_width,$_cut_height,$_new_width,$_new_height,$this->width,$this->height);
		}
		
		//加载图片的各种类型，返回图片的资源句柄
		private function getFromImg($_file,$_type){
			switch($_type){	
	            case 1://gif	返回一图像标识符，代表了从给定的文件名取得的图像。
	                  $img=imagecreatefromgif($_file); 
	                  break;                  
	            case 2://jpg
	                  $img=imagecreatefromjpeg($_file);
	                  break;
	            case 3://png
	                 $img=imagecreatefrompng($_file);  
	                  break;
	            default:
	                 Tool::alertBack("图像类型错误");
       		 }
       		 return $img;
		}
		//图像输出
		public function out(){
			//imagejpeg($this->img,$this->file);
			imagepng($this->new,$this->file);
			imagedestroy($this->img);
			imagedestroy($this->new);
		}
		
	}
?>