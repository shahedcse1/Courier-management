<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">User Information</div>
                    </div>
                    <div class="portlet-body">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-toggle="modal"
                                    data-target="#addModal">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                Add User
                            </button>
                        </div>
                        <br><br>
                        <?php
                        if ($this->session->userdata('add')):
                            echo '<div class="alert alert-success fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Success Message !!! </strong> ' . $this->session->userdata('add') . '</div>' . '<br>' . '<br>';
                            $this->session->unset_userdata('add');

                        elseif ($this->session->userdata('edit')):
                            echo '<div class="alert alert-success fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Success Message !!! </strong> ' . $this->session->userdata('edit') . '</div>' . '<br>' . '<br>';
                            $this->session->unset_userdata('edit');
                        elseif ($this->session->userdata('notadd')):
                            echo '<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Failed Meaasge !!! </strong> ' . $this->session->userdata('notadd') . '</div>';
                            $this->session->unset_userdata('notadd');
                        endif;
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet ">
                                    <div class="portlet-body">
                                         <table class="table table-striped table-bordered table-hover text-center"
                                               id="sample_1">
                                            <thead class="table-background">
                                            <tr>
                                                <th class="text-center">Action</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">User Pin</th>
                                                <th class="text-center">Phone</th>
                                                <th class="text-center">Address</th>
                                                <th class="text-center">Role</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Option</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (isset($users)): ?>
                                                <?php foreach ($users as $user):
                                                    ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <button class="editmodal btn btn-primary btn-circle  btn-xs"
                                                                    onclick="edituser(<?= $user->id; ?>);">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                            <button class="item_delete btn-circle btn btn-danger btn-xs"
                                                                    value="<?= $user->id; ?>">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                        <td><?= $user->name; ?></td>
                                                        <td><?= $user->user_pin; ?></td>
                                                        <td><?= $user->phone; ?></td>
                                                        <td><?= $user->address; ?></td>
                                                        <td><?= $user->role_name; ?></td>
                                                        <td><?= $user->status == '1' ? "Active" : "Inactive"; ?></td>
                                                        <td>
                                                            <a href="<?= base_url('uploads/') . $user->image_path; ?>"
                                                               target="_blank"><?php echo $user->image_path; ?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <button class=" btn btn-primary btn-xs"
                                                                    onclick="passresetmodal(<?= $user->id; ?>);">
                                                                ChangePassword
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;
                                            endif; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- New User Modal Start-->
                                    <form action="<?= base_url('userinfo/adduser'); ?>" method="post"
                                          enctype="multipart/form-data">
                                        <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header table-background">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h4 class="modal-title" id="myModalLabel">New User</h4>
                                                    </div>
                                                    <div class="modal-body col-md-12">
                                                        <div class="col-sm-12" style="margin-bottom: 10px;display: none;" id="addUserMessage">
                                                            <div class="col-sm-12">
                                                                <span class="text-danger" id="alertMsg"></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <div class="form-group col-md-4">
                                                                <label for="newName">Name</label>
                                                                <input type="text"
                                                                       class="form-control"
                                                                       name="name"
                                                                       id="newName"
                                                                       required>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="newCompanyName">Company/Page name</label>
                                                                <input type="text"
                                                                       class="form-control"
                                                                       id="newCompanyName"
                                                                       name="company_name">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="newEmail">Email</label>
                                                                <input type="text"
                                                                       class="form-control"
                                                                       name="email"
                                                                       id="newEmail"
                                                                       required>
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label for="newPhone">Phone</label>
                                                                <input type="text"
                                                                       class="form-control"
                                                                       name="phone"
                                                                       id="newPhone"
                                                                       required>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="newUserPin">User Pin</label>
                                                                <input type="text"
                                                                       class="form-control"
                                                                       name="user_pin"
                                                                       id="newUserPin"
                                                                       required>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="newPassword">Password</label>
                                                                <input type="text"
                                                                       class="form-control"
                                                                       name="password"
                                                                       id="newPassword"
                                                                       required>
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label>User Role</label><br>
                                                                <select name="role"
                                                                        class="col-md-12 brand  btn btn-primary btn-sm dropdown-toggle"
                                                                        required>
                                                                    <option value="">----Select Role----</option>
                                                                    <?php if (isset($role)): ?>
                                                                        <?php foreach ($role AS $tdval): ?>
                                                                            <option value="<?= $tdval->id; ?>"><?= $tdval->role_name; ?></option>
                                                                        <?php endforeach;endif; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Status</label>
                                                                <select name="status"
                                                                        class="col-md-12 brand  btn btn-primary btn-sm dropdown-toggle "
                                                                        required>
                                                                    <option value="">-Select-</option>
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>Address</label>
                                                                <textarea class="form-control" name="address" cols="5"
                                                                          rows="4"></textarea>
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label>Image</label><br>
                                                                <input type="file" name="fileToUpload">
                                                                <div><?php if (isset($error)) echo $error; ?> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer ">
                                                        <button type="submit" class="btn btn-primary" id="add">Add
                                                        </button>
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- User Add Modal End -->
                                    <!-- User Password Change Modal Start -->
                                    <form class="cmxform form-horizontal tasi-form"
                                          action="<?= base_url('userinfo/updatepass'); ?>" method="post">
                                        <div id="myModal" class="modal fade" tabindex="-1" data-width="400">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header table-background">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true"></button>
                                                        <h4 class="modal-title">Change Password</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="">
                                                                    <div class="form-group ">
                                                                        <div class="col-lg-6">
                                                                            <input class=" form-control" id="userid"
                                                                                   name="id" value=""
                                                                                   type="hidden"/>
                                                                            <span id="update_cpassword"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label for="newpassword"
                                                                               class="control-label col-lg-4">New
                                                                            Password :
                                                                        </label>
                                                                        <div class="col-lg-6">
                                                                            <input class=" form-control"
                                                                                   id="npassword" name="npassword"
                                                                                   type="password"/>
                                                                            <span id="update_npassword"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label for="verifynewpassword"
                                                                               class="control-label col-lg-4">VerifyNew
                                                                            Password :</label>
                                                                        <div class="col-lg-6">
                                                                            <input class=" form-control"
                                                                                   id="rpassword" name="rpassword"
                                                                                   type="password"/>
                                                                            <span id="update_rpassword"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-lg-offset-4 col-lg-8">
                                                                            <button type="submit" id="submit"
                                                                                    class="btn btn-success"
                                                                                    onclick="return updatePassword()">
                                                                                Update
                                                                            </button>
                                                                            <button type="reset"
                                                                                    class="btn btn-danger">Clear
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" data-dismiss="modal"
                                                                class="btn dark btn-outline">Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- User Password Change Modal End -->
                                    <!-- User Edit Form Modal -->
                                    <form method="post"
                                          action="<?php echo base_url('userinfo/updateuser'); ?>"
                                          enctype="multipart/form-data">
                                        <div id="editmodal" class="modal fade " tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog ">
                                                <div class="modal-content">
                                                    <div class="modal-header table-background">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">&times;
                                                        </button>
                                                        <h4 class="modal-title" id="myModalLabel">Edit User</h4>
                                                    </div>
                                                    <div class="modal-body col-md-12">
                                                        <div class="form-group ">
                                                            <div class="form-group col-md-4">
                                                                <label>Name</label>
                                                                <input type="hidden" class="form-control" name="id"
                                                                       id="editval">
                                                                <input type="text" class="form-control" name="name"
                                                                       id="name" required>
                                                            </div>
                                                             <div class="form-group col-md-4">
                                                                <label>Company/Page name</label>
                                                                <input type="text" class="form-control" id="company_name" name="company_name"
                                                                       >
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Email</label>
                                                                <input type="text" class="form-control" name="email"
                                                                       id="email" required>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>User Pin</label>
                                                                <input type="text" class="form-control"
                                                                       name="user_pin" id="user_pin" required>
                                                                <span id="pinval"></span>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>Phone</label>
                                                                <input type="text" class="form-control" name="phone"
                                                                       id="phone" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>User Role</label><br>
                                                                <select name="role" id="role"
                                                                        class="col-md-12 brand  btn btn-primary btn-sm dropdown-toggle"
                                                                        required>
                                                                    <option value="">----Select Role----</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Status</label>
                                                                <select name="status" id="status"
                                                                        class="col-md-12 btn btn-primary btn-sm dropdown-toggle "
                                                                        required>
                                                                    <option value="">----Select Status----</option>
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Address</label>
                                                                <textarea class="form-control" name="address"
                                                                          cols="5" rows="6" id="address"></textarea>
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label>Image</label><br>

                                                                <input type="file" name="fileToUpload" id="image">
                                                                <div><?php if (isset($error)) echo $error; ?> </div>
                                                            </div>
                                                            <div class="form-group col-md-1"
                                                                 id="upload_image"></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer ">
                                                        <button type="submit" class="btn btn-primary" id="submitpin">
                                                            Submit
                                                        </button>
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- End User Edit Form  Modal-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= base_url('assets/js/custom/userinfo.js'); ?>" type="text/javascript"></script>
    </div>
