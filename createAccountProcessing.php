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
   if (isset($_POST["submit"])) {
      if (isset($_POST["username"])) {
         $username = $_POST["username"];
      } else {
      $username = "unknown";
      }
      if (isset($_POST["password"])) {
         $password = $_POST["password"];
      } else {
         $password = "unknown";
      }
   header("location: index.php?attempt=failed");
   } else {
   header("location: index.php?attempt=failed");
   }
   $query = "INSERT INTO PLAYER (Uname, Pword, NumOfDecks) Values ('$username', '$password', 0)";
   $result = mysqli_query($dbconnection, $query);
   if (!$result) {
      die("Database query failed.");
      header("location: createAccount.php?attempt=failed");
   }
   else {
      $query = "SELECT Pid FROM PLAYER WHERE Uname = '$username' and Pword = '$password'";
      $result = mysqli_query($dbconnection, $query);
      $row = mysqli_fetch_assoc($result);
      $userPid = $row["Pid"];
      header("location: playerProfile.php?Pid=$userPid");
   }
   mysqli_free_result($result);
   mysqli_close($dbconnection);
?>