<?
	include("config.php");
	putenv('TZ = GMT');

   // This code snippet was added to handle browser caching issues while handling Excel Exports
   // not opening directly. Users were forced to save the file and then open the same.
      
    session_cache_limiter ('private, must-revalidate');    
    $cache_limiter = session_cache_limiter();
    session_cache_expire(120); // in minutes 
    
    // Start the session
	session_name('StayF');
	session_start();
	
    if(isset($_REQUEST["Username"]) && isset($_REQUEST["Password"])){
                        $Username=$_REQUEST["Username"];
                        $Password=$_REQUEST["Password"];
                        $HOME_URL=$_REQUEST["HOME_URL"];
                        if (strlen($HOME_URL)==0){$HOME_URL="index.php";}
                        $Color_Theme="images/theme_blue.jpg";

        }

   if(isset($Username)&&isset($Password)){
                        $_SESSION['Username']=$Username;
                        $_SESSION['Password']=$Password;
                        $_SESSION['HOME_URL']=$HOME_URL;
                        $_SESSION['Color_Theme']=$Color_Theme;
    }

    if (isset($_REQUEST["Language"])){
                $Language = $_REQUEST["Language"];
        $_SESSION['Language']=$Language;
        }else if (isset($_SESSION['Language'])){
                $Language = $_SESSION['Language'];
        }else{
                $Language = "english";
        $_SESSION['Language']=$Language;
    }


  	if(strlen($HOME_URL)==0){
  		$HOME_URL="index.php";
  	}
 	
	include("version.php");

	$db = mysql_connect("$DATABASE_SERVER:$DATABASE_PORT", "$DATABASE_USERNAME","$DATABASE_PASSWORD");
	mysql_select_db("$DATABASE_NAME",$db);
        
	$sql = "SELECT a.Firstname,a.Lastname,a.User_Type_ID,a.Account_ID,a.E_Mail,a.Alerts,a.Refresh,a.Map_Size,a.Map_API,c.Map_API_Key,b.Account_Name,a.Valid_Till,a.Icon_Set FROM USER_MASTER a,ACCOUNT b, ACCOUNT_MAP c WHERE a.Username='" . $_SESSION['Username'] . "' and a.Status='Enabled' and a.Password='" . $_SESSION['Password'] . "' and a.Account_ID=b.Account_ID and a.Account_ID=c.Account_ID and a.Map_API=c.Map_API and a.KlikoF='enabled' and a.User_Type_ID in ('1','2')";
	$result = mysql_query( $sql );
	$row = mysql_fetch_row($result);
	$record_count=mysql_num_rows($result);
		
		
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
		?>
		<script lanuguage="javascript">
			function refresh_parent(){
				 window.open("<?=$HOME_URL?>","_top");		
			}
			setTimeout('refresh_parent()',0000);
		</script>
		<?
		exit;
	}elseif($record_count>0 && $Valid_Till>=$Current){
			
				$User_Full_Name=$row[0] . " " . $row[1];
				$User_Type_ID=$row[2];
				$Account_ID=$row[3];
				$E_Mail=$row[4];
				$Alerts=$row[5];
				$Refresh_Rate=$row[6];
				$Map_Size=$row[7];	
				/*
				if ($Map_Size==1){$Map_Height=400;$Map_Width=640;}
				if ($Map_Size==2){$Map_Height=480;$Map_Width=720;}
				if ($Map_Size==3){$Map_Height=520;$Map_Width=800;}
			    if ($Map_Size==4){$Map_Height=680;$Map_Width=880;}
			    if ($Map_Size==5){$Map_Height=640;$Map_Width=960;}
			    */
			    if ($Map_Size==1){$Map_Height=400;$Map_Width="99%";}
				if ($Map_Size==2){$Map_Height=440;$Map_Width="99%";}
				if ($Map_Size==3){$Map_Height=480;$Map_Width="99%";}
			    if ($Map_Size==4){$Map_Height=520;$Map_Width="99%";}
			    if ($Map_Size==5){$Map_Height=560;$Map_Width="99%";}
				
			    $MAP_API=$row[8];
			    // Fix for Map My India Maps Only
			    if ($MAP_API=="ceinfo"){$Map_Width="750px";}
				$MAP_API_KEY=$row[9];	
			    
				$Account_Name=$row[10];
				$Icon_Set=$row[12];
				if (strlen($Icon_Set)==0){$Icon_Set="set_1";}
				
				// Fetch Account Defaults		
				$sub_sql = "select Default_Speed_Threshold,Default_Distance_Unit,Reverse_Geocoding_Engine,Default_Volume_Unit,Geofence_Radius,Support_URL,Date_Format,Date_Seperator,Dist_Correction,Health_Time FROM ACCOUNT_DEFAULTS where Account_ID='$Account_ID'";
				$sub_result = mysql_query($sub_sql);
				$sub_row = mysql_fetch_row($sub_result);
					        	
				$DEFAULT_SPEED_THRESHOLD=$sub_row[0];
				$DEFAULT_DISTANCE_UNIT=$sub_row[1];
				$REV_GEO_ENGINE=$sub_row[2];     
				$DEFAULT_VOLUME_UNIT=$sub_row[3];
				$GEOFENCE_RADIUS=$sub_row[4];
				if(strlen($sub_row[5])>0){$Help_URL=$sub_row[5];}
				$DATE_FORMAT=$sub_row[6];
				$DATE_SEPERATOR=$sub_row[7];
				$DIST_CORRECTION=$sub_row[8];
				$HEALTH_TIME=$sub_row[9];
				
				$sub_sql="select * from ACCOUNT_FEATURE where Account_ID='$Account_ID' order by Feature_Index";
				$sub_result = mysql_query($sub_sql);
				$i=0;
				while ($sub_row = mysql_fetch_row($sub_result)){
						$Feature_Set[$i]=$sub_row[1];
						$i++;
				}				
				
				$Username=$_SESSION['Username'];
	}
	
?>
