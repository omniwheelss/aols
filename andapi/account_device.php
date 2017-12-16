<?include_once("auth.php"); ?>
<?include_once("default.css"); ?>
<?include_once("text.php"); ?>
<?include_once("include.php"); ?>
<?
$Group=$_REQUEST["Group"];
if(strlen($Group)==0){$Group="ALL";}
if($Group=="ALL"){$Group_Index="ALL";$Group_Name="ALL";}
elseif($Group=="Moving"){$Group_Index="Moving";$Group_Name="Moving";}
elseif($Group=="Stopped"){$Group_Index="Stopped";$Group_Name="Stopped";}
elseif($Group=="Verify"){$Group_Index="Verify";$Group_Name="Verify";}
else{
	$sql="SELECT Group_Index,Group_Name FROM DEVICE_GROUP_MASTER where Group_Index='$Group' and Account_ID='$Account_ID'";
	$result = mysql_query($sql);
	$row=mysql_fetch_row($result);
	$Group_Index=$row[0];
	$Group_Name=$row[1];
}

$Search=$_REQUEST["Search"];
if(strlen($Search)==0){$Search="ALL";}
?>

<head>
</head>

<body style="width:100%;background: #FFFFFF;background-image:url('images/bg_device_list.gif');" leftmargin="0" rightmargin="0" topmargin="0" >

<script type="text/javascript" src="js/wz_tooltip.js"></script>  
<center>

	<table width=100% height=100% align="center" cellspacing="0" cellpadding="0" border="0">
<?

			if ($User_Type_ID==1){
				$sql="SELECT a.Group_Index,a.Group_Name FROM DEVICE_GROUP_MASTER a, DEVICE_GROUP_USER b WHERE a.Group_Index=b.Group_Index AND b.Username='$Username'";
				$result = mysql_query($sql);
			
				if ($Group=="ALL" || $Group=="Moving" || $Group=="Stopped" || $Group=="Verify"){
					$sql="SELECT a.Group_Index,a.Group_Name FROM DEVICE_GROUP_MASTER a, DEVICE_GROUP_USER b WHERE a.Group_Index=b.Group_Index AND b.Username='$Username'";
				}else{
					$sql="SELECT a.Group_Index,a.Group_Name FROM DEVICE_GROUP_MASTER a, DEVICE_GROUP_USER b WHERE a.Group_Index=b.Group_Index AND b.Username='$Username' AND a.Group_Index='$Group_Index'";
				}
			
				$result = mysql_query($sql);
			
				$GROUP_LIST="";
				while($row=mysql_fetch_row($result)){
					if (strlen($GROUP_LIST)>0){
						$GROUP_LIST=$GROUP_LIST.","."'".$row[0]."'";
					}else{
						$GROUP_LIST="'".$row[0]."'";
					}
				}
				// Filter the IMEI list based on the Access Profile of the User to the Groups
				$sql="select distinct a.IMEI from DEVICE_GROUP a, DEVICE_REGISTER b where a.IMEI=b.IMEI and Group_Index in ($GROUP_LIST) order by b.Asset_No";
				$result = mysql_query($sql);
				$imei=0;
				while($row=mysql_fetch_row($result)){
					$IMEI_LIST[$imei]=$row[0];
					$imei++;
				}
			}
			
			
			if ($User_Type_ID==2){
			
				$sql="select Group_Index,Group_Name from DEVICE_GROUP_MASTER where Account_ID='$Account_ID'";
				$result = mysql_query($sql);
				// Filter the IMEI list for the account
				if ($Group_Index=="ALL" || $Group_Index=="Stopped" || $Group_Index=="Moving" || $Group_Index=="Verify"){
					$sql="select IMEI from DEVICE_REGISTER where Account_ID='$Account_ID' and Device_Status='Active' order by Asset_No";
					$result = mysql_query($sql);
					$imei=0;
					while($row=mysql_fetch_row($result)){
						$IMEI_LIST[$imei]=$row[0];
						$imei++;
					}
				}else{
					$sql="select a.IMEI from DEVICE_GROUP a, DEVICE_REGISTER b where a.IMEI=b.IMEI and Group_Index='$Group_Index' order by b.Asset_No";
					$result = mysql_query($sql);
					$imei=0;
					while($row=mysql_fetch_row($result)){
						$IMEI_LIST[$imei]=$row[0];
						$imei++;
					}
				}
			}

?>

		<tr>
			<td valign="top">
			<table width=225 align="center" cellspacing="0" cellpadding="0" border="0">			

			
		
