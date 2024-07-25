<?php
require_once("includes/config.php");



if(isset($_POST['save']))
{
	// To call external php file for validation
	require_once("includes/validations.php");

	// call function for validations which is created into validations.php file
	$errors = hobbyvalidate_form();
	if(empty($errors))
	{
		$checkhobbytitle = mysqli_fetch_assoc(mysqli_query($conn,"SELECT title FROM hobbies where title='".$_POST['title']."'"));
		if(!empty($checkhobbytitle))
		{
			 $errors['title']='hobby already exist';
		}
		else
		{
		$inserthobby = "INSERT INTO hobbies set 
		tokenid='".md5("hobbies_".date('y-m-d-h-i-s').rand(100000,999999))."',
		title='".ucwords($_POST['title'])."', 
		
		status='".$_POST['status']."',
		
		created='".date("Y-m-d h:i:s")."'";
		if(mysqli_query($conn,$inserthobby))
		{
		$massage = "Hobby has been created successfully";
		}
		else
		{
		$error =	 "Unable to create please try again";
		}
		}		
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Create- Manage Hobby</title>
<?php require_once("includes/head.php"); ?>
	</head>
	<body>
		<div class="container">
				<?php require_once("includes/navigation.php"); ?>
						
		

			<div class="panel panel-default">
			
			<div class="panel-heading">
		
			<h3 class="text-center">Create Hobby</h3>
			</div>
			<br/>
				<div class="text-center">
			<?php if(isset($massage) && ($massage == "Hobby has been created successfully")) { ?>
			<span class="alert alert-success"><?php echo $massage; ?></span>
			<?php } if(isset($error) && ($error ==	"Unable to create please try again")) { ?>
			<span class="alert alert-danger"><?php echo $error; ?></span>
			<?php } ?></div>
			<form  role="form" method="post">
			<div class ="panel-body">
				
				<div class=" col-lg-6 col-md-6 col-sm-6">
		
					<div class="form-group">
						<label class="control-label">Hobby Name</label> <span class="text text-danger"> * <?php echo(isset($errors['title']))?$errors['title']:'';?></span>
						<input type="text" class="form-control" name="title" placeholder="Enter your Hobby"  autocomplete="off" value="<?php echo(isset($_POST['title']))?$_POST['title']:'';?>">
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
							<button type="submit" class=" btn btn-success" name="save">Create</button>
							<button type="button" class=" btn btn-danger" name="back" onclick="window.location='hobby_manage.php'">Cancel</button>
						</div>
					
				</div>
			</form>
		</div>
		
		</div>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
	</body>
</html>