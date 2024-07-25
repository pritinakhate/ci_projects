<!DOCTYPE html>
<html lang="en">

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@5.1.1/css/bootstrap5-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@5.1.1/js/bootstrap5-toggle.ecmas.min.js"></script>
    <script>
        $('input[data-toggle="toggle"]').bootstrapToggle();
    </script>
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
                    <h1 class="h3 mb-0 text-gray-800 font-weight-bold">User List</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('welcome/admin') ?>">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">User List</li>
                    </ol>
                </div>


                <div class="row ms-5">
                    <!-- Datatables -->
                    <div style="color:white;">
                        <a class="btn btn-primary pull-right mb-2" style="margin-right: 50px;" href="<?php echo site_url('Login/createuser'); ?>">

                            Create
                        </a>
                    </div>
                    <div class=" col-lg-12  " style="padding:0 60px 30px 60px;">


                        <div class="card mb-4 ">

                            <div class="table-responsive p-3">
                                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Sr no.</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Profile</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($user as $userdata) {
                                        ?>
                                            <tr>

                                                <td scope="'row"><?php echo $i++ ?></td>
                                                <td> <?php echo $userdata->name ?></td>
                                                <td><?php echo $userdata->mobile ?></td>
                                                <td><?php echo $userdata->email ?></td>
                                                <td><?php echo $userdata->gender ?></td>
                                                <td><img src="<?php echo base_url('uploads/user_images/') . $userdata->image; ?>" width="50" height="50">
                                                </td>
                                                <!-- without ajax -->
                                                <!-- <td>


                                                <? //php if ($userdata->status == 'Active') { 
                                                ?>

                                                <a href="<? //= site_url('Users/update_status?id=' . $userdata->id); 
                                                            ?>
                                                        " class="btn btn-success">Active</a>

                                                <? //php } elseif ($userdata->status == 'Pending') { 
                                                ?>
                                                <a href="<? //php echo site_url('Users/update_status?id=' . $userdata->id); 
                                                            ?>"
                                                    class="btn btn-warning">Pending</a>
                                                <? //php } elseif ($userdata->status == "Block") { 
                                                ?>
                                                <a href="<? //php echo site_url('Users/update_status?id=' . $userdata->id); 
                                                            ?>"
                                                    class="btn btn-danger">Block</a>
                                                <? //php } 
                                                ?>
                                            </td> -->

                                                <!-- with ajax -->
                                                <td>
                                                    <?php
                                                    // Assuming $userdata is your object containing user data
                                                    $status = $userdata->status;
                                                    $userid = $userdata->id;
                                                    ?>
                                                    <button class="btn btn-status <?php
                                                                                    echo ($status == 'Active') ? 'btn-success' : (($status == 'Pending') ? 'btn-warning' : 'btn-danger');
                                                                                    ?>" data-id="<?php echo $userid; ?>" data-status="<?php echo $status; ?>">
                                                        <?php echo $status; ?>
                                                    </button>
                                                </td>
                                                <td class="pt-4">
                                                    <a href="<?php echo site_url('Users/updateuser/' . $userdata->id); ?>"><i class="fas fa-user-edit pr-2 text-warning"></i></a>
                                                    <a href="<?php echo site_url('Users/deleteuser/' . $userdata->id); ?>"><i class="fas fa-trash-alt pr-2 text-danger"></i></a>
                                                    <a href="<?php echo site_url('Users/viewuser/' . $userdata->id); ?>"><i class="far fa-eye text-info"></i></i></a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php $this->load->view('logout.php') ?>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <?php $this->load->view('commonadmin/footer') ?>
    <!-- End footer -->
    <!--Row-->

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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-status').click(function() {
                var userid = $(this).data('id');
                var currentbutton = $(this);
                if (confirm("You want to update User status ???")) {

                    $.ajax({
                        url: "<?php echo site_url('Users/update_status'); ?>",
                        type: "POST",
                        data: {
                            id: userid
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if (response.status == 'success') {
                                var newstatus = response.new_status;

                                currentbutton.text(newstatus);
                                if (newstatus == 'Active') {
                                    currentbutton.removeClass('btn-warning btn-danger')
                                        .addClass(
                                            'btn-success');
                                    toastr.success('Status updated successfully');
                                } else if (newstatus == 'Pending') {
                                    currentbutton.removeClass('btn-success btn-danger')
                                        .addClass(
                                            'btn-warning');
                                    toastr.success('Status Update successfully.');
                                } else {
                                    currentbutton.removeClass('btn-success btn-warning')
                                        .addClass(
                                            'btn-danger');
                                    toastr.success('Status update successfully.');
                                }
                            } else {
                                alert('failed To update user status.');
                            }
                        },
                        error: function() {
                            alert('Error updating status.');
                        }
                    });
                }
            });
        });
    </script>





</body>

</html>