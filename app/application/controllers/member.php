<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {
	private $data;

	function __construct(){
		parent::__construct();
		$this->load->model("user_model");
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
		$this->load->view('welcome_message');
	}
}