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
		echo form_input("first_name",set_value("first_name"),"class='half'");
		echo form_input("last_name",set_value("last_name"),"class='half'");
		echo form_label("First Name <span class='right'>Last Name</span>","first_name");
		echo form_input("email",set_value("email"));
		echo form_label("Email","email");
		echo form_dropdown();
		echo form_label("Christian Union","cuid");
		echo form_dropdown("atid",array(),"", "class='half'");
		echo form_dropdown("grad_year",array(),"","class='half'");
		echo form_label("Affiliation <span class='right'>Year of Graduation</span>","atid");
		echo form_input("phone",set_value("phone"));
		echo form_label("phone","phone");

		echo form_input("email",set_value("email"));
		echo form_label("Email","email");
		echo form_password("password",set_value("password"),"class='half'");
		echo form_password("password_confirm",set_value("password_confirm"),"class='half'");
		echo form_label("Password <span class='right'>Password Confirm</span>","password");

		echo form_submit("register","Register","class='btn btn-lg btn-success'");

		?>
	</div>
</div>
