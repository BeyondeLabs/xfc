<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School extends CI_Controller {
	private $data;

	function __construct(){
		parent::__construct();
		$this->load->model("school_model");
		$this->is_logged_in();
	}

	private function is_logged_in(){
		// var_dump($this->session->userdata('logged_in')); die();
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
		$this->data['main'] = "school/home";
		$this->_load_view();
	}

	public function add(){
		#complete registration
		$this->data['main'] = "school/add";
		$this->_load_view();
	}

	public function profile($mode="school"){
		if($mode=="school"){
			#not to allow members here
			if(!$this->session->userdata('uid')==1){
				redirect("school/profile/member");
			}
			#check if registration is complete, if not redirect to $this-add()
			$uid = $this->session->userdata('uid');
			if($this->school_model->is_registered($uid)){

			}else{
				redirect("school/add");
			}
		}else{
			#member mode - TBD

		}
	}
}