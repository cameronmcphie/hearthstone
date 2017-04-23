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
   $query = "SELECT Pid FROM PLAYER WHERE Uname = '$username' and Pword = '$password'";
   $result = mysqli_query($dbconnection, $query);
   if (!$result) {
         die("Database query failed.");
      }
   $count = mysqli_num_rows($result);
   $row = mysqli_fetch_assoc($result);
   $userPid = $row["Pid"];

   if($count == 1)
   {
      header("location: playerProfile.php?Pid=$userPid");
   }
   else
   {
      header("location: index.php?attempt=failed");
   }
   mysqli_free_result($result);
   mysqli_close($dbconnection);
?>
