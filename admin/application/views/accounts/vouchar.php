<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">Voucher Details</div>
                    </div>



                    <div class="portlet-body">
                        <?php
                        if ($this->session->userdata('add')):
                            echo '<div class="alert alert-success fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Success Message !!! </strong> ' . $this->session->userdata('add') . '</div>' . '<br>' . '<br>';
                            $this->session->unset_userdata('add');
                        elseif ($this->session->userdata('notadd')):
                            echo '<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Failed Meaasge !!! </strong> ' . $this->session->userdata('notadd') . '</div>';
                            $this->session->unset_userdata('notadd');
                        endif;
                        ?>
                        <?php if ($this->session->userdata('user_role') == 1): ?>
                            <div class="btn-group">
                                <a href="<?= base_url('accounts/vouchar'); ?>">
                                    <button type="button" class="btn btn-primary" data-toggle="modal">
                                        <span class="glyphicon glyphicon-backward" aria-hidden="true"></span>
                                        Back to voucher list
                                    </button>
                                </a>
                            </div>
                            <div class="row" style="margin-top: 15px; margin-left: 50px;">
                                <form id="monthOfProfitForm" class="form-inline" action="<?= base_url('accounts/vouchar_details'); ?>" method="GET">
                                    <div class="form-group col-md-12">
                                        <label for="monthOfProfit" class="font-size-12">Select  Month:</label>
                                        <div class="input-group">
                                            <input value="<?= $paidto ?>" class="form-control" type="hidden" name="paid_to" id="paid_to">
                                            <input autocomplete="off" class="form-control form-control-inline input-medium date-picker" size="16" type="text" name="month" id="monthOfProfit">
                                        </div>
                                        <button type="submit" style="margin-left: 10px" class="btn btn-primary form-control" id="submitMonthOfProfit">Submit</button>
                                    </div>
                                </form>

                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet ">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover text-center"
                                               id="sample_1">
                                            <thead class="table-background">
                                                <tr>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Options</th>
                                                    <th class="text-center">Voucher No.</th>

                                                    <th class="text-center">payment Status</th>
                                                    <th class="text-center">Amount</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (sizeof($voucharinfo)):
                                                    foreach ($voucharinfo as $value):
                                                        ?>
                                                        <tr>
                                                            <td><?= $value->paid_date; ?></td>
                                                            <td>
                                                                <a href="<?= base_url('accounts/print_vouchar?id=' . $value->id); ?>">
                                                                    <button class="cost_edit btn btn-primary btn-circle" title="print">
                                                                        <i class="fa fa-pencil">Preview / Print</i>
                                                                    </button>
                                                                </a>
                                                            </td>
                                                            <td><?= $value->vouchar_no; ?></td>

                                                            <td style="background-color: green;color: #ee5619">
                                                                <?php
                                                                if ($value->receivedby_marchent == 1):
                                                                    echo 'Paid';
                                                                else:
                                                                    echo 'Unpaid';
                                                                endif;
                                                                ?>
                                                            </td>
                                                            <td><?= $value->total_amount; ?></td>

                                                        </tr>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= base_url('assets/global/plugins/moment.min.js') ?>"></script>
        <script src="<?= base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/custom/payable.js'); ?>" type="text/javascript"></script>
    </div>
    <script>
        $('.date-picker').datepicker({
            format: "yyyy-mm",
            startView: "months",
            minViewMode: "months",
            endDate: new Date()
        });
    </script>

