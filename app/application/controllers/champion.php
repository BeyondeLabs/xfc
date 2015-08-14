<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Champion extends CI_Controller {
	private $data;

	function __construct(){
		parent::__construct();
		// $this->load->model("cu_model");
		$this->load->model("champion_model");
		$this->is_logged_in();
		$this->data['cid'] = $this->session->userdata("cid");
	}

	private function is_logged_in(){
		if(!$this->session->userdata('logged_in')){
			$this->session->sess_destroy();
			redirect('home/login');
		}
	}

	private function _load_view(){
		$this->load->view("inc/temp",$this->data);
	}

	public function index()
	{
		//redirect for now
		redirect("champion/profile");
		$this->data['main'] = "champion/index";
		$this->_load_view();
	}

	public function p($cid=21){
		#admin-only view of the profile
		if(!$this->session->userdata('logged_in') ||
			!$this->session->userdata('is_admin')){
			$this->session->sess_destroy();
			redirect('home');
		}

		$this->data['css_class'] = "profile";
		$this->data['css_id'] = "profile";
		$this->data['profile'] = $this->champion_model
															->get_champ_profile($cid);
		// if(!$this->data['profile']) redirect("admin");
		$this->data['champs_count'] = $this->champion_model->get_champs();
		$this->data['champs_invited'] = $this->champion_model
																				->get_champs_invited();
		$this->data['main'] = "champion/profile_public";
		$this->data['cd'] = $this->champion_model->get_commitment_details($cid);
		$this->data['org'] = $this->champion_model->get_org($cid);
		$this->data['invite'] = $this->champion_model->get_invite($cid);
		$this->data['cl'] = $this->champion_model->get_commit_later($cid);
		$this->_load_view();
	}

	public function profile($mode="view"){
		$this->data['css_class'] = "profile";
		$this->data['css_id'] = "profile";
		$this->data['champs_count'] = $this->champion_model->get_champs();
		$this->data['champs_invited'] = $this->champion_model
																			->get_champs_invited();

		if($mode=="view"){
			
			if(!$this->champion_model->made_commitment($this->data['cid']) &&
				!$this->champion_model->will_commit_later($this->data['cid'])){
				redirect("champion/commitment/form");
			}
			$this->data['main'] = "champion/profile";
			$this->data['cd'] = $this->champion_model
															->get_commitment_details($this->data['cid']);
			$this->data['profile'] = $this->champion_model->get_champ_profile
										($this->session->userdata("email"));
			$this->data['org'] = $this->champion_model->get_org($this->data['cid']);
			$this->data['invite'] = $this->champion_model
																->get_invite($this->data['cid']);
			$this->data['cl'] = $this->champion_model
															->get_commit_later($this->data['cid']);

			$this->load->model('contribution_model');
			$this->data['contrib_total'] = $this->contribution_model
																					->get_contribution_total(
																						$this->data['cid']);
			$this->_load_view();
		}

		if($mode=="edit"){
			$this->load->model("cu_model");
			$this->data['uni_cu'] = $this->cu_model->get_uni_cu();
			// affiliation types
			$this->data['aff_type'] = $this->cu_model->get_aff_type();
			$this->data['main'] = "champion/profile_edit";
			$this->data['profile'] = $this->champion_model->get_champ_profile
										($this->session->userdata("email"));
			$this->_load_view();
		}

		if($mode=="update"){
			#process submitted form
			$this->load->library("form_validation");

			$this->load->model("general_model");
			$rules = $this->general_model->validation_rules("champion_edit");
			$this->form_validation->set_rules($rules);

			if($this->form_validation->run()){
				
				$this->champion_model->update_profile($this->data['cid']);
				redirect("champion/profile");
			}else{
				$this->profile("edit");
			}
		}
	}

	public function commitment($mode="view", $mode2=1){
		//check first if made a commitment, if not, take to
		//commitment form
		$this->data['mode2'] = $mode2;

		if($mode=="view"){
			if($this->champion_model->will_commit_later($this->data['cid'])){
				redirect("champion/commitment/form/2");
			}

			$this->data['main'] = "champion/commitment_view";
			$this->data['cd'] = $this->champion_model
																->get_commitment_details($this->data['cid']);
			$this->_load_view();
		}

		if($mode=="form"){
			//if already commited
			$this->_has_committed($this->session->userdata("cid"));

			$this->data['date_picker'] = TRUE;
			$this->data['step'] = array(2,3);
			$this->data['main'] = "champion/commitment_form";
			$this->data['commitment_type'] = $this->champion_model
																					->get_commitment_type();
			$this->_load_view();
		}

		if($mode=="submit"){
			//if already commited
			$this->_has_committed($this->session->userdata("cid"));

			$this->load->library("form_validation");

			if($this->input->post("amount")==0){
				$rule = array(
						'field'=>'other_amount',
						'label'=>'Specified Amount',
						'rules'=>'required|greater_than[199]'
					);
			}else{
				$rule = array(
						'field'=>'other_amount',
						'label'=>'Specified Amount',
						'rules'=>'greater_than[199]'
					);
			}

			if($this->input->post("lifetime") != 1){
				$rule2 = array(
					'field'=>'date_to',
					'label'=>'End Date',
					'rules'=>'required|callback_validate_end_date'
					);
			}else{
				$rule2 = array(
					'field'=>'date_to',
					'label'=>'End Date',
					'rules'=>'none'
					);
			}

			$rules = array(
				$rule,
				$rule2,
				array(
					'field'=>'date_from',
					'label'=>'Start Date',
					'rules'=>'required|callback_validate_start_date'
					),
				array(
					'field'=>'lifetime',
					'label'=>'Lifetime',
					'rules'=>'none'
					),
				array(
					'field'=>'payment_mode',
					'label'=>'Payment Mode',
					'rules'=>'required'
					)
				);

			$this->form_validation->set_rules($rules);
			if($this->form_validation->run()){
				$this->champion_model->save_commitment();

				$log = array(
							"cid" => $this->session->userdata("cid"),
							"type" => "made_commitment",
							"value_int" => 2
						);
				$this->champion_model->champion_log($log);

				#send email to champion / exec

				#load email message
				$_msg = $this->email_model->get_msg("commitment");
				$msg = $_msg['html'];
				$subject = $_msg['subject'];

				$name = $this->session->userdata('first_name')." ".
                                $this->session->userdata('last_name');
        $amount = $this->input->post("amount");
        $other_amount = $this->input->post("other_amount");

        if($other_amount > 0) $amount = $other_amount;

        $ctid = $this->input->post("ctid");

        $type = $this->champion_model
        									->get_commitment_type_name($ctid);

        $date_from = $this->input->post("date_from");
        $date_to = $this->input->post("date_to");
        if($this->input->post("lifetime")==1){
        	$date_to = "Lifetime";
        }
        $payment_mode = $this->input->post("payment_mode");

				$msg = str_replace("{name}", $name, $msg);
				$msg = str_replace("{amount}", $amount, $msg);
				$msg = str_replace("{type}", $type, $msg);
				$msg = str_replace("{start_date}", $date_from, $msg);
				$msg = str_replace("{end_date}", $date_to, $msg);
				$msg = str_replace("{payment_mode}", $payment_mode, $msg);

				$to_email = $this->session->userdata("email");

				$this->email_model->send($to_email,$subject,$msg);
				//another email to staff I/C
				$to_email = "nkimani@focuskenya.org";
				$this->email_model->send($to_email,$subject,$msg);

				if($mode2==1){
					redirect("champion/step/complete");	
				}else{
					redirect("champion");
				}
			}else{
				$this->commitment("form",$mode2);
			}
		}

		if($mode=="edit"){
			$this->data['date_picker'] = TRUE;
			$this->data['main'] = "champion/commitment_form_edit";
			$this->data['commitment_type'] = $this->champion_model
																					->get_commitment_type();
			$this->data['cd'] = $this->champion_model
														->get_commitment_details2($this->data['cid']);
			$this->_load_view();
		}

		if($mode=="update"){
			$this->load->library("form_validation");

			if($this->input->post("lifetime") != 1){
				$rule2 = array(
					'field'=>'date_to',
					'label'=>'End Date',
					'rules'=>'required|callback_validate_end_date'
					);
			}else{
				$rule2 = array(
					'field'=>'date_to',
					'label'=>'End Date',
					'rules'=>'none'
					);
			}

			$rules = array(
				$rule2,
				array(
					'field'=>'amount',
					'label'=>'Amount',
					'rules'=>'required|greater_than[199]'
					),
				array(
					'field'=>'date_from',
					'label'=>'Start Date',
					'rules'=>'required'
					),
				array(
					'field'=>'lifetime',
					'label'=>'Lifetime',
					'rules'=>'none'
					)
				);

			$this->form_validation->set_rules($rules);
			if($this->form_validation->run()){
				$this->champion_model->update_commitment($this->data['cid']);
				redirect("champion/profile");
			}else{
				$this->commitment("edit");
			}
		}

		if($mode=="later"){
			//view CL (commit later) form
			$this->data['step'] = array(2,3);
			$this->data['date_picker'] = TRUE;
			$this->data['main'] = "champion/commit_later";
			$this->_load_view();
		}

		if($mode=="laterc"){
			//submit CL form
			$this->load->library("form_validation");
			$this->form_validation
						->set_rules('reminder_date','Reminder Date','required');
			if($this->form_validation->run()){
				$this->champion_model->commit_later($this->data['cid']);
				redirect("champion/step/complete");
			}else{
				$this->commitment("later");
			}
		}
	}

	public function validate_end_date($date) {
		//end date should be more than start date;

		$date = new DateTime($date);
		$start_date = $this->input->post("date_from"); //hacked
		$start_date = new DateTime($start_date);

		if($date > $start_date) {
			return TRUE;
		}
		else {
			$this->form_validation->set_message('validate_end_date',
			'The End Date must be later than Start Date');
			return FALSE;
		}
	}

	public function validate_start_date($date) {
		//must be today or later than today
		$date = new DateTime($date);
		$today = new DateTime();

		if($date >= $today) {
			return TRUE;
		}
		else {
			$this->form_validation->set_message('validate_start_date',
			'The Start Date must be today or later than today');
			return FALSE;
		}
	}

	private function _has_committed($cid){
		if($this->champion_model->made_commitment($this->data['cid'])){
			redirect("champion/commitment/view");
		}
	}

	public function step($step="commitment"){
		if($step == "commitment"){
			//make commitment
			$this->commitment("form");
		}
		if($step == "complete"){
			//finish registration
			$this->data['main'] = "champion/reg_complete";
			$this->data['step'] = array(3,3);
			$this->_load_view();
		}
	}

	public function org($mode="add"){
		if($mode=="add"){
			$this->data['main'] = "champion/org_add";
			$this->data['date_picker'] = TRUE;
			$this->_load_view();
		}
		if($mode=="submit"){
			$rules = array(
				array(
					'field'=>'name',
					'label'=>'Orgarnization',
					'rules'=>'required'
					),
				array(
					'field'=>'url',
					'label'=>'Website',
					'rules'=>'prep_url'
					),
				array(
					'field'=>'designation',
					'label'=>'Designation',
					'rules'=>'required'
					),
				array(
					'field'=>'date_from',
					'label'=>'Start Date',
					'rules'=>'required'
					),
				array(
					'field'=>'date_to',
					'label'=>'End Date',
					'rules'=>'none'
					),
				array(
					'field'=>'current',
					'label'=>'current',
					'rules'=>'none'
					)
				);

			$this->load->library("form_validation");
			$this->form_validation->set_rules($rules);
			if($this->form_validation->run()){
				$this->champion_model->add_org($this->data['cid']);
				redirect("champion/profile");
			}else{
				$this->org("add");
			}
		}
	}

	public function invite($mode="form"){
		
		if($mode=="form"){
			$this->data['main'] = "champion/invite";
			$this->data['invite'] = $this->champion_model
															->get_invite($this->data['cid']);
			$this->_load_view();
		}

		if($mode=="submit"){
			$rules = array(
				array(
					'field'=>'first_name',
					'label'=>'First Name',
					'rules'=>'required'
					),
				array(
					'field'=>'last_name',
					'label'=>'Last Name',
					'rules'=>'required'
					),
				array(
					'field'=>'email',
					'label'=>'Email',
					'rules'=>'required|valid_email
						|is_unique[invite.email]|is_unique[champion.email]'
					),
				array(
					'field'=>'phone',
					'label'=>'Phone',
					'rules'=>'numeric'
					)
				);

			$this->load->library("form_validation");
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_message("is_unique","Already invited");
			if($this->form_validation->run()){
				$invite = $this->champion_model->invite($this->data['cid']);
				//email invite
				$iid = $invite['iid'];
				$check = $invite['check'];
				$invite_link = anchor("home/invited/$iid/$check");

				$invitee = $this->input->post("first_name");
				$inviter = $this->session
										->userdata("first_name")." ".
										$this->session->userdata("last_name");
				$from_email = $this->session->userdata("email");
				$from_phone = $this->session->userdata("phone");
				$_msg = $this->email_model->get_msg("invite");
				$msg = $_msg['html'];
				$msg = str_replace("{invitee}", $invitee, $msg);
				$msg = str_replace("{inviter}", $inviter, $msg);
				$msg = str_replace("{invite_link}", $invite_link, $msg);
				$msg = str_replace("{from_email}", $from_email, $msg);
				$msg = str_replace("{from_phone}", $from_phone, $msg);

				$to_email = $this->input->post("email");
				$subject = $_msg['subject'];

				$this->email_model->send($to_email,$subject,$msg);

				redirect("champion/invite");
			}else{
				$this->invite("form");
			}
		}
	}

	public function reset($mode="form"){
		//set new password
		if($mode=="form"){
			$this->data['main'] = "champion/reset";
			$this->_load_view();
		}

		if($mode=="submit"){
			$this->load->library("form_validation");
			$this->form_validation
							->set_rules("password","Password",
								"required|matches[password_confirm]");
			$this->form_validation
							->set_rules("password_confirm","Confirm Password","required");

			if($this->form_validation->run()){
				$cid = $this->data['cid'];
				$this->champion_model->password_new($cid);
				redirect("champion");
			}else{
				$this->reset();
			}
		}
	}

	public function contribution($mode="make") {
		if($mode == "make") {
			$this->data["main"] = "champion/contribution_make";
			$this->data['cd'] = $this->champion_model
													->get_commitment_details($this->data['cid']);
			$this->_load_view();
		}

		if($mode=="history") {
			$this->load->model("contribution_model");
			$this->data["main"] = "champion/contribution_history";
			$this->data["history"] = $this->contribution_model
															->get_contribution_history($this->data['cid']);
			$this->data['contrib_total'] = $this->contribution_model
																					->get_contribution_total(
																						$this->data['cid']);
			$this->_load_view();
		}
	}
}