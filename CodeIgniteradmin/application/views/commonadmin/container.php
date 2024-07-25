<head>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <!-- chart css -->
    <!-- <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style> -->
</head>



<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2"></h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="<?php echo site_url('Login/all_data')  ?>" class="btn btn-label-info btn-round me-2">Manage</a>
                <a href="<?php echo site_url('Login/createuser') ?>" class="btn btn-primary btn-round">Add Customer</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <?php if ($_SESSION['role'] == 'User') : ?>
                                        <p class="card-category">Total Guest</p>
                                        <h4 class="card-title"><?php echo $totalguest; ?></h4>
                                    <?php elseif ($_SESSION['role'] == 'Admin') : ?>
                                        <p class="card-category">Total User</p>
                                        <h4 class="card-title"><?php echo $totaluser; ?></h4>
                                    <?php endif; ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <?php if ($_SESSION['role'] == 'User') : ?>
                                        <p class="card-category">Total Male</p>
                                        <h4 class="card-title"><?php echo $totalguestmale; ?></h4>
                                    <?php elseif ($_SESSION['role'] == 'Admin') : ?>
                                        <p class="card-category">Total Male</p>
                                        <h4 class="card-title"><?php echo $totalmaleuser;
                                                                ?></h4>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-luggage-cart"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <?php if ($_SESSION['role'] == 'User') : ?>
                                        <p class="card-category">Total Female</p>
                                        <h4 class="card-title"><?php echo $totalguestfemale; ?></h4>
                                    <?php elseif ($_SESSION['role'] == 'Admin') : ?>
                                        <p class="card-category">Total Female</p>
                                        <h4 class="card-title">
                                            <?php echo $totalfemaleuser;
                                            ?>
                                        </h4>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="far fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Order</p>
                                    <h4 class="card-title">576</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card card-round p-5">

                    <figure class="highcharts-figure">
                        <div class="card-title">User Statistics</div>
                        <div id="container"></div>
                        <!-- <p class="highcharts-description">
                            A basic column chart comparing estimated corn and wheat production
                            in some countries.

                            The chart is making use of the axis crosshair feature, to highlight
                            the hovered country.
                        </p> -->
                    </figure>
                    <!-- <div class="card-body">
                        <div class="chart-container" style="min-height: 375px">
                            <canvas id="user_container"></canvas>
                        </div>
                        <div id="myChartLegend"></div>
                    </div> -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Daily Sales</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-label-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Export
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-category">March 25 - April 02</div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="mb-4 mt-2">
                            <h1>$4,578.58</h1>
                        </div>
                        <div class="pull-in">
                            <canvas id="dailySalesChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card card-round">
                    <div class="card-body pb-0">
                        <div class="h1 fw-bold float-end text-primary">+5%</div>
                        <h2 class="mb-2">17</h2>
                        <p class="text-muted">Users online</p>
                        <div class="pull-in sparkline-fix">
                            <div id="lineChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">Users Geolocation</h4>
                            <div class="card-tools">
                                <button class="btn btn-icon btn-link btn-primary btn-xs">
                                    <span class="fa fa-angle-down"></span>
                                </button>
                                <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card">
                                    <span class="fa fa-sync-alt"></span>
                                </button>
                                <button class="btn btn-icon btn-link btn-primary btn-xs">
                                    <span class="fa fa-times"></span>
                                </button>
                            </div>
                        </div>
                        <p class="card-category">
                            Map of the distribution of users around the world
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive table-hover table-sales">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="<?php echo base_url(); ?>assetsadmin/img/flags/id.png" alt="indonesia" />
                                                    </div>
                                                </td>
                                                <td>Indonesia</td>
                                                <td class="text-end">2.320</td>
                                                <td class="text-end">42.18%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="<?php echo base_url(); ?>assetsadmin/img/flags/us.png" alt="united states" />
                                                    </div>
                                                </td>
                                                <td>USA</td>
                                                <td class="text-end">240</td>
                                                <td class="text-end">4.36%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="<?php echo base_url(); ?>assetsadmin/img/flags/au.png" alt="australia" />
                                                    </div>
                                                </td>
                                                <td>Australia</td>
                                                <td class="text-end">119</td>
                                                <td class="text-end">2.16%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="<?php echo base_url(); ?>assetsadmin/img/flags/ru.png" alt="russia" />
                                                    </div>
                                                </td>
                                                <td>Russia</td>
                                                <td class="text-end">1.081</td>
                                                <td class="text-end">19.65%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="<?php echo base_url(); ?>assetsadmin/img/flags/cn.png" alt="china" />
                                                    </div>
                                                </td>
                                                <td>China</td>
                                                <td class="text-end">1.100</td>
                                                <td class="text-end">20%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="<?php echo base_url(); ?>assetsadmin/img/flags/br.png" alt="brazil" />
                                                    </div>
                                                </td>
                                                <td>Brasil</td>
                                                <td class="text-end">640</td>
                                                <td class="text-end">11.63%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mapcontainer">
                                    <div id="world-map" class="w-100" style="height: 300px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card card-round">
                    <div class="card-body">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">New Customers</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-list py-4">
                            <div class="item-list">
                                <div class="avatar">
                                    <img src="<?php echo base_url(); ?>assetsadmin/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle" />
                                </div>
                                <div class="info-user ms-3">
                                    <div class="username">Jimmy Denis</div>
                                    <div class="status">Graphic Designer</div>
                                </div>
                                <button class="btn btn-icon btn-link op-8 me-1">
                                    <i class="far fa-envelope"></i>
                                </button>
                                <button class="btn btn-icon btn-link btn-danger op-8">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                            <div class="item-list">
                                <div class="avatar">
                                    <span class="avatar-title rounded-circle border border-white">CF</span>
                                </div>
                                <div class="info-user ms-3">
                                    <div class="username">Chandra Felix</div>
                                    <div class="status">Sales Promotion</div>
                                </div>
                                <button class="btn btn-icon btn-link op-8 me-1">
                                    <i class="far fa-envelope"></i>
                                </button>
                                <button class="btn btn-icon btn-link btn-danger op-8">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                            <div class="item-list">
                                <div class="avatar">
                                    <img src="<?php echo base_url(); ?>assetsadmin/img/talha.jpg" alt="..." class="avatar-img rounded-circle" />
                                </div>
                                <div class="info-user ms-3">
                                    <div class="username">Talha</div>
                                    <div class="status">Front End Designer</div>
                                </div>
                                <button class="btn btn-icon btn-link op-8 me-1">
                                    <i class="far fa-envelope"></i>
                                </button>
                                <button class="btn btn-icon btn-link btn-danger op-8">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                            <div class="item-list">
                                <div class="avatar">
                                    <img src="<?php echo base_url(); ?>assetsadmin/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle" />
                                </div>
                                <div class="info-user ms-3">
                                    <div class="username">Chad</div>
                                    <div class="status">CEO Zeleaf</div>
                                </div>
                                <button class="btn btn-icon btn-link op-8 me-1">
                                    <i class="far fa-envelope"></i>
                                </button>
                                <button class="btn btn-icon btn-link btn-danger op-8">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                            <div class="item-list">
                                <div class="avatar">
                                    <span class="avatar-title rounded-circle border border-white bg-primary">H</span>
                                </div>
                                <div class="info-user ms-3">
                                    <div class="username">Hizrian</div>
                                    <div class="status">Web Designer</div>
                                </div>
                                <button class="btn btn-icon btn-link op-8 me-1">
                                    <i class="far fa-envelope"></i>
                                </button>
                                <button class="btn btn-icon btn-link btn-danger op-8">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                            <div class="item-list">
                                <div class="avatar">
                                    <span class="avatar-title rounded-circle border border-white bg-secondary">F</span>
                                </div>
                                <div class="info-user ms-3">
                                    <div class="username">Farrah</div>
                                    <div class="status">Marketing</div>
                                </div>
                                <button class="btn btn-icon btn-link op-8 me-1">
                                    <i class="far fa-envelope"></i>
                                </button>
                                <button class="btn btn-icon btn-link btn-danger op-8">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Transaction History</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Payment Number</th>
                                        <th scope="col" class="text-end">Date & Time</th>
                                        <th scope="col" class="text-end">Amount</th>
                                        <th scope="col" class="text-end">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #10231
                                        </th>
                                        <td class="text-end">Mar 19, 2020, 2.45pm</td>
                                        <td class="text-end">$250.00</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">Completed</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/js/chart/highcharts.js"></script>

    <script>
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'User Statastic - <?php echo date('Y'); ?>',
                align: 'left'
            },
            subtitle: {
                text: 'Source: <a target="_blank" ' +
                    'href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>',
                align: 'left'
            },
            xAxis: {
                categories: ['USA', 'China', 'Brazil', 'EU', 'Argentina', 'India'],
                crosshair: true,
                accessibility: {
                    description: 'Countries'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '1000 metric tons (MT)'
                }
            },
            tooltip: {
                valueSuffix: ' (1000 MT)'
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                    name: 'Male',
                    data: [387749, 280000, 129000, 64300, 54000, 34300]
                },
                {
                    name: 'Female',
                    data: [45321, 14050, 10100, 140500, 19500, 213000]
                },
                {
                    name: 'Total',
                    data: [85321, 150000, 50000, 140500, 19500, 113500]
                }
            ]
        });
    </script>
    <!-- Highcharts -->


</div>