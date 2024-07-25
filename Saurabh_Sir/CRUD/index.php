<?php
require_once("includes/config.php");

// Fetch all records from users table
$getallusers = mysqli_query($conn, "SELECT users.id, users.name, users.gender, users.city_id, users.address, users.photo, cities.cityname FROM users left join cities on users.city_id=cities.id order by users.name");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Manage Users</title>
		<?php require_once("includes/head.php"); ?>
	</head>
	<body>
		<div class="container">
		
		<?php require_once("includes/navigation.php"); ?>
		</div>
	</body>
</html>	
