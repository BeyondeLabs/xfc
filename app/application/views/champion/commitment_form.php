<?php

$_commitment_type = array();

foreach($commitment_type->result() as $row){
	$_commitment_type[$row->ctid] = $row->name;
}

$amount = array();

$amount["250"] = 250;
foreach(range(500,5000,500) as $i){
	$amount[$i] = number_format($i);
}
$amount["0"] = "Other";

?>
<h3 class="title">
<i class="fa fa-user"></i> 
Commitment Form
</h3>

<div class="row">
	<div class="col-md-6">
		<?php

		echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');

		echo form_open("champion/commitment/submit","class='form'");
		echo form_dropdown("supporter",array("0"=>"No","1"=>"Yes"),"","class='half'");
		echo form_dropdown("ctid",$_commitment_type,"2","class='half'");
		echo form_label("Already a Focus supporter? <span class='right'>Commitment Type</span>","ctid");
		if(isset($_POST["amount"])){
			$_amount = $this->input->post("amount");
		}else{
			$_amount = 500;
		}
		echo form_dropdown("amount",$amount,$_amount,"class='half'");
		echo form_input("other_amount",set_value("other_amount"),"class='half'");
		echo form_label("Choose Amount (KES) <span class='right'>If Other, specify Amount (KES)</span>","amount");
		echo form_input("date_from",set_value("date_from"), "class='half'");
		echo form_input("date_to",set_value("date_to"),"class='half'");
		echo form_label("Start Date <span class='right'>End Date</span>","date_to");
		echo "<br/>".form_checkbox("lifetime","1",set_value("lifetime"))." <span>Lifetime Supporter</span> <br/>"; 
		echo form_submit("register","Register","class='btn btn-lg btn-success'");

		?>

	</div>

</div>