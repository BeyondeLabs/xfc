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
			//log
			$result = $result->result();
			$result = $result[0];
			$log = array(
				"cid"=> $result->cid,
				"type"=>"login",
				"value_text"=>"success"
				);
			$this->champion_log($log);
			return TRUE;
		}
		return FALSE;
	}

	function get_champ($arg){
		//$arg can be email or cid
		if($arg > 0){
			//$arg is cid
			$this->db->where("cid",$arg);
		}else{
			//$arg is email
			$this->db->where("email",$arg);
		}
		$result = $this->db->get("champion");
		if($result->num_rows > 0){
			$result = $result->result_array();
			return $result[0];
		}
		return FALSE;
	}

	function register_champ(){
		//clean up cases (capitalization)
		$first_name = $this->input->post("first_name");
		$last_name = $this->input->post("last_name");
		$first_name = ucfirst(strtolower($first_name));
		$last_name = ucfirst(strtolower($last_name));


		$champ = array(
			"in_cu" => $this->input->post("in_cu"),
			"cuid" => $this->input->post("cuid"),
			"atid" => $this->input->post("atid"),
			"grad_year" => $this->input->post("grad_year"),
			"title" => $this->input->post("title"),
			"first_name" => $first_name,
			"last_name" => $last_name,
			"gender" => $this->input->post("gender"),
			"marital_status" => $this->input->post("marital_status"),
			"email" => $this->input->post("email"),
			"phone" => $this->input->post("phone"),
			"password" => md5(md5($this->input->post("password"))) //double md5()
			);

		$this->db->insert("champion",$champ);

		//get the cid
		$sql = "SELECT max(cid) as cid FROM champion";
		$result = $this->db->query($sql);
		$result = $result->result();
		$cid_to = $result[0]->cid;

		//update invite table where applicable
		$this->db->where("email",$this->input->post("email"));
		$invite = array(
			"cid_to" => $cid_to
			);
		
		return $this->db->update("invite",$invite);
	}

	function get_champ_profile($arg){
		if($arg>0){
			#cid
			$sql = "SELECT *,
				cu.name as cu_name,
				university.name as uni_name,
				champion.email as champ_email,
				affiliation_type.name as aff_type,
				champion.cid as champ_id
				FROM champion
				LEFT JOIN cu ON champion.cuid = cu.cuid
				LEFT JOIN university ON cu.uid = university.uid
				LEFT JOIN affiliation_type ON champion.atid = affiliation_type.atid
				WHERE champion.cid = $arg";
		}else{
			#email
			$sql = "SELECT *,
				cu.name as cu_name,
				university.name as uni_name,
				champion.email as champ_email,
				affiliation_type.name as aff_type
				FROM champion
				LEFT JOIN cu ON champion.cuid = cu.cuid
				LEFT JOIN university ON cu.uid = university.uid
				LEFT JOIN affiliation_type ON champion.atid = affiliation_type.atid
				WHERE champion.email = '$arg'";
		}

		$result = $this->db->query($sql);

		if($result->num_rows > 0){
			$result = $result->result();
			return $result[0];
		}else{
			return FALSE;
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
		if($other_amount > 0) $amount = $other_amount;

		$commitment = array(
			"cid" => $this->session->userdata("cid"),
			"ctid" => $this->input->post("ctid"),
			"date_from" => $this->input->post("date_from"),
			"date_to" => $this->input->post("date_to"),
			"lifetime" => $this->input->post("lifetime"),
			"amount" => $amount,
			"payment_mode" =>  $this->input->post("payment_mode")
			);

		$this->db->insert("commitment",$commitment);

		//delete from list of commit_later, if exists
		$this->db->where("cid", $this->session->userdata("cid"));
		$this->db->delete("commit_later");
		return TRUE;
	}

	function update_commitment($cid){
		$this->db->where("cid",$cid);
		
		$this->db->set("commit_date","NOW()",FALSE);
		$commitment = array(
			"ctid" => $this->input->post("ctid"),
			"date_from" => $this->input->post("date_from"),
			"date_to" => $this->input->post("date_to"),
			"lifetime" => $this->input->post("lifetime"),
			"amount" => $this->input->post("amount"),
			"payment_mode" =>  $this->input->post("payment_mode")
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

	function get_commitment_details2($cid){
		$sql = "SELECT *
				FROM commitment c
				WHERE c.cid = $cid";
		$result = $this->db->query($sql);
		if($result->num_rows > 0){
			$result = $result->result();
			return $result[0];
		}
		return false;
	}

	function will_commit_later($cid){
		//see if said will commit later
		//or the commitment date has passed

		//first check if already commited
		$this->db->where("cid",$cid);
		$result = $this->db->get("commitment");

		if($result->num_rows > 0){
			return FALSE;
		}

		$sql = "SELECT *
				FROM commit_later
				WHERE cid = $cid"; //AND reminder_date >= NOW()
		$result = $this->db->query($sql);
		if($result->num_rows > 0){
			return TRUE;
		}
		return FALSE;
	}

	function commit_later($cid){
		$commit_later = array(
			"cid" => $cid,
			"reminder_date" => $this->input->post("reminder_date")
			);

		return $this->db->insert("commit_later",$commit_later);
	}

	function get_commit_later($cid){
		$sql = "SELECT date_format(reminder_date,'%M %e, %Y') as reminder_date
				FROM commit_later
				WHERE cid = $cid";
		return $this->db->query($sql);
	}

	function get_champs(){
		//total number of champions
		return $this->db->get("champion")->num_rows;
	}

	function get_champs_invited(){
		//total number of invited champions
		return $this->db->get("invite")->num_rows;
	}

	function get_champs_invited_details(){
		// return $this->db->get("invite");
		$sql = "SELECT concat(c.first_name,' ',c.last_name) as inviter, 
				c.cid,i.cid_to,
				date_format(i.response_datetime,'%M %e, %Y') as response_date,
				date_format(i.date_time,'%M %e, %Y') as invite_date,
				concat(i.first_name,' ',i.last_name) as invitee
				FROM invite i
				LEFT JOIN champion c ON i.cid_from = c.cid
				ORDER BY inviter, invitee";

		return $this->db->query($sql);
	}

	function get_champs_list(){
		$sql = "SELECT *,
				champion.email as champ_email,
				champion.cid as cid,
				date_format(champion.date_time,'%M %e, %Y') as joined,
				at.name as at_name,
				cu.name as cu_name,
				cu.website as cu_website,
				uni.name as uni_name,
				ct.name as ct_name
				FROM champion
				LEFT JOIN commitment ON champion.cid = commitment.cid
				LEFT JOIN commitment_type ct ON ct.ctid = commitment.ctid
				LEFT JOIN affiliation_type at ON champion.atid = at.atid
				LEFT JOIN cu ON champion.cuid = cu.cuid
				LEFT JOIN university uni ON uni.uid = cu.uid
				ORDER BY champion.first_name ASC";

		return $this->db->query($sql);
	}

	function get_commitment_type_name($ctid){
		$this->db->where("ctid",$ctid);
		$result = $this->db->get("commitment_type");
		if($result->num_rows > 0){
			$result = $result->result();
			$result = $result[0];
			return $result->name;
		}else{
			return "<none>";
		}
	}

	function get_champs_committed(){
		$sql = "SELECT *,
				date_format(date_from,'%M %e, %Y') as date_from,
				date_format(date_to,'%M %e, %Y') as date_to,
				date_format(commit_date,'%M %e, %Y') as commit_date,
				date_format(champion.date_time,'%M %e, %Y') as reg_date
				FROM commitment c
				LEFT JOIN commitment_type ct ON ct.ctid = c.ctid
				LEFT JOIN champion ON c.cid = champion.cid
				ORDER BY champion.first_name ASC
				";
		return $this->db->query($sql);

	}

	function get_champs_commit_later(){
		$sql = "SELECT *,
				date_format(cl.date_time,'%M %e, %Y') as date_time,
				date_format(reminder_date,'%M %e, %Y') as reminder_date
				FROM commit_later cl
				LEFT JOIN champion ON cl.cid = champion.cid
				ORDER BY champion.first_name ASC
				";
		return $this->db->query($sql);
	}

	function champion_log($log){
		return $this->db->insert("champion_log",$log);
	}

	function add_org($cid){
		$org = array(
			"name" => $this->input->post("name"),
			"url" => $this->input->post("url"),
			"designation" => $this->input->post("designation"),
			"date_from" => $this->input->post("date_from"),
			"date_to" => $this->input->post("date_to"),
			"cid" => $cid,
			"current" => $this->input->post("current")
			);

		return $this->db->insert("organization",$org);
	}

	function get_org($cid){
		$sql = "SELECT *,
				date_format(date_from,'%b %Y') as date_from,
				date_format(date_to,'%b %Y') as date_to
				FROM organization
				WHERE cid = $cid";
		return $this->db->query($sql);
	}

	function invite($cid){
		//clean up cases (capitalization)
		$first_name = $this->input->post("first_name");
		$last_name = $this->input->post("last_name");
		$first_name = ucfirst(strtolower($first_name));
		$last_name = ucfirst(strtolower($last_name));

		$invite = array(
			"cid_from" => $cid,
			"email" => $this->input->post("email"),
			"phone" => $this->input->post("phone"),
			"first_name" => $first_name,
			"last_name" => $last_name
			);

		$this->db->insert("invite",$invite);
		//get the iid for the invite
		$sql = "SELECT max(iid) as iid FROM invite";
		$result = $this->db->query($sql);
		$result = $result->result();
		$iid = $result[0]->iid;

		$check = bin2hex(openssl_random_pseudo_bytes(rand(2,10), $cstrong));
		//save in DB for counter-checking
		$invite = array(
			"check" => $check,
			"cstrong"=> $cstrong
			);
		$this->db->where("iid",$iid);
		$this->db->update("invite",$invite);

		return array("iid"=>$iid,
					"check"=>$check);
	}

	function get_invite($cid){
		$sql = "SELECT *,
				date_format(date_time,'%b %e, %Y, %l:%i %p') as date_time,
				date_format(response_datetime,'%b %e, %Y, %l:%i %p') as response_datetime
				FROM invite
				WHERE cid_from = $cid
				ORDER BY response_datetime DESC,first_name ASC";
		return $this->db->query($sql);
	}

	function invited($iid,$check){
		$this->db->where(array(
			"iid"=>$iid,
			"check"=>$check
			));

		$result = $this->db->get("invite");
		if($result->num_rows > 0){
			//add response date/time
			$invite = array(
				"response_datetime" => date('Y-m-d H:i:s')
				);
			$this->db->where("iid",$iid);
			$this->db->update("invite",$invite);

			return TRUE;
		}
		return FALSE;
	}

	function password_reset($email){
		//get cid from email
		$champ = $this->get_champ($email);

		if($champ){
			// var_dump($champ['cid']);die();
			$check = bin2hex(openssl_random_pseudo_bytes(rand(2,10), $cstrong));

			$password_reset = array(
				"cid" => $champ['cid'],
				"check" => $check,
				"cstrong" => $cstrong
				);
			$this->db->insert("password_reset",$password_reset);

			//send email
			$this->load->model("email_model");
			$_msg = $this->email_model->get_msg("password_reset");
			$msg = $_msg['html'];

			$to_email = $champ['email'];
			$name = $champ['first_name'];
			$reset_link = anchor("home/reset/".$champ['cid']."/".$check);

			$msg = str_replace("{name}", $name, $msg);
			$msg = str_replace("{reset_link}", $reset_link, $msg);
			$subject = $_msg['subject'];

			$this->email_model->send($to_email,$subject,$msg);

			return TRUE;
		}else{
			return FALSE;
		}

	}

	function password_reset_validate($cid,$check){
		$this->db->where(
			array(
				"cid"=>$cid,
				"check"=>$check
				)
			);
		$result = $this->db->get("password_reset");
		if($result->num_rows > 0){
			return TRUE;
		}
		return FALSE;
	}

	function password_new($cid){
		$this->db->where("cid",$cid);
		$champ = array(
			"password"=>md5(md5($this->input->post("password")))
			);
		$this->db->update("champion",$champ);
	}

	function commitments_reset(){
		#to avoid sending twice
		$sent = $this->db->get("commitment_reset");
		if($sent->num_rows > 2){
			echo "Reset emails already sent";
			die();
		}

		#Get list of all commitments made
		// $c = $this->get_commitment_details2();
		$sql = "SELECT *
				FROM commitment cm
				LEFT JOIN champion c ON cm.cid = c.cid";
		$result = $this->db->query($sql);

		foreach($result->result() as $row){
			$check = bin2hex(openssl_random_pseudo_bytes(rand(2,10), $cstrong));

			$commitment_reset = array(
				"cid" => $row->cid,
				"check" => $check
				);
			$this->db->insert("commitment_reset",$commitment_reset);

			#send email
			$this->load->model("email_model");
			// $_msg = $this->email_model->get_msg("password_reset");
			$msg = "
<p>Dear {first_name},<br/>
Kindly click on this link to fill in your commitment form again - {link} </p>
<p>We are sorry for the inconvinience.</p>
<p>Regards,<br/><br/>
<strong>FOCUS Champions Team</strong></p>";

			$to_email = $row->email;
			$link = anchor("home/commitment/".$row->cid."/".$check);

			$msg = str_replace("{first_name}", $row->first_name, $msg);
			$msg = str_replace("{link}", $link, $msg);
			$subject = "Please Resubmit Your Commitment Form";

			$this->email_model->send($to_email,$subject,$msg);
		}
	}

	#hopefully to be used only once and archived
	function check_reset_commitment($cid,$check){
		$this->db->where(array(
			"cid" => $cid,
			"check" => $check
			));
		$result = $this->db->get("commitment_reset");

		if($result->num_rows > 0){
			//update
			$this->db->where(array(
				"cid" => $cid,
				"check" => $check
			));
			$commitment_reset = array(
				"reset"=>1
				);
			$this->db->update("commitment_reset",$commitment_reset);

			return TRUE;
		}
		return FALSE;
	}
}