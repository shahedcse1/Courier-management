<style>
    .our-team{
        text-align: center;
        overflow: hidden;
        position: relative;
    }
    .our-team img{
        width: 262px;
        height: 276px;
        transition: all 0.5s ease-in-out 0s;
    }
    .our-team:hover img{ transform: scale(1.2); }
    .our-team .social{
        list-style: none;
        padding: 30px 15px;
        margin: 0;
        background: #0facf3;
        border-bottom-right-radius: 50px;
        position: absolute;
        top: 0;
        left: -50%;
        transition: all 0.4s ease-in-out 0s;
    }
    .our-team:hover .social{ left: 0; }
    .our-team .social li{ display: block; }
    .our-team .social li a{
        display: block;
        padding: 5px 0;
        font-size: 18px;
        color: #fff;
        transition: all 0.3s ease-in-out 0s;
    }
    .our-team .social li:first-child a{ padding-top: 0; }
    .our-team .social li:last-child a{ padding-bottom: 0; }
    .our-team .social li a:hover{ color: #000; }
    .our-team .team-content{
        width: 100%;
        padding: 15px 10px;
        background: rgba(0, 0, 0, 0.6);
        position: absolute;
        bottom: 0;
        left: 0;
    }
    .our-team .title{
        font-size: 22px;
        font-weight: bold;
        letter-spacing: 1px;
        color: #fff;
        margin: 0 0 5px 0;
    }
    .our-team .post{
        display: block;
        font-size: 14px;
        color: #0facf3;
    }
    @media only screen and (max-width: 990px){
        .our-team{ margin-bottom: 30px; }
    }  
</style>

<article class="about-page"> 
    <!-- Breadcrumb -->
    <section class="theme-breadcrumb pad-50">                
        <div class="theme-container container ">  
            <div class="row">
                <div class="col-sm-8 pull-left">
                    <div class="title-wrap">
                        <h2 class="section-title no-margin">About Our Team</h2>
                        <p class="fs-16 no-margin">Know about us more</p>
                    </div>
                </div>
                <div class="col-sm-4">                        
                    <ol class="breadcrumb-menubar list-inline">
                        <li><a href="<?= base_url() ?>" class="gray-clr">Home</a></li>
                        <li class="active">Our Team</li>
                    </ol>
                </div>  
            </div>
        </div>
    </section>
    <!-- /.Breadcrumb -->

    <!-- About Us -->
    <section class="pad-50 about-wrap">
        <span class="bg-text"> Our Team </span>
        <div class="theme-container container">               
            <div class="row">
                <div class="container">
                    <div class="row">
                        <?php foreach ($teaminfo AS $value): ?>
                            <div class="col-sm-3">
                                <div class="our-team">
                                    <img src="<?= base_url('admin/uploads/'. $value->image_path) ?>" alt="">
                                    <ul class="social">
                                        <li><a  target="_blank" href="<?= $value->fb; ?>" class="fab fa-facebook-f"></a></li>
                                        <li><a target="_blank" href="<?= $value->twitter; ?>" class="fab fa-twitter"></a></li>
                                        <li><a target="_blank" href="<?= $value->google; ?>" class="fab fa-google-plus-g"></a></li>
                                        <li><a target="_blank" href="<?= $value->linkedin; ?>" class="fab fa-linkedin-in"></a></li>
                                    </ul>
                                    <div class="team-content">
                                        <h4 class="title"><?= $value->name; ?></h4>
                                        <span class="post">Position:<?= $value->position; ?></span>
                                        <h5 class="post">Contact:<?= $value->phone; ?></h5>
                                    </div>
                                </div><br>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
    </section>

</article>

