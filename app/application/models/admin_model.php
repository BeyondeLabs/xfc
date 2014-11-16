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

	function get_uni_list(){
		$this->db->order_by("name");
		return $this->db->get("university");
	}

	function get_uni_list_array(){
		$uni = $this->get_uni_list();
		$uni_list = array();
		foreach($uni->result_array() as $row){
			$uni_list[$row['uid']] = $row['name'];
		}

		return $uni_list;
	}

	function get_cu_list(){
		$this->db->order_by("name");
		return $this->db->get("cu");
	}

	function get_cu_list_array(){
		$cu = $this->get_cu_list();
		$cu_list = array();
		foreach($cu->result_array() as $row){
			$cu_list[$row['cuid']] = $row['name'];
		}

		return $cu_list;
	}

	function add_cu(){
		$cu = array(
			"uid" => $this->input->post("uid"),
			"name" => $this->input->post("name"),
			"email" => $this->input->post("email"),
			"website" => $this->input->post("website")
			);

		return $this->db->insert("cu",$cu);
	}

	function get_uni_cu(){
		//combined Uni/college + CU name
		$sql = "SELECT *, 
				cu.name as cu,
				university.name as uni,
				cu.website as cu_website
				FROM cu
				LEFT JOIN university ON cu.uid = university.uid
				ORDER BY university.name, cu.name";

		return $this->db->query($sql);
	}
}