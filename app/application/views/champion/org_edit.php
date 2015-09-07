<h3 class="title">
<i class="fa fa-briefcase"></i> 
Add Work Information
</h3>

<div class="row">
	<div class="col-md-6">
		<?php

		echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');

		echo form_open("champion/org/update/" . $org->oid,"class='form'");
		echo form_input("name",$org->name);
		echo form_label("Organization/Company Name","name");
		echo form_input("url",$org->url);
		echo form_label("Website","url");
		echo form_input("designation",$org->designation);
		echo form_label("Your Designation/Postion","designation");
		echo form_input("date_from",$org->date_from, "class='half date-picker'");
		echo form_input("date_to",$org->date_to,"class='half date-picker'");
		echo form_label("Start Date <span class='right'>End Date</span>","date_to date-picker");
		echo "<label>"."<span class='right'>".form_checkbox("current","1",$org->current)." Current</span></label>"; 
		echo form_submit("submit","Update","class='btn btn-lg btn-success'");
		?>

	</div>

</div>