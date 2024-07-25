<?php 
require_once("includes/config.php");
if(!isset($_GET['id']) || empty($_GET['id']))
{
	//check id not available
	header("location:city_manage.php");
}
else
{
	//to fetch id of city against token id 
	$getcitydata = mysqli_fetch_assoc(mysqli_query($conn,"select id from cities where tokenid='".base64_decode($_GET['id'])."'"));
	
	//to check whether cityid is associated with location or not
	$checkcitylocationid = mysqli_fetch_assoc(mysqli_query($conn,"select id from locations where city_id='".$getcitydata['id']."'"));
		
	//to check whether cityid is associated with users or not
	$checkcityuserid = mysqli_fetch_assoc(mysqli_query($conn,"select id from users where city_id='".$getcitydata['id']."'"));
	/* print_r($getcitydata);
	print_r($checkcitylocationid);
	print_r($checkcityuserid);
	exit(); */
	
	//if associated with id with users
	if(!empty($checkcityuserid) || !empty($checkcitylocationid))
	{
		echo"This city already mapped";
	}
	else
	{
		mysqli_query($conn,"delete from cities where id='".$getcitydata['id']."'");
		header("location:city_manage.php");
	}
		
}
?>