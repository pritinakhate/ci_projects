<?php
include_once("includes/config.php");
include_once("includes/header.php");
$conn = mysqli_connect("localhost","root","1100","lead");
$getid = $_GET['id'];
if(!isset($getid) || empty($getid)){
    //check id not available

    header("location:sources_manage.php");
    exit;
}else{
   //to check whether category id is associated with product or not
$checksources = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM lead_sources WHERE id = '$getid'"));

//to check id of category against id
    
$checklead= mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM leads WHERE source_id = '".$checksources['id']."'"));


if(!empty($checklead) && !empty($checksources)){
    echo "This source is mapped with lead";
}else{
    $delete = mysqli_query($conn,"DELETE FROM lead_sources WHERE id = '".$checksources['id']."'");
    
    if($delete){
        echo "Source has been deleted successfull";
    }
}
}
?>

<body>

    <div class="container w-50 mt-5 text-center">
        <a class="btn btn-primary btn-lg p-3  " href="sources_manage.php">Go To Manage</a>
    </div>
</body>