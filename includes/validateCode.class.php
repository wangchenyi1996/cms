<?php
	//验证码类
	class ValidateCode{
		private $charset='abcdefghklmnpretvwsyzABCDEFGHKLMNRSTVWXY23456789';//随机字符
		private $code;		//验证码
		private $codelen=4;	//验证码长度
		private $width=130;	//验证码宽
		private $height=50;	//验证码高
		private $img;		//图形资源句柄
		private $font;		//指定的字体
		private $fontsize=20;		//指定的字体字体
		private $fontcolor;		//指定的字体颜色
		
		public function __construct(){
			$this->font=ROOT_PATH.'/font/STKAITI.TTF';
		}
		//制作验证码
		private function createCode(){
			$_len=strlen($this->charset)-1;
			for($i=0;$i<$this->codelen;$i++){
				$this->code.=$this->charset[mt_rand(0,$_len)];
			}
		}
		//创建背景
		private function createBg(){
			//创建一张真彩色图像
			$this->img=imagecreatetruecolor($this->width,$this->height);
			//背景颜色
			$color=imagecolorallocate($this->img,mt_rand(157,255),mt_rand(157,255),mt_rand(157,255));
			//画一矩形并填充到背景上
			imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color);
			
		}	
		//生成文字
		private function createFont(){
			
			$_x=$this->width/$this->codelen;
			for($i=0;$i<$this->codelen;$i++){
				$this->fontcolor=imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
				imagettftext($this->img,$this->fontsize,mt_rand(-30,30),$_x*$i+mt_rand(1,5),$this->height/1.5,$this->fontcolor,$this->font,$this->code[$i]);
			}
		}
		//生成6个线条、100个雪花
		private function createLine(){
			for($i=0;$i<6;$i++){
				$color=imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
				imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);
			}
			for($i=0;$i<100;$i++){
				$color=imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
				imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);
			}
		}
			
		//输出图像
		private function outPut(){
			header('Content-Type:image/png');
			imagepng($this->img);
			imagedestroy($this->img);	//销毁图像
		}
		//对外生成
		public function doimg(){
			$this->createBg();
			$this->createCode();
			$this->createLine();
			$this->createFont();
			$this->outPut();
		}
		public function getCode(){
			return strtolower($this->code);
		}
		
	}
	
?>
