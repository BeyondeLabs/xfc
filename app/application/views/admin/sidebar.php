<?php
if(!isset($active)){
	$active = "dashboard";
}

function active_class($arg,$active){
	$active = strtolower($active);
	$arg = strtolower($arg);

	if($active == $arg){
		echo "class='active'";
	}
}

?>

<ul class="nav nav-pills nav-stacked">
	<li <?php active_class("dashboard",$active);?>>
		<?php echo anchor("admin","<i class='fa fa-pie-chart'></i> Dashboard"); ?></li>
	<li <?php active_class("champions",$active);?>><?php echo anchor("admin/champions","<i class='glyphicon glyphicon-user'></i> Champions"); ?></li>
	<li <?php active_class("contribution",$active);?>><?php echo anchor("admin/contribution","<i class='fa fa-signal'></i> Contribution"); ?></li>
	<li <?php active_class("commitments",$active);?>><?php echo anchor("admin/commitments","<i class='fa fa-thumbs-o-up'></i> Commitments"); ?></li>
	<li <?php active_class("later",$active);?>><?php echo anchor("admin/commitments/later","<i class='fa fa-clock-o'></i> Commit Later"); ?></li>
	<li <?php active_class("invited",$active);?>><?php echo anchor("admin/invited","<i class='fa fa-envelope'></i> Invited"); ?></li>
	<li <?php active_class("mpesa",$active);?>><?php echo anchor("admin/mpesa","<i class='fa fa-database'></i> MPesa IPN"); ?></li>
	<li <?php active_class("feedback",$active);?>><?php echo anchor("admin/feedback","<i class='fa fa-comments'></i> Feedback"); ?></li>
	<li <?php active_class("cu",$active);?>><?php echo anchor("admin/cu","<i class='fa fa-institution'></i> CU List"); ?></li>
</ul>