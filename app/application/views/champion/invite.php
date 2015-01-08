
<h3 class="title">
<i class="fa fa-thumbs-o-up"></i> 
Invite a Champion
</h3>

<div class="row">
	<div class="col-md-6">
		<?php

		echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');

		echo form_open("champion/invite/submit","class='form'");
		echo form_input("first_name",set_value("first_name"),"class='half'");
		echo form_input("last_name",set_value("last_name"),"class='half'");
		echo form_label("First Name <span class='right'>Last Name</span>","first_name");
		echo form_input("email",set_value("email"));
		echo form_label("Email","email");
		// echo form_input("phone",set_value("phone"));
		// echo form_label("Phone","phone");
		echo form_submit("invite","Invite","class='btn btn-lg btn-success'");
		echo anchor("champion/profile","Done");
		?>

	</div>
	<div class="col-md-6">
		<ul>
		<?php
			foreach($invite->result() as $row){
				echo "<li>$row->first_name $row->last_name";
				if($row->response_datetime != ""){
					echo " <i class='fa fa-check-circle'></i>";
				}
				echo "</li>";
			}
		?>
		</ul>
	</div>

</div>