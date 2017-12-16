<?php

include_once('Arrays.php');

######################################################
#
#		Form Fields Creation function
#
#######################################################
							
function Func_Forms_Element($Element_Type,$Field_Type,$Field_Name,$Field_Value,$Class_Name,$Extra,$Match){
	global $Form_Element_Array;

	switch($Element_Type){
		case 1:
			if($Field_Type != 9){
				// For Radio Button
				if($Field_Type == 3){
					$Match_final = ($Field_Value == $Match ? 'checked="checked"' : '');
					$Form_Fields = "<input type=\"$Form_Element_Array[$Field_Type]\" name=\"$Field_Name\" id=\"$Field_Name\" value=\"$Field_Value\" class =\"$Class_Name\" ".$Field_Event." ".$Extra." ".$Match_final." />";
				}
				// For Check box
				elseif($Field_Type == 4){
					$Match_final = ($Field_Value == $Match ? 'checked="checked"' : '');
					$Form_Fields = "<input type=\"$Form_Element_Array[$Field_Type]\" name=\"$Field_Name\" id=\"$Field_Name\" value=\"$Field_Value\" class =\"$Class_Name\" ".$Field_Event." ".$Extra." ".$Match_final." />";
				}
				else{
					$Form_Fields = "<input type=\"$Form_Element_Array[$Field_Type]\" name=\"$Field_Name\" id=\"$Field_Name\" value=\"$Field_Value\" class =\"$Class_Name\" ".$Field_Event." ".$Extra." />";
				}
			}
			else{
				$Form_Fields = "<textarea name=\"$Field_Name\" id=\"$Field_Name\" value=\"$Field_Value\" class =\"$Class_Name\" ".$Extra." />".$Field_Value."</textarea>";
			}
		break;

		default:
		break;
	}
	return $Form_Fields;
}


######################################################
#
#		Form Select Element Creation function
#
#######################################################
							
function Func_Select_Element($Element_Type,$Field_Type,$Field_Name,$Field_Value,$Class_Name,$Extra,$Combo_Title,$Match){
	$Match = urldecode($Match);
	$Select_Element = "
		<select name=\"".$Field_Name."\" id=\"".$Field_Name."\" class=\"$Class_Name\" ".$Extra.">
			<option value=\"0\" selected=\"selected\">".$Combo_Title."</option>";
				while (list ($key, $f_value) = each ($Field_Value)) {
					$Select_Element .= "<option value=\"".$key."\" ".($key == $Match ? 'selected' : '') .">".$f_value."</option>";
				}
		$Select_Element .= "</select>";
	return $Select_Element;
}



######################################################
#
#		Error Report function
#
#######################################################

function Error_Report($Content){
	$Error_Message="<div id='error_text'>$Content</div>";
	return $Error_Message;
}


######################################################
#
#		Message Display function
#
#######################################################


function Message_Display($Content){
	$Message_Display="<div id='error_text'>$Content</div>";
	return $Message_Display;
}

######################################################
#
#		Javascript Message Display
#
#######################################################

function J_Mes($Get_Name){
	return $J_Value = "<div id=\"".$Get_Name."v\" class=\"admin_valid_txt\" ></div><div>&nbsp;</div>";
}


######################################################
#
#		Duplicate Records Checking
#
#######################################################
function Check_Exist($Tab_Name,$Duplicate_Columns_Final,$Duplicate_Column){
		$Mysql_Query = "select * from $Tab_Name where $Duplicate_Columns_Final";
		$Mysql_Query_Result = mysql_query($Mysql_Query) or die(mysql_error());
		$Mysql_Record_Count = mysql_num_rows($Mysql_Query_Result);
		if($Mysql_Record_Count>=1){
			return $Mysql_Record_Count;
		}
}


######################################
#
#	Date Format Function
#
############################################

function Date_Format_Func($Date,$Format){
		global $Date_Format_Array;
		$Date_Output = date($Date_Format_Array[$Format],strtotime($Date));
		return $Date_Output;
}


