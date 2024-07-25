<?php $this->load->view('commonadmin/head.php') ?>

<body class="bg-gradient-login bg-image"
    style="background-image:url('<?php echo base_url();?>assets/registration.jpg'); background-attachment: fixed;">
    <!-- Register Content -->
    <div class="login w-50 ">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                    </div>
                                    <form method="post" action="<?php echo site_url('Login/registration_action'); ?>">

                                        <div class="form-group">
                                            <!--success message -->


                                            <!--error message -->
                                            <?php if($this->session->flashdata('error')){?> <p style="color:red">
                                                <?php echo $this->session->flashdata('error'); ?></p>
                                            <?php } ?>

                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label>First Name &nbsp;</label>
                                                <span class="text text-danger">
                                                    <?php echo form_error('firstname');  ?>
                                                </span>
                                            </div>

                                            <input type="text" class="form-control" name="firstname" value=""
                                                id="exampleInputFirstName" placeholder="Enter First Name">
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label>Last Name &nbsp;</label>
                                                <span class="text text-danger">
                                                    <?php echo form_error('lastname'); ?>
                                                </span>
                                            </div>

                                            <input type="text" name="lastname" value="" class="form-control"
                                                id="exampleInputLastName" placeholder="Enter Last Name">
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label>Email &nbsp;</label>
                                                <span class="text text-danger">
                                                    <?php echo form_error('email'); ?>
                                                </span>
                                            </div>

                                            <input type="email" name="email" value="" class="form-control"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address">
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label>Password &nbsp;</label>
                                                <span class="text text-danger">
                                                    <?php echo form_error('password'); ?>
                                                </span>
                                            </div>


                                            <input type="password" name="password" value="" class="form-control"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label>Repeat Password &nbsp;</label>
                                                <span class="text text-danger">
                                                    <?php echo form_error('confirmpassword') ?>
                                                </span>
                                            </div>

                                            <input type="password" name="confirmpassword" value="" class="form-control"
                                                id="exampleInputPasswordRepeat" placeholder="Confirm Password">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="submit" value=""
                                                class="btn btn-primary btn-block">Register</button>
                                        </div>
                                        <hr>
                                    </form>

                                    <div class="text-center">
                                        <a class="font-weight-bold small"
                                            href="<?php echo site_url('Login\userlogin'); ?>">Already have an
                                            account?</a>
                                    </div>
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
    <?php  $this->load->view('common/script.php')  ?>
</body>