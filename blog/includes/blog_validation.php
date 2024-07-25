<?php
error_reporting(0);

function blog_validation(){
    $error = array();
    $allowarray = array('image/jpg','image/jpeg','image/jfif','image/png');

    if(empty($_POST['name'])){
        $error['name'] = "Please enter Your Name";
    } elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST['name'])){
        $error['name'] ="Only letters and white space allowed";
}

if(empty($_POST['description'])){
    $error['description'] = "Please enter Description";
}

if(empty($_POST['blog_category'])){
    $error['blog_category'] = "Please select  category";
}



  if($_FILES['image']['error']==4)
  {
      $error['image'] = "Please Select image";
  }
  elseif(!in_array($_FILES['image']['type'],$allowarray))
  {
      $error['image'] = "Please Select jpg, jpeg and png type of file";
  }
if(empty($_POST['status'])){
    $error['status'] = "Please select status of Product";
}

return $error;



}




?>