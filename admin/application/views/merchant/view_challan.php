<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">Challan Copy</div>
                        <input type="button" class="btn btn-danger pull-right" onclick="printDiv('printchallan')" value="print Challan" />
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="portlet ">
                                    <div class="portlet-body" id="printchallan">
                                        <table style="font-size: 12px;  width: 100%; "class="table table-striped table-bordered table-hover text-center">

                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="col-lg-6">                    
                                                            <div class="col-lg-12">
                                                                <div class="col-sm-2">
                                                                    <img height="60px;" width="90px;" src="<?= base_url('assets/pages/img/logo-black.png'); ?>">
                                                                </div>
                                                                <div class="col-sm-10">
                                                                    <div style="text-align: center">                        
                                                                        <p><span style="font-size: 20px"><b>Parcel Xpress BD</b></span><br> House-3/1, Road-8, Dhanmondi, Dhaka-1205
                                                                            <br> Contact: +8801842775001 ,+8801842775002 .  </p>
                                                                        <p style="text-align: center"> 
                                                                            Web: www.parcelxpressbd.com <br>
                                                                            E-mail:info@parcelxpressbd.com </p> 

                                                                    </div>
                                                                    <div style="border: 1px solid gray; height: 1px;"> </div>
                                                                    <div style="text-align: center">
                                                                        <h5>
                                                                            COPY OF RECEIPT
                                                                        </h5>                                
                                                                    </div> 
                                                                </div>                                
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div style="text-align: left">
                                                                    Tracking Id:-<span id="invoiceno1"> <?= $allinfo->tracking_id; ?></span><br>
                                                                    Customer Name: <span id="customername"><?= $allinfo->customer_name; ?></span><br>
                                                                    Customer Phone: <span id="salesmanname1"><?= $allinfo->customer_phone; ?></span><br>
                                                                    Address: <span id="salesdate1"><?= $allinfo->d_address; ?></span><br><br>

                                                                </div>                                                       
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="adv-table">                                   
                                                                    <table class="display table table-bordered table-striped edit-table" id="cloudAccounting1" style="font-size: 9px">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="text-center">Product From</th>
                                                                                <th class="text-center">Qty</th>
                                                                                <th class="text-center">Net price</th>
                                                                                <th class="text-center">Delivery Charge</th>
                                                                                <th class="text-center">Amount</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="addprintrowoffice"> 
                                                                            <tr id="rowoffice1">
                                                                                <td style="text-align: center">
                                                                                    <?php if (empty($allinfo->company_name)):
                                                                                        echo 'N/A';
                                                                                    else: echo $allinfo->company_name;
                                                                                    endif;
                                                                                    ?></td>
                                                                                <td style="text-align: center"><?= $allinfo->quantity; ?></td>
                                                                                <td style="text-align: center"><?= $allinfo->netprice; ?></td>
                                                                                <td style="text-align: center"><?= $allinfo->delivery_cost; ?></td>
                                                                                <td style="text-align: center"><?= $allinfo->netprice + $allinfo->delivery_cost ?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <th>Total</th>
                                                                                <th style="text-align: center" id="totalqty1"><?= $allinfo->quantity; ?></th>
                                                                                <th></th>
                                                                                <th></th>
                                                                                <th id="netvalues1" style="text-align: right"><?= $allinfo->netprice + $allinfo->delivery_cost ?>.00</th>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                    <table style="float: right; text-align:right; width:100%; font-size: 12px; font-weight: bold">                                       
                                                                        <tbody><tr>
                                                                                <td>Sub Total: </td>
                                                                                <td id="invoiceamount1" style="text-align:right"><?= $allinfo->netprice + $allinfo->delivery_cost ?>.00</td>
                                                                            </tr>                                      

                                                                        </tbody></table> 
                                                                    <table style="float:left; text-align: center; margin: 10px 5px 0px 5px; font-size: 10px">                                    
                                                                        <tbody><tr>
                                                                                <td>Parcel xpress BD is fastest delivery service with very care . Thank you for choosing parcel xpress BD for your product Delivery.</td>                                           
                                                                            </tr>
                                                                        </tbody></table>
                                                                </div>                       
                                                            </div>                                               
                                                        </div>
                                                    </td>                    
                                                </tr>
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
    <script>
                            function printDiv(divName) {
                                var printContents = document.getElementById(divName).innerHTML;
                                var originalContents = document.body.innerHTML;

                                document.body.innerHTML = printContents;

                                window.print();

                                document.body.innerHTML = originalContents;
                            }
    </script>
