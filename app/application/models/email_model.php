<?php
class Email_model extends CI_Model{

	private $data;

	function __construct(){
		parent::__construct();
		$this->load->library("email");
		$this->init();
	}

	function init(){
		//config html email
		$_config['mailtype'] = "html";
		$this->email->initialize($_config);
		$this->data['from_email'] = "info@champions.focuskenya.org";
		$this->data['from_name'] = "FOCUS Champions";
		$this->data['bcc'] = "profnandaa@gmail.com"; //for debugging
	}

	function send($to,$subject,$msg,$html=TRUE,$config=array()){
		if(!isset($config['from_email'])){
			$this->email->from($this->data['from_email'],
								$this->data['from_name']);
			$this->email->reply_to($this->data['from_email'],
								$this->data['from_name']);
		}else{
			$this->email->from($config['from_email'],
								$config['from_name']);
			$this->email->reply_to($config['from_email'],
								$config['from_name']);
		}
		$this->email->to($to);
		$this->email->bcc($this->data['bcc']);
		$this->email->subject($subject);
		if($html){
			//html email, merge $msg with template
			//using str_replace
			$temp = $this->get_template();
			$msg = str_replace("{body}", $msg, $temp);
			$this->email->message($msg);
		}else{
			//plain email
			$this->email->message($msg);
		}

		// echo $msg; die(); // chaged to echo, since xdebug was
											// truncating the var_dump
		
		$this->email->send();

		// echo $this->email->print_debugger(); die();
	}

	function get_template($name="default"){
		$this->db->where("name",$name);
		$result = $this->db->get("email_template");
		if($result->num_rows > 0){
			$result = $result->result();
			return $result[0]->html;
		}
		return FALSE;
	}

	function get_msg($name=""){
		$this->db->where("name",$name);
		$result = $this->db->get("email_message");
		if($result->num_rows > 0){
			$result = $result->result();
			return array(
				"html"=>$result[0]->html,
				"subject"=>$result[0]->subject
				);
		}
		return FALSE;
	}

	function send_test(){
		$msg = "<p>Hello,<br/>
				This is a test email.<br/>
				<br/>
				Regards,<br/>
				<strong>FC Team</strong></p>";
		$this->send(
			"prof@nandaa.com",
			"Test Email",
			$msg,
			TRUE
			);
		echo $this->email->print_debugger();
	}


}