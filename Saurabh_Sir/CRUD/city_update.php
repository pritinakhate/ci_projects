<?php
require_once("includes/config.php");
// To fetch all countries from table with id
$getallcountries = mysqli_query($conn, "SELECT id,countryname FROM countries WHERE status='Active' ORDER BY countryname");
//print_r($getallcountries);exit();
// To fetch all states from table with id
$getallstates = mysqli_query($conn, "SELECT id,statename FROM states WHERE status='Active' ORDER BY statename");
//print_r($getallstates);exit();

if(!isset($_GET['id']) && empty($_GET['id']))
{
	header("location:city_manage.php");
}
else
{
if(isset($_POST['update']))
{
	// To call external php file for validation
	require_once("includes/validations.php");

	// call function for validations which is created into validations.php file
	$errors = cityupdatevalidate_form();
	if(empty($errors))
	{
		$checkcityname = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM cities where cityname='".$_POST['cityname']."' and country_id='".$_POST['country_id']."' and state_id='".$_POST['state_id']."' and tokenid!='".base64_decode($_GET['id'])."'"));
		
		if(!empty($checkcityname))
		{
			 $errors['cityname']='city already exist';
		}
		else
		{
			//update city record
		$updatecity = "UPDATE  cities set 
		
		cityname='".ucwords($_POST['cityname'])."',
        country_id='".$_POST['country_id']."',
        state_id='".ucwords($_POST['state_id'])."',		
		
		status='".$_POST['status']."',
		
		modified=now() where tokenid='".base64_decode($_GET['id'])."'";
		if(mysqli_query($conn,$updatecity))
		{
		$massage = "City has been updated successfully";
		}
		else
		{
		$error =	 "Unable to create please try again";
		}
		}		
	}
}
   $_POST = mysqli_fetch_assoc(mysqli_query($conn,"select * from cities where tokenid='".base64_decode($_GET['id'])."'"));
   if(empty($_POST))
   {
	   header("location:city_manage.php");
   }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Update-Manage City</title>
<?php require_once("includes/head.php"); ?>
	</head>
	<body>
		<div class="container">
				<?php require_once("includes/navigation.php"); ?>
			<div class="panel panel-default">
			<div class="panel-heading">
			<h3 class="text-center">Update City</h3>
			</div>
			<br/>
			<br/>
			<div class="text-center">
			
			<?php if(isset($massage) && ($massage == "City has been updated successfully")) { ?>
			<span class="alert alert-success"><?php echo $massage; ?></span>
			<?php } if(isset($error) && ($error ==	"Unable to create please try again")) { ?>
			<span class="alert alert-danger"><?php echo $error; ?></span>
			<?php } ?>
			<br/>
			<br/>
			</div>
			
			<form  role="form" method="post">
			<div class ="panel-body">
				
				<div class=" col-lg-6 col-md-6 col-sm-6">
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
						<label for="name" class="control-label">States</label> <span class="text text-danger"> * <?php echo(isset($errors['state_id']))?$errors['state_id']:'';?></span>
						  <select class="form-control js-example-basic-single" name="state_id">
							 <option value="0" <?php echo(isset($_POST['state_id']) && $_POST['state_id']==0)?'selected':'';?>>-- Select State--</option>
							<?php while($staterow = mysqli_fetch_array($getallstates)){?>	
							<option value="<?php echo $staterow['id']; ?>" <?php echo(isset($_POST['state_id']) && $_POST['state_id']==$staterow['id'])?'selected':'';?>><?php echo $staterow['statename']; ?></option>
							<?php } ?>
						  </select>
					</div>
					<div class="form-group">
						<label class="control-label">City Name</label> <span class="text text-danger"> * <?php echo(isset($errors['cityname']))?$errors['cityname']:'';?></span>
						<input type="text" class="form-control" name="cityname" placeholder="Enter  City Name"  autocomplete="off" value="<?php echo(isset($_POST['cityname']))?$_POST['cityname']:'';?>">
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
				
				
					<div class="panel-footer">
						
						<div class="form-group">
							<button type="submit" class=" btn btn-success" name="update">Update</button>
							<button type="button" class=" btn btn-danger" name="cancelbutton" onclick="window.location='city_manage.php'">Cancel</button>
						</div>
					</div>
				
			</form>
			
		
		</div>
		
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