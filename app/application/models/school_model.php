<?php
class School_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function is_registered($uid){
		$this->db->where("uid",$uid);
		$result = $this->db->get("school");
		if($result->num_rows == 1){
			return TRUE;
		}
		return FALSE;
	}
}