<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('commonadmin/head') ?>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php $this->load->view('commonadmin/sidenav') ?>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="../index.html" class="logo">
                            <img src="../assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand"
                                height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <?php $this->load->view('commonadmin/topnav') ?>
                <!-- End Navbar -->
            </div>



            <!-- Row -->
            <div class="container" id="container-wrapper">
                <div class="d-sm-flex align-items-center justify-content-between m-5">
                    <h1 class="h3 mb-0 text-gray-800"></h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('welcome/admin') ?>">Home</a></li>
                        <li class=" breadcrumb-item"><a href="<?php echo site_url('Login/all_data');  ?>">User
                                list</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">User Info</li>
                    </ol>
                </div>


                <div class="container " style="margin: 50px 400px ;" id="container-wrapper">


                    <html lang="en">

                    <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width = device-width, initial-scale = 1, shrink-to-fit = no">
                        <link rel="stylesheet"
                            href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
                            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
                            crossorigin="anonymous">
                        <title>Create User</title>
                        <style>
                        label {
                            margin-left: 20px;
                        }
                        </style>
                    </head>

                    <body class="bg-gradient-login bg-image "
                        style="background-image:url('<?php echo base_url();?>assets/registration.jpg'); background-attachment: fixed;">
                        <!-- Register Content -->
                        <div class="login w-75 " style="margin-left:-100px">
                            <div class="row justify-content-center">
                                <div class="col-xl-10 col-lg-12 col-md-9">
                                    <div class="card shadow-sm my-5">
                                        <div class="card-body p-0">
                                            <div class="row ">
                                                <div class="col-lg-12 p-5">
                                                    <div class="login-form">
                                                        <div class="text-center">
                                                            <h1 class="h4 text-gray-900 mb-4  font-weight-bold">Create
                                                                User
                                                            </h1>
                                                        </div>
                                                        <form method="post"
                                                            action="<?php echo site_url('Login/signup_action'); ?>"
                                                            enctype="multipart/form-data">

                                                            <div class="form-group">
                                                                <!--success message -->


                                                                <!--error message -->
                                                                <?php if($this->session->flashdata('error')){?> <p
                                                                    style="color:red">
                                                                    <?php echo $this->session->flashdata('error'); ?>
                                                                </p>
                                                                <?php } ?>

                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-6 ">

                                                                    <div class="d-flex ">
                                                                        <label class="font-weight-bold">Full Name &nbsp;
                                                                        </label>
                                                                        <span class="text text-danger d-flex ">* &nbsp;
                                                                            <span class="text text-danger">
                                                                                <?php echo form_error('name');  ?>
                                                                            </span>
                                                                        </span>

                                                                    </div>

                                                                    <input type="text" class="form-control" name="name"
                                                                        value="" id="exampleInputFirstName"
                                                                        placeholder="Enter Your Name">
                                                                </div>
                                                                <div class="form-group col-6">
                                                                    <div class="d-flex">
                                                                        <label class="font-weight-bold">Mobile
                                                                            &nbsp;</label>
                                                                        <span class="text text-danger d-flex">*&nbsp;
                                                                            <span class="text text-danger">
                                                                                <?php echo form_error('mobile'); ?>
                                                                            </span>
                                                                        </span>

                                                                    </div>

                                                                    <input type="text" name="mobile" value=""
                                                                        class="form-control" id="exampleInputLastName"
                                                                        placeholder="Mobile No.">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-6">
                                                                    <div class="d-flex">
                                                                        <label class="font-weight-bold">DOB
                                                                            &nbsp;</label>
                                                                        <span class="text text-danger d-flex">* &nbsp;
                                                                            <span class="text text-danger">
                                                                                <?php echo form_error('dob'); ?>
                                                                            </span>
                                                                        </span>

                                                                    </div>

                                                                    <input type="date" name="dob" value=""
                                                                        class="form-control" id="exampleInputLastName"
                                                                        placeholder="Date of Birth">
                                                                </div>
                                                                <div class="form-group col-6">
                                                                    <div class="d-flex  ">
                                                                        <label class="font-weight-bold">Address
                                                                            &nbsp;</label>
                                                                        <span class="text text-danger d-flex">*&nbsp;
                                                                            <span class="text text-danger">
                                                                                <?php echo form_error('address'); ?>
                                                                            </span>
                                                                        </span>

                                                                    </div>

                                                                    <input type="text" name="address" value=""
                                                                        class="form-control" id="exampleInputLastName"
                                                                        placeholder="Address">
                                                                </div>
                                                            </div>

                                                            <div class="row align-items-center ">
                                                                <div class="form-group col-6 ">
                                                                    <div class="d-flex">
                                                                        <label for="inputState"
                                                                            style="color:gray; font-weight:bolder; font-size:15px">Hobby</label>
                                                                        <span class="text text-danger d-flex">* &nbsp;
                                                                            <span class="text text-danger">
                                                                                <?php echo form_error('hobby[]'); ?>
                                                                            </span>
                                                                        </span>
                                                                    </div>

                                                                    <div class="form-check "
                                                                        style="color:#595959; font-size: 15px">
                                                                        <input class="form-check-input" name="hobby[]"
                                                                            type="checkbox" value="reading">
                                                                        <label class="form-check-label">
                                                                            Reading
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check"
                                                                        style="color:#595959; font-size: 15px">
                                                                        <input class="form-check-input" name="hobby[]"
                                                                            type="checkbox" value="writing">
                                                                        <label class="form-check-label">
                                                                            Writing
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check"
                                                                        style="color:#595959; font-size: 15px">
                                                                        <input class="form-check-input" name="hobby[]"
                                                                            type="checkbox" value="singing">
                                                                        <label class="form-check-label">
                                                                            Singing
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-6">
                                                                    <div class="d-flex">
                                                                        <label for="inputState"
                                                                            style="color:Gray; font-weight:bolder; font-size:15px">Gender
                                                                            &nbsp;</label>
                                                                        <span class="text text-danger d-flex">* &nbsp;
                                                                            <span class="text text-danger">
                                                                                <?php echo form_error('gender'); ?>
                                                                            </span>
                                                                        </span>
                                                                    </div>


                                                                    <div class="form-check"
                                                                        style="color:#595959; font-size: 15px">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="gender" value="male">
                                                                        <label class="form-check-label">
                                                                            Male
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check"
                                                                        style="color:#595959; font-size: 15px">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="gender" value="female">
                                                                        <label class="form-check-label">
                                                                            Female
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-6">
                                                                    <div class="d-flex  ">
                                                                        <label class="font-weight-bold">Upload Image
                                                                            &nbsp;</label>
                                                                        <span class="text text-danger d-flex">* &nbsp;
                                                                            <span class="text text-danger">
                                                                                <?php echo form_error('image'); ?>
                                                                            </span>
                                                                        </span>

                                                                    </div>

                                                                    <input type="file" name="image" value=""
                                                                        class="form-control" id="exampleInputLastName"
                                                                        placeholder="Image file">
                                                                </div>
                                                                <div class="form-group col-6">
                                                                    <div class="d-flex  ">
                                                                        <label class="font-weight-bold">Email
                                                                            &nbsp;</label>
                                                                        <span class="text text-danger d-flex">* &nbsp;
                                                                            <span class="text text-danger">
                                                                                <?php echo form_error('email'); ?>
                                                                            </span>
                                                                        </span>

                                                                    </div>

                                                                    <input type="email" name="email" value=""
                                                                        class="form-control" id="exampleInputEmail"
                                                                        aria-describedby="emailHelp"
                                                                        placeholder="Enter Email Address">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class=" col-6 form-group  ">
                                                                    <div class="d-flex">
                                                                        <label class="font-weight-bold">Password
                                                                            &nbsp;</label>
                                                                        <span class="text text-danger d-flex">* &nbsp;
                                                                            <span class="text text-danger">
                                                                                <?php echo form_error('password'); ?>
                                                                            </span>
                                                                        </span>

                                                                    </div>


                                                                    <input type="password" name="password" value=""
                                                                        class="form-control" id="exampleInputPassword"
                                                                        placeholder="Password">
                                                                </div>
                                                                <div class=" col-6 form-group">
                                                                    <div class="d-flex  ">
                                                                        <label class="font-weight-bold">Repeat Password
                                                                            &nbsp;</label>
                                                                        <span class="text text-danger d-flex">* &nbsp;
                                                                            <span class="text text-danger">
                                                                                <?php echo form_error('confirmpassword') ?>
                                                                            </span>
                                                                        </span>

                                                                    </div>

                                                                    <input type="password" name="confirmpassword"
                                                                        value="" class="form-control"
                                                                        id="exampleInputPasswordRepeat"
                                                                        placeholder="Confirm Password">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div
                                                                    class=" col-4 text-center form-group  font-weight-bold">
                                                                    <button type="submit" name="submit" value=""
                                                                        class="btn btn-primary btn-block">Create</button>
                                                                </div>
                                                                <div
                                                                    class=" col-4 text-center form-group  font-weight-bold">
                                                                    <button type="reset" name="submit" value=""
                                                                        class="btn btn-warning btn-block">Reset</button>
                                                                </div>
                                                                <div
                                                                    class=" col-4 text-center text form-group  font-weight-bold">
                                                                    <a type="submit"
                                                                        href="<?php echo site_url('welcome/admin') ?>"
                                                                        class="btn btn-danger btn-block">Cancel</a>
                                                                </div>
                                                            </div>

                                                            <hr>
                                                        </form>


                                                        <div class="text-center">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Register Content -->

                    </body>




                </div>

                <?php $this->load->view('logout.php') ?>

</html>

<!-- Footer -->
<?php $this->load->view('commonadmin/footer')  ?>
<!-- Footer -->



</div>
<!--   Core JS Files   -->
<?php $this->load->view('common/script') ?>
<?php $this->load->view('commonadmin/script') ?>

<script>
$(document).ready(function() {
    $('#dataTable').DataTable(); // ID From dataTable 
    $('#dataTableHover')
        .DataTable(); // ID From dataTable with Hover
});
</script>
</body>

</html>