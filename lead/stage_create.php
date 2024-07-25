<?php
include_once ("includes/config.php");
include_once ("includes/header.php");
include_once ("includes/nav.php");
include_once ("includes/stages_validation.php");

$conn=mysqli_connect("localhost","root","1100","lead");
error_reporting(E_ALL);

if (isset($_POST['save'])) {
  $errors = stages_validation();
  $checkleadstagename = mysqli_fetch_assoc(mysqli_query($conn, "SELECT title FROM lead_stages WHERE title = '" . $_POST['name'] . "' "));

  if (!empty($checkleadstagename)) {
    $errors['title'] = 'stage already exist';
  } else {
    if(empty($errors)){
    $insert_stage = "INSERT INTO lead_stages SET 
                  title = '" . ucwords($_POST['name']) . "',
                  description = '" . ucwords($_POST['description1']) . "',
                  status = '" . $_POST['status'] . "',
                  created = '" . date("y-m-d h:i:s") . "'";

    if (mysqli_query($conn, $insert_stage)) {
      $massage = "lead stage has been created successfully";
    } else {
      $error = "unable to create please try again";
    }
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

          <div class="text-center mt-5">
            <?php if(isset($massage) && ($massage == "lead stage has been created successfully")) { ?>
              <span class="alert alert-success"><?php echo $massage; ?></span>
            <?php }
            if(isset($error) && ($error == "unable to create please try again")) { ?>
              <span class="alert alert-danger"><?php echo $error; ?></span>
            <?php } ?>
            <br>
            <br>
          </div>

    <div class="container w-50 mt-3 ">
    <div class="panel-heading mb-3">
    <h3 class="text-center ">Create Lead Stage</h3>
    </div>
      <div class="mb-3">
        <label class="form-label">Title</label>
        <span class="text text-danger">*
                            <span>
                                <?php echo isset($errors['name']) ? $errors['name'] : " "; ?>
                            </span></span>
        <input type="text" class="form-control" name="name" autocomplete="off"
          value="<?php echo (isset($_POST['name'])) ? $_POST['name'] : ''; ?>" placeholder="title">
      </div>
      <div class="mb-3">
        <label class="form-label">Description</label>
        <span class="text text-danger">*
                            <span>
                                <?php echo isset($errors['description1']) ? $errors['description1'] : " "; ?>
                            </span></span>
        <input type="text" class="form-control" name="description1" autocomplete="off"
        value="<?php echo (isset($_POST['description1'])) ? $_POST['description1'] : ''; ?>" placeholder="enter description">

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
              <input class="form-check-input" type="radio" name="status"  value="Active" <?php echo (isset($_POST['status']) && $_POST['status'] == "Active")  ?> />Active
            </label>

          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="status" autocomplete="off" value="Block" <?php echo (isset($_POST['status']) && $_POST['status'] == "BLock") ?> />
              Block
            </label>
          </div>
        </div>
      </fieldset>
      <div class="panel-footer">
        <div class="form-group text-center">
          <button type="submit" class=" btn btn-success" name="save">Create</button>
          <button type="button" class=" btn btn-danger" name="cancelbutton"
            onclick="window.location='stages_manage.php'">Cancel</button>
        </div>
      </div>

    </div>
  </form>


</body>

</html>