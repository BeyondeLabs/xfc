<?php

class Tumasms {
	
	// api call
	var $api_url;
	var $api_parameters;
	
	// api parameters
	var $api_key;
	var $api_signature;
	var $sms_messages;

	// response
	var $status;
	var $message;	
	var $description;	
	var $response_xml;	
	var $response_json;	
	var $message_separator;
	
	public function __construct($api_key="", $api_signature="")
	{
		$this->api_url = "";
		$this->api_parameters = "";	

		$this->api_key = $api_key;
		$this->api_signature = $api_signature;		
		$this->sms_messages = "";
		
		$this->status = "";	
		$this->message = "";	
		$this->description = "";	
		$this->response_xml = "";	
		$this->response_json = "";	
		$this->message_separator = " ";
	}
	
	public function queue_sms($recipient, $message, $sender = "", $scheduled_date = "")
	{
		$this->sms_messages .= "<sms>";
		$this->sms_messages .= "<recipient>" . $recipient . "</recipient>";
		$this->sms_messages .= "<message>" . $message . "</message>";
		$this->sms_messages .= "<sender>" . $sender . "</sender>";
		$this->sms_messages .= "<scheduled_date>" . $scheduled_date . "</scheduled_date>";
		$this->sms_messages .= "</sms>";
	}
	
	public function send_sms()
	{
		$this->api_url = "send_sms";	
		$this->api_parameters = '&messages=' . urlencode("<request>" . $this->sms_messages . "</request>");
		$this->execute();
	}
	
	public function get_balance()
	{
		$this->api_url = "get_balance";	
		$this->api_parameters = ""; 
		$this->execute();
	}

	function execute()
	{
		
		$this->api_url = "http://tumasms.co.ke/ts/api/" . $this->api_url; 
		$this->api_parameters = 'api_key=' . urlencode($this->api_key) . '&api_signature=' . urlencode($this->api_signature) . $this->api_parameters;	
		
		// execute post
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api_url);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->api_parameters); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 180);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		$results = curl_exec($ch);
		curl_close($ch);

		// process xml results
		$this->response_xml = trim($results);
		$this->response_json = json_encode(simplexml_load_string($this->response_xml));
		$response = json_decode($this->response_json, TRUE);
		
		$this->status = $response["status"]["type"];
		$this->message = $response["content"]["messages"]["message"];
		$this->description = $response["content"]["description"];

		if (is_array($this->message))
		{
			$this->message = implode($this->message_separator, $this->message);
		}
		
		$this->status = urldecode($this->status);
		$this->message = urldecode($this->message);
		$this->description = urldecode($this->description);
		$this->response_xml = urldecode($this->response_xml);
		$this->response_json = urldecode($this->response_json);
	}
	
}

?>	