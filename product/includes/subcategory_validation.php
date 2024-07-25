<?php 

function subcategory_validation(){
    $error = array();

    if(empty($_POST['name'])){
        $error['name'] = "Please enter category name";
    } elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST['name'])){
        $error['name'] ="Only letters and white space allowed";
}

if(empty($_POST['description'])){
    $error['description'] = "Please enter category description";
}
if(empty($_POST['product_category']))
	{
		$error['product_category'] = "Please Select your category";
	}  
if(empty($_POST['status'])){
    $error['status'] = "Please select status of category";
}
return $error;
}




?>