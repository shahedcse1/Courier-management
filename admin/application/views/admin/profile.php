<div class="page-wrapper">
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>User</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- END PAGE HEADER-->
            <div class="row">
                <br>

                <div class="cl-md-12 text-center">

                    <?php if ($role == 2): ?>
                        <div>
                            <a class="btn btn-primary" href="<?= base_url('merchant/requestlist') ?>">Your All Request List</a>
                            <a class="btn btn-success" href="<?= base_url('merchant/makerequest') ?>">Place New Order</a>
                        </div>
                    <?php endif; ?>
                </div>
                <br>

                <div class="col-md-3">
                    <!-- BEGIN PROFILE SIDEBAR -->
                    <div class="profile-sidebar">
                        <!-- PORTLET MAIN -->
                        <div class=" well">
                            <!-- SIDEBAR USERPIC -->
                            <div class="profile-userpic">
                                <img src="<?= base_url('uploads/') . $edit->image_path; ?>" class="img-responsive"
                                     width="300"
                                     alt="">
                            </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR MENU -->
                            <div class="profile-usermenu">
                                <h3> <?= $edit->name; ?></h3>
                            </div>
                            <!-- END MENU -->
                        </div>
                        <!-- END PORTLET MAIN -->
                    </div>
                </div>
                <div class="col-md-9">
                    <!-- END BEGIN PROFILE SIDEBAR -->
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="well ">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                            <br>
                                            <?php
                                            if ($this->session->userdata('update')):
                                                echo '<div class="alert alert-success fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Success Message !!! </strong> ' . $this->session->userdata('update') . '</div>' . '<br>' . '<br>';
                                                $this->session->unset_userdata('update');
                                            elseif ($this->session->userdata('notupdate')):
                                                echo '<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Failed Meaasge !!! </strong> ' . $this->session->userdata('notupdate') . '</div>';
                                                $this->session->unset_userdata('notupdate');
                                            endif;
                                            ?>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab">Change Password</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_3" data-toggle="tab">Change Image</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <!-- PERSONAL INFO TAB -->
                                            <div class="tab-pane active" id="tab_1_1">
                                                <form action="<?= base_url('profile/edit'); ?>" method="post">
                                                    <div class="form-group">
                                                        <label class="control-label">User Name</label>
                                                        <input type="hidden" name="id" value="<?= $edit->id; ?>" class="form-control"/>
                                                        <input type="text" name="name" value="<?= $edit->name; ?>" class="form-control"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Company/Page Name</label>
                                                        <input type="text" name="company_name" value="<?= $edit->company_name; ?>" class="form-control"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <input type="text" name="email" value="<?= $edit->email; ?>" class="form-control"/>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Phone</label>
                                                        <input type="text" name="phone" value="<?= $edit->phone; ?>" class="form-control"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">User Pin</label>
                                                        <input type="text" name="user_pin" id="user_pin" value="<?= $edit->user_pin; ?>" class="form-control"/>
                                                        <span id="pinval"></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Payment type</label>
                                                        <select   name="payment_type"id="payment_type" class="form-control"  >
                                                            <option value="">--Select--</option>
                                                            <option value="1"<?php if ($edit->payment_type == 1): ?>selected<?php endif; ?>>bKash</option>
                                                            <option value="2"<?php if ($edit->payment_type == 2): ?>selected<?php endif; ?>>Rocket</option>
                                                            <option value="3" <?php if ($edit->payment_type == 3): ?>selected<?php endif; ?>>Bank Account</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">payment Account no.</label>
                                                        <input type="text"
                                                               style="color: black;"
                                                               name="account_no"
                                                               id="account_no"value="<?= $edit->account_no; ?>" 
                                                               placeholder="your bkash/Rocket/Bank Ac. No ."
                                                               class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Address</label>
                                                        <textarea class="form-control" name="address" rows="3"> <?= $edit->address; ?></textarea>
                                                    </div>
                                                    <div class="margiv-top-10  pull-right">
                                                        <button type="submit" class="btn btn-primary" id="submitpin">Update Info</button>
                                                    </div>
                                                    <br><br>
                                                </form>
                                            </div>
                                            <!-- END PERSONAL INFO TAB -->
                                            <!-- CHANGE PASSWORD TAB -->
                                            <div class="tab-pane" id="tab_1_2">
                                                <form class="cmxform form-horizontal tasi-form"
                                                      action="<?= base_url('profile/updatePassword'); ?>" method="post">
                                                    <div class="form-group">
                                                        <label class="control-label">Current Password</label>
                                                        <input type="password" name="cpassword" id="cpassword" class="form-control"/>
                                                        <span id="update_cpassword"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">New Password</label>
                                                        <input type="password"  name="npassword" id="npassword" class="form-control"/>
                                                        <span id="update_npassword"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Re-type New Password</label>
                                                        <input type="password" name="rpassword" id="rpassword" class="form-control"/>
                                                        <span id="update_rpassword"></span>
                                                    </div>
                                                    <div class="margin-top-10">
                                                        <button type="submit" id="submit"
                                                                class="btn btn-success"
                                                                onclick="return updatePassword()">
                                                            Update Password
                                                        </button>
                                                        <button type="reset"
                                                                class="btn btn-danger">Clear
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END CHANGE PASSWORD TAB -->
                                            <!-- CHANGE image TAB -->
                                            <div class="tab-pane" id="tab_1_3">
                                                <form class="cmxform form-horizontal tasi-form"
                                                      action="<?= base_url('profile/updateimage'); ?>" method="post" enctype="multipart/form-data">
                                                    <div class="form-group col-md-12">
                                                        <input type="file"  name="fileToUpload" id="image">
                                                        <div>
                                                            <?php if (isset($error)) echo $error; ?>
                                                        </div>
                                                    </div>
                                                    <div class="margin-top-10">
                                                        <button type="submit" class="btn btn-success">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END CHANGE image TAB -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE CONTENT -->
                </div>
            </div>
        </div>
        <script src="<?= base_url('assets/js/custom/userinfo.js'); ?>" type="text/javascript"></script>
        <!-- END CONTENT BODY -->
    </div>

