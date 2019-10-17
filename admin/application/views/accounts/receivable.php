<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">Account Receivable</div>
                    </div>
                    <div class="portlet-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet ">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover text-center"
                                               id="sample_1">
                                            <thead class="table-background">
                                                <tr>
                                                    <?php if ($this->session->userdata('user_role') == 1): ?>
                                                        <th class="text-center">Action</th>
                                                    <?php endif; ?>
                                                    <th class="text-center">Delivery Date</th>
                                                    <th class="text-center">Tracking ID</th>
                                                    <?php if ($this->session->userdata('user_role') == 1): ?>
                                                        <th class="text-center">Company Name</th>
                                                        <th class="text-center">Delivery Man</th>
                                                        <th class="text-center">Contact No. (Delivery Man)</th>
                                                    <?php endif; ?>
                                                    <th class="text-center">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($receivables as $receivable): ?>
                                                    <tr data-id="<?= $receivable->id ?>">
                                                        <?php if ($this->session->userdata('user_role') == 1): ?>
                                                            <td>
                                                                <?php if ($receivable->collect_frmod == 0): ?>
                                                                    <?php if (!empty($receivable->date) || $receivable->final_status == 7): ?>
                                                                        <button class="btn btn-primary btn-circle btn-xs requestReceive" title="Receive from Delivery Man"><i class="fa fa-money"></i></button>
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                    <button class="btn btn-success btn-circle btn-xs " title="Pay to Merchant">Payment Received</button>
                                                                <?php endif; ?>
                                                            </td>
                                                        <?php endif; ?>
                                                        <td>
                                                            <?php if (!empty($receivable->date)): ?>
                                                                <?= date("d F, Y", strtotime($receivable->date)); ?>
                                                            <?php elseif ($receivable->final_status == 7): ?>
                                                                <button class="btn btn-subscribe btn-danger btn-xs " title="Pay to Merchant">product canceled by customer</button>
                                                            <?php else: ?>
                                                                <button class="btn btn-subscribe btn-danger btn-xs " title="Pay to Merchant">Not Delivered yet!</button>

                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= $receivable->trackingId; ?></td>
                                                        <?php if ($this->session->userdata('user_role') == 1): ?>
                                                            <td><?= $receivable->company ?></td>
                                                            <td><?= $receivable->deliveryMan ?></td>
                                                            <td><?= $receivable->deliveryManPhone ?></td>
                                                            <td>&#2547; <?= number_format($receivable->price + $receivable->deliveryCost, 2) ?></td>
                                                        <?php else: ?>
                                                            <td>&#2547; <?= $receivable->price; ?></td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php endforeach; ?>
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
        <script src="<?= base_url('assets/js/custom/receivable.js'); ?>" type="text/javascript"></script>
    </div>
