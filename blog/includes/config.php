<?php
// Connection with database Server
$conn = mysqli_connect("localhost","root","1100")or die("unable to connect server please contact admin ");
// Selection of Database in server
mysqli_select_db($conn,"blogs") or die("unable to select database");


 ?>