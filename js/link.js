function link(type){
	var logo=document.getElementById("logo")
	switch (type){
		case 1:
			logo.style.display='none';
			break;
		case 2:
			logo.style.display='block';
			break;
	}
}
//链接验证
function checkLink(){
	var fm=document.friendlink;
	if(fm.webname.value==''||fm.webname.value.length>20){
		alert('网站名称不能为空并且不能大于20位！');
		fm.webname.focus();
		return false;
	}
	
	if(fm.weburl.value==''||fm.weburl.value.length>100){
		alert('网站地址不能为空并且不能大于100位！');
		fm.weburl.focus();
		return false;
	}
	
	if(fm.user.value.length>20){
		alert('站长名称不能大于20位！');
		fm.user.focus();
		return false;
	}
		
	if(fm.code.value.length!=4){
		alert('验证码必须为4位！');
		fm.code.focus();
		return false;
	}
	
	return true;
}