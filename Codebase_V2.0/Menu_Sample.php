	
<?php if(isset($Cook_Variable[1])){	?>
 <div id="globalNav" style="float:left">
<div class="gblNavigation" id="gblNavigation" style="border:solid 0px red;">

	<?php
		if(isset($_COOKIE[$Cook_Name])){
			echo "<div align=\"right\" class=\"textconTOP\">Welcome, <span style='color:#F25151'>". $Cook_Variable[0] ."</span> &nbsp;&nbsp;[ <a href='Logout.php?cmd=logout' class=\"logout\">logout</a> ]</div>";
		}
	?>

	<?php
	
		######################################################
		#
		#		Menu Declaration 
		#
		#######################################################	
		
		$Menus_Array = array ('Sample');
		$Sub_Menus_Array = array ('E');
				
		//Extra menu Declaration
		$Extra_Menu_Array[0] = array (
									0 => array("Add_Sample.php | Add Sample","List_Sample.php | List Sample")
								);

		?>


	 <table class="Nav" border="0" cellpadding="0" cellspacing="0">
	 	<tr>
			<td class="home-btn" height="25" width="28">
				<a href="Home.php" alt="Home" title="Home" style="width: 28px; height: 25px; display: block;"></a>
			</td>
			
			<?php
				$M = 0;
				foreach ($Menus_Array as $Menus){
					$Menuss = str_replace('_',' ',$Menus);
			?>
        
	     <td class="NavText" onmouseover="mopen('m<?=$M?>')" onmouseout="mclosetime()">
		      <a href="#" class="NavLink"><?=$Menuss?></a>
			   <div id="m<?=$M?>">
			        <table align="left" border="0" cellpadding="0" cellspacing="0">
        				<tr>
					         <td colspan="2" id="mgDd">
						          <table align="left" border="0" cellpadding="0" cellspacing="0">
           								<tr>
								            <td><img src="images/IMG_dropdown_tab-left.gif" alt="" height="27" width="4"></td>
								           <td style="background-image: url(images/IMG_dropdown_tab-bg.gif);" class="PopupTab">
												<a href="#" class="popNavLink"><?=$Menuss?></a>
											</td>
								            <td><img src="images/IMG_dropdown_tab-right.gif" alt="" height="27" width="4"></td>
							           </tr>
								 </table>
							 </td>
			    	    </tr>
			        	<tr>
							 <td id="mgPopup" width="5">&nbsp;</td>
							 <td>
								  <table id="mgDdRht" border="0" cellpadding="0" cellspacing="0" width="210">
									<tr>
										<td colspan="3" height="10"></td>
									</tr>
									<?
                                        if(!empty($Sub_Menus_Array[$M])){
                                    ?>
									<tr>
										<td>
											<table border="0" cellpadding="2" cellspacing="2" >
												<tr>
														<? 
                                                            $Option = $Sub_Menus_Array[$M];
															if($Option == 'AL'){
															?>
														<td width="135"><a href="Add_<?=$Menus?>.php" class="PopupLinks">Add <?=$Menuss?></a></td>
														<td class="Dotts" width="10"></td>
														<td width="135"><a href="List_<?=$Menus?>.php" class="PopupLinks">List <?=$Menuss?></a></td>
															<?	
															}
															elseif($Option == 'A'){
															?>
														<td width="135"><a href="Add_<?=$Menus?>.php" class="PopupLinks">Add <?=$Menuss?></a></td>
														<td class="Dotts" width="10"></td>
														<td width="135">&nbsp;</td>
															<?	
															}
															elseif($Option == 'L'){
															?>
														<td width="135">&nbsp;</td>
														<td class="Dotts" width="10"></td>
														<td width="135"><a href="List_<?=$Menus?>.php" class="PopupLinks">List <?=$Menuss?></a></td>
															<?	
															}
															elseif($Option == 'E'){
															?>
                                                        <td colspan="3">
                                                        	<table border="0" cellpadding="2" cellspacing="2">
                                                            <?
																foreach($Extra_Menu_Array[$M] as $Menu_Key => $Ex_Menus){
																	$Ex_Menus1 = explode('|',$Ex_Menus[0]);
																	$Ex_Menus2 = explode('|',$Ex_Menus[1]);
																	$Menu_Left_Link = $Ex_Menus1[0];
																	$Menu_Left_Disp = $Ex_Menus1[1];
																	$Menu_Right_Link = $Ex_Menus2[0];
																	$Menu_Right_Disp = $Ex_Menus2[1];
															?>
                                                            	<tr>
                                                                    <td width="135"><a href="<?=$Menu_Left_Link?>" class="PopupLinks"><?=$Menu_Left_Disp?></a></td>
                                                                    <td class="Dotts" width="10"></td>
                                                                    <td width="135"><a href="<?=$Menu_Right_Link?>" class="PopupLinks"><?=$Menu_Right_Disp?></a></td>
                                                                </tr>
															<?	
																}
															?>
                                                            </table>
                                                         </td>          
															<?	
															}
															?>
                                                            
                                                            
												</tr>
                                                
											</table>
										</td>			
								   </tr>
									<?
                                    }
                                    ?>    
								   <tr>
										<td colspan="5" height="10"></td>
								   </tr>
								</table>
							</td>
						</tr>
					</table>			
				</div>	
		 </td>
		 
		 
		 <td><img src="images/navSep.gif" alt=""></td>
         
		<?
			$M++;
		} // Menus end
		?>
		
     </tr>
	</table>
		<div style="clear:both"></div>
  </div>
  </div>
<?php 	
}
else{
?>
	<div id="menu_middle">
	 <ul>
	</ul>	
	</div>
<?php } ?>	
