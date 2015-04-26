<?php
class Cron_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function invitation_reminder(){
		$sql = "SELECT * , DATEDIFF( CURRENT_DATE( ) , date_time ) AS diff
				FROM  `invite` 
				WHERE cid_to IS NULL
				HAVING diff >=14";

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
}