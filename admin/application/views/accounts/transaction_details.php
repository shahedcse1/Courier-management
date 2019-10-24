<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">Transaction Details</div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <form class="form-inline" action="<?= base_url('accounts/transaction') ?>" method="POST">
                                <div class="form-group col-md-12">
                                    <label for="monthOfProfit" class="font-size-12">Please Select Your Month:</label>
                                    <div class="input-group">
                                        <input class="form-control form-control-inline input-medium date-picker"
                                               size="16"autocomplete="off" 
                                               type="text"
                                               name="month"
                                               id="monthOfProfit">
                                    </div>
                                    <button type="submit" style="margin-left: 10px" class="btn btn-primary form-control">Submit</button>
                                </div>
                            </form>

                            <section id="showProfit" style="margin-top: 80px;">
                                <div class="col-sm-12 text-center">
                                    <div class="col-sm-5 col-sm-offset-1">
                                        <table class="table table-bordered">
                                            <tr style="background-color: #c3e7d4 ">
                                                <td class="text-left">Amount Total paid to merchant:</td>
                                                <td class="text-right">&#2547; <span id="debit"><?=  $transaction;   ?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-sm-5">

                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= base_url('assets/global/plugins/moment.min.js') ?>"></script>
        <script src="<?= base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
        <script>
            $('.date-picker').datepicker({
                format: "yyyy-mm",
                startView: "months",
                minViewMode: "months",
                endDate: new Date()
            });
        </script>
        <script src="<?= base_url('assets/js/custom/profitAnalysis.js'); ?>" type="text/javascript"></script>
    </div>
