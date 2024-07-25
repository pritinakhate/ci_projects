<?php 
require_once("includes/config.php");
if(!isset($_GET['id']) || empty($_GET['id'])){
	header("location:user_manage.php");
}else{
	$getuserdata = mysqli_fetch_assoc(mysqli_query($conn,"SELECT  users. *,countries.countryname,states.statename,locations.location,locations.pincode,hobbies.title, cities.cityname from users left join countries on users.country_id=countries.id left join states on users.state_id=states.id left join cities on users.city_id=cities.id left join hobbies on users.hobby_id=hobbies.id left join locations on users.location_id=locations.id where users.tokenid='".base64_decode($_GET['id'])."'"));
	if(!isset($getuserdata['id']) || empty($getuserdata['id']))
	{
		header("location:user_manage.php");
	}
}?>
<!DOCTYPE html>
<html>
	<head>
		<title>CRUD</title>
		<meta name="charset" content="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
		<link href="assets/css/style.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="container">
			<h1>Users Details</h1>
			<table class="table table-bordered table-striped">
				<tr>
					<td>Name : </td>
					<td><?= $getuserdata['name'];?> </td>
				</tr>
				<tr>
					<td>Adrress : </td>
					<td><?= $getuserdata['address'];?> </td>
				</tr>
				<tr>
					<td>Gender : </td>
					<td><?= $getuserdata['gender'];?> </td>
				</tr>
				<tr>
					<td>Country : </td>
					<td><?= $getuserdata['countryname'];?> </td>
				</tr>
				<tr>
					<td>State : </td>
					<td><?= $getuserdata['statename'];?> </td>
				</tr>
				<tr>
					<td>City : </td>
					<td><?= $getuserdata['cityname'];?> </td>
				</tr>
				<tr>
					<td>Location : </td>
					<td><?= $getuserdata['location']." - ".$getuserdata['pincode'];?> </td>
				</tr>
				<tr>
					<td>Hobbies : </td>
					<td>
							<?php 
				$hobbies = explode(", ",$getuserdata['hobby_id']);
				$hobbycnt=count($hobbies);
				for($i=0;$i<$hobbycnt;$i++){
					$hobbytitle = mysqli_fetch_assoc(mysqli_query($conn,"Select id,title from hobbies where id='".$hobbies[$i]."'"));
					echo $hobbytitle['title'];
					if($i<$hobbycnt-1)
					{
						echo ", ";
					}
				} 
				?>
					</td>
				</tr>
				<tr>
					<td>Photo : </td>
					<td><img width="50px" src="uploads/photo/<?php echo $getuserdata['photo'];?>" alt="Photo"/> </td>
				</tr>
				<tr>
					<td>Aadhar Photo : </td>
					<td><img width="50px" src="uploads/adhar_photo/<?php echo $getuserdata['adhar_photo'];?>" alt="adhar_photo"/> </td>
				</tr>
				<tr>
					<td>Pan Photo : </td>
					<td><img width="50px" src="uploads/pancard/<?php echo $getuserdata['pancard'];?>" alt="pancard"/> </td>
				</tr>
			</table>
			<button type="button" class=" btn btn-danger" name="cancelbutton" onclick="window.location='user_manage.php'">Cancel</button>
		</div>
	</body>
</html>