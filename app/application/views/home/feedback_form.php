<div class="row">
	<div class="col-md-6">
		<h1><i class="fa fa-comments"></i> Feedback Form </h1>
		<div class="description">
			Your Feedback is important, we wish to hear from you.
		</div>
		<?php

		echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');

		echo form_open("home/feedback/submit","class='form'");
		if(!$this->session->userdata("logged_in")){
			echo form_input("first_name",set_value("first_name"),"class='half'");
			echo form_input("last_name",set_value("last_name"),"class='half'");
			echo form_label("First Name <span class='right'>Last Name</span>","first_name");
			echo form_input("email",set_value("email"));
			echo form_label("Email","email");
			$cid = 0;
		}else{
			$cid = $this->session->userdata("cid");
		}
		echo form_textarea("feedback","");
		echo form_hidden("cid",$cid);
		echo form_submit("submit","Send","class='btn btn-lg btn-success'");

		?>
	</div>
</div>
