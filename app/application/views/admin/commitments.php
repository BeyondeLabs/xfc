<div class="title">
<h1><i class="fa fa-thumbs-o-up"></i> Commitments</h1>
</div>


<div class="row">
<div class="col-md-2">
<?php $this->load->view("admin/sidebar"); ?>

</div>

<div class="col-md-10">

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  View Emails
</button>


<table class="table">
<tr>
	<th width="2%">#</th>
	<th width="25%">Name</th>
	<th width="15%">Amount</th>
	<th width="15%">Type </th>
	<th>Period</th>
</tr>
<?php
$count = 0;
foreach($cm->result() as $row){
	$count++;
	echo "<tr>";
	echo "<td>$count </td>";
	echo "<td>$row->first_name $row->last_name </td>";
	echo "<td>$row->amount </td>";
	echo "<td>$row->name </td>";
	if($row->lifetime == 0){
		echo "<td>$row->date_from - $row->date_to </td>";
	}else{
		echo "<td>Lifetime</td>";
	}
	echo "</tr>";
}
?>

</table>

</div>

<!-- for manual emailing -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Emails</h4>
        <p>For manual emailing, copy-paste and please use BCC for emailing</p>
      </div>
      <div class="modal-body form">
        <textarea style="width:100%;">
			<?php
			$count = 0;
			foreach($cm->result() as $row){
				$count++;
				if($count != 1) echo ",";
				echo "$row->email";
			}

			?>
			</textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



</div>
