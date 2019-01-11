<?php
	
	$img=imagecreatefromjpeg('1.jpg');//代表了从给定的文件名取得的图像。
	list($width,$height,$type)=getimageSize('1.jpg');
	
	$_new_width=110;
    $_new_height=50;
    if($width<$height){
    	$_new_width=($_new_height/$height)*$width;
    }else{
    	$_new_height=($_new_width/$width)*$height;
    }
	
//	$percent=0.5;
//	$_new_width=$width*$percent;
//  $_new_height=$height*$percent;
//
	//创建一个微缩后新的图像源（目标图像）
    $_new_image=imagecreatetruecolor($_new_width,$_new_height);
    imagecopyresampled($_new_image,$img,0,0,0,0,$_new_width,$_new_height,$width,$height);
    	
    $color=imagecolorallocate($_new_image,220,220,220);
    imagettftext($_new_image,10,0,10,10,$color,'font/STKAITI.TTF','hello world');
	header('Content-Type:image/jpeg');
	imagejpeg($_new_image); 
	imagedestroy($img);

	//获取文件的宽和高
//	list($width,$height,$type)=getimageSize('1.jpg');
//	echo $width.'  '.$height.' '.$type;
?>