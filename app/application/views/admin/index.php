<div class="title">
<h1><i class="fa fa-pie-chart"></i> Dashboard</h1>
</div>

<div class="row">
<div class="col-md-2">
<?php $this->load->view("admin/sidebar"); ?>

</div>

<div class="col-md-10">

	<div class="widgets">
		<div class="col-md-2">
			<i class="glyphicon glyphicon-user"></i>
			<span class="title">Champions</span>
			<span><?php echo $reports["signups"]; ?> sign-ups</span>
		</div>
	</div>

	<div class="widgets">
		<div class="col-md-2">
			<i class="fa fa-envelope"></i>
			<span class="title">Invites</span>
			<span><?php echo $reports["invites"]; ?> / 
			<?php echo $reports["responses"]; ?> resp.</span>
		</div>
	</div>

	<div class="widgets">
		<div class="col-md-2">
			<i class="fa fa-signal"></i>
			<span class="title">Contributions</span>
			<span>KES. <?php echo number_format($reports["total_contributions"]); ?></span>
		</div>
	</div>

	<div class="widgets">
		<div class="col-md-2">
			<i class="fa fa-thumbs-o-up"></i>
			<span class="title">Commitments</span>
			<span><?php echo $reports["commitments"]; ?> / 
						KES. <?php echo number_format($reports["commitment_amount"]);?></span>
		</div>
	</div>

	<div class="widgets">
		<div class="col-md-2">
			<i class="fa fa-clock-o"></i>
			<span class="title">Commit Later</span>
			<span><?php echo $reports["commit_later"]; ?></span>
		</div>
	</div>

	

	<div class="col-md-12" id="container" style="padding:15px 0px;">
	</div>


</div>

</div>
