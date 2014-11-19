<?php
class General_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function add_feedback(){
		$feedback = array(
			"feedback" => $this->input->post("feedback"),
			"cid" => $this->input->post("cid"),
			"first_name" => $this->input->post("first_name"),
			"last_name" => $this->input->post("last_name"),
			"email" => $this->input->post("email")
			);

		return $this->db->insert("feedback",$feedback);
	}

	function validation_rules($type){
		if($type=="champion"){
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
						'rules'=>'required|valid_email|is_unique[champion.email]'
					),
					array(
						'field'=>'phone',
						'label'=>'Phone Number',
						'rules'=>'required|is_unique[champion.phone]'
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

			return $rules;
		}

		//later on make more generic!
		if($type=="champion_edit"){
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
						'rules'=>'required|valid_email'
					),
					array(
						'field'=>'phone',
						'label'=>'Phone Number',
						'rules'=>'required'
					),
					array(
						'field'=>'phone_alt',
						'label'=>'Alternative Phone',
						'rules'=>'none'
					),
					array(
						'field'=>'url',
						'label'=>'Website/Blog link',
						'rules'=> 'prep_url'
					),
					array(
						'field'=>'url_fb',
						'label'=>'Facebook link',
						'rules'=> 'prep_url'
					),
					array(
						'field'=>'url_tw',
						'label'=>'Twitter link',
						'rules'=> 'prep_url'
					)
				);

			return $rules;
		}

		if($type=="feedback"){
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
						'rules'=>'required|valid_email'
					),
					array(
						'field'=>'feedback',
						'label'=>'Feedback',
						'rules'=>'required'
					)
				);

			return $rules;
		}
	}
}