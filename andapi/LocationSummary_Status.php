<?php
header('Access-Control-Allow-Origin: *');
if($_REQUEST['Key'] == '14583' && $_REQUEST['format'] == 'xml'){
	$_REQUEST['KEY'] = "AIzaSyCWbN4L_XF9D_E5hazATy4kF9gDU_lztdQ";
	$Account_ID = $_REQUEST['ACCOUNT'] = 95;
	// XML format
	$xml = new SimpleXMLElement('<imei_list/>');

	//Fetching Records
	include("auth_android.php");

	if ($_REQUEST["GROUP"]){$GROUP=$_REQUEST["GROUP"];}else{$GROUP="ALL";}

	$IMEI_LIST=array();
	$REC_MAX_LIST="";
	// Generate a list of all IMEIs
	if ($GROUP=="ALL"){		
		$sql="select IMEI from DEVICE_REGISTER where Account_ID='$Account_ID' order by Asset_No";
	}else{		
		$sql="select IMEI from DEVICE_REGISTER where Account_ID='$Account_ID' and IMEI in (select IMEI from DEVICE_GROUP where Group_Index='$GROUP') order by Asset_No";
	}
	
	$result = mysql_query($sql);
	$i=0;
	while ($row=mysql_fetch_row($result)){
		$IMEI_LIST[$i]=$row[0];
		$i++;
	}
	
	//Get the Health Time(Hrs) from Account Defaults
	$sql = "select Health_Time from ACCOUNT_DEFAULTS where Account_ID='$Account_ID' limit 1";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	$HealthTime=$row[0];
	
	$sql="select a.IMEI,b.Asset_No,b.Phone_No,b.Driver,a.Date_Stamp,a.Time_Stamp,a.Location_Name,a.Latitude,a.Longitude,a.Speed,b.GMT_Drift,b.SIM_No,c.Device_Type,b.Device_Status,b.Device_Index,b.Added_On from DEVICE_DATA_VIEW a,DEVICE_REGISTER b,DEVICE_TYPE c where a.IMEI=b.IMEI and b.Device_Type_ID=c.Device_Type_ID order by b.Asset_No,a.Epoch_Time DESC,a.Speed DESC";
	$result = mysql_query($sql);
	$recordcount = mysql_num_rows($result);
	if($recordcount > 0){
		while ($row=mysql_fetch_row($result)){
			$IMEI=$row[0];
			if (in_array($IMEI,$IMEI_LIST)){
				$Asset_No=$row[1];
				$Phone_No=$row[2];
				$Driver=$row[3];
				$SIM_No=$row[11];
				$Device_Type=$row[12];
				$Device_Status=$row[13];
				$Device_Index=$row[14];
				$Added_On=$row[15];
				$Date=$row[4];
				$Time=$row[5];
				$Latitude=$row[7];
				$Longitude=$row[8];
				$Speed=$row[9];
				$GMT_Drift=$row[10];
				
				if ($Speed<=8){$Speed=0;}
				if ($DEFAULT_DISTANCE_UNIT=="Miles"){$Speed=round(($Speed*0.6214),1);}
				
				if (strlen($row[6])==0 || $row[6]=="Could not fetch location name"){    	  
						$Location_Name=get_location_name($REV_GEO_ENGINE,$Longitude,$Latitude);
						$Location_Name=preg_replace("/[^A-Za-z0-9\s\.\-\/+\!;\n\t\r]/", "", $Location_Name);			
		
				}else {
						$Location_Name=$row[6];
						$Location_Name=preg_replace("/[^A-Za-z0-9\s\.\-\/+\!;\n\t\r]/", "", $Location_Name);			
				}
				
				$Difference=date_diff($Date,$Time,$GMT_Drift);
				
				if ($Speed==0 && $Difference<$HealthTime){$Device_Health="Stopped";}
				if ($Speed>0 && $Difference<$HealthTime){$Device_Health="Moving";}
				if ($Difference>$HealthTime){$Device_Health="Verify";}
				
				if($Device_Health=="Verify"){			
					$sub_sql="select Date_Stamp,Time_Stamp from GPS_HEALTH where IMEI='$IMEI' order by Record_Index DESC LIMIT 1";
					$sub_result = mysql_query($sub_sql);
					$sub_recordcount = mysql_num_rows($sub_result);
							
					$sub_row = mysql_fetch_row($sub_result);
					$gps_verify_diff=date_diff($sub_row[0],$sub_row[1],$GMT_Drift);
				
					if ($gps_verify_diff<=$Difference && $gps_verify_diff<=$HealthTime) {
						$Device_Health="Verify GPS";
					}
				}		
				$track = $xml->addChild('location');
				//$track->addChild('imei', $IMEI);
				//$track->addChild('added_on', $Added_On);
				//$track->addChild('device_index', $Device_Index);
				//$track->addChild('device_type', $Device_Type);
				//$track->addChild('device_status', $Device_Status);
				$track->addChild('device_health', $Device_Health);
				$track->addChild('asset_no', $Asset_No);
				//$track->addChild('phone_no', $Phone_No);
				//$track->addChild('sim_no', $SIM_No);
				//$track->addChild('driver', $Driver);
				$track->addChild('date', $Date);
				$track->addChild('time', $Time);
				//$track->addChild('gmt_drift', $GMT_Drift);
				$track->addChild('latitude', $Latitude);
				$track->addChild('longitude', $Longitude);
				$track->addChild('speed', $Speed);
				$track->addChild('loc', $Location_Name);
			}
		}
	}	
	Header('Content-type: text/xml');
	print($xml->asXML());
}
else{
	$data = "key not exist";
	$xml = new SimpleXMLElement('<xml/>');
	$track = $xml->addChild('data');
	$track->addChild('error', $data);
	Header('Content-type: text/xml');
	print($xml->asXML());
}	
?>