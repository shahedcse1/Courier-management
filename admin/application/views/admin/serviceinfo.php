<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">Service Information</div>
                    </div>
                    <div class="portlet-body">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-toggle="modal"
                                    data-target="#addModal">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                Add Services
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
                                                <th class="text-center">Service ID</th>
                                                <th class="text-center">Service Name</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (isset($services)): ?>
                                                <?php foreach ($services as $service):
                                                    ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <button class="editmodal btn btn-primary btn-circle  btn-xs"
                                                                    onclick="editservice(<?= $service->id; ?>);">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                            <button class="item_delete btn-circle btn btn-danger btn-xs"
                                                                    value="<?= $service->id; ?>">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                        <td><?= $service->id; ?></td>
                                                        <td><?= $service->service_name; ?></td>
                                                    </tr>
                                                <?php endforeach;
                                            endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Service Add Modal Start-->
                                    <form action="<?= base_url('services/addservice'); ?>" method="post"
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
                                                        <h4 class="modal-title" id="myModalLabel">Add Service</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Service Name</label>
                                                            <input type="text" class="form-control" name="service_name"
                                                                   required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea type="text" class="form-control"
                                                                      name="description" rows="5" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Link</label>
                                                            <input type="text" class="form-control" name="link"
                                                                   required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer ">
                                                        <button type="submit" class="btn btn-primary" id="add">Add
                                                            Service
                                                        </button>
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Service Add Modal End -->

                                    <!-- Service Edit Form Modal -->
                                    <form method="post"
                                          action="<?php echo base_url('services/updateservice'); ?>"
                                          enctype="multipart/form-data">
                                        <div id="editmodal" class="modal fade " tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog ">
                                                <div class="modal-content">
                                                    <div class="modal-header table-background"
                                                    >
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">&times;
                                                        </button>
                                                        <h4 class="modal-title" id="myModalLabel">Edit Service</h4>
                                                    </div>
                                                    <div class="modal-body col-md-12">
                                                        <div class="form-group ">
                                                            <label>Service name</label>
                                                            <input type="hidden" class="form-control" name="id" id="editval">
                                                            <input type="text" class="form-control" name="service_name" id="service_name"
                                                                   required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea class="form-control" name="description"
                                                                      id="description" rows="5"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Link</label>
                                                            <input type="text" class="form-control" name="link"
                                                                   id="link" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer ">
                                                        <button type="submit" class="btn btn-primary">
                                                            Edit Service
                                                        </button>
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- End Service Edit Form  Modal-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= base_url('assets/js/custom/serviceinfo.js'); ?>" type="text/javascript"></script>
    </div>
