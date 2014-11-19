<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	private $data;

	function __construct(){
		parent::__construct();
		$this->load->model("champion_model");
		$this->load->model("cu_model");
	}

	private function is_logged_in(){
		return $this->session->userdata("logged_in");
	}

	private function _load_view(){
		$this->load->view("inc/temp",$this->data);
	}

	public function index()
	{
		$this->data['champs'] = $this->champion_model->get_champs();
		if($this->is_logged_in()){
			$this->data['main'] = "home/index_auth";
		}else{
			$this->data['main'] = "home/index";
		}
		$this->_load_view();
	}

	public function register($mode="form"){
		if($mode=="form"){
			$this->data['uni_cu'] = $this->cu_model->get_uni_cu();
			// affiliation types
			$this->data['aff_type'] = $this->cu_model->get_aff_type();
			$this->data['main'] = "home/register";
			$this->_load_view();
		}
		elseif($mode=="submit"){
			#process submitted form
			$this->load->library("form_validation");

			$this->load->model("general_model");
			$rules = $this->general_model->validation_rules("champion");
			$this->form_validation->set_rules($rules);

			if($this->form_validation->run()){
				if($this->champion_model->register_champ()){
					#auto-login user
					$user = $this->champion_model->get_champ($this->input->post("email"));
					$this->session->set_userdata($user);
					$this->session->set_userdata("logged_in",TRUE);

					redirect("champion/profile");
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
				redirect("home/login");
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
}