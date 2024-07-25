<!DOCTYPE html>
<html>

<head>
    <title><?= $page_title; ?></title>
    <?php $this->load->view('common/inner-header'); ?>
    <link href="<?php echo base_url(); ?>assets/css/chart/style.css" rel="stylesheet" />
</head>

<body>
    <div class="container-fluid">
        <!-- Container start -->
        <div class="row" id="menu-row">
            <!-- first row start-->
            <?php $this->load->view('common/navigation'); ?>
        </div><!-- first row end-->
        <div class="row">
            <!-- second row start-->
            <div class="col-md-2 col-sm-2 col-xs-12 example-navbar-collapse content height dash-height">
                <!-- Left Pannel start -->
                <?php $this->load->view('common/left-panel'); ?>
            </div><!-- Left Pannel End -->
            <div class="col-md-10 col-sm-10 col-xs-12 col-lg-10 height">
                <!-- Right Pannel start -->
                <div>
                    <h2><?= $screen; ?></h2>
                    <hr />
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-10  dash star">
                        <i class="glyphicon glyphicon-star iconsize"></i>
                        <p>Total Guests [<?= $totalguests; ?>]</p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-10 dash king">
                        <i class="glyphicon glyphicon-king iconsize"></i>
                        <p>Total Male Guests [<?= $maleguests; ?>]</p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-10 dash queen">
                        <i class="glyphicon glyphicon-queen iconsize"></i>
                        <p>Total Female Guests [<?= $femaleguests; ?>]</p>
                    </div>
                    <?php if ($this->session->userdata('role') == 'superadmin') { ?>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-10 dash users">
                        <i class="fa fa-users iconsize"></i>
                        <p>Total Users [<?= $totalusers; ?>]</p>
                    </div>
                    <?php } ?>
                </div> <br />
                <div class="row">
                    <div class="col">
                        <figure class="highcharts-figure">
                            <div id="guest_container"></div>

                        </figure>
                    </div>
                    <?php if ($this->session->userdata('role') == "Admin") { ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <figure class="highcharts-figure">
                            <div id="user_container"></div>
                        </figure>
                    </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Latest 5 Male Guests</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered datatablelist">
                                        <thead>
                                            <tr>
                                                <th>SR No.</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
											foreach ($maleguest as $malerecords) { ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?= $malerecords->name; ?></td>
                                                <td><?= $malerecords->address; ?></td>
                                                <td>
                                                    <?php if ($malerecords->status == "Active") { ?>
                                                    <span
                                                        class="label label-success"><?= $malerecords->status; ?></span>
                                                    <?php } else if ($malerecords->status == "Block") { ?>
                                                    <span class="label label-danger"><?= $malerecords->status; ?></span>
                                                    <?php } else { ?>
                                                    <span
                                                        class="label label-warning"><?= $malerecords->status; ?></span>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php $i++;
											} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--First table Ends -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <!--second table Start -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Latest 5 Female Guests</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered datatablelist">
                                        <thead>
                                            <tr>
                                                <th>SR No.</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $j = 1;
											foreach ($femaleguest as $femalerecord) { ?>
                                            <tr>
                                                <td><?php echo $j; ?></td>
                                                <td><?= $femalerecord->name; ?></td>
                                                <td><?= $femalerecord->address; ?></td>
                                                <td>
                                                    <?php if ($femalerecord->status == "Active") { ?>
                                                    <span
                                                        class="label label-success"><?= $femalerecord->status; ?></span>
                                                    <?php } else if ($femalerecord->status == "Block") { ?>
                                                    <span
                                                        class="label label-danger"><?= $femalerecord->status; ?></span>
                                                    <?php } else { ?>
                                                    <span
                                                        class="label label-warning"><?= $femalerecord->status; ?></span>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php $j++;
											} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php if ($this->session->userdata('role') == 'Admin') { ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <!--second table Start -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Latest 5 Active Users</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered datatablelist">
                                        <thead>
                                            <tr>
                                                <th>SR No.</th>
                                                <th>Name</th>
                                                <th>Email Address</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $a = 1;
												foreach ($activeusers as $activerecord) { ?>
                                            <tr>
                                                <td><?= $a; ?></td>
                                                <td><?= $activerecord->name; ?></td>
                                                <td><?= $activerecord->email_address; ?></td>
                                                <td>
                                                    <?php if ($activerecord->status == "Active") { ?>
                                                    <span
                                                        class="label label-success"><?= $activerecord->status; ?></span>
                                                    <?php  }  ?>
                                                </td>
                                            </tr>
                                            <?php $a++;
												} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <!--second table Start -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Latest 5 Block Users</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered datatablelist">
                                        <thead>
                                            <tr>
                                                <th>SR No.</th>
                                                <th>Name</th>
                                                <th>Email Address</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $b = 1;
												foreach ($blockusers as $blockrecord) { ?>
                                            <tr>
                                                <td><?= $b; ?></td>
                                                <td><?= $blockrecord->name; ?></td>
                                                <td><?= $blockrecord->email_address; ?></td>
                                                <td>
                                                    <?php if ($blockrecord->status == "Block") { ?>
                                                    <span class="label label-danger"><?= $blockrecord->status; ?></span>
                                                    <?php  }  ?>
                                                </td>
                                            </tr>
                                            <?php $b++;
												} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <!--second table Start -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Latest 5 Pending Users</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered datatablelist">
                                        <thead>
                                            <tr>
                                                <th>SR No.</th>
                                                <th>Name</th>
                                                <th>Email Address</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $c = 1;
											foreach ($pendingusers as $pendingrecord) { ?>
                                            <tr>
                                                <td><?= $c; ?></td>
                                                <td><?= $pendingrecord->name; ?></td>
                                                <td><?= $pendingrecord->email_address; ?></td>
                                                <td>
                                                    <?php if ($pendingrecord->status == "Pending") { ?>
                                                    <span
                                                        class="label label-warning"><?= $pendingrecord->status; ?></span>
                                                    <?php  }  ?>
                                                </td>
                                            </tr>
                                            <?php $c++;
											} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div><!-- Right Pannel End -->
        </div> <!-- second row end-->
        <!--Footer Start-->
        <div class="row">
            <!-- Footer Start  -->
            <?php $this->load->view('common/footer') ?>
        </div> <!-- Footer End  -->
    </div>
    <?php $this->load->view('common/script'); ?>
    <script>
    $("document").ready(function() {
        $('.datatablelist').DataTable();
    });
    </script>
    <script src="<?php echo base_url(); ?>assets/js/chart/highcharts.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/chart/exporting.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/chart/export-data.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/chart/accessibility.js"></script>
    <script>
    Highcharts.chart('guest_container', {

        chart: {
            type: 'area'
        },
        title: {
            text: 'Guests Stats - <?= date('Y'); ?> '
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Guests',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: '',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Total Guests',
            data: [<?= $totalguestchart; ?>]
        }, {
            name: 'Male Guest',
            data: [<?= $maleguestchart ?>]
        }, {
            name: 'Female Guest',
            data: [<?= $femaleguestchart ?>]
        }]
    });
    </script>
    <script>
    Highcharts.chart('user_container', {
        chart: {
            type: 'area'
        },
        title: {
            text: 'Users Stats - <?= date('Y'); ?> '
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Users',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: '',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Total Users',
            data: [<?= $totaluserchart; ?>]
        }, {
            name: 'Active Users',
            data: [<?= $activeuserchart; ?>]
        }, {
            name: 'Block Users',
            data: [<?= $blockuserchart; ?>]
        }, {
            name: 'Pending User',
            data: [<?= $pendinguserchart; ?>]
        }]
    });
    </script>
</body>

</html>