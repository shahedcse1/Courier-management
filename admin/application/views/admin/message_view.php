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
                                        <table class="table table-striped table-bordered table-hover text-center">
                                            <thead>
                                                <tr>
                                                    <th class="text-center table-background" colspan="2">Message</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td><?= $message_info->name; ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Phone</td>
                                                    <td><?= $message_info->phone; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td><?= $message_info->email; ?></td>
                                                </tr>

                                                <tr>
                                                    <td>Message</td>
                                                    <td><?= $message_info->message; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="pull-right">
                                            <a href="<?= base_url('messageinfo'); ?>">
                                                <button type="reset" class="btn btn-primary">Back</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- User Add Modal Start-->


            </div>
        </div>
    </div>

</div>

