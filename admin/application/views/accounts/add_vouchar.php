<style>
    #trackId {
        height: 180px;
        overflow-x: scroll;
        overflow-y: scroll;
    }
    #trackId2 {
        height: 150px;
        overflow-x: scroll;
        overflow-y: scroll;
    }
</style>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="portlet box portletval">
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-10 col-lg-offset-1" style="border:1px solid black;">
                        <center>
                            <img width="50px;" height="30px"src="<?= base_url('uploads/logovouchar.png'); ?>">
                            <h2>Parcel Xpress BD.</h2>
                        </center>
                        <div class="well gorm">
                            <form class="form-horizontal" enctype="multipart/form-data"  action="<?= base_url('accounts/addvouchardata'); ?>"
                                  method="post">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Voucher Date:</label>
                                        <div class="col-md-10">
                                            <input type="text"
                                                   readonly
                                                   name="date"
                                                   value="<?= date('Y-m-d'); ?>" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="marchent_name" class="control-label col-md-2">Paid To:</label>
                                        <div class="col-md-10">
                                            <select type="text" required=""  name="marchent_name" id="marchent_name" class="form-control">
                                                <option value="">-- Select --</option>
                                                <?php foreach ($marchent as $value): ?>
                                                    <option value="<?= $value->id ?>"><?= $value->name ?>--<?= $value->company_name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Select payable tracking Id:</label>
                                        <div class="col-md-6" style="background-color:#dbf0f3; " id="trackId"></div>
                                        <div class="col-md-4">
                                            <input type="text"
                                                   name="amount"
                                                   id="amount"
                                                   readonly
                                                   value="0.00"
                                                   class="form-control" required="" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Adjust due from cancel product/Due Charge:</label>
                                        <div class="col-md-6" style="background-color: #ecaab4; " id="trackId2"></div>
                                        <div class="col-md-4">
                                            <input type="text"
                                                   name="amount1"
                                                   id="amount1"
                                                   readonly
                                                   value="0.00"
                                                   class="form-control" />
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="amount" class="control-label col-md-2">COD (%):</label>

                                        <div class="col-md-10">
                                            <input type="text"
                                                   name="amount3"
                                                   id="amount3"onkeypress="return isNumberKey(event);"
                                                   class="form-control"  />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount" class="control-label col-md-2"></label>

                                        <div class="col-md-4">
                                            <button type="button" id="total"  onclick="calculate_cod();" class="btn btn-success btn-large">Calculate Total Amount</button>
                                        </div>


                                        <label for="amount" class="control-label col-md-2"><b>Merchant Amount:</b></label>

                                        <div class="col-md-4">
                                            <input type="text" style="background-color: blueviolet;color:#fff;"
                                                   name="amount4"
                                                   id="amount4" readonly=""
                                                   class="form-control" required="" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="paid_type" class="control-label col-md-2">Paid Type:</label>
                                        <div class="col-md-10">
                                            <select type="text" required="" name="paid_type" id="paid_type" class="form-control">
                                                <option value="">-- Select --</option>
                                                <option value="1">Cash</option>
                                                <option value="2">bKash</option>
                                                <option value="3">Rocket</option>
                                                <option value="4">Bank Account</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Attach File:</label>
                                        <div class="col-md-10">
                                            <input type="file" name="fileToUpload" id="file_name"  class="form-control"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="summernote" class="control-label col-md-2">Remarks:</label>
                                        <div class="col-md-10">
                                            <textarea type="text" id="summernote" name="remarks" class="form-control"></textarea>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" id="submit1" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                    </div>
                                </div>
                                <br><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="<?= base_url('assets/global/plugins/bootstrap-summernote/summernote.min.js') ?>" type="text/javascript"></script>
<script>

                                                $("#submit1").prop("disabled", true);
                                                $(document).ready(function() {

                                                    $('#total').click(function() {
                                                        var total = $("#amount4").val();
                                                        if (total != '') {
                                                            $("#submit1").prop("disabled", false);
                                                        }
                                                        else {
                                                            $("#amount4").val('');
                                                            alert('Please select payable tracking id first.');
                                                        }
                                                    });
                                                });

                                                function isNumberKey(evt) {
                                                    var charCode = (evt.which) ? evt.which : evt.keyCode
                                                    return !(charCode > 31 && (charCode < 48 || charCode > 57));
                                                }

                                                function calculate_cod() {
                                                    var payval = $("#amount").val();
                                                    if (payval == '' || payval == '0.00') {
                                                        $("#amount1").val('');
                                                        $("#amount4").val('');
                                                        alert('Please select payable tracking id first.');
                                                    }
                                                    var adjust = $("#amount1").val();
                                                    var totlval = payval - adjust;
                                                    var cod = $("#amount3").val();
                                                    var pamount = (totlval * cod) / 100;
                                                    var merchat_amount = Math.round(totlval - pamount);
                                                    $("#amount4").val(merchat_amount);
                                                }
</script>







