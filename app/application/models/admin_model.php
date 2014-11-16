<?php
class Admin_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function validate_admin(){
		$this->db->where(
			array("email"=>$this->input->post("email"),
				"password"=>md5($this->input->post("password"))
				)
			);
		$result = $this->db->get("admin");
		if($result->num_rows == 1){
			return TRUE;
		}
		return FALSE;
	}

	function get_admin($email){
		$this->db->where("email",$email);
		$result = $this->db->get("admin");
		if($result->num_rows > 0){
			$result = $result->result_array();
			return $result[0];
		}
		return FALSE;
	}
}