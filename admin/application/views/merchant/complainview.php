<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">All Complain</div>
                    </div>
                    <div class="portlet-body">
                        <?php if ($role == 2): ?>
                            <div class="btn-group">
                                <a href="<?= base_url('merchant/complaincreate'); ?>" class="linkstyle">
                                    <button class="btn btn-info btn-sm">
                                        <i class="glyphicon glyphicon-plus"></i> Add Complain
                                    </button>
                                </a>
                            </div>
                        <?php endif; ?>
                        <br><br>
                        <?php
                        if ($this->session->userdata('add')):
                            echo '<div class="alert alert-success fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Success Message !!! </strong> ' . $this->session->userdata('add') . '</div>' . '<br>' . '<br>';
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

                                                    <th class="text-center">complain ID</th>
                                                    <th class="text-center">complain Tile</th>
                                                    <th class="text-center">Created by</th>
                                                    <th class="text-center">Created Date</th>
                                                    <th class="text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (isset($complains)): ?>
                                                    <?php foreach ($complains as $complain):
                                                        ?>
                                                        <tr>
                                                            <td><?= $complain->id; ?></td>
                                                            <td><?= $complain->complain_title; ?></td>
                                                            <td><?= $complain->name; ?></td>
                                                            <td><?= $complain->created_date; ?></td>
                                                            <td>
                                                                <a href="<?= base_url('merchant/complain_view?id=' . $complain->id); ?>" >
                                                                    <button type=" button">View</button>
                                                                </a>
                                                            </td>
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
