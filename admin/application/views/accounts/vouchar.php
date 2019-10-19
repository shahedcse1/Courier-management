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
                        <div class="btn-group">
                            <?php if ($this->session->userdata('user_role') == 1): ?>
                                <a href="<?= base_url('accounts/vouchar'); ?>">
                                    <button type="button" class="btn btn-primary" data-toggle="modal">
                                        <span class="glyphicon glyphicon-backward" aria-hidden="true"></span>
                                        Back to vouchar list
                                    </button>
                                </a>
                            <?php endif; ?>
                        </div>
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

                                                            <td style="background-color: green;color:#fff;">
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
        <script src="<?= base_url('assets/js/custom/payable.js'); ?>" type="text/javascript"></script>
    </div>


