<?php
class Champion_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function validate_champ(){
		$this->db->where(
			array("email"=>$this->input->post("email"),
				"password"=>md5(md5($this->input->post("password")))
				)
			);
		$result = $this->db->get("champion");
		if($result->num_rows == 1){
			return TRUE;
		}
		return FALSE;
	}

	function get_champ($email){
		$this->db->where("email",$email);
		$result = $this->db->get("champion");
		if($result->num_rows > 0){
			$result = $result->result_array();
			return $result[0];
		}
		return FALSE;
	}

	function register_champ(){
		$champ = array(
			"cuid" => $this->input->post("cuid"),
			"atid" => $this->input->post("atid"),
			"grad_year" => $this->input->post("grad_year"),
			"first_name" => $this->input->post("first_name"),
			"last_name" => $this->input->post("last_name"),
			"gender" => $this->input->post("gender"),
			"email" => $this->input->post("email"),
			"phone" => $this->input->post("phone"),
			"password" => md5(md5($this->input->post("password"))) //double md5()
			);

		return $this->db->insert("champion",$champ);
	}

	function get_champ_profile($email){
		$sql = "SELECT *,
				cu.name as cu_name,
				university.name as uni_name,
				champion.email as champ_email,
				affiliation_type.name as aff_type
				FROM champion
				LEFT JOIN cu ON champion.cuid = cu.cuid
				LEFT JOIN university ON cu.uid = university.uid
				LEFT JOIN affiliation_type ON champion.atid = affiliation_type.atid
				WHERE champion.email = '$email'";

		$result = $this->db->query($sql);

		if($result->num_rows > 0){
			$result = $result->result();
			return $result[0];
		}else{
			return array("No result");
		}
	}
}