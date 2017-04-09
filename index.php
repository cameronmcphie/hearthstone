<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<?php
      // 1. Create a database connection
      $dbhost = "ecsmysql";
      $dbuser = "cs332u21";  // where ?? is your id
      $dbpass = "xahkohth"; // replace with your password
      $dbname = "cs332u21";
      $dbconnection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

      // Check if the connection is ok
      if (mysqli_connect_errno()) {
         die("Database connection failed: " .
         mysqli_connect_error() . " (" > mysqli_connect_errno() . ")" );
      }
   ?>
<?php
      // 2. Perform database query
      $query = "SELECT * ";
      $query .= "FROM DEPARTMENT";
      // echo $query;
      // echo "<br>";
      $result = mysqli_query($dbconnection, $query);
      // Check if there is a query error
      if (!$result) {
         die("Database query failed.");
      }
   ?>
    <ul>
   <?php
      // echo "--- Fetch the data ---";
      // echo "<br>";
      echo "Department name";
      echo "<br>";
      echo "----------------------";
      echo "<br>";
     
      // 3. Use returned result
      while ($row = mysqli_fetch_assoc($result)) {
         // output data from each row
    ?>
         <li><?php echo $row["Dname"]; ?></li>
    <?php
       }
    ?>
  </ul>

   <?php
      // 4. Release returned result
      mysqli_free_result($result);
   ?>

   <?php
      // 5. Close the database connection
      mysqli_close($dbconnection);
   ?>
</html>
