<?php
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