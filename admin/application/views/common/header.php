<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?= $title; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Fav icons -->
        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= base_url('assets/img/favicons/apple-touch-icon-57x57.png'); ?>" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= base_url('assets/img/favicons/apple-touch-icon-114x114.png'); ?>" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= base_url('assets/img/favicons/apple-touch-icon-72x72.png'); ?>" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= base_url('assets/img/favicons/apple-touch-icon-144x144.png'); ?>" />
        <link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?= base_url('assets/img/favicons/apple-touch-icon-60x60.png'); ?>" />
        <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?= base_url('assets/img/favicons/apple-touch-icon-120x120.png'); ?>" />
        <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?= base_url('assets/img/favicons/apple-touch-icon-76x76.png'); ?>" />
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?= base_url('assets/img/favicons/apple-touch-icon-152x152.png'); ?>" />
        <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicons/favicon-196x196.png'); ?>" sizes="196x196" />
        <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicons/favicon-96x96.png'); ?>" sizes="96x96" />
        <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicons/favicon-32x32.png'); ?>" sizes="32x32" />
        <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicons/favicon-16x16.png'); ?>" sizes="16x16" />
        <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicons/favicon-128.png'); ?>" sizes="128x128" />
        <meta name="application-name" content="&nbsp;"/>
        <meta name="msapplication-TileColor" content="#FFFFFF" />
        <meta name="msapplication-TileImage" content="<?= base_url('assets/img/favicons/mstile-144x144.png'); ?>" />
        <meta name="msapplication-square70x70logo" content="<?= base_url('assets/img/favicons/mstile-70x70.png'); ?>" />
        <meta name="msapplication-square150x150logo" content="<?= base_url('assets/img/favicons/mstile-150x150.png'); ?>" />
        <meta name="msapplication-wide310x150logo" content="<?= base_url('assets/img/favicons/mstile-310x150.png'); ?>" />
        <meta name="msapplication-square310x310logo" content="<?= base_url('assets/img/favicons/mstile-310x310.png'); ?>" />

        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->

        <link href="<?= base_url('assets/scrollbarStyling.css'); ?>" rel="stylesheet" type="text/css" />

        <link href="<?= base_url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/global/plugins/morris/morris.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/global/plugins/fullcalendar/fullcalendar.min.css'); ?>" rel="stylesheet" type="text/css" />

        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?= base_url('assets/global/plugins/datatables/datatables.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?= base_url('assets/global/css/components.min.css'); ?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?= base_url('assets/global/css/plugins.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?= base_url('assets/layouts/layout/css/layout.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/layouts/layout/css/themes/darkblue.min.css'); ?>" rel="stylesheet" type="text/css" id="style_color" />

        <link href="<?= base_url('assets/layouts/layout/css/custom.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->

        <!-- Asset Management -->
        <?= load_assets('css'); ?>
        <!--end::Base Styles -->

        <!--[if lt IE 9]>
        <script src="<?= base_url('assets/global/plugins/respond.min.js'); ?>"></script>
        <script src="<?= base_url('assets/global/plugins/excanvas.min.js'); ?>"></script>
        <script src="<?= base_url('assets/global/plugins/ie8.fix.min.js'); ?>"></script>
        <![endif]-->

        <script src="<?= base_url('assets/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/js/sweetalert.min.js'); ?>" type="text/javascript"></script>
    </head>

    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="<?= base_url(); ?>">
                            <img src="<?= base_url('uploads/logo.jpg'); ?>" width="70px;"height="35px;" alt="logo" class="logo-default" /> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->


                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->

                            <!-- END TODO DROPDOWN -->
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="<?= base_url('uploads/').$this->session->userdata('image_path');?>" />
                                    <span class="username username-hide-on-mobile"><?= $this->session->userdata('user_name');?></span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="<?= base_url('profile');?>">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('auth/logout'); ?>">
                                            <i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">