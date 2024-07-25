<?php 
function validate_form()
{
	$error = array();
	$allowtypes = array('image/jpg','image/jpeg','image/png');
	if(empty(trim($_POST['name'])))
	{
		$error['name'] = "Please Enter your name";
	}
	elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['name']))
	{
		$error['name'] = "Please Enter valid name";
	}
	if(empty(trim($_POST['email'])))
	{
		$error['email'] = "Please Enter Your Email Address";
	}
	if(empty(trim($_POST['password'])))
	{
		$error['password'] = "Please Enter your password";
	}
	if(empty(trim($_POST['address'])))
	{
		$error['address'] = "Please Enter your address";
	}
	if(empty($_POST['gender']))
	{
		$error['gender'] = "Please Select your gender";
	}
	if(empty($_POST['hobby_id']))
	{
		$error['hobby_id'] = "Please Select your hobbies";
	}
	if($_POST['country_id']==0)
	{
		$error['country_id'] = "Please Select  country";
	}
	if($_POST['state_id']==0)
	{
		$error['state_id'] = "Please Select  State";
	}
	if($_POST['city_id']==0)
	{
		$error['city_id'] = "Please Select your city";
	}
	if($_POST['location_id']==0)
	{
		$error['location_id'] = "Please Select your location";
	}
	if(empty(trim($_POST['adhar_no'])))
	{
		$error['adhar_no'] = "Please Enter your adharno";
	}
	elseif(!preg_match("/^([2-9]){1}([0-9]){3}\\s([0-9]){4}\\s([0-9]){4}$/",$_POST['adhar_no']))
	{
		$error['adhar_no'] = "Please Enter valid adhar_no Like (xxxx xxxx xxxx)";
	}
	if($_FILES['adhar_photo']['error']==4)
	{
		$error['adhar_photo'] = "Please Select your adhar_photo";
	}
	elseif(!in_array($_FILES['adhar_photo']['type'],$allowtypes))
	{
		$error['adhar_photo'] = "Please Select jpg, jpeg and png type of file";
	}
	if(empty(trim($_POST['pan_no'])) && $_FILES['pancard']['error']==4)
	{
		
	}
	elseif(empty($_POST['pan_no']) && $_FILES['pancard']['error']==0)
	{
		$error['pan_no'] = "Please Enter your pan number";
	}
	elseif(!preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}$/",$_POST['pan_no']))
	{
		$error['pan_no'] = "Please enter valid pan no";
	} 
	elseif(!empty($_POST['pan_no']) && $_FILES['pancard']['error']==4)
	{
		$error['pancard'] = "Please Select your pancard";
	}
	elseif(!in_array($_FILES['pancard']['type'],$allowtypes) &&  $_FILES['pancard']['error']==0)
	{
		$error['pancard'] = "Please Select jpg, jpeg and png type of file";
	}

	return $error;
	
	
	
}
function validateupdate_form()
{
	$error = array();
	 $allowtypes = array('image/jpg','image/jpeg','image/png');
	if(empty(trim($_POST['name'])))
	{
		$error['name'] = "Name should not be empty";
	}
	elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['name']))
	{
		$error['name'] = "Please Enter valid name";
	}
	if(empty(trim($_POST['email'])))
	{
		$error['email'] = " Email Address should not be empty";
	}
	
	if(empty(trim($_POST['address'])))
	{
		$error['address'] = "Address should not be empty";
	}
	
	if(empty($_POST['hobby_id']))
	{
		$error['hobby_id'] = "Please Select your hobbies";
	}
	if($_POST['country_id']==0)
	{
		$error['country_id'] = "country  not selected";
	}
	if($_POST['state_id']==0)
	{
		$error['state_id'] = " State  not selected";
	}
	if($_POST['city_id']==0)
	{
		$error['city_id'] = " city  not selected";
	}
	if($_POST['location_id']==0)
	{
		$error['location_id'] = " location  not selected";
	}
	if(empty(trim($_POST['adhar_no'])))
	{
		$error['adhar_no'] = " Adharno should not be empty";
	}
	elseif(!preg_match("/^([2-9]){1}([0-9]){3}\\s([0-9]){4}\\s([0-9]){4}$/",$_POST['adhar_no']))
	{
		$error['adhar_no'] = "Please Enter valid adhar_no Like (xxxx xxxx xxxx)";
	}
	
	if(empty(trim($_POST['pan_no'])) && $_FILES['pancard']['error']==4)
	{
		
	}
	elseif(empty($_POST['pan_no']) && $_FILES['pancard']['error']==0)
	{
		$error['pan_no'] = "Pan number should not be empty";
	}
	elseif(!preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}$/",$_POST['pan_no']))
	{
		$error['pan_no'] = "Please enter valid pan no";
	}  
	

	return $error;
	
	
	
}

