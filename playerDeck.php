<!DOCTYPE html>
<html>
<?php parse_str($_SERVER['QUERY_STRING']); ?>
<head>
	<link rel="stylesheet" type="text/css" href="css/table.css">
	<link rel="stylesheet" type="text/css" href="css/topBar.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<?php echo "<title>Deck $deckNum</title>" ?>
</head>

<?php
   include("config.php");
		$dbhost = dbhost;
		$dbuser = dbuser;  
		$dbpass = dbpass; 
		$dbname = dbname;
		$dbconnection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
   ?>
<body>
   <div class = "topBar">
		<img class = "logo" src = "css/img/logo.png">
		<div class = "menuBar">
			<?php
				echo "<a class=\"w3-btn w3-ripple w3-red left-button\" href=\"playerProfile.php?Pid=$Pid\">Back to Decks</a>";
			?>
			<?php
				if (isset($Dclass)) {
					echo "<a class=\"w3-btn w3-ripple w3-green right-button\" href=\"allCards.php?deckNum=$deckNum&Pid=$Pid&Dclass=$Dclass\">Add Cards</a>";
				}
				else {
					$query = "SELECT Dclass FROM IN_DECK WHERE Pid = $Pid AND Dnum = $deckNum";
					$result = mysqli_query($dbconnection, $query);
					if (!$result) {
					 die("Database query failed.");
					}
					$row = mysqli_fetch_assoc($result);
					$Dclass = $row["Dclass"];
					echo "<a class=\"w3-btn w3-ripple w3-green right-button\" href=\"allCards.php?deckNum=$deckNum&Pid=$Pid&Dclass=$Dclass\">Add Cards</a>";
				}
			?>
			</div>
	    	<?php echo "<div class = \"title\">Deck $deckNum</div>"; ?>
	    	
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
			<div class = "cellRemove">&nbsp</div>
		</div>

	
	<?php
		$query = "SELECT * FROM CARDS WHERE Cid IN (Select Cid FROM IN_DECK WHERE Dnum = $deckNum AND Pid = $Pid);";
		$result = mysqli_query($dbconnection, $query);
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
			$cidString = $row["Cid"];
			echo "<a href=\"removeCard.php?Cid=$cidString&Pid=$Pid&deckNum=$deckNum\">"; 
			?>
				<div class="cell-edit"><img class="edit" src="css/img/removeButton.png"/></div>
			</a>
		</div>
    <?php
       }
    ?>
    <?php
		$query = "SELECT Cid FROM IN_DECK WHERE Dnum = $deckNum AND Pid = $Pid AND NumInDeck = 2";
		$result = mysqli_query($dbconnection, $query);
			// Check if there is a query error
		if (!$result) {
		 die("Database query failed.");
		}
		if (mysqli_num_rows($result) > 0)
		{	
			$query = "SELECT * FROM CARDS WHERE Cid IN (Select Cid FROM IN_DECK WHERE Dnum = $deckNum AND Pid = $Pid AND NumInDeck = 2)";
			$result = mysqli_query($dbconnection, $query);
			// Check if there is a query error
			if (!$result) {
			 die("Database query failed.");
			}
			while ($row = mysqli_fetch_assoc($result)) {
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
			$cidString = $row["Cid"];
			echo "<a href=\"removeCard.php?Cid=$cidString&Pid=$Pid&deckNum=$deckNum\">"; 
			?>
				<div class="cell-edit"><img class="edit" src="css/img/removeButton.png"/></div>
			</a>
		</div>

	<?php 
		}
	} 
	?>
	</div>

   <?php
      // Release returned result
      mysqli_free_result($result);
      // Close the database connection
      mysqli_close($dbconnection);
   ?>
   </body>
</html>

