<?php
include_once("includes/config.php");
include_once("includes/header.php");
$conn = mysqli_connect("localhost","root","1100","product");

$getid = $_GET['id'];

if(!isset($getid) || empty($getid)){
    //check id not available

    header("location:category_manage.php");
    exit;
}else{
   //to check whether category id is associated with product or not
$checkcategory = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM product_categories WHERE id = '$getid'"));

//to check id of category against id
$checksubcategory = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM product_subcategories WHERE product_category_id	='".$checkcategory['id']."'"));  

$checkproduct= mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM products WHERE product_category_id = '".$checkcategory['id']."'"));


if(  !empty($checkproduct) || !empty($checksubcategory) || !empty($checkcategory)){
   
    echo "This Category is mapped";

     
}else{
    
    $dell = mysqli_query($conn,"delete from product_categories where id='".$checkcategory['id']."'");
    echo "category has been deleted sucsessfull";
}
    
}
?>

<body>

    <div class="container w-50 mt-5 text-center">
        <a class="btn btn-primary btn-lg p-3  " href="category_manage.php">Go To Manage</a>
    </div>
</body>