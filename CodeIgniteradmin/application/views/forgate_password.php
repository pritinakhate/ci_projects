<?php $this->load->view('common/head.php') ?>

<!-- $user_id= $this->session->userdata('user_id');

if(!$user_id){

redirect('Welcome/login');
} -->
<html>

<head>
    <title>Login</title>
</head>


<body class="bg-image" style="background-image: url(' <?php echo base_url(); ?>assets/background.jpg' ); background-size:cover; background-attachment: fixed;">
    <!-- Login Content -->
    <form method="post" action="<?php echo site_url('Login/forgate_password_action'); ?>">



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
                                <div class="col-lg-12 mt-4">
                                    <h5 class="fs-2 fw-normal text-center text-secondary m-0 px-md-5">Provide the email
                                        address associated with your account to recover your password.</h5>
                                    <div class="login-form">

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




                                        <div class="form-group text-center  ">
                                            <button class="form-control btn btn-primary" type="submit" name="submit">Send OTP</button>
                                        </div>
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>

    </form>
    <hr>
    <div class="text-center">
        <a class="font-weight-bold larger" style="margin-right: 20px;" href="<?php echo site_url('Login/userlogin') ?>">Login</a>

        <a class="font-weight-bold larger " style="margin-left: 20px;" href="<?php echo site_url('Login/signup') ?>">Create an
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
    <?php $this->load->view('common/script.php') ?>
    </form>
</body>

</html>