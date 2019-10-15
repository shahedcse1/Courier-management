<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">Account Payable</div>
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
                                                    <th class="text-center">Action</th>
                                                    <th class="text-center">Delivery Date</th>
                                                    <th class="text-center">Tracking ID</th>
                                                    <th class="text-center">Company Name</th>
                                                    <th class="text-center">Phone</th>
                                                    <th class="text-center">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($payables as $payable): ?>
                                                    <tr data-id="<?= $payable->id ?>">
                                                        <td>
                                                            <?php if ($payable->paidtomarchent == 0): ?>
                                                                <?php if (!empty($payable->date)): ?>
                                                                    <button class="btn btn-primary btn-circle btn-xs requestPaid" title="Pay to Merchant"><i class="fa fa-money"></i></button>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <button class="btn btn-success btn-circle btn-xs " title="Pay to Merchant">Payment Completed</button>
                                                            <?php endif; ?>

                                                        </td>
                                                        <td>
                                                            <?php if (!empty($payable->date)): ?>
                                                                <?= date("d F, Y", strtotime($payable->date)); ?>
                                                            <?php else: ?>
                                                                <button class="btn btn-subscribe btn-danger btn-xs " title="Pay to Merchant">Not Delivered yet!</button>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= $payable->trackingId; ?></td>
                                                        <td><?= $payable->company ?></td>
                                                        <td><?= $payable->phone ?></td>
                                                        <td>&#2547; <?= number_format($payable->price, 2); ?></td>
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
        <script src="<?= base_url('assets/js/custom/payable.js'); ?>" type="text/javascript"></script>
    </div>
