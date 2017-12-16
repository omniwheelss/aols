<?
include_once("include_android.php");

	$KEY=$_REQUEST["KEY"];
	$ACCOUNT=$_REQUEST["ACCOUNT"];
	$AUTH_STATUS=0;
	if($_REQUEST['Username'] != '' && $_REQUEST['Password'] != ''){		
		$sql = "SELECT a.Firstname,a.Lastname,a.User_Type_ID,a.Account_ID,a.E_Mail,a.Alerts,a.Refresh,a.Map_Size,a.Map_API,c.Map_API_Key,b.Account_Name,a.Valid_Till,a.Icon_Set FROM USER_MASTER a,ACCOUNT b, ACCOUNT_MAP c WHERE a.Username='" . $_REQUEST['Username'] . "' and a.Status='Enabled' and a.Password='" . $_REQUEST['Password'] . "' and a.Account_ID=b.Account_ID and a.Account_ID=c.Account_ID and a.Map_API=c.Map_API and a.KlikoF='enabled' and a.User_Type_ID in ('1','2')";
		$result = mysql_query( $sql );
		$row = mysql_fetch_row($result);
		$record_count=mysql_num_rows($result);
		if($record_count > 0){
			
			if (strlen($row[11])==0){
					$Valid_Till=mktime(0,0,0);
					$Current=mktime(0,0,0);
			}else{
				$Valid_Till=$row[11];
				$day=substr($Valid_Till,0,2);
				$month=substr($Valid_Till,3,2);
				$year=substr($Valid_Till,6,4);
				$Valid_Till=mktime(0,0,0,$month,$day,$year);
				//$Current=mktime(0,0,0);
			}

				
			if ($record_count<1 || $Valid_Till<$Current) {
				exit;
			}elseif($record_count>0 && $Valid_Till>=$Current){
				$User_Full_Name=$row[0] . " " . $row[1];
				$User_Type_ID=$row[2];
				$Account_ID=$row[3];
				$E_Mail=$row[4];
			}
			// Check if the key provided, matches the Master API Key
			// If it matches the Master API Key, then the request is successfully authenticated.
			// NOTE : If the Master API Key is used, then it is mandatory that the ACCOUNT parameter is passed.
			if(strlen($KEY)>0 && strlen($ACCOUNT)>0 && $KEY==$KLIKO_API_KEY){	
				$AUTH_STATUS=1;	
				$Account_ID=$ACCOUNT;
			}


			// If the request is not authenticated against Master API Key, then check if the 
			// API Key is an account specific API Key

			if (strlen($KEY)>0 && $AUTH_STATUS==0){
				$sql = "SELECT Account_ID FROM ACCOUNT WHERE API_Key='$KEY'";
				$result = mysql_query( $sql );	
				$recordcount=mysql_num_rows($result);
				if ($recordcount >0){
					$row=mysql_fetch_row($result);
					$AUTH_STATUS=1;
					$Account_ID=$row[0];		
				}
			}

			if ($AUTH_STATUS==1 && $ACCOUNT!="UNKNOWN"){
				// Fetch Account Defaults
				list($DEFAULT_SPEED_THRESHOLD,$DEFAULT_DISTANCE_UNIT,$REV_GEO_ENGINE,$DEFAULT_VOLUME_UNIT,$GEOFENCE_RADIUS,$HELP_URL,$DATE_FORMAT,$DATE_SEPERATOR,$DIST_CORRECTION)=account_defaults($Account_ID);
			}
			if ($AUTH_STATUS==0){
				echo "<error>The API Key you entered was wrong.</error>";
				exit;
			}
		}	
	}
?>