<?

if ($Group_Index=="ALL" || $Group_Index=="Stopped" || $Group_Index=="Moving" || $Group_Index=="Verify"){
	$API_GROUP="ALL";
}else{
	$API_GROUP="$Group_Index";
}

// Call API to fetch Last Known Location of all Vehicles in this account
$url="$KLIKO_API_BASE_URL/xml_last_known_loc_all.php?KEY=$KLIKO_API_KEY&ACCOUNT=$Account_ID&GROUP=$API_GROUP";
$device_index_url=$MAP_API."_device_index.php";

$Device_List=array();
$ctr=0;

//Fetch list of stopped, moving and verify devices
if ($query = load_xml($url)){

	for ($i=0;$i<count($query,0);$i++){
		
		$IMEI=$query->location[$i]->imei;
		$Asset_No=$query->location[$i]->asset_no;
	 	$Phone_No=$query->location[$i]->phone_no;  
		$Driver=$query->location[$i]->driver;
		$Date=$query->location[$i]->date;
		$Time=$query->location[$i]->time;		
		$GMT_Drift=$query->location[$i]->gmt_drift;
		$Location_Name=$query->location[$i]->loc;
		$Latitude=$query->location[$i]->latitude;
		$Longitude=$query->location[$i]->longitude;
		$Speed=$query->location[$i]->speed;
		$Device_Health=$query->location[$i]->device_health;

		$show_record=0;
		$group_record=0;
		
		if($Group_Index=="Stopped" && $Device_Health=="Stopped"){
			$group_record=1;
		}elseif($Group_Index=="Moving" && $Device_Health=="Moving"){
			$group_record=1;
		}elseif($Group_Index=="ALL"){
			$group_record=1;
		}elseif($Group_Index=="Verify" && ($Device_Health=="Verify"	 || $Device_Health=="Verify GPS")){
			$group_record=1;
		}elseif($Group_Index!="ALL" && $Group_Index!="Stopped" && $Group_Index!="Moving" && $Group_Index!="Verify"){
			$group_record=1;
		}
		
		if($Search=="ALL"){			
			$show_record=1;
		}
		if($Search!="ALL"){
			$check=strpos(strtolower($Asset_No),strtolower($Search),0);
			if($check!==false){
				$show_record=1;
			}
		}



		
		
		if (in_array($IMEI,$IMEI_LIST) && $show_record==1 && $group_record==1){
			
				$Device_List[$ctr][0]=$IMEI;
				$Device_List[$ctr][1]=$Asset_No;
				$Device_List[$ctr][2]=$Phone_No;
				$Device_List[$ctr][3]=$Driver;				
				$Device_List[$ctr][4]=$Date;
				$Device_List[$ctr][5]=$Time;				
				$Device_List[$ctr][6]=$GMT_Drift;				
				$Device_List[$ctr][7]=$Location_Name;
				$Device_List[$ctr][8]=$Latitude;
				$Device_List[$ctr][9]=$Longitude;
				$Device_List[$ctr][10]=$Speed;				
				$Device_List[$ctr][11]=$Device_Health;
				$ctr++;
		}
	}
}

//Fetch list of unknown devices
if( $Group_Index!="Stopped" && $Group_Index!="Moving"){
	$url="$KLIKO_API_BASE_URL/xml_unknown_imei.php?KEY=$KLIKO_API_KEY&ACCOUNT=$Account_ID&GROUP=$API_GROUP";
	
	if ($query = load_xml($url)){
		for ($i=0;$i<count($query,0);$i++){
			$IMEI=$query->location[$i]->imei;
			$Asset_No=$query->location[$i]->asset_no;
		 	$Phone_No=$query->location[$i]->phone_no;  
			$Driver=$query->location[$i]->driver;
			$Date=$query->location[$i]->date;
			$Time=$query->location[$i]->time;		
			$GMT_Drift=$query->location[$i]->gmt_drift;
			$Location_Name=$query->location[$i]->loc;
			$Latitude=$query->location[$i]->latitude;
			$Longitude=$query->location[$i]->longitude;
			$Speed=$query->location[$i]->speed;
			$Device_Health=$query->location[$i]->device_health;
			
			$show_record=0;
	
			if($Search=="ALL"){
				$show_record=1;
			}
			if($Search!="ALL"){
				$check=strpos(strtolower($Asset_No),strtolower($Search),0);
				if($check!==false){
					$show_record=1;
				}
			}
			
			if (in_array($IMEI,$IMEI_LIST) && $show_record==1){
	
				
					$Device_List[$ctr][0]=$IMEI;
					$Device_List[$ctr][1]=$Asset_No;
					$Device_List[$ctr][2]=$Phone_No;
					$Device_List[$ctr][3]=$Driver;				
					$Device_List[$ctr][4]="";
					$Device_List[$ctr][5]="";				
					$Device_List[$ctr][6]=$GMT_Drift;				
					$Device_List[$ctr][7]="";
					$Device_List[$ctr][8]="";
					$Device_List[$ctr][9]="";
					$Device_List[$ctr][10]="";				
					$Device_List[$ctr][11]="Verify";
					$ctr++;
			}		
		}
	}
}



