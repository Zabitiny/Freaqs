<?php
	ob_start(); // turns on output buffering
	session_start(); // enables the use of sessions

	$sName = "localhost";
	$uName = "root";
	$pass = "";
	$db_name = "freaqs";
	// try {
	// 	$timezone = date_default_timezone_set("America/Los_Angeles");
	// 	$con = new PDO("mysql:host=$sName; dbname=$db_name",
	// 									$uName, $pass);
	// 	$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// } catch(PDOException $e) {
	// 	echo "Connection failed: ". $e->getMessage;
	// }

	$timezone = date_default_timezone_set("America/Los_Angeles");
  $con = mysqli_connect($sName, $uName, $pass, $db_name);

  if(mysqli_connect_errno()) {
    echo "Failed to connect: " . mysqli_connect_errno();
  }
?>