<style>
    body {font-family: Arial, Helvetica, sans-serif;}
    * {box-sizing: border-box;}

    /* Button used to open the contact form - fixed at the bottom of the page */
    .open-button {
        background-color: #F5AB35  ;
        color: black;
        padding: 6px 30px;
        border: 1px solid black;
        cursor: pointer;
        opacity: 0.8;
        position: fixed;
        bottom: 2px;
        right: 18px;
        width: 240px;

    }

    /* The popup form - hidden by default */
    .form-popup {
        display: none;
        position: fixed;
        bottom: 0;
        right: 15px;
        border: 3px solid #f1f1f1;
        z-index: 9;

    }

    /* Add styles to the form container */
    .form-container {
        max-width: 320px;
        padding: 5px;
        background-color: #F5AB35;
        color: black;
        border: 1px solid black;
    }

    /* Full-width input fields */
    .form-container input[type=text], .form-container input[type=password] {
        width: 100%;
        padding: 5px;
        margin: 5px 0 12px 0;
        border: none;
        background: #f1f1f1;
    }

    /* When the inputs get focus, do something */
    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Set a style for the submit/login button */
    .form-container .btn {
        background-color: #4CAF50;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom:10px;
        opacity: 0.8;
    }

    /* Add a red background color to the cancel button */
    .form-container .cancel {
        background-color: red;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
        opacity: 1;
    }


    .mover {
        position: absolute;
        top: 25px;
    }

</style>

<footer>
    <div class="footer-main pad-120 white-clr">
        <div class="theme-container container">               
            <div class="row">
                <div class="col-md-3 col-sm-6 footer-widget">
                    <a href="#"> <img class="logo" alt="<?= base_url(); ?>" src="<?= base_url('assets/img/logo/logo-white.png') ?>" />  </a>
                </div>

                <div class="col-md-3 col-sm-6 footer-widget">
                    <h2 class="title-1 fw-900">Address</h2>
                    House-3/1, Road-8, Dhanmondi, Dhaka-1205
                </div>

                <div class="col-md-3 col-sm-6 footer-widget">
                    <h2 class="title-1 fw-900">quick links</h2>
                    <ul>
                        <li><a href="<?= base_url('about'); ?>">About Us</a></li>
                        <li><a href="<?= base_url('services'); ?>">Services</a></li>
                        <li><a href="<?= base_url('tracking'); ?>">Tracking</a></li>
                        <li><a href="<?= base_url('contact'); ?>">Contact</a></li>
                        <li><a href="<?= base_url('blog'); ?>">Blog</a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-sm-6 footer-widget">
                    <h2 class="title-1 fw-900">get in touch</h2>
                    <ul class="social-icons list-inline">
                        <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".20s"><a target="_blank" href="https://www.facebook.com/parcelxpressbd/"><i style="padding-top: 9px;font-size: 14px" class="fab fa-facebook-f"></i></a></li>
                        <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".25s"><a href="#"><i style="padding-top: 9px;font-size: 14px" class="fab fa-twitter"></i></a></li>
                        <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".30s"><a href="#"><i style="padding-top: 9px;font-size: 14px" class="fab fa-google-plus-g"></i></a> </li>
                        <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".35s"><a href="#"><i style="padding-top: 9px;font-size: 14px" class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="theme-container container">               
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <p> © Copyright <?php echo date("Y", strtotime(date('Y-m-d'))); ?>, All rights reserved by <a href="<?= base_url(); ?>"> parcel xpress BD</a></p>
                </div>
                <div class="col-md-6 col-sm-6 text-right">

                </div>
            </div>
        </div>
    </div>
</footer>
<!--<div class="to-top theme-clr-bg transition" style="background-color: red;"> <i class="fa fa-angle-up"></i> </div>-->

