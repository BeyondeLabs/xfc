<h3 class="title">
<i class='fa fa-lock'></i>
Set New Login Password
</h3>

<div class="row">
	<div class="col-md-6">
		
		<?php

		echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');

		echo form_open("champion/reset/submit","class='form'");
		echo form_password("password",set_value("password"),"class='half'");
		echo form_password("password_confirm",set_value("password_confirm"),"class='half'");
		echo form_label("Set New Password <span class='right'>Confirm Password</span>","password");
		echo form_submit("reset","Set Password","class='btn btn-lg btn-success'");
		echo form_close();
		?>

	</div>

</div>