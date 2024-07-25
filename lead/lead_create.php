<?php
include_once ("includes/config.php");
include_once ("includes/header.php");
include_once ("includes/nav.php");
require_once("includes/lead_validation.php");

$conn=mysqli_connect("localhost","root","1100","lead");
error_reporting(E_ALL); 


$result = mysqli_query($conn, "SELECT id, title_sources FROM lead_sources WHERE status='active' order by title_sources ");


$result1 = mysqli_query($conn, "SELECT id, title FROM lead_stages WHERE status='active' order by title ");

if (isset($_POST['save'])) {
    $errors = lead_validation();
        $checkleadname= mysqli_fetch_assoc(mysqli_query($conn,"SELECT name FROM leads where name='".$_POST['name']."'"));
        if(!empty($checkleadname))
        {
            $errors['name']= 'lead already exist';
        }
       


        if(empty($errors)){
            
$insert_lead = "INSERT INTO leads SET
source_id = '".$_POST['lead_sources']."',
stage_id = '".$_POST['lead_stages']."',
name = '".ucwords($_POST['name'])."',
email = '".$_POST['email']."',
phone = '".$_POST['phone']."' ";


if(mysqli_query($conn,$insert_lead)){
    unset($_POST);
$massage = "Lead has been created successfully";
}
else
{
$error =	 "Unable to create please try again";
}
        }
}


?>

<body>
    <section>
        <form action="" method="post" enctype="multipart/form-data">

            <div class="container w-50 p-4 h-100"
                >
                <form class="row g-3">
                    <div class="col mt-3 fw-bold">
                    <div class="panel-heading">
			<h3 class="text-center">Create Lead</h3>
			</div>
			<br/>
			<div class="text-center">
			<?php if(isset($massage) && ($massage == "Lead has been created successfully")) { ?>
			<span class="alert alert-success"><?php echo $massage; ?></span>
			<?php } if(isset($error) && ($error ==	"Unable to create please try again")) { ?>
			<span class="alert alert-danger"><?php echo $error; ?></span>
			<?php } ?></div>
                        <label for="inputEmail4" class="form-label">lead Name</label>
                        <span class="text text-danger">*
                            <span>
                                <?php echo isset($errors['name']) ? $errors['name'] : " "; ?>
                            </span></span>
                        <input type="text" name="name" autocomplete="off" class="form-control" placeholder="Name" id="inputEmail4" value="<?php echo (isset($_POST['name']))? $_POST['name'] : '' ; ?>">
                    </div>

                    <div class="col-12  mt-3 fw-bold">
                        <label for="inputAddress" class="form-label">Email</label>
                        <span class="text text-danger">*
                            <span>
                                <?php echo isset($errors['email']) ? $errors['email'] : " "; ?>
                            </span></span>
                        
                            <input type="text" name="email" autocomplete="off" class="form-control" placeholder="email" id="inputEmail4" value="<?php echo (isset($_POST['email']))? $_POST['email'] : ''; ?>">
                    </div>
                    <div class="col-12  mt-3 fw-bold">
                        <label for="inputAddress" class="form-label">Phone</label>
                        <span class="text text-danger">*
                            <span>
                                <?php echo isset($errors['phone']) ? $errors['phone'] : " "; ?>
                            </span></span>
                        
                            <input type="text" name="phone" autocomplete="off" class="form-control" placeholder="Mobile No." id="inputEmail4" value="<?php echo (isset($_POST['phone'])) ? $_POST['phone'] : ''; ?>">
                    </div>
                    <div class="row g-3 mt-2 fw-bold">
                        <div class="col-md-6 ">
                            <label for="inputCity" class="form-label">Select lead sources </label>
                            <span class="text text-danger">*
                            <span>
                                <?php echo isset($errors['lead_sources']) ? $errors['lead_sources'] : " "; ?>
                            </span></span>
                            
                            <select id="inputState" name="lead_sources" class="form-select">
                                <option value="0">Select source</option>
                                <?php
                            while($getdata= mysqli_fetch_assoc($result) ){
                                print_r($getdata['title_sources']);
                            ?>
                                <option value="<?php echo $getdata['id'];?>"
                                    <?php echo (isset($_POST['lead_sources_id']) && $_POST['lead_sources_id'] == $getdata['id']) ? "selected":" ";?>>
                                    <?php echo $getdata['title_sources'];?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputState" class="form-label"> Select lead stage</label>
                            <span class="text text-danger">*
                            <span>
                                <?php echo isset($errors['lead_stages']) ? $errors['lead_stages'] : " "; ?>
                            </span></span>
                            <select id="inputState" name="lead_stages" class="form-select">
                                <option value="0">Select lead stage</option>
                                <?php
                            while($getdata1= mysqli_fetch_assoc($result1) ){
                                print_r($getdata1['title']);
                            ?>
                                <option value="<?php echo $getdata1['id'];?>"
                                    <?php echo (isset($_POST['lead_stages_id']) && $_POST['lead_stages_id'] == $getdata1['id']) ? "selected":" ";?>>
                                    <?php echo $getdata1['title'];?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                   
                    <div class="row g-3 mt-3">
                        <div class="col-12 mt-3  text-center fw-bold">
                            <button type="submit" name="save" class="btn btn-primary">Create</button>

                            <button type="button" name="cancel" class="btn btn-danger"  onclick="window.location='lead_manage.php'">Cancel</button>
                        </div>
                    </div>

                </form>

            </div>
        </form>

    </section>

</body>