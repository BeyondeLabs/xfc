<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	private $data;

	function __construct(){
		parent::__construct();
		$this->load->model("admin_model");
		$this->is_logged_in();
	}

	private function _load_view(){
		$this->load->view("inc/temp",$this->data);
	}

	public function index()
	{
		$this->data['main'] = "admin/index";
		$this->_load_view();
	}

	public function cu($action="add",$mode="form"){
		if($action=="add"){
			if($mode=="form"){
				$this->data['main'] = "admin/cu";
				$this->data['cu'] = $this->admin_model->get_cu_list();
				//includes both universities and colleges
				$this->data['uni'] = $this->admin_model->get_uni_list_array();
				$this->data['uni_cu'] = $this->admin_model->get_uni_cu();
				$this->_load_view();
			}
			if($mode=="submit"){
				//insert name of CU in DB
				$this->load->library("form_validation");

				$rules = array(
						array(
							'field'=>'name',
							'label'=>'CU Name',
							'rules'=>'required'
						),
						array(
							'field'=>'email',
							'label'=>'Email',
							'rules'=>'valid_email|is_unique[cu.email]'
						),
						array(
							'field'=>'website',
							'label'=>'Website',
							'rules'=>'pre_url'
						)
					);
				$this->form_validation->set_rules($rules);

				if($this->form_validation->run()){
					$this->admin_model->add_cu();
					redirect("admin/cu");
				}else{
					$this->cu();
				}
			}
		}
		
	}

	private function is_logged_in(){
		if(!$this->session->userdata('logged_in') ||
			!$this->session->userdata('is_admin')){
			$this->session->sess_destroy();
			redirect('home/alogin');
		}
	}
}