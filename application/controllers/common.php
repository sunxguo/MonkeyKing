<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Common extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->helper("upload");
		$this->load->library('CommonGetData');
		$this->load->model("dbHandler");
	}
	public function addInfo(){
		$table="";
		$data=json_decode($_POST['data']);
		$info=array();
		switch($_POST['info_type']){
			case "user":
				if($this->commongetdata->isExist("user",'user_username',$data->username)){
					echo json_encode(array("result"=>"notUnique","message"=>"该用户名已经存在"));
					return false;
				}
				$table="user";
				$info=array(
					"user_username"=>$data->username,
					"user_pwd"=>MD5("MonkeyKing".$data->pwd),
					"user_gender"=>$data->gender,
					"user_reg_time"=>date("Y-m-d H:i:s"),
					"user_lastlogin_time"=>date("Y-m-d H:i:s"),
					"user_grade"=>1,
					"user_vip_grade"=>0
				);
			break;
			case "column":
				$table="column";
				$info=array(
					"column_fid"=>$data->fid,
					"column_name"=>$data->name,
					"column_display"=>$data->display,
					"column_type"=>$data->type,
					"column_ordernum"=>$data->order_num
				);
			break;
			case "position":
				$posiType=$this->commongetdata->getPositionType($data->type);
				$selectCondition=array(
					"table"=>'position',
					"where"=>array(
						"position_type"=>$posiType
					),
					"result"=>'count'
				);
				$amount=$this->dbHandler->selectData($selectCondition);
				$table="position";
				$info=array(
					"position_column"=>$data->column_id,
					"position_type"=>$posiType,
					"position_ordernum"=>$amount+1
				);
			break;
			case "essay":
				$table="essay";
				$info=array(
					"essay_column"=>$data->column_id,
					"essay_title"=>$data->title,
					"essay_summary"=>$data->summary,
					"essay_content"=>$data->content,
					"essay_thumbnail"=>json_encode($data->thumbnail),
					"essay_state"=>$data->draft,
					"essay_create_time"=>date("Y-m-d H:i:s"),
					"essay_visits"=>0,
					"essay_author_type"=>$this->commongetdata->getUserType($_SESSION['usertype']),
					"essay_author_id"=>$_SESSION['userid'],
					"essay_lastmodify_time"=>date("Y-m-d H:i:s")
				);
			break;
			case "forum":
				if (strcmp($_SESSION["usertype"], "admin")==0) {
					echo json_encode(array("result"=>"failed","message"=>"管理员账号不可以发帖！请先退出"));
					return false;
				}
				$table="forum";
				$info=array(
					"forum_column"=>$data->column_id,
					"forum_title"=>$data->title,
					"forum_content"=>$data->content,
					"forum_create_time"=>date("Y-m-d H:i:s"),
					"forum_visits"=>0,
					"forum_author_id"=>$_SESSION['userid'],
					"forum_lastmodify_time"=>date("Y-m-d H:i:s")
				);
			break;
			case "comment":
				if (strcmp($_SESSION["usertype"], "admin")==0) {
					echo json_encode(array("result"=>"failed","message"=>"管理员账号不可以回复！请先退出"));
					return false;
				}
				$table="comment";
				$info=array(
					"comment_content"=>$data->content,
					"comment_to_id"=>$data->to_id,
					"comment_to_type"=>$data->to_type,
					"comment_user_id"=>$_SESSION['userid'],
					"comment_time"=>date("Y-m-d H:i:s")
				);
			break;
			case "image":
				$table="image";
				$images=$data->src;
				$info=array(
					"image_column"=>$data->column_id,
					"image_title"=>$data->title,
					"image_summary"=>$data->summary,
					"image_src"=>$images[0]->src,
					"image_state"=>$data->draft,
					"image_create_time"=>date("Y-m-d H:i:s"),
					"image_visits"=>0,
					"image_author_type"=>$this->commongetdata->getUserType($_SESSION['usertype']),
					"image_author_id"=>$_SESSION['userid'],
					"image_lastmodify_time"=>date("Y-m-d H:i:s")
				);
			break;
		}
		$result=$this->dbHandler->insertData($table,$info);
		if($result==1) echo json_encode(array("result"=>"success","message"=>"信息写入成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息写入失败"));
	}
	public function delInfo(){
		$condition=array();
		$data=json_decode($_POST['data']);
		switch($_POST['info_type']){
			case 'column':
				$condition['table']="column";
				$condition['where']=array("column_id"=>$data->id);
			break;
			case 'essay':
				$condition['table']="essay";
				$condition['where']=array("essay_id"=>$data->id);
			break;
			case 'forum':
				$condition['table']="forum";
				$condition['where']=array("forum_id"=>$data->id);
			break;
			case 'comment':
				$condition['table']="comment";
				$condition['where']=array("comment_id"=>$data->id);
			break;
			case 'user':
				$condition['table']="user";
				$condition['where']=array("user_id"=>$data->id);
			break;
			case 'image':
				$condition['table']="image";
				$condition['where']=array("image_id"=>$data->id);
			break;
			case 'position':
				$condition['table']="position";
				$condition['where']=array("position_id"=>$data->id);
				$currentPosi=$this->commongetdata->getOneData($condition);
				
				$selectCondition=array(
					"table"=>'position',
					"where"=>array(
						"position_type"=>$currentPosi->position_type
					),
					"result"=>'count'
				);
				$amount=$this->dbHandler->selectData($selectCondition);
				for($i=$currentPosi->position_ordernum+1;$i<=$amount;$i++){
					$updateCondition=array(
						"table"=>'position',
						"where"=>array(
							"position_type"=>$currentPosi->position_type,
							"position_ordernum"=>$i
						),
						"data"=>array(
							"position_ordernum"=>$i-1
						)
					);
					$this->dbHandler->updateData($updateCondition);
				}
			break;
		}
		$result=$this->dbHandler->deleteData($condition);
		if($result==1) echo json_encode(array("result"=>"success","message"=>"信息删除成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息删除失败"));
	}
	public function modifyInfo(){
		$condition=array();
		$data=json_decode($_POST['data']);
		switch($_POST['info_type']){
			case 'column':
				$condition['table']="column";
				$condition['where']=array("column_id"=>$data->id);
				$condition['data']=array(
					"column_fid"=>$data->fid,
					"column_name"=>$data->name,
					"column_display"=>$data->display,
					"column_type"=>$data->type,
					"column_ordernum"=>$data->order_num
				);
			break;
			case 'adminInfo':
				$condition['table']="mkadmin";
				$condition['where']=array("mkadmin_id"=>$_SESSION['userid']);
				$adminInfo=$this->commongetdata->getOneData($condition);
				if($adminInfo->mkadmin_pwd!=MD5("MonkeyKing".$data->oldpwd)){
					echo json_encode(array("result"=>"failed","message"=>"原密码不正确！"));
					return false;
				}
				$condition['data']=array(
					"mkadmin_username"=>$data->username,
					"mkadmin_pwd"=>MD5("MonkeyKing".$data->newpwd)
				);
			break;
			case 'user':
				$condition['table']="user";
				$condition['where']=array("user_id"=>$_SESSION['userid']);
				$userInfo=$this->commongetdata->getOneData($condition);
				$condition['data']=array(
					"user_username"=>$data->username,
					"user_avatar"=>$data->avatar,
					"user_phone"=>$data->phone,
					"user_email"=>$data->email,
					"user_gender"=>$data->gender
				);
				if($data->newPwd!=""){
					if($userInfo->user_pwd!=MD5("MonkeyKing".$data->oldPwd)){
						echo json_encode(array("result"=>"failed","message"=>"原密码不正确！"));
						return false;
					}else{
						$condition['data']["user_pwd"]=MD5("MonkeyKing".$data->newPwd);
					}
				}
			break;
				$condition['table']="essay";
				$condition['where']=array("essay_id"=>$data->id);
				$condition['data']=array(
					"essay_column"=>$data->column_id,
					"essay_title"=>$data->title,
					"essay_summary"=>$data->summary,
					"essay_content"=>$data->content,
					"essay_thumbnail"=>json_encode($data->thumbnail),
					"essay_state"=>$data->draft,
					"essay_lastmodify_time"=>date("Y-m-d H:i:s")
				);
			break;
			case "image":
				$condition['table']="image";
				$condition['where']=array("image_id"=>$data->id);
				$images=$data->src;
				$condition['data']=array(
					"image_column"=>$data->column_id,
					"image_title"=>$data->title,
					"image_summary"=>$data->summary,
					"image_src"=>$images[0]->src,
					"image_state"=>$data->draft,
					"image_lastmodify_time"=>date("Y-m-d H:i:s")
				);
			break;
			case "websiteconfig":
				$condition['table']="websiteconfig";
				$condition['where']=array("key_websiteconfig"=>$data->key);
				$condition['data']=array(
					"value_websiteconfig"=>$data->value
				);
			break;
		}
		$result=$this->dbHandler->updateData($condition);
		if($result==1) echo json_encode(array("result"=>"success","message"=>"信息修改成功"));
		else echo json_encode(array("result"=>"failed","message"=>"信息修改失败"));
	}
	public function uploadImage(){
		$result=upload("image");
		echo json_encode($result);
	}
}