<?php
// Connection with database Server
$conn = mysqli_connect("localhost","root","") or die("Unable to connect server please contact admin");

// Selection of Database in server
mysqli_select_db($conn,"batch_62_basics") or die("Unable to select Database");

// Setup for timezone 
date_default_timezone_set("asia/kolkata");
?>