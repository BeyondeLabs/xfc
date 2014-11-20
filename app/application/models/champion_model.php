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

	function update_profile($cid){
		$this->db->where("cid",$cid);
		$champ = array(
			"cuid" => $this->input->post("cuid"),
			"atid" => $this->input->post("atid"),
			"grad_year" => $this->input->post("grad_year"),
			"first_name" => $this->input->post("first_name"),
			"last_name" => $this->input->post("last_name"),
			"gender" => $this->input->post("gender"),
			"email" => $this->input->post("email"),
			"phone" => $this->input->post("phone"),
			"phone_alt" => $this->input->post("phone_alt"),
			"location" => $this->input->post("location"),
			"url" => $this->input->post("url"),
			"url_fb" => $this->input->post("url_fb"),
			"url_tw" => $this->input->post("url_tw")
			);

		return $this->db->update("champion",$champ);
	}

	function made_commitment($cid){
		$this->db->where("cid",$cid);
		$result = $this->db->get("commitment");
		if($result->num_rows > 0){
			return TRUE;
		}
		return FALSE;
	}

	function get_commitment_type(){
		return $this->db->get("commitment_type");
	}

	function save_commitment(){
		$amount = $this->input->post("amount");
		$other_amount = $this->input->post("other_amount");
		if($amount == 0) $amount = $other_amount;

		$commitment = array(
			"cid" => $this->session->userdata("cid"),
			"ctid" => $this->input->post("ctid"),
			"date_from" => $this->input->post("date_from"),
			"date_to" => $this->input->post("date_to"),
			"lifetime" => $this->input->post("lifetime"),
			"amount" => $amount
			);

		return $this->db->insert("commitment",$commitment);
	}

	function update_commitment(){
		$commitment = array(
			"ctid" => $this->input->post("ctid"),
			"date_from" => $this->input->post("date_from"),
			"date_to" => $this->input->post("date_to"),
			"lifetime" => $this->input->post("lifetime"),
			"amount" => $this->input->post("amount")
			);

		return $this->db->update("commitment",$commitment);
	}

	function get_commitment_details($cid){
		$sql = "SELECT *,
				date_format(date_from,'%M %e, %Y') as date_from,
				date_format(date_to,'%M %e, %Y') as date_to
				FROM commitment c
				LEFT JOIN commitment_type ct ON c.ctid = ct.ctid
				WHERE c.cid = $cid";
		$result = $this->db->query($sql);
		if($result->num_rows > 0){
			$result = $result->result();
			return $result[0];
		}
		return false;
	}

	function get_champs(){
		//total number of champions
		return $this->db->get("champion")->num_rows;
	}

	function get_champs_list(){
		$sql = "SELECT *,
				champion.email as champ_email,
				cu.name as cu_name,
				cu.website as cu_website,
				uni.name as uni_name
				FROM champion
				LEFT JOIN affiliation_type at ON champion.atid = at.atid
				LEFT JOIN cu ON champion.cuid = cu.cuid
				LEFT JOIN university uni ON uni.uid = cu.uid";

		return $this->db->query($sql);
	}
}