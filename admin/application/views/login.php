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
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?= base_url('assets/global/plugins/select2/css/select2.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('assets/global/plugins/select2/css/select2-bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?= base_url('assets/global/css/components.min.css'); ?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?= base_url('assets/global/css/plugins.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?= base_url('assets/pages/css/login-2.min.css'); ?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />
        <style>
            .logbody{
                background-color: #1B2757;
                padding: 40px;
               
            }
            .title{
                font-weight: 700;
                color: #fff;
            }
            .loginpage{
                margin-top:170px;
            }

        </style>
    </head>
    <!-- END HEAD -->
    <body>
        <div class="col-md-6 col-md-offset-3 loginpage" >
            <div class="content">
                <!-- BEGIN LOGIN FORM -->
                <form class="login-form" action="<?= base_url('auth/login'); ?>" method="post" >
                    <div class="col-md-8 col-md-offset-1 logbody" style="border: 1px solid black;">
                        <div class="form-title text-center">
                            <h3 class="title">Parcel xpress BD Login</h3>
                            <img src="<?= base_url('assets/pages/img/logo-black.png'); ?>" width="100" height="60">
                        </div>
                        <?php if ($this->session->userdata('login_error')): ?>
                            <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                <span> <?=
                                    $this->session->userdata('login_error');
                                    $this->session->unset_userdata('login_error');
                                    ?> </span>
                            </div>
                        <?php endif; ?>
                        <br>
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            <span> Enter your user Name and password. </span>
                        </div>
                        <div class="form-group">
                            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                            <label class="control-label visible-ie8 visible-ie9">User Name</label>
                            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="User Name" name="userpin"/> </div>
                        <div class="form-group">
                            <label class="control-label visible-ie8 visible-ie9">Password</label>
                            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/> </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-block uppercase">Login</button>
                        </div>
                    </div>
                </form>
                <!-- END LOGIN FORM -->

            </div>
            <div class="copyright hide"> </div>
            <!-- END LOGIN -->
        </div>
    </body>
</html>