<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DbHandler extends CI_Model{
	function _construct(){
		parent::__construct();
		$this->load->database();
	}
	public function insertData($table,$data){
		$this->db->insert($table, $data);
		return $this->db->affected_rows();
	}
	public function deleteData($table,$condition){
	 	$this->db->where($condition);
		$this->db->delete($table);
		return $this->db->affected_rows();
	}
	public function  updateData($table,$data,$condition){
	 	$this->db->where($condition);
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}
	public function selectData($condition){
		$this->db->from($condition['table']);
		if(isset($condition['join'])){
			foreach($condition['join'] as $key=>$value){
				//Example:$this->db->join('comments', 'comments.id = blogs.id');
				$this->db->join($condition['join'][$key],$condition['join'][$value]);
			}
		}
		if(isset($condition['where'])){
			foreach($condition['where'] as $key=>$value){
				$this->db->where($condition['where'][$key],$condition['where'][$value]);
			}
		}
		if(isset($condition['or_where'])){
			foreach($condition['or_where'] as $key=>$value){
				$this->db->or_where($condition['or_where'][$key],$condition['or_where'][$value]);
			}
		}
		if(isset($condition['where_in'])){
			foreach($condition['where_in'] as $key=>$value){
				$this->db->where_in($condition['where_in'][$key],$condition['where_in'][$value]);
			}
		}
		if(isset($condition['or_where_in'])){
			foreach($condition['or_where_in'] as $key=>$value){
				$this->db->or_where_in($condition['or_where_in'][$key],$condition['or_where_in'][$value]);
			}
		}
		if(isset($condition['like'])){
			foreach($condition['like'] as $key=>$value){
				$this->db->like($condition['like'][$key],$condition['like'][$value]);
			}
		}
		if(isset($condition['or_like'])){
			foreach($condition['or_like'] as $key=>$value){
				$this->db->or_like($condition['or_like'][$key],$condition['or_like'][$value]);
			}
		}
		if(isset($condition['limit'])) $this->db->limit($condition['limit']['start'],$condition['limit']['offset']);
		//Example: $this->db->group_by("title"); OR $this->db->group_by(array("title", "date")); 
		if(isset($condition['group_by'])) $this->db->group_by($condition['group_by']);
		if(isset($condition['order_by'])){
			foreach($condition['order_by'] as $key=>$value){
				$this->db->order_by($condition['order_by'][$key],$condition['order_by'][$value]);
			}
		}
		if(isset($condition['select'])) $this->db->select($condition['select']);
	 	if($condition['result']=="data") return $this->db->get()->result();
	 	else return $this->db->count_all_results();
	}
	public function custom_query($sql){
		$this->db->query($sql);
		return $this->db->get()->result();
	}
}
?>
