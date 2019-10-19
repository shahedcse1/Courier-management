<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">All Merchant List .</div>
                    </div>
                    <div class="portlet-body">
                        <br><br>
                        <?php
                        if ($this->session->userdata('add')):
                            echo '<div class="alert alert-success fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Congrats !!! </strong> ' . $this->session->userdata('add') . '</div>' . '<br>' . '<br>';
                            $this->session->unset_userdata('add');

                        elseif ($this->session->userdata('notadd')):
                            echo '<div class="alert alert-block alert-danger fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Failed Meaasge !!! </strong> ' . $this->session->userdata('notadd') . '</div>';
                            $this->session->unset_userdata('notadd');
                        else:
                        endif;
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet ">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover text-center"
                                               id="sample_1">
                                            <thead class="table-background">
                                                <tr>
                                                    <th class="text-center">Serial</th>

                                                    <th class="text-center">Merchant Name </th>
                                                    <th class="text-center">Option </th>
                                                    <th class="text-center">Merchant Phone </th>
                                                    <th class="text-center">Address </th>
                                                    <th class="text-center">Company/Page Name </th>
                                                    <th class="text-center">payment </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (sizeof($users2)):
                                                    $i = 0;
                                                    foreach ($users2 as $value):
                                                        $i++;
                                                        ?>
                                                        <tr>
                                                            <td><?= $i; ?></td>
                                                            <td>
                                                                <a href="<?= base_url('Merchant/allrequest_list?id=' . $value->id); ?>">
                                                                    <?= $value->name; ?>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <?php if (empty($value->price_plan)): ?>
                                                                    <button class="btn btn-subscribe btn-circle  btn-xs"
                                                                            onclick="showsettings(<?= $value->id; ?>)">
                                                                        <i class="fa fa-pencil"></i>plan Settings
                                                                    </button>
                                                                <?php else: ?>
                                                                    <button class="btn btn-success btn-circle  btn-xs"
                                                                            onclick="showsettings(<?= $value->id; ?>)">
                                                                        <i class="fa fa-pencil"></i>plan update
                                                                    </button>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td><?= $value->phone; ?></td>
                                                            <td><?= $value->address; ?></td>
                                                            <td><?= $value->company_name ?></td>
                                                            <td><?php
                                                                if ($value->payment_type == 1):
                                                                    echo 'bKash' . '(' . $value->account_no . ')';
                                                                elseif ($value->payment_type == 2):
                                                                    echo 'Rocket' . '(' . $value->account_no . ')';
                                                                elseif ($value->payment_type == 2):
                                                                    echo 'Bank Account' . '(' . $value->account_no . ')';
                                                                else:
                                                                    echo 'N/A';
                                                                endif;
                                                                ?></td>
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

    </div>

    <div class="modal fade" id="settingmodal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('Userinfo/set_settings'); ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header table-background">
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Settings info.</h4>
                    </div>
                    <div class="modal-body col-md-12">
                        <div class="col-md-12">
                            <div class="form-group col-md-10">
                                <label>Price Plan :</label>
                                <input type="hidden" id="user_id" name="user_id" class="form-control">
                                <select name="price_plan" id="price_plan"
                                        class="col-md-12 brand   btn-sm dropdown-toggle"
                                        required >
                                    <option value="">--Select Plan--</option>
                                    <?php if (isset($priceplan)): ?>
                                        <?php foreach ($priceplan AS $val): ?>
                                            <option value="<?= $val->id; ?>"><?= $val->plan_type; ?> - <?= $val->price; ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-10">
                                <label>Weight Plan :</label>
                                <select name="weight_plan" id="weight_plan"
                                        class="col-md-12 brand  btn-sm dropdown-toggle"
                                        required >
                                    <option value="">--Select Plan--</option>
                                    <?php if (isset($weightplan)): ?>
                                        <?php foreach ($weightplan AS $val): ?>
                                            <option value="<?= $val->id; ?>"><?= $val->plan; ?> - <?= $val->price; ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-primary" id="add">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>

        function showsettings(id) {
            var user_id = id;
            $('#user_id').val(user_id);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Userinfo/getDetailsData'); ?>",
                data: 'id=' + user_id,
                success: function(data) {
                    var outputData = JSON.parse(data);
                    var response = outputData.userdata;

                    $("#price_plan").val(response.price_plan);
                    $("#weight_plan").val(response.weight_plan);
                    $('#settingmodal').modal('show');
                }
            });
        }

    </script>

