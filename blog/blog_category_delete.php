<?php
include_once("includes/config.php");
include_once("includes/header.php");
error_reporting(E_ALL);
$getid = $_GET['id'];
if(isset($getid) && empty($getid)){
    header('location:blog_category_manage.php');
    exit;
}else{
    $categoryid = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM blog_categories where id ='".$getid."'"));
    $blogid = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM blogs WHERE blog_category_id = '".$categoryid['id']."'"));

    if(!empty($blogid) && !empty($categoryid)){
        echo "Blog category is already mapped";
    }else{
        $query = mysqli_query($conn,"DELETE FROM blog_categories WHERE id = '".$categoryid['id']."'");
       if($query){
        echo "Category has been deleted sucsessfully";
       }
    }
}


?>

<body>

    <div class="container w-50 mt-5 text-center">
        <a class="btn btn-primary btn-lg p-3  " href="blog_category_manage.php">Go To Manage</a>
    </div>
</body>