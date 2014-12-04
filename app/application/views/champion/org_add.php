<h3 class="title">
<i class="fa fa-briefcase"></i> 
Add Work Information
</h3>

<div class="row">
	<div class="col-md-6">
		<?php

		echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');

		echo form_open("champion/org/submit","class='form'");
		echo form_input("name",set_value("name"));
		echo form_label("Organization/Company Name","name");
		echo form_input("url",set_value("url"));
		echo form_label("Website","url");
		echo form_input("designation",set_value("designation"));
		echo form_label("Your Designation/Postion","designation");
		echo form_input("date_from",set_value("date_from"), "class='half date-picker'");
		echo form_input("date_to",set_value("date_to"),"class='half date-picker'");
		echo form_label("Start Date <span class='right'>End Date</span>","date_to date-picker");
		echo "<label>"."<span class='right'>".form_checkbox("current","1",set_value("lifetime"))." Current</span></label>"; 
		echo form_submit("register","Add","class='btn btn-lg btn-success'");
		?>

	</div>

</div>