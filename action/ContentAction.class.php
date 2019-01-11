<?php
	class ContentAction extends Action{
		
		//构造方法初始化
		public function __construct(&$_tpl){
			parent::__construct($_tpl,new ContentModel());
			
		}
		public function _action(){
			switch($_GET['action']){
				case 'show':
					$this->show();
					break;
				case 'add':
					$this->add();
					break;
				case 'update':
					$this->update();
					break;
				case 'delete':
					$this->delete();
					break;
				default:
					Tool::alertBack('非法操作！');
			}
		}
		//show
		private function show(){
			$this->_tpl->assign('show',true);
			$this->_tpl->assign('title','文档列表');
			$this->nav();
			if(empty($_GET['nav'])){
				$_nav=new NavModel();
				$_id=$_nav->getAllNavChildId();
				$this->_model->nav=Tool::objArrOfStr($_id,'id');
			}else{
				$this->_model->nav=$_GET['nav'];
			}
			
			$_page=new Page($this->_model->getListContentTotal(),ARTICLE_SIZE);
			$this->_model->limit=$_page->limit;
			$this->_tpl->assign('page',$_page->showpage());
			$this->_tpl->assign('SearchContent',$this->_model->getListContent());
			
		}
		//add
		private function add(){
			if(isset($_POST['send'])){
				if(Validate::checkNull($_POST['title'])){
					Tool::alertBack('标题不能为空！');
				}
				if(Validate::checkLength($_POST['title'],2,'min')){
					Tool::alertBack('标题长度不能小于2位！');
				}
				if(Validate::checkLength($_POST['title'],50,'max')){
					Tool::alertBack('标题长度不能大于50位！');
				}
				if(Validate::checkNull($_POST['nav'])){
					Tool::alertBack('栏目不能为空，必须选择一个栏目！');
				}
				if(Validate::checkLength($_POST['tag'],30,'max')){
					Tool::alertBack('标签长度不能大于30位！');
				}
				if(Validate::checkLength($_POST['keyword'],30,'max')){
					Tool::alertBack('标关键字不能大于30位！');
				}
				if(Validate::checkLength($_POST['source'],20,'max')){
					Tool::alertBack('文章来源不能大于20位！');
				}
				if(Validate::checkLength($_POST['author'],10,'max')){
					Tool::alertBack('作者名称不能大于10位！');
				}
				if(Validate::checkLength($_POST['info'],200,'max')){
					Tool::alertBack('内容简介不能大于200位！');
				}
				if(Validate::checkNull($_POST['content'])){
					Tool::alertBack('详细不能为空！');
				}
				if(Validate::checkNum($_POST['count'])){
					Tool::alertBack('浏览次数必须为数字表示！');
				}
				if(Validate::checkNum($_POST['gold'])){
					Tool::alertBack('金币数必须为数字表示！');
				}
				if(isset($_POST['attr'])){
					$this->_model->attr=implode(',',$_POST['attr']);
					
				}else{
					$this->_model->attr='无属性值！';
				}
				
				$this->_model->title=$_POST['title'];	
				$this->_model->nav=$_POST['nav'];	
				$this->_model->tag=$_POST['tag'];	
				$this->_model->keyword=$_POST['keyword'];	
				$this->_model->thumbnail=$_POST['thumbnail'];	
				$this->_model->source=$_POST['source'];	
				$this->_model->author=$_POST['author'];	
				$this->_model->info=$_POST['info'];	
				$this->_model->content=$_POST['content'];	
				$this->_model->commend=$_POST['commend'];	
				$this->_model->count=$_POST['count'];	
				$this->_model->gold=$_POST['gold'];	
				$this->_model->color=$_POST['color'];	
				$this->_model->readlimit=$_POST['readlimit'];	
				$this->_model->sort=$_POST['sort'];	
				$this->_model->addContent()?Tool::alertLocation('文档发布成功！','?action=show'):Tool::alertBack('文档发布失败！');
			
			}
			
			$this->_tpl->assign('add',true);
			$this->_tpl->assign('title','新增文档');
			
			$_nav=new NavModel();
			foreach($_nav->getAllFrontNav() as $_object){
				$_html.='<optgroup label="'.$_object->nav_name.'">'."\r\n";
				$_nav->id=$_object->id;
				
				if(!!$_childnav=$_nav->getAllChildFrontNav()){
					foreach($_childnav as $_object){
						$_html.='<option value="'.$_object->id.'">'.$_object->nav_name.'</option>'."\r\n";
					}
				}
				
				$_html.='</optgroup>';
			}
			$this->_tpl->assign('nav',$_html);
			
			$this->_tpl->assign('author',$_SESSION['admin']['admin_user']);
		}
		//update
		private function update(){
			if(isset($_POST['send'])){
				$this->_model->id=$_POST['id'];
				$this->getPost();	
				$this->_model->updateContent()?Tool::alertLocation('文档修改成功！','?action=show'):Tool::alertBack('文档修改失败！');		
			}
			if(isset($_GET['id'])){
				$this->_tpl->assign('update',true);
				$this->_tpl->assign('title','修改列表');
				$this->_model->id=$_GET['id'];
				$_content=$this->_model->getOneContent();
				if($_content){
					$this->_tpl->assign('id',$_content->id);
					$this->_tpl->assign('titlec',$_content->title);
					$this->_tpl->assign('tag',$_content->tag);
					$this->_tpl->assign('keyword',$_content->keyword);
					$this->_tpl->assign('thumbnail',$_content->thumbnail);
					$this->_tpl->assign('source',$_content->source);
					$this->_tpl->assign('author',$_content->author);
					$this->_tpl->assign('content',$_content->content);
					$this->_tpl->assign('info',$_content->info);
					$this->_tpl->assign('count',$_content->count);
					$this->_tpl->assign('gold',$_content->gold);
					$this->nav($_content->nav);
					$this->attr($_content->attr);
					$this->color($_content->color);
					$this->sort($_content->sort);
					$this->readlimit($_content->readlimit);
					$this->commend($_content->commend);
				}else{
					Tool::alertBack('不存在此文档！');
				}
				
			}else{
				Tool::alertBack('非法操作！');
			}
			
		}
		//delete
		private function delete(){
			if(isset($_GET['id'])){
				$this->_model->id=$_GET['id'];
				$this->_model->deleteContent()?Tool::alertLocation('文档删除成功！','?action=show'):Tool::alertBack('文档删除失败！');		
			}else{
				Tool::alertBack('非法操作！');
			}
		}
		//getPost
		private function getPost(){
			if(Validate::checkNull($_POST['title'])){
					Tool::alertBack('标题不能为空！');
			}
			if(Validate::checkLength($_POST['title'],2,'min')){
				Tool::alertBack('标题长度不能小于2位！');
			}
			if(Validate::checkLength($_POST['title'],50,'max')){
				Tool::alertBack('标题长度不能大于50位！');
			}
			if(Validate::checkNull($_POST['nav'])){
				Tool::alertBack('栏目不能为空，必须选择一个栏目！');
			}
			if(Validate::checkLength($_POST['tag'],30,'max')){
				Tool::alertBack('标签长度不能大于30位！');
			}
			if(Validate::checkLength($_POST['keyword'],30,'max')){
				Tool::alertBack('标关键字不能大于30位！');
			}
			if(Validate::checkLength($_POST['source'],20,'max')){
				Tool::alertBack('文章来源不能大于20位！');
			}
			if(Validate::checkLength($_POST['author'],10,'max')){
				Tool::alertBack('作者名称不能大于10位！');
			}
			if(Validate::checkLength($_POST['info'],200,'max')){
				Tool::alertBack('内容简介不能大于200位！');
			}
			if(Validate::checkNull($_POST['content'])){
				Tool::alertBack('详细不能为空！');
			}
			if(Validate::checkNum($_POST['count'])){
				Tool::alertBack('浏览次数必须为数字表示！');
			}
			if(Validate::checkNum($_POST['gold'])){
				Tool::alertBack('金币数必须为数字表示！');
			}
			if(isset($_POST['attr'])){
				$this->_model->attr=implode(',',$_POST['attr']);
				
			}else{
				$this->_model->attr='无属性值！';
			}
			
			$this->_model->title=$_POST['title'];	
			$this->_model->nav=$_POST['nav'];	
			$this->_model->tag=$_POST['tag'];	
			$this->_model->keyword=$_POST['keyword'];	
			$this->_model->thumbnail=$_POST['thumbnail'];	
			$this->_model->source=$_POST['source'];	
			$this->_model->author=$_POST['author'];	
			$this->_model->info=$_POST['info'];	
			$this->_model->content=$_POST['content'];	
			$this->_model->commend=$_POST['commend'];	
			$this->_model->count=$_POST['count'];	
			$this->_model->gold=$_POST['gold'];	
			$this->_model->color=$_POST['color'];	
			$this->_model->readlimit=$_POST['readlimit'];	
			$this->_model->sort=$_POST['sort'];	
		}
		//是否允许评论commend
		private function commend($_commend){
			$_commendArr=array(0=>'禁止评论',1=>'允许评论');
			foreach($_commendArr as $_key=>$_value){
				if($_key==$_commend)$_checked='checked="checked""';
				$_html.='<input type="radio" '.$_checked.' name="commend" value="'.$_key.'" /> '.$_value;
				$_checked='';
			}
			$this->_tpl->assign('commend',$_html);		
		}
		//排序sort
		private function sort($_sort){
			$_sortArr=array(0=>'默认排序',1=>'置顶一天',2=>'置顶一周',3=>'制顶一月',4=>'制顶一年');
			foreach($_sortArr as $_key=>$_value){
				if($_key==$_sort)$_selected='selected="selected"';
				$_html.='<option '.$_selected.' value="'.$_key.'">'.$_value.'</option>';
				$_selected='';
			}
			$this->_tpl->assign('sort',$_html);			
		}
		//阅读权限readlimit
		private function readlimit($_readlimit){
			$_readlimitArr=array(0=>'开放浏览',1=>'初级会员',2=>'中级会员',3=>'高级会员',4=>'VIP会员');
			foreach($_readlimitArr as $_key=>$_value){
				if($_key==$_readlimit)$_selected='selected="selected"';
				$_html.='<option '.$_selected.' value="'.$_key.'" >'.$_value.'</option>';
				$_selected='';
			}
			$this->_tpl->assign('readlimit',$_html);			
		
		}
		//修改文档标题颜色
		private function color($_color){
			$_colorArr=array(''=>'默认颜色','red'=>'红色','green'=>'绿色','blue'=>'蓝色');
			foreach($_colorArr as $_key=>$_value){
				if($_key==$_color)$_selected='selected="selected"';
				$_html.='<option '.$_selected.' value="'.$_key.'" style="color: '.$_key.';">'.$_value.'</option>';
				$_selected='';
			}
			$this->_tpl->assign('color',$_html);				
		}
		
		//修改文档，获取attr方法 
		private function attr($_attr){
			$_attrArr=array('头条','推荐','加粗','跳转');
			$_attrS=explode(',',$_attr);	//选择的属性
			$_attrNo=array_diff($_attrArr,$_attrS);	//数组差集
			if($_attrS[0]!='无属性值！'){
				foreach($_attrS as $_value){
					$_html.='<input type="checkbox" checked="checked" name="attr[]" value="'.$_value.'"> '.$_value.'   ';
				}
			}
			foreach($_attrNo as $_value){
				$_html.='<input type="checkbox" name="attr[]" value="'.$_value.'"> '.$_value.'   ';
			}
			$this->_tpl->assign('attr',$_html);
		}
		
		//nav
		private function nav($_n=0){
			$_nav=new NavModel();
			foreach($_nav->getAllFrontNav() as $_object){
				$_html.='<optgroup label="'.$_object->nav_name.'">'."\r\n";
				$_nav->id=$_object->id;
				if(!!$_childnav=$_nav->getAllChildFrontNav()){
					foreach($_childnav as $_object){
						if($_n==$_object->id){
							$_html.='<option selected="selected" value="'.$_object->id.'">'.$_object->nav_name.'</option>'."\r\n";
						}else{
							$_html.='<option value="'.$_object->id.'">'.$_object->nav_name.'</option>'."\r\n";
						}
					}
				}
				$_html.='</optgroup>';
			}
			$this->_tpl->assign('nav',$_html);
		}
		
	}
?>