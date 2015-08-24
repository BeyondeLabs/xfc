<h3 class="title">
<i class="fa fa-user"></i> 
<?php echo $profile->first_name." ".$profile->last_name ?>
 <span>Profile</span>
</h3>

<div class="row">
	<div class="col-md-6">
		<div class="profile">
			<h4>Personal Information</h4>
			<p><span class="left">Gender</span>
				<span class="right">
					<?php echo $profile->gender; ?>
				</span>
			</p>

		<?php if($profile->in_cu ==1): ?>

			<p><span class="left">CU</span>
				<span class="right">
					<?php echo $profile->uni_name." - ".$profile->cu_name; ?>
				</span>
			</p>
			<p><span class="left">Affiliation</span>
				<span class="right">
					<?php echo $profile->aff_type; ?>
				</span>
			</p>
			<p><span class="left">Year of Graduation</span>
				<span class="right">
					<?php echo $profile->grad_year; ?>
				</span>
			</p>
		<?php endif; ?>

			<p><span class="left">Phone Number</span>
				<span class="right">
					<?php echo $profile->phone; ?>
					<?php
					if($profile->phone_alt != ""){
						echo " or ".$profile->phone_alt;
					}
					?>
				</span>
			</p>
			<p><span class="left">Email</span>
				<span class="right">
					<?php echo $profile->champ_email; ?>
				</span>
			</p>
			<p><span class="left">Blog/Website</span>
				<span class="right">
					<?php
					if($profile->url != "")
					echo anchor($profile->url,"","target='_blank'"); ?>
				</span>
			</p>
			<p><span class="left">Facebook</span>
				<span class="right">
					<?php 
					if($profile->url_fb != "")
					echo anchor($profile->url_fb,"","target='_blank'"); ?>
				</span>
			</p>
			<p><span class="left">Twitter</span>
				<span class="right">
					<?php 
					if($profile->url_tw != "")
					echo anchor($profile->url_tw,"","target='_blank'"); ?>
				</span>
			</p>

		</div>
	</div>

	<div class="col-md-6">
		<div class="profile">
			<h4><i class="fa fa-heart-o"></i> Commitment</h4>
			<?php
			 if($cd): ?>
			<p><span class="left">Type</span>
				<span class="right">
					<?php echo $cd->name; ?>
				</span>
			</p>
			<p><span class="left">Amount</span>
				<span class="right">
					<?php echo "KES. ".number_format($cd->amount,2); ?>
				</span>
			</p>
			<p><span class="left">Starting</span>
				<span class="right">
					<?php echo $cd->date_from; ?>
				</span>
			</p>
			<p><span class="left">Ending</span>
				<span class="right">
					<?php
						if($cd->lifetime == 1){
							echo "Lifetime Supporter";
						}else{
							echo $cd->date_to;
						}
					?>
				</span>
			</p>
			<p><span class="left">Payment Mode</span>
				<span class="right">
					<?php
						echo $cd->payment_mode;
					?>
				</span>
			</p>
			<p class="large"><span class="left">Payment Instructions</span>
				<span class="right">
					<?php
					if($cd->payment_mode == "MPesa"){
						echo "Business Number: <strong>412 412</strong>, <br/>Account Name: <strong>Champions</strong>.";
					}
					if($cd->payment_mode == "Airtel"){
						echo "Send to Number: <strong>0733 614 340</strong>.";
					}
					if($cd->payment_mode == "SO"){
						echo "Barclays Bank A/c: <strong>0948 2074 00</strong>, <br/>Swift Code: <strong>BARCKENX</strong>.";
					}
					?>
				</span>
			</p>

			<?php else: ?>
				<div style="padding-left:21px;">
					<i class="fa fa-bell-slash"></i> Not committed yet.
				</div>
			<?php endif; ?>

		</div>
	</div>

	<div class="col-md-6">
		<h4><i class="fa fa-thumbs-o-up"></i> Invites</h4>
		<div class="progress">
			<div class="progress-bar progress-bar-success" style="width: <?php echo($invite->num_rows/20 * 100) ?>%;">
  			</div>
		</div>
		<p>Invited <?php echo $invite->num_rows; ?> 
			<?php
			if($invite->num_rows == 1){
				echo "person";
			}else{
				echo "people";
			}
			?>, out of a 
			target of 20</p>
	</div>

</div>

<div class="row">
	<div class="col-md-6 work">
		<h4><i class="fa fa-briefcase"></i> Work Information</h4>
		<?php if($org->num_rows ==0) echo "None Added"; ?>

		<?php
		foreach($org->result() as $row){
			if($row->date_to == ""){
				$date_to = "Date";
			}else{
				$date_to = $row->date_to;
			}
			echo "<div class='col-md-6'>";
			echo "<p class='co'> $row->name </p>";
			echo "<p><em>$row->designation</em> </p>";
			echo "<p> $row->date_from - $date_to </p>";
			echo "</div>";
		}

		?>
	</div>
</div>