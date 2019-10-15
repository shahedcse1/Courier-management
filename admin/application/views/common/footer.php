<!-- BEGIN QUICK SIDEBAR -->

<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer" style="background-color:#1B2757;">
    <div class="text-center" style="color:#fff;">
        <a target="_blank" href="https://www.facebook.com/shahed.cse">Design And Developed by Shahed cse</a>
        <a href="#" class="go-top ">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>
</div>
<!-- END FOOTER -->
</div>
<script>
    var site_url = "<?= site_url(); ?>";
</script>

<!-- BEGIN CORE PLUGINS -->
<script src="<?= base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/global/plugins/js.cookie.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= base_url('assets/global/scripts/datatable.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/global/plugins/datatables/datatables.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/pages/scripts/table-datatables-buttons.min.js'); ?>" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?= base_url('assets/global/scripts/app.min.js'); ?>" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<script>
    var base_url = "<?= base_url(); ?>";
</script>

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?= base_url('assets/layouts/layout/scripts/layout.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/layouts/layout/scripts/demo.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/layouts/global/scripts/quick-sidebar.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/layouts/global/scripts/quick-nav.min.js'); ?>" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!-- Asset Management -->
<?= load_assets('js'); ?>


<!-- Sweet Alert -->
<script>
    $(document).ready(function() {
        $('#clickmewow').click(function()
        {
            $('#radio1003').attr('checked', 'checked');
        });
    });
</script>
<script type="text/javascript">
    (function() {
        var options = {
            facebook: "232125570864856", // Facebook page ID
            call_to_action: "Message us", // Call to action
            position: "right" // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = url + '/widget-send-button/js/init.js';
        s.onload = function() {
            WhWidgetSendButton.init(host, proto, options);
        };
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
    })();
</script>
</body>

</html>