<?php
include_once ("includes/config.php");
include_once ("includes/nav.php");
include_once ("includes/header.php");
include_once ("includes/subcategory_validation.php");

// $conn = mysqli_connect ("localhost","root","1100","product");



$result = mysqli_query($conn, "SELECT id, category_name FROM product_categories WHERE status='active' ORDER BY category_name");


if (isset($_POST['save'] )) {

  include_once ("includes/subcategory_validation.php");
  $errors = subcategory_validation();

   if(empty($errors)){

    $checksubcategoryname= mysqli_fetch_assoc(mysqli_query($conn,"SELECT subcategory_name FROM product_subcategories where subcategory_name='".$_POST['name']."'"));

    if(!empty($checksubcategoryname)) 
    {
        if($checksubcategoryname)
        {
            $errors['name']= 'subcategory already exist';
        }
        
    }
    else
    {
    $insert_subcategory = "INSERT INTO product_subcategories SET
                            product_category_id = '".$_POST['product_category']."',
                            subcategory_name = '".ucwords($_POST['name'])."',
                            description = '".ucfirst($_POST['description'])."',
                            status = '".$_POST['status']."'";


    if(mysqli_query($conn,$insert_subcategory)){
        $massage= "subcategory has been created successfully";
       
    }else{
        $error= "Unable to create please try again";
    }
    

    }

}
}    ?>


<section>

    <div class="text-center mb-3">

        <?php if(isset($massage) && ($massage == "subcategory has been created successfully")) { ?>
        <span class="alert alert-success"><?php echo $massage; ?></span>
        <?php } if(isset($error) && ($error ==	"Unable to create please try again")) { ?>
        <span class="alert alert-danger"><?php echo $error; ?></span>
        <?php } ?>
        <br />

    </div>
    <form action="subcategory_create.php" method="post" enctype="multipart/form-data">
        <div class="container w-50 p-4"
            style="border-radius:20px;  background-image: linear-gradient(to bottom right, #e6dae0, #dbced8, #cec3d2, #bfb9cb, #afafc5, #a7afc6, #9eb0c7, #95b0c6, #95bacc, #98c4d0, #9dcdd2, #a5d6d3);; background-repeat : no-repeat; background-size:cover;background-position: fixed;">
            <form class="row g-3">
                <div class="panel-heading">
                    <h3 class="text-center">Create Subcategory</h3>
                </div>

                <div class="col mt-3 fw-bold">
                    <label for="inputEmail4" class="form-label">Product Sub-Category </label>
                    <span class="text text-danger">*
                        <span>
                            <?php echo isset($errors['name']) ? $errors['name'] : " "; ?>
                        </span></span>
                    <input type="text" name="name" autocomplete="off" class="form-control"
                        placeholder="Name of Sub-category"
                        value="<?php echo (isset($_POST['name']))? $_POST['name'] : ''; ?>">
                </div>

                <div class="col-12  mt-3 fw-bold">
                    <label for="inputAddress" class="form-label">Description</label>
                    <span class="text text-danger">*
                        <span>
                            <?php echo isset($errors['description']) ? $errors['description'] : ""; ?>
                        </span></span>
                    <textarea class="form-control" type="text" name="description"
                        placeholder="Description of Subcategory" id="floatingTextarea2" style="height: 100px"
                        value="<?php echo (isset($_POST['description']))? $_POST['description'] : ''; ?>"></textarea>
                </div>
                <div class="row g-3 mt-2 fw-bold">
                    <div class="col ">
                        <label for="inputCity" class="form-label">Product category</label>
                        <span class="text text-danger"> *
                            <?php echo(isset($errors['product_category']))?$errors['product_category']:'';?></span>
                        <select id="inputState" name="product_category" class="form-select">
                            <option value="0">Select Category</option>
                            <?php
                            while($getdata= mysqli_fetch_assoc($result) ){
                                print_r($getdata['category_name']);
                            ?>
                            <option value="<?php echo $getdata['id'];?>"
                                <?php echo (isset($_POST['product_category']) && $_POST['product_category'] == $getdata['id']) ? "selected":" ";?>>
                                <?php echo $getdata['category_name'];?>
                            </option>
                            <?php } ?>

                        </select>
                    </div>

                </div>

                <div class="col-12 mt-4 fw-bold">
                    <label class="me-4">Status</label>
                    <span class="text text-danger"> *
                        <span>
                            <?php echo isset($errors['status']) ? $errors['status'] : " "; ?>
                        </span>
                    </span>
                    <br>
                    <input class="form-check-input ms-5" type="radio" id="gridCheck" name="status" value="active"
                        <?php echo (isset($_POST['status']) && $_POST['status'] == "active") ? 'checked' : ''; ?>>
                    Active
                    <input class="form-check-input ms-3" type="radio" id="gridCheck" name="status" value="inactive"
                        value="active"
                        <?php echo (isset($_POST['status']) && $_POST['status'] == "inactive") ? 'checked' : ''; ?>>
                    Not Active

                </div>
                <div class="col-12 mt-3  text-center fw-bold">
                    <button type="submit" name="save" class="btn btn-primary">Insert</button>
                    <button type="button" name="cancel" class="btn btn-danger" name="cancelbutton"
                        onclick="window.location='subcategory_manage.php'">Cancel</button>
                </div>
            </form>

        </div>
    </form>



</section>