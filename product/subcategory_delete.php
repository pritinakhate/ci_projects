<?php
include_once("includes/config.php");
include_once("includes/header.php");
$conn = mysqli_connect("localhost","root","1100","product");



$getid = $_GET['id'];

if (!isset($getid) || empty($getid)){
    //check id not available
    header("location:subcategory_manage.php");
    exit;
}else{
  
//to check whether category id is associated with product or not
$checksubcategory = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM product_subcategories WHERE id	='".$_GET['id']."'"));
    
    //to check id of subcategory against id
$checkproduct = mysqli_fetch_assoc(mysqli_query($conn, "select id FROM products WHERE product_subcategory_id = '".$checksubcategory['id']."'"));


if(!empty($checkproduct) && !empty($checksubcategory)){
  
    echo 'This subcategory is mapped with product';

}else{
    
    $detete =mysqli_query($conn,"delete from product_subcategories where id = '".$checksubcategory['id']."'");
    
    if($detete){
        echo "Subycategory has been deleted sucsessfull";
    }
    
}

}



?>

<body>

    <div class="container w-50 mt-5 text-center">
        <a class="btn btn-primary btn-lg p-3  " href="subcategory_manage.php">Go To Manage</a>
    </div>
</body>