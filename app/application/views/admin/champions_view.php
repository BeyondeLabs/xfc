<div class="title">
	<h1><i class="glyphicon glyphicon-user"></i> Champions</h1>
</div>
<div class="row">

<div class="col-md-2">
	<?php $this->load->view("admin/sidebar"); ?>
</div>

<div class="col-md-10 paginate">
<?php
foreach($champs->result() as $row):
?>
<div class="col-md-4 c-profile">
	<?php //var_dump($row); die(); ?>
<h4><?php 
	echo anchor("champion/p/".$row->cid,
		$row->first_name." ".$row->last_name);?>
</h4>
<div class="desc">
<i class="fa fa-clock-o"></i> Joined <?php echo $row->joined; ?><br/>
<?php echo $row->cu_name." &mdash; ".$row->uni_name; ?><br/>
<i class="fa fa-tag"></i> <?php echo $row->at_name." &bull; ".$row->grad_year; ?><br/>
	<?php 
	if($row->amount > 0){
		echo "<span class='green'><strong> KES. ".number_format($row->amount)." &bull; ".$row->ct_name."</strong></span>"; 
	}else{
		echo "<span class='red'>Will pledge later</span>";
	}

	?>
</div>

</div>

<?php endforeach; ?>


</div>

</div>