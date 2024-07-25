<?php $this->load->view('common/head.php') ?>

<body class="bg-gradient-login bg-image"
    style="background-image:url('<?php echo base_url();?>assets/registration.jpg'); background-attachment: fixed;">
    <!-- Register Content -->
    <div class="login w-75 " style="margin-left:-50px">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row ">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4  font-weight-bold">Register</h1>
                                    </div>
                                    <form method="post" action="<?php echo site_url('Login/signup_action'); ?>"
                                        enctype="multipart/form-data">

                                        <div class="form-group">
                                            <!--success message -->


                                            <!--error message -->
                                            <?php if($this->session->flashdata('error')){?> <p style="color:red">
                                                <?php echo $this->session->flashdata('error'); ?></p>
                                            <?php } ?>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6 ">
                                                <div class="d-flex ">
                                                    <label class="font-weight-bold">Full Name &nbsp; </label>
                                                    <span class="text text-danger d-flex ">* &nbsp;
                                                        <span class="text text-danger">
                                                            <?php echo form_error('name');  ?>
                                                        </span>
                                                    </span>

                                                </div>

                                                <input type="text" class="form-control" name="name" value=""
                                                    id="exampleInputFirstName" placeholder="Enter Your Name">
                                            </div>
                                            <div class="form-group col-6">
                                                <div class="d-flex">
                                                    <label class="font-weight-bold">Mobile &nbsp;</label>
                                                    <span class="text text-danger d-flex">*&nbsp;
                                                        <span class="text text-danger">
                                                            <?php echo form_error('mobile'); ?>
                                                        </span>
                                                    </span>

                                                </div>

                                                <input type="text" name="mobile" value="" class="form-control"
                                                    id="exampleInputLastName" placeholder="Mobile No.">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <div class="d-flex">
                                                    <label class="font-weight-bold">DOB &nbsp;</label>
                                                    <span class="text text-danger d-flex">* &nbsp;
                                                        <span class="text text-danger">
                                                            <?php echo form_error('dob'); ?>
                                                        </span>
                                                    </span>

                                                </div>

                                                <input type="date" name="dob" value="" class="form-control"
                                                    id="exampleInputLastName" placeholder="Date of Birth">
                                            </div>
                                            <div class="form-group col-6">
                                                <div class="d-flex  ">
                                                    <label class="font-weight-bold">Address &nbsp;</label>
                                                    <span class="text text-danger d-flex">*&nbsp;
                                                        <span class="text text-danger">
                                                            <?php echo form_error('address'); ?>
                                                        </span>
                                                    </span>

                                                </div>

                                                <input type="text" name="address" value="" class="form-control"
                                                    id="exampleInputLastName" placeholder="Address">
                                            </div>
                                        </div>

                                        <div class="row align-items-center ">
                                            <div class="form-group col-6">
                                                <div class="d-flex">
                                                    <label for="inputState"
                                                        style="color:gray; font-weight:bolder; font-size:15px">Hobby</label>
                                                    <span class="text text-danger d-flex">* &nbsp;
                                                        <span class="text text-danger">
                                                            <?php echo form_error('hobby[]'); ?>
                                                        </span>
                                                    </span>
                                                </div>



                                                <div class="form-check" style="color:#595959; font-size: 15px">
                                                    <input class="form-check-input" name="hobby[]" type="checkbox"
                                                        value="reading">
                                                    <label class="form-check-label">
                                                        Reading
                                                    </label>
                                                </div>
                                                <div class="form-check" style="color:#595959; font-size: 15px">
                                                    <input class="form-check-input" name="hobby[]" type="checkbox"
                                                        value="writing">
                                                    <label class="form-check-label">
                                                        Writing
                                                    </label>
                                                </div>
                                                <div class="form-check" style="color:#595959; font-size: 15px">
                                                    <input class="form-check-input" name="hobby[]" type="checkbox"
                                                        value="singing">
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


                                                <div class="form-check" style="color:#595959; font-size: 15px">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        value="male">
                                                    <label class="form-check-label">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="form-check" style="color:#595959; font-size: 15px">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        value="female">
                                                    <label class="form-check-label">
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <div class="d-flex  ">
                                                    <label class="font-weight-bold">Upload Image &nbsp;</label>
                                                    <span class="text text-danger d-flex">* &nbsp;
                                                        <span class="text text-danger">
                                                            <?php echo form_error('image'); ?>
                                                        </span>
                                                    </span>

                                                </div>

                                                <input type="file" name="image" value="" class="form-control"
                                                    id="exampleInputLastName" placeholder="Image file">
                                            </div>
                                            <div class="form-group col-6">
                                                <div class="d-flex  ">
                                                    <label class="font-weight-bold">Email &nbsp;</label>
                                                    <span class="text text-danger d-flex">* &nbsp;
                                                        <span class="text text-danger">
                                                            <?php echo form_error('email'); ?>
                                                        </span>
                                                    </span>

                                                </div>

                                                <input type="email" name="email" value="" class="form-control"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Enter Email Address">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class=" col-6 form-group  ">
                                                <div class="d-flex">
                                                    <label class="font-weight-bold">Password &nbsp;</label>
                                                    <span class="text text-danger d-flex">* &nbsp;
                                                        <span class="text text-danger">
                                                            <?php echo form_error('password'); ?>
                                                        </span>
                                                    </span>

                                                </div>


                                                <input type="password" name="password" value="" class="form-control"
                                                    id="exampleInputPassword" placeholder="Password">
                                            </div>
                                            <div class=" col-6 form-group">
                                                <div class="d-flex  ">
                                                    <label class="font-weight-bold">Repeat Password &nbsp;</label>
                                                    <span class="text text-danger d-flex">* &nbsp;
                                                        <span class="text text-danger">
                                                            <?php echo form_error('confirmpassword') ?>
                                                        </span>
                                                    </span>

                                                </div>

                                                <input type="password" name="confirmpassword" value=""
                                                    class="form-control" id="exampleInputPasswordRepeat"
                                                    placeholder="Confirm Password">
                                            </div>
                                        </div>
                                        <div class="form-group  font-weight-bold" style="margin:0px 10 0px 10">
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