<?php 
	require_once("includes/config.php");
	if(!isset($_GET['id']) || empty($_GET['id']))
	{
		//check if "id" not available
		header("location:hobby_manage.php");
	}
	else
	{
		// fetch the ID
		$getid = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM hobbies where tokenid='".base64_decode($_GET['id'])."'"));
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
			//display massage if data of hobbies master table mapped with users or transaction table.
			echo "Hobby is already mapped";
				//header("location:hobby_manage.php");
		}
		else
		{
			//remove data from master table if master table hobbies not mapped with transation table or users table
				mysqli_query($conn,"DELETE FROM hobbies WHERE id='".$getid['id']."'");
					header("location:hobby_manage.php");
		}
	}
?>