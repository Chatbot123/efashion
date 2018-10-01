<?php
$method = $_SERVER['REQUEST_METHOD'];
//process only when method id post
if($method == 'POST')
{
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	if(isset($json->queryResult->parameters->command))
		{	$com = $json->queryResult->parameters->command; } else {$com = "";}
	
	$com = strtolower($com);
	
	if(isset($json->queryResult->parameters->myaction))
		{	$myaction = $json->queryResult->parameters->myaction; } else {$myaction = '0';}
	
	if(isset($json->queryResult->action))
		{	$action = $json->queryResult->action; } else {$action = '0';}
	
	if($action == 'MyPreviousIntent' and $myaction == 'HighLowValues' )
	{
		if($com != "")
		{ $action = ""; }
		else
		{$action = 'HighLowValues';
				
		}
	}
			
	
	
	
	if(($com == 'liststates' || $com == 'shoplist' || $com == 'listcity' || $com == 'listfamily' || $com == 'listcategory' || $com == 'listarticle' || $com == 'listyear') && $my_action == 'amountsold' && $action == '0')
	{$com = "amountsold";}
	
	if(($com == 'liststates' || $com == 'shoplist' || $com == 'listcity' || $com == 'listfamily' || $com == 'listcategory' || $com == 'listarticle' || $com == 'listyear') && $my_action == 'qtysold' && $action == '0' )
	{$com = "qtysold";}
	
	if(($com == 'liststates' || $com == 'shoplist' || $com == 'listcity' || $com == 'listfamily' || $com == 'listcategory' || $com == 'listarticle' || $com == 'listyear') && $my_action == 'margin' && $action == '0')
	{$com = "margin";}
	
	//to execute xsjs for high and low measures
	$xsjs_url = "http://74.201.240.43:8000/ChatBot/Sample_chatbot/EFASHION_DEV_TOP.xsjs?";
		
	
		if(isset($json->queryResult->parameters->STATE))
		{	$STATE= $json->queryResult->parameters->STATE; } 
	
		if(isset($json->queryResult->parameters->ENT_STATE))
		{	$ENT_STATE= $json->queryResult->parameters->ENT_STATE;	}
	
		if(isset($json->queryResult->parameters->CITY))
		{	$CITY= $json->queryResult->parameters->CITY; } 
	
		if(isset($json->queryResult->parameters->ENT_CITY))
		{	$ENT_CITY= $json->queryResult->parameters->ENT_CITY; } 
	
		if(isset($json->queryResult->parameters->SHOPNAME))
		{	$SHOPNAME= $json->queryResult->parameters->SHOPNAME; }
	
		if(isset($json->queryResult->parameters->ENT_SHOP))
		{	$ENT_SHOP= $json->queryResult->parameters->ENT_SHOP; }
	
		if(isset($json->queryResult->parameters->YR))
		{	$YR= $json->queryResult->parameters->YR; } 
		
		if(isset($json->queryResult->parameters->QTR))
		{	$QTR= $json->queryResult->parameters->QTR; }
		
		if(isset($json->queryResult->parameters->MTH))
		{	$MTH= $json->queryResult->parameters->MTH; } 

	   	if(isset($json->queryResult->parameters->FAMILY))
		{	$FAMILY= $json->queryResult->parameters->FAMILY; } 
	
		if(isset($json->queryResult->parameters->ENT_FAM))
		{	$ENT_FAM= $json->queryResult->parameters->ENT_FAM; } 
	
	     	if(isset($json->queryResult->parameters->CATEGORY))
		{	$CATEGORY= $json->queryResult->parameters->CATEGORY; } 
	
		if(isset($json->queryResult->parameters->ENT_CAT))
		{	$ENT_CAT= $json->queryResult->parameters->ENT_CAT; }
	
	     	if(isset($json->queryResult->parameters->ARTICLE))
		{	$ARTICLE= $json->queryResult->parameters->ARTICLE; } 
	
		if(isset($json->queryResult->parameters->ENT_ARTICLE))
		{	$ENT_ARTICLE= $json->queryResult->parameters->ENT_ARTICLE; }
	
		if(isset($json->queryResult->parameters->NUM))
		{	$NUM= $json->queryResult->parameters->NUM;
			
		}

		if(isset($json->queryResult->parameters->ENT_TOP_BOT))
		{	$ENT_TOP_BOT= $json->queryResult->parameters->ENT_TOP_BOT; } 
		
		if(isset($json->queryResult->parameters->ENT_MEASURE))
		{	$ENT_MEASURE= $json->queryResult->parameters->ENT_MEASURE; }
	
		$CITY= strtoupper($CITY);
		$STATE= strtoupper($STATE);
		$SHOPNAME= strtoupper($SHOPNAME);
		$FAMILY= strtoupper($FAMILY);
		$CATEGORY= strtoupper($CATEGORY);
		$ARTICLE= strtoupper($ARTICLE);
		$YR= strtoupper($YR);
		$MTH= strtoupper($MTH);
		$QTR= strtoupper($QTR);
		$ENT_MEASURE= strtoupper($ENT_MEASURE);
		$ENT_TOP_BOT= strtoupper($ENT_TOP_BOT);
	
	
		$SHOPNAME = str_replace(' ', '', $SHOPNAME);
		$CITY = str_replace(' ', '', $CITY);
		$STATE = str_replace(' ', '', $STATE);
		$FAMILY = str_replace(' ', '', $FAMILY);
		$CATEGORY = str_replace(' ', '', $CATEGORY);
		$ARTICLE = str_replace(' ', '', $ARTICLE);
		$YR = str_replace(' ', '', $YR);
		$MTH = str_replace(' ', '', $MTH);
		$QTR = str_replace(' ', '', $QTR);
		
		$qty_array = array("QUANTITY","QTY","ITEMS","PRODUCTS");
		if (in_array($ENT_MEASURE, $qty_array)) {$showqty=1;}
	
		
	
		
	
		/*$sale_array = array("SALES","SALE");
		if (in_array($ENT_MEASURE, $sale_array)) {$showsale=1;}
		$margin_array = array("MARGIN","PROFIT");
		if (in_array($ENT_MEASURE, $margin_array)) {$showmearuse=1;}
		$bottom_array =  array("LOWEST","MINIMUM");
		if (in_array($ENT_TOP_BOT, $bottom_array)) {$NUM=1;}*/
	
		$userespnose = array("PLEASEIGNORE", "IGNORE","IGNOREIT", "ANYVALUE","ANY","NOIDEA","DRILLUP");
		
		if (in_array($YR, $userespnose)) {$YR='0';}
		if (in_array($QTR, $userespnose)) {$QTR='0';}
		if (in_array($MTH, $userespnose)) {$MTH='0';}
	
		$useres = array("PLEASEIGNORE", "IGNORE","IGNOREIT", "DRILLUP");
		if (in_array($STATE, $useres)) {$STATE=""; $ENT_STATE ="";}
		if (in_array($CITY, $useres)) {$CITY=""; $ENT_CITY ="";}
		if (in_array($SHOPNAME, $useres)) {$SHOPNAME=""; $ENT_SHOP ="";}
		if (in_array($FAMILY, $useres)) {$FAMILY=""; $ENT_FAM ="";}
		if (in_array($CATEGORY, $useres)) {$CATEGORY=""; $ENT_CAT ="";}
		if (in_array($ARTICLE, $useres)) {$ARTICLE=""; $ENT_ARTICLE ="";}    
		    
		$userespnose = array("EACH", "EVERY","ALL");
		if(in_array($YR, $userespnose))	{ $YR = 'ALL';	}
		if(in_array($QTR, $userespnose)){ $QTR = 'ALL';	}
		if(in_array($MTH, $userespnose)){ $MTH = 'ALL';	}
		if(in_array($CITY, $userespnose)){ $CITY = 'ALL'; }
		if(in_array($FAMILY, $userespnose)){ $FAMILY = 'ALL'; }
		if(in_array($CATEGORY, $userespnose)){	$CATEGORY = 'ALL';}
		if(in_array($ARTICLE, $userespnose)){	$ARTICLE = 'ALL'; }
		if(in_array($STATE, $userespnose)){	$STATE = 'ALL'; }
		if(in_array($SHOPNAME, $userespnose)){	$SHOPNAME = 'ALL'; }
	
		if($CITY != "" and $CITY != 'ALL' )
		{ 
			$xsjs_url .= "&CITY=$CITY"; 
			$ENT_CITY = "city";
		}
	
		if($STATE!="" and $STATE !='ALL' )
		 { 
			$xsjs_url .= "&STATE=$STATE";
		  	$ENT_STATE = "state";
		 }
	
		if($SHOPNAME!="" and $SHOPNAME != 'ALL' )
		{
			$xsjs_url .= "&SHOPNAME=$SHOPNAME"; 
			$ENT_SHOP = "shop";
		}
	
		if($FAMILY!="" and $FAMILY != 'ALL' )
		{ 
			$xsjs_url .= "&FAMILY=$FAMILY";
			$ENT_FAM = "family";
		}
	
		if($CATEGORY!="" and $CATEGORY != 'ALL' )
		{ 
			$xsjs_url .= "&CATEGORY=$CATEGORY"; 
			$ENT_CAT = "category";
		}
	
		if($ARTICLE!="" and $ARTICLE != 'ALL')	
		 { 
			$xsjs_url .= "&ARTICLE=$ARTICLE"; 
		 	$ENT_ARTICLE = "article";
		 }
		if($com!="")	
		 { 
			$xsjs_url .= "&COMMAND=$com";
		 	
		 }
	
		if($YR=="" )		{	$YR='0'; 	}
		if($MTH=="" )		{	$MTH='0';	}
		if($QTR=="" )		{	$QTR='0'; 	}
		if($action!="" )	 { $xsjs_url .= "&ACTION=$action"; }
		if($ENT_CITY!="" )	 { $xsjs_url .= "&ENT_CITY=$ENT_CITY"; }
		if($ENT_STATE!="" )	 { $xsjs_url .= "&ENT_STATE=$ENT_STATE"; }
		if($ENT_SHOP!="" )	 { $xsjs_url .= "&ENT_SHOP=$ENT_SHOP"; }
		if($ENT_FAM!="")	{ $xsjs_url .= "&ENT_FAM=$ENT_FAM"; }
		if($ENT_CAT!="")	{ $xsjs_url .= "&ENT_CAT=$ENT_CAT"; }
		if($ENT_ARTICLE!="" )	{ $xsjs_url .= "&ENT_ARTICLE=$ENT_ARTICLE"; }
		if($ENT_TOP_BOT!="")	{ $xsjs_url .= "&ENT_TOP_BOT=$ENT_TOP_BOT"; }
		if($ENT_MEASURE!="" )	 { $xsjs_url .= "&ENT_MEASURE=$ENT_MEASURE";}
		if($NUM == "") 		{	$NUM='0'; } 
		$top_array =  array("HIGHEST","MAXIMUM","LOWEST","MINIMUM");
		if (in_array($ENT_TOP_BOT, $top_array)) 
		{
			$NUM=1;
			$disnum = "";
			$disval = "VALUE IS ";
		}
		else 
		{
			$disnum=$NUM;
			$disval = "VALUES ARE ";
		}
		/*$xsjs_url .= "&CITY=$CITY";
		
		
		$xsjs_url .= "&STATE=$STATE";
		$xsjs_url .= "&SHOPNAME=$SHOPNAME";
		$xsjs_url .= "&FAMILY=$FAMILY";
		$xsjs_url .= "&CATEGORY=$CATEGORY";
		$xsjs_url .= "&ARTICLE=$ARTICLE";*/
		$xsjs_url .= "&YR=$YR";
		$xsjs_url .= "&MTH=$MTH";
		$xsjs_url .= "&QTR=$QTR";
		$xsjs_url .= "&NUM=$NUM";
		
	//echo $xsjs_url;
		//if($action == 'HighLowValues')
		//{
			$username    = "SANYAM_K";
			$password    = "Welcome@123";
			$ch      = curl_init( $xsjs_url );
			$options = array(
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_USERPWD        => "{$username}:{$password}",
			CURLOPT_HTTPHEADER     => array( "Accept: application/json" ),
			);
			curl_setopt_array( $ch, $options );
			$json = curl_exec( $ch );
			$someobj = json_decode($json,true);
		/*}
		else
		{
		
		$json_url = "http://74.201.240.43:8000/ChatBot/Sample_chatbot/EFASHION_DEV.xsjs?command=$com&STATE=$STATE&CITY=$CITY&SHOPNAME=$SHOPNAME&YR=$YR&QTR=$QTR&MTH=$MTH&FAMILY=$FAMILY&CATEGORY=$CATEGORY&ARTICLE=$ARTICLE&ACTION=$action";		
		
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
		}*/
	//echo $json_url;
		if($com == 'amountsold' or $com == 'margin' or $com == 'qtysold' or $action == 'HighLowValues'  )
		{
			
			if ($com == 'amountsold' )
			{
				$distext = "Sale  ";
				//$distext .= "\r\n";
				$show_dlr = "worth of $";
			}
			else if($com == 'margin' )
			{
				$distext = "Margin ";
				//$distext .= "\r\n";
				$show_dlr = "worth of $";
			}
			else if ($com == 'qtysold' )
			{
				$distext = "Products ";
				//$distext .= "\r\n";
				$show_dlr = "";
			}
			if ($action == 'HighLowValues')
			{
				
				$distext = "$ENT_TOP_BOT $disnum $ENT_MEASURE $disval ";
				if($showqty==1)
				{$show_dlr = "";} else {$show_dlr = "Worth of $";}
				 $distext .= "\r\n";
				$speech .= $distext;
				$distext="";
				
			}
			if($CITY !="" 	|| $ENT_CITY !="")	{ $discity = " for city "; } else { $discity = ""; }
			if($STATE !="" || $ENT_STATE !=""){ $disstate = " in state "; } else { $disstate = ""; }
			if($FAMILY !="" || $ENT_FAM !=""){ $disfamily = " family of product sold "; } else {$disfamily = ""; }
            		if($CATEGORY !="" || $ENT_CAT !=""){ $discategory = " category sold "; }	else { $discategory = ""; }
            		if($ARTICLE !="" || $ENT_ARTICLE !=""){$disarticle = " article sold ";} else	{ $disarticle = ""; }
			if($SHOPNAME !="" || $ENT_SHOP !="") { $disshop = " of shop "; } else{	$disshop = "";	}
			if($YR != '0')	{      $disyear = " for year ";} else {$disyear = "";}
			if($QTR != '0')	{      $disqtr = " in quarter ";} else {$disqtr = "";}
			if($MTH != '0')	{      $dismth = " for month ";} else {$dismth = "";}
			
			
			
			foreach ($someobj["results"] as $value) 
			{
				$speech .=  $distext.$show_dlr. $value["AMOUNT"].$disshop.$value["SHOP_NAME"].$discity.$value["CITY"].$disstate.$value["STATE"]." ".$value["FAMILY_NAME"].$disfamily." ".$value["CATEGORY"].$discategory." ".$value["ARTICLE_LABEL"].$disarticle.$disqtr.$value["QTR"].$dismth.$value["MTH"].$disyear.$value["YR"];
				$speech .= "\r\n";
				//$speech .= "Do you want this info on mail\n";
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
			if(isset($json->queryResult->parameters->CITY))
		{	$CITY= $json->queryResult->parameters->CITY; } 
		if(strlen($CITY) > 1) 
		{	 

			/*$opts = array();
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
			$speech .= "\r\n";*/
			//$link = "https://api.openweathermap.org/data/2.5/weather?q=".$CITY."&appid=4b75f2eaa9f9a62fe7309f06b84b69f9"; // Link goes here!
			$speech = "Now the Weather in $CITY can be seen at below link";
			$speech .= "\r\n";
			$link = "https://www.timeanddate.com/weather/usa/".$CITY;
			$speech .= $link;
			
				
			
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
