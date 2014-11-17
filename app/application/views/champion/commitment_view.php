<h3 class="title">
<i class="fa fa-arrow-circle-o-right"></i> 
Commitment Details
</h3>

<div class="row">
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

			<?php echo anchor("champion/commitment/edit","Edit Commitment",
					"class='btn btn-success'"); ?>

		</div>
	</div>

</div>