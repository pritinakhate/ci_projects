<?php
require_once("includes/config.php");
if(isset($_POST['deleteall']))
{
	//print_r($_POST); exit();
	//Get all user selected token id
	$tokenids = $_POST['selector'];
	if(empty($tokenids))
	{
		header("location:state_manage.php");
	}
	else
	{
	 $del=0;
	 $nondel=0;	
	
	for($i=0; $i<count($tokenids); $i++)
	{
		//to fetch id of city against token id 
	$getstatedata = mysqli_fetch_assoc(mysqli_query($conn,"select id from states where tokenid='".base64_decode($tokenids[$i])."'"));
		
		//to check whether state is associated with users or not
		$checkstateid = mysqli_fetch_assoc(mysqli_query($conn,"select id from users where state_id='".$getstatedata['id']."'"));
		//to check whether state is associated with city or not
		$checkcityid = mysqli_fetch_assoc(mysqli_query($conn,"select id from cities where state_id='".$getstatedata['id']."'"));
		//to check whether state is associated with location or not
		$checklocationid = mysqli_fetch_assoc(mysqli_query($conn,"select id from locations where state_id='".$getstatedata['id']."'"));
		
		
		//if associated with id with users and city and location
		if(!empty($checkstateid) || !empty($checkcityid) || !empty($checklocationid))
		{
			//echo"This states already mapped";
			$nondel++;
		}
		else
		{
			mysqli_query($conn,"delete from states where id='".$getstatedata['id']."'");
			//header("location:state_manage.php");
			$del++;
		}
	}
	$massage = $del."Record has been deleted and ".$nondel."Unable to delete record";
	}
}
// Fetch all records from states table
$getallstates = mysqli_query($conn, "SELECT states.id,states.tokenid, states.statename,states.status, countries.countryname FROM states inner join countries on states.country_id=countries.id order by states.statename");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Manage States</title>
<?php require_once("includes/head.php"); ?>
<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="container">
		<?php require_once("includes/navigation.php"); ?>
		<div class="panel panel-primary">
		 <div class="panel-heading">
					<h3 class="panel-title">States List</h3>
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
					<button type="button" class=" btn btn-primary 	"  onclick="window.location='state_create.php'">Create State</button>
					</div>
				</div>
				<div class="panel-body">
				<form method="post" onsubmit="return confirm('Do you really want to remove this record?');">
					<table id="statedatalist" class="table table-bordered table-striped">
						<thead>
							<tr>
								<td><input type="checkbox" name="checkall" onclick="check();"/></td>
								<td>State Name</td>
								<td>Country Name</td>
								<td>Status</td>
								<td>Action</td>
								
							</tr>
						</thead>
						<tbody>
							<?php while($rows = mysqli_fetch_array($getallstates)){?>
							<tr>
								<td><input type="checkbox" name="selector[]" value="<?= base64_encode($rows['tokenid']);?>"/></td>
								<td><?= $rows['statename'];?></td>
								<td><?= empty($rows['countryname'])?'--NA--':$rows['countryname'];?></td>
								<td><button  class="label label-<?= ($rows['status']=="Active")?'success':'danger'?>"><?= $rows['status'];?></button></td>
								
								<td>
								<a href="state_update.php?id=<?= base64_encode($rows['tokenid']); ?>" class="glyphicon glyphicon-pencil btn"></a>
									<a href="state_delete.php?id=<?= base64_encode($rows['tokenid']); ?>" class="glyphicon glyphicon-trash btn" onclick="return confirm('Do you really want to remove this record?')"></a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
						<tr>
								<td colspan="5"><button type="submit" name="deleteall" class="btn btn-danger btn-xs">Delete</button></td>
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
    $('#statedatalist').DataTable();
    } );
		</script>
		  <script src="assets/js/main.js"></script>
	</body>
</html>	
