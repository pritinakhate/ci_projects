<?php 
require_once("includes/config.php");
if(!isset($_GET['id']) || empty($_GET['id']))
{
	//check id not available
	header("location:country_manage.php");
}
else
{
	//to fetch id of country against token id 
	$getcountrydata = mysqli_fetch_assoc(mysqli_query($conn,"select id from countries where tokenid='".base64_decode($_GET['id'])."'"));
		
		//to check whether countryid is associated with users or not
		$checkcountryiduser = mysqli_fetch_assoc(mysqli_query($conn,"select id from users where country_id='".$getcountrydata['id']."'"));
		//to check whether countryid is associated with states or not
		$checkcountryidstate = mysqli_fetch_assoc(mysqli_query($conn,"select id from states where country_id='".$getcountrydata['id']."'"));
		//to check whether countryid is associated with city or not
		$checkcountryidcity = mysqli_fetch_assoc(mysqli_query($conn,"select id from cities where country_id='".$getcountrydata['id']."'"));
		//to check whether countryid is associated with locations or not
		$checkcountryidlocation = mysqli_fetch_assoc(mysqli_query($conn,"select id from locations where country_id='".$getcountrydata['id']."'"));
	
		
		
		if(!empty($checkcountryiduser) || !empty($checkcountryidstate) || !empty($checkcountryidcity) || !empty($checkcountryidlocation))
		{
			echo"This Country already mapped";
		}
		else
		{
			mysqli_query($conn,"delete from countries where id='".$getcountrydata['id']."'");
			header("location:country_manage.php");
		}
		
}
?>