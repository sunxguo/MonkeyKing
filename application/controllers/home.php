<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->library('CommonGetData');
		$this->load->model("dbHandler");
	}
	public function checkUserLogin(){
		if (!checkLogin() || strcmp($_SESSION["usertype"], "user")) {
			$this->load->view('redirect',array("url"=>"/home/login","info"=>"请先登录!"));
			return false;
		}else return true;
	}
	public function login(){
		$this->homeBaseHandler('登录','null','login',array());
	}
	public function register(){
		$this->homeBaseHandler('注册','null','register',array());
	}
	public function loginHandler(){
		if(isset($_POST["username"]) && isset($_POST["pwd"])){
			$condition=array(
				'table'=>'user',
				'result'=>'data',
				'where'=>array('user_username'=>$_POST["username"])
			);
			$info=$this->dbHandler->selectData($condition);
			if(count($info,0)==1){
				$post_pwd=MD5("MonkeyKing".$_POST["pwd"]);
				$db_pwd=$info[0]->user_pwd;
				if($post_pwd==$db_pwd){
					$_SESSION['username']=$info[0]->user_username;
					$_SESSION['userid']=$info[0]->user_id;
					$_SESSION['usertype']="user";
					$this->load->view('redirect',array("url"=>"/home/index"));
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
	public function homeBaseHandler($title,$siderName,$view,$data){
		$websiteName=$this->commongetdata->getWebsiteConfig("website_name");
		$data['columnType']=$columnType=$this->commongetdata->getAllColumnType('english');
		$this->load->view('home/header',
			array(
				'title' => $title."-".$websiteName,
				'showSider' => true,
				$siderName => true,
				'websiteName'=>$websiteName,
				'topBar'=>$this->commongetdata->getPositions('topBar',true),
				'sliderImage'=>$this->commongetdata->getSliderImage(),
				'sider'=>$this->commongetdata->getPositions('sider',true),
				'columnType'=>$columnType
			)
		);
		$this->load->view('home/'.$view,$data);
		$this->load->view('home/footer');
	}
	public function index(){
		$data=array(
			'column'=>$this->commongetdata->getPositions('index',true),
			'columnType'=>$this->commongetdata->getAllColumnType('english')
		);
		$this->homeBaseHandler('首页','index','index',$data);
	}
	public function columnList(){
		$data=array(
			'column'=>$this->commongetdata->getSubColumn($_GET['id']),
			'columnType'=>$this->commongetdata->getAllColumnType('english')
		);
		$this->homeBaseHandler('栏目列表','column_list','column_list',$data);
	}
	public function essayList(){
		if(isset($_GET['page'])&& is_numeric($_GET['page']) && $_GET['page']>0) $page=$_GET['page'];
		else $page=1;
		$amountPerPage=20;
		$condition['table']='essay';
		$baseUrl=$selectUrl='/home/essayList?id='.$_GET['id'];
		$condition['where']=array("essay_column"=>$_GET['id']);
		$condition['result']="count";
		$amount=$this->commongetdata->getData($condition);
		$pageInfo=$this->commongetdata->getPageLink($baseUrl,$selectUrl,$page,$amountPerPage,$amount);
		$condition['result']="data";
		$condition['limit']=$pageInfo['limit'];
		$condition['order_by']=array('essay_lastmodify_time'=>'DESC');
		$data=array(
			"essays"=>$this->commongetdata->getData($condition),
			"column"=>$this->commongetdata->getColumn($_GET['id'])
		);
		$data=array_merge($data,$pageInfo);
		$this->homeBaseHandler('文章列表','essay_list','essay_list',$data);
	}
	public function essay(){
		$essay=$this->commongetdata->getEssay($_GET['id']);
		$column=$this->commongetdata->getColumn($essay->essay_column);
		$this->homeBaseHandler('文章','essay','essay',array("essay"=>$essay,"column"=>$column));
	}
	public function imageList(){
		if(isset($_GET['page'])&& is_numeric($_GET['page']) && $_GET['page']>0) $page=$_GET['page'];
		else $page=1;
		$amountPerPage=20;
		$condition['table']='image';
		$baseUrl=$selectUrl='/home/imageList?id='.$_GET['id'];
		$condition['where']=array("image_column"=>$_GET['id']);
		$condition['result']="count";
		$amount=$this->commongetdata->getData($condition);
		$pageInfo=$this->commongetdata->getPageLink($baseUrl,$selectUrl,$page,$amountPerPage,$amount);
		$condition['result']="data";
		$condition['limit']=$pageInfo['limit'];
		$condition['order_by']=array('image_lastmodify_time'=>'DESC');
		$data=array(
			"images"=>$this->commongetdata->getData($condition),
			"column"=>$this->commongetdata->getColumn($_GET['id'])
		);
		$data=array_merge($data,$pageInfo);
		$this->homeBaseHandler('图片列表','image_list','image_list',$data);
	}
	public function forumList(){
		if(isset($_GET['page'])&& is_numeric($_GET['page']) && $_GET['page']>0) $page=$_GET['page'];
		else $page=1;
		$amountPerPage=20;
		$condition['table']='forum';
		$baseUrl=$selectUrl='/home/forumList?id='.$_GET['id'];
		$condition['where']=array("forum_column"=>$_GET['id']);
		$condition['result']="count";
		$amount=$this->commongetdata->getData($condition);
		$pageInfo=$this->commongetdata->getPageLink($baseUrl,$selectUrl,$page,$amountPerPage,$amount);
		$condition['result']="data";
		$condition['join']=array('user'=>'user.user_id=forum.forum_author_id');
		$condition['limit']=$pageInfo['limit'];
		$condition['order_by']=array('forum_lastmodify_time'=>'DESC');
		$data=array(
			"forums"=>$this->commongetdata->getData($condition),
			"column"=>$this->commongetdata->getColumn($_GET['id'])
		);
		$data=array_merge($data,$pageInfo);
		$this->homeBaseHandler('论坛列表','forum_list','forum_list',$data);
	}
	public function forum(){
		$this->checkUserLogin();
		if(isset($_GET['page'])&& is_numeric($_GET['page']) && $_GET['page']>0) $page=$_GET['page'];
		else $page=1;
		$amountPerPage=20;
		$condition['table']='comment';
		$baseUrl=$selectUrl='/home/forum?id='.$_GET['id'];
		$condition['where']=array("comment_to_type"=>'1',"comment_to_id"=>$_GET['id']);
		$condition['result']="count";
		$amount=$this->commongetdata->getData($condition);
		$pageInfo=$this->commongetdata->getPageLink($baseUrl,$selectUrl,$page,$amountPerPage,$amount);
		$condition['result']="data";
		$condition['join']=array('user'=>'user.user_id=comment.comment_user_id');
		$condition['limit']=$pageInfo['limit'];
		$condition['order_by']=array('comment_time'=>'DESC');
		$forum=$this->commongetdata->getForum($_GET['id']);
		$data=array(
			"forum"=>$forum,
			"comments"=>$this->commongetdata->getData($condition),
			"column"=>$this->commongetdata->getColumn($forum->forum_column)
		);
		foreach($data["comments"] as $item){
			$commentCondition=array(
				"table"=>'comment',
				"where"=>array("comment_to_type"=>2,"comment_to_id"=>$item->comment_id),
				'join'=>array('user'=>'user.user_id=comment.comment_user_id'),
				"result"=>'data'
			);
			$item->subComments=$this->commongetdata->getData($commentCondition);
		}
		$data=array_merge($data,$pageInfo);
		$this->homeBaseHandler('帖子','forum','forum',$data);
	}
	public function addForum(){
		$this->checkUserLogin();
		$data=array(
			"column"=>$this->commongetdata->getColumn($_GET['id'])
		);
		$this->homeBaseHandler('发布帖子','add_forum','add_forum',$data);
	}
	public function userCenter(){
		$this->checkUserLogin();
		$data=array('user'=>$this->commongetdata->getUser($_SESSION['userid']));
		$this->homeBaseHandler('用户中心','userCenter','userCenter',$data);
	}
	/*
	public function contentList(){
		$type=isset($_GET['type'])?$_GET['type']:"essay";//默认为文章
		if(isset($_GET['page'])&& is_numeric($_GET['page'])) $page=$_GET['page'];
		else $page=1;
		$amountPerPage=20;
		$condition['table']=$type;
		$baseUrl=$selectUrl='/home/contentList?type='.$type;
		if(isset($_GET['column'])&& is_numeric($_GET['column'])){
			$condition['where']=array($type.'_column'=>$_GET['column']);
			$baseUrl.='&column='.$_GET['column'];
		}
		if(isset($_GET['state'])&& is_numeric($_GET['state'])){
			$condition['where']=array($type.'_state'=>$_GET['state']);
			$baseUrl.='&state='.$_GET['state'];
		}
		if(isset($_GET['search'])){
			$condition['like']=array($type.'_title'=>$_GET['search']);
			$baseUrl.='&search='.$_GET['search'];
		}
		$condition['result']="count";
		$amount=$this->commongetdata->getData($condition);
		$pageInfo=$this->commongetdata->getPageLink($baseUrl,$selectUrl,$page,$amountPerPage,$amount);
		$condition['result']="data";
		$condition['limit']=$pageInfo['limit'];
		$condition['order_by']=array($type.'_lastmodify_time'=>'DESC');
		$data=array(
			"columns"=>$this->commongetdata->getColumns(array($type.'List'),true),
			"contents"=>$this->commongetdata->getData($condition),
			"contentState"=>$this->commongetdata->getContentState()
		);
		$data=array_merge($data,$pageInfo);
		$this->adminBaseHandler('栏目管理','contentList',$type.'List',$data);
	}*/
}