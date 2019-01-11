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
//验证新增和修改
function checkForm(){
	var fm=document.add;
	if(fm.nav_name.value.length==''||fm.nav_name.value.length<2||fm.nav_name.value.length>20){
		alert('导航名称不能为空、不能小于2位大于20位！');
		fm.nav_name.focus();
		return false;
	}
	if(fm.nav_info.value.length>200){
		alert('导航描述不能大于200位！');
		fm.nav_info.focus();
		return false;
	}
	return true;
}