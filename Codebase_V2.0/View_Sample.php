<?php
	
	####################################
	#
	#   $Date_Format = 1 - 2010-01-01 10:10:10 (yyyy-mm-dd hh:ii:ss)
	#   $Date_Format = 2 - 01-01-2010 10:10:10 (yyyy-mm-dd hh:ii:ss)
	#   $Date_Format = 3 - 01-01-2010 (yyyy-mm-dd)
	#   $Date_Format = 4 - 10:10:10 (hh:ii:ss)

	# 	$Photo_Fields[] = array($Photo_Field_Name,$Target_Folder_Path,$Thumb_Img_Folder_Path,",$Img_Width,$Img_Height,$Img_Name_Unique_Id,$Content_Type);
	#	$Photo_Fields[] = array("pho","big","thumb",100,'','Yes','I|F');
	#	Yes - means It will tale last insert record id from table and store with that name Ex : 123.jpg
	#
	################################################
	
	include("Header.php");
	$Title_Head = str_replace('.php','',basename($_SERVER['SCRIPT_NAME']));
	$List_Page = str_replace('View','List',basename($_SERVER['SCRIPT_NAME']));
	$Back_Link = '<a href="'.$List_Page.'" class="Navigation_Right">Back To List</a>';
	
	if(empty($_COOKIE[$Cook_Name])){
		header("Location: index.php");
		exit;
	}

	############################################
	#
	# variable Declaration
	#
	############################################
 	
	$Table_Name = "Table1";
	$Mysql_Select_Column = array ('ID','Tbox','Pword','Rad','Chec','Hid','Texta','Sel','Gender');
	// For Field Heading
	$Field_Name_Heading = array ('Textbox ID','Textbox Field','Pword','Rad','Chec','Hidden Field','Texta','Sel','Gender');
	
	 // Array Actual value from Dropdown Ex: Instead of one we can show Active or Inactive
	$Mysql_Select_Column1 = array ('','','','','','','',$Status_Array,$Gender_Array);
	
	//Photo and File Declaration
	$Photo_Fields[] = array("Fil","biFile","",100,'','Yes','F');
	$Photo_Fields[] = array("Fil2","biFile","",100,'','Yes','F');
	$Photo_Fields[] = array("pho","big","thumb",100,'','','I');
	

	###############################################     End      #########################################


	$Edit_ID_Column = $_REQUEST['Edit_Column'];

	// Javascript Validation	
	foreach($Form_Fields as $Forms){
		if($Forms[5] == '*'){
			$Jvalid_Arr[$Forms[3]].=$Forms[3].",";
			$Jvalid_Type_Arr[$Forms[6]].=$Forms[6].",";
		}
	}
	$Jvalid_Arr_Join = substr(join('',$Jvalid_Arr),0,-1);
	$Jvalid_Type_Arr_Join = substr(join('',$Jvalid_Type_Arr),0,-1);

	// Combine Mysql select columns for select the query	
	$Mysql_Select_Columns = join(',',$Mysql_Select_Column);
	
	// Getting View Id from Url
	$View_ID = $_REQUEST['View'];
	
	
	// Select total records for Navigation functionality
	$Select_Navigation_Sql=mysql_query("SELECT * FROM $Table_Name") or die (mysql_error());
	$Navigation_Num = mysql_num_rows ($Select_Navigation_Sql);
	$N = 1;	
	while($Navigation_Result=mysql_fetch_array($Select_Navigation_Sql)){ 
		$Navigation_ID[$N] = $Navigation_Result[$Edit_ID_Column];
		$N++;
	}
	$Navigation_Flip = array_flip($Navigation_ID);
	$Navigation_Prev = $Navigation_Flip[$View_ID]-1;
	$Navigation_Next = $Navigation_Flip[$View_ID]+1;
	$Total_Records = count($Navigation_ID);

	 // For Previous Record Navigation Link
	( ($Navigation_Prev == 0) ? $Navigation_Link_Prev = "<span class='Navigation_Left1'>&lt;&lt; Prev</span>" : $Navigation_Link_Prev = '<a href="'.$Title_Head.'.php?View='.$Navigation_ID[$Navigation_Prev].'&Edit_Column='.$Edit_ID_Column.'" class="Navigation_Left">&lt;&lt; Prev</a>');

	 // For Next Record Navigation Link
	( (empty($Navigation_ID[$Navigation_Next])) ? $Navigation_Link_Next = "<span class='Navigation_Right1'>Next &gt;&gt;</span>" : $Navigation_Link_Next = '<a href="'.$Title_Head.'.php?View='.$Navigation_ID[$Navigation_Next].'&Edit_Column='.$Edit_ID_Column.'" class="Navigation_Right">Next &gt;&gt;</a>');

?>

