<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/table.css">
	<link rel="stylesheet" type="text/css" href="css/topBar.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<title>All Cards</title>
</head>
   
<body>
   <div class = "topBar">
		<img class = "logo" src = "css/img/logo.png">
		<div class = "menuBar">
			<?php
			echo "<a class=\"w3-btn w3-ripple w3-red left-button\" href=\"index.php\">Back to Homepage</a>";
				parse_str($_SERVER['QUERY_STRING']);
				if (isset($Pid)) {
				echo "<a class=\"w3-btn w3-ripple w3-green right-button\" href=\"playerDeck.php?deckNum=$deckNum&Pid=$Pid&Dclass=$Dclass\">Back to Deck</a>";
				}
			?>
	    	<div class = "title">All Cards</div>
    	</div>
	</div>
	<div class = "table">
		<div class = "row">
			<div class = "cell"><strong>Name</strong></div>
			<div class = "cell"><strong>Mana</strong></div>
			<div class = "cell"><strong>Health</strong></div>
			<div class = "cell"><strong>Attack</strong></div>
			<div class = "cell"><strong>Subtype</strong></div>
			<div class = "cell-description"><strong>Description</strong></div>
			<div class = "cell"><strong>Class</strong></div>
			<div class = "cell"><strong>Rarity</strong></div>
			<div class = "cell"><strong>Collection</strong></div>
		</div>
	<?php
		// 1. Create a database connection
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
      // 2. Perform database query
		if (isset($Dclass)) {
			$query = "SELECT * FROM CARDS WHERE Class = '$Dclass' OR Class = 'Neutral'";
		}
		else {
			$query = "SELECT * ";
			$query .= "FROM CARDS";
		}
		//echo $query;
		//echo "<br>";
		$result = mysqli_query($dbconnection, $query);
		// Check if there is a query error
		if (!$result) {
		 die("Database query failed.");
		}
   ?>
	<?php
		// 3. Use returned result
		while ($row = mysqli_fetch_assoc($result)) {
		// output data from each row
    ?>
		<div class = "row">
			<div class = "cell"><?php echo $row["Cname"]; ?></div>
			<div class = "cell"><?php echo $row["Mana"]; ?></div>
			<?php 
			if ($row["Health"] != -1) {
				echo "<div class = \"cell\">";
				echo $row["Health"];
				echo "</div>";
			}
			else {
				echo "<div class = \"cell\">&nbsp</div>";
			}
			?>
			<?php 
			if ($row["Attack"] != -1) {
				echo "<div class = \"cell\">";
				echo $row["Attack"];
				echo "</div>";
			}
			else {
				echo "<div class = \"cell\">&nbsp</div>";
			}
			?>
			<?php 
			if (!$row["Subtype"] == '') {
				echo "<div class = \"cell\">";
				echo $row["Subtype"];
				echo "</div>";
			}
			else {
				echo "<div class = \"cell\">&nbsp</div>";
			}
			?>
			<?php 
			if (!$row["Description"] == '') {
				echo "<div class = \"cell-description\">";
				echo $row["Description"];
				echo "</div>";
			}
			else {
				echo "<div class = \"cell-description\">&nbsp</div>";
			}
			?>
			<div class = "cell"><?php echo $row["Class"]; ?></div>
			<div class = "cell"><?php echo $row["Rarity"]; ?></div>
			<div class = "cell"><?php echo $row["Collection"]; ?></div>
			<?php
				$Cid = $row["Cid"];
				if (isset($Pid) && $Pid != '') {
			?>
				<div class="cell-edit">
					<?php echo "<a href=\"addCardProcessing.php?deckNum=$deckNum&Pid=$Pid&Cid=$Cid&Dclass=$Dclass\">";?>
						<img class="edit" src="css/img/addButton.png"/>
					</a>
				</div>
				
			<?php	
				}
			?>
		</div>
    <?php
       }
    ?>
	</div>

   <?php
      // 4. Release returned result
      mysqli_free_result($result);
   ?>

   <?php
      // 5. Close the database connection
      mysqli_close($dbconnection);
   ?>
   </body>
</html>