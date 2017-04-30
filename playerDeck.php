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
		$query = "SELECT * FROM CARDS RIGHT JOIN IN_DECK ON CARDS.Cid = IN_DECK.CID WHERE IN_DECK.Pid = $Pid AND IN_DECK.Dnum = $deckNum";
		$result = mysqli_query($dbconnection, $query);
		$row = mysqli_fetch_assoc($result);
   ?>
<body>
   <div class = "topBar">
		<img class = "logo" src = "css/img/logo.png">
		<div class = "menuBar">
			<?php
				echo "<a class=\"w3-btn w3-ripple w3-red left-button\" href=\"playerProfile.php?Pid=$Pid\">Back to Decks</a>";
			?>
			<?php
				// Check if deck is full
				if (mysqli_num_rows($result) >= 30) {
							echo "<div class=\"w3-btn w3-ripple w3-red right-button\">Deck is Full</div>";
				}
				// For handling if all cards are deleted from a deck
				else if ($row == 0 && !isset($_GET["Dclass"])) {
					echo "<a class=\"w3-btn w3-ripple w3-green right-button\" href=\"createDeck.php?deckNum=$deckNum&Pid=$Pid&deck=exists\">Add Cards</a>";
				}
				else {
					// Deck is empty need to get the class
					if (isset($_GET["Dclass"])) {
						echo "<a class=\"w3-btn w3-ripple w3-green right-button\" href=\"allCards.php?deckNum=$deckNum&Pid=$Pid&Dclass=$Dclass\">Add Cards</a>";
					}
					else {
						// If deck deck is full
						if (mysqli_num_rows($result) >= 30) {
							echo "<div class=\"w3-btn w3-ripple w3-red right-button\">Deck is Full</div>";
						}
						else {
						$row = mysqli_fetch_assoc($result);
						$Dclass = $row["Dclass"];
						echo "<a class=\"w3-btn w3-ripple w3-green right-button\" href=\"allCards.php?deckNum=$deckNum&Pid=$Pid&Dclass=$Dclass\">Add Cards</a>";
						}
					}
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
		$query = "SELECT * FROM CARDS RIGHT JOIN IN_DECK ON CARDS.Cid = IN_DECK.CID WHERE IN_DECK.Pid = $Pid AND IN_DECK.Dnum = $deckNum";
		$result = mysqli_query($dbconnection, $query);
      	// 3. Use returned result
      	while($row = mysqli_fetch_assoc($result)) {
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
      // Release returned result
      mysqli_free_result($result);
      // Close the database connection
      mysqli_close($dbconnection);
   ?>
   </body>
</html>

