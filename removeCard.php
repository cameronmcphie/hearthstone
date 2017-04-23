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
	$query = "SELECT * FROM IN_DECK WHERE Cid = $Cid AND Pid = $Pid AND Dnum = $deckNum";
	$result = mysqli_query($dbconnection, $query);
	if (mysqli_num_rows($result) > 1) {
		$query = "DELETE FROM IN_DECK where Cid = $Cid AND Pid = $Pid AND DNum = $deckNum AND NumInDeck = 2";
		mysqli_query($dbconnection, $query);
		// Release returned result
		mysqli_free_result($result);
		// Close the database connection
		mysqli_close($dbconnection);
		header("location: playerDeck.php?deckNum=$deckNum&Pid=$Pid&attempt=success");
	}
	else if (mysqli_num_rows($result) > 0) {
		$query = "DELETE FROM IN_DECK where Cid = $Cid AND Pid = $Pid AND DNum = $deckNum AND NumInDeck = 1";
		mysqli_query($dbconnection, $query);
		// Release returned result
		mysqli_free_result($result);
		// Close the database connection
		mysqli_close($dbconnection);
		header("location: playerDeck.php?deckNum=$deckNum&Pid=$Pid&attempt=success");
	}
	else {
		// Release returned result
		mysqli_free_result($result);
		// Close the database connection
		mysqli_close($dbconnection);
		header("location: playerDeck.php?deckNum=$deckNum&Pid=$Pid&attempt=failed");
	}
?>