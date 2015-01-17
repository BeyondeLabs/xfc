<div class="title">
<h1><i class="fa fa-institution"></i> List of CUs 
			&mdash; <?php echo $uni_cu->num_rows; ?></h1>
</div>


<div class="row">

<div class="col-md-2">
	<?php $this->load->view("admin/sidebar"); ?>
</div>

<div class="col-md-10">

	<div class="col-md-6">


		<?php
		echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');

		echo form_open("admin/cu/add/submit","class='form'");
		echo form_dropdown("uid",$uni);
		echo form_label("University/College","uid");
		echo form_input("name",set_value("name"));
		echo form_label("CU Name","name");
		echo form_input("website",set_value("website"));
		echo form_label("Website","website");
		echo form_input("email",set_value("email"));
		echo form_label("Email","email");
		echo form_submit("add_cu","Add CU","class='btn btn-success'");
		?>

	</div>

	<div class="col-md-6">
		<div class="cu-list">
			<ul>
			<?php
			$uid = 0;
			foreach($uni_cu->result() as $row){
				if($row->uid != $uid){
					if($uid != 0) echo "</li></ul>"; //close the previous sub-list
					$uid = $row->uid;
					echo "<li> $row->uni";
					if($row->initials != "") echo " - ($row->initials)";
					echo "<ul>";
					if($row->cu_website != ""){
						echo "<li>".anchor($row->cu_website,$row->cu,"target='_blank'")."</li>";
					}else{
						echo "<li>$row->cu </li>";
					}
				}else{
					if($row->cu_website != ""){
						echo "<li>".anchor($row->cu_website,$row->cu,"target='_blank'")."</li>";
					}else{
						echo "<li>$row->cu </li>";
					}
				}
			}
			?>

			</ul>
		</div>

	</div>

</div>
</div>





