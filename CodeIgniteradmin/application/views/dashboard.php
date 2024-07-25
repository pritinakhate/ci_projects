<head>
    <?php
    $this->load->view('common/head.php')
    ?>
</head>

<body style="margin:0;" id="page-top ">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php $this->load->view('commonadmin/sidenav.php') ?>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <?php $this->load->view('common/topnav.php') ?>
                <!-- Topbar -->


                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>
                    <!-- cards Row start-->
                    <?php $this->load->view('common/cards.php')      ?>
                    <!-- cards Row end-->



                    <!-- Modal Logout -->
                    <?php $this->load->view('logout.php') ?>

                </div>
                <!---Container Fluid-->
            </div>
            <!-- Footer -->
            <?php $this->load->view('common/footer.php') ?>
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php $this->load->view('common/script.php') ?>
</body>

</html>