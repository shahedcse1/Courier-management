<article> 
    <!-- Breadcrumb -->
    <section class="theme-breadcrumb pad-50">                
        <div class="theme-container container ">  
            <div class="row">
                <div class="col-sm-8 pull-left">
                    <div class="title-wrap">
                        <h2 class="section-title no-margin"> contact us </h2>
                        <p class="fs-16 no-margin"> Get in touch with us easily </p>
                    </div>
                </div>
                <div class="col-sm-4">                        
                    <ol class="breadcrumb-menubar list-inline">
                        <li><a href="#" class="gray-clr">Home</a></li>                                   
                        <li class="active">contact</li>
                    </ol>
                </div>  
            </div>
        </div>
    </section>
    <?php if ($this->session->userdata('login_error')): ?>
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span> <?=
                $this->session->userdata('login_error');
                $this->session->unset_userdata('login_error');
                ?> </span>
        </div>
    <?php endif; ?>
    <section class="contact-page pad-30">                    
        <div class="theme-container container">               
            <div class="row">
                <div class="col-sm-5">
                    <ul class="contact-detail title-2 pt-60">
                        <li class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s"> <span>Contact numbers:</span> <p class=""> +8801842775001 <br> +8801842775002 </p> </li>
                        <li class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".40s"> <span>Office Address:</span> <p class=""> House-3/1, Road-8, Dhanmondi, Dhaka-1205</p> </li>
                        <li class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".50s"> <span>Email address:</span> <p class="">parcelxpressbd@gmail.com <br> info@parcelxpressbd.com </p> </li>
                    </ul>

                </div>

                <div class="col-sm-6 col-sm-offset-1 contact-form">
                    <div class="calculate-form">
                        <form class="row" action="<?= base_url('home/add_message'); ?>" method="post" >
                            <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                                <div class="col-sm-3 text-right"><label for="Name" class="title-2">Name:</label></div>
                                <div class="col-sm-9">
                                    <input type="text" style="color: black;" name="name" id="Name" required class="form-control">
                                </div>
                            </div>
                            <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                                <div class="col-sm-3 text-right"><label for="Email" class="title-2">Email:</label></div>
                                <div class="col-sm-9">
                                    <input type="text" style="color: black;" name="email" id="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control">
                                </div>
                            </div>
                            <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                                <div class="col-sm-3 text-right"><label for="phone" class="title-2">Phone:</label></div>
                                <div class="col-sm-9">
                                    <input type="text" style="color: black;" name="phone" maxlength="11" id="phone" class="form-control">
                                </div>
                            </div>
                            <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                                <div class="col-sm-3 text-right"><label class="title-2" for="Message">Your Message:</label></div>
                                <div class="col-sm-9">
                                    <textarea style="color: black;" class="form-control" name="message" id="Message" required cols="25" rows="3"></textarea>
                                </div>
                            </div>                                  
                            <div class="form-group wow fadeInUp text-right" data-wow-offset="50" data-wow-delay=".30s">
                                <div class="col-sm-12">
                                    <button name="submit" id="submit_btn" class="btn-1" style="background-color: #03a84e;">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <sction class="row">
        <iframe width="100%"
                height="400"
                id="gmap_canvas"
                src="https://maps.google.com/maps?q=Dhanmondi%2CRd%20No%208%20Dhaka-1205&t=&z=13&ie=UTF8&iwloc=&output=embed"
                frameborder="0"
                scrolling="no"
                marginheight="0"
                marginwidth="0">
        </iframe>
    </sction>
    <br />

</article>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>