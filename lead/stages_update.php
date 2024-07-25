<?php
include_once ("includes/config.php");
include_once ("includes/nav.php");
include_once ("includes/header.php");
include_once ("includes/stages_validation.php");
error_reporting(E_ALL);

$conn = mysqli_connect ("localhost","root","1100","lead");
// if ($conn) {
//     echo "successfully";
//     }
//     else{
//         echo "die";
//     }
$update_id = $_GET['id'];



$ans = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM lead_stages WHERE id = '$update_id'"));

if(isset($_POST['save'])){
  $errors = stages_validation();
     if(empty($errors)){

  
    $update_stages ="UPDATE lead_stages SET
    title = '".$_POST['name']."',
    
    description ='".ucfirst($_POST['description1'])."',
    status = '".$_POST['status']."',
    created = '" . date("y-m-d h:i:s") . "',
    modified= NOW() 
    where id = '".$update_id."'";

    if (mysqli_query($conn, $update_stages )) {
        $massage = "lead stage has been updated successfully";
      } else {
        $error = "unable to update please try again";
      }
    

    }
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Manage Lead stage</title>
</head>

</html>

<body>

  <form action="" role="form" method="post" enctype="multipart/form-data">

    <div class="panel-heading">
      <h3 class="text-center">List Of Lead Source</h3>
    </div>
          <div class="text-center mt-5">
            <?php if(isset($massage) && ($massage == "lead stage has been updated successfully")) { ?>
              <span class="alert alert-success"><?php echo $massage; ?></span>
            <?php }
            if(isset($error) && ($error == "unable to update please try again")) { ?>
              <span class="alert alert-danger"><?php echo $error; ?></span>
            <?php } ?>
            <br>
            <br>
          </div>

    <div class="container w-50 mt-5 ">
      <div class="mb-3">
        <label class="form-label">Title</label>
        <span class="text text-danger">*
                            <span>
                                <?php echo isset($errors['name']) ? $errors['name'] : " "; ?>
                            </span></span>
        <input type="text" class="form-control" name="name"
          value="<?php echo (isset($ans['title'])) ? $ans['title'] : ''; ?>" placeholder="title">
      </div>
      <div class="mb-3">
        <label class="form-label">Description</label>
        <span class="text text-danger">*
                            <span>
                                <?php echo isset($errors['description1']) ? $errors['description1'] : " "; ?>
                            </span></span>
        <input type="text" class="form-control" name="description1"
        value="<?php echo (isset($ans['description'])) ? $ans['description'] : ''; ?>" placeholder="enter description">

      </div>

      <fieldset class="row mb-3">
        <legend class="col-form-label col-sm-2 pt-0">Status</legend>
        <div class="col-sm-10">
          <div class="form-check">
            <label class="form-check-label">
            <span class="text text-danger">*
                            <span>
                                <?php echo isset($errors['status']) ? $errors['status'] : " "; ?>
                            </span></span>
                            <br>
              <input class="form-check-input" type="radio" name="status" value="active" <?php echo (isset($ans['status']) && $ans['status'] == "active") ? 'checked' : ''; ?> />Active
            </label>

          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="status" value="block" <?php echo (isset($ans['status']) && $ans['status'] == "block") ? 'checked' : ''; ?>/>
              Block
            </label>
          </div>
        </div>
      </fieldset>
      <div class="panel-footer">
        <div class="form-group">
          <button type="submit" class=" btn btn-success" name="save">Update</button>
          <button type="button" class=" btn btn-danger" name="cancelbutton"
            onclick="window.location='stages_manage.php'">Cancel</button>
        </div>
      </div>

    </div>
  </form>


</body>

</html>