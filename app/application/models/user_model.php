<?php
class User_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function register_user(){
		$user = array(
			"username"=>$this->input->post("username"),
			"email"=>$this->input->post("email"),
			"password"=>md5(md5($this->input->post("password"))),
			"type"=>$this->input->post("tid"),
			"user_agent"=>$this->input->user_agent(),
			"ip_address"=>$this->input->ip_address()
			);

		return $this->db->insert("user",$user);
	}

	function validate_user(){
		$this->db->where(
			array("email"=>$this->input->post("email"),
				"password"=>md5(md5($this->input->post("password")))
				)
			);
		$result = $this->db->get("user");
		if($result->num_rows == 1){
			return TRUE;
		}
		return FALSE;
	}

	function get_user($email){
		$this->db->where("email",$email);
		$result = $this->db->get("user");
		if($result->num_rows > 0){
			$result = $result->result_array();
			return $result[0];
		}
		return FALSE;
	}
}