<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">All Messages</div>
                    </div>

                    <div class="portlet-body">
                        <br><br>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet ">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover text-center"
                                               id="sample_1">
                                            <thead class="table-background">
                                                <tr>
                                                    <th class="text-center">id</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Phone</th>
                                                    <th class="text-center">Send Date</th>
                                                    <th class="text-center">Option</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (isset($message_info)): ?>
                                                    <?php foreach ($message_info as $value):
                                                        ?>
                                                        <tr>
                                                            <td><?= $value->id; ?></td>
                                                            <td><?= $value->name; ?></td>
                                                            <td><?= $value->phone; ?></td>
                                                            <td><?= $value->created_date; ?></td>
                                                            <td class="text-center">
                                                                <a href="<?= base_url('messageinfo/view_message?id=' . $value->id); ?>">
                                                                    <button class="editmodal btn btn-primary btn-circle  btn-xs" >
                                                                        view
                                                                    </button>
                                                                </a>

                                                            </td>
                                                        </tr>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div><!-- User Add Modal Start-->


                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- User Add Modal Start-->


            </div>
        </div>
    </div>

</div>
