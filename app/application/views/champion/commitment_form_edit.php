<?php

$_commitment_type = array();

foreach($commitment_type->result() as $row){
	$_commitment_type[$row->ctid] = $row->name;
}

$airtel = 0; $mpesa = 0; $so = 0;

$pm = $cd->payment_mode;
if($pm == "Airtel") $airtel = 1;
if($pm == "MPesa") $mpesa = 1;
if($pm == "SO") $so = 1;

?>
<h3 class="title">
<i class="fa fa-user"></i> 
Commitment Form
</h3>

<div class="row">
	<div class="col-md-6">
		<?php

		echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');

		echo form_open("champion/commitment/update","class='form'");
		echo form_dropdown("ctid",$_commitment_type,$cd->ctid);
		echo form_label("Commitment Type","ctid");
		if(isset($_POST["amount"])){
			$_amount = $this->input->post("amount");
		}else{
			$_amount = $cd->amount;
		}
		echo form_input("amount",$_amount);
		echo form_label("Amount (KES)","amount");
		echo form_input("date_from",$cd->date_from, "class='half date-picker'");
		echo form_input("date_to",$cd->date_to,"class='half date-picker'");
		echo form_label("Start Date <span class='right'>End Date</span>","date_to");
		echo "<label>"."<span class='right'>".form_checkbox("lifetime","1",$cd->lifetime)." Lifetime Supporter</span></label>"; 
		echo "<div><strong class='grey'>Choose Payment Mode:</strong> ";
		echo form_radio("payment_mode","MPesa",$mpesa)." M-Pesa ";
		echo form_radio("payment_mode","Airtel",$airtel)." Airtel Money ";
		echo form_radio("payment_mode","SO",$so)." Standing Orders ";
		echo "</div>";
		echo form_submit("register","Update","class='btn btn-lg btn-success'");

		?>

	</div>

</div>