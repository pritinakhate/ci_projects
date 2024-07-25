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
                        <li class=" breadcrumb-item"><a href="<?php echo site_url('Users/guestdata');  ?>">Guest
                                list</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Guest Info</li>
                    </ol>
                </div>

                <html lang="en">

                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width = device-width, initial-scale = 1, shrink-to-fit = no">
                    <link rel="stylesheet"
                        href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
                        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
                        crossorigin="anonymous">
                    <title>Guest View</title>
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
                    <div class="container w-50 text-center mb-5 ">
                        <div class="card p-3 ">
                            <div>
                                <h1> <?= $guest_data['name'];  ?></h1>
                                <img src="<?Php echo base_url('uploads/guest_images/').$guest_data['image']; ?>"
                                    width="50%" style="margin-bottom: 20px; border-radius:50%">
                            </div>


                            <div class="row text-left ml-5 d-flex">

                                <div class="col-6">
                                    <label class="lable">
                                        Mobile No:-
                                    </label>

                                </div>
                                <div class="col-6">
                                    <span class="span">
                                        <?= $guest_data['mobile']; ?>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <label class="lable">
                                        DOB:-
                                    </label>

                                </div>
                                <div class="col-6">
                                    <span class="span">
                                        <?= $guest_data['gender']; ?>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <label class="lable">
                                        Gender:-
                                    </label>

                                </div>
                                <div class="col-6">
                                    <span class="span">
                                        <?= $guest_data['dob']; ?>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <label class="lable">
                                        Email:-
                                    </label>

                                </div>
                                <div class="col-6">
                                    <span class="span">
                                        <?= $guest_data['email']; ?>
                                    </span>
                                </div>

                                <div class="col-6">
                                    <label class="lable">
                                        Address:-
                                    </label>

                                </div>
                                <div class="col-6">
                                    <span class="span">
                                        <?= $guest_data['address']; ?>
                                    </span>
                                </div>

                                <div class="col-6">
                                    <label class="lable">
                                        Hobbies:-
                                    </label>

                                </div>
                                <div class="col-6">
                                    <span class="span">
                                        <?= $guest_data['hobby'];?>

                                    </span>
                                </div>

                            </div>


                        </div>
                    </div>

                </body>

                </html>
                <!--Row-->



                <?php $this->load->view('logout.php') ?>



            </div>

            <!--Row-->

            <!-- Documentation Link -->


            <!-- Modal Logout -->
            <?php $this->load->view('logout.php') ?>



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