<?php include("Header.php"); ?>
<?php 	
	if(empty($_COOKIE[$Cook_Name])){
		header("Location: index.php");
		exit;
	}
?>

<br /><br /><br /><br /><br /><br /><br />
	<form action="" method="post" name="Home_form" onsubmit="return login_validation()">
						<h1 style="padding:15px 0 15px 0; text-align:center;"><?=$Site_Heading?></h1> 
	</form>

	
<?php include("Footer.php"); ?>	