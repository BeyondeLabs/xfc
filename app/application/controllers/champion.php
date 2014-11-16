<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Champion extends CI_Controller {
	private $data;

	function __construct(){
		parent::__construct();
		// $this->load->model("cu_model");
		$this->load->model("champion_model");
		$this->is_logged_in();
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
		$this->data['main'] = "champion/index";
		$this->_load_view();
	}

	public function profile(){
		$this->data['main'] = "champion/profile";
		$this->_load_view();
	}
}