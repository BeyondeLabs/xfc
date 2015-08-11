<?php


// $myFile = "mpesalog_test.txt";
// $fh = fopen($myFile, 'a') or die("can't open file");
// fwrite($fh, "=============================\n");

// foreach ($_REQUEST as $var => $value) {
// 	// fwrite($fh, "$var = $value\n");
// }

// // fwrite($fh, $fmessage);
// fclose($fh);

//save all the records in a central DB

// print_r(PDO::getAvailableDrivers());

//to load from inc file

$host = "localhost";
$dbname = "focuschampions_live";
$user = "prof";
$pass = "pr0f";

try {
	$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
}
catch(PDOException $e) {
	echo $e->getMessage();
}

$data = array(
			"id" => $_REQUEST["id"],
			"orig" => $_REQUEST["orig"],
			"dest" => $_REQUEST["dest"],
			"tstamp" => $_REQUEST["tstamp"],
			"text" => $_REQUEST["text"],
			"customer_id" => $_REQUEST["customer_id"],
			"user" => $_REQUEST["user"],
			"pass" => $_REQUEST["pass"],
			"routemethod_id" => $_REQUEST["routemethod_id"],
			"routemethod_name" => $_REQUEST["routemethod_name"],
			"mpesa_code" => $_REQUEST["mpesa_code"],
			"mpesa_acc" => $_REQUEST["mpesa_acc"],
			"mpesa_msisdn" => $_REQUEST["mpesa_msisdn"],
			"mpesa_trx_date" => $_REQUEST["mpesa_trx_date"],
			"mpesa_trx_time" => $_REQUEST["mpesa_trx_time"],
			"mpesa_amt" => $_REQUEST["mpesa_amt"],
			"mpesa_sender" => $_REQUEST["mpesa_sender"],
			"business_number" => $_REQUEST["business_number"]
		);

$sql = "INSERT INTO mpesa_ipn 
										(id,orig,dest,tstamp,text,customer_id,
										user,pass,routemethod_id,routemethod_name,mpesa_code,
										mpesa_acc,mpesa_msisdn,mpesa_trx_date,mpesa_trx_time,
										mpesa_amt,mpesa_sender,business_number)
				VALUES (:id,:orig,:dest,:tstamp,:text,:customer_id,
										:user,:pass,:routemethod_id,:routemethod_name,:mpesa_code,
										:mpesa_acc,:mpesa_msisdn,:mpesa_trx_date,:mpesa_trx_time,
										:mpesa_amt,:mpesa_sender,:business_number)";

$sth = $dbh->prepare($sql);

$dbh = NULL;

$sth->execute($data);


$url = "http://champions.focuskenya.org/home/mpesa";

// $url = "http://localhost/focus-champions/app/home/mpesa";

## ROUTING
$patterns = array(
	"champions"=>"/^champ/"
	);

$mpesa_acc = $_REQUEST["mpesa_acc"];

# (1) FOCUS Champions

if(preg_match($patterns["champions"], $mpesa_acc)) {
	
	$url = "http://champions.focuskenya.org/home/mpesa";

	//using cURL
	$curl_connection = curl_init($url);
	curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($curl_connection, CURLOPT_USERAGENT,
	"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
	curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);

	$result = curl_exec($curl_connection);

	curl_close($curl_connection);
}
