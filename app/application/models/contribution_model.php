<?php
class Contribution_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}

	function save_mpesa_transaction($data){
		$this->db->insert("mpesa_ipn", $data);

		$sql = "SELECT max(ipnid) as ipnid
						FROM mpesa_ipn";
		$result = $this->db->query($sql);
		$result = $result->result();
		return $result[0]->ipnid;
	}

	function save_contribution($data){
		$this->db->insert("contribution", $data);
	}

}