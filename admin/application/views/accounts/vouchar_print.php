<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">

                                <div class="portlet-body" id="printvouchar">
                                    <table style="font-size: 12px;  width: 100%; " class="table table-striped table-bordered table-hover ">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="col-lg-10">
                                                        <div class="col-lg-12">
                                                            <div class="col-sm-2">
                                                                <img height="60px;" width="90px;" src="<?= base_url('assets/pages/img/logo-black.png'); ?>">
                                                            </div>
                                                            <div class="col-sm-10">
                                                                <div style="text-align: center">
                                                                    <p><span style="font-size: 20px"><b>Parcel Xpress BD</b></span>
                                                                        <br> House-3/1, Road-8, Dhanmondi, Dhaka-1205
                                                                        <br> Contact: +8801842775001 ,+8801842775002 .
                                                                        <br> Web: www.parcelxpressbd.com
                                                                    </p>
                                                                </div>
                                                                <div style="border: 1px solid gray; height: 1px;"> </div>
                                                                <div style="text-align: right">
                                                                    <img height="60px;" width="90px;" src="<?= base_url('assets/pages/img/barcode.png'); ?>">
                                                                    <br>
                                                                    <?= $allinfo->vouchar_no; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div style="text-align: left">
                                                                <b>  Paid To </b>: <span id="customername"><?= $allinfo->name; ?> (<?= $allinfo->company_name; ?>)</span>
                                                                <br>
                                                                <b>  Phone </b>: <span id="salesmanname1"><?= $allinfo->phone; ?></span>
                                                                <br>
                                                                <b>  Address </b>: <span id="salesdate1"><?= $allinfo->address; ?></span>
                                                                <br>
                                                                <br>

                                                            </div>
                                                        </div>

                                                        <div class="adv-table">
                                                            <table class="display table table-bordered table-striped edit-table" id="cloudAccounting1" style="font-size: 7px">
                                                                <?php
                                                                if (!empty($allinfo->adjustable_ids)):
                                                                    $trackingid = $this->db->query("SELECT group_concat(request.tracking_id) AS track FROM accounts JOIN request ON request.id=accounts.request_id WHERE accounts.id IN($allinfo->adjustable_ids)")->row()->track;
                                                                endif;
                                                                ?>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">Paid tracking</th>
                                                                        <?php if (!empty($trackingid)): ?>
                                                                            <th class="text-center">Adjust tracking</th>
                                                                        <?php endif; ?>
                                                                        <th class="text-center">Total Paid
                                                                            <br> Product</th>
                                                                        <th class="text-center">Total Amount</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="addprintrowoffice">
                                                                    <tr id="rowoffice1">
                                                                        <?php
                                                                        $trackingQr = $this->db->query("SELECT group_concat(request.tracking_id) AS track FROM accounts JOIN request ON request.id=accounts.request_id Where accounts.id IN($allinfo->payable_ids) ");
                                                                        $tracking_id = $trackingQr->row()->track;
                                                                        $ids = explode(',', $tracking_id);
                                                                        $nooftracking = sizeof($ids)
                                                                        ?>

                                                                        <td style="text-align: center">
                                                                            <?php
                                                                            foreach ($ids as $trid):
                                                                                $customername = $this->db->query("SELECT customer_name,netprice FROM request where tracking_id='$trid'")->row();
                                                                                echo $trid . ' -- From  ' . $customername->customer_name . ' ৳' . $customername->netprice . '<br>';
                                                                            endforeach;
                                                                            ?>
                                                                        </td>
                                                                        <?php if (!empty($trackingid)): ?>
                                                                            <td class="text-center" style="color:red;">
                                                                                <?= $trackingid ?>
                                                                            </td>
                                                                        <?php endif; ?>
                                                                        <td style="text-align: center">
                                                                            <?= $nooftracking ?>
                                                                        </td>
                                                                        <td style="text-align: center">
                                                                            <?= $allinfo->payable_amount; ?>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>

                                                            </table>
                                                            <table style=" text-align:right; width:100%; font-size: 12px; font-weight: bold;margin-bottom: 5px;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Product Total: </td>
                                                                        <td id="invoiceamount1" style="text-align:right">
                                                                            <?= $allinfo->payable_amount ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>COD: </td>
                                                                        <td id="invoiceamount1" style="text-align:right">
                                                                            <?= $allinfo->COD ?> %</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Adjust From cancel product / Due charge: </td>
                                                                        <td id="invoiceamount1" style="text-align:right;color:red;"> -
                                                                            <?= $allinfo->adjustable_amount ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Total Paid Amount: </td>
                                                                        <td id="invoiceamount1" style="text-align:right">
                                                                            <?= $allinfo->total_amount ?>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <table style="float: right; text-align:left; width:100%;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Transactional Document: </td>
                                                                        <td id="invoiceamount1" style="text-align:left">
                                                                            <?php if (!empty($allinfo->file_name)): ?>
                                                                                <a target="_blank" href="<?= base_url('uploads/vouchar/' . $allinfo->file_name); ?>">
                                                                                    <img  height="150px;" width="120px;" src="<?= base_url('uploads/vouchar/' . $allinfo->file_name); ?>">
                                                                                </a>
                                                                            <?php else: ?>
                                                                                N/A
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                            <table style="float:left; text-align: center; margin: 10px 5px 0px 5px; font-size: 10px">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Parcel xpress BD is fastest delivery service with very care . Thank you for choosing parcel xpress BD for your product Delivery.</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <?php if ($role == 2): ?>
                                <input type="button" class="btn btn-success pull-right" onclick="printDiv2('printvouchar')" value="Rceived & print vouchar" />
                            <?php else: ?>
                                <input type="button" class="btn btn-success pull-right" onclick="printDiv('printvouchar')" value="print vouchar" />
                            <?php endif; ?>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <script src="<?= base_url('assets/js/custom/payable.js'); ?>" type="text/javascript"></script>
    </div>
    <script>
                                    function printDiv2(divName) {
                                        var receivedid = '<?php echo $allinfo->id ?>';
                                        $.ajax({
                                            type: "POST",
                                            dataType: 'json',
                                            url: base_url + 'accounts/updateby_marchent',
                                            data: {
                                                receivedid: receivedid
                                            }
                                        });

                                        var printContents = document.getElementById(divName).innerHTML;
                                        var originalContents = document.body.innerHTML;

                                        document.body.innerHTML = printContents;

                                        window.print();

                                        document.body.innerHTML = originalContents;
                                    }

                                    function printDiv(divName) {
                                        var printContents = document.getElementById(divName).innerHTML;
                                        var originalContents = document.body.innerHTML;

                                        document.body.innerHTML = printContents;

                                        window.print();

                                        document.body.innerHTML = originalContents;
                                    }
    </script>