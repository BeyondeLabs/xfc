<?php
class Cron_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function invitation_reminder(){
		$sql = "SELECT * , DATEDIFF( CURRENT_DATE( ) , date_time ) AS diff
				FROM  `invite` 
				WHERE cid_to IS NULL AND remind=1
				HAVING diff >=14";
				//added 'AND remind..' for convinience

		$result = $this->db->query($sql);

		#load email message
		$_msg = $this->email_model->get_msg("invite_reminder");
		$subject = $_msg['subject'];

		#send email reminders

		$count = 0; //count for testing

		foreach($result->result() as $row){
			$msg = $_msg['html'];

			// echo $row->email."<br/>";
			#send email only if not already sent 2 reminders
			if(($row->remind == 0 && $row->diff >=14) || 
				($row->remind == 1 && $row->diff >=28)){ //modified to disable resending...

				$count++; //for testing //to send 10 reminder emails per day

				if($count == 11){
					break;
				}

				$iid = $row->iid;
				$check = $row->check;
				$invite_link = anchor("home/invited/$iid/$check");
				$invitee = $row->first_name;

				$msg = str_replace("{name}", $invitee, $msg);
				$msg = str_replace("{link}", $invite_link, $msg);

				$to_email = $row->email;

				$this->email_model->send($to_email,$subject,$msg);

				#update table
				$this->db->where("iid",$iid);

				$invite = array("remind"=>0); //default

				if($row->remind == 0){
					$invite = array("remind"=>1);
				}else{
					$invite = array("remind"=>2);
				}

				$this->db->update("invite",$invite);
			}
		}

	}

	function contribution_reminder() {
		// this will be run every 1st day of the month
		$sql = "SELECT * , ct.name as type 
						FROM commitment cm
						LEFT JOIN champion ch ON cm.cid = ch.cid
						LEFT JOIN commitment_type ct ON cm.ctid = ct.ctid";
		$result = $this->db->query($sql);

		$month = intval(date("m"));

		// later might need message queueing!!
		foreach ($result->result() as $row) {
			if ($row->ctid == 2) {
				// monthly, send
				$this->email_contribution_reminder($row);
			}
			else if ($row->ctid == 3) {
				// quarterly, check if it's Jan, Mar, Jun or Dec
				// then email
				if ($month == 1 || ($month % 3 == 0)) {
					$this->email_contribution_reminder($row);
				}
			}
			else if ($row->ctid == 4) {
				// bi-annually, check if it's Jan or Jun
				// then email
				if ($month == 1 || $month == 6) {
					$this->email_contribution_reminder($row);
				}
			}
			else {
				// annually, check if it's Jan, then email
				if ($month == 1) {
					$this->email_contribution_reminder($row);
				}
			}
		}
	}

	function email_contribution_reminder($row) {
		$this->load->model("email_model");
		
		$name = $row->first_name;
		$to_email = $row->email;

		$_msg = $this->email_model->get_msg("contrib_reminder");
		$msg = $_msg['html'];
		$msg = str_replace("{name}", $name, $msg);
		$msg = str_replace("{type}", $row->type, $msg);
		$msg = str_replace("{cid}", $row->cid, $msg);
		$msg = str_replace("{amount}", $row->amount, $msg);

		$subject = $_msg['subject'];

		// record reminder sent
		$contribution_reminder = array(
				"cmid" => $row->cmid
			);
		$this->db->insert("contribution_reminder", 
												$contribution_reminder);

		//placed at the end for easy debugging
		$this->email_model->send($to_email,$subject,$msg);
	}

	function commitment_reminder() {
		// cron job runs daily to see who to remind
		// to make their commitment / pledge
		$sql = "SELECT * 
						FROM  `commit_later` cl
						LEFT JOIN champion c ON cl.cid = c.cid
						WHERE reminder_date = CURDATE( )";
		$result = $this->db->query($sql);

		foreach ($result->result() as $row) {
			// update commit_later table
			if ($row->reminded < 1) {
				$reminded = array("reminded" => 1);
			}
			else{
				$reminded = array("reminded" => ($row->reminded + 1));
			}
			$this->db->where("clid", $row->clid);
			$this->db->update("commit_later", $reminded);

			$this->email_commitment_reminder($row);
		}
	}

	function email_commitment_reminder($row) {
		$this->load->model("email_model");
		
		$name = $row->first_name;
		$to_email = $row->email;

		$_msg = $this->email_model->get_msg("commit_reminder");
		$msg = $_msg['html'];
		$msg = str_replace("{name}", $name, $msg);

		$subject = $_msg['subject'];

		//placed at the end for easy debugging
		$this->email_model->send($to_email,$subject,$msg);
	}

	function weekly_executive_report() {
		// reports sent to executive every Monday morning

		$report = array();
		// sign-ups last week
		$sql = "SELECT count(cid) as count
						FROM `champion`
						WHERE WEEK(date_time) = (WEEK(CURDATE())-1)";
		$result = $this->db->query($sql)->result();
		$report["signups"] = $result[0]->count;

		// amount contributed
		$sql = "SELECT sum(amount) AS amount, count(ctid) as count
						FROM `contribution`
						WHERE WEEK(date_time) = (WEEK(CURDATE())-1)";
		$result = $this->db->query($sql)->result();
		$report["contrib_amount"] = $result[0]->amount;
		$report["contrib_count"] = $result[0]->count;

		// commitments
		$sql = "SELECT count(cmid) AS count
						FROM `commitment`
						WHERE WEEK(commit_date) = (WEEK(CURDATE())-1)";
		$result = $this->db->query($sql)->result();
		$report["commitment"] = $result[0]->count;

		// email to exec
		$this->load->model("email_model");
		$to_email = "nkimani@focuskenya.org";

		$date = strtotime("last sunday");
		$date = date('l, F d, Y', $date);

		$_msg = $this->email_model->get_msg("exec_report");
		$msg = $_msg['html'];
		$msg = str_replace("{date}", $date, $msg);
		$msg = str_replace("{signups}", $report['signups'], $msg);
		$msg = str_replace("{commitment}", $report['commitment'], $msg);
		$msg = str_replace("{contrib_count}", $report['contrib_count'], $msg);
		$msg = str_replace("{contrib_amount}", "KES. ".$report['contrib_amount'], $msg);

		$subject = $_msg['subject'];

		$this->email_model->send($to_email,$subject,$msg);
	}

}