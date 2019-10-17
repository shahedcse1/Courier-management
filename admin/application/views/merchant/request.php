<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
<style>
    #branchdetails {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        font-size: 12px;
    }
    #branchdetails td {
        padding-top: 8px;
        padding-bottom: 8px;
        text-align: left;
        color: black;
        width: 100px;

    }

    .tab {
        overflow: hidden;
        border: 2px solid black;
        //   background-color: yellow;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 10px 12px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color:greenyellow;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color:#f39c12;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: none;
        border-top: none;
    }
    .hidden { display: none; }
    .formfield { float: left; }
    .example-template { clear: left; }
</style>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <?php if (empty($priceplan)): ?>
                <div class="col-md-12">
                    <p style="color:red; font-size: 20px;">Sorry !! Your delivery price plan is not updated in our system.please make a complain or call us at 01842-775001

                    </p>
                    <div class="btn-group">
                        <a href="<?= base_url('merchant/complaincreate'); ?>" class="linkstyle">
                            <button class="btn btn-info btn-sm">
                                <i class="glyphicon glyphicon-plus"></i> Add Complain
                            </button>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-md-12">
                    <div class="tab">
                        <button  style="background-color:green;color:#fff;"class="tablinks" id="active" onclick="openCity(event, 'single')">Single product request</button>
                        <button class="tablinks"style="background-color:#F79646;" onclick="openCity(event, 'multiple')">Multiple product request</button>
                        <button class="tablinks"style="background-color:#4BACC6;" onclick="openCity(event, 'csv')">Import CSV/XLS</button>
                    </div>


                    <div id="csv" class="tabcontent">
                        <div class="portlet box portletval">
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                        <div class="portlet">
                                            <h4>Click On Download Icon For Download Sample File:</h4>
                                            <a href="<?= base_url('uploads/sample_file.xlsx'); ?>">
                                                <img  height="120px;"src="<?= base_url('uploads/download.jpg'); ?>">
                                            </a>
                                            <div class="portlet-body">
                                                <form class="form-horizontal" action="<?= base_url('merchant/file_upload') ?>" enctype="multipart/form-data" method="post"> 
                                                    <div class="col-md-10 col-lg-offset-1" style=" color:black; border: 1px solid black; padding: 20px;">
                                                        <h5>Import Deliveries:</h5><br>
                                                        <input type="file" name="data_import" id="data_import"><br><br>
                                                        <button type="submit" class="btn btn-primary" id="add">Upload Data</button>
                                                    </div>
                                                </form>


                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <div id="single" class="tabcontent">
                        <div class="portlet box portletval">
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                        <div class="portlet">
                                            <div class="portlet-body">
                                                <div class="col-md-10 col-lg-offset-1" style=" color:black; border: 1px solid black; padding: 32px;  border-radius: 55px;">
                                                    <form class="form-horizontal" action="<?= base_url('merchant/request_save') ?>" enctype="multipart/form-data" method="post"> 
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Delivery Zone:</b><span style="color:red;">*</span></label>
                                                            <div class="col-md-8">
                                                                <select  name="zoneid" id="zoneid" required  class="form-control">
                                                                    <option value="">Select</option>
                                                                    <?php
                                                                    if (isset($zones)):
                                                                        foreach ($zones AS $value):
                                                                            ?>
                                                                            <option value="<?= $value->id; ?>"><?= $value->zone_name; ?></option>
                                                                            <?php
                                                                        endforeach;
                                                                    endif;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" id="area_name">
                                                            <label class="control-label col-md-3"><b>Delivery Area:</b></label>
                                                            <div class="col-md-8">
                                                                <select  name="areaid" id="areaid"class="form-control">
                                                                    <option value="">Select</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group" id="district_name" style="display:none;">
                                                            <label class="control-label col-md-3"><b>District Name:</b></label>
                                                            <div class="col-md-8">
                                                                <select  name="districtid" id="districtid"class="form-control">
                                                                    <option value="">Select</option>
                                                                    <?php
                                                                    if (isset($district)):
                                                                        foreach ($district AS $value):
                                                                            ?>
                                                                            <option value="<?= $value->id; ?>"><?= $value->districtname; ?></option>
                                                                            <?php
                                                                        endforeach;
                                                                    endif;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Delivery Address:</b><span style="color:red;">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="address" id="address"  required   class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Customer Name:</b></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="customer_name" id="customer_name"  class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Customer Phone:</b><span style="color:red;">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" required onkeypress="return isNumberKey(event)" maxlength="11" name="customer_phone" id="customer_phone"  class="form-control"/>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Packet Weight:</b> <span style="color:red;">*</span></label>
                                                            <div class="col-md-8">
                                                                <select  name="weight" required id="weight"  class="form-control">
                                                                    <option value="">Select</option>
                                                                    <?php
                                                                    if (isset($weight)):
                                                                        foreach ($weight AS $value):
                                                                            ?>
                                                                            <option value="<?= $value->id; ?>"><?= $value->weight; ?></option>
                                                                            <?php
                                                                        endforeach;
                                                                    endif;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Product Price:</b> <span style="color:red;">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text"
                                                                       required
                                                                       onkeypress="return isNumberKey(event)"
                                                                       name="p_price"
                                                                       id="p_price"
                                                                       class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Quantity:</b><span style="color:red;">*</span></label>
                                                            <div class="col-md-3">
                                                                <input type="text" required name="quantity" oninput="calculate_net();" onkeypress="return isNumberKey(event);" id="quantity"   class="form-control"/>
                                                            </div>
                                                            <div class="col-md-4" style="background-color:honeydew; ">
                                                                <div class="col-md-7">
                                                                    <input type="text" placeholder="Total price" readonly name="total_price" id="total_price"   class="form-control"/>
                                                                </div>
                                                                <div class="col-md-3" id="takadiv"  style="display:none; padding: 5px;" >
                                                                    TAKA
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Order No.:</b></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="order_no" id="order_no"  class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Product Image:</b></label>
                                                            <div class="col-md-8">
                                                                <input type="file" name="fileToUpload" id="file_name"  class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Delivery Type:</b></label>
                                                            <div class="col-md-8">
                                                                <select  name="delivery_type" id="delivery_type"  class="form-control">
                                                                    <option value="1">Normal</option>
                                                                    <option value="2">Urgent</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Note:</b></label>
                                                            <div class="col-md-8">
                                                                <textarea name="details" id="details" value="" class="form-control">
                                                                </textarea>
                                                            </div>
                                                        </div>

                                                        <div class="pull-right">
                                                            <button type="submit" class="btn btn-primary" id="add">Submit Request</button>
                                                            <a href="<?= base_url('merchant/requestlist'); ?>">
                                                                <button type="button" class="btn btn-default" > Back </button>
                                                            </a>
                                                        </div>
                                                    </form>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <div id="multiple" class="tabcontent">
                        <div class="portlet box portletval">
                            <div class="portlet-body">
                                <form class="form-horizontal" action="<?= base_url('merchant/request_save_multiple') ?>" enctype="multipart/form-data" method="post"> 
                                    <div class="row">

                                        <div class="col-md-12">
                                            <!-- BEGIN EXAMPLE TABLE PORTLET-->

                                            <div class="portlet">
                                                <div class="portlet-body">
                                                    <div class="col-md-10 col-lg-offset-1" style=" color:black; border: 1px solid black; padding: 20px;">

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Delivery Zone:</b><span style="color:red;">*</span></label>
                                                            <div class="col-md-8">
                                                                <select  name="zoneid[]" id="zoneid" required  class="form-control">
                                                                    <option value="">Select</option>
                                                                    <?php
                                                                    if (isset($zones)):
                                                                        foreach ($zones AS $value):
                                                                            ?>
                                                                            <option value="<?= $value->id; ?>"><?= $value->zone_name; ?></option>
                                                                            <?php
                                                                        endforeach;
                                                                    endif;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Delivery Address:</b><span style="color:red;">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="address[]" id="address"  required   class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Customer Name:</b></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="customer_name[]" id="customer_name"  class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Customer Phone:</b><span style="color:red;">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" required onkeypress="return isNumberKey(event)" maxlength="11" name="customer_phone[]" id="customer_phone"  class="form-control"/>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Product Price:</b> <span style="color:red;">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text"  required  name="netprice[]" id="netprice"  class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Order No.:</b> </label>
                                                            <div class="col-md-8">
                                                                <input type="text"  name="order_no[]" id="order_no"  class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="edit-area">
                                                            <div class="controls">
                                                                <button class="add btn-success" type="button">Add Another + </button>
                                                                <button class="rem btn-danger"  type="button">Remove One - </button>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="hidden">
                                                        <div class="col-md-10 col-lg-offset-1 example-template" style="color:black; border: 1px solid black; padding: 20px; margin-top: 20px;">
                                                            <div class="pull-right" style="margin-bottom: 10px;"><button type="button" class="del btn-danger">Remove This</button></div><br>
                                                            <div class="form-group" >
                                                                <label class="control-label col-md-3"><b>Delivery Zone:</b><span style="color:red;">*</span></label>
                                                                <div class="col-md-8">
                                                                    <select  name="zoneid[]" id="zoneid" required  class="form-control">
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        if (isset($zones)):
                                                                            foreach ($zones AS $value):
                                                                                ?>
                                                                                <option value="<?= $value->id; ?>"><?= $value->zone_name; ?></option>
                                                                                <?php
                                                                            endforeach;
                                                                        endif;
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3"><b>Delivery Address:</b><span style="color:red;">*</span></label>
                                                                <div class="col-md-8">
                                                                    <input type="text" name="address[]" id="address"  required   class="form-control"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3"><b>Customer Name:</b></label>
                                                                <div class="col-md-8">
                                                                    <input type="text" name="customer_name[]" id="customer_name"  class="form-control"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3"><b>Customer Phone:</b><span style="color:red;">*</span></label>
                                                                <div class="col-md-8">
                                                                    <input type="text" required onkeypress="return isNumberKey(event)" maxlength="11" name="customer_phone[]" id="customer_phone"  class="form-control"/>
                                                                </div>
                                                            </div>


                                                            <div class="form-group">
                                                                <label class="control-label col-md-3"><b>Product Price:</b> <span style="color:red;">*</span></label>
                                                                <div class="col-md-8">
                                                                    <input type="text"  required  name="netprice[]" id="netprice"  class="form-control"/>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3"><b>Order No.:</b> </label>
                                                                <div class="col-md-8">
                                                                    <input type="text"  name="order_no[]" id="order_no"  class="form-control"/>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-primary" id="add">Submit Request</button>
                                            <a href="<?= base_url('merchant/requestlist'); ?>">
                                                <button type="button" class="btn btn-default" > Back </button>
                                            </a>
                                        </div>

                                    </div>
                            </div>
                            </form>
                        </div>



                        <!-- BEGIN EXAMPLE TABLE PORTLET-->

                    </div>
                </div>
            <?php endif; ?>

        </div>
        <div class="modal fade fade modal-auto-clear" id="infomodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header table-background">
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body col-md-12" style="  width: 100%; height:320px; background-image: url('<?= base_url('uploads/new.jpg'); ?>');" >

                    </div>
                    <div class="modal-footer ">
                        <h4 style="color:red;"><b> ডেলিভারি রিকুয়েস্ট পাঠাতে কোন সমষ্যার সম্মুক্ষীন হলে অথবা কোন সাহায্যের দরকার হলে 01842-775001 নাম্বারে আমাদের যোগাযোগ করুন। </b> </h4>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= base_url('assets/js/custom/staffinfo.js'); ?>" type="text/javascript"></script>
        <script>

                                                                    (function($) {
                                                                        "use strict";
                                                                        var itemTemplate = $('.example-template').detach(),
                                                                                editArea = $('.edit-area'),
                                                                                itemNumber = 1;

                                                                        $(document).on('click', '.edit-area .add', function(event) {
                                                                            var item = itemTemplate.clone();
                                                                            item.find('[name]').attr('name', function() {
                                                                                return $(this).attr('name') + '_' + itemNumber;
                                                                            });
                                                                            ++itemNumber;
                                                                            item.appendTo(editArea);
                                                                        });

                                                                        $(document).on('click', '.edit-area .rem', function(event) {
                                                                            editArea.children('.example-template').last().remove();
                                                                        });

                                                                        $(document).on('click', '.edit-area .del', function(event) {
                                                                            var target = $(event.target),
                                                                                    row = target.closest('.example-template');
                                                                            row.remove();
                                                                        });
                                                                    }(jQuery));
                                                                    function openCity(evt, cityName) {
                                                                        var i, tabcontent, tablinks;
                                                                        tabcontent = document.getElementsByClassName("tabcontent");
                                                                        for (i = 0; i < tabcontent.length; i++) {
                                                                            tabcontent[i].style.display = "none";
                                                                        }
                                                                        tablinks = document.getElementsByClassName("tablinks");
                                                                        for (i = 0; i < tablinks.length; i++) {
                                                                            tablinks[i].className = tablinks[i].className.replace(" active", "");
                                                                        }
                                                                        document.getElementById(cityName).style.display = "block";
                                                                        evt.currentTarget.className += " active";
                                                                    }
                                                                    document.getElementById("active").click();

        </script>



