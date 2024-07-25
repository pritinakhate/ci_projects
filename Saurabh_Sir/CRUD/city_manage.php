<?php
require_once("includes/config.php");
if(isset($_POST['deleteall']))
{
	//print_r($_POST); exit();
	//Get all user selected token id
	$tokenids = $_POST['selector'];
	if(empty($tokenids))
	{
		header("location:city_manage.php");
	}
	else
	{
	  $del=0;
	  $nondel=0;	
	
	for($i=0; $i<count($tokenids); $i++)
	{
		//to fetch id of city against token id 
		$getcitydata = mysqli_fetch_assoc(mysqli_query($conn,"select id from cities where tokenid='".base64_decode($tokenids[$i])."'"));

		//to check whether cityid is associated with locations or not
		$checkcitylocationid = mysqli_fetch_assoc(mysqli_query($conn,"select id from locations where city_id='".$getcitydata['id']."'"));
			
		//to check whether cityid is associated with users or not
		$checkcityuserid = mysqli_fetch_assoc(mysqli_query($conn,"select id from users where city_id='".$getcitydata['id']."'"));
		/* print_r($getcitydata);
		print_r($checkcitylocationid);
		print_r($checkcityuserid);
		exit(); */
		
		//if associated with id with users
		if(!empty($checkcityuserid) || !empty($checkcitylocationid))
		{
			//echo"This city already mapped";
			$nondel++;
		}
		else
		{
			mysqli_query($conn,"delete from cities where id='".$getcitydata['id']."'");
			$del++;
			//header("location:city_manage.php");
		}
	}
	$massage = $del."Record has been deleted and ".$nondel."Unable to delete record";
  }	
}
// Fetch all records from cities table
$getallcities = mysqli_query($conn, "SELECT cities.id,cities.tokenid, cities.cityname,cities.status, countries.countryname,states.statename FROM cities inner join countries on cities.country_id=countries.id inner join states on cities.state_id=states.id order by cities.cityname");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Manage Cities</title>
<?php require_once("includes/head.php"); ?>
<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="container">
		<?php require_once("includes/navigation.php"); ?>
		<div class="panel panel-primary">
		 <div class="panel-heading">
					<h3 class="panel-title">Cities List</h3>
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
					<button type="button" class=" btn btn-primary 	"  onclick="window.location='city_create.php'">Create City</button>
					</div>
				</div>
				<div class="panel-body">
				<form method="post" onsubmit="return confirm('Do you really want to remove this record?');">
					<table id="citydatalist" class="table table-bordered table-striped">
						<thead>
							<tr>
								<td><input type="checkbox" name="checkall" onclick="check();"/></td>
								<td>City Name</td>
								<td>State Name</td>
								<td>Country Name</td>
								<td>Status</td>
								<td>Action</td>
								
							</tr>
						</thead>
						<tbody>
							<?php while($rows = mysqli_fetch_array($getallcities)){?>
							<tr>
								<td><input type="checkbox" name="selector[]" value="<?= base64_encode($rows['tokenid']);?>"/></td>
								<td><?= $rows['cityname'];?></td>
								<td><?= empty($rows['statename'])?'--NA--':$rows['statename'];?></td>
								<td><?= empty($rows['countryname'])?'--NA--':$rows['countryname'];?></td>
								<td><button  class="label label-<?= ($rows['status']=="Active")?'success':'danger'?>"><?= $rows['status'];?></button></td>
								
								<td>
								<a href="city_update.php?id=<?= base64_encode($rows['tokenid']); ?>" class="glyphicon glyphicon-pencil btn"></a>
									<a href="city_delete.php?id=<?= base64_encode($rows['tokenid']); ?>" class="glyphicon glyphicon-trash btn" onclick="return confirm('Do you really want to remove this record?')"></a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
						<tr>
								<td colspan="6"><button type="submit" name="deleteall" class="btn btn-danger btn-xs">Delete</button></td>
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
    $('#citydatalist').DataTable();
    } );
		</script>
		<script src="assets/js/main.js"></script>

	</body>
</html>	
