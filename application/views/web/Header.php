<head>
    <title><?= $page_title; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/logo/logo-black.png') ?>">

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

    <!-- Bootstrap Css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/bootstrap-3.3.6/css/bootstrap.min.css') ?>">
    <!-- Bootstrap Select Css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/bootstrap-select-1.10.0/dist/css/bootstrap-select.min.css') ?>">
    <!-- Fonts Css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/fontawesome-free-5.5.0-web/css/all.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/font-elegant/elegant.css'); ?>">
    <!-- OwlCarousel2 Slider Css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/owl.carousel.2/assets/owl.carousel.css'); ?>">

    <!-- Animate Css -->       
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/animate.css') ?>">

    <!-- Main Css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/theme.css') ?>">

    <!-- Asset Management -->
    <?= load_assets('css'); ?>
    <!--end::Base Styles -->

    <!-- Main Jquery JS -->
    <script src="<?= base_url('assets/js/jquery-2.2.4.min.js') ?>" type="text/javascript"></script>

    <!--[if lt IE 9]>
    <script src="<?= base_url('assets/plugins/iesupport/html5shiv.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/iesupport/respond.js') ?>"></script>
    <![endif]-->
    <style>
        a:hover {
            color: green;
        }
        .sign-in:hover,
        .sign-in:visited,
        .sign-in:focus {
            color: #fff;
        }
        .content {
            padding: 16px;
        }

        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10;
        }

        .sticky + .content {
            padding-top: 102px;
        }
    </style>
</head>

<!--<div id="preloader">
    <div class="small1">
        <div class="small ball smallball1"></div>
        <div class="small ball smallball2"></div>
        <div class="small ball smallball3"></div>
        <div class="small ball smallball4"></div>
    </div>
    <div class="small2">
        <div class="small ball smallball5"></div>
        <div class="small ball smallball6"></div>
        <div class="small ball smallball7"></div>
        <div class="small ball smallball8"></div>
    </div>

    <div class="bigcon">
        <div class="big ball"></div>
    </div>
</div> -->
<div id="preloader">

    <div class="small2">
        <img  src="<?= base_url('assets/img/logo/logo-black.png'); ?>" />
    </div>

    <div class="bigcon">
        <div class="big ball"></div>
    </div>
</div> 

<header class="header-main"id="myHeader">
    <div class="top-bar font2-title1 white-clr">
        <div class="theme-container container">
            <div class="row">
                <div class="col-md-6 col-sm-5">
                    <ul class="list-items fs-10">
                        <li><a href="<?= base_url('services'); ?>">Services</a></li>
                        <li><a href="<?= base_url('contact'); ?>">Contact</a></li>
                        <li><a  target="_blank"  href="<?= base_url('home/register'); ?>">Sign Up</a></li>
                    </ul>

                </div>

                <div class="col-md-6 col-sm-7 fs-12">
                    <p class="contact-num"> <img height="20" width="20" src="<?= base_url('assets/img/icons/5a452570546ddca7e1fcbc7d.png') ?>" /> Call us now: <span class="theme-clr" style="color: #FAD91B;"> +880-1842775001 </span> </p>
                </div>
            </div>
        </div>
        <a data-toggle="modal" href="#login-popup" style="background-color: #03a84e;" class="sign-in fs-12 theme-clr-bg">Login</a>
    </div>
    <!-- /.Header Topbar -->

    <!-- Header Logo & Navigation -->
    <nav class="menu-bar font2-title1" >
        <div class="theme-container container">
            <div class="row">
                <div class="col-md-2 col-sm-2">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-logo" href="<?= base_url(); ?>"> <img  height="58" width="95" src="<?= base_url('assets/img/logo/logo-black.png'); ?>" alt="logo" /> </a>
                </div>
                <div class="col-md-10 col-sm-10 fs-12">
                    <div id="navbar" class="collapse navbar-collapse no-pad">
                        <ul class="navbar-nav theme-menu">
                            <li><a href="<?= base_url(); ?>">Home</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" >About</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= base_url('about'); ?>">About Us</a></li>
                                    <li><a href="<?= base_url('about/team'); ?>">Our Team</a></li>

                                </ul>
                            </li>
                            <li><a href="<?= base_url('tracking'); ?>">Tracking</a></li>
                            <li><a href="<?= base_url('services'); ?>">Services</a></li>
                            <li><a href="<?= base_url('pricing'); ?>">Our Pricing</a></li>
                            <li><a href="<?= base_url('contact'); ?>">Contact</a></li>

                        </ul>                                                      
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- /.Header Logo & Navigation -->

</header>


