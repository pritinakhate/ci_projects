<?php
require_once("includes/config.php");
if(isset($_POST['deleteall']))
{
	//print_r($_POST); exit();
	//Get all user selected token id
	$tokenids = $_POST['selector'];
	if(empty($tokenids))
	{
		header("location:location_manage.php");
	}
	else
	{
	for($i=0; $i<count($tokenids); $i++)
	{
		 $del=0;
	     $nondel=0;
		//to fetch id of location against token id 
	$getlocationdata = mysqli_fetch_assoc(mysqli_query($conn,"select id from locations where tokenid='".base64_decode($tokenids[$i])."'"));
		
		//to check whether location id is associated with users or not
		$checklocationuserid = mysqli_fetch_assoc(mysqli_query($conn,"select id from users where location_id='".$getlocationdata['id']."'"));
		
		//print_r($getcitydata);
		//print_r($checkcityid);
		//exit();
		
		//if associated with id with users
		if(!empty($checklocationuserid))
		{
			$nondel++;
			//echo"This location already mapped";
		}
		else
		{
			$del++;
			mysqli_query($conn,"delete from locations where id='".$getlocationdata['id']."'");
			header("location:location_manage.php");
		}
	}
		$massage = $del."Record has been deleted and ".$nondel."Unable to delete record";
	}
}
// Fetch all records from location table
$getallocations = mysqli_query($conn, "SELECT locations.id,locations.tokenid, locations.location,locations.pincode,locations.latitude,locations.logitude,locations.status, cities.cityname, countries.countryname,states.statename FROM locations inner join countries on countries.id=locations.country_id inner join states on states.id=locations.state_id inner join cities on cities.id=locations.city_id order by locations.location");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Manage Locations</title>
<?php require_once("includes/head.php"); ?>
<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="container">
		<?php require_once("includes/navigation.php"); ?>
		<div class="panel panel-primary">
		 <div class="panel-heading">
					<h3 class="panel-title">Location List</h3>
				</div>	
				<br/>
				<div class="text text-center">
				<?php if(isset($massage) && !empty($massage)) { ?>
				 <span class= "alert alert-danger" >
					<?= $massage ?>
				 </span>
				<?php } ?>
			</div>
					<div class="panel-body">
					<div class="text-right buttonalign">
					<button type="button" class=" btn btn-primary 	"  onclick="window.location='location_create.php'">Create Location</button>
					</div>
				</div>
				<div class="panel-body">
				<form method="post" onsubmit="return confirm('Do you really want to remove this record?');">
					<table id="locationdatalist" class="table table-bordered table-striped">
						<thead>
							<tr>
								<td><input type="checkbox" name="checkall" onclick="check();"/></td>
								<td>Location</td>
								<td>Country Name</td>
								<td>State Name</td>
								<td>City Name</td>
								<td>Pincode</td>
								<td>Latitude</td>
								<td>Logitude</td>
								<td>Status</td>
								<td>Action</td>
								
							</tr>
						</thead>
						<tbody>
							<?php while($rows = mysqli_fetch_array($getallocations)){?>
							<tr>
								<td><input type="checkbox" name="selector[]" value="<?= base64_encode($rows['tokenid']);?>"/></td>
								<td><?= $rows['location'];?></td>
								<td><?= empty($rows['countryname'])?'--NA--':$rows['countryname'];?></td>
								<td><?= empty($rows['statename'])?'--NA--':$rows['statename'];?></td>
								<td><?= empty($rows['cityname'])?'--NA--':$rows['cityname'];?></td>
								<td><?= $rows['pincode'];?></td>
								<td><?= $rows['latitude'];?></td>
								<td><?= $rows['logitude'];?></td>
								<td><button  class="label label-<?= ($rows['status']=="Active")?'success':'danger'?>"><?= $rows['status'];?></button></td>
								
								<td>
								<a href="location_update.php?id=<?= base64_encode($rows['tokenid']); ?>" class="glyphicon glyphicon-pencil btn"></a>
									<a href="location_delete.php?id=<?= base64_encode($rows['tokenid']); ?>" class="glyphicon glyphicon-trash btn" onclick="return confirm('Do you really want to remove this record?')"></a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
						<tr>
								<td colspan="10"><button type="submit" name="deleteall" class="btn btn-danger btn-xs">Delete</button></td>
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
    $('#locationdatalist').DataTable();
    } );
		</script>
		<script src="assets/js/main.js"></script>
	</body>
</html>	
