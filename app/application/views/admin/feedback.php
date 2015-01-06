<div class="title">
	<h1><i class="fa fa-comments"></i> Feedback</h1>
</div>
<div class="row">

<?php
foreach($feedback->result() as $row):
?>
<div class="feedback col-md-4">
<h5>
<?php
if($row->cid !=0 ){
	echo $row->first_name." ".$row->last_name." <i class='fa fa-lock grey'></i>";
}else{
	echo $row->f_first_name." ".$row->f_last_name;
}
?>
</h5>
<div class="text">
<?php echo $row->feedback; ?>
</div>
<div class='date'><i class="fa fa-clock-o"></i> <?php echo $row->date_posted; ?></div>

</div>

<?php endforeach; ?>

</div>