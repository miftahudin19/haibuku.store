<?php  
ob_start();
if(!isset($_SESSION)){
session_start();
}

$timezone = date_default_timezone_set("Asia/Jakarta");

$con = mysqli_connect("localhost:3306", "miftah", "Hai161907", "haibuku"); //Connection variable

if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}
?>