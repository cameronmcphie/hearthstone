<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/table.css">
	<link rel="stylesheet" type="text/css" href="css/topBar.css">
	<title>All Cards</title>
</head>
   
<body>
   <div class = "topBar">
		<img class = "logo" src = "css/img/logo.png">
		<div class = "menuBar">
			<a href="index.php">
				<img class = "back" src = "css/img/backArrow.png">
			</a>
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
      // 1. Create a database connectio
      $dbhost = "localhost";
      $dbuser = "test";  
      $dbpass = "Eagles79!"; 
      $dbname = "hearthstone";
      $dbconnection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
      // Check if the connection is ok
      if (mysqli_connect_errno()) {
         die("Database connection failed: " .
         mysqli_connect_error() . " (" > mysqli_connect_errno() . ")" );
      }
      // 2. Perform database query
      $query = "SELECT * ";
      $query .= "FROM CARDS";
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

