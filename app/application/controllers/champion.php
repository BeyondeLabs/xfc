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

	public function profile($mode="view"){
		$this->data['css_class'] = "profile";
		$this->data['css_id'] = "profile";

		if($mode=="view"){
			
			if(!$this->champion_model->made_commitment($this->data['cid']) &&
				!$this->champion_model->will_commit_later($this->data['cid'])){
				redirect("champion/commitment/form");
			}
			$this->data['main'] = "champion/profile";
			$this->data['cd'] = $this->champion_model->get_commitment_details($this->data['cid']);
			$this->data['profile'] = $this->champion_model->get_champ_profile
										($this->session->userdata("email"));
			$this->data['org'] = $this->champion_model->get_org($this->data['cid']);
			$this->data['invite'] = $this->champion_model->get_invite($this->data['cid']);
			$this->data['cl'] = $this->champion_model->get_commit_later($this->data['cid']);
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
			if($this->champion_model->made_commitment($this->data['cid']) ||
				 $this->champion_model->will_commit_later($this->data['cid'])){
				redirect("champion/commitment/form/2");
			}

			if($this->champion_model->made_commitment($this->data['cid'])){
				redirect("champion/commitment/form");
			}

			$this->data['main'] = "champion/commitment_view";
			$this->data['cd'] = $this->champion_model->get_commitment_details($this->data['cid']);
			$this->_load_view();
		}

		if($mode=="form"){
			//if already commited
			$this->_has_committed($this->session->userdata("cid"));

			$this->data['date_picker'] = TRUE;
			$this->data['step'] = array(2,3);
			$this->data['main'] = "champion/commitment_form";
			$this->data['commitment_type'] = $this->champion_model->get_commitment_type();
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
						'rules'=>'required|greater_than[99]'
					);
			}else{
				$rule = array(
						'field'=>'other_amount',
						'label'=>'Specified Amount',
						'rules'=>'less_than[1]|greater_than[-1]'
					);
			}

			$rules = array(
				$rule,
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
					'field'=>'lifetime',
					'label'=>'Lifetime',
					'rules'=>'none'
					)
				);

			$this->form_validation->set_rules($rules);
			if($this->form_validation->run()){
				$this->champion_model->save_commitment();

				$log = array(
							"cid" => $this->session->userdata("cid"),
							"type" => "register",
							"value_int" => 2
						);
				$this->champion_model->champion_log($log);
				redirect("champion/step/complete");
			}else{
				$this->commitment("form",$mode2);
			}
		}

		if($mode=="edit"){
			$this->data['date_picker'] = TRUE;
			$this->data['main'] = "champion/commitment_form_edit";
			$this->data['commitment_type'] = $this->champion_model->get_commitment_type();
			$this->data['cd'] = $this->champion_model->get_commitment_details2($this->data['cid']);
			$this->_load_view();
		}

		if($mode=="update"){
			$this->load->library("form_validation");

			$rules = array(
				array(
					'field'=>'amount',
					'label'=>'Amount',
					'rules'=>'required|greater_than[99]'
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
					'field'=>'lifetime',
					'label'=>'Lifetime',
					'rules'=>'none'
					)
				);

			$this->form_validation->set_rules($rules);
			if($this->form_validation->run()){
				$this->champion_model->update_commitment();
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
			$this->form_validation->set_rules('reminder_date','Reminder Date','required');
			if($this->form_validation->run()){
				$this->champion_model->commit_later($this->data['cid']);
				redirect("champion/step/complete");
			}else{
				$this->commitment("later");
			}
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
			$this->data['invite'] = $this->champion_model->get_invite($this->data['cid']);
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
					'rules'=>'required|valid_email|is_unique[invite.email]|is_unique[champion.email]'
					),
				array(
					'field'=>'phone',
					'label'=>'Phone',
					'rules'=>'numeric'
					)
				);

			$this->load->library("form_validation");
			$this->form_validation->set_rules($rules);
			$this->form_validation->set_message("is_unique","Already invited by someone else");
			if($this->form_validation->run()){
				$this->champion_model->invite($this->data['cid']);
				redirect("champion/invite");
			}else{
				$this->invite("form");
			}
		}
	}
}