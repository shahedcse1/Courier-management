<style>
    .form-control{
        height: 35px;
    }

    /**
    * Demo styles
    * Not needed for tooltips to work
    */

    /* `border-box`... ALL THE THINGS! */
    html {
        box-sizing: border-box;
    }

    *,
    *:before,
    *:after {
        box-sizing: inherit;
    }



    a:hover {
        text-decoration: none;
    }

    header,
    .demo,
    .demo p {
        margin: 1em 0;
        text-align: center;
    }

    /**
     * Tooltip Styles
     */

    /* Add this attribute to the element that needs a tooltip */
    [data-tooltip] {
        position: relative;
        z-index: 2;
        cursor: pointer;
    }

    /* Hide the tooltip content by default */
    [data-tooltip]:before,
    [data-tooltip]:after {
        visibility: hidden;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        filter:DXImageTransform.Microsoft.Alpha(Opacity=0);
        opacity: 0;
        pointer-events: none;
    }

    /* Position tooltip above the element */
    [data-tooltip]:before {
        position: absolute;
        bottom: 150%;
        left: 50%;
        margin-bottom: 5px;
        margin-left: -80px;
        padding: 7px;
        width: 250px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        background-color: #000;
        background-color: hsla(0, 0%, 20%, 0.9);
        color: #fff;
        content: attr(data-tooltip);
        text-align: center;
        font-size: 14px;
        line-height: 1.2;
    }

    /* Triangle hack to make tooltip look like a speech bubble */
    [data-tooltip]:after {
        position: absolute;
        bottom: 150%;
        left: 50%;
        margin-left: -5px;
        width: 0;
        border-top: 5px solid #000;
        border-top: 5px solid hsla(0, 0%, 20%, 0.9);
        border-right: 5px solid transparent;
        border-left: 5px solid transparent;
        content: " ";
        font-size: 0;
        line-height: 0;
    }

    /* Show tooltip content on hover */
    [data-tooltip]:hover:before,
    [data-tooltip]:hover:after {
        visibility: visible;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
        filter: DXImageTransform.Microsoft.Alpha(Opacity=100);
        opacity: 1;
    }
</style>
<article> 
    <!-- Breadcrumb -->
    <h3 class="section-title no-margin" style="margin-top: 8px;">Merchant Registration Form:</h3>

    <section class="pt-50 pb-120 error-wrap">                    
        <div class="theme-container container text-center"> 

            <div class="col-md-8" style="border: 1px solid black;background-image: url('<?= base_url('assets/img/background/signup.jpg') ?>');">
                <a data-toggle="modal" href="#register-popup"> 
                    <button type="button" class="pull-right btn-info" onclick="">Need help,click here ?</button>
                </a>
                <div class="calculate-form">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="reg-validation-alert"></div>
                        </div>
                    </div>
                    <form class="row"
                          id="registerForm"
                          action="<?= base_url('home/registermerchant'); ?>"
                          method="post" >
                        <h4 style="text-align-last:center;text-decoration:underline;FONT-WEIGHT:BOLD;font-size: 25px; color: green ;">Basic Information:</h4>
                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                            <div class="col-sm-4 text-left"><label for="name" class="title-2">Name:<span style="color:red">*</span></label></div>
                            <div class="col-sm-8">
                                <input type="text"
                                       style="color: black;"
                                       <?php if (!empty($name)): ?>
                                           value="<?= $name; ?>"
                                       <?php endif; ?>
                                       name="name"
                                       id="name"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                            <div class="col-sm-4 text-left"><label for="company_name" class="title-2">Company/Page Name:<span style="color:red">*</span> </label></div>
                            <div class="col-sm-8">
                                <input type="text"
                                       style="color: black;"
                                       name="company_name"
                                       id="company_name"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                            <div class="col-sm-4 text-left"><label for="user_phone" class="title-2">Phone:<span style="color:red">*</span> </label></div>
                            <div class="col-sm-8">
                                <input type="text"
                                       style="color: black;"
                                       <?php if (!empty($phone)): ?>
                                           value="<?= $phone; ?>"
                                       <?php endif; ?>
                                       name="user_phone"
                                       id="user_phone"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                            <div class="col-sm-4 text-left"><label for="user_email" class="title-2">Email:<span style="color:red">*</span></label></div>
                            <div class="col-sm-8">
                                <input type="text"
                                       style="color: black;"
                                       name="user_email"
                                       <?php if (!empty($email)): ?>
                                           value="<?= $email; ?>"
                                       <?php endif; ?>
                                       id="user_email"
                                       class="form-control">
                            </div>
                        </div>
                        <h4 style="text-align-last:center;text-decoration:underline;FONT-WEIGHT:BOLD;font-size: 25px; color:green ;">Payment Information:</h4>
                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                            <div class="col-sm-4 text-left"><label for="payment" class="title-2">Payment Type:<span style="color:red">*</span> </label></div>
                            <div class="col-sm-8">
                                <select   name="payment_type"id="payment_type" style="height:38px;" class="form-control"  >
                                    <option value="">--Select payment method--</option>
                                    <option value="1">bKash</option>
                                    <option value="2">Rocket</option>
                                    <option value="3">Bank Account</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                            <div class="col-sm-4 text-left"><label for="payment" class="title-2">Payment Account No.:<span style="color:red">*</span> </label></div>
                            <div class="col-sm-8">
                                <input type="text"
                                       style="color: black;"
                                       name="account_no"
                                       id="account_no" 
                                       placeholder="your bkash/Rocket/Bank Ac. No ."
                                       class="form-control">
                            </div>
                        </div>

                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                            <div class="col-sm-4 text-left"><label for="address" class="title-2">Address:<span style="color:red">*</span></label></div>
                            <div class="col-sm-8">
                                <textarea name="address"
                                          id="address"
                                          class="form-control"></textarea>
                            </div>
                        </div>


                        <h4 style="text-align-last:center; text-decoration:underline;FONT-WEIGHT:BOLD;font-size: 25px; color: green ;">Login Information:  </h4>
                        <div class="demo">
                            <p><button type="button" data-tooltip="Please give here an user Name and password as you want which will be use for future website login.keep remember in mind this user pin and password. ">Help Desk?</button></p>
                        </div>
                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                            <div class="col-sm-4 text-left"><label for="user_pin" class="title-2">User Name:<span style="color:red">*</span></label>(website Login Name)</div>
                            <div class="col-sm-8">
                                <input type="text"
                                       style="color: black;"
                                       name="user_pin"
                                       id="user_pin" 
                                       placeholder="Give a user Name as you want"
                                       class="form-control">
                            </div>
                        </div>

                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                            <div class="col-sm-4 text-left"><label for="password" class="title-2">Password:<span style="color:red">*</span></label></div>
                            <div class="col-sm-8">
                                <input type="password"
                                       name="password"
                                       id="password" 
                                       placeholder="****"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="form-group wow fadeInUp text-right" data-wow-offset="50" data-wow-delay=".30s">
                            <div class="col-sm-12">
                                <button name="submit"
                                        id="submit_btn"
                                        type="submit"
                                        style="background-color: green"
                                        class="btn-1">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 ">
                <img src="<?= base_url('assets/img/block/parcel.gif'); ?>">
            </div>
        </div>
    </section>


</article>
