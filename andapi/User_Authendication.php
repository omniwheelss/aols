<?
header('Access-Control-Allow-Origin: *');
if($_REQUEST['Key'] == '14583' && $_REQUEST['format'] == 'xml'){

	include_once("include_android.php");
	// XML format
	$xml = new SimpleXMLElement('<user_status/>');
	
	if($_REQUEST['Username'] != '' && $_REQUEST['Password'] != ''){		
		$sql = "SELECT * from USER_MASTER WHERE Username='" . $_REQUEST['Username'] . "' and Password='" . $_REQUEST['Password'] . "'";
		$result = mysql_query( $sql );
		$row = mysql_fetch_row($result);
		$record_count=mysql_num_rows($result);
		$record_count == 1?$status = "true" : $status = "false";
		$track = $xml->addChild('status',$status);
	}
	else{
		$track = $xml->addChild('status', "Key not exist");
	}	
	Header('Content-type: text/xml');
	print($xml->asXML());
}	
?>