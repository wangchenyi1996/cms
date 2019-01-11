window.onload=function(){
	var leval=document.getElementById('leval');
	var options=document.getElementsByTagName('option');
	if(leval){
		for (var i = 0; i < options.length; i++) {
			if(options[i].value==leval.value){
				options[i].setAttribute('selected','selected');
			}
		}
	}
	
	var title=document.getElementById('title');
	var ol=document.getElementsByTagName('ol');
	var a=ol[0].getElementsByTagName('a');
	for (var i = 0; i < a.length; i++) {
		a[i].className=null;
		if(title.innerHTML==a[i].innerHTML){
			a[i].className="selected";
		}
	}
};

//验证Manageadd
function checkAddForm(){
	var fm=document.add;
	if(fm.admin_user.value.length==''||fm.admin_user.value.length<2||fm.admin_user.value.length>20){
		alert('用户名不能为空并且不能小于2位并且也不能大于20位！');
		fm.admin_user.focus();
		return false;
	}
	if(fm.admin_pass.value==''||fm.admin_pass.value.length<6){
		alert('密码不能为空并且不能小于6位！');
		fm.admin_pass.focus();
		return false;
	}
	if(fm.admin_pass.value!=fm.admin_notpass.value){
		alert('两次密码不一致！');
		fm.admin_notpass.focus();
		return false;
	}
	return true;
}

//验证Manageupdate
function checkUpdateForm(){
	var fm=document.update;
	if(fm.admin_pass.value!=''){
		if(fm.admin_pass.value.length<6){
			alert('密码修改不能小于6位！');
			fm.admin_pass.focus();
			return false;
		}
	}
	return true;
}
