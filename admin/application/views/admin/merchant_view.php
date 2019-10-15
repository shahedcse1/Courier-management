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
                                                    <th class="text-center">Merchant Phone </th>
                                                    <th class="text-center">Email </th>
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
                                                            <td><?= $value->name; ?></td>
                                                            <td><?= $value->phone; ?></td>
                                                            <td><?= $value->email; ?></td>
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