<!-- Popup: Login -->
<div class="modal fade login-popup" id="login-popup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">                
        <a class="close close-btn" data-dismiss="modal" aria-label="Close"> x </a>

        <div class="modal-content">   
            <div class="login-wrap text-center">                        
                <h2 class="title-3">sign in</h2>
                <p> Sign in to <strong> Parcel Xpress BD </strong> for getting all details </p>                        

                <div class="login-form clrbg-before">
                    <form class="login-form" action="<?= base_url('admin/auth/login') ?>" method="post">
                        <div class="form-group"><input type="text" placeholder="User Pin" name="userpin" id="userpin" class="form-control"></div>
                        <div class="form-group"><input type="password" placeholder="Password" name="password" id="user_password" class="form-control"></div>
                        <div class="form-group">
                            <button class="btn-1" type="submit" style="background-color: #FAD91B;">Sign in now</button>
                        </div>
                        <div class="form-group">
                            New to Parcel Xpress BD ? <a target="_blank" style="text-decoration: underline" class="text-success" href="<?= base_url('home/register'); ?>">Create a free account.</a>
                        </div>
                    </form>
                </div>                        
            </div>
        </div>
    </div>
</div>

<div class="modal fade login-popup" id="register-popup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">                
        <a class="close close-btn" data-dismiss="modal" aria-label="Close"> x </a>

        <div class="modal-content">   
            <div class="login-wrap text-center">                        
                <h2 class="title-3">Helping Information</h2>
                                    

                <div class="login-form clrbg-before">
                    ১।আপনার নাম,কম্পানি নাম,ফোন এবং ইমেইল ১নং স্টেপে  পুরন করুন।<br>
২।আপনার পেমেন্ট সংক্রান্ত তথ্য ২নং স্টেপে  পুরন করুন।<br>
৩।ওয়েব সাইটে প্রবেশ ও পিকআপ রিকুয়েস্ট এর জন্য ৩ নং স্টেপে আপনার ইচ্ছামত একটি পিন এবং পাসওয়ার্ড দিন এবং সেটি সংরক্ষন করুন।<br>
যেকোন সহযোগিতার জন্য ফোন করুন +880-1842775001 নম্বরে।

                </div>                        
            </div>
        </div>
    </div>
</div>
<!-- /Popup: Login --> 


<!-- / Search Popup -->

<!-- Bootstrap JS -->
<script src="<?= base_url('assets/plugins/bootstrap-3.3.6/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<!-- Bootstrap Select JS -->
<script src="<?= base_url('assets/plugins/bootstrap-select-1.10.0/dist/js/bootstrap-select.min.js') ?>" type="text/javascript"></script>
<!-- OwlCarousel2 Slider JS -->
<script src="<?= base_url('assets/plugins/owl.carousel.2/owl.carousel.min.js') ?>" type="text/javascript"></script>
<!-- Sticky Header -->
<script src="<?= base_url('assets/js/jquery.sticky.js') ?>"></script>
<!-- Wow JS -->
<script src="<?= base_url('assets/plugins/WOW-master/dist/wow.min.js'); ?>" type="text/javascript"></script>
<!-- Data binder -->
<script src="<?= base_url('assets/plugins/data.binder.js/data.binder.js') ?>" type="text/javascript"></script>

<script src="<?= base_url('assets/js/theme.js') ?>" type="text/javascript"></script>

<script>
    var base_url = "<?= base_url(); ?>";
</script>

<!-- Asset Management -->
<?= load_assets('js'); ?>

<script>
    $(document).ready(function() {
        $('[id^=phone]').keypress(validateNumber);
    });

    function validateNumber(event) {
        var key = window.event ? event.keyCode : event.which;
        if (event.keyCode === 8 || event.keyCode === 46) {
            return true;
        } else if (key < 48 || key > 57) {
            return false;
        } else {
            return true;
        }
    }

</script>
<script>
window.onscroll = function() {myFunction();};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>
<!-- WhatsHelp.io widget -->
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
<!-- /WhatsHelp.io widget -->