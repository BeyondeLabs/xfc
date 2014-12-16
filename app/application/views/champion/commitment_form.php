<?php

$_commitment_type = array();

foreach($commitment_type->result() as $row){
	$_commitment_type[$row->ctid] = $row->name;
}

$amount = array();

$amount["250"] = 250;
$amount["500"] = 500;
foreach(range(1000,5000,1000) as $i){
	$amount[$i] = number_format($i);
}
$amount["10000"] = 10000;
$amount["20000"] = 20000;
$amount["50000"] = 50000;
$amount["100000"] = 100000;

$amount["0"] = "Other";

//payment modes
$mpesa = 0; $airtel = 0; $so = 0;

if(isset($_POST['commit'])){
	$payment_mode = $this->input->post("payment_mode");
	if($payment_mode == "MPesa"){
		$mpesa = 1;
	}
	if($payment_mode == "Airtel"){
		$airtel = 1;
	}
	if($payment_mode == "SO"){
		$so = 1;
	}
}


?>
<h3 class="title">
<i class="fa fa-user"></i> 
Commitment Form
</h3>

<div class="row">
	<div class="col-md-6">

		<?php 
		if($mode2 == 1){
			$this->load->view("inc/progress_reg");
		}
		 ?>
		
		<?php

		echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');

		echo form_open("champion/commitment/submit/$mode2","class='form'");
		echo form_dropdown("ctid",$_commitment_type,"2");
		echo form_label("Commitment Type","ctid");
		if(isset($_POST["amount"])){
			$_amount = $this->input->post("amount");
		}else{
			$_amount = 500;
		}
		echo form_dropdown("amount",$amount,$_amount,"class='half'");
		echo form_input("other_amount",set_value("other_amount"),"class='half'");
		echo form_label("Choose Amount (KES) <span class='right'>If Other, specify Amount (KES)</span>","amount");
		echo form_input("date_from",set_value("date_from"), "class='half date-picker'");
		echo form_input("date_to",set_value("date_to"),"class='half date-picker'");
		echo form_label("Start Date <span class='right'>End Date</span>","date_to date-picker");
		echo "<label>"."<span class='right'>".form_checkbox("lifetime","1",set_value("lifetime"))." Lifetime Supporter</span></label>"; 

		echo "<div><strong class='grey'>Choose Payment Mode:</strong> ";
		echo form_radio("payment_mode","MPesa",$mpesa)." M-Pesa ";
		echo form_radio("payment_mode","Airtel",$airtel)." Airtel Money ";
		echo form_radio("payment_mode","SO",$so)." Standing Orders ";
		echo "</div>";
		echo form_submit("commit","Commit","class='btn btn-lg btn-success'");

		if($mode2==1){
			echo anchor("champion/commitment/later","<i class='fa fa-clock-o'></i> Commit Later");
		}

		echo form_close();
		?>

	</div>

</div>