<?php 
require_once("includes/config.php");

if(isset($_POST['update']))
{
	// To call external php file for validation
	require_once("includes/validations.php");
	
	//call for  validations  which is created into validation.php file
	$errors = countryupdatevalidate_form();
	//print_r($errors);exit();
	if(empty($errors))
	{
		
			
			$checkcountryname = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM countries where countryname='".$_POST['countryname']."' and tokenid!='".base64_decode($_GET['id'])."'"));
			//print_r($checkcountryname['id']);exit();
			if(!empty($checkcountryname))
			{
				$errors['countryname']= 'country already exist';
			}
			else
			{
				
				$checkcountryflag = mysqli_fetch_assoc(mysqli_query($conn,"select id, countryflag from countries where tokenid='".base64_decode($_GET['id'])."'"));
				//print_r($checkcountryflag);exit();
				if($_FILES['countryflag']['error']==0)
		         {
					$attachment = time().$_FILES['countryflag']['name'];
					$src = $_FILES['countryflag']['tmp_name'];
					$dest = "uploads/countryflag/".$attachment;
					if(move_uploaded_file($src, $dest))
					{
						$_POST['countryflag']=$attachment;
					}
					else
					{
						echo "Unable to delete countryflag";
						exit();
					}
			     }
				 else
				 {
					 $_POST['countryflag']=$checkcountryflag['countryflag'];
				 }
				$updatecountry = "UPDATE  countries set 
				countryname='".ucwords($_POST['countryname'])."',
				countryflag='".$_POST['countryflag']."',
				countrycode='".$_POST['countrycode']."',
				status='".$_POST['status']."',
				modified=now() where tokenid='".base64_decode($_GET['id'])."'";
				if(mysqli_query($conn,$updatecountry))
				{
					if($_FILES['countryflag']['error']==0)
					 {
						unlink("uploads/countryflag/".$checkcountryflag['countryflag']);
					 }	
					$massage= "Country has been updated successfully";
				}
				else
				{
					$error= "Unable to updated please try again";
				}
			}
	 }
	

	
 }
	 $_POST = mysqli_fetch_assoc(mysqli_query($conn,"select * from countries where tokenid='".base64_decode($_GET['id'])."'"));
	//print_r($_POST);exit();
   if(empty($_POST))
   {
	   header("location:country_manage.php");
   }
	


?>
<!DOCTYPE html>
<html>
<head>
	<title>Update-Manage Country</title>
	<?php require_once("includes/head.php"); ?>
</head>
<body>
	<div class="container">
		<?php require_once("includes/navigation.php"); ?>
		<div class="panel panel-default">
			<form role="form" method="post" enctype="multipart/form-data">
		   <div class="panel-heading">
			  <h3 class="text-center">Update Country</h3>
		   </div>
		   <div class="text-center">
			
			<?php if(isset($massage) && ($massage == "Country has been updated successfully")) { ?>
			<span class="alert alert-success"><?php echo $massage; ?></span>
			<?php } if(isset($error) && ($error ==	"Unable to updated please try again")) { ?>
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
				<img src="uploads/countryflag/<?php echo $_POST['countryflag'];?>" alt="<?php echo $_POST['countryname'];?>" width="50px"/>
				
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
					<input type="radio" name="status" value="Block" <?php echo(isset($_POST['status'])&& $_POST['status']=="Block")?'checked':''; ?>/>Block
				</label>
					
				
			  </div>
		   </div>
		</div>
		   <div class="panel-footer">
                <div class="form-group">
				<button type="submit" class=" btn btn-success" name="update">Update</button>
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