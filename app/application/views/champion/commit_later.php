<h3 class="title">
<i class="fa fa-bell-o"></i> 
Commitment Reminder
</h3>

<div class="row">
	<div class="col-md-6">

		<?php $this->load->view("inc/progress_reg"); ?>
		
		<?php

		echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');

		echo form_open("champion/commitment/laterc","class='form commit-later'");
		
		echo "When do you wish to be reminded?";
		echo form_input("reminder_date",set_value("reminder_date"),"class='date-picker'");
		echo form_label("Please set a reminder date");
		echo form_submit("commit","Remind Me","class='btn btn-lg btn-success'");
		echo form_close();
		?>

	</div>

</div>