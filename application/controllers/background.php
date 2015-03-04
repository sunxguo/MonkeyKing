<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
@session_start();
class Background extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper("base");
		$this->load->model("dbHandler");
	}
	public function index(){
		$condition=array(
			'table'=>'website_name',
			'where'=>array('key_websiteconfig'=>'website_name')
		);
		$result=$this->dbHandler->selectData($condition);
		$websiteName=$result[0]->value_websiteconfig;
		$this->load->view('background/header',
			array(
				'title' => $websiteName."-后台管理系统",
				'websiteName'=>$websiteName
			)
		);
		$this->load->view('background/index', $data);
		$this->load->view('background/footer');
	}
}