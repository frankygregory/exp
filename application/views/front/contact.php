<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
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
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <!-- Start Social Links -->
                <ul class="social-list">
                    <li>
                        <a class="facebook itl-tooltip" data-placement="bottom" title="Facebook" href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a class="twitter itl-tooltip" data-placement="bottom" title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a class="google itl-tooltip" data-placement="bottom" title="Google Plus" href="#"><i class="fa fa-google-plus"></i></a>
                    </li>
                    <li>
                        <a class="dribbble itl-tooltip" data-placement="bottom" title="Dribble" href="#"><i class="fa fa-dribbble"></i></a>
                    </li>
                    <li>
                        <a class="linkdin itl-tooltip" data-placement="bottom" title="Linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                    <li>
                        <a class="flickr itl-tooltip" data-placement="bottom" title="Flickr" href="#"><i class="fa fa-flickr"></i></a>
                    </li>
                    <li>
                        <a class="tumblr itl-tooltip" data-placement="bottom" title="Tumblr" href="#"><i class="fa fa-tumblr"></i></a>
                    </li>
                    <li>
                        <a class="instgram itl-tooltip" data-placement="bottom" title="Instagram" href="#"><i class="fa fa-instagram"></i></a>
                    </li>
                    <li>
                        <a class="vimeo itl-tooltip" data-placement="bottom" title="vimeo" href="#"><i class="fa fa-vimeo-square"></i></a>
                    </li>
                    <li>
                        <a class="skype itl-tooltip" data-placement="bottom" title="Skype" href="#"><i class="fa fa-skype"></i></a>
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
            <a class="navbar-brand" href="index.html"><img alt="" src="<?=base_url()?>assets/front/images/yukirim.png"></a>
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
<!-- End Header ( Logo & Naviagtion ) -->

</header>
<!-- End Header -->

<!-- Start Map -->
<div id="map" data-position-latitude="23.858092" data-position-longitude="90.262181"></div>
<script>
    (function($) {
        $.fn.CustomMap = function(options) {

            var posLatitude = $('#map').data('position-latitude'),
                posLongitude = $('#map').data('position-longitude');

            var settings = $.extend({
                home: {
                    latitude: posLatitude,
                    longitude: posLongitude
                },
                text: '<div class="map-popup"><h4>Web Development | ZoOm-Arts</h4><p>A web development blog for all your HTML5 and WordPress needs.</p></div>',
                icon_url: $('#map').data('marker-img'),
                zoom: 15
            }, options);

            var coords = new google.maps.LatLng(settings.home.latitude, settings.home.longitude);

            return this.each(function() {
                var element = $(this);

                var options = {
                    zoom: settings.zoom,
                    center: coords,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: false,
                    scaleControl: false,
                    streetViewControl: false,
                    panControl: true,
                    disableDefaultUI: true,
                    zoomControlOptions: {
                        style: google.maps.ZoomControlStyle.DEFAULT
                    },
                    overviewMapControl: true,
                };

                var map = new google.maps.Map(element[0], options);

                var icon = {
                    url: settings.icon_url,
                    origin: new google.maps.Point(0, 0)
                };

                var marker = new google.maps.Marker({
                    position: coords,
                    map: map,
                    icon: icon,
                    draggable: false
                });

                var info = new google.maps.InfoWindow({
                    content: settings.text
                });

                google.maps.event.addListener(marker, 'click', function() {
                    info.open(map, marker);
                });

                var styles = [{
                    "featureType": "landscape",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "lightness": 65
                    }, {
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "poi",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "lightness": 51
                    }, {
                        "visibility": "simplified"
                    }]
                }, {
                    "featureType": "road.highway",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "visibility": "simplified"
                    }]
                }, {
                    "featureType": "road.arterial",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "lightness": 30
                    }, {
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "road.local",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "lightness": 40
                    }, {
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "transit",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "visibility": "simplified"
                    }]
                }, {
                    "featureType": "administrative.province",
                    "stylers": [{
                        "visibility": "on"
                    }]
                }, {
                    "featureType": "water",
                    "elementType": "labels",
                    "stylers": [{
                        "visibility": "on"
                    }, {
                        "lightness": -25
                    }, {
                        "saturation": -100
                    }]
                }, {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{
                        "hue": "#ffff00"
                    }, {
                        "lightness": -25
                    }, {
                        "saturation": -97
                    }]
                }];

                map.setOptions({
                    styles: styles
                });
            });

        };
    }(jQuery));

    jQuery(document).ready(function() {
        jQuery('#map').CustomMap();
    });
</script>
<!-- End Map -->

<!-- Start Content -->
<div id="content">
    <div class="container">

        <div class="row">

            <div class="col-md-8">

                <!-- Classic Heading -->
                <h4 class="classic-title"><span>Contact Us</span></h4>

                <!-- Start Contact Form -->
                <form role="form" class="contact-form" id="contact-form" method="post">
                    <div class="form-group">
                        <div class="controls">
                            <input type="text" placeholder="Name" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <input type="email" class="email" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <input type="text" class="requiredField" placeholder="Subject" name="subject">
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="controls">
                            <textarea rows="7" placeholder="Message" name="message"></textarea>
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn-system btn-large">Send</button>
                    <div id="success" style="color:#34495e;"></div>
                </form>
                <!-- End Contact Form -->

            </div>

            <div class="col-md-4">

                <!-- Classic Heading -->
                <h4 class="classic-title"><span>Information</span></h4>

                <!-- Some Info -->
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum.</p>

                <!-- Divider -->
                <div class="hr1" style="margin-bottom:10px;"></div>

                <!-- Info - Icons List -->
                <ul class="icons-list">
                    <li><i class="fa fa-globe">  </i> <strong>Address:</strong> 1234 Street Name, Bangladesh.</li>
                    <li><i class="fa fa-envelope-o"></i> <strong>Email:</strong> info@yourcompany.com</li>
                    <li><i class="fa fa-mobile"></i> <strong>Phone:</strong> +12 345 678 001</li>
                </ul>

                <!-- Divider -->
                <div class="hr1" style="margin-bottom:15px;"></div>

                <!-- Classic Heading -->
                <h4 class="classic-title"><span>Working Hours</span></h4>

                <!-- Info - List -->
                <ul class="list-unstyled">
                    <li><strong>Monday - Friday</strong> - 9am to 5pm</li>
                    <li><strong>Saturday</strong> - 9am to 2pm</li>
                    <li><strong>Sunday</strong> - Closed</li>
                </ul>

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

<!-- Style Switcher -->
<?php $this->load->view('front/common/settings'); ?>

</body>

</html>