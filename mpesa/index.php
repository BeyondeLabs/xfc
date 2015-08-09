<?php

$myFile = "mpesalog.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
fwrite($fh, "=============================\n");

foreach ($_REQUEST as $var => $value) {
	fwrite($fh, "$var = $value\n");
}

// fwrite($fh, $fmessage);
fclose($fh);

//save all the records in a central DB

$patterns = array(
	"champions"=>"/^champ/"
	);

$mpesa_acc = $_REQUEST["mpesa_acc"];

if(preg_match($patterns["champions"], $mpesa_acc)) {
	//post to FOCUS Champions
	$url = "http://champions.focuskenya.org/home/mpesa";
	$data = $_REQUEST;

	$options = array(
		"http" => array(
			"header" => "Content-type: application/x-www-form-urlencoded\r\n",
			"method" => "POST",
			"content" => http_build_query($data),
			),
		);

	$context = stream_context_create($options);
	$result = file_get_contents($url,false,$context);

	//for debugging, should be removed later
	var_dump($result);
}

//send post request to champions
//use regex to select account_name c[C]hamp*, 
//plus the number
