<div class="title">
	<h1><i class="fa fa-list"></i> Champions</h1>
</div>
<div class="row">

<?php
foreach($champs->result() as $row):
?>
<div class="col-md-2 c-profile">
<h4><?php echo $row->first_name." ".$row->last_name; ?></h4>
<div class="desc"><?php echo $row->cu_name." &mdash; ".$row->uni_name; ?><br/>
<i class="fa fa-chain"></i> <?php echo $row->at_name; ?><br/>
<?php echo "KES. ".number_format($row->amount)." &bull; ".$row->ct_name; ?>
</div>

</div>

<?php endforeach; ?>

</div>