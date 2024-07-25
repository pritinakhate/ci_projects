<?php
require_once("includes/config.php");
if(isset($_POST['deleteall']))
{
	//print_r($_POST); exit();
	//Get all user selected token id
	$tokenids = $_POST['selector'];
	if(empty($tokenids))
	{
		header("location:country_manage.php");
	}
	else
	{
		$del=0;
		$nondel=0;
	for($i=0; $i<count($tokenids); $i++)
	{
		//to fetch id of country against token id 
		$getcountrydata = mysqli_fetch_assoc(mysqli_query($conn,"select id from countries where tokenid='".base64_decode($tokenids[$i])."'"));
		
		//to check whether countryid is associated with users or not
		$checkcountryiduser = mysqli_fetch_assoc(mysqli_query($conn,"select id from users where country_id='".$getcountrydata['id']."'"));
		//to check whether countryid is associated with states or not
		$checkcountryidstate = mysqli_fetch_assoc(mysqli_query($conn,"select id from states where country_id='".$getcountrydata['id']."'"));
		//to check whether countryid is associated with city or not
		$checkcountryidcity = mysqli_fetch_assoc(mysqli_query($conn,"select id from cities where country_id='".$getcountrydata['id']."'"));
		//to check whether countryid is associated with locations or not
		$checkcountryidlocation = mysqli_fetch_assoc(mysqli_query($conn,"select id from locations where country_id='".$getcountrydata['id']."'"));
	
		
		
		if(!empty($checkcountryiduser) || !empty($checkcountryidstate) || !empty($checkcountryidcity) || !empty($checkcountryidlocation))
		{
			//echo"This country already mapped";
			$nondel++;
		}
		else
		{
			mysqli_query($conn,"delete from countries where id='".$getcountrydata['id']."'");
			$del++;
			//header("location:country_manage.php");
		}
	 }
	 $massage = $del."Record has been deleted and ".$nondel." Unable to delete record";
	}
}

// Fetch all records from users table
$getallcountries = mysqli_query($conn, "SELECT countries.id,countries.tokenid, countries.countryname,countries.countryflag,countries.countrycode, countries.status from countries");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Manage Countries</title>
<?php require_once("includes/head.php"); ?>
<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="container">
		<?php require_once("includes/navigation.php"); ?>
		<div class="panel panel-primary">
		 <div class="panel-heading">
					<h3 class="panel-title">Countries List</h3>
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
					<button type="button" class=" btn btn-primary 	"  onclick="window.location='country_create.php'">Create Country</button>
					</div>
				</div>
				<div class="panel-body">
				<form method="post" onsubmit="return confirm('Do you really want to remove this record?');">
					<table id="countrydatalist" class="table table-bordered table-striped">
						<thead>
							<tr>
								<td><input type="checkbox" name="checkall" onclick="check();"/></td>
								<td>Country Name</td>
								<td>Country Flag</td>
								<td>Country Code</td>
								<td>Status</td>
								<td>Action</td>
								
							</tr>
						</thead>
						<tbody>
							<?php while($rows = mysqli_fetch_array($getallcountries)){?>
							<tr>
								<td><input type="checkbox" name="selector[]" value="<?= base64_encode($rows['tokenid']);?>"/></td>
								<td><?= $rows['countryname'];?></td>
								<td>
								<?php if($rows['countryflag']!=""){ ?>
								<img src="uploads/countryflag/<?= $rows['countryflag'];?>" alt="countryflag" width="50px">
								<?php }else{ ?>
								No Countryflag Available
								<?php }?>
								</td>
								<td><?= $rows['countrycode'];?></td>
								<td><button  class="label label-<?= ($rows['status']=="Active")?'success':'danger'?>"><?= $rows['status'];?></button></td>
								
								<td>
								<a href="country_update.php?id=<?= base64_encode($rows['tokenid']); ?>" class="glyphicon glyphicon-pencil btn"></a>
									<a href="country_delete.php?id=<?= base64_encode($rows['tokenid']); ?>" class="glyphicon glyphicon-trash btn" onclick="return confirm('Do you really want to remove this record?')"></a>
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
    $('#countrydatalist').DataTable();
    } );
		</script>
		<script src="assets/js/main.js"></script>
	</body>
</html>	
