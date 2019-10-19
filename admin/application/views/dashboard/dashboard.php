<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="" style="text-decoration: none;">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Dashboard</span>
                </li>
            </ul>
        </div>
        <center>
            <h1 style="color:green"><b>Welcome <?= $user_name ?> To Parcel Xpress BD</b></h1>
        </center>
        <?php if ($roleId == 2): ?>
            <div class="cl-md-12 text-center">
                <div>
                    <a class="btn btn-danger" href="<?= base_url('accounts/vouchar') ?>">Accounts Voucher </a>
                    <a class="btn btn-primary" href="<?= base_url('merchant/requestlist') ?>">Your All Request List</a>
                    <a class="btn btn-success" href="<?= base_url('merchant/makerequest') ?>">Place New Order</a>
                </div><br>
            </div>
        <?php endif; ?>

        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="<?= base_url('merchant/requestlist/1') ?>">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="1349"><?= $pending; ?></span>
                        </div>
                        <div class="desc">Pending</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="<?= base_url('merchant/requestlist/2') ?>">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="12,5"><?= $inProgress; ?></span>
                        </div>
                        <div class="desc">In-progress</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" href="<?= base_url('merchant/requestlist/4') ?>">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="549"><?= $inHouse; ?></span>
                        </div>
                        <div class="desc">In-house</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green-seagreen " href="<?= base_url('merchant/requestlist/6') ?>">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="549"><?= $outfordelivery; ?></span>
                        </div>
                        <div class="desc">Out For Delivery</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="<?= base_url('merchant/requestlist/7') ?>">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="12,5"><?= $customercanceled; ?></span>
                        </div>
                        <div class="desc">Canceled by Customer</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="<?= base_url('merchant/requestlist/5') ?>">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="89"><?= $delivered; ?></span>
                        </div>
                        <div class="desc">Delivered</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6" style="border: 1px solid black">
                    <div id="dailychart" style="min-width: 310px; height: 345px; max-width: 500px; margin: 0 auto"></div>
                </div>
                <div class="col-md-6" style="border: 1px solid black" >
                    <div id="container" style="min-width: 310px; height: 320px; max-width: 500px; margin: 0 auto"></div>
                    <button id="plain">Plain</button>
                    <button id="inverted">Inverted</button>
                    <button id="polar">Polar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/highcharts/highcharts.js') ?>"></script>
    <script src="<?= base_url('assets/highcharts/exporting.js') ?>"></script>
    <script src="<?= base_url('assets/highcharts/export-data.js') ?>"></script>
    <script src="<?= base_url('assets/highcharts/highcharts-more.js') ?>"></script>
    <div class="modal fade fade modal-auto-clear" id="voucharmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header table-background">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                    Vouchar alert.
                </div>
                <div class="modal-body col-md-12">
                    <h1>Hello dear,You have <?= $newvouchar; ?> new Invoice vouchar from parcel xpress BD.Please check it</h1><br>
                    <center>
                        <a class="btn btn-danger" href="<?= base_url('accounts/vouchar') ?>">Accounts Voucher   (<?= $newvouchar; ?>) </a>
                    </center>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
<?php if ($roleId == 2 && !empty($newvouchar)): ?>
            $(document).ready(function() {
                $('#voucharmodal').modal('show');
            });
<?php endif; ?>
        var chart = Highcharts.chart('container', {
            title: {
                text: 'Month Wise Total Delivery'
            },
            subtitle: {
                text: 'Plain'
            },
            xAxis: {
                categories: [<?php foreach ($period as $p): ?> '<?= $p ?>', <?php endforeach; ?>]
            },
            series: [{
                    type: 'column',
                    colorByPoint: true,
                    data: [<?= implode(',', $totaldata) ?>],
                    showInLegend: false
                }]

        });


        $('#plain').click(function() {
            chart.update({
                chart: {
                    inverted: false,
                    polar: false
                },
                subtitle: {
                    text: 'Plain'
                }
            });
        });

        $('#inverted').click(function() {
            chart.update({
                chart: {
                    inverted: true,
                    polar: false
                },
                subtitle: {
                    text: 'Inverted'
                }
            });
        });

        $('#polar').click(function() {
            chart.update({
                chart: {
                    inverted: false,
                    polar: true
                },
                subtitle: {
                    text: 'Polar'
                }
            });
        });


        Highcharts.chart('dailychart', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Todays All Request Status'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    showInLegend: true,
                    data: [{
                            name: 'Pending',
                            y: <?= $todayPendingInPercent; ?>
                        }, {
                            name: 'In-progress',
                            y: <?= $todayInProgressInPercent; ?>
                        }, {
                            name: 'In-house',
                            y: <?= $todayInHouseInPercent; ?>
                        }, {
                            name: 'Out For Delivery',
                            y: <?= $todayoutfordeliverypercent; ?>
                        }, {
                            name: 'Delivered',
                            y: <?= $todayDeliveredInPercent; ?>
                        }]
                }]
        });
    </script>





