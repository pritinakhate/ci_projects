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

            <div class="container " id="container-wrapper ">
                <div class=" d-sm-flex align-items-center justify-content-between m-5">
                    <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Guest List</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('welcome/admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Guest Table</li>
                    </ol>
                </div>

                <!-- Row -->
                <div class="row">
                    <!-- Datatables -->

                    <!-- DataTable with Hover -->
                    <div class="col-lg-12" style="padding:0 60px 30px 60px;">
                        <div class="text-right mb-2 " style="color:white;">
                            <a class="btn btn-primary " href="<?php echo site_url('Users/create'); ?>">

                                Create
                            </a>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary"></h6>
                            </div>
                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Hobbies</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($guest as $guestdata) { ?>
                                        <tr>
                                            <td scope="row"><?php echo $i++; ?></td>
                                            <td><?php echo $guestdata->name; ?></td>
                                            <td><?php echo $guestdata->mobile; ?></td>
                                            <td><?php echo $guestdata->email;  ?></td>
                                            <td><?php echo $guestdata->gender; ?></td>
                                            <td><?php echo $guestdata->hobby; ?></td>
                                            <td>
                                                <img src="<?php echo base_url('uploads/guest_images/') . $guestdata->image; ?>"
                                                    width="50" height="50">
                                            </td>
                                            <td class="pt-4">
                                                <a
                                                    href="<?php echo site_url('Users/updateguest/' . $guestdata->id); ?>"><i
                                                        class="fas fa-user-edit pr-2 text-warning"></i></a>
                                                <a
                                                    href="<?php echo site_url('Users/deleteguest/' . $guestdata->id); ?>"><i
                                                        class="fas fa-trash-alt pr-2 text-danger"></i></a>
                                                <a href="<?php echo site_url('Users/viewguest/' . $guestdata->id); ?>"><i
                                                        class="far fa-eye text-info"></i></i></a>
                                            </td>
                                        </tr>

                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Row-->

                <!-- Documentation Link -->


                <!-- Modal Logout -->
                <?php $this->load->view('logout.php') ?>

            </div>

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