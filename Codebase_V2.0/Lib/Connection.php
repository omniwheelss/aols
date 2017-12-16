<?php
$hostname="localhost";
$username="root";
$password="";
$dbname = "LTP";
$conn=mysql_connect($hostname,$username,$password);
$db=mysql_select_db($dbname,$conn);
?>
