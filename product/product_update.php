<?php
include_once("includes/config.php");
include_once("includes/nav.php");
include_once("includes/header.php");
include_once("includes/product_validation_update.php");
error_reporting(E_ALL);

$conn = mysqli_connect("localhost", "root", "1100", "product");
// if ($conn) {
//     echo"successfully";}
//     else{
//         echo "die";
//     }
$update_id = $_GET['id'];



$ans = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id = '$update_id'"));



if (isset($_POST['save'])) {
    include_once("includes/product_validation.php");
    $errors = product_validation_update();

    if (empty($errors)) {
        $checkImg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM products WHERE id = '$update_id'"));

        if ($_FILES['image']['error'] == 0) {
            $src = $_FILES['image']['tmp_name'];
            $attachment = time() . $_FILES['image']['name'];
            $dest = "uploads/product_image/" . $attachment;

            if (move_uploaded_file($src, $dest)) {
                $_POST['image'] = $attachment;
            } else {
                echo "unable to delete image";
                exit();
            }
        } else {
            $_POST['image'] = $checkImg['image'];
        }

        $update_products = "UPDATE products SET
    product_subcategory_id = '" . $_POST['product_subcategory'] . "',
product_category_id = '" . $_POST['product_category'] . "',
product_name = '" . ucwords($_POST['name']) . "',
description = '" . ucfirst($_POST['description']) . "',
price = '" . $_POST['price'] . "',
image = '" . $_POST['image'] . "',
status = '" . $_POST['status'] . "',

modified= NOW() 
    WHERE id = '" . $update_id . "'
    ";
        //print_r($update_products);
        if (mysqli_query($conn, $update_products)) {

            //header("location:product_manage.php");
            $massage = "Product has been Updated successfully";
        } else {
            $error = "Unable to update please try again";
        }
    }
}
?>

