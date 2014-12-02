<?php
if(!isset($step) || sizeof($step)<2){
	$step = [1,4];
}
?>

		<div class="progress">
			<div class="progress-bar progress-bar-success" style="width: <?php echo($step[0]/$step[1] * 100) ?>%;">
    			<?php echo "Step $step[0] of $step[1]"; ?>
  			</div>
		</div>