<html>
    <body id="home">
    <main class="wrapper">

        <article> 
            <!-- Banner -->
            <section class="banner  pad-120 white-clr">

                <div class="container theme-container rel-div">
                    <div class="col-md-12">
                        <div class="col-md-7" style="padding: 20px;">
                            <img class="pt-10 effect animated fadeInLeft" alt="" src="<?= base_url('assets/img/icons/icon-1.png') ?>" />
                            <h2 class="section-title fs-48 effect animated wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s"> <span class="theme-clr" style="color:#e0262c;"> parcel xpress </span>  <span class="theme-clr" style="color: #e0262c;"> BD </span><br><h4 style="color:red">Delivery On time With Care .</h4></h2>
                            <h4 class="section-title fs-40 effect animated wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s"><img height="50" width="50" src="<?= base_url('assets/img/icons/5a452570546ddca7e1fcbc7d.png') ?>" /> <span class="theme-clr" style="color: black;">+880-1842775001 </span> </h4>
                        </div>
                        <div class="col-md-5" style=" background-color: #82e38f;color:black ">
                            <div class="calculate-form" >
                                <h4>Register Now - It's Free!</h4>
                                <form class="row" action="<?= base_url('home/register'); ?>" method="post" >
                                    <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                                        <div class="col-sm-3"><label for="name"><b> Name: </b></label></div>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                   style="color: black; height: 35px;"
                                                   name="name"
                                                   id="name"
                                                   required
                                                   class="form-control" />
                                        </div>
                                    </div>

                                    <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                                        <div class="col-sm-3"><label for="user_phone"><b> Phone:</b> </label></div>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                   style="color: black;  height: 35px;"
                                                   maxlength="11"
                                                   onkeypress="return isNumberKey(event)"
                                                   name="user_phone"
                                                   id="user_phone"
                                                   required
                                                   class="form-control" />
                                        </div>
                                    </div>

                                    <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                                        <div class="col-sm-3"><label for="user_email"><b>Email: </b></label></div>
                                        <div class="col-sm-9">
                                            <input type="text" style="color: black; height: 35px;" name="user_email" id="user_email" required class="form-control" />
                                        </div>
                                    </div>

                                    <div class="form-group wow fadeInUp text-right" data-wow-offset="50" data-wow-delay=".30s">
                                        <div class="col-sm-12">
                                            <button name="submit"
                                                    style="color: #fff;background-color: #03a84e;"
                                                    class="btn"
                                                    id="submit_btn"><b>Next</b></button>
                                        </div>
                                    </div>
                                </form>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="pad-50 visible-lg"></div>
            </section>

            <!-- /.Banner -->

            <!-- Track Product -->
            <section>
                <div class="theme-container container">               
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 track-prod clrbg-before wow slideInUp" data-wow-offset="50" data-wow-delay=".10s">     
                            <h2 class="title-1"> track your product </h2> <span class="font2-light fs-12">Now you can track your product easily</span>
                            <div class="row">
                                <form action="<?= base_url('tracking/search'); ?>" method="get">
                                    <div class="col-md-7 col-sm-7">
                                        <div class="form-group">
                                            <input type="text" style="color: black;" name="tracking_id" id="tracking_id" placeholder="Enter your Tracking ID" required="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-5">
                                        <div class="form-group">
                                            <button class="btn-1" style="color: #fff;background-color: #03a84e;">track your product</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>                        
                    </div>
                </div>
            </section>
            <!-- /.Track Product -->

            <!-- About Us -->
            <section class="pad-80 about-wrap clrbg-before">
                <span class="bg-text wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s"> About </span>
                <div class="theme-container container">               
                    <div class="row">
                        <div class="col-md-6">
                            <div class="about-us">
                                <h2 class="section-title pb-10 wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s"> About Us </h2>
                                <p class="fs-16 wow fadeInUp" data-wow-offset="50" data-wow-delay=".25s">Established in 2018
                                    Parcel Xpress BD is now one of the most reliable courier service in Bangladesh.
                                    We are now a delivery one-stop-shop providing same day delivery and next day delivery for any professional company throughout Bangladesh.</p>
                                <ul class="feature">
                                    <li> 
                                        <img alt="" src="<?= base_url('assets/img/icons/icon-2.png') ?>" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" />
                                        <div class="feature-content wow rotateInDownRight" data-wow-offset="50" data-wow-delay=".30s"> 
                                            <h2 class="title-1">Fast delivery</h2> 
                                            <p>We delivered  product as soon as possible</p>                                            
                                        </div>  
                                    </li>
                                    <li> 
                                        <img alt="" src="<?= base_url('assets/img/icons/icon-3.png') ?>" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" />
                                        <div class="feature-content wow rotateInDownRight" data-wow-offset="50" data-wow-delay=".30s"> 
                                            <h2 class="title-1">secured service</h2> 
                                            <p>Your Product is valuable for us</p>                                            
                                        </div>  
                                    </li>
                                    <li> 
                                        <img alt="" src="<?= base_url('assets/img/icons/icon-4.png') ?>" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" />
                                        <div class="feature-content wow rotateInDownRight" data-wow-offset="50" data-wow-delay=".30s"> 
                                            <h2 class="title-1">All Over Bangladesh</h2> 
                                            <p>We deliver all over Bangladesh in a professional approach.</p>                                            
                                        </div>  
                                    </li>
                                </ul>
                            </div>
                            <a href="<?= base_url('contact'); ?>">
                                <button class="btn-1" style="color: #fff;background-color: #03a84e;">Contact Us</button>
                            </a>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="pb-50 visible-lg"></div>
                            <img alt="" height="450" src="<?= base_url('assets/img/block/courier-min.png') ?>" class="wow slideInRight" data-wow-offset="50" data-wow-delay=".20s" />
                        </div>
                    </div>
                </div>
            </section>
            <section class="pricing-wrap pt-120">                
                <div class="theme-container container">    
                    <span class="bg-text center wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s">Our Offer </span>
                    <div class="title-wrap text-center  pb-50">
                        <h2 class="section-title wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s">What We Offer</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4 wow slideInUp" data-wow-offset="50" style="background-color:#82E38F; " data-wow-delay=".20s">
                                <div class="pricing-box clrbg-before clrbg-after transition">
                                    <div class="title-wrap text-center">
                                        <img alt="" src="<?= base_url('assets/img/icons/icon-4.png') ?>" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" />
                                        <h2 class="section-title fs-16">Daily Pick Up</h2>
                                        <p>We pick up daily from your pick point free of cost and there are no limitations!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 wow slideInUp" data-wow-offset="50"style="background-color:#FAD91B; " data-wow-delay=".20s">
                                <div class="pricing-box clrbg-before clrbg-after transition">
                                    <div class="title-wrap text-center">
                                        <img alt="" src="<?= base_url('assets/img/icons/icon-4.png') ?>" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" />
                                        <h2 class="section-title fs-16">Cash On Delivery</h2> 
                                        <p>We collect cash on behalf of you! </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 wow slideInUp" data-wow-offset="50"style="background-color:#82E38F; " data-wow-delay=".20s">
                                <div class="pricing-box clrbg-before clrbg-after transition">
                                    <div class="title-wrap text-center">
                                        <img alt="" src="<?= base_url('assets/img/icons/icon-4.png') ?>" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" />
                                        <h2 class="section-title fs-16">Online Management</h2> 
                                        <p>Get all informations and updates from your user dashboard.  </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-top: 30px;">
                            <div class="col-md-4 wow slideInUp" data-wow-offset="50"style="background-color:#82E38F; " data-wow-delay=".20s">
                                <div class="pricing-box clrbg-before clrbg-after transition">
                                    <div class="title-wrap text-center">
                                        <img alt="" src="<?= base_url('assets/img/icons/icon-4.png') ?>" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" />
                                        <h2 class="section-title fs-16">Advanced  Service</h2> 
                                        <p>We offer both online and offline services to you.  </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 wow slideInUp" data-wow-offset="50"style="background-color:#FAD91B; " data-wow-delay=".20s">
                                <div class="pricing-box clrbg-before clrbg-after transition">
                                    <div class="title-wrap text-center">
                                        <img alt="" src="<?= base_url('assets/img/icons/icon-4.png') ?>" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" />
                                        <h2 class="section-title fs-16">Faster Payment </h2>
                                        <p>Get your payment daily by cash, Mobile Wallet or Bank deposit/Transfer!  </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 wow slideInUp" data-wow-offset="50"style="background-color:#82E38F; " data-wow-delay=".20s">
                                <div class="pricing-box clrbg-before clrbg-after transition">
                                    <div class="title-wrap text-center">
                                        <img alt="" src="<?= base_url('assets/img/icons/icon-4.png') ?>" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" />
                                        <h2 class="section-title fs-16">Real-Time Tracking</h2>
                                        <p>Get the exact location and status of your consignments through live tracking or phone.   </p>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>               
            </section><br><br><br>


        </article>
    </main>
    <!--    <div class="modal fade login-popup" id="infomodal" tabindex="-1" role="dialog" aria-hidden="true">
           <div class="modal-dialog modal-md" >                
               <a class="close close-btn" data-dismiss="modal" aria-label="Close"> x </a>
   
               <div class="modal-content" style="width: 100%; height:350px; background-image: url('<?= base_url('assets/img/logo/logolayer.jpg'); ?>');">
                   <div class="login-wrap text-center">                        
                       <h2 style="color:#fff;"><b>parcel xpress BD তে আপনাকে সাগতম।<br> 
                               আমাদের সাথে যোগাযোগ করুন 01842-775001 নাম্বারে।
                           </b></h2>                        
                   </div>
   
               </div>
           </div>
       </div>-->
</body>

</html>

<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }



</script>

