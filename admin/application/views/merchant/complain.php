<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?= base_url('assets/global/plugins/bootstrap-summernote/summernote.css'); ?>" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="portlet box portletval">
            <div class="portlet-title">
                <div class="caption" style="color: darkgreen">Create Complain</div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXTRAS PORTLET-->
                        <div class="well gorm">
                            <form class="form-horizontal" action="<?= base_url('merchant/addcomplain'); ?>"
                                  method="post">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Complain Title:</label>
                                        <div class="col-md-10">
                                            <input type="text" name="complain_title" value="" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Complain Details:</label>
                                        <div class="col-md-10">
                                            <div >
                                                <textarea type=text" name="complain_details" id="summernote"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
        <script src="<?= base_url('assets/global/plugins/bootstrap-summernote/summernote.min.js') ?>" type="text/javascript"></script>
        <script>
                $(document).ready(function() {
                    $('#summernote').summernote({
                        height: 150
                    });
                });
        </script>
    </div>
</div>






