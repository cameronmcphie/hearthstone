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
			header("location: allCards.php?Pid=$Pid&Dnum=$deckNum&attempt=failed");
		}

		// Need this for when creating a new deck
		$query = "SELECT NumOfDecks FROM PLAYER WHERE Pid = $Pid";
		$result = mysqli_query($dbconnection, $query);
		if (!$result) {
		  header("location: allCards.php?Pid=$Pid&Dnum=$deckNum&attempt=failed");
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
			  header("location: allCards.php?Pid=$Pid&Dnum=$deckNum&attempt=failed");
			}
		}

		$query = "SELECT * FROM IN_DECK WHERE Pid = $Pid AND Dnum = $deckNum";
		$result = mysqli_query($dbconnection, $query);
		if (!$result) {
			  header("location: allCards.php?Pid=$Pid&Dnum=$deckNum&attempt=failed");
			}
		if (mysqli_num_rows($result) >= 30) {
			header("location: playerDeck.php?Pid=$Pid&deckNum=$deckNum");
		}
		else {
			$query = "SELECT * FROM IN_DECK WHERE (Pid = $Pid AND Dnum = $deckNum AND Cid = $Cid)";
			$result = mysqli_query($dbconnection, $query);
			if (!$result) {
			  header("location: allCards.php?Pid=$Pid&Dnum=$deckNum&attempt=failed");
			}
			if (mysqli_num_rows($result) == 1) {
				$query = "INSERT INTO IN_DECK (Pid,Cid,Dnum,Dclass,NumInDeck) VALUES ($Pid,$Cid,$deckNum,'$Dclass',2)";
				$result = mysqli_query($dbconnection, $query);
				if (!$result) {
					header("location: allCards.php?Pid=$Pid&Dnum=$deckNum&attempt=failed");
				}
				else {
				header("location: allCards.php?deckNum=$deckNum&Pid=$Pid&Dclass=$Dclass&attempt=success");
				}
			}
			else if (mysqli_num_rows($result) == 0) {
				$query = "INSERT INTO IN_DECK (Pid,Cid,Dnum,Dclass,NumInDeck) VALUES ($Pid,$Cid,$deckNum,'$Dclass',1)";
				$result = mysqli_query($dbconnection, $query);
				if (!$result) {
					header("location: allCards.php?Pid=$Pid&Dnum=$deckNum&attempt=failed");
				}
				else {
				header("location: allCards.php?deckNum=$ddeckNum&Pid=$Pid&Dclass=$Dclass&attempt=success");
				}
			}
			else {
				mysqli_query($dbconnection, $query);
				header("location: allCards.php?deckNum=$deckNum&Pid=$Pid&Dclass=$Dclass&attempt=failed");
			}
		}
	}
	mysqli_free_result($result);
	mysqli_close($dbconnection);
?>