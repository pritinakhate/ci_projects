<?php
error_reporting(0);

function lead_validation()
{
    $error = array();


    if (empty($_POST['name'])) {
        $error['name'] = "Please enter Your Name";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST['name'])) {
        $error['name'] = "Only letters and white space allowed";
    }
    if (empty(trim($_POST['email']))) {
        $error['email'] = "Please Enter Your Email Address";
    } elseif (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/", $_POST['email'])) {
        $error['email'] = "enter valid email id";
    }

    if (empty($_POST['phone'])) {
        $error['phone'] = "Please enter mobile";
    } elseif (!preg_match("/^[6-9][0-9]{9}$/", $_POST['phone'])) {
        $error['phone'] = "Only number are allowed";
    }

    if (empty($_POST['lead_sources'])) {
        $error['lead_sources'] = "Please select lead source";
    }

    if (empty($_POST['lead_stages'])) {
        $error['lead_stages'] = "Please select lead stages";

    }

    return $error;


}





?>