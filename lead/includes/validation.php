<?php
error_reporting(0);

function product_validation(){
    $error = array();
    $allowarray = array('image/jpg','image/jpeg','image/jfif','image/png');

    if(empty($_POST['name'])){
        $error['name'] = "Please enter Your Name";
    } elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST['name'])){
        $error['name'] ="Only letters and white space allowed";
}

if(empty($_POST['description'])){
    $error['description'] = "Please enter Product Description";
}

if(empty($_POST['product_category'])){
    $error['product_category'] = "Please select product category";
}

if(empty($_POST['product_subcategory'])){
    $error['product_subcategory'] = "Please select product sub-category";

}
if(empty($_POST['price'])){
    $error['price']="Please enter price of product";
} elseif(!preg_match("/^[0-1 ]*$/",$_POST['price'])) {
    $error['price'] = "Only number allowed";
  }

if(empty($_POST['image'])){
    $error['image'] = "Please select Product image";
}elseif(in_array($_FILES['image']['type'],$allowarray)){
    $error['image'] = "Select only jpg, png, jpeg, jfif, file,type";
}
if(empty($_POST['status'])){
    $error['status'] = "Please select status of Product";
}

return $error;



}

function product_category_validation(){
    $error = array();

    if(empty($_POST['name'])){
        $error['name'] = "Please enter Your Name";
    } elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST['name'])){
        $error['name'] ="Only letters and white space allowed";
}

if(empty($_POST['description'])){
    $error['description'] = "Please enter Product Description";
}
if(empty($_POST['status'])){
    $error['status'] = "Please select status of Product";
}
return $error;
}


?>