<body>
    <section>


        <div class="text-center mb-3">

            <?php if (isset($massage) && ($massage == "Product has been Updated successfully")) { ?>
                <span class="alert alert-success"><?php echo $massage; ?></span>
            <?php }
            if (isset($error) && ($error ==    "Unable to update please try again")) { ?>
                <span class="alert alert-danger"><?php echo $error; ?></span>
            <?php } ?>
            <br />

        </div>

        <form action="" method="post" enctype="multipart/form-data">

            <div class="container w-50 p-4" style="border-radius:20px;  background-image: linear-gradient(to top right, #e6dae0, #dbced8, #cec3d2, #bfb9cb, #afafc5, #a7afc6, #9eb0c7, #95b0c6, #95bacc, #98c4d0, #9dcdd2, #a5d6d3);; background-repeat : no-repeat; background-size:cover; background-position: fixed; ">
                <form class="row g-3 ">
                    <div class="panel-heading mb-0">
                        <h3 class="text-center">Update Product</h3>
                    </div>
                    <div class="col mt-3 fw-bold">
                        <label for="inputEmail4" class="form-label">Product</label>
                        <span class="text text-danger">*
                            <span>
                                <?php echo isset($errors['name']) ? $errors['name'] : " "; ?>
                            </span></span>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo isset($ans['product_name']) ? $ans['product_name'] : ''; ?>">
                    </div>

                    <div class="col-12  mt-3 fw-bold">
                        <label for="inputAddress" class="form-label">Description</label>
                        <span class="text text-danger">*
                            <span>
                                <?php echo isset($errors['description']) ? $errors['description'] : ""; ?>
                            </span></span>

                        <textarea type="text" name="description" class="form-control" placeholder="Description of Poduct" id="floatingTextarea2" style="height: 70px"><?php echo isset($ans['description']) ? $ans['description'] : ''; ?></textarea>
                    </div>
                    <div class="row g-3 mt-2 fw-bold">
                        <div class="col-md-12 ">
                            <label for="inputCity" class="form-label">Select Product category</label>
                            <span class="text text-danger">*
                                <span>
                                    <?php echo isset($errors['product_category']) ? $errors['product_category'] : ""; ?>
                                </span></span>
                            <select id="inputState" name="product_category" class="form-select">
                                <option value="0">Select Category</option>
                                <?php
                                $result = mysqli_query($conn, "SELECT id, category_name FROM product_categories WHERE status='active' ORDER BY category_name");

                                while ($getdata = mysqli_fetch_assoc($result)) {
                                    print_r($getdata['category_name']);
                                ?>
                                    <option value="<?php echo $getdata['id']; ?>" <?php echo (isset($ans['product_category_id']) && $ans['product_category_id'] == $getdata['id']) ? "selected" : " "; ?>>
                                        <?php echo $getdata['category_name']; ?>
                                    </option>
                                <?php } ?>

                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="inputState" class="form-label"> Select Product Sub-category</label>
                            <span class="text text-danger">*
                                <span>
                                    <?php echo isset($errors['product_subcategory']) ? $errors['product_subcategory'] : ""; ?>
                                </span></span>
                            <select id="inputState" name="product_subcategory" class="form-select">
                                <option value="0">Select subCategory</option>
                                <?php
                                $result1 = mysqli_query($conn, "SELECT id, subcategory_name FROM product_subcategories WHERE status='active' ORDER BY subcategory_name");

                                while ($getdata1 = mysqli_fetch_assoc($result1)) {
                                    print_r($getdata1['subcategory_name']);
                                ?>
                                    <option value="<?php echo $getdata1['id']; ?>" <?php echo (isset($ans['product_subcategory_id']) && $ans['product_subcategory_id'] == $getdata1['id']) ? "selected" : " "; ?>>
                                        <?php echo $getdata1['subcategory_name']; ?>
                                    </option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                    <div class="row g-3 mt-2 fw-bold">
                        <div class="col-12">
                            <label for="inputZip" class="form-label">Enter Product price</label>
                            <span class="text text-danger">*
                                <span>
                                    <?php echo isset($errors['price']) ? $errors['price'] : " "; ?>
                                </span>
                            </span>
                            <input type="number" name="price" class="form-control" id="inputZip" value="<?php echo isset($ans['price']) ? $ans['price'] : ''; ?>">
                        </div>

                        <div class="row">
                            <div class="col-10 mt-3">
                                <label for="inputZip" class="form-label">Upload Product Image</label>
                                <span class="text text-danger">*
                                    <span>
                                        <?php echo isset($errors['image']) ? $errors['image'] : " "; ?>
                                    </span>
                                </span>
                                <input type="file" name="image" class="form-control" id="inputZip" value="<?php echo isset($ans['image']) ? $ans['image'] : ''; ?>">

                            </div>
                            <div class="col-2 mt-4">
                                <img src="uploads/product_image/<?php echo $ans['image']  ?>" width="100">
                            </div>
                        </div>

                    </div>
                    <div class="col-6 mt-4 fw-bold">
                        <label class="me-4">Status</label>
                        <span class="text text-danger">
                            *<?php echo isset($errors['status']) ? $errors['status'] : ''; ?></span><br>
                        <input class=" form-check-input ms-4" type="radio" id="gridCheck1" name="status" value="active" <?php echo (isset($ans['status']) && $ans['status'] == "active") ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="gridCheck1">Active</label>
                        <input class="form-check-input ms-3" type="radio" id="gridCheck2" name="status" value="inactive" <?php echo (isset($ans['status']) && $ans['status'] == "inactive") ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="gridCheck2">Not Active</label>
                    </div>
                    <div class="row g-3 mt-3">
                        <div class="col-12 mt-3  text-center fw-bold">
                            <button type="submit" name="save" class="btn btn-primary">Update</button>

                            <button type="button" name="cancel" class="btn btn-danger" onclick="window.location='product_manage.php'">Cancel</button>
                        </div>
                    </div>

                </form>

            </div>
        </form>

    </section>

</body>