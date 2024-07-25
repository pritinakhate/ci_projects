<?php
require_once("includes/config.php");
if(isset($_POST['deleteall']))
{
	//print_r($_POST); exit();
	//Get all user selected token id
	$tokenids= $_POST['selector'];
	if(empty($tokenids))
	{
		header("location:hobby_manage.php");
	}
	else
	{
			  $del=0;
	        $nondel=0;
	for($i=0;$i<count($tokenids); $i++)
	{
		// fetch the ID
		$getid = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM hobbies where tokenid='".base64_decode($tokenids[$i])."'"));
		//Check if users table field hobby_id and hobby field id is same
		$gethobbymap = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id,hobby_id FROM users where hobby_id LIKE ('%".$getid['id']."%')"));
		//print_r($gethobbymap);
		//exit();
		if(!isset($getid['id']) || empty($getid['id']))
		{
			//after fetching no record found then redirect to list page
			header("location:hobby_manage.php");
		}
		else if($gethobbymap)
		{
			$nondel++;
			//display massage if data of hobbies master table mapped with users or transaction table.
			//echo "Hobby is already mapped";
				//header("location:hobby_manage.php");
		}
		else
		{
			$del++;
			//remove data from master table if master table hobbies not mapped with transation table or users table
				mysqli_query($conn,"DELETE FROM hobbies WHERE id='".$getid['id']."'");
					header("location:hobby_manage.php");
		}
	}
	$massage = $del."Record has been deleted and ".$nondel."Unable to delete record";
  }

}

// Fetch all records from users table
$getallhobbies = mysqli_query($conn, "SELECT hobbies.id,hobbies.tokenid, hobbies.title, hobbies.status from hobbies");
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Manage Hobby</title>
		<?php require_once("includes/head.php"); ?>
		<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="container">
		<?php require_once("includes/navigation.php"); ?>
		<div class="panel panel-primary">
		 <div class="panel-heading">
					<h3 class="panel-title">Hobbies List</h3>
				</div>	
					<div class="panel-body">
					<div class="text-right buttonalign">
					<button type="button" class=" btn btn-primary 	"  onclick="window.location='hobby_create.php'">Create Hobby</button>
					</div>
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
				<form method="post" onsubmit="return confirm('Do you really want to delete it? ')";>
					<table id="hobbydatalist" class="table table-bordered table-striped">
						<thead>
							<tr>
								<td><input type="checkbox" name="checkall" onclick="check();"/></td>
								<td>Hobby Name</td>
								<td>Status</td>
								<td>Action</td>
								
							</tr>
						</thead>
						<tbody>
							<?php while($rows = mysqli_fetch_array($getallhobbies)){?>
							<tr>
							    <td><input type="checkbox" name="selector[]" value="<?= base64_encode($rows['tokenid']);?>"/></td>
								<td><?= $rows['title'];?></td>
								<td><button  class="label label-<?= ($rows['status']=="Active")?'success':'danger'?>"><?= $rows['status'];?></button></td>
								
								<td>
								<a href="hobby_update.php?id=<?= base64_encode($rows['tokenid']); ?>" class="glyphicon glyphicon-pencil btn"></a>
									<a href="hobby_delete.php?id=<?= base64_encode($rows['tokenid']); ?>" class="glyphicon glyphicon-trash btn" onclick="return confirm('Do you really want to remove this record?')"></a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
						<tr>
								<td colspan="4"><button type="submit" name="deleteall" class="btn btn-danger btn-xs">Delete</button></td>
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
    $('#hobbydatalist').DataTable();
    } );
		</script>
		<script src="assets/js/main.js"></script>
	</body>
</html>	