function countryvalidate_form()
{
	$error = array();
	$allowtypes = array('image/jpg','image/jpeg','image/png');
	
	if(empty(trim($_POST['countryname'])))
	{
		$error['countryname'] = "Please Enter  countryname";
	}
	elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['countryname']))
	{
		$error['countryname'] = "Please Enter valid countryname";
	}
		if($_FILES['countryflag']['error']==4)
	{
		$error['countryflag'] = "Please Select countryflag";
	}
	elseif(!in_array($_FILES['countryflag']['type'],$allowtypes))
	{
		$error['countryflag'] = "Please Select jpg, jpeg and png type of file";
	}
	if(empty(trim($_POST['countrycode'])))
	{
		$error['countrycode'] = "Please Enter  countrycode";
	}
	if(empty($_POST['status']))
	{
		$error['status'] = "Please Select your status";
	}
	return $error;
}function countryupdatevalidate_form()
{
	$error = array();
	$allowtypes = array('image/jpg','image/jpeg','image/png');
	
	if(empty(trim($_POST['countryname'])))
	{
		$error['countryname'] = "Countryname should not be empty";
	}
	elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['countryname']))
	{
		$error['countryname'] = "Please Enter valid countryname";
	}
	
	/*  if(!in_array($_FILES['countryflag']['type'],$allowtypes))
	{
		$error['countryflag'] = "Please Select jpg, jpeg and png type of file";
	} 
 */	if(empty(trim($_POST['countrycode'])))
	{
		$error['countrycode'] = "Countrycode should not be empty";
	}
	
	return $error;
}
function statevalidate_form()
{
	$error = array();
	if(empty(trim($_POST['statename'])))
	{
		$error['statename'] = "Please Enter  statename";
	}
	elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['statename']))
	{
		$error['statename'] = "Please Enter valid statename";
	}
	if(empty($_POST['status']))
	{
		$error['status'] = "Please Select your status";
	}
	if($_POST['country_id']==0)
	{
		$error['country_id'] = "Please Select your country";
	}
	
	return $error;
}
function stateupdatevalidate_form()
{
	$error = array();
	if(empty(trim($_POST['statename'])))
	{
		$error['statename'] = "Statename should not be empty";
	}
	elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['statename']))
	{
		$error['statename'] = "Please Enter valid statename";
	}
	
	if($_POST['country_id']==0)
	{
		$error['country_id'] = "Country should not be empty";
	}
	
	return $error;
}

function cityvalidate_form()
{
	$error = array();
	if(empty(trim($_POST['cityname'])))
	{
		$error['cityname'] = "Please Enter  cityname";
	}
	elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['cityname']))
	{
		$error['cityname'] = "Please Enter valid cityname";
	}
	if($_POST['country_id']==0)
	{
		$error['country_id'] = "Please Select  country";
	}
	if($_POST['state_id']==0)
	{
		$error['state_id'] = "Please Select  State";
	}
	if(empty($_POST['status']))
	{
		$error['status'] = "Please Select status";
	}
	return $error;
}
function cityupdatevalidate_form()
{
	$error = array();
	if(empty(trim($_POST['cityname'])))
	{
		$error['cityname'] = "Cityname should not be empty";
	}
	elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['cityname']))
	{
		$error['cityname'] = "Please Enter valid cityname";
	}
	if($_POST['country_id']==0)
	{
		$error['country_id'] = "Country should not be empty";
	}
	if($_POST['state_id']==0)
	{
		$error['state_id'] = "State should not be empty";
	}
	
	return $error;
}
function hobbyvalidate_form()
{
	$error = array();
	if(empty(trim($_POST['title'])))
	{
		$error['title'] = "Please Select your hobbyname";
	}
	elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['title']))
	{
		$error['title'] = "Please Enter valid hobbyname";
	}
	if(empty($_POST['status']))
	{
		$error['status'] = "Please Select your status";
	}
	return $error;
}
function hobbyupdatevalidate_form()
{
	$error = array();
	if(empty(trim($_POST['title'])))
	{
		$error['title'] = "Hobbyname should not be empty";
	}
	elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['title']))
	{
		$error['title'] = "Please Enter valid hobbyname";
	}
	
	return $error;
}
function validatepasswordupdate_form()
{
	$error = array();
	if(empty(trim($_POST['password'])))
	{
		$error['password'] = "password should not be empty";
	}
	if(empty(trim($_POST['confirmpassword'])))
	{
		$error['confirmpassword'] = "Confirm password should not be empty";
	}
	if($_POST['password'] != $_POST['confirmpassword'])
	{
		$error['confirmpassword'] = "Password does not match";
	}
	
	
	return $error;
}
function locationvalidate_form()
{
	$error = array();
	
	
	if(empty(trim($_POST['location'])))
	{
		$error['location'] = "Please Enter  location";
	}
	if(empty(trim($_POST['pincode'])))
	{
		$error['pincode'] = "Please Enter  pincode";
	}
	if(empty(trim($_POST['latitude'])))
	{
		$error['latitude'] = "Please Enter  latitude";
	}
	if(empty($_POST['logitude']))
	{
		$error['logitude'] = "Please Select  logitude";
	}
	
	if($_POST['country_id']==0)
	{
		$error['country_id'] = "Please Select  country";
	}
	if($_POST['state_id']==0)
	{
		$error['state_id'] = "Please Select  State";
	}
	if($_POST['city_id']==0)
	{
		$error['city_id'] = "Please Select your city";
	}
	if(empty($_POST['status']))
	{
		$error['status'] = "Please Select your status";
	}
	
	return $error;
	
	
	
}
function locationupdatevalidate_form()
{
	$error = array();
	
	
	if(empty(trim($_POST['location'])))
	{
		$error['location'] = "Location should not be empty";
	}
	if(empty(trim($_POST['pincode'])))
	{
		$error['pincode'] = "Pincode should not be empty";
	}
	if(empty(trim($_POST['latitude'])))
	{
		$error['latitude'] = "Latitude should not be empty";	}
	if(empty($_POST['logitude']))
	{
		$error['logitude'] = "Logitude should not be empty";
	}
	
	if($_POST['country_id']==0)
	{
		$error['country_id'] = "Country should not be empty";
	}
	if($_POST['state_id']==0)
	{
		$error['state_id'] = "State should not be empty";
	}
	if($_POST['city_id']==0)
	{
		$error['city_id'] = "City should not be empty";
	}
	
	return $error;
	
	
	
}


?>