######################################
#
#	Query Executer
#
############################################

function Query_Executer($Query){

	$Query_Result = mysql_query($Query);
	if($Query_Result)
		return $Message = "Query Executed Successfully";
	
}


######################################
#
#	Image Upload and Thumbnail Creater
#
############################################

function CreateThumbs( $Field_Name , $pathToImages, $pathToThumbs, $thumbWidth, $thumbHeight = '', $Insert_ID, $Sequence) {
	global $Tmp_Upload;
	global $Img_Big_Prefix;
	global $Img_Thumb_Prefix;

	$Img_Info = $_FILES[$Field_Name];
	$Img_Name = $Img_Info['name'];
	$Img_Type = $Img_Info['type'];
	$Img_Tmp_Name = $Img_Info['tmp_name'];
	$Img_Size = $Img_Info['size'];
	if(file_exists($pathToImages) == '')
		mkdir($pathToImages, 0777);

	if(file_exists($pathToThumbs) == '')
		mkdir($pathToThumbs, 0777);

	if( strstr($Img_Type,'image') != ''){
			
			if(str_replace('image/','',$Img_Type) == 'jpeg')
				$Img_Ext = 'jpg';
			else
				$Img_Ext  = str_replace('image/','',$Img_Type);	
				$Img_Ext = 'jpg';
			
			$Img_Name1 = explode('.',$Img_Name);
			if(!empty($Insert_ID)){	
				$Img_Name_Big = "/".$Img_Big_Prefix."".$Insert_ID."_".$Sequence.".".$Img_Ext;
				$Img_Name_Thumb = $pathToThumbs .""."/".$Img_Thumb_Prefix."".$Insert_ID."_".$Sequence.".".$Img_Ext;
			}	
			else{
				$Img_Name_Big = "/".$Img_Big_Prefix."".$Img_Name1[0]."_".$Sequence.".".$Img_Ext;
				$Img_Name_Thumb = $pathToThumbs .""."/".$Img_Thumb_Prefix."".$Img_Name1[0]."_".$Sequence.".".$Img_Ext;
			}	
				
		 	$Moved_Img1 = move_uploaded_file($Img_Tmp_Name, "./$pathToImages".$Img_Name_Big);
			if(!$Moved_Img1)
				echo "Not moved";	

			// load image and get image size
			$img = imagecreatefromjpeg( "./$pathToImages/$Img_Name_Big" );
			$width = imagesx( $img );
			$height = imagesy( $img );

			
			// calculate thumbnail size
			$new_width = $thumbWidth;
			if(empty($thumbHeight))
				$new_height = floor( $height * ( $thumbWidth / $width ) );
			else
				$new_height =   $thumbHeight;
			
			// create a new tempopary image
			$tmp_img = imagecreatetruecolor( $new_width, $new_height );
			
			// copy and resize old image into new image 
			imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
			// save thumbnail into a file
			imagejpeg( $tmp_img, "{$Img_Name_Thumb}" );

	}
	else{
		 	$Moved_File = move_uploaded_file($Img_Tmp_Name, "./$pathToImages/".$Insert_ID."_".$Field_Name."_".$Img_Name);
	}	
	// close the directory
	closedir( $dir );
}

######################################
#
#	Random String Function
#
############################################


function Random_String_Func($Len){
		$len = 16;
		$base='ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz';
		$max=strlen($base)-1;
		$activatecode='';
		mt_srand((double)microtime()*1000000);
		while (strlen($activatecode)<$len+1)
		$activatecode.=$base{mt_rand(0,$max)};
		$pass_str = substr($activatecode,0,$Len);
		return $pass_str;
}		


