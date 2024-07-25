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
            <div class="container " id="container-wrapper">


                <html lang="en">

                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width = device-width, initial-scale = 1, shrink-to-fit = no">
                    <link rel="stylesheet"
                        href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
                        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
                        crossorigin="anonymous">
                    <title>Change Password</title>
                    <style>
                    body {

                        font-family: Arial, Helvetica, sans-serif;
                        font-size: large;
                    }

                    * {
                        box-sizing: border-box
                    }

                    /* Full-width input fields */
                    input[type=text],
                    input[type=password] {
                        width: 100%;
                        padding: 15px;
                        margin: 5px 0 22px 0;
                        display: inline-block;
                        border: none;
                        background: #f1f1f1;
                    }

                    input[type=text]:focus,
                    input[type=password]:focus {
                        background-color: #ddd;
                        outline: none;
                    }

                    hr {
                        border: 1px solid #f1f1f1;
                        margin-bottom: 25px;
                    }

                    /* Set a style for all buttons */
                    button {
                        background-color: #04AA6D;
                        color: white;
                        padding: 14px 20px;
                        margin: 8px 0;
                        border: none;
                        cursor: pointer;
                        width: 100%;
                        opacity: 0.9;
                    }

                    button:hover {
                        opacity: 1;
                    }

                    /* Extra styles for the cancel button */


                    /* Float cancel and signup buttons and add an equal width */

                    .signupbtn {
                        float: left;
                        width: 50%;
                    }

                    .cancelbtn {
                        padding: 14px 20px;
                        background-color: #f44336;
                        margin-top: 8px;
                        color: white;
                        text-align: center;
                        float: left;
                        width: 50%;
                    }

                    /* Add padding to container elements */


                    /* Clear floats */
                    .clearfix::after {
                        content: "";
                        clear: both;
                        display: table;
                    }

                    /* Change styles for cancel button and signup button on extra small screens */
                    @media screen and (max-width: 300px) {

                        .cancelbtn,
                        .signupbtn {
                            width: 100%;
                        }
                    }
                    </style>

                    <form method="post" action='<?php echo site_url('Users/update_password/' . $id) ?>'>
                        <div class=" containers w-75 d-flex p-5 " style="background-color: white; margin-left:50px">
                            <div class="row col-6">

                                <h1>Change Password</h1>
                                <hr>
                                <div class="d-flex">
                                    <label for="current_password " class="d-flex"><b>Current Password&nbsp;</b></label>

                                    <span class="text text-danger d-flex">*&nbsp;
                                        <span class="text text-danger">
                                            <?php echo form_error('current_password'); ?>
                                        </span>
                                    </span>
                                </div>

                                <input type="password" name="current_password" id="current_password"
                                    placeholder="Current Password" />
                                <div class="d-flex">
                                    <label for=""><b>New Password &nbsp;</b></label>
                                    <span class="text text-danger d-flex">*&nbsp;
                                        <span class="text text-danger">
                                            <?php echo form_error('new_password'); ?>
                                        </span>
                                    </span>
                                </div>
                                <input type="password" name="new_password" id="new_password"
                                    placeholder="New Password" />
                                <div class="d-flex">
                                    <label for="psw-repeat"><b>Repeat Password&nbsp;</b></label>
                                    <span class="text text-danger d-flex">*&nbsp;
                                        <span class="text text-danger">
                                            <?php echo form_error('confirm_password');  ?>
                                        </span>
                                    </span>
                                </div>

                                <input type="password" name="confirm_password" id="confirm_password"
                                    placeholder="Confirm Password" />

                                <label>
                                    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px">
                                    Remember me
                                </label>

                                <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms &
                                        Privacy</a>.</p>

                                <div class="clearfix col-12">
                                    <a type="button" class="cancelbtn"
                                        href="<?php echo site_url('Welcome/admin') ?>">Cancel</a>
                                    <button type="submit" class="signupbtn">Change</button>
                                </div>


                            </div>
                            <div class="col-6 ms-5  ">
                                <img src="<?php echo base_url('assets/change_pass1.jpg') ?>"
                                    style="background-size: cover; height:500px; margin-left:50px; width:500px">
                            </div>
                        </div>

                    </form>

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