<?php
include_once ("includes/config.php");
include_once ("includes/nav.php");
include_once ("includes/header.php");
include_once ("includes/blogcategory_validation.php");

error_reporting(E_ALL);

if (isset($_POST['save'])) {

  include_once ("includes/validation.php");
  $errors = category_validation();

 if (empty($errors)) {
    $checkblogname= mysqli_fetch_assoc(mysqli_query($conn,"SELECT category_title FROM blog_categories where category_title='".$_POST['name']."'"));

    if(!empty($checkblogname))
			{
			    $errors['name']= 'category already exist';
			}else{

    $insert_blog_category = "INSERT INTO blog_categories SET 
                      category_title = '" . ucwords($_POST['name']) . "',
                      content = '" . ucfirst($_POST['description']) . "',
                      status ='" . $_POST['status'] . "'";


                      if(mysqli_query($conn, $insert_blog_category))
                      {	
                          $massage= "Category has been created successfully";
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
    <div class="container w-50 text-center">
			
			<?php if(isset($massage) && ($massage == "Category has been created successfully")) { ?>
			<span class="alert alert-success"><?php echo $massage; ?></span>
			<?php } if(isset($error) && ($error ==	"Unable to create please try again")) { ?>
			<span class="alert alert-danger"><?php echo $error; ?></span>
			<?php } ?>
			<br/>
        </div>
    <title>Create-category</title>
        <form action="blog_category_create.php" method="post" enctype="multipart/form-data">
            <div class="container w-50 p-4 h-100"
                style="border-radius:20px; background: linear-gradient(90deg, hsla(152, 100%, 50%, 1) 0%, hsla(156, 100%, 70%, 1) 100%);background-repeat : no-repeat; background-size:cover;background-position: fixed; height:600px;">
                <form class="row g-3">
                <div class="panel-heading">
			  <h3 class="text-center">Create Category</h3>
		   </div>
		   
                    <div class="col mt-3 fw-bold">
                        <label for="inputEmail4" class="form-label">title</label>
                        <span class="text text-danger">*
                            <span>
                                <?php echo (isset($errors['name'])) ? $errors['name'] : ''; ?>
                            </span></span>
                        <input type="text" name="name" autocomplete="off" class="form-control" placeholder="Name" id="inputEmail4" value="<?php echo (isset($_POST['name'])) ? $_POST['name']:'';?>">
                    </div>

                    <div class="col-12  mt-3 fw-bold">
                        <label for="inputAddress" class="form-label">content</label>
                        <span class="text text-danger">*
                            <span>
                                <?php echo isset($errors['description']) ? $errors['description'] : ""; ?>
                            </span></span>

                        <textarea class="form-control" type="text" name="description"
                            placeholder="Description of Poduct" id="floatingTextarea2" style="height: 100px" value="<?php echo (isset($_POST['description'])) ? $_POST['description']:'';?>"></textarea>
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
                        <button type="button" name="cancel" class="btn btn-danger" onclick="window.location='blog_category_manage.php'">Cancel</button>
                    </div>
                </form>

            </div>
        </form>
    </section>
</body>