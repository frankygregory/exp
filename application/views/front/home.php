<!doctype html>
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]>
<html lang="en" class="no-js"> <![endif]-->
<html lang="en">

<head>

    <?php $this->load->view('front/common/header'); ?>

</head>

<body>

<!-- Full Body Container -->
<div id="container">


<!-- Start Header Section -->
<div class="hidden-header"></div>
<header class="clearfix">

<!-- Start Top Bar -->
<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <!-- Start Contact Info -->
                <!--ul class="contact-details">
                    <li><a href="#"><i class="fa fa-map-marker"></i> House-54/A, London, UK</a>
                    </li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> info@yourcompany.com</a>
                    </li>
                    <li><a href="#"><i class="fa fa-phone"></i> +12 345 678 000</a>
                    </li>
                </ul-->
                <!-- End Contact Info -->
            </div>
            <!-- .col-md-6 -->
            <div class="col-md-5">
                <!-- Start Social Links -->
                <ul class="social-list">
                    <li>
                        <a class="facebook itl-tooltip" data-placement="bottom" title="Facebook" href="#"><i
                                class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a class="twitter itl-tooltip" data-placement="bottom" title="Twitter" href="#"><i
                                class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a class="google itl-tooltip" data-placement="bottom" title="Google Plus" href="#"><i
                                class="fa fa-google-plus"></i></a>
                    </li>
                    <li>
                        <a class="dribbble itl-tooltip" data-placement="bottom" title="Dribble" href="#"><i
                                class="fa fa-dribbble"></i></a>
                    </li>
                    <li>
                        <a class="linkdin itl-tooltip" data-placement="bottom" title="Linkedin" href="#"><i
                                class="fa fa-linkedin"></i></a>
                    </li>
                    <li>
                        <a class="flickr itl-tooltip" data-placement="bottom" title="Flickr" href="#"><i
                                class="fa fa-flickr"></i></a>
                    </li>
                    <li>
                        <a class="tumblr itl-tooltip" data-placement="bottom" title="Tumblr" href="#"><i
                                class="fa fa-tumblr"></i></a>
                    </li>
                    <li>
                        <a class="instgram itl-tooltip" data-placement="bottom" title="Instagram" href="#"><i
                                class="fa fa-instagram"></i></a>
                    </li>
                    <li>
                        <a class="vimeo itl-tooltip" data-placement="bottom" title="vimeo" href="#"><i
                                class="fa fa-vimeo-square"></i></a>
                    </li>
                    <li>
                        <a class="skype itl-tooltip" data-placement="bottom" title="Skype" href="#"><i
                                class="fa fa-skype"></i></a>
                    </li>
                </ul>
                <!-- End Social Links -->
            </div>
            <!-- .col-md-6 -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</div>
<!-- .top-bar -->
<!-- End Top Bar -->


<!-- Start  Logo & Naviagtion  -->
<div class="navbar navbar-default navbar-top">
<div class="container">
    <div class="navbar-header">
        <!-- Stat Toggle Nav Link For Mobiles -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <i class="fa fa-bars"></i>
        </button>
        <!-- End Toggle Nav Link For Mobiles -->
        <a class="navbar-brand" href="<?=site_url()?>">
            <img alt="" src="<?=base_url()?>assets/front/images/yukirim.png">
        </a>
    </div>
    <div class="navbar-collapse collapse">
        <!-- Stat Search -->
        <div class="search-side">
            <a class="show-search"><i class="fa fa-search"></i></a>

            <div class="search-form">
                <form autocomplete="off" role="search" method="get" class="searchform" action="#">
                    <input type="text" value="" name="s" id="s" placeholder="Search the site...">
                </form>
            </div>
        </div>
        <!-- End Search -->
        <!-- Start Navigation List -->

        <?php $this->load->view('front/common/menu'); ?>

        <!-- End Navigation List -->
    </div>
</div>

<!-- Mobile Menu Start -->
<ul class="wpb-mobile-menu">
    <?php $this->load->view('front/common/menu-mobile');?>
</ul>
<!-- Mobile Menu End -->

</div>
<!-- End Header Logo & Naviagtion -->

</header>
<!-- End Header Section -->


