<?php 
require_once("includes/config.php");
if(!isset($_GET['id']) || empty($_GET['id'])){
	// check if "id" not available
	header("location:index.php");
}else{
	// fetch photo against id
	$getuserdata = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id,photo FROM users where tokenid='".base64_decode($_GET['id'])."'"));
	if(!isset($getuserdata['id']) || empty($getuserdata['id']))
	{
		// after fetching no record found then reditect to list page
		header("location:user_manage.php");
	}
	else
	{
		//remove data from table 
		mysqli_query($conn,"DELETE FROM users where id='".$getuserdata['id']."'");
		//remove attachments from folder
		unlink("uploads/photo/".$getuserdata['photo']);
		header("location:user_manage.php");
	}
}?>