<?php $this->load->view('common/head.php') ?>

<!-- $user_id= $this->session->userdata('user_id');

if(!$user_id){

redirect('Welcome/login');
} -->
<html>

<head>
    <title>Login</title>
</head>
<style>
.field-icon {
    float: right;
    margin-right: 5px;
    margin-top: -30px;
    position: relative;
    z-index: 5;
}
</style>

<body class="bg-image"
    style="background-image: url(' <?php echo base_url(); ?>assets/background.jpg' ); background-size:cover; background-attachment: fixed;">
    <!-- Login Content -->
    <form method="post" action="<?php echo site_url('Login/changenewpassword_action') ?>">



        <div class=" container container-login">

            <div class="row justify-content-center">

                <div class="col-xl-6 col-lg-12 col-md-9">
                    <div class="text-center p-5">
                        <a href="index.html" class="logo">
                            <img src="<?php echo base_url(); ?>assetsadmin/img/kaiadmin/logo_light.svg"
                                alt="navbar brand" class="navbar-brand" height="50" />
                        </a>
                    </div>

                    <div class="card shadow-sm ">

                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="login-form">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Change Password</h1>
                                        </div>

                                        <!--error message -->
                                        <?php if ($this->session->flashdata('error')) { ?>
                                        <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                                        <?php } ?>

                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label>OTP &nbsp;</label>
                                                <span class="text text-danger d-flex">*&nbsp;
                                                    <span class="text text-danger">
                                                        <?php echo form_error('otp'); ?>
                                                    </span>
                                                </span>
                                            </div>

                                            <input type="text" name="otp" id="otp" class="form-control"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter OTP">

                                            <!-- for varify otp(not working) -->
                                            <!-- <a href="<? //php site_url('Login/varifiedotp');
                                                            ?>
                                                        " class="btn btn-success">Active</a> -->
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label>Set Password &nbsp;</label>
                                                <span class="text text-danger d-flex">*&nbsp;
                                                    <span class="text text-danger">
                                                        <?php echo form_error('password'); ?>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="password" name="password" id="password-field"
                                                class="form-control" placeholder="Password">
                                            <span toggle="#password-field"
                                                class="fa fa-fw fa-eye field-icon toggle-password"></span>


                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label>Confirm Password &nbsp;</label>
                                                <span class="text text-danger d-flex">*&nbsp;
                                                    <span class="text text-danger">
                                                        <?php echo form_error('confirm'); ?>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="password" name="confirm" id="password-field1"
                                                class="form-control" placeholder="Password">
                                            <span toggle="#password-field1"
                                                class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>


                                        <div class="form-group text-center  ">
                                            <button class="form-control btn btn-primary" type="submit"
                                                name="submit">Submit</button>
                                        </div>
                                        <div class="form-group text-center ">
                                            <a class="form-control btn btn-danger text-white" type="submit"
                                                name="submit"
                                                href="<?php echo site_url('Login/userlogin')  ?>">Cancle</a>
                                        </div>
                                        <hr>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Login Content -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });
    </script>
    <?php $this->load->view('common/script.php') ?>

</body>

</html>