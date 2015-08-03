<h3><i class="fa fa-heart-o"> Make Contribution</i></h3>

<div class="row">
	<div class="col-md-6">
		<p>Go to <strong>M-Pesa menu</strong> &#187; Payment Services
			 &#187; Pay Bill</p>
		<ul>
			<li>For <strong>Business no.</strong>, put <strong>412412</strong></li>
			<li>For <strong>Account no.</strong>, put <strong>
						<?php echo "Champ-".$cid; ?></strong></li>
			<li>For amount, put your pledged amount which is <strong>
				<?php echo $cd->amount; ?></strong></li>
		</ul>

		<p>You will receive a notification SMS from Mpesa, and shortly 
		 after an email from <em>FOCUS Champions</em> acknowledging receipt.</p>
		<p>Your contribution will then be reflected on your panel</strong> 

			<div><?php echo anchor("champion/contribution/history","Done",
												"class='btn btn-success btn-lg'"); ?></div>
	</div>
</div>
