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

	function get_contribution_history($cid) {
		$sql = "SELECT * , date_format(tstamp,'%M %e, %Y') as tstamp
						FROM `contribution` c
						LEFT JOIN mpesa_ipn m ON c.ipnid = m.ipnid
						WHERE c.cid = ".$cid;
		return $this->db->query($sql);
	}

	function get_contribution_total($cid) {
		$sql = "SELECT sum(amount) as amount
						FROM `contribution`
						WHERE cid = ".$cid;
		$res = $this->db->query($sql)->result();
		return $res[0]->amount;
	}
}