<?php

$method = $_SERVER['REQUEST_METHOD'];
//process only when method id post
if($method == 'POST')
{
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$com = $json->queryResult->parameters->command;
	$com = strtolower($com);
	
		
	if ($com == 'amountsold') or ($com=='margin') or ($com=='qtysold')
	{
		$STATE= $json->queryResult->parameters->STATE;
		$STATE= strtoupper($STATE);
		
		
		
		$username    = "SANYAM_K";
    		$password    = "Welcome@123";
		
		$json_url = "http://74.201.240.43:8000/ChatBot/Sample_chatbot/EFASHION_TEST.xsjs?command=$com&STATE='$STATE'";
		
		$ch      = curl_init( $json_url );
    		$options = array(
        	CURLOPT_SSL_VERIFYPEER => false,
        	CURLOPT_RETURNTRANSFER => true,
        	CURLOPT_USERPWD        => "{$username}:{$password}",
        	CURLOPT_HTTPHEADER     => array( "Accept: application/json" ),
    		);
    		curl_setopt_array( $ch, $options );
		$json = curl_exec( $ch );
		$someobj = json_decode($json,true);
		
		foreach ($someobj["results"] as $value) 
		{
			$speech = "Total sale in ".$value["STATE"]." is $".$value["AMOUNT_SOLD"];
			$speech .= "\r\n";
			
			
       		 }
			
	
		
		
	}
	
	$response = new \stdClass();
    	$response->fulfillmentText = $speech;
    	$response->source = "webhook";
	echo json_encode($response);

}
else
{
	echo "Method not allowed";
}

?>
