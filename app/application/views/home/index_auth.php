
<div class="landing">

<h1>Thank you <?php echo $this->session->userdata("first_name") ?><br/>
	<sub>for being a FOCUS <em>Champion</em>!</sub>
</h1>
<p>Feel free to invite others to join in. </p>

<?php echo anchor("#","Invite Frieds","class='btn btn-lg btn-success'"); ?>

<p class='stats'><i class="fa fa-bar-chart"></i> <?php echo $champs; ?> supporters joined so far.</p>

</div>

