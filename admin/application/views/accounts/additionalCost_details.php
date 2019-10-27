<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">Additional Cost Details</div>
                    </div>
                    <div class="portlet-body">
                        <div class="btn-group">
                            <a href="<?= base_url('accounts/additionalcost'); ?>">
                                <button type="button" class="btn btn-primary"
                                        <span class=" glyphicon-backward" aria-hidden="true"></span>
                                    <- Back to Additional Cost
                                </button>
                            </a>
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
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Purpose</th>
                                                    <th class="text-center">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($costs as $cost): ?>
                                                    <tr data-id="<?= $cost->id ?>">
                                                        <td>
                                                            <button class="cost_edit btn btn-primary btn-circle  btn-xs" title="Edit">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                            <button class="cost_delete btn-circle btn btn-danger btn-xs" title="Delete">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                        <td><?= $cost->date ? date("d F, Y", strtotime($cost->date)) : ''; ?></td>
                                                        <td><?= $cost->purpose ?></td>
                                                        <td>&#2547; <?= number_format($cost->amount, 2) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- New Additional Cost Modal Start-->
                                    <form action="<?= base_url('accounts/newcost'); ?>" method="post">
                                        <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header table-background">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h4 class="modal-title" id="myModalLabel">New Additional Cost</h4>
                                                    </div>
                                                    <div class="modal-body col-md-12">
                                                        <div class="col-sm-12" style="margin-bottom: 10px;display: none;" id="addAddiCostMessage">
                                                            <div class="col-sm-12">
                                                                <span class="text-danger" id="alertMsg"></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="dateOfCost" class="font-size-12">Select Date:</label>
                                                            <div class="input-group">
                                                                <input class="form-control form-control-inline input-medium date-picker"
                                                                       size="16"
                                                                       type="text" required=""
                                                                       name="dateOfCost"
                                                                       id="dateOfCost">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="dateOfCost" class="font-size-12">Select purpose:</label>
                                                            <div class="input-group">
                                                                <select class="form-control form-control-inline input-medium " name="addPurpose"id="addPurpose" required="">
                                                                    <option value="">-Select--</option>
                                                                    <?php foreach ($category as $value): ?>
                                                                        <option value="<?= $value->category_name; ?>"><?= $value->category_name; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="form-group col-md-12">
                                                            <label for="addAmount">Amount</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   id="addAmount" required=""
                                                                   name="addAmount">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="addPurpose">Remarks</label>
                                                            <textarea class="form-control"
                                                                      name="remarks"
                                                                      id="remarks"
                                                                      rows="5"
                                                                      ></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer ">
                                                        <button type="submit" class="btn btn-primary" id="add">Add</button>
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- User Add Modal End -->

                                    <!-- User Edit Form Modal -->
                                    <form method="post"
                                          action="<?= base_url('accounts/updatecost'); ?>">
                                        <div id="editmodal" class="modal fade" tabindex="-1" role="dialog"
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
                                                        <div class="col-sm-12" style="margin-bottom: 10px;display: none;" id="editAddiCostMessage">
                                                            <div class="col-sm-12">
                                                                <span class="text-danger" id="alertMsg"></span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="editDateOfCost" class="font-size-12">Select Date:</label>
                                                            <div class="input-group">
                                                                <input class="form-control form-control-inline input-medium date-picker"
                                                                       size="16"
                                                                       type="text"
                                                                       name="editDateOfCost"
                                                                       id="editDateOfCost">
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="additionalCostId" id="additionalCostId" value="" />

                                                        <div class="form-group col-md-12">
                                                            <label for="editPurpose">Purpose</label>
                                                            <textarea class="form-control"
                                                                      name="editPurpose"
                                                                      rows="5"
                                                                      id="editPurpose"></textarea>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="editAmount">Amount</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   id="editAmount"
                                                                   name="editAmount" />
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
    </div>
