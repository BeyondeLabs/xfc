<div class="title">
	<h1><i class="fa fa-list"></i> Champions</h1>
</div>
<div class="row">

<?php
foreach($champs->result() as $row):
?>
<div class="col-md-3 c-profile">
<h4><?php echo $row->first_name." ".$row->last_name; ?></h4>
<div class="desc">
<i class="fa fa-clock-o"></i> Joined <?php echo $row->joined; ?><br/>
<?php echo $row->cu_name." &mdash; ".$row->uni_name; ?><br/>
<i class="fa fa-tag"></i> <?php echo $row->at_name." &bull; ".$row->grad_year; ?><br/>
<?php echo "KES. ".number_format($row->amount)." &bull; ".$row->ct_name; ?>
</div>

</div>

<?php endforeach; ?>

</div>