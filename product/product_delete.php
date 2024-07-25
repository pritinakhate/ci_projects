<?php
include_once("includes/config.php");
$getid = $_GET['id'];
$delete_product = mysqli_query($conn, "DELETE FROM products WHERE id = '$getid'");
unlink("assets/product_image/".$delete_product['image']);
if($delete_product){
    echo "delete succesfully";
    header('location:product_manage.php');
}else{
    die(mysqli_error($conn));
}


?>;