<?php
	include("config.php");
	$dbhost = dbhost;
	$dbuser = dbuser;
	$dbpass = dbpass;
	$dbname = dbname;
	$dbconnection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	// Check if the connection is ok
	if (mysqli_connect_errno()) {
		die("Database connection failed: " .
		mysqli_connect_error() . " (" > mysqli_connect_errno() . ")" );
	}
	parse_str($_SERVER['QUERY_STRING']);
	$Pid = (int)$Pid;
	$deckNum = (int)$deckNum;
	$query = "INSERT INTO IN_DECK VALUES ($Pid,0,$deckNum,'$Dclass',0,30)";
	$result = mysqli_query($dbconnection, $query);
	if (!$result) {
		die("Database query failed.");
	}

	
?>