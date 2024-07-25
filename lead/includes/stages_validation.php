<?php
error_reporting(0);

function stages_validation()
{
    $error = array();


    if (empty($_POST['name'])) {
        $error['name'] = "Please enter sources Name";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST['name'])) {
        $error['name'] = "Only letters and white space allowed";
    }
    if (empty($_POST['description1'])) {
        $error['description1'] = "please enter Description";

    }

    if (empty($_POST['status'])) {
        $error['status'] = "Please select status";
    }

    

    return $error;


}





?>