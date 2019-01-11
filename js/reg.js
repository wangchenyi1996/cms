//选择头像
function sface(){
	var fm=document.reg;
	var index=fm.face.selectedIndex;
	fm.faceimg.src='image/'+fm.face.options[index].value;
}

//注册验证
function checkReg(){
	var fm=document.reg;
	if(fm.user.value==''||fm.user.value.length<2||fm.user.value.length>20){
		alert('用户名不能为空并且不能小于2位并且也不能大于20位！');
		fm.user.focus();
		return false;
	}
	
	if(fm.pass.value==''||fm.pass.value.length<6){
		alert('密码不能为空并且不能小于6位！');
		fm.pass.focus();
		return false;
	}
	if(fm.pass.value!=fm.notpass.value){
		alert('两次密码输入不一致');
		fm.notpass.focus();
		return false;
	}
	
	//邮箱验证
	if(!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)){
		alert('邮箱格式不正确');
		fm.email.value='';
		fm.email.focus();
		return false;
	}
		
	if(fm.code.value.length!=4){
		alert('验证码必须为4位！');
		fm.code.focus();
		return false;
	}
	
	return true;
}
//登陆验证
function checkLogin(){
	var fm=document.login;
	if(fm.user.value==''||fm.user.value.length<2||fm.user.value.length>20){
		alert('用户名不能为空并且不能小于2位并且也不能大于20位！');
		fm.user.focus();
		return false;
	}
	
	if(fm.pass.value==''||fm.pass.value.length<6){
		alert('密码不能为空并且不能小于6位！');
		fm.pass.focus();
		return false;
	}
	if(fm.code.value.length!=4){
		alert('验证码必须为4位！');
		fm.code.focus();
		return false;
	}
	
	return true;
}