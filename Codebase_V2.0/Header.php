<?php
 ob_start(); error_reporting(0); 
 include("Lib/Includes.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?=$Title?></title>
	<? if($XLS != 1){ ?>
	 <link rel="stylesheet" type="text/css" href="css/Style.css">
	 <script language="javascript" type="text/javascript" src="js/admin-menu1.js"></script>
	 <script language="javascript" type="text/javascript" src="js/admin-menu2.js"></script>
	 <script language="javascript" type="text/javascript" src="js/jscript.js"></script>
	 <script language="javascript" type="text/javascript" src="js/jq1.js"></script>
	 
</head>
<body>
<center>
	<?php
		$query = $_SERVER['QUERY_STRING'];
		$url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$Cook_Variable = explode("|",$_COOKIE[$Cook_Name]);
		
	?>

<div id="wrap">
  <div id="banner"  style="width:1000px;">
  		<div class="top-left"></div>
  		<div class="top-middle"><div class="website-name-inner"><?=$Title?></div></div>
  		<div class="top-right"><!--<img src="images/<?=$Logo_Name?>" alt ="<?=$Website_Name?>" class="logo-inner">--></div>
  		

  <?php
		switch($Cook_Variable[2]){
			case 1:	
	  		 include("Menu_Owner.php");
			break;
			default:
			include("Menu_Sample.php");
			break;
		}
  ?>
  
  </div>
  <table border="0" cellpadding="0" cellspacing="0" width="1000" style="border:solid 1px #D0D7EC; border-top:0px; border-bottom:0px;">
  		<tr>
			<td height="400px;" valign="top">
            
           <?
		   } // Excel end
		   ?> 