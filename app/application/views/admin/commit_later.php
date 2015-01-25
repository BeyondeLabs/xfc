<div class="title">
<h1><i class="fa fa-clock-o"></i> Commit Later</h1>
</div>


<div class="row">
<div class="col-md-2">
<?php $this->load->view("admin/sidebar"); ?>

</div>

<div class="col-md-10">

<table class="table">
<tr>
	<th width="2%">#</th>
	<th width="25%">Name</th>
	<th width="25%">Date</th>
	<th>Reminder Date </th>
</tr>
<?php
$count = 0;
foreach($cl->result() as $row){
	$count++;
	echo "<tr>";
	echo "<td>$count </td>";
	echo "<td>$row->first_name $row->last_name </td>";
	echo "<td>$row->date_time </td>";
	echo "<td>$row->reminder_date </td>";
	echo "</tr>";
}
?>

</table>


</div>

</div>
