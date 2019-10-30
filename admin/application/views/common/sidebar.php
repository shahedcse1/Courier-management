<style>
    .page-sidebar .page-sidebar-menu .sub-menu > li > a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu .sub-menu > li > a {
        color: #0f0e0f;
    }
    .page-sidebar .page-sidebar-menu .sub-menu > li > a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu .sub-menu > li > a {
        color: #fff;
    }
</style>
<div class="page-sidebar-wrapper" >
    <div class="page-sidebar navbar-collapse collapse" >
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="margin-top: 30px; margin-left: 10px;background-color:  #9bccd7; color:#fff;">
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <!-- Dashboard -->
            <li class="nav-item start <?= $active_menu == 'dashboard' ? 'active open' : ''; ?>">
                <a href="<?= base_url('dashboard'); ?>" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
            <?php if (in_array($this->session->userdata('user_role'), array(1, 3, 4))) : ?>
                <li class="nav-item start <?= $active_menu == 'requestlist' ? 'active open' : ''; ?>">
                    <a href="<?= base_url('merchant/requestlist'); ?>" class="nav-link">
                        <i class="icon-bag"></i>
                        <span class="title">All Request</span>
                        <span class="selected"></span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (in_array($this->session->userdata('user_role'), array(1, 3))) : ?>
                <li class="nav-item start <?= $active_menu == 'admin' ? 'active open' : ''; ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-user"></i>
                        <span class="title">Admin</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item start <?= $sub_menu == 'userinfo' ? 'active open' : ''; ?>">
                            <a href="<?= base_url('userinfo'); ?>" class="nav-link nav-toggle">
                                <i class=""></i>
                                <span class="title">User Info</span>
                            </a>
                        </li>

                        <li class="nav-item start <?= $sub_menu == 'services' ? 'active open' : ''; ?>">
                            <a href="<?= base_url('services'); ?>" class="nav-link nav-toggle">
                                <i class=""></i>
                                <span class="title">Our Services</span>
                            </a>
                        </li>
                        <li class="nav-item start <?= $sub_menu == 'staff' ? 'active open' : ''; ?>">
                            <a href="<?= base_url('staffs'); ?>" class="nav-link nav-toggle">
                                <i class=""></i>
                                <span class="title">Our Staff</span>
                            </a>
                        </li>
                        <li class="nav-item start <?= $sub_menu == 'merchant' ? 'active open' : ''; ?>">
                            <a href="<?= base_url('userinfo/allmerchant'); ?>" class="nav-link nav-toggle">
                                <i class=""></i>
                                <span class="title">All Merchant</span>
                            </a>
                        </li>


                    </ul>
                </li>
            <?php endif; ?>

            <?php if (in_array($this->session->userdata('user_role'), [1, 5])) : ?>
                <li class="nav-item start <?= $active_menu == 'accounts' ? 'active open' : ''; ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-calculator"></i>
                        <span class="title">Accounts</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item start <?= $sub_menu == 'vouchar' ? 'active open' : ''; ?>">
                            <a href="<?= base_url('accounts/vouchar') ?>" class="nav-link nav-toggle">
                                <i class=""></i>
                                <span class="title">Voucher</span>
                            </a>
                        </li>

                        <li class="nav-item start <?= $sub_menu == 'payable' ? 'active open' : ''; ?>">
                            <a href="<?= base_url('accounts/payable') ?>" class="nav-link nav-toggle">
                                <i class=""></i>
                                <span class="title">Accounts payable</span>
                            </a>
                        </li>

                        <li class="nav-item start <?= $sub_menu == 'receivable' ? 'active open' : ''; ?>">
                            <a href="<?= base_url('accounts/receivable') ?>" class="nav-link nav-toggle">
                                <i class=""></i>
                                <span class="title">Accounts Receivable</span>
                            </a>
                        </li>
                        <li class="nav-item start <?= $sub_menu == 'additionalcost' ? 'active open' : ''; ?>">
                            <a href="<?= base_url('accounts/additionalcost') ?>" class="nav-link nav-toggle">
                                <i class=""></i>
                                <span class="title">Additional Costs</span>
                            </a>
                        </li>
                        <?php if (in_array($this->session->userdata('user_role'), [1])) : ?>
                            <li class="nav-item start <?= $sub_menu == 'profit' ? 'active open' : ''; ?>">
                                <a href="<?= base_url('accounts/profitanalysis') ?>" class="nav-link nav-toggle">
                                    <i class=""></i>
                                    <span class="title">Profit Analysis</span>
                                </a>
                            </li>

                            <li class="nav-item start <?= $sub_menu == 'transaction' ? 'active open' : ''; ?>">
                                <a href="<?= base_url('accounts/transaction') ?>" class="nav-link nav-toggle">
                                    <i class=""></i>
                                    <span class="title">Transaction Details</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php if (in_array($this->session->userdata('user_role'), [1])) : ?>
                    <li class="nav-item start <?= $active_menu == 'settings' ? 'active open' : ''; ?>">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-settings"></i>
                            <span class="title">Settings</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item start <?= $sub_menu == 'zone' ? 'active open' : ''; ?>">
                                <a href="<?= base_url('settings/zone') ?>" class="nav-link nav-toggle">
                                    <i class=""></i>
                                    <span class="title">Zone</span>
                                </a>
                            </li>

                            <li class="nav-item start <?= $sub_menu == 'area' ? 'active open' : ''; ?>">
                                <a href="<?= base_url('settings/area') ?>" class="nav-link nav-toggle">
                                    <i class=""></i>
                                    <span class="title">Area</span>
                                </a>
                            </li>
                            <li class="nav-item start">
                                <a href="<?= base_url('backup'); ?>" class="nav-link nav-toggle">
                                    <i class=""></i>
                                    <span class="title">Data backup</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (in_array($this->session->userdata('user_role'), [2])) : ?>

                <li class="nav-item start <?= $active_menu == 'new' ? 'active open' : ''; ?>">
                    <a href="<?= base_url('merchant/makerequest'); ?>" class="nav-link">
                        <i class="icon-settings"></i>
                        <span class="title">Add New Request</span>
                        <span class="selected"></span>
                    </a>
                </li>

                <li class="nav-item start <?= $active_menu == 'merchant' ? 'active open' : ''; ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-bag"></i>
                        <span class="title">Merchant</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item start <?= $sub_menu == 'request' ? 'active open' : ''; ?>">
                            <a href="<?= base_url('merchant/requestlist'); ?>" class="nav-link nav-toggle">
                                <i class=""></i>
                                <span class="title"> <i class="icon-control-play"></i>Request List</span>
                            </a>
                        </li>
    <!--                        <li class="nav-item start <?= $sub_menu == 'tracking' ? 'active open' : ''; ?>">
                            <a href="#" class="nav-link nav-toggle">
                                <i class=""></i>
                                <span class="title"> <i class="icon-control-play"></i>Product Tracking</span>
                            </a>
                        </li>-->
                        <li class="nav-item start <?= $sub_menu == 'complain' ? 'active open' : ''; ?>">
                            <a href="<?= base_url('merchant/complainlist'); ?>" class="nav-link nav-toggle">
                                <i class=""></i>
                                <span class="title"> <i class="icon-control-play"></i>Complain</span>
                            </a>
                        </li>
                        <li class="nav-item start <?= $sub_menu == 'receivable' ? 'active open' : ''; ?>">
                            <a href="<?= base_url('accounts/receivable') ?>" class="nav-link nav-toggle">
                                <i class=""></i>
                                <span class="title"><i class="icon-control-play"></i>Accounts Receivable</span>
                            </a>
                        </li>

                    </ul>
                </li>

            <?php endif; ?>
            <li class="nav-item start">
                <a href="<?= base_url('profile'); ?>" class="nav-link">
                    <i class="icon-user-follow"></i>
                    <span class="title">Update my profile</span>
                    <span class="selected"></span>
                </a>
            </li>
            <?php if (in_array($this->session->userdata('user_role'), [1, 2, 3, 4])) : ?>
                <li class="nav-item start <?= $active_menu == 'complainlist' ? 'active open' : ''; ?>">
                    <a href="<?= base_url('merchant/complainlist'); ?>" class="nav-link">
                        <i class="icon-anchor"></i>
                        <span class="title">All Complain</span>
                        <span class="selected"></span>
                    </a>
                </li>
            <?php endif; ?>

            <li class="nav-item start">
                <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
                    <i class="icon-key"></i>
                    <span class="title">Log Out</span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->