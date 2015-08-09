<?php

$myFile = "mpesalog_test.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
fwrite($fh, "=============================\n");

foreach ($_REQUEST as $var => $value) {
	// fwrite($fh, "$var = $value\n");
}

// fwrite($fh, $fmessage);
fclose($fh);

//save all the records in a central DB
$url = "http://champions.focuskenya.org/home/mpesa";

//using cURL
$curl_connection = curl_init($url);
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl_connection, CURLOPT_USERAGENT,
"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);


// echo http_build_query($_REQUEST);
foreach ($_REQUEST as $key => $value) {
	$post_items[] = $key . '=' . $value;
}

//create the final string to be posted using implode()
$post_string = implode ('&', $post_items);

curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);

$result = curl_exec($curl_connection);

curl_close($curl_connection);

var_dump($post_string);

echo "<br/>";

var_dump(http_build_query($_REQUEST));

// echo curl_error($curl_connection);

// var_dump($result); 

die();


$patterns = array(
	"champions"=>"/^champ/"
	);

$mpesa_acc = $_REQUEST["mpesa_acc"];

if(preg_match($patterns["champions"], $mpesa_acc)) {
	//post to FOCUS Champions
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
