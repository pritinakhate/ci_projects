<?php 
require_once("includes/config.php");
if(isset($_POST['save']))
{
	// To call external php file for validation
	require_once("includes/validations.php");

	//call for  validations  which is created into validation.php file
	$errors = countryvalidate_form();
	if(empty($errors))
	{
		if($_FILES['countryflag']['error']==0)
			{
				$attachment = time().$_FILES['countryflag']['name'];
				$src = $_FILES['countryflag']['tmp_name'];
				$dest = "uploads/countryflag/".$attachment;
				if(move_uploaded_file($src, $dest))
					{
						$_POST['countryflag']=$attachment;
					}
			}
		$checkcountryname= mysqli_fetch_assoc(mysqli_query($conn,"SELECT countryname FROM countries where countryname='".$_POST['countryname']."'"));
		$checkcountrycode= mysqli_fetch_assoc(mysqli_query($conn,"SELECT countrycode FROM countries where countrycode='".$_POST['countrycode']."'"));
		if(!empty($checkcountryname) || !empty($checkcountrycode))
		{
			if(!empty($checkcountryname))
			{
			    $errors['countryname']= 'country already exist';
			}
			if(!empty($checkcountrycode))
			{
				$errors['countrycode']= 'countrycode already exist';
			}
		}
		else
		{
			
			$insertcountry = "INSERT INTO countries set 
			tokenid='".md5("countries_".date('y-m-d-h-i-s').rand(100000,999999))."',
			countryname='".ucwords($_POST['countryname'])."',
			countryflag='".$_POST['countryflag']."',
			countrycode='".$_POST['countrycode']."',
			status='".$_POST['status']."',
			created='".date("y-m-d h:i:s")."'";
			if(mysqli_query($conn,$insertcountry))
			{	
				$massage= "Country has been created successfully";
			}	
			else
			{
				$error= "Unable to create please try again";
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create-Manage Country</title>
	<?php require_once("includes/head.php"); ?>
</head>
<body>
	<div class="container">
		<?php require_once("includes/navigation.php"); ?>
		<div class="panel panel-default">
			<form role="form" method="post" enctype="multipart/form-data">
		   <div class="panel-heading">
			  <h3 class="text-center">Create Country</h3>
		   </div>
		   <div class="text-center">
			
			<?php if(isset($massage) && ($massage == "Country has been created successfully")) { ?>
			<span class="alert alert-success"><?php echo $massage; ?></span>
			<?php } if(isset($error) && ($error ==	"Unable to create please try again")) { ?>
			<span class="alert alert-danger"><?php echo $error; ?></span>
			<?php } ?>
			<br/>
			<br/>
			</div>
		   <div class="panel-body">
			<div class=" col-lg-6 col-md-6 col-sm-6">	
			  
			  <div class="form-group">
				<label class="control-label">Country Name : </label><span class="text text-danger">*<?php echo(isset($errors['countryname']))?$errors['countryname']:''; ?></span>
				
					<input type="text" class="form-control" name="countryname" value="<?php echo(isset($_POST['countryname']))?$_POST['countryname']:''; ?>" />
				
			  </div>
			  <div class="form-group">
				<label class="control-label">Countryflag : </label><span class="text text-danger">*<?php echo(isset($errors['countryflag']))?$errors['countryflag']:''; ?></span>
				<input type="file" class="form-control" name="countryflag" />
			  </div>
			   <div class="form-group">
				<label class="control-label">Country Code : </label><span class="text text-danger">*<?php echo(isset($errors['countrycode']))?$errors['countrycode']:''; ?></span>
				
					<input type="text" class="form-control" name="countrycode" value="<?php echo(isset($_POST['countrycode']))?$_POST['countrycode']:''; ?>" />
				
			  </div>
			   <div class="form-group">
				<label class="control-label">Status : </label><span class="text text-danger">*<?php echo(isset($errors['status']))? $errors['status']:'';?></span>
				<br>
				<label class="radio-inline">
					<input type="radio" name="status" value="Active" <?php echo(isset($_POST['status']) && $_POST['status']=="Active")?'checked':''; ?>/>Active
				</label>
				<label class="radio-inline">
					<input type="radio" name="status" value="Block" <?php echo(isset($_POST['status'])&& $_POST['status']=="Block") ?>/>Block
				</label>
					
				
			  </div>
		   </div>
		</div>
		   <div class="panel-footer">
                <div class="form-group">
				<button type="submit" class=" btn btn-success" name="save">Create</button>
				<button type="button" class=" btn btn-danger" name="cancelbutton" onclick="window.location='country_manage.php'">Cancel</button>
				</div>
		   </div>
		</form>
		</div>

	</div>
	<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>