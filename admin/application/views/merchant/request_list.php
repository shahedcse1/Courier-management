<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">All Request</div>
                    </div>
                    <div class="portlet-body">

                        <div class="btn-group">
                            <?php if ($role == 2): ?>
                                <a href="<?= base_url('merchant/makerequest'); ?>" class="linkstyle">
                                    <button class="btn btn-info btn-sm">
                                        <i class="glyphicon glyphicon-plus"></i> Add New Request
                                    </button>
                                </a>
                            <?php endif; ?>
                        </div>

                        <br><br>
                        <?php
                        if ($this->session->userdata('add')):
                            echo '<div class="alert alert-success fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Congrats !!! </strong> ' . $this->session->userdata('add') . '</div>' . '<br>' . '<br>';
                            $this->session->unset_userdata('add');

                        elseif ($this->session->userdata('notadd')):
                            echo '<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Failed Meaasge !!! </strong> ' . $this->session->userdata('notadd') . '</div>';
                            $this->session->unset_userdata('notadd');
                        else:
                        endif;
                        ?>
                        <?php
                        if ($this->session->userdata('successfull')):
                            echo '<div class="alert alert-success fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Success Message !!! </strong> ' . $this->session->userdata('successfull') . '</div>';
                            $this->session->unset_userdata('successfull');
                        endif;
                        if ($this->session->userdata('failed')):
                            echo '<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Failed Meaasge !!! </strong> ' . $this->session->userdata('failed') . '</div>';
                            $this->session->unset_userdata('failed');
                        endif;
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet ">
                                    <div class="portlet-body">
                                        <form method="post" action="<?= base_url('merchant/makerequest_action'); ?>">
                                            <table class="table table-striped table-bordered table-hover text-center"
                                                   id="sample_1">
                                                <thead class="table-background">
                                                    <tr>
                                                        <th class="text-center">Zone</th>
                                                        <th class="text-center">Track Id</th>
                                                        <th class="text-center">Order No.</th>
                                                        <th class="text-center">Customer Name(Phone)</th>
                                                        <th class="text-center">Address</th>
                                                        <th class="text-center">Amount</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Com./Page Name(Phone)</th>
                                                        <?php if ($role == 1 && ($status == 6 || $status == 7)): ?>
                                                            <th class="text-center">Delivery Man</th>
                                                        <?php endif; ?>
                                                        <th class="text-center">Option</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (sizeof($requestinfo)):
                                                        foreach ($requestinfo as $value):
                                                            if (!empty($value->delivery_man)):
                                                                $phoneqr = $this->db->query("SELECT phone FROM staffs where id='$value->delivery_man'");
                                                                if ($phoneqr->num_rows()):
                                                                    $phone = $phoneqr->row()->phone;
                                                                else:
                                                                    $phone = 'N/A';
                                                                endif;
                                                            else:
                                                                $phone = 'N/A';
                                                            endif;
                                                            ?>
                                                            <tr>
                                                                <td><?= $value->zone_name; ?></td>
                                                                <td>
                                                                    <?php if ($role == 1 && ($status == 1 || $status == 2 || $status == 4 || $status == 6)): ?>
                                                                        <?= $value->tracking_id; ?>  - <input type="checkbox" id="request_id" name="request_id[]" value="<?= $value->id ?>">
                                                                    <?php else: ?> 
                                                                        <?= $value->tracking_id; ?>
                                                                        <?php if ($status == 7 && $value->product_returned == 1): ?>
                                                                            <p style="color:red">  Returned To Vendor </p>
                                                                        <?php elseif ($status == 7 && $value->product_returned == 0): ?>
                                                                            <p style="color:green">  Still In Our House. </p>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td><?= $value->order_no; ?></td>
                                                                <td><?= $value->customer_name; ?>(<?= $value->customer_phone; ?>)</td>
                                                                <td><?= $value->d_address; ?></td>
                                                                <td>&#2547; <?= number_format($value->netprice + $value->delivery_cost, 2) ?></td>

                                                                <td style="background-color:<?= $value->color; ?> ">
                                                                    <a href="<?= base_url('merchant/editrequest/' . $value->id . '/' . $status) ?>">
                                                                        <?= $value->status_name; ?><br>

                                                                    </a>
                                                                    <?php if (!empty($value->delay_notes)): ?>
                                                                        <button type="button" onclick="delay_reason();" id="delay" value="<?= $value->delay_notes ?>" class="btn-default-focus">Delay reason</button>

                                                                    <?php endif; ?>

                                                                </td>
                                                                <td><?= $value->company_name; ?>(<?= $value->phone; ?>)</td>
                                                                <?php if ($role == 1 && ($status == 6 || $status == 7)): ?>
                                                                    <td>
                                                                        <?php
                                                                        if (!empty($value->delivery_man)):
                                                                            $nameqr = $this->db->query("SELECT name FROM staffs where id='$value->delivery_man'");
                                                                            if ($nameqr->num_rows()):
                                                                                $name = $nameqr->row()->name;
                                                                            else:
                                                                                $name = 'N/A';
                                                                            endif;
                                                                        else:
                                                                            $name = 'N/A';
                                                                        endif;
                                                                        echo $name;
                                                                        ?>
                                                                    </td>
                                                                <?php endif; ?>
                                                                <td>
                                                                    <?php if ($value->final_status == 1): ?>
                                                                        <a href="<?= base_url('merchant/editrequest/' . $value->id . '/' . $status) ?>">
                                                                            Update

                                                                        </a>
                                                                    <?php elseif ($value->final_status == 6 && $role == 1): ?>
                                                                        <a  target="_blank"href="<?= base_url('merchant/print_challan?id=') . $value->id ?>">
                                                                            <button type="button" class="btn-success">Print Challan</button>
                                                                        </a>
                                                                    <?php else: ?>
                                                                        N/A
                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        endforeach;
                                                    endif;
                                                    ?>

                                                </tbody>
                                            </table>


                                            <?php if ($role == 1 && $status == 1): ?>
                                                <button type="submit" name="action" value="1" class="btn-lg btn-primary pull-left"> All selected make to In progress</button>
                                            <?php endif; ?>
                                            <?php if ($role == 1 && $status == 2): ?>
                                                <button type="submit"name="action" value="2" class="btn-lg btn-primary pull-left"> All selected make to In house</button>
                                            <?php endif; ?>
                                            <?php if ($role == 1 && $status == 4): ?>
                                                <div class="modal-body col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3"><b>Please Select a Delivery man:</b></label>
                                                        <div class="control-label col-md-3">
                                                            <select  required   name="delivery_man" id="delivery_man" required  class="form-control"/>
                                                            <option value="">--Select--</option>
                                                            <?php
                                                            foreach ($deliveryman as $value):
                                                                ?>
                                                                <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                                                <?php
                                                            endforeach;
                                                            ?>

                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <button type="submit"name="action" value="4" class="btn-lg btn-primary pull-left"> All selected Send out for delivery</button>
                                            <?php endif; ?>
                                            <?php if ($role == 1 && $status == 6): ?>
                                                <div class="form-group">
                                                    <label class="control-label col-md-5"><b>Delivery Charge and price Collect From Delivery Man:</b></label>
                                                    <div class="control-label col-md-4">
                                                        <input type="checkbox" name="delivery_Charge" value="1">&nbsp;&nbsp;  YES
                                                    </div>
                                                </div><br>
                                                <button type="submit"name="action" value="7" class="btn-lg btn-danger pull-left"> All selected canceled by customer</button>&nbsp;&nbsp;
                                                <button type="submit"name="action" value="5" class="btn-lg btn-primary pull-left"> All selected make to delivered</button>
                                            <?php endif; ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade fade modal-auto-clear" id="infomodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header table-background">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                    Delivery delay reason.
                </div>
                <div class="modal-body col-md-12" id="alert" style="color:red;" >

                </div>
                <div class="modal-footer ">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function delay_reason() {
            var delay = $('#delay').val();
            $('#alert').html(delay);
            $('#infomodal').modal('show');

        }
    </script>
