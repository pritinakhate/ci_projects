<?php
include_once("includes/config.php");

    $getid = $_GET['id'];
    
    $delete_blog = mysqli_query($conn, "DELETE FROM blogs WHERE id='$getid'");
    unlink("uploads/blog_image/". $delete_blog['image']);
    if($delete_blog){
        

        echo "delete Successfully";
        header('location:blogs_manage.php');
    }else{
            die(mysqli_error($conn));
    }

?>;