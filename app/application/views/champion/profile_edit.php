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
for($i=date("Y"); $i>=1950; $i--){
	$_year[$i] = $i;
}

//later to do for all, but for now...
if(isset($_POST['phone_alt'])){
	$phone_alt = $this->input->post('phone_alt');
	$url = $this->input->post('url');
	$url_tw = $this->input->post('url_tw');
	$url_fb = $this->input->post('url_fb');
}else{
	$phone_alt = $profile->phone_alt;
	$url = $profile->url;
	$url_tw = $profile->url_tw;
	$url_fb = $profile->url_fb;
}

?>
<div class="row">
	<div class="col-md-6">
		<h1>Edit Profile </h1>
		<div class="description">
			Update your profile
		</div>
		<?php

		echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');

		echo form_open("champion/profile/update","class='form'");
		echo form_input("first_name",$profile->first_name,"class='half'");
		echo form_input("last_name",$profile->last_name,"class='half'");
		echo form_label("First Name <span class='right'>Last Name</span>","first_name");
		echo form_dropdown("cuid",$_uni_cu,$profile->cuid);
		echo form_label("Christian Union","cuid");
		echo form_dropdown("atid",$_aff_type,$profile->atid, "class='half'");
		echo form_dropdown("grad_year",$_year,$profile->grad_year,"class='half'");
		echo form_label("Affiliation <span class='right'>Year of Graduation</span>","atid");
		echo form_input("phone",$profile->phone,"class='half'");
		echo form_dropdown("gender", 
			array("Male"=>"Male","Female"=>"Female"),"",
			"class='half'");
		echo form_label("Phone Number <span class='right'>Gender</span>","phone");

		echo form_input("email",$profile->champ_email);
		echo form_label("Email","email");
		echo form_input("phone_alt",$phone_alt,"class='half'");
		echo form_input("url",$url,"class='half' placeholder='http://'");
		echo form_label("Alternative Phone Number <span class='right'>Website/Blog URL</span>","phone_alt");
		echo form_input("url_fb",$url_fb,"class='half' placeholder='facebook.com/xxxx'");
		echo form_input("url_tw",$url_tw,"class='half' placeholder='twitter.com/xxxx'");
		echo form_label("Facebook Link/URL <span class='right'>Twitter Link/URL</span>","phone_alt");

		echo form_submit("register","Update","class='btn btn-lg btn-success'");

		?>
	</div>
</div>
