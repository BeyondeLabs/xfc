<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	private $data;

	function __construct(){
		parent::__construct();
		$this->load->model("champion_model");
		$this->load->model("cu_model");
		$this->load->model("general_model");
	}

	private function is_logged_in(){
		return $this->session->userdata("logged_in");
	}

	private function _load_view(){
		$this->load->view("inc/temp",$this->data);
	}

	public function index()
	{
		//redirect if is_admin
		if($this->session->userdata("is_admin")){
			redirect("admin");
		}
		
		$this->data['champs'] = $this->champion_model->get_champs();
		$this->data['invited'] = $this->champion_model->get_champs_invited();
		if($this->is_logged_in()){
			//redirect for now
			redirect("champion/profile");
			$this->data['main'] = "home/index_auth";
		}else{
			$this->data['main'] = "home/index";
		}
		$this->_load_view();
	}

	public function about(){
		$this->data['main'] = "home/about";
		$this->_load_view();
	}

	public function pre(){
		//preamble before registration
		$this->data['main'] = "home/register_pre";
		$this->_load_view();
	}

	public function register($mode="form", $cu=1){
		if($mode=="form"){
			$this->data['uni_cu'] = $this->cu_model->get_uni_cu();
			// affiliation types
			$this->data['aff_type'] = $this->cu_model->get_aff_type();
			if($cu != 1) $cu = 0;
			$this->data['in_cu'] = $cu;
			$this->data['step'] = array(1,3);
			$this->data['main'] = "home/register";
			$this->_load_view();
		}
		elseif($mode=="submit"){
			#process submitted form
			$this->load->library("form_validation");

			$rules = $this->general_model->validation_rules("champion");
			$this->form_validation->set_rules($rules);

			if($this->form_validation->run()){
				if($this->champion_model->register_champ()){
					#email user, later will add verification code
					$this->load->model("email_model");

					$name = $this->input->post("first_name");
					$to_email = $this->input->post("email");

					$_msg = $this->email_model->get_msg("welcome");
					$msg = $_msg['html'];
					$msg = str_replace("{name}", $name, $msg);
					$subject = $_msg['subject'];

					$this->email_model->send($to_email,$subject,$msg);

					#auto-login user
					$user = $this->champion_model->get_champ($this->input->post("email"));
					$this->session->set_userdata($user);
					$this->session->set_userdata("logged_in",TRUE);

					//log step 1 completed
					$log = array(
							"cid" => $this->session->userdata("cid"),
							"type" => "register",
							"value_int" => 1
						);
					$this->champion_model->champion_log($log);

					redirect("champion/step/commitment");
				}else{
					#almost impossible to get here?
				}
			}else{
				$this->register();
			}	
		}
		else{
			#404
			redirect("home/register");
		}
	}

	public function login($mode="form"){
		if($this->session->userdata("logged_in")){
			$this->logout();
		}
		if($mode=="form"){
			$this->data['main'] = "home/login";
			$this->_load_view();
		}
		if($mode=="submit"){
			if($this->champion_model->validate_champ()){
				$user = $this->champion_model->get_champ($this->input->post("email"));
				$this->session->set_userdata($user);
				$this->session->set_userdata("logged_in",TRUE);
				
				redirect("champion/profile");
			}else{
				$this->session->set_flashdata("error","Wrong email/password");
				$this->login();
			}
		}
	}

	public function alogin($mode="form"){
		if($mode=="form"){
			$this->data['main'] = "home/login_admin";
			$this->_load_view();
		}
		if($mode=="submit"){
			$this->load->model("admin_model");
			if($this->admin_model->validate_admin()){
				$admin = $this->admin_model->get_admin($this->input->post("email"));
				$this->session->set_userdata($admin);
				$this->session->set_userdata("logged_in",TRUE);
				$this->session->set_userdata("is_admin",TRUE);
				
				redirect("admin");
			}else{
				redirect("home/alogin");
			}
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect("home");
	}

	public function feedback($mode="form"){
		if($mode=="form"){
			$this->data['main'] = "home/feedback_form";
			$this->_load_view();
		}

		if($mode=="submit"){
			$this->load->library("form_validation");
			if(!$this->is_logged_in()){
				$rules = $this->general_model->validation_rules("feedback");
			}else{
				$rules = array(
					array(
						'field'=>'feedback',
						'label'=>'Feedback',
						'rules'=>'required'
					)
					);
			}
			
			$this->form_validation->set_rules($rules);

			if($this->form_validation->run()){
				$this->general_model->add_feedback();
				$this->session->set_flashdata("msg",
					"Thanks for your feedback");
				redirect("home");
			}else{
				$this->feedback();
			}
		}
	}

	public function contact(){
		$this->data['main'] = "home/contact";
		$this->_load_view();
	}

	public function email(){
		//testing email
		$this->load->model("email_model");
		$this->email_model->send_test();
	}

	public function invited($iid,$check){
		//logout whoever logged in
		$this->session->sess_destroy();

		//iid --> invite ID, $check --> hash
		$this->champion_model->invited($iid,$check);

		redirect("home");
	}

	public function reset($mode="form",$arg=""){
		if($mode=="form"){
			$this->data['main'] = "home/reset";
			$this->_load_view();
		}

		if($mode=="submit"){
			$this->load->library("form_validation");
			$this->form_validation->set_rules("email","Email","required|valid_email");

			if($this->form_validation->run()){
				$email = $this->input->post("email");
				if($this->champion_model->password_reset($email)){
					$this->session->set_flashdata("success","An email has been sent to you with the reset instructions");
				}else{
					$this->session->set_flashdata("error","Please put the correct email");
				}
				redirect("home/reset");
			}else{
				$this->reset();
			}
		}

		if($mode > 0){
			//reset link clicked on from the email
			$check = $arg;
			$cid = $mode;
			if($check != ""){
				if($this->champion_model->password_reset_validate($cid,$check)){
					//auto-login and redirect to set-new-password section
					$user = $this->champion_model->get_champ($cid);
					$this->session->set_userdata($user);
					$this->session->set_userdata("logged_in",TRUE);
					redirect("champion/reset");
				}
			}else{
				redirect("home");
			}
		}
	}

	public function commitment($cid,$check){
		if($this->champion_model->check_reset_commitment($cid,$check)){
			#auto-login user
			$user = $this->champion_model->get_champ($cid);
			$this->session->set_userdata($user);
			$this->session->set_userdata("logged_in",TRUE);

			#redirect to commitment form update
			redirect("champion/commitment/edit");
		}else{
			redirect("home");
		}
	}

	public function cron($type="test"){
		$this->load->model("cron_model");

		if($type=="test"){
			$this->general_model->cron_test();
		}

		if($type=="daily"){
			#daily fired cron jobs

			#sending invitation reminders
			$this->cron_model->invitation_reminder();
		}
	}

	public function mpesa() {
		//receives a post request from the MPesa IPN script

		//record transaction in table
		$this->load->model("contribution_model");

		//head to rewrite just in case the IPN structure changes
		//i.e. more data is added to it
		$data = array(
			"id" => $_POST["id"],
			"orig" => $_POST["orig"],
			"dest" => $_POST["dest"],
			"tstamp" => $_POST["tstamp"],
			"text" => $_POST["text"],
			"customer_id" => $_POST["customer_id"],
			"user" => $_POST["user"],
			"pass" => $_POST["pass"],
			"routemethod_id" => $_POST["routemethod_id"],
			"routemethod_name" => $_POST["routemethod_name"],
			"mpesa_code" => $_POST["mpesa_code"],
			"mpesa_acc" => $_POST["mpesa_acc"],
			"mpesa_msisdn" => $_POST["mpesa_msisdn"],
			"mpesa_trx_date" => $_POST["mpesa_trx_date"],
			"mpesa_trx_time" => $_POST["mpesa_trx_time"],
			"mpesa_amt" => $_POST["mpesa_amt"],
			"mpesa_sender" => $_POST["mpesa_sender"],
			"business_number" => $_POST["business_number"]
			);

		//testing stub

		// $data = array(
		// 	"id" => "2345",
		// 	"orig" => "MPESA",
		// 	"dest" => "254702137717",
		// 	"tstamp" => "2015-07-30 23:03:32",
		// 	"text" => "JGU0SWAWMQ Confirmed. on 30/7/15 at 11:03 PM Ksh50.00 received from ANTHONY BARASA 254728590438.  Account Number IPN Test New Utility balance is Ksh41,614.00",
		// 	"customer_id" => "7540",
		// 	"user" => "default",
		// 	"pass" => "default",
		// 	"routemethod_id" => "2",
		// 	"routemethod_name" => "HTTP",
		// 	"mpesa_code" => "JGU0SWAWMQ",
		// 	"mpesa_acc" => "champ-17",
		// 	"mpesa_msisdn" => "254728590438",
		// 	"mpesa_trx_date" => "30/7/15",
		// 	"mpesa_trx_time" => "11:03 PM",
		// 	"mpesa_amt" => "50.0",
		// 	"mpesa_sender" => "ANTHONY BARASA",
		// 	"business_number" => "412412"
		// 	);
		
		$ipnid = $this->contribution_model->save_mpesa_transaction($data);


		$mpesa_acc = $_POST["mpesa_acc"];
		// $mpesa_acc = "champ-17";

		$acc = explode("-", $mpesa_acc);

		if(sizeof($acc) == 2) {
			$cid = $acc[1]; //champion ID


			$data = array(
				"cid" => $cid,
				"amount" => $_POST["mpesa_amt"],
				"ipnid" => $ipnid,
				"method" => "mpesa"
				);

			$this->contribution_model->save_contribution($data);

			//send acknowledgement email
		}
	}
}