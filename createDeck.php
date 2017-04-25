<!DOCTYPE html>
<html>
	<head>
		<title>Create Account</title>
		<link rel="stylesheet" type="text/css" href="css/topBar.css">
		<link rel="stylesheet" type="text/css" href="css/createDeck.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	</head>
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
		$query = "SELECT NumOfDecks FROM PLAYER WHERE Pid = $Pid";
		$result = mysqli_query($dbconnection, $query);
		$row = mysqli_fetch_assoc($result);
		$deckNum = $row["NumOfDecks"] + 1;
	?>
<body>
	<div class = "topBar">
		<img class = "logo" src = "css/img/logo.png">
		<div class = "menuBar">
			<?php
				echo "<a class=\"w3-btn w3-ripple w3-red left-button\" href=\"playerProfile.php?Pid=$Pid\">Back to Decks</a>";
			?>
			<div class = "title">Select Deck Class</div>
		</div>
	</div>
	<div class="mainContainer">
		<?php echo "<a href=\"playerDeck.php?deckNum=$deckNum&Pid=$Pid&Dclass=Mage\">"; ?>
			<div class="classLogo"><img class="classImage" src="css/img/mage.png"/></div>
		</a>
		<?php echo "<a href=\"playerDeck.php?deckNum=$deckNum&Pid=$Pid&Dclass=Druid\">"; ?>
			<div class="classLogo"><img class="classImage" src="css/img/druid.png"/></div>
		</a>
		<?php echo "<a href=\"playerDeck.php?deckNum=$deckNum&Pid=$Pid&Dclass=Hunter\">"; ?>
			<div class="classLogo"><img class="classImage" src="css/img/hunter.png"/></div>
		</a>
		<?php echo "<a href=\"playerDeck.php?deckNum=$deckNum&Pid=$Pid&Dclass=Paladin\">"; ?>
			<div class="classLogo"><img class="classImage" src="css/img/paladin.png"/></div>
		</a>
		<?php echo "<a href=\"playerDeck.php?deckNum=$deckNum&Pid=$Pid&Dclass=Priest\">"; ?>
			<div class="classLogo"><img class="classImage" src="css/img/priest.png"/></div>
		</a>
		<?php echo "<a href=\"playerDeck.php?deckNum=$deckNum&Pid=$Pid&Dclass=Rogue\">"; ?>
			<div class="classLogo"><img class="classImage" src="css/img/rogue.png"/></div>
		</a>
		<?php echo "<a href=\"playerDeck.php?deckNum=$deckNum&Pid=$Pid&Dclass=Shaman\">"; ?>
			<div class="classLogo"><img class="classImage" class="classImage" src="css/img/shaman.png"/></div>
		</a>
		<?php echo "<a href=\"playerDeck.php?deckNum=$deckNum&Pid=$Pid&Dclass=Warlock\">"; ?>
			<div class="classLogo"><img class="classImage" src="css/img/warlock.png"/></div>
		</a>
		<?php echo "<a href=\"playerDeck.php?deckNum=$deckNum&Pid=$Pid&Dclass=Warrior\">"; ?>
			<div class="classLogo"><img class="classImage" src="css/img/warrior.png"/></div>
		</a>
	</div>
</body>