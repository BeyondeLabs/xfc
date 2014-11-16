<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	private $data;

	function __construct(){
		parent::__construct();
		$this->load->model("user_model");
	}

	private function _load_view(){
		$this->load->view("inc/temp",$this->data);
	}

	public function index()
	{
		$this->data['main'] = "home/index";
		$this->_load_view();
	}

	/*for initial lazy registration */
	public function register($type="form"){
		if($type=="form"){
			$this->data['type'] = $type;
			$this->data['main'] = "home/register";
			$this->_load_view();
		}
		elseif($type=="submit"){
			#process submitted form
			$this->load->library("form_validation");

			$rules = array(
					array(
						'field'=>'username',
						'label'=>'Username',
						'rules'=>'required|is_unique[user.username]|max_length[15]'
					),
					array(
						'field'=>'email',
						'label'=>'Email',
						'rules'=>'required|valid_email|is_unique[user.email]'
					),
					array(
						'field'=>'password',
						'label'=>'Password',
						'rules'=>'required|matches[password_confirm]'
					),
					array(
						'field'=>'password_confirm',
						'label'=>'Password Confirm',
						'rules'=> 'required'
					)
				);
			$this->form_validation->set_rules($rules);

			if($this->form_validation->run()){
				if($this->user_model->register_user()){
					#auto-login user
					$user = $this->user_model->get_user($this->input->post("email"));
					$this->session->set_userdata($user);
					$this->session->set_userdata("logged_in",TRUE);

					redirect("school/add");
				}else{
					#almost impossible to get here?
				}
			}else{
				if($this->input->post("tid") == 2){
					$this->register("member");
				}else{
					$this->register();
				}
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
			if($this->user_model->validate_user()){
				$user = $this->user_model->get_user($this->input->post("email"));
				$this->session->set_userdata($user);
				$this->session->set_userdata("logged_in",TRUE);
				#redirect to respective profile page
				if($user['type'] == 1){
					redirect("school/profile");
				}else{
					redirect("member/profile");
				}
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