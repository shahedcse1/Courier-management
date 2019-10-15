<article> 
    <!-- Breadcrumb -->
    <section class="theme-breadcrumb pad-50">                
        <div class="theme-container container ">  
            <div class="row">
                <div class="col-sm-8 pull-left">
                    <div class="title-wrap">
                        <h2 class="section-title no-margin"> product tracking </h2>
                        <p class="fs-16 no-margin"> Track your product & see the current condition </p>
                    </div>
                </div>
                <div class="col-sm-4">                        
                    <ol class="breadcrumb-menubar list-inline">
                        <li><a href="<?= base_url(); ?>" class="gray-clr">Home</a></li>
                        <li class="active">Track</li>
                    </ol>
                </div>  
            </div>
        </div>
    </section>
    <!-- /.Breadcrumb -->

    <!-- Tracking -->
    <section class="pt-50 pb-120 tracking-wrap">    
        <div class="theme-container container ">  
            <div class="row pad-10">
                <div class="col-md-8 col-md-offset-2 track-prod clrbg-before wow slideInUp" data-wow-offset="50" data-wow-delay=".20s">     
                    <h2 class="title-1"> track your product </h2> <span class="font2-light fs-12">Now you can track your product easily</span>
                    <div class="row">
                        <form action="<?= base_url('tracking/search'); ?>" method="get">
                            <div class="col-md-7 col-sm-7">
                                <div class="form-group">
                                    <input type="text" style="color: black;" value="<?php
                                    if (!empty($product_id)): echo $product_id;
                                    else: echo '';
                                    endif;
                                    ?>" name="tracking_id" id="tracking_id" placeholder="Enter your Tracking ID" required="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-5">
                                <div class="form-group">
                                    <button class="btn-1" style="background-color: #FAD91B; color:black">track your product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>    
            </div>
            <div class="row">
                <div class="col-md-7 pad-30 wow fadeInLeft" data-wow-offset="50" data-wow-delay=".30s"> 
                    <?php if (!empty($all_info)): ?>
                        <img alt="nofile" height="450px;" src="<?= base_url('admin/uploads/product/'. $all_info->p_img_path); ?>" />
                    <?php else: ?>
                        <img alt="nofile" height="450px;" src="<?= base_url('assets/img/block/product-1.png'); ?>" />
                    <?php endif ?>
                </div>
                <div class="col-md-5 pad-30 wow fadeInRight" data-wow-offset="50" data-wow-delay=".30s"> 
                    <div class="prod-info white-clr">
                        <?php if (!empty($product_id)): if (!empty($all_info)): ?>
                            <ul>
                                <li><span class="title-2">Delivery Status:</span> <span class="fs-16"><?= $all_info->status_name; ?></span></li>
                                <li><span class="title-2">Delivery Zone:</span> <span class="fs-16"><?= $all_info->zone_name; ?></span></li>
                                <li><span class="title-2">Customer name:</span> <span class="fs-16 theme-clr"><?= $all_info->customer_name; ?></span></li>
                                <li><span class="title-2">Product price:</span> <span class="fs-16"><?= $all_info->netprice; ?></span></li>
                                <li><span class="title-2">Order date:</span> <span class="fs-16"><?=  date("d F, Y", strtotime($all_info->createddate));   ?></span></li>
                                <li><span class="title-2">weight:</span> <span class="fs-16"><?= $all_info->weight; ?></span></li>
                            </ul>
                        <?php else: ?>
                            <h3 style="color: red;">   Incorrect Tracking No. please Enter Correct Tracking No. or Contact with us for details. </h3>
                        <?php endif; else: ?>
                            <ul>
                                <li><span class="title-2">Delivery Status:</span></li>
                                <li><span class="title-2">Delivery Zone:</span></li>
                                <li><span class="title-2">Customer name:</span></li>
                                <li><span class="title-2">Product price:</span></li>
                                <li><span class="title-2">Order date:</span></li>
                                <li><span class="title-2">weight:</span></li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /.Tracking -->

</article>
