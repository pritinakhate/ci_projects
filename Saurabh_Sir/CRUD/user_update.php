<?php
require_once("includes/config.php");
// To fetch all cities from table with id
$getallcities = mysqli_query($conn, "SELECT id,cityname FROM cities WHERE status='Active' ORDER BY cityname");
// To fetch all states from table with id
$getallstates = mysqli_query($conn, "SELECT id,statename FROM states WHERE status='Active' ORDER BY statename");
// To fetch all countires from table with id
$getallcountries = mysqli_query($conn, "SELECT id,countryname FROM countries WHERE status='Active' ORDER BY countryname");
// To fetch all countires from table with id
$getalllocation = mysqli_query($conn, "SELECT id,location,pincode FROM locations WHERE status='Active' ORDER BY location");
//print_r($getallstates);exit();
//Get All Active Hobbies from table
$getallhobbies =mysqli_query($conn,"select id,title from hobbies where status='Active' order by title");
if(isset($_POST['update']))
{
	// To call external php file for validation
	require_once("includes/validations.php");
	// call function for validations which is created into validations.php file
	$errors = validateupdate_form();
	if(empty($errors))
	{
		  $checkemail = mysqli_fetch_assoc(mysqli_query($conn,"SELECT  id FROM users where email='".$_POST['email']."' and tokenid!='".base64_decode($_GET['id'])."'"));
		//print_r($checkemail);exit();
		$checkadhar_no = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM users where adhar_no='".$_POST['adhar_no']."' and tokenid!='".base64_decode($_GET['id'])."'"));
		$checkpan_no = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM users where pan_no='".$_POST['pan_no']."' and tokenid!='".base64_decode($_GET['id'])."'"));
		if(!empty($checkemail) || !empty($checkadhar_no ) || (!empty($checkpan_no) && !empty($_POST['pan_no'])))
		{
			 if(!empty($checkemail))
			{
				 $errors['email']='Email already exist';
			}
			if(!empty($checkadhar_no))
			{
				 $errors['adhar_no']='Adhar no already exist';
			}
			if(!empty($checkpan_no) && !empty($_POST['pan_no']))
			{
				 $errors['pan_no']='Pan no already exist';
			}
		}
		else
		{ 
			$checkphoto = mysqli_fetch_assoc(mysqli_query($conn,"select photo from users where tokenid='".base64_decode($_GET['id'])."'"));
			$checkadharphoto = mysqli_fetch_assoc(mysqli_query($conn,"select adhar_photo from users where tokenid='".base64_decode($_GET['id'])."'"));
			$checkpanphoto = mysqli_fetch_assoc(mysqli_query($conn,"select pancard from users where tokenid='".base64_decode($_GET['id'])."'"));
			//print_r($checkallphoto);exit();
		if($_FILES['photo']['error']==0)
		{
			$attachment = time().$_FILES['photo']['name'];
			$src = $_FILES['photo']['tmp_name'];
			$dest = "uploads/photo/".$attachment;
			if(move_uploaded_file($src,$dest))
			{
				$_POST['photo'] = $attachment;
			}
			else
			{
				echo "Unable to delete photo";
				exit();
			}
		}
		else
		{
			$_POST['photo']=$checkphoto['photo'];
		}			
		if($_FILES['adhar_photo']['error']==0)
		{
			$adharattachment = time().$_FILES['adhar_photo']['name'];
			$src = $_FILES['adhar_photo']['tmp_name'];
			$dest = "uploads/adhar_photo/".$adharattachment;
			if(move_uploaded_file($src,$dest))
			{
				$_POST['adhar_photo'] = $adharattachment;
			}
			else
			{
				echo "Unable to delete adharphoto";
				exit();
			}
		}
		else
		{
			$_POST['adhar_photo']=$checkadharphoto['adhar_photo'];
		}
		if($_FILES['pancard']['error']==0)
		{
			$panattachment = time().$_FILES['pancard']['name'];
			$src = $_FILES['pancard']['tmp_name'];
			$dest = "uploads/pancard/".$panattachment;
			if(move_uploaded_file($src,$dest))
			{
				$_POST['pancard'] = $panattachment;
			}
		   else
			{
				echo "Unable to delete panphoto";
				exit();
			}
		}
		else
		{
			$_POST['pancard']=$checkpanphoto['pancard'];
		}
				
				$updatetuser = "UPDATE  users set 
				
				name='".ucwords($_POST['name'])."', 
				email='".strtolower($_POST['email'])."',
				address='".$_POST['address']."',
				dob='".date('y-m-d',strtotime($_POST['dob']))."',
				gender='".$_POST['gender']."',
				hobby_id='".implode(", ",$_POST['hobby_id'])."',
				city_id='".$_POST['city_id']."',
				state_id='".$_POST['state_id']."',
				country_id='".$_POST['country_id']."',
				location_id='".$_POST['location_id']."',
				photo='".$_POST['photo']."',
				adhar_no='".$_POST['adhar_no']."', 
				adhar_photo='".$_POST['adhar_photo']."',
				pan_no='".$_POST['pan_no']."', 
				pancard='".$_POST['pancard']."',
				modified=now() where tokenid='".base64_decode($_GET['id'])."'";
		  if(mysqli_query($conn,$updatetuser))
		  {
			  if(($_FILES['photo']['error']==0 && !empty($checkphoto['photo'])) || $_FILES['adhar_photo']['error']==0 ||($_FILES['pancard']['error']==0 && !empty($checkpanphoto['pancard'])))
			  {
				 if($_FILES['photo']['error']==0 && !empty($checkphoto['photo']))
				 {
					unlink("uploads/photo/".$checkphoto['photo']);
				 }	
				 if($_FILES['adhar_photo']['error']==0)
				 {
					unlink("uploads/adhar_photo/".$checkadharphoto['adhar_photo']);
				 }	
				 if($_FILES['pancard']['error']==0 && !empty($checkpanphoto['pancard']))
				 {
					unlink("uploads/pancard/".$checkpanphoto['pancard']);
				 }	
			  }
		     $massage = "User has been updated successfully";
		  }
		 else
		  {
		   $error =	 "Unable to update please try again";
		  }
		}		
	}
	
	
}
 $_POST = mysqli_fetch_assoc(mysqli_query($conn,"select * from users where tokenid='".base64_decode($_GET['id'])."'"));
	$_POST['hobby_id']=explode(',',$_POST['hobby_id']);
   if(empty($_POST))
   {
	   header("location:country_manage.php");
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
			<h3 class="text-center">Update User</h3>
			</div>
			<br/>
			<div class="text-center">
			<?php if(isset($massage) && ($massage == "User has been updated successfully")) { ?>
			<span class="alert alert-success"><?php echo $massage; ?></span>
			<?php } if(isset($error) && ($error ==	"Unable to update please try again")) { ?>
			<span class="alert alert-danger"><?php echo $error; ?></span>
			<?php } ?></div>
			<form  role="form" method="post"  enctype="multipart/form-data">
			<div class="panel-body">
				<div class="row">
				<div class="col-md-7">
					<div class="form-group">
						<label class="control-label">Name</label> <span class="text text-danger"> * <?php echo(isset($errors['name']))?$errors['name']:'';?></span>
						<input type="text" class="form-control" name="name" placeholder="Enter your Name"  autocomplete="off" value="<?php echo(isset($_POST['name']))?$_POST['name']:'';?>">
					</div>
					<div class="form-group">
						<label class="control-label">Email</label><span class="text-danger">* <?php echo(isset($errors['email']))?$errors['email']:'';?></span>
						<input type="text" class="form-control" name="email" placeholder="Enter your Email Address" autocomplete="off" value="<?php echo(isset($_POST['email']))?$_POST['email']:''; ?>"/>
					</div>
					
					<div class="form-group">
						<label class="control-label">DOB</label> 
						<input type="text" class="form-control" id="dobpicker" name="dob" placeholder="Select  your Date Of Birth" autocomplete="off" readonly="true" value="<?php echo(isset($_POST['dob']))?$_POST['dob']:''; ?>" />
					</div>
					<div class="form-group">
						<label class="control-label">Address</label> <span class="text text-danger"> * <?php echo(isset($errors['address']))?$errors['address']:'';?></span>
						<textarea class="form-control" name="address" placeholder="Enter your Address"><?php echo(isset($_POST['address']))?$_POST['address']:'';?></textarea>	
					</div>
					<div class="form-group">
						<label class=" control-label">Photo</label> 
						<input type="file" class="form-control" name="photo" >
						<img src="uploads/photo/<?php echo $_POST['photo'];?>" alt="<?= $_POST['name'];?>" width="50px"/>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label class="control-label">Gender</label> <span class="text text-danger"> * <?php echo(isset($errors['gender']))?$errors['gender']:'';?></span>
							<br/>
							<label class="radio-inline">
							  <input type="radio" name="gender" value="male" <?php echo(isset($_POST['gender']) && $_POST['gender']=="male")?'checked':''; ?>> Male
							</label>
							<label class="radio-inline">
							  <input type="radio" name="gender" value="female" <?php echo(isset($_POST['gender']) && $_POST['gender']=="female")?'checked':''; ?>> Female
							</label>
					</div>
					<div class="form-group">
						<label for="name" class="control-label">Hobbies</label> <span class="text text-danger"> * <?php echo(isset($errors['hobby_id']))?$errors['hobby_id']:'';?> </span> 
							<br/>
							<?php  $i=0; 
							while($hobbyrow = mysqli_fetch_array($getallhobbies)){?>
							<label class="checkbox-inline">
							  <input type="checkbox" id="inlineCheckbox1" name="hobby_id[]" value="<?php echo $hobbyrow['id'];?>" <?php echo (isset($_POST['hobby_id']) && in_array($hobbyrow['id'],$_POST['hobby_id']))?'checked':'';?> /><?php echo $hobbyrow['title'];?>
							</label>
							<?php $i++; if ($i%3==0)
							{
								echo '<br/>';
							}
								} ?>
					</div>
					
					
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
						  <select class="form-control js-example-basic-single"  name="state_id">
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
						<label for="name" class="control-label">Loation</label> <span class="text text-danger"> * <?php echo(isset($errors['location_id']))?$errors['location_id']:'';?></span>
						  <select class="form-control js-example-basic-single" name="location_id">
							 <option value="0" <?php echo(isset($_POST['location_id']) && $_POST['location_id']==0)?'selected':'';?>>-- Select Location--</option>
							<?php while($cityrow = mysqli_fetch_array($getalllocation)){?>	
							<option value="<?php echo $cityrow['id']; ?>" <?php echo(isset($_POST['location_id']) && $_POST['location_id']==$cityrow['id'])?'selected':'';?>><?php echo $cityrow['location']." - ".$cityrow['pincode']; ?></option>
							<?php } ?>
						  </select>
					</div>
				
				</div>
					<div class="col-md-7">
					
					<div class="form-group">
						<label class="control-label">Adhar No.</label> <span class="text text-danger">  <?php echo(isset($errors['adhar_no']))?$errors['adhar_no']:'';?></span>
						<input type="text" class="form-control" name="adhar_no" placeholder="Enter your adhar_no"  autocomplete="off" value="<?php echo(isset($_POST['adhar_no']))?$_POST['adhar_no']:'';?>">
						
					</div>
					</div>
					
					<div class="col-md-5">
					
						<div class="form-group">
							<label class=" control-label">Aadhar Photo</label> <span class="text text-danger"> * <?php echo(isset($errors['adhar_photo']))?$errors['adhar_photo']:'';?></span>
								<input type="file" class="form-control" name="adhar_photo" >
								<img src="uploads/adhar_photo/<?= $_POST['adhar_photo']; ?>" alt="<?= $_POST['name']; ?>" width="50px"/>
						</div>
					</div>
					<div class="col-md-7">
					<div class="form-group">
						<label class="control-label">Pan No.</label> <span class="text text-danger">  <?php echo(isset($errors['pan_no']))?$errors['pan_no']:'';?></span>
						<input type="text" class="form-control" name="pan_no" placeholder="Enter your pan_no"  autocomplete="off" value="<?php echo(isset($_POST['pan_no']))?$_POST['pan_no']:'';?>">
					</div>
					</div>
					<div class="col-md-5">

						<div class="form-group">
							<label class=" control-label">Pancard</label> <span class="text text-danger">  <?php echo(isset($errors['pancard']))?$errors['pancard']:'';?></span>
								<input type="file" class="form-control" name="pancard" >
								<img src="uploads/pancard/<?= $_POST['pancard']; ?>" alt="<?= $_POST['name']; ?>" width="50px"/>
						</div>
						
					</div>
              </div>
				</div>
					<div class="panel-footer">
						<div class="form-group">
							<button type="submit" class=" btn btn-success" name="update">Update</button>
							<button type="button" class=" btn btn-danger" name="back" onclick="window.location='user_manage.php'">Cancel</button>
						</div>
					</div>
			</form>
		</div>
		
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery-ui.js"></script>
		<script src="assets/js/select2.min.js"></script>
		<script type="text/javascript">
			  $("document").ready( function() {
				  // Select 2 
				  $('.js-example-basic-single').select2();
				  // Data picker
				 
				$( "#dobpicker" ).datepicker({
				  showButtonPanel: true,
				  changeMonth: true,
                  changeYear: true
				});
			  });
        </script>
	</body>
</html>