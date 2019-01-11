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

//验证投票add
function checkAddForm(){
	var fm=document.add;
	if(fm.title.value.length==''||fm.title.value.length<2||fm.title.value.length>20){
		alert('主题名称不能为空、不能小于2位大于20位！');
		fm.title.focus();
		return false;
	}
	if(fm.info.value.length>200){
		alert('主题描述不能大于200位！');
		fm.info.focus();
		return false;
	}
	return true;
}

//投票项目
function checkAddForm2(){
	var fm=document.add;
	if(fm.title.value.length==''||fm.title.value.length<2||fm.title.value.length>20){
		alert('投票项目名称不能为空、不能小于2位大于20位！');
		fm.title.focus();
		return false;
	}
	if(fm.info.value.length>200){
		alert('投票项目描述不能大于200位！');
		fm.info.focus();
		return false;
	}
	return true;
}