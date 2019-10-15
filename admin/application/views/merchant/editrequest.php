<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">
                            <?php if ($role == 2): ?>
                                Edit Request
                            <?php else: ?>
                                Process Request
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet">
                                    <div class="portlet-body">
                                        <div class="col-md-10 col-lg-offset-1" style=" color:black; border: 1px solid black; padding: 20px;">
                                            <form class="form-horizontal" action="<?= base_url('merchant/request_update/' . $status) ?>" enctype="multipart/form-data" method="post">
                                                <input type="hidden" name="id" id="id" value="<?= $allinfo->id; ?>"  class="form-control"/>
                                                <?php if ($role == 2): ?>
                                                    <?php if ($allinfo->final_status == 1): ?>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Delivery Zone:</b><span style="color:red;">*</span></label>
                                                            <div class="col-md-8">
                                                                <select  name="zoneid" id="zoneid" required  class="form-control">
                                                                    <option value="">Select</option>
                                                                    <?php
                                                                    if (isset($zones)):
                                                                        foreach ($zones AS $value):
                                                                            if ($allinfo->zoneid == $value->id):
                                                                                ?>
                                                                                <option value="<?= $value->id; ?>"selected><?= $value->zone_name; ?></option>
                                                                            <?php else: ?>
                                                                                <option value="<?= $value->id; ?>"><?= $value->zone_name; ?></option>
                                                                            <?php
                                                                            endif;
                                                                        endforeach;
                                                                    endif;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <?php if (!empty($allinfo->areaid)): ?>
                                                            <div class="form-group" id="area_name">
                                                                <label class="control-label col-md-3"><b>Delivery Area:</b></label>
                                                                <div class="col-md-8">
                                                                    <?php
                                                                    $areaname = $this->db->query("SELECT area_name FROM area WHERE id='$allinfo->areaid'");
                                                                    if ($areaname->num_rows()):
                                                                        $area = $areaname->row()->area_name;
                                                                    endif;
                                                                    ?>
                                                                    <select  name="areaid" id="areaid" class="form-control">
                                                                        <option value="<?= $allinfo->areaid; ?>"><?php echo $area; ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (!empty($allinfo->distrcitid)): ?>
                                                            <div class="form-group" >
                                                                <label class="control-label col-md-3"><b>District Name:</b></label>
                                                                <div class="col-md-8">
                                                                    <select  name="districtid" id="districtid"class="form-control">
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                        if (isset($district)):
                                                                            foreach ($district AS $value):
                                                                                if ($allinfo->districtid == $value->id):
                                                                                    ?>
                                                                                    <option value="<?= $value->id; ?>" selected=""><?= $value->districtname; ?></option>
                                                                                <?php else: ?>
                                                                                    <option value="<?= $value->id; ?>"><?= $value->districtname; ?></option>
                                                                                <?php
                                                                                endif;
                                                                            endforeach;
                                                                        endif;
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="form-group" id="district_name" style="display: none;">
                                                            <label class="control-label col-md-3"><b>District Name:</b></label>
                                                            <div class="col-md-8">
                                                                <select  name="districtid" id="districtid"class="form-control">
                                                                    <option value="">Select</option>
                                                                    <?php
                                                                    if (isset($district)):
                                                                        foreach ($district AS $value):
                                                                            if ($allinfo->districtid == $value->id):
                                                                                ?>
                                                                                <option value="<?= $value->id; ?>" selected=""><?= $value->districtname; ?></option>
                                                                            <?php else: ?>
                                                                                <option value="<?= $value->id; ?>"><?= $value->districtname; ?></option>
                                                                            <?php
                                                                            endif;
                                                                        endforeach;
                                                                    endif;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Delivery Address:</b><span style="color:red;">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="address" id="address" value="<?= $allinfo->d_address; ?>"  required   class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Customer Name:</b></label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="customer_name" value="<?= $allinfo->customer_name; ?>" id="customer_name"  class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Customer Phone:</b><span style="color:red;">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text" required onkeypress="return isNumberKey(event)" value="<?= $allinfo->customer_phone; ?>" maxlength="11" name="customer_phone" id="customer_phone"  class="form-control"/>
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
                                                                            if ($allinfo->p_weight == $value->id):
                                                                                ?>
                                                                                <option value="<?= $value->id; ?>"selected=""><?= $value->weight; ?></option>
                                                                            <?php else: ?>
                                                                                <option value="<?= $value->id; ?>"><?= $value->weight; ?></option>
                                                                            <?php
                                                                            endif;
                                                                        endforeach;
                                                                    endif;
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Product price:</b> <span style="color:red;">*</span></label>
                                                            <div class="col-md-8">
                                                                <input type="text"  required onkeypress="return isNumberKey(event)" value="<?= $allinfo->product_price ?>" name="p_price" id="p_price"  class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Quantity:</b><span style="color:red;">*</span></label>
                                                            <div class="col-md-3">
                                                                <input type="text" required name="quantity" value="<?= $allinfo->quantity ?>" oninput="calculate_net();" onkeypress="return isNumberKey(event);" id="quantity"   class="form-control"/>
                                                            </div>
                                                            <div class="col-md-4" style="background-color:honeydew; ">
                                                                <div class="col-md-7">
                                                                    <input type="text" placeholder="Total price" value="<?= $allinfo->netprice ?>" readonly name="total_price" id="total_price"   class="form-control"/>
                                                                </div>
                                                                <div class="col-md-3" id="takadiv"  style="display:none; padding: 5px;" >
                                                                    TAKA
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Product image:</b></label>
                                                            <?php if ($role == 2): ?>
                                                                <div class="col-md-8">
                                                                    <input type="file" name="fileToUpload" id="file_name"  class="form-control"/>
                                                                </div>
                                                                img:<a target="_blank"href="<?php echo base_url('uploads/product/') . $allinfo->p_img_path ?>"> <?= $allinfo->p_img_path ?></a>
                                                            <?php else: ?>
                                                                <div class="col-md-8">
                                                                    <a target="_blank"href="<?php echo base_url('uploads/product/') . $allinfo->p_img_path ?>"> <?= $allinfo->p_img_path ?></a>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Delivery Type:</b></label>
                                                            <div class="col-md-8">
                                                                <select  name="delivery_type" id="delivery_type"  class="form-control">
                                                                    <option<?php if ($allinfo->delivery_type == 1): ?> checked <?php endif; ?> value="1">Normal</option>
                                                                    <option <?php if ($allinfo->delivery_type == 2): ?> checked <?php endif; ?> value="2">Argent</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Note:</b></label>
                                                            <div class="col-md-8">
                                                                <textarea name="details" id="details" value="" class="form-control">
                                                                    <?= $allinfo->note ?>
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    <?php elseif ($allinfo->final_status == 2 || $allinfo->final_status == 3 || $allinfo->final_status == 4 || $allinfo->final_status == 5): ?>
                                                        <div class="form-group" style="background-color:#c9effa; ">
                                                            <label class="control-label col-md-3"><b>Delivery Zone:</b></label>
                                                            <div class=" control-label col-md-2">
                                                                <?php
                                                                $zonenameqr = $this->db->query("SELECT zone_name FROM zone WHERE id='$allinfo->zoneid'");
                                                                if ($zonenameqr->num_rows()):
                                                                    echo $zonenameqr->row()->zone_name;
                                                                else:
                                                                    echo 'N/A';
                                                                endif;
                                                                ?>
                                                            </div>

                                                            <?php if (!empty($allinfo->areaid)): ?>

                                                                <label class="control-label col-md-3"><b>Delivery Area:</b></label>
                                                                <div class=" control-label col-md-2">
                                                                    <?php
                                                                    $areaname = $this->db->query("SELECT area_name FROM area WHERE id='$allinfo->areaid'");
                                                                    if ($areaname->num_rows()):
                                                                        echo $areaname->row()->area_name;
                                                                    else:
                                                                        echo 'N/A';
                                                                    endif;
                                                                    ?>

                                                                </div>

                                                            <?php endif; ?>
                                                            <?php if (!empty($allinfo->distrcitid)): ?>

                                                                <label class="control-label col-md-3"><b>District Name:</b></label>
                                                                <div class="control-label col-md-2">
                                                                    <?php
                                                                    $districtname = $this->db->query("SELECT districtname FROM district_govt WHERE id='$allinfo->districtid'");
                                                                    if ($districtname->num_rows()):
                                                                        echo $districtname->row()->districtname;
                                                                    else:
                                                                        echo 'N/A';
                                                                    endif;
                                                                    ?>
                                                                </div>
                                                            <?php endif; ?>
                                                            <label class="control-label col-md-3"><b>Delivery Address:</b></label>
                                                            <div class="control-label col-md-2">
                                                                <?= $allinfo->d_address; ?>
                                                            </div>


                                                            <label class="control-label col-md-3"><b>Customer Name:</b></label>
                                                            <div class="control-label col-md-2">
                                                                <?= $allinfo->customer_name; ?>
                                                            </div>


                                                            <label class="control-label col-md-3"><b>Customer Phone:</b></label>
                                                            <div class="control-label col-md-2">
                                                                <?= $allinfo->customer_phone; ?>
                                                            </div>



                                                            <label class="control-label col-md-3"><b>Packet Weight:</b></label>
                                                            <div class="control-label col-md-2">
                                                                <?php
                                                                $weight = $this->db->query("SELECT weight FROM weight_info WHERE id='$allinfo->p_weight'");
                                                                if ($weight->num_rows()):
                                                                    echo $weight->row()->weight;
                                                                else:
                                                                    echo 'N/A';
                                                                endif;
                                                                ?>
                                                            </div>

                                                            <label class="control-label col-md-3"><b>Product price:</b> </label>
                                                            <div class="control-label col-md-2">
                                                                <?= $allinfo->product_price ?>
                                                            </div>

                                                            <label class="control-label col-md-3"><b>Quantity:</b></label>
                                                            <div class="control-label col-md-2">
                                                                <?= $allinfo->quantity ?>
                                                            </div>

                                                            <label class="control-label col-md-3"><b>Net price:</b></label>
                                                            <div class="control-label col-md-2">
                                                                <?= $allinfo->netprice ?>
                                                            </div>

                                                            <label class="control-label col-md-3"><b>Product image:</b></label>
                                                            <div class="control-label col-md-2">
                                                                <a target="_blank"href="<?php echo base_url('uploads/product/') . $allinfo->p_img_path ?>"> <?= $allinfo->p_img_path ?></a>
                                                            </div>


                                                            <label class="control-label col-md-3"><b>Delivery Type:</b></label>
                                                            <div class="control-label col-md-2">
                                                                <?php
                                                                if ($allinfo->delivery_type == 1):
                                                                    echo ' Normal';
                                                                else:
                                                                    echo 'Argent';
                                                                endif;
                                                                ?>
                                                            </div>

                                                            <label class="control-label col-md-3"><b>Note:</b></label>
                                                            <div class="control-label col-md-2">
                                                                <?= $allinfo->note ?>
                                                            </div>
                                                        </div>
                                                        <?php if ($allinfo->final_status == 4 || $allinfo->final_status == 5 || $allinfo->final_status == 6): ?>
                                                            <h4 style="text-align-last:left;text-decoration:underline;FONT-WEIGHT:BOLD;">Admin process:</h4>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4"><b>Product received From Merchant:</b><span style="color:red;">*</span></label>
                                                                <div class="control-label col-md-4">
                                                                    <input type="checkbox"  name="product_receive"<?php if ($allinfo->product_receive == 1): ?> Checked <?php endif; ?> value="1">&nbsp;&nbsp;  YES (<?php
                                                                    if (!empty($allinfo->inhousedate)): echo 'Received Date-' . $allinfo->inhousedate;
                                                                    endif;
                                                                    ?>)
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3"><b>Delivery man:</b></label>
                                                                <div class="control-label col-md-2">
                                                                    <select  required   name="delivery_man" disabled="" id="delivery_man"  class="form-control"/>
                                                                    <option value="">--Select--</option>
                                                                    <?php
                                                                    foreach ($deliveryman as $value):
                                                                        if ($allinfo->delivery_man == $value->id):
                                                                            ?>
                                                                            <option value="<?php echo $value->id; ?>"selected=""><?php echo $value->name; ?></option>
                                                                        <?php else: ?>
                                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                                                        <?php
                                                                        endif;
                                                                    endforeach;
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                                <?php
                                                                $phoneqr = $this->db->query("SELECT phone FROM staffs  where id='$allinfo->delivery_man'");
                                                                if ($phoneqr->num_rows()):
                                                                    $phone = $phoneqr->row()->phone;
                                                                else:
                                                                    $phone = 'N/A';
                                                                endif;
                                                                ?>
                                                                <div class="control-label col-md-4"><h4 style="color:green">Contact No:<?= $phone ?></h4></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3"><b>Delivery Charge:</b></label>
                                                                <div class="control-label col-md-4">
                                                                    <input type="text"  required  readonly="" onkeypress="return isNumberKey(event)" value="<?= $allinfo->delivery_cost; ?>"  name="delivery_cost" id="delivery_cost"  class="form-control"/>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-4"><b>Delivery Charge and price Collect From Delivery man:</b></label>
                                                                <div class="control-label col-md-4">
                                                                    <input type="checkbox" name="delivery_Charge"<?php if ($allinfo->collect_frmod == 1): ?> Checked <?php endif; ?> value="1">&nbsp;&nbsp;  YES
                                                                    &nbsp;&nbsp;<h4 style="color:red;">(Total Taka:<?= $allinfo->netprice + $allinfo->delivery_cost ?>)</h4>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if ($role == 1 || $role == 3): ?>
                                                    <h4 style="text-align-last:left;text-decoration:underline;FONT-WEIGHT:BOLD;">Delivery Basic Info:</h4>
                                                    <div class="form-group" style="background-color:#c9effa; ">
                                                        <label class="control-label col-md-3"><b>Delivery Zone:</b></label>
                                                        <div class=" control-label col-md-2">
                                                            <?php
                                                            $zonenameqr = $this->db->query("SELECT zone_name FROM zone WHERE id='$allinfo->zoneid'");
                                                            if ($zonenameqr->num_rows()):
                                                                echo $zonenameqr->row()->zone_name;
                                                            else:
                                                                echo 'N/A';
                                                            endif;
                                                            ?>
                                                        </div>

                                                        <?php if (!empty($allinfo->areaid)): ?>

                                                            <label class="control-label col-md-3"><b>Delivery Area:</b></label>
                                                            <div class=" control-label col-md-2">
                                                                <?php
                                                                $areaname = $this->db->query("SELECT area_name FROM area WHERE id='$allinfo->areaid'");
                                                                if ($areaname->num_rows()):
                                                                    echo $areaname->row()->area_name;
                                                                else:
                                                                    echo 'N/A';
                                                                endif;
                                                                ?>

                                                            </div>

                                                        <?php endif; ?>
                                                        <?php if (!empty($allinfo->distrcitid)): ?>

                                                            <label class="control-label col-md-3"><b>District Name:</b></label>
                                                            <div class="control-label col-md-2">
                                                                <?php
                                                                $districtname = $this->db->query("SELECT districtname FROM district_govt WHERE id='$allinfo->districtid'");
                                                                if ($districtname->num_rows()):
                                                                    echo $districtname->row()->districtname;
                                                                else:
                                                                    echo 'N/A';
                                                                endif;
                                                                ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <label class="control-label col-md-3"><b>Delivery Address:</b></label>
                                                        <div class="control-label col-md-2">
                                                            <?= $allinfo->d_address; ?>
                                                        </div>


                                                        <label class="control-label col-md-3"><b>Customer Name:</b></label>
                                                        <div class="control-label col-md-2">
                                                            <?= $allinfo->customer_name; ?>
                                                        </div>


                                                        <label class="control-label col-md-3"><b>Customer Phone:</b></label>
                                                        <div class="control-label col-md-2">
                                                            <?= $allinfo->customer_phone; ?>
                                                        </div>



                                                        <label class="control-label col-md-3"><b>Packet Weight:</b></label>
                                                        <div class="control-label col-md-2">
                                                            <?php
                                                            $weight = $this->db->query("SELECT weight FROM weight_info WHERE id='$allinfo->p_weight'");
                                                            if ($weight->num_rows()):
                                                                echo $weight->row()->weight;
                                                            else:
                                                                echo 'N/A';
                                                            endif;
                                                            ?>
                                                        </div>

                                                        <label class="control-label col-md-3"><b>Product price:</b> </label>
                                                        <div class="control-label col-md-2">
                                                            <?= $allinfo->product_price ?>
                                                        </div>

                                                        <label class="control-label col-md-3"><b>Quantity:</b></label>
                                                        <div class="control-label col-md-2">
                                                            <?= $allinfo->quantity ?>
                                                        </div>

                                                        <label class="control-label col-md-3"><b>Net price:</b></label>
                                                        <div class="control-label col-md-2">
                                                            <?= $allinfo->netprice ?>
                                                        </div>

                                                        <label class="control-label col-md-3"><b>Product image:</b></label>
                                                        <div class="control-label col-md-2">
                                                            <a target="_blank"href="<?php echo base_url('uploads/product/') . $allinfo->p_img_path ?>"> <?= $allinfo->p_img_path ?></a>
                                                        </div>


                                                        <label class="control-label col-md-3"><b>Delivery Type:</b></label>
                                                        <div class="control-label col-md-2">
                                                            <?php
                                                            if ($allinfo->delivery_type == 1):
                                                                echo ' Normal';
                                                            else:
                                                                echo 'Argent';
                                                            endif;
                                                            ?>
                                                        </div>

                                                        <label class="control-label col-md-3"><b>Note:</b></label>
                                                        <div class="control-label col-md-2">
                                                            <?= $allinfo->note ?>
                                                        </div>
                                                    </div>
                                                    <h4 style="text-align-last:left;text-decoration:underline;FONT-WEIGHT:BOLD;">Admin process:</h4>
                                                    <?php if ($allinfo->final_status == 2): ?>
                                                        (**After Receive product from marchent this section will be proceed. )
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4"><b>Product received From Merchant:</b><span style="color:red;">*</span></label>
                                                            <div class="control-label col-md-3">
                                                                <input type="checkbox" name="product_receive" value="1">&nbsp;&nbsp;  YES
                                                            </div>
                                                        </div>

                                                    <?php elseif ($allinfo->final_status == 4): ?>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4"><b>Product received From Merchant:</b><span style="color:red;">*</span></label>
                                                            <div class="control-label col-md-4">
                                                                <input type="checkbox"  name="product_receive"<?php if ($allinfo->product_receive == 1): ?> Checked <?php endif; ?> value="1">&nbsp;&nbsp;  YES (<?php
                                                                if (!empty($allinfo->inhousedate)): echo 'Received Date-' . $allinfo->inhousedate;
                                                                endif;
                                                                ?>)
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Asign To delivery man:</b></label>
                                                            <div class="control-label col-md-4">
                                                                <select  required   name="delivery_man"  id="delivery_man"  class="form-control"/>
                                                                <option value="">--Select--</option>
                                                                <?php
                                                                foreach ($deliveryman as $value):
                                                                    if ($allinfo->delivery_man == $value->id):
                                                                        ?>
                                                                        <option value="<?php echo $value->id; ?>"selected=""><?php echo $value->name; ?></option>
                                                                    <?php else: ?>
                                                                        <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                                                    <?php
                                                                    endif;
                                                                endforeach;
                                                                ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Set Delivery Charge:</b></label>
                                                            <div class="control-label col-md-4">
                                                                <input type="text"  required   onkeypress="return isNumberKey(event)" value="<?= $allinfo->delivery_cost; ?>"  name="delivery_cost" id="delivery_cost"  class="form-control"/>
                                                            </div>
                                                        </div>

                                                    <?php elseif ($allinfo->final_status == 6 || $allinfo->final_status == 5): ?>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4"><b>Product received From Merchant:</b><span style="color:red;">*</span></label>
                                                            <div class="control-label col-md-4">
                                                                <input type="checkbox"  name="product_receive"<?php if ($allinfo->product_receive == 1): ?> Checked <?php endif; ?> value="1">&nbsp;&nbsp;  YES (<?php
                                                                if (!empty($allinfo->inhousedate)): echo 'Received Date-' . $allinfo->inhousedate;
                                                                endif;
                                                                ?>)
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Asign To delivery man:</b></label>
                                                            <div class="control-label col-md-4">
                                                                <select  required   name="delivery_man" disabled=""  id="delivery_man"  class="form-control"/>
                                                                <option value="">--Select--</option>
                                                                <?php
                                                                foreach ($deliveryman as $value):
                                                                    if ($allinfo->delivery_man == $value->id):
                                                                        ?>
                                                                        <option value="<?php echo $value->id; ?>"selected=""><?php echo $value->name; ?></option>
                                                                    <?php else: ?>
                                                                        <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                                                    <?php
                                                                    endif;
                                                                endforeach;
                                                                ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3"><b>Set Delivery Charge:</b></label>
                                                            <div class="control-label col-md-4">
                                                                <input type="text"  readonly=""  onkeypress="return isNumberKey(event)" value="<?= $allinfo->delivery_cost; ?>"  name="delivery_cost" id="delivery_cost"  class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <?php if ($allinfo->final_status == 6): ?>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3"><b>Delay note's:</b></label>
                                                                <div class="control-label col-md-4">
                                                                    <textarea type="text" name="delay_notes"  id="delay_notes"  class="form-control">
                                                                        <?= $allinfo->delay_notes; ?>
                                                                    </textarea>
                                                                    <button type="button" onclick="update_delay();" class="btn-default">Update</button>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>



                                                        <div class="form-group">
                                                            <label class="control-label col-md-4"><b>Delivery Charge and price Collect From Delivery Man:</b></label>
                                                            <div class="control-label col-md-4">
                                                                <input type="checkbox" name="delivery_Charge"<?php if ($allinfo->collect_frmod == 1): ?> Checked <?php endif; ?> value="1">&nbsp;&nbsp;  YES
                                                                &nbsp;&nbsp;<h4 style="color:red;">(Total Taka:<?= $allinfo->netprice + $allinfo->delivery_cost ?>)</h4>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <div class="pull-right">
                                                    <?php if ($role == 2): ?>
                                                        <?php if ($allinfo->final_status == 1): ?>
                                                            <button type="submit" class="btn btn-primary" id="add">update Request</button>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php if ($allinfo->final_status == 1): ?>
                                                            <button type="submit" value="2" class="btn btn-primary" name="final_status">Request In-progress</button>
                                                            <button type="submit" value="3" class="btn btn-danger" name="final_status">Request Cancel </button>
                                                        <?php elseif ($allinfo->final_status == 2): ?>
                                                            <button type="submit" value="4" class="btn btn-primary" name="final_status">product In-house</button>
                                                        <?php elseif ($allinfo->final_status == 4): ?>
                                                            <button type="submit" value="6" class="btn btn-primary" name="final_status">Out For Delivery</button>
                                                        <?php elseif ($allinfo->final_status == 6): ?>
                                                            <button type="submit" value="7" class="btn btn-danger" name="final_status">Canceled By Customer </button>
                                                            <button type="submit" style="background-color: #9BBB59;" value="5" class="btn btn-primary" name="final_status">Delivery Completed</button>
                                                        <?php elseif ($allinfo->final_status == 7 && $allinfo->product_returned == 0): ?>
                                                            <button type="submit"  value="8" class="btn btn-primary" name="final_status">Product Returned to Vendor</button>
                                                        <?php endif; ?>
                                                    <?php endif; ?>


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
        </div>
    </div>
    <script>
        function update_delay() {
            var id = $("#id").val();
            var notes = $("#delay_notes").val();


            if (notes == '') {
                alert('Please write Something');
            }
            else {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url('merchant/update_delay'); ?>",
                    data: {
                        id: id,
                        notes: notes
                    }
                });
                alert('Notes added Succesfully');
                location.reload();
            }
        }


        $('document').ready(function()
        {
            $('textarea').each(function() {
                $(this).val($(this).val().trim());
            }
            );
        });
    </script>
    <script src="<?= base_url('assets/js/custom/staffinfo.js'); ?>" type="text/javascript"></script>


