<?php  
defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $this->load->view('common/head.php')
    ?>


</head>





<div id="wrapper">
    <!-- Sidebar -->
    <?php $this->load->view('common/sidenav.php') ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- TopBar -->
            <?php $this->load->view('common/topnav.php') ?>
            <!-- Topbar -->

            <!-- Container Fluid-->
            <div class="container " style="margin: 50px ;" id="container-wrapper">


                <html lang="en">

                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width = device-width, initial-scale = 1, shrink-to-fit = no">
                    <link rel="stylesheet"
                        href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
                        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
                        crossorigin="anonymous">
                    <title>User Account</title>
                    <style>
                    .lable {
                        margin-left: 75px;
                        font-size: large;
                        font-weight: bold;
                    }

                    .span {
                        margin-left: -30px;
                        font-size: large;
                        font-weight: bold;
                        color: gray;
                    }
                    </style>
                </head>


                <body>
                    <div class="row container">
                        <div class=" col-xl-4">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Profile Picture</div>
                                <div class="card-body text-center">
                                    <!-- Profile picture image-->
                                    <img class="img-account-profile rounded-circle mb-2"
                                        src="<?Php echo base_url('uploads/user_images/').$this->session->userdata('image'); ?>"
                                        alt="">

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <!-- Account details card-->
                            <div class="card mb-4 ">
                                <div class="card-header">Account Details</div>
                                <div class="card-body">
                                    <form>
                                        <!-- Form Group (username)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputUsername">User Name </label>
                                            <input class="form-control" id="inputUsername" type="text"
                                                placeholder="Enter your username"
                                                value=" <?= $this->session->userdata('name');  ?>">
                                        </div>
                                        <!-- Form Row-->
                                        <div class="row gx-3 mb-3">
                                            <!-- Form Group (first name)-->
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputFirstName">Gender</label>
                                                <input class="form-control" id="inputFirstName" type="text"
                                                    placeholder="Enter your first name"
                                                    value="<?php  echo $this->session->userdata('gender');?>">
                                            </div>
                                            <!-- Form Group (last name)-->
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputLastName">Hobby</label>
                                                <input class="form-control" id="inputLastName" type="text"
                                                    placeholder="Enter your last name"
                                                    value="<?php echo $this->session->userdata('hobby'); ?>">
                                            </div>
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <!-- Form Group (phone number)-->
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                                <input class="form-control" id="inputPhone" type="tel"
                                                    placeholder="Enter your phone number"
                                                    value="<?php echo $this->session->userdata('mobile'); ?>">
                                            </div>
                                            <!-- Form Group (birthday)-->
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                                <input class="form-control" id="inputBirthday" type="text"
                                                    name="birthday" placeholder="Enter your birthday"
                                                    value="<?php echo $this->session->userdata('dob') ; ?>">
                                            </div>
                                        </div>
                                        <!-- Form Row        -->
                                        <div class="row gx-3 mb-3">
                                            <!-- Form Group (organization name)-->
                                            <div class="col-md-12">
                                                <label class="small mb-1" for="inputOrgName"> <label class="small mb-1"
                                                        for="inputLastName">Address</label>
                                                </label>
                                                <input class="form-control" id="inputOrgName" type="text"
                                                    placeholder="Enter your organization name"
                                                    value="<?php echo $this->session->userdata('address');?>">
                                            </div>
                                            <!-- Form Group (location)-->

                                        </div>
                                        <!-- Form Group (email address)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                            <input class="form-control" id="inputEmailAddress" type="email"
                                                placeholder="Enter your email address"
                                                value="<?php echo $this->session->userdata('email'); ?>">
                                        </div>
                                        <!-- Form Row-->

                                        <!-- Save changes button-->
                                        <a class="btn btn-primary"
                                            href="<?php echo site_url('Users/change_password') ?>">Password
                                            changes</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </body>


                </html>
                <!--Row-->

                <?php $this->load->view('common/script') ?>

                <?php $this->load->view('logout.php') ?>



            </div>

        </div>

    </div>
</div>
<!-- Footer -->
<?php $this->load->view('common/footer.php') ?>
<!-- Footer -->
<!-- Scroll to top -->
<a class=" scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>



</body>

</html>