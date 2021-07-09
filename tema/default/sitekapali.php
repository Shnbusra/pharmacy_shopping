<!DOCTYPE html>

<html lang="tr-TR">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ThemeStarz">

    <link href="<?php echo TEMA_URL; ?>fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="<?php echo TEMA_URL; ?>fonts/elegant-fonts.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo TEMA_URL; ?>css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo TEMA_URL; ?>css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="<?php echo TEMA_URL; ?>css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="<?php echo TEMA_URL; ?>css/trackpad-scroll-emulator.css" type="text/css">
    <link rel="stylesheet" href="<?php echo TEMA_URL; ?>css/sitekapali.css" type="text/css">

    <title><?php echo $satir["site_baslik"];?></title>

</head>
<?php
$sitekapali=mysqli_fetch_array(mysqli_query($baglan, "select * from sitekapali"));
//date format gelen tarihi yanda gösterdi gibi formatlar date create veri tabanından gelen tarihin formatlamak için tarih olarak oluşmasını sağlar.
$date=date_format(date_create($sitekapali["sitek_tarih"]), 'd.m.Y');
?>

<body class=" nav-btn-only">

<div id="outer-wrapper" class="animate translate-z-in">
    <div id="inner-wrapper">
        <div id="table-wrapper">
            <div class="container">
                <div id="row-header">
                    <header><a href="#" id="brand" class="animate animate fade-in animation-time-3s"><img src="assets/img/logo.png" alt=""></a></header>
                </div>
                <!--end row-header-->
                <div id="row-content">
                    <div id="content-wrapper">
                        <div id="content" class="animate translate-z-in animation-time-2s delay-05s">
                            <h1 class="opacity-60"><?php echo $sitekapali["sitek_baslik"]; ?></h1>
							<!-- substr komutu parçalamak için bulunur ilk olarak 6 karakterden başlayıp 4 karakter alır bir diyerinde 3 karakterden başlayıp 2 alır-->
                            <div class="center count-down animate" data-countdown-year="<?php echo substr($date, 6, 4); ?>" 
							data-countdown-month="<?php echo substr($date, 3, 2); ?>" data-countdown-day="<?php echo substr($date, 0, 2); ?>"></div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <!--end form-->
                                    <p><?php echo $sitekapali["sitek_aciklama"]; ?>
                                    </p>
                                </div>
                                <!--end col-md-6-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end content-->
                    </div>
                    <!--end content-wrapper-->
                </div>
                <!--end row-content-->
                <div id="row-footer">
                    <footer>
                        <div class="social-icons">
                            <a href="<?php echo $satir["site_twitter"]; ?>" target="_blank" class="animate fade-in animation-time-1s delay-1s"><i class="fa fa-twitter"></i></a>
                            <a href="<?php echo $satir["site_instagram"]; ?>" target="_blank" class="animate fade-in animation-time-1s delay-06s"><i class="fa fa-instagram"></i></a>
                        </div>
                    </footer>
                </div>
                <!--end row-footer-->
            </div>
            <!--end container-->
        </div>
        <!--end table-wrapper-->
        <div class="background-wrapper has-vignette zoom-animation">
            <div class="bg-transfer opacity-40"><img src="<?php echo TEMA_URL; ?>images/sitekapali.jpg" alt=""></div>
        </div>
        <!--end background-wrapper-->
    </div>
    <!--end inner-wrapper-->
</div>
<!--end outer-wrapper-->

<div class="backdrop"></div>

<script type="text/javascript" src="<?php echo TEMA_URL; ?>js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>
<script type="text/javascript" src="<?php echo TEMA_URL; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo TEMA_URL; ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo TEMA_URL; ?>js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo TEMA_URL; ?>js/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="<?php echo TEMA_URL; ?>js/jquery.trackpad-scroll-emulator.min.js"></script>
<script type="text/javascript" src="<?php echo TEMA_URL; ?>js/jquery.plugin.min.js"></script>
<script type="text/javascript" src="<?php echo TEMA_URL; ?>js/jquery.countdown.min.js"></script>
<script type="text/javascript" src="<?php echo TEMA_URL; ?>js/custom.js"></script>

<script type="text/javascript">
    var latitude = 34.038405;
    var longitude = -117.946944;
    var markerImage = "assets/img/map-marker-w.png";
    var mapTheme = "dark";
    var mapElement = "map-contact";
    google.maps.event.addDomListener(window, 'load', simpleMap(latitude, longitude, markerImage, mapTheme, mapElement));
</script>


</body>
