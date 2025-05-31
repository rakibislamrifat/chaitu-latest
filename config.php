<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chaituupdate";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  echo "";
  
  // Select the database
  if (!mysqli_select_db($conn, $dbname)) {
      die("Error selecting database: " . mysqli_error($conn));
  }

?>