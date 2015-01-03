<?php
class Email_model extends CI_Model{

	private $data;

	function __construct(){
		parent::__construct();
		$this->load->library("email");
		$this->init();
	}

	function init(){
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
			//using preg_match
			$this->email->message($msg);
		}else{
			//plain email
			$this->email->message($msg);
		}

		$this->email->send();
	}

	function get_template($name="default"){

	}

	function send_test(){
		$msg = 
"Hello,
This is a test email.
Rgds, FC Team";
		$this->send(
			"prof@nandaa.com",
			"Test Email",
			$msg,
			FALSE
			);
		echo $this->email->print_debugger();
	}


}