######################################
#
#	HTML Editor Function
#
############################################

	function HTML_Editor(){
?>
        <!-- TinyMCE -->
        <script type="text/javascript" src="./Lib/jscripts/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript">
            tinyMCE.init({
                // General options
                mode : "textareas",
                theme : "advanced",
                plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
        
                // Theme options
                theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : true,
        
                // Example content CSS (should be your site CSS)
                content_css : "css/content.css",
        
                // Drop lists for link/image/media/template dialogs
                template_external_list_url : "lists/template_list.js",
                external_link_list_url : "lists/link_list.js",
                external_image_list_url : "lists/image_list.js",
                media_external_list_url : "lists/media_list.js",
        
                // Style formats
                style_formats : [
                    {title : 'Bold text', inline : 'b'},
                    {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
                    {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
                    {title : 'Example 1', inline : 'span', classes : 'example1'},
                    {title : 'Example 2', inline : 'span', classes : 'example2'},
                    {title : 'Table styles'},
                    {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
                ],
        
                // Replace values for the template plugin
                template_replace_values : {
                    username : "Some User",
                    staffid : "991234"
                }
            });
        </script>    

<?

	}


######################################
#
#	List Files From Directory
#
############################################

function Read_Direcotry($Dir_Name){
	$Open_Dir = opendir($Dir_Name);
	$F = 1;	
	while(false != ($File_Con = readdir($Open_Dir))){
		if(($File_Con != ".") and ($File_Con != "..")){
			return $File_Con;
		}
		$F++;
	}
}



######################################
#
#	Update Log Query Executer
#
############################################

function Update_Query_Executer($AccountID,$Activity){

	$Query = "insert into LOGS (Account_ID,Date_Stamp,Activity) values ('".$AccountID."','".date('Y-m-d H:i:s')."','".$Activity."')";
	$Query_Result = mysql_query($Query);
	if($Query_Result)
		return $Message = "Query Executed Successfully";
	
}




function func_cities($name,$title){

	global $cities_array;

	$sel_cities = "

		<select name=\"".$name."\">

			<option value=\"0\">------- ".$title." ---------- </option>";

			foreach($cities_array as $key => $city){

				$sel_cities .= "<option value=\"".$key."\">".$city."</option>";

			}

		$sel_cities .= "</select>

	";		

	return $sel_cities;

}


function clean_url($text){ 

	$text=strtolower($text); 

	$code_entities_Match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','='); 

	$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','',''); 

	$text = str_replace($code_entities_Match, $code_entities_replace, $text); 

	return  $text; 

} 



function clean_text($text){ 

	$code_entities_Match = array('<?','?>','<?php','<?=','"','\''); 

	$code_entities_replace = array('&lt?;','?&gt;','&lt?php','&lt?=','&quot;','&#39;'); 

	$text = str_replace($code_entities_Match, $code_entities_replace, $text); 

	return  $text; 

} 



		$star = "<span class='valid_txt1'> *</span>";



		$daylight = date('Y-m-d h:i:s');

		$created_on = $daylight;

		$updated_on = $daylight;



		$reg_ip = $_SERVER['REMOTE_ADDR'];

		

function Sec2Time($time){

	global $sec_to_time_val;

  if(is_numeric($time)){

    $sec_to_time_val = array(

      "years" => 0, "days" => 0, "hours" => 0,

      "minutes" => 0, "seconds" => 0,

    );

    if($time >= 31556926){

      $sec_to_time_val["years"] = floor($time/31556926);

      $time = ($time%31556926);

    }

    if($time >= 86400){

      $sec_to_time_val["days"] = floor($time/86400);

      $time = ($time%86400);

    }

    if($time >= 3600){

      $sec_to_time_val["hours"] = floor($time/3600);

      $time = ($time%3600);

    }

    if($time >= 60){

      $sec_to_time_val["minutes"] = floor($time/60);

      $time = ($time%60);

    }

    $sec_to_time_val["seconds"] = floor($time);

    (array) $sec_to_time_val;

  }else{

    return (bool) FALSE;

  }	

 	return "".$sec_to_time_val['hours'] ." : ".$sec_to_time_val['minutes']." : ".$sec_to_time_val['seconds']."" ;

}









?>

