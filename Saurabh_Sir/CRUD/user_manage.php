<?php
require_once("includes/config.php");
//For multidelete functionality
if(isset($_POST['deleteall']))
{
	//print_r($_POST); exit();
	//Get all users selected token Id
	$tokenids = $_POST['selector'];
	if(empty($tokenids))
	{
		header("location:user_manage.php");
	}
	else
	{
		$del=0;
		$nondel=0;
	for($i=0; $i<count($tokenids); $i++)
	{
		//Get id against Tokenid
		// fetch photo against id
	$getuserdata = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id,photo,adhar_photo,pancard FROM users where tokenid='".base64_decode($tokenids[$i])."'"));
	if(!isset($getuserdata['id']) || empty($getuserdata['id']))
	{
		// after fetching no record found then reditect to list page
		header("location:user_manage.php");
		$nondel=0;
	}
	else
	{
		//remove data from table 
		mysqli_query($conn,"DELETE FROM users where id='".$getuserdata['id']."'");
		//remove attachments from folder
		unlink("uploads/photo/".$getuserdata['photo']);
		unlink("uploads/adhar_photo/".$getuserdata['adhar_photo']);
		unlink("uploads/pancard/".$getuserdata['pancard']);
		$del++;
		header("location:user_manage.php");
	}
	}
	$massage = $del."Record has been deleted <br/>".$nondel."Unable to delete record<br/>";
}
}
// Fetch all records from users table
$getallusers = mysqli_query($conn, "SELECT users.id,users.tokenid, users.name, users.gender, users.city_id,users.state_id,users.country_id, users.address, users.photo, cities.cityname,countries.countryname,states.statename FROM users left join cities on users.city_id=cities.id left join countries on users.country_id=countries.id left join states on users.state_id=states.id  order by users.name");
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Manage User</title>
		<?php require_once("includes/head.php"); ?>
		<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
		<link href="assets/css/font-awesome.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="container">
		<?php require_once("includes/navigation.php"); ?>
		<div class="panel panel-primary">
		 <div class="panel-heading">
					<h3 class="panel-title">Users List</h3>
				</div>	
				<br/>
			
					<div class="panel-body">
					<div class="text-right buttonalign">
					<button type="button" class=" btn btn-primary 	"  onclick="window.location='user_create.php'">Create User</button>
					</div>
				</div>
				<div class="panel-body">
				<form method="post" onsubmit="return confirm('Do you really want to remove this record?');">
					<table id="usersdatalist" class="table table-bordered table-striped">
						<thead>
							<tr>
								<td><input type="checkbox" name="checkall" onclick="check();"/></td>
								<td>Name</td>
								<td>Gender</td>
								<td>Address</td>
								<td>Country</td>
								<td>State</td>
								<td>City</td>
								<td>Photo</td>
								<td>Actions</td>
							</tr>
						</thead>
						<tbody>
							<?php while($rows = mysqli_fetch_array($getallusers)){?>
							<tr>
								<td><input type="checkbox" name="selector[]" value="<?= base64_encode($rows['tokenid']);?>"/></td>
								<td><?= $rows['name'];?></td>
								<td><?= $rows['gender'];?></td>
								<td><?= $rows['address'];?></td>
								<td><?= empty($rows['countryname'])?'--NA--':$rows['countryname'];?></td>
								<td><?= empty($rows['statename'])?'--NA--':$rows['statename'];?></td>
								<td><?= empty($rows['cityname'])?'--NA--':$rows['cityname'];?></td>
								<td>
									<?php if($rows['photo']!=""){?>
									<img src="uploads/photo/<?= $rows['photo'];?>" alt="Photo" width="50px"/>
									<?php }else {?>
										No Photo Available
									<?php } ?>
								</td>
								<td>
									<a href="user_view.php?id=<?= base64_encode($rows['tokenid']); ?>" class="glyphicon glyphicon-eye-open"></a>
									<a href="user_update.php?id=<?= base64_encode($rows['tokenid']); ?>" class="glyphicon glyphicon-pencil btn"></a>
									<a href="user_password_update.php?id=<?= base64_encode($rows['tokenid']); ?>"><i class="fa fa-key"></i></a>
									<a href="user_delete.php?id=<?= base64_encode($rows['tokenid']); ?>" class="glyphicon glyphicon-trash btn" onclick="return confirm('Do you really want to remove this record?')"></a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
						<tr>
								<td colspan="9"><button type="submit" name="deleteall" class="btn btn-danger btn-xs">Delete</button></td>
							</tr>
					</table>
					</form>
				</div>
				<div class="panel-footer"></div>
			</div>
		</div>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/dataTables.bootstrap.min.js"></script>
		<script>
			$(document).ready(function() {
    $('#usersdatalist').DataTable();
    } );
		</script>
		<script src="assets/js/main.js"></script>
	</body>
</html>	