$moving_count		=0;
$stopped_count		=0;
$verify_count		=0;
$verify_gps_count	=0;



// Moving Vehicles
for ($ctr=0;$ctr<count($Device_List,0);$ctr++){
	
		$IMEI			=$Device_List[$ctr][0];
		$Asset_No		=$Device_List[$ctr][1];
		$Phone_No		=$Device_List[$ctr][2];
		$Driver			=$Device_List[$ctr][3];
		$Date			=$Device_List[$ctr][4];
		$Time			=$Device_List[$ctr][5];
		$GMT_Drift		=$Device_List[$ctr][6];
		$Location_Name	=$Device_List[$ctr][7];
		$Latitude		=$Device_List[$ctr][8];
		$Longitude		=$Device_List[$ctr][9];
		$Speed			=$Device_List[$ctr][10];
		$Device_Health	=$Device_List[$ctr][11];
		
		if ($Device_Health=="Moving"){
					$info_sql="select * from VEHICLE_INFORMATION where IMEI='$IMEI'";
					$info_result = mysql_query($info_sql);
					$info_row = mysql_fetch_row($info_result);
			
					$Make=$info_row[1];
					$Model=$info_row[2];
					$Description=$info_row[3];
					$Serial_No=$info_row[4];
					$Plate=$info_row[5];
					$Vehicle_Condition=$info_row[6];
					$Hours=$info_row[7];
					$Odometer=$info_row[8];
					$VMU_Location=$info_row[9];
					$VMU_Wiring=$info_row[10];
					$Base_Hub=$info_row[11];
					$Comments=$info_row[12];
			
					$popup="<center><font size=2><b><u>Vehicle Information</u></b></font></center><br>";
					$popup.="<b>Driver : </b>$Driver<br>";
					$popup.="<b>Make : </b>$Make<br>";
					$popup.="<b>Model : </b>$Model<br>";
					$popup.="<b>Serial # : </b>$Serial_No<br>";
					$popup.="<b>Plate # : </b>$Plate<br><br>";
					$popup.="<b>VMU IMEI : </b>$IMEI<br>";
					$popup.="<b>Phone No : </b>$Phone_No<br><br>";
					$popup.="<b>Comments : </b><br>$Comments<br><br>";
			
					// check if file exists
					$filename = 'imei_images/thumbs/'.$IMEI.'.jpg';
			
					if (file_exists($filename)) {
						$image=$IMEI;
					}
					else {
						$image="noimg";
					}
			
					echo "<tr>";
					echo "<td class=devicelist width=10 align=center><img src='images/moving.gif'/></td>";
					echo "<td class=devicelist><a href=\"javascript:void(0);\" onmouseover=\"Tip('<b>$Asset_No</b><p>Make: $Make $Model<br>IMEI : $IMEI<br>Driver : $Driver<br>Serial # : $Serial_No<br>Plate # : $Plate<br>Cell : $Phone_No<br>Note : $Comments</p><br><img src=imei_images/thumbs/$image.jpg width=150 height=100>', WIDTH, 150, PADDING, 5, BGCOLOR, '#ffffff')\" onmouseout=\"UnTip()\" style=\"text-decoration:none;color: #525252;\">$Asset_No</a></td>";
					echo "<td class=devicelist style=\"text-align: center;\"  title='$table06_02'><a href='$device_index_url?IMEI=$IMEI&ASSET_NO=$Asset_No' target=report_frame><img src=images/track.gif border=0></a></td>";
					echo "<td class=devicelist style=\"text-align: center;\"  title='$table06_03'><a href='report_list.php?IMEI=$IMEI&ASSET_NO=$Asset_No&DRIVER=$Driver' target=report_frame><img src=images/device_select.gif border=0></a></td>";
					echo "</tr>";
					$moving_count++;		
		}
}
		
