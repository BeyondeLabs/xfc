<div class="title">
<h1><i class="fa fa-database"></i> MPesa IPN</h1>
</div>


<div class="row">
<div class="col-md-2">
<?php $this->load->view("admin/sidebar"); ?>

</div>

<div class="col-md-10">

<table class="table data">
<thead>
<tr>
	<th width="2%">#</th>
	<th width="10%">Sender </th>
	<th width="5%">Amount</th>
	<th width="15%">Date/Time</th>
	<th width="15%">M-Pesa Account</th>
	<th width="5%">Processed</th>
</tr>
<thead>
<tbody>
<?php
$count = 0;
foreach($mpesa->result() as $row){
	$count++;
	echo "<tr>";
	echo "<td>$count </td>";
	echo "<td>$row->mpesa_sender </td>";
	echo "<td>$row->mpesa_amt </td>";
	echo "<td>$row->tstamp </td>";
	echo "<td>$row->mpesa_acc </td>";
	echo "<td>$row->processed </td>";
	echo "</tr>";
}
?>
</tbody>
</table>


</div>

</div>
