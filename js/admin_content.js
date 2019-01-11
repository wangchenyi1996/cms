window.onload=function(){
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

//打开一个新窗口，并且在中心位置显示
function centerWindow(url,name,width,height){
	var left=(window.screen.width-width)/2;
	var top=(window.screen.height-height)/2-50;
	window.open(url,name,'height='+height+',width='+width+',left='+left+',top='+top);
}

//验证addContent
function checkAddContent(){
	var fm=document.content;
	if(fm.title.value==''||fm.title.value.length<2||fm.title.value.length>50){
		alert('标题不能为空、不能小于2位大于50位！');
		fm.title.focus();
		return false;
	}
	if(fm.nav.value==''){
		alert('必须选择一个栏目');
		fm.nav.focus();
		return false;
	}
	if(fm.tag.value.length>30){
		alert('标签不能大于30位！');
		fm.tag.focus();
		return false;
	}
	if(fm.keyword.value.length>30){
		alert('关键字不能大于30位！');
		fm.keyword.focus();
		return false;
	}
	if(fm.source.value.length>20){
		alert('文章来源长度不能超过20位！');
		fm.source.focus();
		return false;
	}
	if(fm.author.value.length>10){
		alert('作者名称不能大于10位！');
		fm.author.focus();
		return false;
	}
	if(fm.info.value.length>200){
		alert('内容简介不能大于200位！');
		fm.info.focus();
		return false;
	}
	if(CKEDITOR.instances.TextArea1.getData()==''){
		alert('详细内容不能为空！');
		CKEDITOR.instances.TextArea1.focus();
		return false;
	}
	
	return true;
}
