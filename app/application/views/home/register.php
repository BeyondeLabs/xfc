<div class="row">
	<div class="col-md-6">
		<h1>Sign Up </h1>
		<div class="description">
			Signing up as a <?php echo anchor("http://www.focuskenya.org/",
			"FOCUS","target='blank'") ?> Champion.
		</div>
		<?php

		echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');

		echo form_open("home/register/submit","class='form'");
		echo form_input("username",set_value("username"));
		echo form_label("Username - <em>Short name or initials</em>","username");
		echo form_input("email",set_value("email"));
		echo form_label("Email","email");
		echo form_password("password",set_value("password"));
		echo form_label("Password","password");
		echo form_password("password_confirm",set_value("password_confirm"));
		echo form_label("Confirm Password");

		echo form_submit("register","Register","class='btn btn-lg btn-success'");

		?>
	</div>
</div>
