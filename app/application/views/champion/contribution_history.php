<h3><i class="fa fa-clock-o"></i> Contribution History
</h3>

<div class="row">

	<div class="col-md-8">

		<?php
		echo "<p>Your Total Contribution: <strong>KES. ".
								number_format($contrib_total,2)."</strong>";

		echo anchor("champion/contribution/make",
									"<i class='fa fa-heart'></i> Make Contribtion",
									"class='btn btn-success' 
									style='float:right;'");

		echo "</p>";
		?>
		<br/>
		<table class="table">
			<thead>
				<tr>
					<th></th>
					<th>Date</th>
					<th>Amount</th>
					<th>Phone Number</th>
					<th>Sender</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($history->result() as $row) {
						echo "<tr>";
						echo "<td></td>";
						echo "<td>".$row->tstamp."</td>";
						echo "<td>".$row->amount."</td>";
						echo "<td>".$row->mpesa_msisdn."</td>";
						echo "<td>".$row->mpesa_sender."</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>

	</div>

	<div class="col-md-4">

	</div>

</div>