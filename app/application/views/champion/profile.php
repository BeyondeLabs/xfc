<h3 class="title">
<i class="fa fa-user"></i> 
<?php echo $profile->first_name." ".$profile->last_name ?>
 <span>Profile Details</span>
</h3>

<div class="row">
	<div class="col-md-6">
		<div class="profile">
			<p><span class="left">Gender</span>
				<span class="right">
					<?php echo $profile->gender; ?>
				</span>
			</p>
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
					<?php echo anchor($profile->url,"","target='_blank'"); ?>
				</span>
			</p>
			<p><span class="left">Facebook</span>
				<span class="right">
					<?php echo anchor($profile->url_fb,"","target='_blank'"); ?>
				</span>
			</p>
			<p><span class="left">Twitter</span>
				<span class="right">
					<?php echo anchor($profile->url_tw,"","target='_blank'"); ?>
				</span>
			</p>

			<?php echo anchor("champion/profile/edit",
					"<i class='fa fa-pencil'></i> Edit Profile",
					"class='btn btn-default'"); ?>

		</div>
	</div>

	<div class="col-md-6">
		<div class="profile">
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

			<?php echo anchor("champion/commitment/edit",
				 	"<i class='fa fa-pencil'></i> Edit Commitment",
					"class='btn btn-default'"); ?>

		</div>
	</div>

</div>