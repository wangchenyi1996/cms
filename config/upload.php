<?php
	require substr(dirname(__FILE__),0,-7).'/init.inc.php';
	if(isset($_POST['send'])){
		$_fileupload=new FileUpload('pic');
		$_path=$_fileupload->getPath();
		$_img=new Image($_path);
		//$_img->thumb(50);//百分比
		//$_img->thumb1(148,48);//等比例
		$_img->thumb2(148,98);//固定宽和高
		$_img->out();
		Tool::alertOpenerClose('缩略图上传成功！',$_path);
	}else{
		Tool::alertBack("文件过大或其他未知错误导致浏览器崩溃");
	}
	
?>