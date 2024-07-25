<?php
include_once ("includes/config.php");
include_once ("includes/nav.php");
include_once ("includes/header.php");
 include_once ("includes/blog_validation.php");


error_reporting(E_ALL);


$result = mysqli_query($conn, "SELECT id, category_title FROM blog_categories WHERE status='active' ORDER BY category_title");


if (isset($_POST['save'])) {

include_once ("includes/validation.php");
$errors = blog_validation();
  if(empty($errors)) {
    $checkblogname= mysqli_fetch_assoc(mysqli_query($conn,"SELECT title FROM blogs where title='".$_POST['name']."'"));

    if(!empty($checkblogname))
			{
			    $errors['name']= 'blog already exist';
			}else{
  if($_FILES['image']['error'] == 0) {
    $src = $_FILES['image']['tmp_name'];
    $attachment = time().$_FILES['image']['name'];
    $dest = "uploads/blog_image/".$attachment;
    
    if (move_uploaded_file($src, $dest)){
    $_POST['image'] = $attachment;
    }
    }

 //if(empty($errors)){
    $insert_blogs = "INSERT INTO blogs SET
                            blog_category_id = '".$_POST['blog_category']."',
                            title = '".ucwords($_POST['name'])."',
                            content = '".ucfirst($_POST['description'])."',
                            image = '".$_POST['image']."',
                            status = '".$_POST['status']."',

        
                            created='".date("Y-m-d h:i:s")."'";
                            if(mysqli_query($conn,$insert_blogs))
                            {
                            $massage = "blog has been created successfully";
                            }
                            else
                            {
                            $error ="Unable to create please try again";
                            }
    
  }
    }
}
?>


<section>
<div class="container w-50 text-center">
			
			<?php if(isset($massage) && ($massage == "blog has been created successfully")) { ?>
			<span class="alert alert-success"><?php echo $massage; ?></span>
			<?php } if(isset($error) && ($error ==	"Unable to create please try again")) { ?>
			<span class="alert alert-danger"><?php echo $error; ?></span>
			<?php } ?>
			<br/>
            </div>
    <form action="blogs_create.php" method="post" enctype="multipart/form-data">
        <div class="container w-50 p-4 mt-3 h-100"
            style="border-radius:20px;  background: linear-gradient(90deg, hsla(152, 100%, 50%, 1) 0%, hsla(156, 100%, 70%, 1) 100%); background-repeat : no-repeat; background-size:cover;background-position: fixed; height:600px;">
            <form class="row g-3">
                <div class="col  fw-bold">
                <div class="panel-heading">
			<h3 class="text-center">Create Blog</h3>
			</div>
			
			
                    <label for="inputEmail4" class="form-label">title</label>
                    <span class="text text-danger">*
                        <span>
                            <?php echo isset($errors['name']) ? $errors['name'] : " "; ?>
                        </span></span>
                    <input type="text" name="name" autocomplete="off" class="form-control" placeholder="Name of Sub-category" value="<?php echo (isset($_POST['name'])) ? $_POST['name']:'';?>">
                </div>

                <div class="col-12  mt-3 fw-bold">
                    <label for="inputAddress" class="form-label">Content</label>
                    <span class="text text-danger">*
                        <span>
                            <?php echo isset($errors['description']) ? $errors['description'] : ""; ?>
                        </span></span>
                    <textarea class="form-control" type="text" name="description"
                        placeholder="Description of Subcategory" id="floatingTextarea2"
                        style="height: 100px" value="<?php echo (isset($_POST['description']))? $_POST['description'] : ''; ?>"></textarea>
                </div>
                <div class="row g-3 mt-2 fw-bold">
                    <div class="col ">
                        <label for="inputCity" class="form-label">Blog category</label>
                        <span class="text text-danger">*
                            <span>
                                <?php echo isset($errors['blog_category']) ? $errors['blog_category'] : ""; ?>
                            </span></span>
                        <select id="inputState" name="blog_category" class="form-select">
                            <option value="0">Select Category</option>
                            <?php
                            while($getdata= mysqli_fetch_assoc($result) ){
                                print_r($getdata['title']);
                            ?>
                            <option value="<?php echo $getdata['id'];?>"
                                <?php echo (isset($_POST['title_category']) && $_POST['title_category'] == $getdata['id']) ? "selected":" ";?>>
                                <?php echo $getdata['category_title'];?>
                            </option>
                            <?php } ?>

                        </select>
                    </div>

                </div>
                <div class="col fw-bold mt-3">
                            <label for="inputZip" class="form-label">Upload Product Image</label>
                            <span class="text text-danger">*
                                <span>
                                    <?php echo isset($errors['image']) ? $errors['image'] : " "; ?>
                                </span>
                            </span>
                            <input type="file" name="image" class="form-control" id="inputZip">
                        </div>

                <div class="col-12 mt-4 fw-bold">
                    <label class="me-4">Status</label>
                    <span class="text text-danger"> *
                        <span>
                            <?php echo isset($errors['status']) ? $errors['status'] : " "; ?>
                        </span>
                    </span><br>
                    <input class="form-check-input ms-5" type="radio" id="gridCheck" name="status" value="active"
                        <?php echo (isset($_POST['status']) && $_POST['status'] == "active") ? 'checked' : ''; ?>>
                    Active
                    <input class="form-check-input ms-3 " type="radio" id="gridCheck" name="status" value="inactive"
                        value="active"
                        <?php echo (isset($_POST['status']) && $_POST['status'] == "inactive") ? 'checked' : ''; ?>>
                    Not Active

                </div>
                <div class="col-12 mt-3  text-center fw-bold">
                    <button type="submit" name="save" class="btn btn-primary">Insert</button>
                    <button type="button" name="cancel" class="btn btn-danger" onclick="window.location='blogs_manage.php'">Cancel</button>
                </div>
            </form>

        </div>
    </form>



</section>