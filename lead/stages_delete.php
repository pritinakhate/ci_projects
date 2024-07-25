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
$checkstages = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM lead_stages WHERE id = '$getid'"));

//to check id of category against id
    
$checklead= mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM leads WHERE stage_id = '".$checkstages['id']."'"));


if(!empty($checklead) && !empty($checkstages)){
    echo "This stage is mapped with lead";
}else{
    $delete = mysqli_query($conn,"DELETE FROM lead_stages WHERE id = '".$checkstages['id']."'");
    
    if($delete){
        echo "Stage has been deleted successfull";
    }
}
}
?>

<body>

    <div class="container w-50 mt-5 text-center">
        <a class="btn btn-primary btn-lg p-3  " href="stages_manage.php">Go To Manage</a>
    </div>
</body>