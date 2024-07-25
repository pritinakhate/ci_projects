<?php
include_once ("includes/config.php");
include_once ("includes/nav.php");
include_once ("includes/header.php");
include_once ("includes/category_validation.php");
error_reporting(E_ALL);

if (isset($_POST['save'])) {

  include_once ("includes/category_validation.php");
  $errors = category_validation();

  if (empty($errors)) {

    $checkcategoryname= mysqli_fetch_assoc(mysqli_query($conn,"SELECT category_name FROM product_categories where category_name='".$_POST['name']."'"));
    
    if(!empty($checkcategoryname)) 
		{
			if($checkcategoryname)
			{
			    $errors['name']= 'category already exist';
			}
			
		}
		else
		{
    $insert_category = "INSERT INTO product_categories SET 
                      category_name = '" . ucwords($_POST['name']) . "',
                      description = '" . ucfirst($_POST['description']) . "',
                      status ='" . $_POST['status'] . "'";


                      if(mysqli_query($conn,$insert_category))
                      {	
                          $massage= "Country has been created successfully";
                      }	
                      else
                      {
                          $error= "Unable to create please try again";
                      }
  }
}
}
?>

<body>
    <section>
        <div class="text-center mb-3">

            <?php if(isset($massage) && ($massage == "Country has been created successfully")) { ?>
            <span class="alert alert-success"><?php echo $massage; ?></span>
            <?php } if(isset($error) && ($error ==	"Unable to create please try again")) { ?>
            <span class="alert alert-danger"><?php echo $error; ?></span>
            <?php } ?>
            <br />

        </div>
        <form action="category_create.php" method="post" enctype="multipart/form-data">
            <div class="container w-50 p-4"
                style="border-radius:20px;  background-image: linear-gradient(to  top left, #e6dae0, #dbced8, #cec3d2, #bfb9cb, #afafc5, #a7afc6, #9eb0c7, #95b0c6, #95bacc, #98c4d0, #9dcdd2, #a5d6d3);; background-repeat : no-repeat; background-size:cover;background-position: fixed;">
                <div class="panel-heading">
                    <h3 class="text-center">Create Category</h3>
                </div>

                <div class="row g-3">
                    <div class="col mt-3 fw-bold">
                        <label for="inputEmail4" class="form-label">Product Category</label>
                        <span class="text text-danger">*
                            <span>
                                <?php echo (isset($errors['name'])) ? $errors['name'] : ''; ?>
                            </span></span>
                        <input type="text" name="name" autocomplete="off" class="form-control" placeholder="Name"
                            id="inputEmail4" value="<?php echo (isset($_POST['name'])) ? $_POST['name']:'';?>">
                    </div>

                    <div class="col-12  mt-3 fw-bold">
                        <label for="inputAddress" class="form-label">Description</label>
                        <span class="text text-danger">*
                            <span>
                                <?php echo isset($errors['description']) ? $errors['description'] : ""; ?>
                            </span></span>

                        <textarea class="form-control" type="text" name="description" placeholder="Description"
                            id="floatingTextarea2" style="height: 100px"
                            value="<?php echo (isset($_POST['description'])) ? $_POST['description']:'';?>"> </textarea>
                    </div>

                    <div class="col-12 mt-4 fw-bold">
                        <label class="me-4">Status</label>
                        <span class="text text-danger"> *
                            <span>
                                <?php echo isset($errors['status']) ? $errors['status'] : " "; ?>
                            </span>
                        </span><br>
                        <input class="form-check-input ms-4" type="radio" id="gridCheck" name="status" value="active"
                            <?php echo (isset($_POST['status']) && $_POST['status'] == "active") ? 'checked' : ''; ?>>
                        Active
                        <input class="form-check-input ms-3" type="radio" id="gridCheck" name="status" value="inactive"
                            <?php echo (isset($_POST['status']) && $_POST['status'] == "inactive") ? 'checked' : ''; ?>>
                        Not Active

                    </div>
                    <div class="col-12 mt-3  text-center fw-bold">
                        <button type="submit" name="save" class="btn btn-primary">Insert</button>
                        <button type="button" name="cancel" class="btn btn-danger" name="cancelbutton"
                            onclick="window.location='category_manage.php'">Cancel</button>
                    </div>
                </div>

            </div>
        </form>
    </section>
</body>