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

	function get_contribution_total($cid=0) {
		if($cid == 0) {
			//all the contribution
			$sql = "SELECT sum(amount) as amount
							FROM `contribution`";
		}
		else {
			//for an individual
			$sql = "SELECT sum(amount) as amount
							FROM `contribution`
							WHERE cid = ".$cid;
		}
		$res = $this->db->query($sql)->result();
		return $res[0]->amount;
	}

	function get_last_mpesa_ipn(){
		$sql = "SELECT * FROM mpesa_ipn
						WHERE mpesa_acc LIKE 'champ%'
						ORDER BY ipnid DESC
						LIMIT 1";

		$res = $this->db->query($sql)->result();
		return $res[0];
	}

	function mpesa_ipn_processed($ipnid) {
		$this->db->where("ipnid",$ipnid);
		return $this->db->update("mpesa_ipn",array("processed" => 1));
	}

	function get_all_contribution() {
		$sql = "SELECT *, date_format(tstamp,'%M %e, %Y') as tstamp,
						cmt.name as commitment_type  
						FROM contribution ct
						LEFT JOIN mpesa_ipn m ON ct.ipnid = m.ipnid
						LEFT JOIN champion c ON ct.cid = c.cid
						LEFT JOIN commitment cm ON c.cid = cm.cid
						LEFT JOIN commitment_type cmt ON cm.ctid = cmt.ctid
						ORDER BY m.ipnid DESC";

		return $this->db->query($sql);
	}
}