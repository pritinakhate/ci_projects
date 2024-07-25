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

<body class="bg-image" style="background-image: url(' <?php echo base_url(); ?>assets/background.jpg' ); background-size:cover; background-attachment: fixed;">
    <!-- Login Content -->
    <form method="post" action="<?php echo site_url('Login/login_action') ?>">



        <div class=" container container-login">

            <div class="row justify-content-center">

                <div class="col-xl-6 col-lg-12 col-md-9">
                    <div class="text-center p-5">
                        <a href="index.html" class="logo">
                            <img src="<?php echo base_url(); ?>assetsadmin/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="50" />
                        </a>
                    </div>

                    <div class="card shadow-sm ">

                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="login-form">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                        </div>

                                        <!--error message -->
                                        <?php if ($this->session->flashdata('error')) { ?>
                                            <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                                        <?php } ?>

                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label>User Name &nbsp;</label>
                                                <span class="text text-danger">
                                                    <?php echo form_error('email'); ?>
                                                </span>
                                            </div>

                                            <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Id">
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <label>Password &nbsp;</label>
                                                <span class="text text-danger">
                                                    <?php echo form_error('password'); ?>
                                                </span>
                                            </div>
                                            <input type="password" name="password" class="form-control" id="password-field" placeholder="Password">
                                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>

                                        <div class="form-group ">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                                <span class="fs-6" style="margin-left: 200px;"><a class="font-weight-bold larger" href="<?php echo site_url('Login/forgate_password') ?>">Forgate
                                                        Password</a></span>

                                            </div>

                                        </div>

                                        <div class="form-group text-center  ">
                                            <button class="form-control btn btn-primary" type="submit" name="submit">Login</button>
                                        </div>
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>

    </form>
    <hr>
    <div class="text-center">
        <a class="font-weight-bold larger" href="<?php echo site_url('Login/signup') ?>">Create an
            Account!</a>
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
    </form>
</body>

</html>