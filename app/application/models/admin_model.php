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

	function exec_reports(){
		$reports = array();

		// number of sign-ups
		$reports["signups"] = $this->db->get("champion")->num_rows();
		// amount contributed
		$sql = "SELECT SUM( amount ) AS amount
						FROM  `contribution`";
		$result = $this->db->query($sql)->result();
		$reports["total_contributions"] = $result[0]->amount;

		// invites sent
		$reports["invites"] = $this->db->get("invite")->num_rows();

		// invite responses
		$sql = "SELECT COUNT( cid_to ) AS count
						FROM  `invite`
						WHERE cid_to >0";
		$result = $this->db->query($sql)->result();
		$reports["responses"] = $result[0]->count;

		// commitments made
		$reports["commitments"] = $this->db->get("commitment")
																	->num_rows();

		// commitment amount
		$sql = "SELECT SUM( amount ) AS amount
						FROM  `commitment`";
		$result = $this->db->query($sql)->result();
		$reports["commitment_amount"] = $result[0]->amount;

		// commit later
		$reports["commit_later"] = $this->db->get("commit_later")
																					->num_rows();
		return $reports;
	}

	function get_mpesa_ipn() {
		$sql = "SELECT *, date_format(tstamp,'%h:%i %p %M %e, %Y') as tstamp
						FROM mpesa_ipn";
		return $this->db->query($sql);
	}

	function chart_reports() {
		// monthly reports
		$reports = array();
		$_array = array_fill(0, 12, 0);
		// sign-ups
		$sql = "SELECT MONTH(date_time) as month, count(cid) as count
						FROM champion
						WHERE YEAR(date_time ) = YEAR(CURDATE())
						GROUP BY MONTH(date_time)";
		$result = $this->db->query($sql)->result();
		$signups = $_array;
		foreach($result as $row) {
			$signups[$row->month - 1] = intval($row->count);
		}

		$reports['signups'] = $signups;

		// invites
		

		$reports = json_encode($reports);
		return $reports;
	}
}
