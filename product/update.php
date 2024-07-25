<?php
include_once ("includes/config.php");
include_once ("includes/nav.php");
include_once ("includes/header.php");
error_reporting(E_ALL);

$update_id = $_GET['id'];
$sql = "SELECT * FROM product_categories WHERE id = '$update_id'";
$result = mysqli_query($conn, $sql);
$ans = mysqli_fetch_assoc($result);

if(isset($_POST['save'])){
    include_once ("includes/category_validation.php");
    $errors = category_validation();
    if(empty($errors)){
    

        $update_category ="UPDATE product_categories SET
        category_name ='".$_POST['name']."',
        description ='".$_POST['description']."',
        status = '".$_POST['status']."',
        modified= NOW() where id = '$update_id'
        ";

        if(mysqli_query($conn, $update_category)){
            $massage= "Category has been Updated successfully";
}else{
    $error= "Unable to update please try again";
}
    }
}
?>

<body>
    <section>


        <div class="text-center mb-3">

            <?php if(isset($massage) && ($massage == "Category has been Updated successfully")) { ?>
            <span class="alert alert-success"><?php echo $massage; ?></span>
            <?php } if(isset($error) && ($error ==	"Unable to update please try again")) { ?>
            <span class="alert alert-danger"><?php echo $error; ?></span>
            <?php } ?>
            <br />
            <br />
        </div>

        <form method="post" enctype="multipart/form-data">
            <div class="container w-50 p-4"
                style="border-radius:20px; background-image: linear-gradient(to top left, #e6dae0, #dbced8, #cec3d2, #bfb9cb, #afafc5, #a7afc6, #9eb0c7, #95b0c6, #95bacc, #98c4d0, #9dcdd2, #a5d6d3); background-repeat: no-repeat; background-size: cover; background-position: fixed;">
                <form class="row g-3">
                    <div class="panel-heading mb-0">
                        <h3 class="text-center">Update Category</h3>
                    </div>
                    <div class="col mt-3 fw-bold">
                        <label for="inputEmail4" class="form-label">Product Category</label>
                        <span
                            class="text text-danger">*<?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
                        <input type="text" name="name" class="form-control" placeholder="Name" id="inputEmail4"
                            value="<?php echo isset($ans['category_name']) ? $ans['category_name'] : ''; ?>" />
                    </div>

                    <div class="col-12 mt-3 fw-bold">
                        <label for="inputAddress" class="form-label">Description</label>
                        <span
                            class="text text-danger">*<?php echo isset($errors['description']) ? $errors['description'] : ''; ?></span>
                        <textarea class="form-control" type="text" name="description"
                            placeholder="Description of Product" id="floatingTextarea2"
                            style="height: 100px"><?php echo isset($ans['description']) ? $ans['description'] : ''; ?></textarea>
                    </div>

                    <div class="col-12 mt-4 fw-bold">
                        <label class="me-4">Status</label>
                        <span class="text text-danger">
                            *<?php echo isset($errors['status']) ? $errors['status'] : ''; ?></span><br>
                        <input class="form-check-input ms-4" type="radio" id="gridCheck1" name="status" value="active"
                            <?php echo (isset($ans['status']) && $ans['status'] == "active") ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="gridCheck1">Active</label>
                        <input class="form-check-input ms-3" type="radio" id="gridCheck2" name="status" value="inactive"
                            <?php echo (isset($ans['status']) && $ans['status'] == "inactive") ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="gridCheck2">Not Active</label>
                    </div>
                    <div class="col-12 mt-3 text-center fw-bold">
                        <button type="submit" name="save" class="btn btn-primary">Update</button>
                        <button type="button" name="cancel" class="btn btn-danger" name="cancelbutton"
                            onclick="window.location='category_manage.php'">Cancel</button>
                    </div>
                </form>
            </div>
        </form>
    </section>
</body>