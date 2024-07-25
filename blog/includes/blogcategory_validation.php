<?php
error_reporting(0);

function category_validation(){
    $error = array();
    

    if(empty($_POST['name'])){
        $error['name'] = "Please enter Your Name";
    } elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST['name'])){
        $error['name'] ="Only letters and white space allowed";
}

if(empty($_POST['description'])){
    $error['description'] = "Please enter Description";
}

if(empty($_POST['status'])){
    $error['status'] = "Please select status";
}

return $error;



}




?>