<!-- Start Home Page Slider -->
<section id="home">
    <!-- Carousel -->
    <div id="main-slide" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#main-slide" data-slide-to="0" class="active"></li>
            <li data-target="#main-slide" data-slide-to="1"></li>
            <li data-target="#main-slide" data-slide-to="2"></li>
        </ol>
        <!--/ Indicators end-->

        <!-- Carousel inner -->
        <div class="carousel-inner">
            <div class="item active">
                <img class="img-responsive" src="<?=base_url()?>assets/front/images/slider/bg1.jpg" alt="slider">

                <div class="slider-content">
                    <div class="col-md-12 text-center">
                        <h2 class="animated2">
                            <span>Welcome to <strong>yukirim</strong></span>
                        </h2>

                        <h3 class="animated3">
                            <span>The ultimate aim of your business</span>
                        </h3>

                        <p class="animated4"><a href="#" class="slider btn btn-system btn-large">Check Now</a>
                        </p>
                    </div>
                </div>
            </div>
            <!--/ Carousel item end -->
            <div class="item">
                <img class="img-responsive" src="<?=base_url()?>assets/front/images/slider/bg2.jpg" alt="slider">

                <div class="slider-content">
                    <div class="col-md-12 text-center">
                        <h2 class="animated4">
                            <span><strong>yukirim</strong> for the highest</span>
                        </h2>

                        <h3 class="animated5">
                            <span>The Key of your Success</span>
                        </h3>

                        <p class="animated6"><a href="#" class="slider btn btn-system btn-large">Buy Now</a>
                        </p>
                    </div>
                </div>
            </div>
            <!--/ Carousel item end -->
            <div class="item">
                <img class="img-responsive" src="<?=base_url()?>assets/front/images/slider/bg3.jpg" alt="slider">

                <div class="slider-content">
                    <div class="col-md-12 text-center">
                        <h2 class="animated7 white">
                            <span>The way of <strong>Success</strong></span>
                        </h2>

                        <h3 class="animated8 white">
                            <span>Why you are waiting</span>
                        </h3>

                        <div class="">
                            <a class="animated4 slider btn btn-system btn-large btn-min-block" href="#">Get Now</a><a
                                class="animated4 slider btn btn-default btn-min-block" href="#">Live Demo</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Carousel item end -->
        </div>
        <!-- Carousel inner end-->

        <!-- Controls -->
        <a class="left carousel-control" href="#main-slide" data-slide="prev">
            <span><i class="fa fa-angle-left"></i></span>
        </a>
        <a class="right carousel-control" href="#main-slide" data-slide="next">
            <span><i class="fa fa-angle-right"></i></span>
        </a>
    </div>
    <!-- /carousel -->
</section>
<!-- End Home Page Slider -->

<!--divider-->
<div class="empty-section">&nbsp;</div>

<!-- Start Team Member Section -->
<div class="section-child">
    <div class="container">
        <!-- Start Big Heading -->
        <div class="big-title-child text-center" data-animation="fadeInDown" data-animation-delay="01">
            <h1>Apa itu Yukirim?</h1>
        </div>
        <!--<div class="line"></div>-->
        <!-- End Big Heading -->
        <p class="text-center-child">Yukirim.com merupakan sebuah situs layanan yang menghubungkan antara penyedia jasa kiriman dengan orang yang mempunyai kiriman. Kami membuat pengiriman dalam jumlah atau bentuk besar menjadi mudah dengan menghubungkan langsung dengan penyedia jasa kiriman.
Baik untuk mengisi kekosongan dalam truk maupun menambah potensi muatan yang dimiliki bagi penyedia jasa kiriman. Semua pengiriman dibuat transparan dan jelas dimana semuanya memberikan keuntungan bagi penyedia jasa kiriman dan yang mempunyai kiriman.</p>
    </div>
</div>

<!-- divider -->
<div class="hr5" style="margin-top:25px; margin-bottom:45px;"></div>

