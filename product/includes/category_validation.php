<?php 
error_reporting(E_ALL);
function category_validation(){
    $error = array();

    if(empty($_POST['name'])){
        $error['name'] = "Please enter category name";
    } elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST['name'])){
        $error['name'] ="Only letters and white space allowed";
}

if(empty(trim($_POST['description']))){
    $error['description'] = "Please enter category description";
}
if(empty($_POST['status'])){
    $error['status'] = "Please select status of category";
}
return $error;
}



?>