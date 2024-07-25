<?php
require_once("includes/config.php");
// To fetch all cities from table with id
$getallcities = mysqli_query($conn, "SELECT id,cityname FROM cities WHERE status='Active' ORDER BY cityname");
// To fetch all states from table with id
$getallstates = mysqli_query($conn, "SELECT id,statename FROM states WHERE status='Active' ORDER BY statename");
// To fetch all countires from table with id
$getallcountries = mysqli_query($conn, "SELECT id,countryname FROM countries WHERE status='Active' ORDER BY countryname");
//print_r($getallstates);exit();
if(!isset($_GET['id']) && empty($_GET['id']))
{
	header("location:location_manage.php");
}
else
{
if(isset($_POST['update']))
{
	// To call external php file for validation
	require_once("includes/validations.php");
	// call function for validations which is created into validations.php file
	$errors = locationupdatevalidate_form();
	if(empty($errors))
	{
		$checklocationname = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM locations where location='".$_POST['location']."' and tokenid!='".base64_decode($_GET['id'])."'"));
		
		if(!empty($checklocationname))
		{
			 $errors['location']='location already exist';
		}
		else
		{
		$updatelocations = "UPDATE  locations set 
		location='".$_POST['location']."', 
		pincode='".$_POST['pincode']."',
		latitude='".$_POST['latitude']."',
		logitude='".$_POST['logitude']."',
		status='".$_POST['status']."',
		city_id='".$_POST['city_id']."',
		state_id='".$_POST['state_id']."',
		country_id='".$_POST['country_id']."',
		
		modified=now() where tokenid='".base64_decode($_GET['id'])."'";
		if(mysqli_query($conn,$updatelocations))
		{
			
		  $massage = "Location has been updated successfully";
		}
		else
		{
		  $error =	 "Unable to updated please try again";
		}
		}
	}		
	}
	$_POST = mysqli_fetch_assoc(mysqli_query($conn,"select * from locations where tokenid='".base64_decode($_GET['id'])."'"));
   if(empty($_POST))
   {
	   header("location:location_manage.php");
   }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Update-Manage Users</title>
		<?php require_once("includes/head.php"); ?>
	</head>
	<body>
		<div class="container">
				<?php require_once("includes/navigation.php"); ?>
			<div class="panel panel-default">
			
			<div class="panel-heading">
			<h3 class="text-center">Update Location</h3>
			</div>
			<br/>
			<div class="text-center">
			<?php if(isset($massage) && ($massage == "Location has been updated successfully")) { ?>
			<span class="alert alert-success"><?php echo $massage; ?></span>
			<?php } if(isset($error) && ($error ==	"Unable to updated please try again")) { ?>
			<span class="alert alert-danger"><?php echo $error; ?></span>
			<?php } ?></div>
			<form  role="form" method="post"  enctype="multipart/form-data">
			<div class="panel-body">
				<div class="row">
				<div class="col-md-7">
					<div class="form-group">
						<label class="control-label">Location</label> <span class="text text-danger"> * <?php echo(isset($errors['location']))?$errors['location']:'';?></span>
						<input type="text" class="form-control" name="location" placeholder="Enter your location"  autocomplete="off" value="<?php echo(isset($_POST['location']))?$_POST['location']:'';?>">
					</div>
					<div class="form-group">
						<label class="control-label">Pincode</label><span class="text text-danger">* <?php echo(isset($errors['pincode']))?$errors['pincode']:'';?></span>
						<input type="text" class="form-control" name="pincode" placeholder="Enter your  pincode" autocomplete="off" value="<?php echo(isset($_POST['pincode']))?$_POST['pincode']:''; ?>"/>
					</div>
					<div class="form-group">
						<label class="control-label">Latitude</label><span class="text-danger">* <?php echo(isset($errors['latitude']))?$errors['latitude']:'';?></span>
						<input type="text" class="form-control" name="latitude" placeholder="Enter your  latitude" autocomplete="off" value="<?php echo(isset($_POST['latitude']))?$_POST['latitude']:''; ?>"/>
					</div>
					<div class="form-group">
						<label class="control-label">Logitude</label><span class="text-danger">* <?php echo(isset($errors['logitude']))?$errors['logitude']:'';?></span>
						<input type="text" class="form-control" name="logitude" placeholder="Enter your  logitude" autocomplete="off" value="<?php echo(isset($_POST['logitude']))?$_POST['logitude']:''; ?>"/>
					</div>
					
					
					
				</div>
				
					
					<div class="col-md-5">
					<div class="form-group">
						<label for="name" class="control-label">Country</label> <span class="text text-danger"> * <?php echo(isset($errors['country_id']))?$errors['country_id']:'';?></span>
						  <select class="form-control js-example-basic-single" name="country_id">
							 <option value="0" <?php echo(isset($_POST['country_id']) && $_POST['country_id']==0)?'selected':'';?>>-- Select Country--</option>
							<?php while($countryrow = mysqli_fetch_array($getallcountries)){?>	
							<option value="<?php echo $countryrow['id']; ?>" <?php echo(isset($_POST['country_id']) && $_POST['country_id']==$countryrow['id'])?'selected':'';?>><?php echo $countryrow['countryname']; ?></option>
							<?php } ?>
						  </select>
					</div>
					<div class="form-group">
						<label for="name" class="control-label">State</label> <span class="text text-danger"> * <?php echo(isset($errors['state_id']))?$errors['state_id']:'';?></span>
						  <select class="form-control js-example-basic-single" name="state_id">
							 <option value="0" <?php echo(isset($_POST['state_id']) && $_POST['state_id']==0)?'selected':'';?>>-- Select State--</option>
							<?php while($staterow = mysqli_fetch_array($getallstates)){?>	
							<option value="<?php echo $staterow['id']; ?>" <?php echo(isset($_POST['state_id']) && $_POST['state_id']==$staterow['id'])?'selected':'';?>><?php echo $staterow['statename']; ?></option>
							<?php } ?>
						  </select>
					</div>
					<div class="form-group">
						<label for="name" class="control-label">City</label> <span class="text text-danger"> * <?php echo(isset($errors['city_id']))?$errors['city_id']:'';?></span>
						  <select class="form-control js-example-basic-single" name="city_id">
							 <option value="0" <?php echo(isset($_POST['city_id']) && $_POST['city_id']==0)?'selected':'';?>>-- Select City--</option>
							<?php while($cityrow = mysqli_fetch_array($getallcities)){?>	
							<option value="<?php echo $cityrow['id']; ?>" <?php echo(isset($_POST['city_id']) && $_POST['city_id']==$cityrow['id'])?'selected':'';?>><?php echo $cityrow['cityname']; ?></option>
							<?php } ?>
						  </select>
					</div>
					<div class="form-group">
						<label class="control-label">Status</label> <span class="text text-danger"> * <?php echo(isset($errors['status']))?$errors['status']:'';?></span>
							<br/>
							<label class="radio-inline">
							  <input type="radio" name="status" value="Active" <?php echo(isset($_POST['status']) && $_POST['status']=="Active")?'checked':''; ?>> Active
							</label>
							<label class="radio-inline">
							  <input type="radio" name="status" value="Block" <?php echo(isset($_POST['status']) && $_POST['status']=="Block")?'checked':''; ?>> Block
							</label>
					</div>
				
				</div>
					
					
					
              </div>
				</div>
					<div class="panel-footer">
						<div class="form-group">
							<button type="submit" class=" btn btn-success" name="update">Update</button>
							<button type="button" class=" btn btn-danger" name="back" onclick="window.location='location_manage.php'">Cancel</button>
						</div>
					</div>
			</form>
		</div>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/select2.min.js"></script>
		<script type="text/javascript">
			  $("document").ready( function() {
				  // Select 2 
				  $('.js-example-basic-single').select2();
			  });
        </script>
	</body>
</html>