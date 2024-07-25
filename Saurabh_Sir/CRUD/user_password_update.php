<?php
require_once("includes/config.php");
if(isset($_POST['update']))
{
	// To call external php file for validation
	require_once("includes/validations.php");
	// call function for validations which is created into validations.php file
	$errors = validatepasswordupdate_form();
	if(empty($errors))
	{
		$password = md5($_POST['password']);
		$confirmpassword = md5($_POST['confirmpassword']);
		if($password == $confirmpassword)
		{
			$updatetpassword = "UPDATE  users set 
			password='".md5($_POST['password'])."',
			modified=now() where tokenid='".base64_decode($_GET['id'])."'";
			if(mysqli_query($conn,$updatetpassword))
			{
				$massage = "User Password has been updated successfully";
			}
			else
			{
			   $error =	 "Unable to update user password please try again";
			}
		}
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
			<h3 class="text-center">Update Password</h3>
			</div>
			<br/>
			<div class="text-center">
			<?php if(isset($massage) && ($massage == "User Password has been updated successfully")) { ?>
			<span class="alert alert-success"><?php echo $massage; ?></span>
			<?php } if(isset($error) && ($error ==	"Unable to update user password please try again")) { ?>
			<span class="alert alert-danger"><?php echo $error; ?></span>
			<?php } ?></div>
			<form  role="form" method="post"  enctype="multipart/form-data">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-7">
							<div class="form-group">
								<label class="control-label">New Password</label> <span class="text text-danger"> * <?php echo(isset($errors['password']))?$errors['password']:'';?></span>
								<input type="password" class="form-control" name="password">
							</div>
							<div class="form-group">
								<label class="control-label">Confirm Password</label> <span class="text text-danger"> * <?php echo(isset($errors['confirmpassword']))?$errors['confirmpassword']:'';?></span>
								<input type="password" class="form-control" name="confirmpassword">
							</div>
						</div>
						<div class="panel-footer">
							<div class=" col-md-7">
								<div class="form-group">
									<button type="submit" class=" btn btn-success" name="update">Update</button>
									<button type="button" class=" btn btn-danger" name="back" onclick="window.location='user_manage.php'">Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
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