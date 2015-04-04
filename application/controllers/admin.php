<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->library('CommonGetData');
		$this->load->model("dbHandler");
	}
	public function checkAdminLogin(){
		if (!checkLogin() || strcmp($_SESSION["usertype"], "admin")) {
			$this->load->view('redirect',array("url"=>"/admin/login","info"=>"请先登录管理员账号"));
			return false;
		}else return true;
	}
	public function login(){
		$this->load->view('admin/login',array('title'=>"管理员登录"));
	}
	public function login_handler(){
		if(isset($_POST["username"]) && isset($_POST["pwd"])){
			$condition=array(
				'table'=>'mkadmin',
				'result'=>'data',
				'where'=>array('mkadmin_username'=>$_POST["username"])
			);
			$info=$this->dbHandler->selectData($condition);
			if(count($info,0)==1){
				$post_pwd=MD5("MonkeyKing".$_POST["pwd"]);
				$db_pwd=$info[0]->mkadmin_pwd;
				if($post_pwd==$db_pwd){
					$_SESSION['username']=$info[0]->mkadmin_username;
					$_SESSION['userid']=$info[0]->mkadmin_id;
					$_SESSION['usertype']="admin";
					$this->load->view('redirect',array("url"=>"/admin/index"));
				}
				else{
					$this->load->view('redirect',array("info"=>"密码错误"));
				}
			}
			else{
				$this->load->view('redirect',array("info"=>"用户名不存在"));
			}
		}else{
			$this->load->view('redirect',array("info"=>"请输入用户名和密码"));
		}
	}
	public function logout(){
		unset($_SESSION["username"]);
		unset($_SESSION["userid"]);
		unset($_SESSION["usertype"]);
		$this->load->view('redirect',array("url"=>"/admin/login"));
	}
	public function adminBaseHandler($title,$slider,$view,$data){
		$this->checkAdminLogin();
		$websiteName=$this->commongetdata->getWebsiteConfig("website_name");
		$this->load->view('admin/header',
			array(
				'title' => $title."-".$websiteName,
				'showSlider' => true,
				$slider => true,
				'websiteName'=>$websiteName
			)
		);
		$this->load->view('admin/'.$view,$data);
		$this->load->view('admin/footer');
	}
	public function index(){
		$this->adminBaseHandler('后台管理系统','index','index',array());
	}
	public function columnList(){
		$data=array(
			"columns"=>$this->commongetdata->getColumns(),
			"columnType"=>$this->commongetdata->getAllColumnType('zh_cn')
		);
		$this->adminBaseHandler('栏目管理','columnList','columnList',$data);
	}
	public function addColumn(){
		$data=array("columns"=>$this->commongetdata->getColumns());
		$this->adminBaseHandler('添加栏目','columnList','addColumn',$data);
	}
	public function editColumn(){
		$data=array(
			"columns"=>$this->commongetdata->getColumns(),
			"currentColumn"=>$this->commongetdata->getColumn($_GET['column']),
			);
		$this->adminBaseHandler('编辑栏目','columnList','editColumn',$data);
	}
	public function password(){
		$data=array();
		$this->adminBaseHandler('修改密码','account','password',$data);
	}
	public function webDesign(){
		$type=isset($_GET['type'])?$_GET['type']:"index";//默认为顶部菜单栏
		$data=array(
			"type"=>$type,
			"positions"=>$this->commongetdata->getPositions($type),
			"columns"=>$this->commongetdata->getColumns()
		);
		$this->adminBaseHandler('网站设计','webDesign','positionList',$data);
	}
	public function contentList(){
		$type=isset($_GET['type'])?$_GET['type']:"essay";//默认为文章
		if(isset($_GET['page'])&& is_numeric($_GET['page'])) $page=$_GET['page'];
		else $page=1;
		$amountPerPage=20;
		$condition['table']=$type;
		$baseUrl=$selectUrl='/admin/contentList?type='.$type;
		if(isset($_GET['column'])&& is_numeric($_GET['column'])){
			$condition['where']=array($type.'_column'=>$_GET['column']);
			$baseUrl.='&column='.$_GET['column'];
		}
		if(isset($_GET['forum'])&& is_numeric($_GET['forum'])){
			$condition['where']=array($type.'_to_id'=>$_GET['forum'],'comment_to_type'=>1);
			$condition['join']=array('forum'=>'forum.forum_id=comment.comment_to_id','user'=>'user.user_id=comment.comment_user_id');
			$baseUrl.='&forum='.$_GET['forum'];
		}
		if(isset($_GET['state'])&& is_numeric($_GET['state'])){
			$condition['where']=array($type.'_state'=>$_GET['state']);
			$baseUrl.='&state='.$_GET['state'];
		}
		if(isset($_GET['search'])){
			if($type=='comment') $condition['like']=array($type.'_content'=>$_GET['search']);
			else $condition['like']=array($type.'_title'=>$_GET['search']);
			$baseUrl.='&search='.$_GET['search'];
		}
		$condition['result']="count";
		$amount=$this->commongetdata->getData($condition);
		$pageInfo=$this->commongetdata->getPageLink($baseUrl,$selectUrl,$page,$amountPerPage,$amount);
		$condition['result']="data";
		if($type=='forum') $condition['join']=array('user'=>'user_id=forum_author_id');
		$condition['limit']=$pageInfo['limit'];
		if($type=='comment') $condition['order_by']=array($type.'_time'=>'DESC');
		else $condition['order_by']=array($type.'_lastmodify_time'=>'DESC');
		$data=array(
			"columns"=>$this->commongetdata->getColumns(array('essayList','essay','imageList','forumList'),true),
			"contents"=>$this->commongetdata->getData($condition),
			"contentState"=>$this->commongetdata->getContentState()
		);
		$data=array_merge($data,$pageInfo);
		$this->adminBaseHandler('栏目管理','contentList',$type.'List',$data);
	}
	public function userList(){
		if(isset($_GET['page'])&& is_numeric($_GET['page'])) $page=$_GET['page'];
		else $page=1;
		$amountPerPage=20;
		$condition['table']='user';
		$baseUrl=$selectUrl='/admin/userList?valid=true';
		if(isset($_GET['gender'])&& is_numeric($_GET['gender'])){
			$condition['where']=array('user_gender'=>$_GET['gender']);
			$baseUrl.='&gender='.$_GET['gender'];
		}
		if(isset($_GET['state'])&& is_numeric($_GET['state'])){
			$condition['where']=array('user_state'=>$_GET['state']);
			$baseUrl.='&state='.$_GET['state'];
		}
		if(isset($_GET['search'])){
			$condition['like']=array('user_username'=>$_GET['search']);
			$baseUrl.='&search='.$_GET['search'];
		}
		$condition['result']="count";
		$amount=$this->commongetdata->getData($condition);
		$pageInfo=$this->commongetdata->getPageLink($baseUrl,$selectUrl,$page,$amountPerPage,$amount);
		$condition['result']="data";
		$condition['limit']=$pageInfo['limit'];
		$condition['order_by']=array('user_lastlogin_time'=>'DESC');
		$data=array(
			"users"=>$this->commongetdata->getData($condition)
		);
		$data=array_merge($data,$pageInfo);
		$this->adminBaseHandler('用户管理','userList','userList',$data);
	}
	public function addContent(){
		$type=isset($_GET['type'])?$_GET['type']:"essay";//默认为文章
		$typeArray=array();
		switch($type){
			case 'essay':
				$typeArray=array('essayList','essay');
			break;
			case 'image':
				$typeArray=array('imageList');
			break;
			default:
				$typeArray=array('essayList','essay');
			break;
		}
		$data=array(
			"columns"=>$this->commongetdata->getColumns($typeArray)
		);
		$this->adminBaseHandler('添加内容','addContent','add'.ucfirst($type),$data);
	}
	public function editContent(){
		$type=isset($_GET['type'])?$_GET['type']:"essay";//默认为文章
		$typeArray=array();
		switch($type){
			case 'essay':
				$typeArray=array('essayList','essay');
			break;
			case 'image':
				$typeArray=array('imageList');
			break;
			default:
				$typeArray=array('essayList','essay');
			break;
		}
		$data=array(
			"columns"=>$this->commongetdata->getColumns($typeArray),
			"content"=>$this->commongetdata->getContent($type,$_GET[$type])
		);
		$this->adminBaseHandler('编辑内容','contentList','edit'.ucfirst($type),$data);
	}
	public function setting(){
		$data=array("lastBackTime"=>$this->commongetdata->getWebsiteConfig('last_backup_time'));
		$this->adminBaseHandler('系统设置','setting','backup',$data);
	}
	public function email(){
		$data=array("email"=>$this->commongetdata->getWebsiteConfig('email'));
		$this->adminBaseHandler('系统设置','setting','email',$data);
	}
	public function backup(){
		$this->checkAdminLogin();
		// 加载数据库工具类
		$this->load->dbutil();
		$fileName=$_GET['filename'];
		$prefs = array(
			'tables'      => array(),  // 包含了需备份的表名的数组.
			'ignore'      => array('column'),           // 备份时需要被忽略的表
			'format'      => 'txt',             // gzip, zip, txt
			'filename'    => $fileName,    // 文件名 - 如果选择了ZIP压缩,此项就是必需的
			'add_drop'    => TRUE,              // 是否要在备份文件中添加 DROP TABLE 语句
			'add_insert'  => TRUE,              // 是否要在备份文件中添加 INSERT 语句
			'newline'     => "\n"               // 备份文件中的换行符
		);
		// 备份整个数据库并将其赋值给一个变量
		$backup =& $this->dbutil->backup($prefs);
		// 加载文件辅助函数并将文件写入你的服务器
		$this->load->helper('file');
		write_file($fileName, $backup);
		$condition=array(
			"table"=>'websiteconfig',
			"where"=>array('key_websiteconfig'=>'last_backup_time'),
			"data"=>array('value_websiteconfig'=>date("Y-m-d H:i:s"))
		);
		$this->dbHandler->updateData($condition);
		// 加载下载辅助函数并将文件发送到你的桌面
		$this->load->helper('download');
		force_download($fileName, $backup);
	}
}