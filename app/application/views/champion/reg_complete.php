<h3 class="title">
<i class="fa fa-user"></i> 
Registration Completed
</h3>
<div class="row">
	<div class="col-md-6">
		<?php $this->load->view("inc/progress_reg"); ?>


		<div>
		<i class="fa fa-check-circle complete"></i> Thank you <strong><?php echo $this->session->userdata("first_name") ?></strong> for
		registering as a champion. You can go to your profile to make any 
		further edits and confirm your details.<br/><br/>
		<?php echo anchor("champion/invite","<i class='fa fa-thumbs-o-up'></i> Invite Someone",
			"class='btn btn-warning'"); ?>

			<?php echo " &nbsp; ".anchor("champion/profile","Skip <i class='fa fa-angle-double-right'></i> "); ?>
	</div>

</div>