<div class="section-child">
    <div class="container">

        <div class="big-title-child text-center" data-animation="fadeInDown" data-animation-delay="01">
            <h1><strong>Kenapa Yukirim?</strong></h1>
        </div>

        <!-- Start Services Icons -->
        <div class="row">

            <!-- Start Service Icon 1 -->
            <div class="col-md-3 col-sm-6 service-box service-center">
                <div class="service-icon">
                    <i class="fa fa-fast-forward icon-large-effect icon-effect-1"></i>
                </div>
                <div class="service-content">
                    <h4>Cepat & Mudah</h4>

                    <p>Cukup isi lokasi dan barang yang mau dikirim dan Anda akan terhubung dengan begitu banyak penyedia jasa kiriman</p>
                </div>
            </div>
            <!-- End Service Icon 1 -->

            <!-- Start Service Icon 2 -->
            <div class="col-md-3 col-sm-6 service-box service-center">
                <div class="service-icon">
                    <i class="fa fa-star-half-empty icon-large-effect icon-effect-1"></i>
                </div>
                <div class="service-content">
                    <h4>Harga dan Layanan Terbaik</h4>

                    <p>Sistem penawaran sehingga Anda dapat memilih layanan dan harga terbaik</p>
                </div>
            </div>
            <!-- End Service Icon 2 -->

            <!-- Start Service Icon 3 -->
            <div class="col-md-3 col-sm-6 service-box service-center">
                <div class="service-icon">
                    <i class="fa fa-area-chart icon-large-effect icon-effect-1"></i>
                </div>
                <div class="service-content">
                    <h4>Transparan</h4>

                    <p>Bandingkan review dan rating berbagai penyedia jasa kiriman</p>
                </div>
            </div>
            <!-- End Service Icon 3 -->

            <!-- Start Service Icon 4 -->
            <div class="col-md-3 col-sm-6 service-box service-center">
                <div class="service-icon">
                    <i class="fa fa-life-saver icon-large-effect icon-effect-1"></i>
                </div>
                <div class="service-content">
                    <h4>Otomasi dan Integrasi</h4>

                    <p>Anda bisa langsung lihat dan lacak kiriman karena Anda terhubung langsung dengan penyedia jasa kiriman</p>
                </div>
            </div>
            <!-- End Service Icon 4 -->

        </div>
        <!-- End Services Icons -->
    </div>
</div>

<!-- divider -->
<div class="hr5" style="margin-top:25px; margin-bottom:45px;"></div>


<div class="section-child">
    <div class="container">
        <div class="big-title-child text-center" data-animation="fadeInDown" data-animation-delay="01">
            <h1><strong>Bagaimana caranya?</strong></h1>
        </div>
    </div>
</div>

<!-- Timeline -->
<section id="cd-timeline" class="section-child cd-container">
    <div class="cd-timeline-block">
        <div class="cd-timeline-img cd-picture">
            <img src="<?=base_url()?>assets/front/images/timeline/cd-icon-picture.svg" alt="Picture">
        </div> <!-- cd-timeline-img -->

        <div class="cd-timeline-content">
            <h2>1. Isi detail Barang dan lokasi asal serta tujuan pengiriman</h2>
            <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>-->
            <!--<a href="#0" class="cd-read-more">Read more</a>-->
            <!--<span class="cd-date">Jan 14</span>-->
        </div> <!-- cd-timeline-content -->
    </div> <!-- cd-timeline-block -->

    <div class="cd-timeline-block">
        <div class="cd-timeline-img cd-movie">
            <img src="<?=base_url()?>assets/front/images/timeline/cd-icon-movie.svg" alt="Movie">
        </div> <!-- cd-timeline-img -->

        <div class="cd-timeline-content">
            <h2>2. Piih penyedia jasa kiriman yang sesuai baik dari sisi harga ataupun pelayanan</h2>
            <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde?</p>-->
            <!--<a href="#0" class="cd-read-more">Read more</a>-->
            <!--<span class="cd-date">Jan 18</span>-->
        </div> <!-- cd-timeline-content -->
    </div> <!-- cd-timeline-block -->

    <div class="cd-timeline-block">
        <div class="cd-timeline-img cd-picture">
            <img src="<?=base_url()?>assets/front/images/timeline/cd-icon-picture.svg" alt="Picture">
        </div> <!-- cd-timeline-img -->

        <div class="cd-timeline-content">
            <h2>3. Lacak dan Lihat status kiriman Anda</h2>
            <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, obcaecati, quisquam id molestias eaque asperiores voluptatibus cupiditate error assumenda delectus odit similique.</p>-->
            <!--<a href="#0" class="cd-read-more">Read more</a>-->
            <!--<span class="cd-date">Jan 24</span>-->
        </div> <!-- cd-timeline-content -->
    </div> <!-- cd-timeline-block -->

    <div class="cd-timeline-block">
        <div class="cd-timeline-img cd-location">
            <img src="<?=base_url()?>assets/front/images/timeline/cd-icon-location.svg" alt="Location">
        </div> <!-- cd-timeline-img -->

        <div class="cd-timeline-content">
            <h2>4. Konfirmasi Kiriman yang sudah selesai</h2>
            <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>-->
            <!--<a href="#0" class="cd-read-more">Read more</a>-->
            <!--<span class="cd-date">Feb 14</span>-->
        </div> <!-- cd-timeline-content -->
    </div> <!-- cd-timeline-block -->

    <div class="cd-timeline-block">
        <div class="cd-timeline-img cd-location">
            <img src="<?=base_url()?>assets/front/images/timeline/cd-icon-location.svg" alt="Location">
        </div> <!-- cd-timeline-img -->

        <div class="cd-timeline-content">
            <h2>5. Berikan feedback dan rating bagi penyedia jasa kiriman</h2>
            <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum  earum voluptatem doloremque dolorem ipsam quae rerum quis. Odit, itaque, deserunt corporis vero ipsum nisi eius odio natus ullam provident pariatur temporibus quia eos repellat consequuntur perferendis enim amet.</p>-->
            <!--<a href="#0" class="cd-read-more">Read more</a>-->
            <!--<span class="cd-date">Feb 18</span>-->
        </div> <!-- cd-timeline-content -->
    </div> <!-- cd-timeline-block -->

    <div class="cd-timeline-block">
        <div class="cd-timeline-img cd-movie">
            <img src="<?=base_url()?>assets/front/images/timeline/cd-icon-movie.svg" alt="Movie">
        </div> <!-- cd-timeline-img -->

        <div class="cd-timeline-content">
            <h2>6. Proses Kiriman sudah selesai</h2>
            <!--<p>This is the content of the last section</p>-->
            <!--<span class="cd-date">Feb 26</span>-->
        </div> <!-- cd-timeline-content -->
    </div> <!-- cd-timeline-block -->