// Stopped Vehicles
for ($ctr=0;$ctr<count($Device_List,0);$ctr++){	    
		$IMEI			=$Device_List[$ctr][0];
		$Asset_No		=$Device_List[$ctr][1];
		$Phone_No		=$Device_List[$ctr][2];
		$Driver			=$Device_List[$ctr][3];
		$Date			=$Device_List[$ctr][4];
		$Time			=$Device_List[$ctr][5];
		$GMT_Drift		=$Device_List[$ctr][6];
		$Location_Name	=$Device_List[$ctr][7];
		$Latitude		=$Device_List[$ctr][8];
		$Longitude		=$Device_List[$ctr][9];
		$Speed			=$Device_List[$ctr][10];
		$Device_Health	=$Device_List[$ctr][11];
		
		if ($Device_Health=="Stopped"){
					$info_sql="select * from VEHICLE_INFORMATION where IMEI='$IMEI'";
					$info_result = mysql_query($info_sql);
					$info_row = mysql_fetch_row($info_result);
			
					$Make=$info_row[1];
					$Model=$info_row[2];
					$Description=$info_row[3];
					$Serial_No=$info_row[4];
					$Plate=$info_row[5];
					$Vehicle_Condition=$info_row[6];
					$Hours=$info_row[7];
					$Odometer=$info_row[8];
					$VMU_Location=$info_row[9];
					$VMU_Wiring=$info_row[10];
					$Base_Hub=$info_row[11];
					$Comments=$info_row[12];
			
					$popup="<center><font size=2><b><u>Vehicle Information</u></b></font></center><br>";
					$popup.="<b>Driver : </b>$Driver<br>";
					$popup.="<b>Make : </b>$Make<br>";
					$popup.="<b>Model : </b>$Model<br>";
					$popup.="<b>Serial # : </b>$Serial_No<br>";
					$popup.="<b>Plate # : </b>$Plate<br><br>";
					$popup.="<b>VMU IMEI : </b>$IMEI<br>";
					$popup.="<b>Phone No : </b>$Phone_No<br><br>";
					$popup.="<b>Comments : </b><br>$Comments<br><br>";
			
					// check if file exists
					$filename = 'imei_images/thumbs/'.$IMEI.'.jpg';
			
					if (file_exists($filename)) {
						$image=$IMEI;
					}
					else {
						$image="noimg";
					}
			
					echo "<tr>";
					echo "<td class=devicelist width=10 align=center><img src='images/stopped.gif'/></td>";
					echo "<td class=devicelist><a href=\"javascript:void(0);\" onmouseover=\"Tip('<b>$Asset_No</b><p>Make: $Make $Model<br>IMEI : $IMEI<br>Driver : $Driver<br>Serial # : $Serial_No<br>Plate # : $Plate<br>Cell : $Phone_No<br>Note : $Comments</p><br><img src=imei_images/thumbs/$image.jpg width=150 height=100>', WIDTH, 150, PADDING, 5, BGCOLOR, '#ffffff')\" onmouseout=\"UnTip()\" style=\"text-decoration:none;color: #525252;\">$Asset_No</a></td>";
					echo "<td class=devicelist style=\"text-align: center;\"  title='$table06_02'><a href='$device_index_url?IMEI=$IMEI&ASSET_NO=$Asset_No' target=report_frame><img src=images/track.gif border=0></a></td>";
					echo "<td class=devicelist style=\"text-align: center;\"  title='$table06_03'><a href='report_list.php?IMEI=$IMEI&ASSET_NO=$Asset_No&DRIVER=$Driver' target=report_frame><img src=images/device_select.gif border=0></a></td>";
					echo "</tr>";
					$stopped_count++;
		}
}
	
// Verify Vehicles