<div id="admin_div">
		<div id="admin_left">
		<div class="headings" ><?=$Title_Head?><div class="total_admin">Total Records : <?=$Total_Records?></div></div>
			<table border="0" cellpadding="0" cellspacing="0" width="985" height="30" align="left" style="padding-top:10px">
				<tr>
					<td width="30%" valign="top" align="left"><?=$Navigation_Link_Prev?></td>
					<td width="40%" valign="top" align="center"><?=$Back_Link?></td>
					<td width="30%" valign="top" align="right"><?=$Navigation_Link_Next?></td>
				</tr>
			</table>
		</div>
		<div style="clear:both"></div>
</div>
<form name="View_Form">
<div id="admin_div"  style="border:0px solid red;">
			<div style="padding-left:0px;"><span class="msg"><?=$_GET[Msg]?></span>
				<p class="headings" style="padding-left:10px;"></p>
			<table border="0" cellpadding="1" cellspacing="1" width="985" align="center">
				<?php
					$Select_Mysql = "SELECT $Mysql_Select_Columns FROM $Table_Name where $Edit_ID_Column = ".$_REQUEST['View']."";
					$View_Query = mysql_query($Select_Mysql);
					$Record_Count = mysql_num_rows ($View_Query);
					if($Record_Count){
				?>
				<tr bgcolor="#F0F0F0" height="25px">
                	<?php
					echo '<td class="admin-menu-heading">Column Name</td>';
					echo '<td class="admin-menu-heading">Column Value</td>';
					?>
				</tr>
				<tr>
					<td colspan="7">&nbsp;</td>
				</tr>
				<?php 
					$SNo = 1;
					$Record_Column = 0;
					while($Fetch_Result = mysql_fetch_array($View_Query)){

						($Record_Column%2 == 1 ? $Row_Cls = 'Grey_Bg' : $Row_Cls = 'White_Bg');
						$R = 0;
						foreach($Mysql_Select_Column as $Fields){
							echo $Display_List[] = "<tr class='$Row_Cls' height='25'>";
							
							if($Mysql_Select_Column1[$R]){
									$Arr_Field = $Mysql_Select_Column1[$R];
								echo "<td class='Row_Td' width='200px'>".$Field_Name_Heading[$R]."</td>";
								echo "<td class='Row_Td'>".$Arr_Field[$Fetch_Result[$Fields]]."</td>";
							}
							else{
								echo "<td class='Row_Td' width='200px'>".$Field_Name_Heading[$R]."</td>";
								echo "<td class='Row_Td'>".$Fetch_Result[$Fields]."</td>";
							}
							echo "</tr>";	
							$R++;
						}
						$P = 1;
						// Photo Fields Display
						foreach($Photo_Fields as $Photo){
							if($Photo[6] == 'I'){
								$Photo_Path = "".$Photo[2]."/".$Img_Thumb_Prefix."".$View_ID."_".$Photo[0].".jpg";
								if(file_exists($Photo_Path)){
									$Photo_View = '<a href="'.$Photo[1].'/'.$Img_Big_Prefix.''.$View_ID.'_'.$Photo[0].'.jpg" target="_New"><img src="'.$Photo[2].'/'.$Img_Thumb_Prefix.''.$View_ID.'_'.$Photo[0].'.jpg" /></a>';
									echo $Display_List[] = "<tr class='$Row_Cls' height='25'>";
									echo "<td class='Row_Td' width='200px'>".$Photo[0]."</td>";	
									echo "<td class='Row_Td'>".$Photo_View."</td>";
									echo "</tr>";	
								}
							}
							// File Content Display							
							elseif($Photo[6] == 'F'){
								$Open_Dir = opendir($Photo[1]);
								while(false != ($File_Con = readdir($Open_Dir))){
									if(($File_Con != ".") and ($File_Con != "..")){
										$DirFiles_Array = $File_Con;
										$Check_Pos = strpos($File_Con, $View_ID."_".$Photo[0]."_")."I";
										
											if( ($Check_Pos == '0I') ) {
												$DirFiles_Array1 = str_replace($View_ID.'_'.$Photo[0].'_','',$DirFiles_Array);
												$File_View = '<a href="'.$Photo[1].'/'.$DirFiles_Array.'" target="_New" class="File_Con">'.$DirFiles_Array1.'</a>';
												echo $Display_List[] = "<tr class='$Row_Cls' height='25'>";
												echo "<td class='Row_Td' width='200px'>".$Photo[0]."</td>";	
												echo "<td class='Row_Td'>".$File_View."</td>";
												echo "</tr>";	
											}
									}
								}
							}	
							else{	
								$Photo_View = '';
							}
							$P++;
						}				
						$SNo++;
						$Record_Column++;
					}
				?>					
				<?php
				}
				else{
					echo "<tr>
							<td id=\"\">".error_report("Records Not Found")."</td>
						</tr>";
				}				
				?>
			</table>
            </form>
			<br />
</div> 
		</div>		
				<div style="clear:both"></div>
		</div>
<?php include("Footer.php"); ?>	