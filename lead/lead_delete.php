<?php
include_once("includes/config.php");
$conn = mysqli_connect("localhost","root","1100","lead");
$getid = $_GET['id'];
$delete_leads = mysqli_query($conn, "DELETE FROM leads WHERE id = '$getid'");

if($delete_leads){
    echo "delete succesfully";
    header('location:lead_manage.php');
}else{
    die(mysqli_error($conn));
}


?>;