</section>
<!-- End Timeline -->

<!-- divider -->
<div class="empty-section"></div>

<!-- divider -->
<div class="hr5" style="margin-top:25px; margin-bottom:45px;"></div>

<!-- Start Testimonials Section -->
<div class="section-child">
    <div class="container">

        <div class="big-title-child text-center" data-animation="fadeInDown" data-animation-delay="01">
            <h1><strong>Testimoni</strong></h1>
        </div>

        <div class="row">
            <div class="col-md-12">

                <!-- Start Testimonials Carousel -->
                <div class="custom-carousel show-one-slide touch-carousel" data-appeared-items="1">
                    <!-- Testimonial 1 -->
                    <div class="classic-testimonials item">
                        <div class="testimonial-content">
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                                anim laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
                        <div class="testimonial-author"><span>John Doe</span> - Customer</div>
                    </div>
                    <!-- Testimonial 2 -->
                    <div class="classic-testimonials item">
                        <div class="testimonial-content">
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                                anim laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
                        <div class="testimonial-author"><span>John Doe</span> - Customer</div>
                    </div>
                    <!-- Testimonial 3 -->
                    <div class="classic-testimonials item">
                        <div class="testimonial-content">
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                                anim laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
                        <div class="testimonial-author"><span>John Doe</span> - Customer</div>
                    </div>
                </div>
                <!-- End Testimonials Carousel -->

            </div>
        </div>
    </div>
</div>
<!-- End Testimonials Section -->

<!-- divider -->
<div class="hr5" style="margin-top:25px; margin-bottom:45px;"></div>

<div id="content">
    <div class="container">
        <div class="page-content" data-animation="fadeInDown" data-animation-delay="01">
            <!-- Start Call Action -->
            <div class="call-action call-action-boxed call-action-style2 clearfix">
                <!-- Call Action Button -->
                <div class="button-side" style="margin-top:8px;"><a href="<?=site_url('login')?>" class="btn-system btn-large"><i class="icon-gift-1"></i> Login</a> <a href="<?=site_url('register')?>" class="btn-system btn-large btn-gray"><i class="icon-basket-2"></i> Get Started</a></div>
                <!-- Call Action Text -->
                <h2 class="primary"><strong>Yukirim</strong>, kirim apapun dan kapanpun dengan mudah, cepat dan aman</h2>
                <!--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>-->
            </div>
            <!-- End Call Action -->
        </div>
    </div>
</div>


<!-- Start Footer Section -->
<footer>
    <?php $this->load->view('front/common/footer'); ?>
</footer>
<!-- End Footer Section -->


</div>
<!-- End Full Body Container -->

<!-- Go To Top Link -->
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

<div id="loader">
    <div class="spinner">
        <div class="dot1"></div>
        <div class="dot2"></div>
    </div>
</div>


<?php $this->load->view('front/common/settings'); ?>

</body>

</html>