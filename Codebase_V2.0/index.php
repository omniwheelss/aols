<?php
 ob_start();
 error_reporting(0); 
 // Include Connection and Arrays
 include("./Lib/Includes.php"); 

	if(!empty($_COOKIE[$Cook_Name])){
		header("Location: Home.php");
		exit;
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" > 
<head> 
  <title><?=$Title?></title> 
  
	 <link rel="stylesheet" type="text/css" href="css/Style.css">
	 <script language="javascript" type="text/javascript" src="js/jscript.js"></script>
	 <script language="javascript" type="text/javascript" src="js/jq1.js"></script>
 
<script language="javascript" type="text/javascript"> 
	function setFocus() {
		document.login_form.uname.select();
		document.login_form.uname.focus();
	}
</script> 
</head> 
<body onload="javascript:setFocus()"> 

<?php

	####################################
	#	// For Text fields
	#	$Form_Fields[$No]= array($Element_Type,$Field_Type,$Field_Heading,$Field_Name,$Field_Value,$Manditary,$JValid,$Class_Name,$Extra);
	
	#	// For Select Event
	#	$Form_Fields[$No]= array($Element_Type,$Field_Type,$Field_Heading,$Field_Name,$Field_Value,$Manditary,$JValid,$Class_Name,$Extra,$Combo_Title,$Match);
	
	#	$Field_Type 1 => 'text',
	#	$Field_Type 2 => 'password',
	#	$Field_Type 3 => 'radio',
	#	$Field_Type 4 => 'checkbox',
	#	$Field_Type 5 => 'submit',
	#	$Field_Type 6 => 'button',
	#	$Field_Type 7 => 'hidden',
	#	$Field_Type 8 => 'file',
	
	#   $JValid = E - Should Not Empty
	#   $JValid = N - Numeric Valid (Only String allowed)
	#   $JValid = NN - Numeric Valid (Only Numbers allowed)
	#   $JValid = L - Text Limit
	
	#   $Field_Heading = Optional (Default will take Field Name)
	#
	#	Func_Forms_Element($Element_Type,$Field_Type,$Field_Name,$Field_Value,$Class_Name,$Extra)
	#
	#	Func_Select_Element($Element_Type,$Field_Type,$Field_Name,$Field_Value,$Class_Name,$Extra,$Combo_Title,$Match)
	#
	################################################

	include("Lib/Includes.php");
	$Title_Head = str_replace('.php','',basename($_SERVER['SCRIPT_NAME']));
	$List_Page = str_replace('Add','List',$Title_Head);
	

	############################################
	#
	# variable Declaration
	#
	############################################

	$Table_Name = "USER_MASTER";
	$Duplicate_Column = "";
	
	//Select
	
	//Text boxes
	$Form_Fields[] = array('1','1','UserName','uname','','*','E|N|0','','login-input','');
	$Form_Fields[] = array('1','2','Password','upass','','*','E|N|0','','login-input','');
	
	//Submit Button
	$Form_Fields[] = array('1','5','','Login_Submit','Login','','','','submit_but','');

	// Join query - 
	$Query_To_Mysql_Join = "";
	

	
	// Javascript Validation	
	foreach($Form_Fields as $Forms){
		if($Forms[5] == '*'){
			$Jvalid_Arr[$Forms[3]].=$Forms[3].",";
			$Jvalid_Type_Arr[$Forms[6]].=$Forms[6].",";
		}
	}
	$Jvalid_Arr_Join = substr(join('',$Jvalid_Arr),0,-1);
	$Jvalid_Type_Arr_Join = substr(join('',$Jvalid_Type_Arr),0,-1);
	
	// After submit
	$Submit_Pos =count($Form_Fields) - 1;
	if(isset($_REQUEST[$Form_Fields[$Submit_Pos][3]])){
		$Username = $_REQUEST['uname'];
		$Password = md5(trim($_REQUEST['upass']));
		$Login_Sql = "select * from $Table_Name where Username = '$Username' and Password = '$Password'";
		$Login_Run = mysql_query($Login_Sql) or die(mysql_error());
		$Login_Count = mysql_num_rows($Login_Run); 
		if($Login_Count == 1){
			$Login_Result=mysql_fetch_array($Login_Run);
			$Random = rand(0,99999);
			$Cook_Variable = $Login_Result['Username']."|".$Random."|".$Login_Result['User_Type_ID'];
			setcookie("$Cook_Name", "$Cook_Variable", time()+86400);
			header("Location: Home.php");
			exit;
		}
		else{
			$war_msg = error_report ( "Oops! Username or Password wrong" );
		}
	}
?>

	
<br /><br /><br /><br /><br />
<div align="center">
			<div id="element-box" class="login"> 
				<div class="t"> 
					<div class="t"> 
						<div class="t"></div> 
					</div> 
				</div> 
				<div class="m"> 
 
					<h1 style="padding:15px 0 15px 10px"><?=$Site_Heading?></h1> 
					<p class="home-content">Use a valid username and password to gain access to the Administrator Back-end.
						<!--<a href="<?=$Administration_Home?>" class="home">Return to site Home Page</a> -->
                        <div class="home" style="width:100px;">&nbsp;</div>
					</p> 
				<div>	
					<div style="width:150px;float:left;">
						<div id="lock"></div> 
					</div>
					<div  style="width:400px;float:left">
					<!-- Login Box  -->
							<div id="section-box">  
								<div class="t"> 
									<div class="t"> 
										<div class="t"></div> 
									</div> 
								</div> 
								<div class="m"> 
                                <br />
									<?php
										if($war_msg){
											echo "<span class='msg'>".$war_msg."</span><br />";
										}
									?>
									<?php 
                                   
                                            echo "<form action=\"\" method=\"post\" name=\"login_form\" id=\"login_form\" onsubmit=\"return FormValid('$Jvalid_Arr_Join','$Jvalid_Type_Arr_Join')\">";
                                                        
                                                    foreach($Form_Fields as $Forms){
                                                        if($Forms[1] == 3){
                                                            // For select Box ?>						
                                                        <div id="admin_left_inner">
                                                                <div id="admin_fields"><?=($Forms[2] != ''?$Forms[2] : $Forms[3])?><?=($Forms[5] == '*'?$star : '')?></div>
                                                            <?=Func_Select_Element($Forms[0],$Forms[1],$Forms[3],$Forms[4],$Forms[8],$Forms[9],$Forms[10],$Forms[11]);?>
                                                            <?=J_Mes($Forms[3]);?>
                                                        </div>
                                    
                                                       <? }elseif($Forms[1] == 5 || $Forms[1] == 6){ echo $Forms[2];
                                                            // For Submit boxes
                                                        ?>
                                                        <div id="admin_left_inner">
                                                            <div class="submbg" style="margin-left:220px;"><?=Func_Forms_Element($Forms[0],$Forms[1],$Forms[3],$Forms[4],$Forms[8],$Forms[9]);?><div class="submbg1"></div><div style="clear:both"></div>
                                                        </div>	
                                                                    
                                                       <? }else{
                                                            // For Text boxes
                                                        ?>
                                                        <div id="admin_left_inner">
                                                                <div id="admin_fields"><?=($Forms[2] != ''?$Forms[2] : $Forms[3])?><?=($Forms[5] == '*'?$star : '')?></div>
                                                            <?=Func_Forms_Element($Forms[0],$Forms[1],$Forms[3],$Forms[4],$Forms[8],$Forms[9]);?>
                                                            <?=J_Mes($Forms[3]);?>
                                                        </div>
                                                        
                                                       <? } ?>
                                                        
                                                   <? } ?> 

							</div> 
						</form>
						<div class="clr"></div> 
									<div class="clr"></div> 
								</div> 
								<div class="b"> 
									<div class="b"> 
										<div class="b"></div> 
									</div> 
								</div> 
							</div> 
							
					<!-- Login Box  End -->

					</div>
					<div style="clear:both"></div><br /><br />
				</div>
		
				</div> 
				<div class="b"> 
					<div class="b"> 
						<div class="b"></div> 
					</div> 
				</div> 
					<div id="footer_home"> 
						<p class="copyright"> <br />
							Copyright &copy; <?=date("Y")?> <a href="<?=$Footer_Link?>" target="_blank" class="home"><?=$Website_Name?>.</a> All Rights Reserved. 
							</p> 
					</div> 
			</div> 
			<div class="clr"></div> 
		</div> 
	</div> 
</div>
</body> 
</html> 		