if( $Group_Index!="Stopped" && $Group_Index!="Moving"){
for ($ctr=0;$ctr<count($Device_List,0);$ctr++){
	
		$IMEI			=$Device_List[$ctr][0];
		$Asset_No		=$Device_List[$ctr][1];
		$Phone_No		=$Device_List[$ctr][2];
		$Driver			=$Device_List[$ctr][3];
		$Date			=$Device_List[$ctr][4];
		$Time			=$Device_List[$ctr][5];
		$GMT_Drift		=$Device_List[$ctr][6];
		$Location_Name	=$Device_List[$ctr][7];
		$Latitude		=$Device_List[$ctr][8];
		$Longitude		=$Device_List[$ctr][9];
		$Speed			=$Device_List[$ctr][10];
		$Device_Health	=$Device_List[$ctr][11];
				
		if ($Device_Health=="Verify" || $Device_Health=="Verify GPS" ){
					$info_sql="select * from VEHICLE_INFORMATION where IMEI='$IMEI'";
					$info_result = mysql_query($info_sql);
					$info_row = mysql_fetch_row($info_result);
			
					$Make=$info_row[1];
					$Model=$info_row[2];
					$Description=$info_row[3];
					$Serial_No=$info_row[4];
					$Plate=$info_row[5];
					$Vehicle_Condition=$info_row[6];
					$Hours=$info_row[7];
					$Odometer=$info_row[8];
					$VMU_Location=$info_row[9];
					$VMU_Wiring=$info_row[10];
					$Base_Hub=$info_row[11];
					$Comments=$info_row[12];
			
					$popup="<center><font size=2><b><u>Vehicle Information</u></b></font></center><br>";
					$popup.="<b>Driver : </b>$Driver<br>";
					$popup.="<b>Make : </b>$Make<br>";
					$popup.="<b>Model : </b>$Model<br>";
					$popup.="<b>Serial # : </b>$Serial_No<br>";
					$popup.="<b>Plate # : </b>$Plate<br><br>";
					$popup.="<b>VMU IMEI : </b>$IMEI<br>";
					$popup.="<b>Phone No : </b>$Phone_No<br><br>";
					$popup.="<b>Comments : </b><br>$Comments<br><br>";
			
					// check if file exists
					$filename = 'imei_images/thumbs/'.$IMEI.'.jpg';
			
					if (file_exists($filename)) {
						$image=$IMEI;
					}
					else {
						$image="noimg";
					}
			
					echo "<tr>";
					if ($Device_Health=="Verify GPS"){
						echo "<td class=devicelist width=10 align=center><img src='images/verify_gps.gif'/></td>";
						$verify_gps_count++;
					}else{
						echo "<td class=devicelist width=10 align=center><img src='images/verify.gif'/></td>";
						$verify_count++;
					}
					echo "<td class=devicelist><a href=\"javascript:void(0);\" onmouseover=\"Tip('<b>$Asset_No</b><p>Make: $Make $Model<br>IMEI : $IMEI<br>Driver : $Driver<br>Serial # : $Serial_No<br>Plate # : $Plate<br>Cell : $Phone_No<br>Note : $Comments</p><br><img src=imei_images/thumbs/$image.jpg width=150 height=100>', WIDTH, 150, PADDING, 5, BGCOLOR, '#ffffff')\" onmouseout=\"UnTip()\" style=\"text-decoration:none;color: #525252;\">$Asset_No</a></td>";
					echo "<td class=devicelist style=\"text-align: center;\"  title='$table06_02'><a href='$device_index_url?IMEI=$IMEI&ASSET_NO=$Asset_No' target=report_frame><img src=images/track.gif border=0></a></td>";
					echo "<td class=devicelist style=\"text-align: center;\"  title='$table06_03'><a href='report_list.php?IMEI=$IMEI&ASSET_NO=$Asset_No&DRIVER=$Driver' target=report_frame><img src=images/device_select.gif border=0></a></td>";
					echo "</tr>";
	
		}
	}			
}


/*
// Filter Records based on search criteria
if($Search!="ALL"){	
	$filter_record_set=array();
	$j=0;
	for ($i=0;$i<count($record_set,0);$i++){
		$IMEI=$record_set[$i][0];
		$Asset_No=$record_set[$i][1];

		$check=strpos(strtolower($Asset_No),strtolower($Search),0);
		if($check!==false){
			$filter_record_set[$j][0]=$record_set[$i][0];
			$filter_record_set[$j][1]=$record_set[$i][1];
			$filter_record_set[$j][2]=$record_set[$i][2];
			$filter_record_set[$j][3]=$record_set[$i][3];
			$filter_record_set[$j][4]=$record_set[$i][4];
			$j++;
		}
	}
	$record_set=array();
	$record_set=$filter_record_set;
}
*/


?>
</table>
</td>
</tr>
<?if (in_array('21',$Feature_Set)){?>	
  	<script lanuguage="javascript">
		function load_health_summary(){
			parent.health_summary.location='health_summary.php?MOVING=<?=$moving_count;?>&STOPPED=<?=$stopped_count;?>&VERIFY=<?=$verify_count;?>&VERIFYGPS=<?=$verify_gps_count;?>';
		}
		setTimeout('load_health_summary()',2000);
	</script>
<?}?>
</table>

</body>
</html>
