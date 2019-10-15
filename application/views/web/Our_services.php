<style>
    .main-timeline{
        padding: 150px 0 0;
        position: relative;
        display: inline-block;
    }
    .main-timeline:before,
    .main-timeline:after{
        content: '';
        height: 30px;
        width: 50px;
        background: #909090;
        border-radius: 50%;
        transform: translateX(-50%);
        position: absolute;
        left: 50%;
        top: 0;
        z-index: 2;
    }
    .main-timeline:after{
        top: auto;
        bottom: -10px;
    }
    .main-timeline .timeline{
        width: 52.2%;
        float: left;
        display: block;
        position: relative;
        z-index: 1;
    }
    .main-timeline .timeline-content{
        color: #000;
        border-right: 50px solid #E5E5E5;
        padding: 40px 30px 20px 0;
        display: block;
        position: relative;
    }
    .main-timeline .timeline-content:hover{ text-decoration: none; }
    .main-timeline .timeline-content:before,
    .main-timeline .timeline-content:after{
        content: '';
        background-color: #00B3AD;
        height: 80px;
        width: 50px;
        border-radius: 23px;
        position: absolute;
        right: -50px;
        top: 30px;
    }
    .main-timeline .timeline-content:before{
        background-color: #047a74;
        height: 30px;
        border-radius: 50%;
        z-index: 1;
    }
    .main-timeline .title{
        color: #fff;
        background-color: #00B3AD;
        font-weight: 800;
        font-size: 20px;
        padding: 10px 25px;
        margin: 0 0 35px 0;
        -webkit-clip-path: polygon(95% 0, 100% 50%, 95% 100%, 0 100%, 0 0);
        clip-path: polygon(95% 0, 100% 50%, 95% 100%, 0 100%, 0 0);
    }
    .main-timeline .inner-content{
        padding-right: 150px;
        position: relative;
    }
    .main-timeline .timeline-icon{
        color: #fff;
        background-color: #00B3AD;
        font-size: 60px;
        text-align: center;
        line-height: 100px;
        height: 100px;
        width: 100px;
        border-radius: 50%;
        position: absolute;
        right: 0;
        top: 5px;
    }
    .main-timeline .description{
        font-size: 14px;
        text-align: justify;
        letter-spacing: 1px;
    }
    .main-timeline .timeline:nth-child(odd){ margin-top: -12%; }
    .main-timeline .timeline:nth-child(even){
        float: right;
        width: 52.15%;
        margin-top: -12%;
    }
    .main-timeline .timeline:nth-child(even) .timeline-content{
        border-right: 0 solid transparent;
        border-left: 50px solid #E5E5E5;
        padding: 40px 0 20px 30px;
    }
    .main-timeline .timeline:nth-child(even) .timeline-content:before,
    .main-timeline .timeline:nth-child(even) .timeline-content:after{
        right: auto;
        left: -50px;
    }
    .main-timeline .timeline:nth-child(even) .inner-content{
        padding-right: 0;
        padding-left: 150px;
    }
    .main-timeline .timeline:nth-child(even) .title{
        padding: 10px 25px 10px 40px;
        -webkit-clip-path: polygon(5% 0, 100% 0, 100% 100%, 5% 100%, 0 50%);
        clip-path: polygon(5% 0, 100% 0, 100% 100%, 5% 100%, 0 50%);
    }
    .main-timeline .timeline:nth-child(even) .timeline-icon{
        right: auto;
        left: 0;
    }
    .main-timeline .timeline:nth-child(4n+2) .timeline-icon,
    .main-timeline .timeline:nth-child(4n+2) .title,
    .main-timeline .timeline:nth-child(4n+2) .timeline-content:after{
        background-color: #FF534F;
    }
    .main-timeline .timeline:nth-child(4n+2) .timeline-content:before{
        background-color: #a02724;
    }
    .main-timeline .timeline:nth-child(4n+3) .timeline-icon,
    .main-timeline .timeline:nth-child(4n+3) .title,
    .main-timeline .timeline:nth-child(4n+3) .timeline-content:after{
        background-color: #9642A4;
    }
    .main-timeline .timeline:nth-child(4n+3) .timeline-content:before{
        background-color: #6d167c;
    }
    .main-timeline .timeline:nth-child(4n+4) .timeline-icon,
    .main-timeline .timeline:nth-child(4n+4) .title,
    .main-timeline .timeline:nth-child(4n+4) .timeline-content:after{
        background-color: #FAB030;
    }
    .main-timeline .timeline:nth-child(4n+4) .timeline-content:before{
        background-color: #ba7807;
    }
    @media screen and (max-width:1200px){
        .main-timeline{ padding: 130px 0 0; }
        .main-timeline .timeline{ width: 52.66%; }
        .main-timeline .timeline:nth-child(even){ width: 52.66%; }
    }
    @media screen and (max-width:990px){
        .main-timeline{ padding: 100px 0 0; }
        .main-timeline .timeline{ width: 53.5%; }
        .main-timeline .timeline:nth-child(even){ width: 53.5%; }
        .main-timeline .inner-content{
            padding-right: 120px;
        }
        .main-timeline .timeline:nth-child(even) .inner-content{
            padding-left: 120px;
        }
    }
    @media screen and (max-width:767px){
        .main-timeline{ padding: 17px 0 0; }
        .main-timeline:before,
        .main-timeline:after{
            transform:translateX(0);
            left: 0;
        }
        .main-timeline:after{
            top: auto;
            bottom: -10px;
        }
        .main-timeline .timeline:nth-child(odd){
            margin-top: 0;
        }
        .main-timeline .timeline,
        .main-timeline .timeline:nth-child(even){
            width: 100%;
            margin-top: 0;
            float: right;
        }
        .main-timeline .timeline .title{
            padding: 10px 25px 10px 30px;
            -webkit-clip-path: polygon(5% 0, 100% 0, 100% 100%, 5% 100%, 0 50%);
            clip-path: polygon(5% 0, 100% 0, 100% 100%, 5% 100%, 0 50%);
        }
        .main-timeline .timeline-icon{
            right: auto;
            left: 0;
        }
        .main-timeline .inner-content{
            padding-right: 0;
            padding-left: 150px;
        }
        .main-timeline .timeline-content:before,
        .main-timeline .timeline-content:after{
            right: auto;
            left: -50px;
        }
        .main-timeline .timeline-content{
            border-right: 0 solid transparent;
            border-left: 50px solid #E5E5E5;
            padding: 40px 0 20px 30px;
        }
    }
    @media screen and (max-width:479px){
        .main-timeline .timeline .title,
        .main-timeline .timeline:nth-child(even) .title{
            font-size: 16px;
            padding: 10px 5px 10px 25px;
        }
        .main-timeline .timeline:nth-child(even) .inner-content,
        .main-timeline .inner-content{
            padding-right: 0;
            padding-left: 15px;
        }
        .main-timeline .timeline:nth-child(even) .timeline-icon,
        .main-timeline .timeline-icon{
            transform:scale(0.7);
            right: auto;
            left: -107px;
        }
    }

</style>

<article> 
    <!-- Breadcrumb -->
    <section class="theme-breadcrumb pad-50">                
        <div class="theme-container container ">  
            <div class="row">
                <div class="col-sm-8 pull-left">
                    <div class="title-wrap">
                        <h2 class="section-title no-margin">Our Services</h2>
                        <p class="fs-16 no-margin">Know about our Services</p>
                    </div>
                </div>
                <div class="col-sm-4">                        
                    <ol class="breadcrumb-menubar list-inline">
                        <li><a href="<?= base_url(); ?>" class="gray-clr">Home</a></li>
                        <li class="active">Services</li>
                    </ol>
                </div>  
            </div>
        </div>
    </section>
    <!-- /.Breadcrumb -->

    <!-- Pricing & Plans -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-timeline">
                    <?php foreach ($allservices as $value): ?>
                        <div class="timeline">
                            <a target="_blank" href="<?= base_url($value->link); ?>" class="timeline-content">
                                <h3 class="title"><?= $value->service_name ?></h3>
                                <div class="inner-content">
                                    <p class="description">
                                        <?= $value->description; ?>
                                    </p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!-- /.Pricing & Plans -->
</article>
<br />