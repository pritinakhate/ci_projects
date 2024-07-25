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
                            <img src="../assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
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
                        <li class=" breadcrumb-item"><a href="<?php echo site_url('Users/guestdata');  ?>">Guest
                                list</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Update Guest</li>
                    </ol>
                </div>

                <html lang="en">

                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width = device-width, initial-scale = 1, shrink-to-fit = no">
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                    <title>Update Guest</title>
                    <style>
                        .note {
                            text-align: center;
                            height: 80px;
                            background-image: linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%);
                            color: #fff;
                            font-weight: bold;
                            line-height: 80px;
                            margin-top: 0px;
                        }

                        body {
                            margin: 0;
                            font-family: 'Lato', sans-serif;
                            font-size: 12px;
                            line-height: 1.8em;
                            text-transform: none;
                            letter-spacing: .075em;
                            font-weight: bold;
                            font-style: normal;
                            text-decoration: none;
                            color: #e7bd74;
                            background-color: rgba(34, 28, 28);
                            display: block;
                            background-color: gainsboro;
                        }

                        .title {
                            margin-top: 2rem;
                            margin-bottom: 1rem;
                        }

                        .form-content {
                            padding: 5%;
                            border: 1px solid #ced4da;
                            margin-bottom: 2%;
                        }

                        .form-control {
                            border-radius: 1.5rem;
                        }

                        .btnSubmit {
                            font-weight: bold;
                            border: none;
                            border-radius: 1.5rem;
                            padding: 0.8%;
                            width: 10%;
                            cursor: pointer;
                            margin-top: 10px;
                            color: #fff;
                        }

                        .btncancel {
                            border: none;
                            border-radius: 1.5rem;
                            padding: 0.8%;
                            width: 10%;
                            cursor: pointer;
                            margin-top: 10px;
                            color: #fff;
                            padding: 12px 25px;
                        }

                        h1 {
                            font-family: sans-serif;
                            display: block;
                            font-size: 1rem;
                            font-weight: bold;
                            text-align: center;
                            letter-spacing: 3px;
                            color: White;
                            text-transform: uppercase;
                            padding-top: 30px;
                        }

                        a {
                            text-decoration: none;
                            color: #fff;
                        }

                        a:hover {
                            text-decoration: none;
                            color: #fff;
                        }
                    </style>
                </head>

                <body>
                    <div class="container register-form">
                        <div class="form">
                            <div class="note">
                                <h1> Guest Information</h1>
                            </div>
                            <form method="post" action="<?php echo site_url('Users/update_action/' . $id); ?>" enctype="multipart/form-data">

                                <div class="form-content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <label for="inputState" style="color:Gray; font-weight:bolder; font-size:larger">Full
                                                        Name &nbsp;</label>

                                                    <span class="text text-danger  d-flex">* &nbsp;
                                                        <span class="text text-danger">

                                                            <?php echo form_error('name'); ?>
                                                        </span>
                                                    </span>
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo $guest['id']; ?>">
                                                <input type="text" name="name" class="form-control" placeholder="Your Name" value="<?php echo set_value('name', $guest['name']); ?>" />
                                            </div>
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <label for="inputState" style="color:Gray; font-weight:bolder; font-size:larger">Email
                                                        &nbsp;</label>
                                                    <span class="text text-danger d-flex">*&nbsp;
                                                        <span class="text text-danger">
                                                            <?php echo form_error('email'); ?>
                                                        </span>
                                                    </span>
                                                </div>
                                                <input type="text" name="email" class="form-control" placeholder="Email Id" value="<?php echo set_value('email', $guest['email']); ?>" />
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <label for="inputState" style="color:Gray; font-weight:bolder; font-size:larger">Mobile
                                                        No.&nbsp;</label>
                                                    <span class="text text-danger d-flex">*&nbsp;
                                                        <span class="text text-danger">
                                                            <?php echo form_error('mobile'); ?>
                                                        </span>
                                                    </span>
                                                </div>
                                                <input type="text" name="mobile" class="form-control" placeholder="Phone No." value="<?php echo set_value('mobile', $guest['mobile']); ?>" />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="d-flex">
                                                <label for="inputState" style="color:Gray; font-weight:bolder; font-size:larger">DOB&nbsp;</label>
                                                <span class="tex text-danger d-flex">*&nbsp;
                                                    <span class="text text-danger">
                                                        <?php echo form_error('dob'); ?>
                                                    </span>
                                                </span>
                                            </div>

                                            <input type="date" name="dob" class="form-control" placeholder="DOB" value="<?php echo set_value('dob', $guest['dob']);  ?>">
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="d-flex">
                                                <label for="inputState" style="color:Gray; font-weight:bolder; font-size:larger">Address&nbsp;</label>
                                                <span class="text text-danger d-flex">*&nbsp;

                                                    <span class="text text-danger">
                                                        <?php echo form_error('address'); ?>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="text" name="address" class="form-control" placeholder="Address" value="<?php echo set_value('address', $guest['address']); ?>">
                                        </div>
                                    </div>
                                    <div class="row align-items-center mt-4">
                                        <div class="form-group col-6">
                                            <div class="d-flex">
                                                <label for="inputState" style="color:gray; font-weight:bolder; font-size:larger">Hobbies&nbsp;</label>
                                                <span class="text text-danger d-flex">*
                                                    <span class="text text-danger">
                                                        <?php echo form_error('hobby[]'); ?>
                                                    </span>
                                                </span>
                                            </div>

                                            <div class="form-check" style="color:#595959; font-size: larger">
                                                <input class="form-check-input" name="hobby[]" type="checkbox" value="Reading" <?php echo in_array('Reading', explode(",", trim($guest["hobby"]))) ? 'checked' : "" ?>><label class="form-check-label" style="margin-left:20px;">
                                                    Reading
                                                </label>

                                            </div>
                                            <div class="form-check" style="color:#595959; font-size: larger">
                                                <input class="form-check-input" name="hobby[]" type="checkbox" value="Writing" <?php echo in_array('Writing', explode(",", trim($guest["hobby"]))) ? 'checked' : "" ?>>
                                                <label class="form-check-label" style="margin-left:20px;">
                                                    Writing
                                                </label>

                                            </div>
                                            <div class="form-check" style="color:#595959; font-size: larger">
                                                <input class="form-check-input" name="hobby[]" type="checkbox" value="Singing" <?php echo in_array('Singing', explode(",", trim($guest["hobby"]))) ? 'checked' : "" ?>><label class="form-check-label" style="margin-left:20px;">
                                                    Singing
                                                </label>

                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <div class="d-flex">
                                                <label for="inputState" style="color:Gray; font-weight:bolder; font-size:larger">Gender&nbsp;</label>
                                                <span class="text text-danger d-flex">*&nbsp;
                                                    <span class="text text-danger">
                                                        <?php echo form_error('gender'); ?>
                                                    </span>
                                                </span>
                                            </div>


                                            <div class="form-check" style="color:#595959; font-size: larger">
                                                <input class="form-check-input" type="radio" name="gender" value="male" <?php echo set_radio('gender', 'male', $guest['gender'] == 'Male'); ?>><label class="form-check-label" style="margin-left:20px;">
                                                    Male
                                                </label>

                                            </div>
                                            <div class="form-check" style="color:#595959; font-size: larger">
                                                <input class="form-check-input" type="radio" name="gender" value="female" <?php echo set_radio('gender', 'female', $guest['gender'] == 'Female')  ?>><label class="form-check-label" style="margin-left:20px;">
                                                    Female
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="d-flex">
                                                <label for="inputState" style="color:Gray; font-weight:bolder; font-size:larger">Upload
                                                    Image&nbsp;</label>
                                                <span class="text text-danger d-flex">*&nbsp;
                                                    <span class="text text-danger">
                                                        <?php echo form_error('image'); ?>
                                                    </span>
                                                </span>
                                            </div>

                                            <input type="file" name="image" class="form-control" placeholder="select your image">


                                        </div>
                                        <div class="col-md-2 ml-2">
                                            <img src="<?php echo base_url('uploads/guest_images/') . $guest['image'] ?>" height="70" width="70">
                                        </div>

                                    </div>
                                    <div class=" row justify-content-start mt-4">
                                        <div class="col">

                                            <button type="submit" name="submit" class="btnSubmit btn-info"> Update
                                            </button>
                                            <a href="<?php echo site_url('Users/guestdata') ?>" class="btncancel btn-danger"> Cancel </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- footer -->
                    <?php $this->load->view('commonadmin/footer') ?>
                    <!-- End footer -->
                </body>

                </html>
                <!--Row-->



                <?php $this->load->view('logout.php') ?>



            </div>

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