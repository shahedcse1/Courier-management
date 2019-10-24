<link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url('assets/global/plugins/bootstrap-summernote/summernote.css'); ?>" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box portletval">
                    <div class="portlet-title">
                        <div class="caption">Complain View</div>
                    </div>
                    <div class="portlet-body">

                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet ">
                                    <div class="portlet-body">
                                        <div class="col-md-12">
                                            <!-- BEGIN EXTRAS PORTLET-->
                                            <div class="well gorm">
                                                <form class="form-horizontal" action=""
                                                      method="post">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-2">Complain ID:</label>
                                                            <div class="col-md-10">
                                                                <input type="text" name="complain_title" value="<?php echo $complains_view->id; ?>" class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-2">Complain Title:</label>
                                                            <div class="col-md-10">
                                                                <input type="text" name="complain_title" value="<?php echo $complains_view->complain_title; ?>" class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-2">Created by:</label>
                                                            <div class="col-md-10">
                                                                <input type="text" name="complain_title" value="<?php echo $complains_view->name; ?>" class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-2">Created Date:</label>
                                                            <div class="col-md-10">
                                                                <input type="text" name="complain_title" value="<?php echo $complains_view->created_date; ?>" class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-2">Complain Details:</label>
                                                            <div class="col-md-10">
                                                                <div >
                                                                    <textarea type=text" name="complain_details" id="summernote"><?php echo $complains_view->complain_details; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="pull-right">
                                                            <a href="<?= base_url('merchant/complainlist'); ?>">
                                                                <button type="button" class="btn btn-danger">Back</button>
                                                            </a>
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
                </div>
            </div>

        </div>

    </div>
    <script src="<?= base_url('assets/global/plugins/bootstrap-summernote/summernote.min.js') ?>" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 150
            });
        });
    </script>
