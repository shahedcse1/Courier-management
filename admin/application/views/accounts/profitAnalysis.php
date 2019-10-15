<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">Profit Analysis</div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <form id="monthOfProfitForm" class="form-inline" action="<?= base_url('accounts/monthofprofit') ?>" method="GET">
                                <div class="form-group col-md-12">
                                    <label for="monthOfProfit" class="font-size-12">Select Your Month:</label>
                                    <div class="input-group">
                                        <input class="form-control form-control-inline input-medium date-picker"
                                               size="16"
                                               type="text"
                                               name="monthOfProfit"
                                               id="monthOfProfit">
                                    </div>
                                    <button type="submit" style="margin-left: 10px" class="btn btn-primary form-control" id="submitMonthOfProfit">Submit</button>
                                </div>
                            </form>

                            <section id="showProfit" style="display: none;margin-top: 80px;">
                                <div class="col-sm-12 text-center">
                                    <div class="col-sm-5 col-sm-offset-1">
                                        <table class="table table-bordered">
                                            <tr style="background-color: #c3e7d4 ">
                                                <td class="text-right">Total Debit:</td>
                                                <td class="text-right">&#2547; <span id="debit"></span></td>
                                            </tr>
                                            <tr style="background-color:  #fdc8b8 ">
                                                <td class="text-right">Total Credit:</td>
                                                <td class="text-right">&#2547; <span id="credit"></span></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">Overall Profit:</td>
                                                <td class="text-right"><span id="profit"></span></td>
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
                format: "mm/yyyy",
                startView: "months",
                minViewMode: "months",
                endDate: new Date()
            });
        </script>
        <script src="<?= base_url('assets/js/custom/profitAnalysis.js'); ?>" type="text/javascript"></script>
    </div>
