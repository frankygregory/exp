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

<!-- Container -->
<div id="container">

    <!-- Start Header -->
    <div class="hidden-header"></div>
    <header class="clearfix">

        <!-- Start Top Bar -->
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <!-- Start Contact Info -->
                        <!--                <ul class="contact-details">-->
                        <!--                    <li><a href="#"><i class="fa fa-map-marker"></i> House-54/A, London, UK</a>-->
                        <!--                    </li>-->
                        <!--                    <li><a href="#"><i class="fa fa-envelope-o"></i> info@yourcompany.com</a>-->
                        <!--                    </li>-->
                        <!--                    <li><a href="#"><i class="fa fa-phone"></i> +12 345 678 000</a>-->
                        <!--                    </li>-->
                        <!--                </ul>-->
                        <!-- End Contact Info -->
                    </div>
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
                </div>
            </div>
        </div>
        <!-- End Top Bar -->

        <!-- Start Header ( Logo & Naviagtion ) -->
        <div class="navbar navbar-default navbar-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Stat Toggle Nav Link For Mobiles -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- End Toggle Nav Link For Mobiles -->
                    <a class="navbar-brand" href="<?= site_url() ?>">
                        <img alt="" src="<?= base_url() ?>assets/front/images/yukirim.png">
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
                <?php $this->load->view('front/common/menu-mobile'); ?>
            </ul>
            <!-- Mobile Menu End -->

        </div>
        <!-- End Header ( Logo & Naviagtion ) -->

    </header>
    <!-- End Header -->


    <!-- Start Page Banner -->
    <div class="page-banner"
         style="padding:40px 0; background: url(<?= base_url('assets/front/images/default/breadcrumb.png') ?>) center #f9f9f9;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Kebijakan Privasi</h2>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumbs">
                        <li><a href="#">Home</a></li>
                        <li>Kebijakan Privasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Banner -->


    <!-- Start Content -->
    <div id="content">
        <div class="container">
            <div class="page-content">


                <div class="row">

                    <div class="col-md-12">

                        <!-- Classic Heading -->
                        <h4 class="classic-title"><span>Yukirim Shipment Marketplace</span></h4>

                        <!-- Some Text -->
                        <p style="text-align: justify">Kebijakan privasi yang dimaksud di Yukirim.com adalah acuan yang
                            mengatur dan melindungi penggunaan data dan informasi penting
                            para pengguna di bawah domain dan subdomain Yukirim.com
                            Data dan informasi yang telah dikumpulkan pada saat mendaftar seperti nama, alamat, e-mail,
                            nomor telepon, nomor handphone
                            dan lain lain yang dianggap perlu.
                            Dengan mendaftar di situs ini, berarti Anda setuju untuk terikat dengan syarat dan ketentuan
                            serta kebijakan privasi dari layanan kami.
                            Jika Anda tidak setuju, jangan menggunakan atau mengakses situs kami.
                        </p>

                        <p><strong>Kebijakan - kebijakan tersebut antara lain:</strong></p>
                        <p><ul style="list-style: circle; margin-left: 20px">
                            <li><p>Melindungi segala data dan informasi pribadi yang diberikan pengguna pada saat
                                    pendaftaran, mengakses, dan menggunakan seluruh layanan dari situs ini.</p></li>
                            <li><p>Yukirim.com berhak menggunakan data dan informasi para pengguna demi meningkatkan
                                    mutu dan pelayanan di situs ini.</p></li>
                            <li><p>Yukirim.com tidak bertanggung jawab atas pemberian data yang dilakukan sendiri oleh
                                    pengguna di luar situs ini.</p></li>
                            <li><p>Yukirim.com hanya dapat memberitahukan data dan informasi yang dimiliki oleh para
                                    pengguna situs bila diwajibkan dan/atau diminta oleh institusi
                                    yang berwenang berdasarkan ketentuan hukum yang berlaku, perintah resmi dari
                                    pengadilan, dan/atau perintah resmi dari instansi/aparat
                                    yang bersangkutan.</p></li>
                            <li><p>Pengguna dapat berhenti berlangganan beragam informasi terbaru (unsubscribe) jika
                                    tidak ingin menerima informasi tersebut.</p></li>
                        </ul></p>
                    </div>


                </div>


            </div>
        </div>
    </div>
    <!-- End content -->


    <!-- Start Footer -->
    <footer>
        <?php $this->load->view('front/common/footer'); ?>
    </footer>
    <!-- End Footer -->

</div>
<!-- End Container -->

<!-- Go To Top Link -->
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

<?php $this->load->view('front/common/settings'); ?>

<script type="text/javascript" src="js/script.js"></script>

</body>

</html>