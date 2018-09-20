<?php
$method = $_SERVER['REQUEST_METHOD'];
//process only when method id post
if($method == 'POST')
{
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$com = $json->queryResult->parameters->command;
	$com = strtolower($com);
	if(isset($json->queryResult->parameters->myaction))
		{	$my_action = $json->queryResult->parameters->myaction; } else {$my_action = "";}
	
	if(isset($json->queryResult->action))
		{	$action = $json->queryResult->action; } else {$action = "";}
	
	
	if(($com == 'liststates' || $com == 'shoplist' || $com == 'listcity' || $com == 'listfamily' || $com == 'listcategory' || $com == 'listarticle' || $com == 'listyear') && $my_action == 'amountsold' && $action == '')
	{$com = "amountsold";}
	
	if(($com == 'liststates' || $com == 'shoplist' || $com == 'listcity' || $com == 'listfamily' || $com == 'listcategory' || $com == 'listarticle' || $com == 'listyear') && $my_action == 'qtysold' && $action == '' )
	{$com = "qtysold";}
	
	if(($com == 'liststates' || $com == 'shoplist' || $com == 'listcity' || $com == 'listfamily' || $com == 'listcategory' || $com == 'listarticle' || $com == 'listyear') && $my_action == 'margin' && $action == '')
	{$com = "margin";}
	
		
	
		if(isset($json->queryResult->parameters->STATE))
		{	$STATE= $json->queryResult->parameters->STATE; } else {$STATE = '0';}
		
		if(isset($json->queryResult->parameters->CITY))
		{	$CITY= $json->queryResult->parameters->CITY; } else {$CITY = '0';}
				
		if(isset($json->queryResult->parameters->SHOPNAME))
		{	$SHOPNAME= $json->queryResult->parameters->SHOPNAME; } else {$SHOPNAME = '0';}
	
		if(isset($json->queryResult->parameters->YR))
		{	$YR= $json->queryResult->parameters->YR; } else {$YR = '0';}
		
		if(isset($json->queryResult->parameters->QTR))
		{	$QTR= $json->queryResult->parameters->QTR; } else {$QTR = '0';}
		
		if(isset($json->queryResult->parameters->MTH))
		{	$MTH= $json->queryResult->parameters->MTH; } else {$MTH = '0';}	

	   	if(isset($json->queryResult->parameters->FAMILY))
		{	$FAMILY= $json->queryResult->parameters->FAMILY; } else {$FAMILY = '0';}
	
	     	if(isset($json->queryResult->parameters->CATEGORY))
		{	$CATEGORY= $json->queryResult->parameters->CATEGORY; } else {$CATEGORY = '0';}
	
	     	if(isset($json->queryResult->parameters->ARTICLE))
		{	$ARTICLE= $json->queryResult->parameters->ARTICLE; } else {$ARTICLE = '0';}
	
		
			/*$my_previous_com = $com;
		
		if(isset($json->queryResult->parameters->myaction))
		{	$my_action = $json->queryResult->parameters->myaction; } else {$my_action = "";}
		
		/*if($my_action == 'PreviousContextTotSale'){$com = $my_previous_com;}
		if($my_action == 'PreviousContextQtySold'){$com = $my_previous_com;}
		if($my_action == 'PreviousContextMargin'){$com = $my_previous_com;}*/
	
		$CITY= strtoupper($CITY);
		$STATE= strtoupper($STATE);
		$SHOPNAME= strtoupper($SHOPNAME);
		$FAMILY= strtoupper($FAMILY);
		$CATEGORY= strtoupper($CATEGORY);
		$ARTICLE= strtoupper($ARTICLE);
		$YR= strtoupper($YR);
		$MTH= strtoupper($MTH);
		$QTR= strtoupper($QTR);
	
		$SHOPNAME = str_replace(' ', '', $SHOPNAME);
		$CITY = str_replace(' ', '', $CITY);
		$STATE = str_replace(' ', '', $STATE);
		$FAMILY = str_replace(' ', '', $FAMILY);
		$CATEGORY = str_replace(' ', '', $CATEGORY);
		$ARTICLE = str_replace(' ', '', $ARTICLE);
		$YR = str_replace(' ', '', $YR);
		$MTH = str_replace(' ', '', $MTH);
		$QTR = str_replace(' ', '', $QTR);
		
		if($CITY=="" ){	$CITY='0';}
		if($STATE=="" ){$STATE='0';}
		if($SHOPNAME=="" ){$SHOPNAME='0';}
		if($FAMILY=="" ){$FAMILY='0';}
		if($CATEGORY=="" ){$CATEGORY='0';}
		if($ARTICLE=="" ){$ARTICLE='0';}
		if($YR=="" ){$YR='0';}
		if($MTH=="" ){$MTH='0';}
		if($QTR=="" ){$QTR='0';}
		
		
		
		$userespnose = array("PLEASEIGNORE", "IGNORE","IGNOREIT", "ANYVALUE","ANY","NOIDEA");
		
		if (in_array($YR, $userespnose)) {$YR='0';}
		if (in_array($QTR, $userespnose)) {$QTR='0';}
		if (in_array($MTH, $userespnose)) {$MTH='0';}
	
		$useres = array("PLEASEIGNORE", "IGNORE","IGNOREIT");
		if (in_array($STATE, $useres)) {$STATE='0';}
		if (in_array($CITY, $useres)) {$CITY='0';}
		if (in_array($SHOPNAME, $useres)) {$SHOPNAME='0';}
		if (in_array($FAMILY, $useres)) {$FAMILY='0';}
		if (in_array($CATEGORY, $useres)) {$CATEGORY='0';}
		if (in_array($ARTICLE, $useres)) {$ARTICLE='0';}    
		    
		$userespnose = array("EACH", "EVERY","ALL");
		if(in_array($STATE, $userespnose))
		{
			$STATE = 'ALL';
		}
	
		if(in_array($SHOPNAME, $userespnose))
		{
			$SHOPNAME = 'ALL';
		}
		
		if(in_array($CITY, $userespnose))
		{
			$CITY = 'ALL';
		}
		
		if(in_array($YR, $userespnose))
		{
			$YR = 'ALL';
		}
		
		if(in_array($FAMILY, $userespnose))
		{
			$FAMILY = 'ALL';
		}
		
		
		if(in_array($CATEGORY, $userespnose))
		{
			$CATEGORY = 'ALL';
		}
		
		
		if(in_array($ARTICLE, $userespnose))
		{
			$ARTICLE = 'ALL';
		}
		$json_url = "http://74.201.240.43:8000/ChatBot/Sample_chatbot/EFASHION_DEV.xsjs?command=$com&STATE=$STATE&CITY=$CITY&SHOPNAME=$SHOPNAME&YR=$YR&QTR=$QTR&MTH=$MTH&FAMILY=$FAMILY&CATEGORY=$CATEGORY&ARTICLE=$ARTICLE";		
		
		$username    = "SANYAM_K";
    		$password    = "Welcome@123";
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
		if($com == 'amountsold' or $com == 'margin' or $com == 'qtysold')
		{
			if ($com == 'amountsold')
				$distext = "Total sale value is of worth $";
			else if($com == 'margin')
				$distext = "Total profit value is of worth $";
			else if ($com == 'qtysold')
				$distext = "Total ";
			if($CITY !='0')	{ $discity = " for city "; } else { $discity = ""; }
			if($STATE !='0'){ $disstate = " in state "; } else { $disstate = ""; }
			if($FAMILY !='0'){ $disfamily = " family of product sold "; } else {$disfamily = ""; }
            		if($CATEGORY !='0'){ $discategory = " category sold "; }	else { $discategory = ""; }
            		if($ARTICLE !='0'){$disarticle = " article sold ";} else	{ $disarticle = ""; }
			if($SHOPNAME != '0') { $disshop = " of shop "; } else{	$disshop = "";	}
			if($YR != '0')	{      $disyear = " for year ";} else {$disyear = "";}
			if($QTR != '0')	{      $disqtr = " in quarter ";} else {$disqtr = "";}
			if($MTH != '0')	{      $dismth = " for month ";} else {$dismth = "";}
			foreach ($someobj["results"] as $value) 
			{
				$speech .= $distext. $value["AMOUNT"].$disshop.$value["SHOP_NAME"].$discity.$value["CITY"].$disstate.$value["STATE"]." ".$value["FAMILY_NAME"].$disfamily." ".$value["CATEGORY"].$discategory." ".$value["ARTICLE_LABEL"].$disarticle.$disqtr.$value["QTR"].$dismth.$value["MTH"].$disyear.$value["YR"];
				$speech .= "\r\n";
				$speech .= "Do you want this info on mail\n";
			 }
			//if($speech != "") { $speech .= "I can drill down further\n";}
		}
		else if($com == 'shoplist')
		{
			foreach ($someobj["results"] as $value) 
			{
				$speech .= $value["SHOP_NAME"];
				$speech .= "\r\n";
			 }
		}
		else if ($com == 'liststates')
		{
			$speech = "You can see values for following states";
			$speech .= "\r\n";
			foreach ($someobj["results"] as $value) 
			{
				
				$speech .= $value["STATE"]." - ".$value["SHORT_STATE"];
				$speech .= "\r\n";
			}
			$speech .= "Which would you prefer?";
			
		}
		else if ($com == 'listcity')
		{
			$speech = "You can see values for following cities";
			$speech .= "\r\n";
			foreach ($someobj["results"] as $value) 
			{
				
				$speech .= $value["CITY"];
				$speech .= "\r\n";
			}
			$speech .= "Which would you prefer?";
			
		}
		else if ($com == 'listfamily')
		{
			$speech = "You can see values for following Product Families";
			$speech .= "\r\n";
			foreach ($someobj["results"] as $value) 
			{
				
				$speech .= $value["FAMILY_NAME"];
				$speech .= "\r\n";
			}
			$speech .= "Which would you prefer?";
			
		}
		else if ($com == 'listcategory')
		{
			$speech = "You can see values for following Product categories";
			$speech .= "\r\n";
			foreach ($someobj["results"] as $value) 
			{
				
				$speech .= $value["CATEGORY"];
				$speech .= "\r\n";
			}
			$speech .= "Which would you prefer?";
			
		}
		else if ($com == 'listarticle')
		{
			$speech = "You can see values for following Product articles";
			$speech .= "\r\n";
			foreach ($someobj["results"] as $value) 
			{
				
				$speech .= $value["ARTICLE_LABEL"];
				$speech .= "\r\n";
			}
			$speech .= "Which would you prefer?";
			
		}
		else if ($com == 'listyear')
		{
			$speech = "You can see values for following years";
			$speech .= "\r\n";
			foreach ($someobj["results"] as $value) 
			{
				
				$speech .= $value["YR"];
				$speech .= "\r\n";
			}
			$speech .= "Which would you prefer?";
			
		}
	
	else if ($com=='weather')
	{
		if(strlen($CITY) > 1) 
		{	 

			$opts = array();
			$opts['http'] = array();
			$opts['http']['method']="GET";
			$opts['http']['header']="Accept-language: en\r\n"."Cookie: foo=bar\r\n";

			$t1=stream_context_create($opts);

			// Open the file using the HTTP headers set above
			$test_file=file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=$CITY&appid=4b75f2eaa9f9a62fe7309f06b84b69f9", false, $t1);

			$file = json_decode($test_file);
			$weather_data = $file->weather[0]->description;
			$temp =  1.8*($file->main->temp - 273) +32 ;
			$speech = "Now the Weather in $CITY is $weather_data , The temperature is $temp F " ;
			$speech .= "\r\n";
			/*$link = 'https://api.openweathermap.org/data/2.5/weather?q='.$CITY.'&appid=4b75f2eaa9f9a62fe7309f06b84b69f9'; // Link goes here!
			//echo $link;
			$speech = '<a href="'.$link.'">Link</a>';*/
			
				
			
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
