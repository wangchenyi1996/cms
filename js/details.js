//发表评论验证
function checkComment(){
	var fm=document.comment;
	if(fm.content.value==''||fm.content.value.length>250){
		alert('评论内容不能为空并且不能大于250位！');
		fm.content.focus();
		return false;
	}
	if(fm.code.value.length!=4){
		alert('验证码必须为4位！');
		fm.code.focus();
		return false;
	}
	return true;
}