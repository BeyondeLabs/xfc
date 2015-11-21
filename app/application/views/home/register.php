<?php
//get list of CUs

$_uni_cu = array();

foreach($uni_cu->result() as $row){
	$_uni_cu[$row->cuid] = $row->uni." - ".$row->cu;
}

//get list of affiliation types

$_aff_type = array();
foreach($aff_type->result() as $row){
	$_aff_type[$row->atid] = $row->name;
}

//generate list of years
$_year = array();
for($i = (date("Y") + 10); $i >= 1950; $i--){
	$_year[$i] = $i;
}

if(isset($_POST['register'])){
	//preserve the submitted drop-downs
	$_marital_status = $this->input->post("marital_status");
	$_title = $this->input->post("title");
	$_cuid = $this->input->post("cuid");
	$_atid = $this->input->post("atid");
	$_gender = $this->input->post("gender");
}else{
	$_marital_status = "";
	$_title = "";
	$_cuid = 137;
	$_atid = "";
	$_gender = "";
}



?>
<div class="row">
	<div class="col-md-6">
		<h3>Basic Information </h3>

		<?php $this->load->view("inc/progress_reg"); ?>

		<div class="description">
			Please provide few basic details about yourself below. The password you set 
			here is the one you will use for logging in into the system any time.
		</div>
		<?php

		echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');

		echo form_open("home/register/submit","class='form'");
		echo form_label("*All the fields are mandory","__");
		echo form_input("first_name",set_value("first_name"),"class='half'");
		echo form_input("last_name",set_value("last_name"),"class='half'");
		echo form_label("First Name <span class='right'>Last Name</span>","first_name");
		echo form_dropdown("title",
			array(
				"Mr." => "Mr.",
				"Ms." => "Ms.",
				"Mrs." => "Mrs.",
				"Prof." => "Prof.",
				"Dr." => "Dr.",
				"Pastor" => "Pastor",
				"Reverend" => "Reverend",
				),$_title, "class='half'");
		echo form_dropdown("marital_status",
			array("Single"=>"Single","Married"=>"Married","Other"=>"Other"),
				$_marital_status,"class='half'");
		echo form_label("Title <span class='right'>Marital Status</span>","first_name");
		if($in_cu == 1){
			echo form_dropdown("atid",$_aff_type,$_atid, "class='half'");
			echo form_dropdown("grad_year",$_year,"","class='half'");
			echo form_label("Category <span class='right'>Year of Graduation</span>","atid");
			echo form_dropdown("cuid",$_uni_cu,$_cuid);
			echo form_label("Christian Union","cuid");
		}else{
			echo form_hidden(
				array(
					"cuid"=>146, //none
					"atid"=>1
					)
			);	
		}
		echo form_input("phone",set_value("phone"),"class='half'");
		echo form_dropdown("gender", 
			array("Male"=>"Male","Female"=>"Female"),$_gender,
			"class='half'");
		echo form_label("Phone Number <span class='right'>Gender</span>","phone");

		echo form_input("email",set_value("email"));
		echo form_label("Email (Will be used for logging in)","email");
		echo form_password("password",set_value("password"),"class='half'");
		echo form_password("password_confirm",set_value("password_confirm"),"class='half'");
		echo form_label("Set new Password for this sytem <span class='right'>Password Confirm</span>","password");

		echo form_hidden("in_cu",$in_cu);

		echo '<div class="g-recaptcha" data-sitekey="6LePexETAAAAADiIZvQW2TdKxlbrdFQyuCPp7qsU"></div>';

		echo form_submit("register","Register","class='btn btn-lg btn-success'");

		?>
	</div>
</div>
