<?php include("Header.php"); ?>
<?php
	$title = "admin";
	$title_head = "Logout";
?>
<?php
if(isset($_GET['cmd'])){
		setcookie($Cook_Name,"",time()-345);
		header("Location: index.php");
		exit;
}
?>