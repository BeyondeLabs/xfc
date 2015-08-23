<div class="title">
<h1><i class="fa fa-database"></i> Invited Champions</h1>
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
	<th width="25%">Name</th>
	<th width="15%">Date Invited</th>
	<th width="25%">Invited By </th>
	<th width="5%">Responded</th>
	<th width="5%">Joined</th>
</tr>
</thead>
<tbody>
<?php
$count = 0;
foreach($invited->result() as $row){
	$count++;
	echo "<tr>";
	echo "<td>$count </td>";
	echo "<td>$row->invitee </td>";
	echo "<td>$row->invite_date </td>";
	echo "<td>$row->inviter </td>";
	echo "<td>";
		if($row->response_date != ""){
			echo "<center><i class='fa fa-check-circle green fa-lg'></i></center>";
		}
	echo "</td>";
	echo "<td>";
		if($row->cid_to > 0){
			echo "<center><i class='fa fa-check-circle green fa-lg'></i></center>";
		}
	echo "</td>";

	echo "</tr>";
}
?>
</tbody>
</table>

</div>


</div>
