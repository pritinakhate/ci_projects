<?php 
require_once("includes/config.php");
if(!isset($_GET['id']) || empty($_GET['id']))
{
	//check id not available
	header("location:state_manage.php");
}
else
{
	//to fetch id of state against token id 
	$getstatedata = mysqli_fetch_assoc(mysqli_query($conn,"select id from states where tokenid='".base64_decode($_GET['id'])."'"));
		
		//to check whether stateid is associated with users or not
		$checkstateid = mysqli_fetch_assoc(mysqli_query($conn,"select id from users where state_id='".$getstatedata['id']."'"));
		//to check whether stateid is associated with cities or not
		$checkcityid = mysqli_fetch_assoc(mysqli_query($conn,"select id from cities where state_id='".$getstatedata['id']."'"));
		//to check whether stateid is associated with locations or not
		$checklocationid = mysqli_fetch_assoc(mysqli_query($conn,"select id from locations where state_id='".$getstatedata['id']."'"));
		/* print_r($getcitydata);
		print_r($checkcityid);
		print_r($checkstateid);
		print_r($checklocationid);
		exit();
		 */
		//if associated with id with users
		if(!empty($checkstateid) || !empty($checkcityid) || !empty($checklocationid))
		{
			echo"This State already mapped";
		}
		else
		{
			mysqli_query($conn,"delete from states where id='".$getstatedata['id']."'");
			header("location:state_manage.php");
		}
		
}
?>