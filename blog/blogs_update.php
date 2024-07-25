<?php
include_once ("includes/config.php");
include_once ("includes/nav.php");
include_once ("includes/header.php");
include_once ("includes/blog_validation_update.php");
error_reporting(E_ALL);

$conn = mysqli_connect ("localhost","root","1100","blogs");
// if ($conn) {
//     echo"successfully";}
//     else{
//         echo "die";
//     }
$update_id = $_GET['id'];

print_r($update_id);



$ans = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM blogs WHERE id = '".$_GET['id']."'"));

if(isset($_POST['save'])){
   // print_r($_POST);
    include_once ("includes/blog_validation_update.php");
    $errors = blog_validation_update();
    
     if(empty($errors)){
        $checkImg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image FROM blogs WHERE id = '$update_id'"));

        if ($_FILES['image']['error'] == 0) {
            $src = $_FILES['image']['tmp_name'];
            $attachment = time() . $_FILES['image']['name'];
            $dest = "uploads/blog_image/" . $attachment;
          
            if (move_uploaded_file($src, $dest)) {
              $_POST['image'] = $attachment;
            }else{
              echo "unable to delete image";
              exit();
            }
          }else{
            $_POST['image'] =$checkImg['image'];
          }
  
    $update_blog ="UPDATE blogs SET
    blog_category_id = '".$_POST['blog_category']."',
    title ='".ucwords($_POST['name'])."',
    content ='".ucfirst($_POST['description'])."',
    image = '".$_POST['image']."',
    status = '".$_POST['status']."',
    modified= NOW() 
    where id = '".$_GET['id']."'";


    if(mysqli_query($conn,$update_blog)){
       $massage = "Blog has been updated successfully";
    }else{
        $error="Unable to update please try again";
    

    }
}
 }
?>

<body>
    <section>
        <div class="text-center">

            <?php if(isset($massage) && ($massage == "Blog has been updated successfully")) { ?>
            <span class="alert alert-success"><?php echo $massage; ?></span>
            <?php } if(isset($error) && ($error ==	"Unable to update please try again")) { ?>
            <span class="alert alert-danger"><?php echo $error; ?></span>
            <?php } ?>
            <br />
            <br />
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="container w-50 p-4 h-100"
                style="border-radius:20px;  background-image: linear-gradient(to left, #43e97b 0%, #38f9d7 100%); background-repeat : no-repeat; background-size:cover;background-position: fixed; height:600px;">
                <form class="row g-3">
                    <div class="col mt-3 fw-bold">
                        <label for="inputEmail4" class="form-label">Title</label>
                        <span class="text text-danger">*
                            <span>
                                <?php echo isset($errors['name']) ? $errors['name'] : " "; ?>
                            </span></span>
                        <input type="text" name="name" autocomplete="off" class="form-control" placeholder="Name"
                            id="inputEmail4" value="<?php echo isset($ans['title']) ? $ans['title'] : ''; ?>" />

                        <div class=" col-12 mt-3 fw-bold">
                            <label for="inputAddress" class="form-label">Content</label>
                            <span class="text text-danger">*
                                <span>
                                    <?php echo isset($errors['description']) ? $errors['description'] : ""; ?>
                                </span></span>
                            <textarea class="form-control" type="text" name="description"
                                placeholder="Description of Subcategory" id="floatingTextarea2"
                                style="height: 100px"><?php echo isset($ans['content']) ? $ans['content'] : ''; ?></textarea>
                        </div>
                        <div class="row g-3 mt-2 fw-bold">
                            <div class="col ">
                                <label for="inputCity" class="form-label">Select Blog category</label>
                                <span class="text text-danger">*
                                    <span>
                                        <?php echo isset($errors['blog_category']) ? $errors['blog_category'] : ""; ?>
                                    </span></span>
                                <select id="inputState" name="blog_category" class="form-select">
                                    <option value="0">Select Category</option>
                                    <?php
                                    $result = mysqli_query($conn, "SELECT id, category_title FROM blog_categories WHERE status='active' ORDER BY category_title");

                                   while ($getdata = mysqli_fetch_assoc($result)) {
                                    print_r($getdata['category_title']);
                                      ?>
                                    <option value="<?php echo $getdata['id']; ?>"
                                        <?php echo (isset($ans['blog_category_id']) && $ans['blog_category_id'] == $getdata['id']) ? "selected":" ";?>>
                                        <?php echo $getdata['category_title']; ?>
                                    </option>
                                    <?php } ?>

                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-10 fw-bold mt-3">
                                <label for="inputZip" class="form-label">Upload Blog Image</label>
                                <span class="text text-danger">*
                                    <span>
                                        <?php echo isset($errors['image']) ? $errors['image'] : " "; ?>
                                    </span>
                                </span>
                                <input type="file" name="image" class="form-control" id="inputZip">
                            </div>
                            <div class="col-2" style="margin-top:25px">

                                <img src="uploads/blog_image/<?php echo $ans['image'] ?>" width="100" />
                            </div>

                        </div>

                        <div class="col-12 mt-4 fw-bold">
                            <label class="me-4">Status</label>
                            <span class="text text-danger">
                                *<?php echo isset($errors['status']) ? $errors['status'] : ''; ?></span><br>
                            <input class="form-check-input ms-4" type="radio" id="gridCheck1" name="status"
                                value="active"
                                <?php echo (isset($ans['status']) && $ans['status'] == "active") ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="gridCheck1">Active</label>
                            <input class="form-check-input ms-3" type="radio" id="gridCheck2" name="status"
                                value="inactive"
                                <?php echo (isset($ans['status']) && $ans['status'] == "inactive") ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="gridCheck2">Not Active</label>
                        </div>
                        <div class="col-12 mt-3  text-center fw-bold">
                            <button type="submit" name="save" class="btn btn-primary">Update</button>
                            <button type="button" name="cancel" class="btn btn-danger"
                                onclick="window.location='blogs_manage.php'">Cancel</button>
                        </div>
                </form>

            </div>
        </form>



    </section>
</body>