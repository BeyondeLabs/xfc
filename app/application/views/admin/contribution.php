<div class="title">
<h1><i class="fa fa-signal"></i> Contribution</h1>
</div>


<div class="row">
<div class="col-md-2">
<?php $this->load->view("admin/sidebar"); ?>

</div>

<div class="col-md-10">

<h4><strong>Total Amount: </strong> 
	<?php echo number_format($total_contribution,2); ?></h4>
<table class="table data">
<thead>
<tr>
	<th width="2%">#</th>
	<th width="15%">Name</th>
	<th width="25%">Date/Time</th>
	<th width="15%">Amount</th>
	<th>Commitment</th>
	<th>M-Pesa Name</th>
</tr>
</thead>
<tbody>
<?php
$count = 0;
foreach($contribution->result() as $row){
	$count++;
	echo "<tr>";
	echo "<td>$count </td>";
	echo "<td>$row->first_name $row->last_name </td>";
	echo "<td>$row->tstamp</td>";
	echo "<td>$row->mpesa_amt </td>";
	echo "<td>$row->amount / $row->commitment_type</td>";
	echo "<td>$row->mpesa_sender</td>";
	echo "</tr>";
}
?>
</tbody>
</table>

</div>

</div>
