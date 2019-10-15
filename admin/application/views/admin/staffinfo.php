<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">Staff Information</div>
                    </div>
                    <div class="portlet-body">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-toggle="modal"
                                    data-target="#addModal">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                Add Staffs
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
                        else:
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
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Phone</th>
                                                <th class="text-center">Address</th>
                                                <th class="text-center">Staff Image</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (isset($staffs)): ?>
                                                <?php foreach ($staffs as $staff):
                                                    ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <button class="editmodal btn btn-primary btn-circle  btn-xs"
                                                                    onclick="editstaff(<?= $staff->id; ?>);">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                            <button class="item_delete btn-circle btn btn-danger btn-xs"
                                                                    value="<?= $staff->id; ?>">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                        <td><?= $staff->name; ?></td>
                                                        <td><?= $staff->category; ?></td>
                                                        <td><?= $staff->phone; ?></td>
                                                        <td><?= $staff->address; ?></td>
                                                        <td>
                                                            <a href="<?= base_url('uploads/') . $staff->image_path; ?>"
                                                               target="_blank"><?php echo $staff->image_path; ?>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;
                                            endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Staff Add Modal Start-->
            <form action="<?= base_url('staffs/addstaff'); ?>" method="post"
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
                                <h4 class="modal-title" id="myModalLabel">Add Staff</h4>
                            </div>
                            <div class="modal-body col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group col-md-6">
                                        <label>Staff Name</label>
                                        <input type="text" class="form-control" name="name"
                                               required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Staff Category</label><br>
                                        <select name="category" id="category"
                                                class="col-md-12 brand  btn btn-primary btn-sm dropdown-toggle"
                                                required>
                                            <option value="">----Select Category----</option>
                                            <?php if (isset($category)): ?>
                                                <?php foreach ($category AS $cat): ?>
                                                    <option value="<?= $cat->id; ?>"><?= $cat->staff_category; ?></option>
                                                <?php endforeach;endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div id="category_one">
                                    <div class="col-md-12">
                                        <div class="col-md-6  form-group">
                                            <label>Position</label>
                                            <input type="text" class="form-control" name="position" id="position">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Facebook Link</label>
                                            <input type="text" class="form-control" name="fb" id="fb">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6 form-group">
                                            <label>Twitter Link</label>
                                            <input type="text" class="form-control" name="twitter" id="twitter">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Google Link</label>
                                            <input type="text" class="form-control" name="google" id="google">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12 form-group">
                                            <label>Linkedin Link</label>
                                            <input type="text" class="form-control" name="linkedin" id="linkdin">
                                        </div>
                                    </div>
                                </div>
                                <div id="category_two">
                                    <div class="col-md-12">
                                        <div class="col-md-6 form-group">
                                            <select name="zone" id="zone"
                                                    class="col-md-12 brand  btn btn-primary btn-sm dropdown-toggle">
                                                <option value="">----Select Zone----</option>
                                                <?php if (isset($zones)): ?>
                                                    <?php foreach ($zones AS $zone): ?>
                                                        <option value="<?= $zone->id; ?>"><?= $zone->zone_name; ?></option>
                                                    <?php endforeach;endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <select name="area" id="area"
                                                    class="col-md-12 brand  btn btn-primary btn-sm dropdown-toggle">
                                                <option value="">----Select Area----</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group col-md-6">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="phone"
                                               required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Image</label><br>
                                        <input type="file" name="fileToUpload" >
                                        <div class="desc">(Width:400px,Height:550px)</div>
                                        <div><?php if (isset($error)) echo $error; ?> </div>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group col-md-12">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address"
                                                  rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-primary" id="add">Add Staff
                                </button>
                                <button type="button" class="btn btn-default"
                                        data-dismiss="modal">Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Staff Add Modal End -->
            <!-- Staff Edit Form Modal -->
            <form method="post"
                  action="<?php echo base_url('staffs/updatestaff'); ?>"
                  enctype="multipart/form-data">
                <div class="modal fade" id="editmodal" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header table-background">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close"><span
                                            aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Edit Staff</h4>
                            </div>
                            <div class="modal-body col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group col-md-6">
                                        <label>Staff Name</label>
                                        <input type="hidden" class="form-control" name="id" id="editval">
                                        <input type="text" class="form-control" name="name" id="name"
                                               required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Staff Category</label><br>
                                        <select name="categoryid" id="categoryid"
                                                class="col-md-12 brand  btn btn-primary btn-sm dropdown-toggle">
                                            <option value="">----Select Category----</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="category_1">
                                    <div class="col-md-12">
                                        <div class="col-md-6  form-group">
                                            <label>Position</label>
                                            <input type="text" class="form-control" name="pos" id="pos">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Facebook Link</label>
                                            <input type="text" class="form-control" name="facebook" id="facebook">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6 form-group">
                                            <label>Twitter Link</label>
                                            <input type="text" class="form-control" name="twit" id="twit">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Google Link</label>
                                            <input type="text" class="form-control" name="goog" id="goog">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12 form-group">
                                            <label>Linkedin Link</label>
                                            <input type="text" class="form-control " name="link" id="link">
                                        </div>
                                    </div>
                                </div>
                                <div id="category_2">
                                    <div class="col-md-12">
                                        <div class="col-md-6 form-group">
                                            <select name="zoneid" id="zoneid"
                                                    class="col-md-12 brand  btn btn-primary btn-sm dropdown-toggle">
                                                <option value="">----Select Zone----</option>
                                                <?php if (isset($zones)): ?>
                                                    <?php foreach ($zones AS $zone): ?>
                                                        <option value="<?= $zone->id; ?>"><?= $zone->zone_name; ?></option>
                                                    <?php endforeach;endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <select name="areaid" id="areaid"
                                                    class="col-md-12 brand  btn btn-primary btn-sm dropdown-toggle">
                                                <option value="">----Select Area----</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group col-md-6">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="phone" id="phone"
                                               required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Image</label><br>
                                        <input type="file" name="fileToUpload" id="image">
                                        <div><?php if (isset($error)) echo $error; ?> </div>
                                    </div>
                                    <div class="form-group col-md-1"
                                         id="upload_image"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group col-md-12">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" id="address"
                                                  rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-primary" id="add">Edit Staff</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- End Staff Edit Form  Modal-->
        </div>
        <script src="<?= base_url('assets/js/custom/staffinfo.js'); ?>" type="text/javascript"></script>
    </div>
