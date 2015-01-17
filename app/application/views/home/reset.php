<div class="row">
	<div class="col-md-6">
		<h2><i class='fa fa-lock'></i> Reset Password</h2>
	<?php

		echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');

		if($this->session->flashdata("error") != ""){
			echo "<div class='alert alert-danger' roles='alert'>".$this->session->flashdata("error")."</div>";
		}

		if($this->session->flashdata("success") != ""){
			echo "<div class='alert alert-success' roles='alert'>".$this->session->flashdata("success")."</div>";
		}

		echo form_open("home/reset/submit","class='form'");
		echo form_input("email",set_value("email"));
		echo form_label("Your <strong>Email Address</strong>? A reset link will be emailed to you","email");
		echo form_submit("reset","Reset Password","class='btn btn-lg btn-success'");

	?>
	</div>
</div>