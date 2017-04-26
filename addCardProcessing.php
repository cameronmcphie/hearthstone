<?php
	parse_str($_SERVER['QUERY_STRING']);
	// Deck is empty need to pick class again
	if ($Dclass == "") {
		header("location: createDeck.php?Pid=$Pid&deckNum=$deckNum&deck=exists");
	}
	else{
		include("config.php");
		$dbhost = dbhost;
		$dbuser = dbuser;  
		$dbpass = dbpass; 
		$dbname = dbname;
		$dbconnection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		if (mysqli_connect_errno()) {
			die("Database connection failed: " .
			mysqli_connect_error() . " (" > mysqli_connect_errno() . ")" );
		}

		// Need this for when creating a new deck
		$query = "SELECT NumOfDecks FROM PLAYER WHERE Pid = $Pid";
		$result = mysqli_query($dbconnection, $query);
		if (!$result) {
		  die("Database query failed.");
		}
		$row = mysqli_fetch_assoc($result);
		$row = (int)$row["NumOfDecks"];
		$Pid = (int)$Pid;
		$Cid = (int)$Cid;
		$deckNum = (int)$deckNum;
		if ($row < $deckNum) {
			$query = "UPDATE PLAYER SET NumOfDecks = $deckNum WHERE Pid = $Pid";
			$result = mysqli_query($dbconnection, $query);
			if (!$result) {
			  die("Database query failed.");
			}
		}

		$query = "SELECT * FROM IN_DECK WHERE (Pid = $Pid AND Dnum = $deckNum AND Cid = $Cid)";
		$result = mysqli_query($dbconnection, $query);
		if (!$result) {
		  die("Database query failed.");
		}
		if (mysqli_num_rows($result) == 1) {
			$query = "INSERT INTO IN_DECK (Pid,Cid,Dnum,Dclass,NumInDeck,CardsInDeck) VALUES ($Pid,$Cid,$deckNum,'$Dclass',2,30)";
			$result = mysqli_query($dbconnection, $query);
			if (!$result) {
				die("Database query failed.");
				header("location: allCards.php?Pid=$Pid&Dnum=$deckNum&attempt=failed");
				mysqli_free_result($result);
				// Close the database connection
				mysqli_close($dbconnection);
			}
			else {
			// Release returned result
			mysqli_free_result($result);
			// Close the database connection
			mysqli_close($dbconnection);
			header("location: allCards.php?deckNum=$deckNum&Pid=$Pid&Dclass=$Dclass&attempt=success");
			}
		}
		else if (mysqli_num_rows($result) == 0) {
			$query = "INSERT INTO IN_DECK (Pid,Cid,Dnum,Dclass,NumInDeck,CardsInDeck) VALUES ($Pid,$Cid,$deckNum,'$Dclass',1,30)";
			$result = mysqli_query($dbconnection, $query);
			if (!$result) {
				die("Database query failed.");
				header("location: allCards.php?Pid=$Pid&Dnum=$deckNum&attempt=failed");
				// Release returned result
				mysqli_free_result($result);
				// Close the database connection
				mysqli_close($dbconnection);
			}
			else {
			// Release returned result
-			mysqli_free_result($result);
			// Close the database connection
			mysqli_close($dbconnection);
			header("location: allCards.php?deckNum=$deckNum&Pid=$Pid&Dclass=$Dclass&attempt=success");
			}
		}
		else {
			mysqli_query($dbconnection, $query);
			// Release returned result
			mysqli_free_result($result);
			// Close the database connection
			mysqli_close($dbconnection);
			header("location: allCards.php?deckNum=$deckNum&Pid=$Pid&Dclass=$Dclass&attempt=failed");
		}
	}
?>