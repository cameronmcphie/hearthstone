<!DOCTYPE html>
<html>

	<head>
		<title>Homepage</title>
		<link rel="stylesheet" type="text/css" href="css/topBar.css">
		<link rel="stylesheet" type="text/css" href="css/playerProfile.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	</head>
	<?php
	parse_str($_SERVER['QUERY_STRING']);
	?>

<body>
	<div class = "topBar">
		<img class = "logo" src = "css/img/logo.png">
    	<div class = "menuBar">
			<?php
			echo "<a class=\"w3-btn w3-ripple w3-red left-button\" href=\"index.php\">Logout</a>"
			?>
			<?php
			echo "<a class=\"w3-btn w3-ripple w3-green right-button\" href=\"createDeck.php?Pid=$Pid\">Create Deck</a>"
			?>
		</div>
		<div class = "title">My Decks</div>
	</div>

	<div class = "mainContainer">
		<?php
			// Parse the query string
		   // Check that the query string is set
		   if (isset($Pid) && $Pid != '') {
				// Connect to DB
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
				// Set query and feth result 
		   		$query = "Select * FROM PLAYER WHERE Pid = $Pid";
		   		$result = mysqli_query($dbconnection, $query);
		   		$row = mysqli_fetch_assoc($result);
		   		// Check to make sure the Pid exists
		   		if (!is_null($row["Pid"])) {
		   			for ($i = 1; $i <= $row["NumOfDecks"]; $i++) {
		   				echo "<a href=\"playerDeck.php?deckNum=$i&Pid=$Pid\"><div class=\"deckLink\">$i</div></a>";
		   			}
		   			mysqli_free_result($result);
					mysqli_close($dbconnection);
		   		}
		   		else {
					echo "<div class = \"noPid\"><strong style=\"color:red\">This account does not exist!</strong></div>";
					mysqli_free_result($result);
					mysqli_close($dbconnection);
		   		}
		   	}
		   else {
		   	echo "<divs class = \"noPid\"><strong style=\"color:red\">You are not Logged in!</strong></div>";
		   }
		?>
	</div>
</body>
</html>

