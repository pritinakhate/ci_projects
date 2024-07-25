<?php 
require_once("includes/config.php");
if(!isset($_GET['id']) || empty($_GET['id']))
{
	//check id not available
	header("location:location_manage.php");
}
else
{
	//to fetch id of location against token id 
	$getlocationdata = mysqli_fetch_assoc(mysqli_query($conn,"select id from locations where tokenid='".base64_decode($_GET['id'])."'"));
	
	
		
	//to check whether locationid is associated with users or not
	$checklocationuserid = mysqli_fetch_assoc(mysqli_query($conn,"select id from users where location_id='".$getlocationdata['id']."'"));
	
/* 	print_r($getlocationdata);
	print_r($checklocationuserid);
	exit(); */ 
	
	//if associated with id with users
	if(!empty($checklocationuserid) )
	{
		echo"This locations already mapped";
	}
	else
	{
		mysqli_query($conn,"delete from locations where id='".$getlocationdata['id']."'");
		header("location:location_manage.php");
	}
		
}
?>