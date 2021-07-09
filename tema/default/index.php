<!DOCTYPE html>
<?php

?>
<html lang="tr-TR">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="<?php echo $satir["site_aciklama"]; ?>">
	<meta name="keywords" content="<?php echo $satir["site_anahtarkelimeler"]; ?>">
	<meta name="author" content="Büşra ŞAHİN">

	<title><?php echo $satir["site_baslik"]; ?></title>
	<link rel="stylesheet" href="<?php echo TEMA_URL; ?>assets/styles/style.min.css">
	<style>
	#boscontent:before{
		content:"";
	}
	</style>
</head>

<body class="style-dark">
<div class="menumobile-navbar-wrapper">
	<nav class="menu-navbar menumobile-navbar js__menu_mobile">
		<div class="menumobile-close-btn js__menu_close">
			<span class="fa fa-times"></span> KAPAT
		</div>
		<div id="menu-mobile">
			<ul class="menu">
				<li class="current-menu-item menu-item-has-children"><a href="index.html">Anasayfa</a></li>
				<?php 
						$kategori=mysqli_query($baglan, "select * from ust_kategori");
						while($kategorigelen=mysqli_fetch_array($kategori)){
						$kategori_ust_id=$kategorigelen["kategori_ust_id"];
				?>
				<li class="menu-item-has-children"><a><?php echo $kategorigelen["kategori_ust_adi"]; ?></a><span class="drop-down-icon js__menu_drop"></span>
					<ul class="sub-menu">
					<?php
					$altkategori=mysqli_query($baglan, "select * from alt_kategori where kategori_ust_id=$kategori_ust_id");
					while($altkategorigelen=mysqli_fetch_array($altkategori)){
						echo '<li><a href="#">'.$altkategorigelen["kategori_alt_adi"].'</a></li>';
					}
					?>
					</ul>
				</li>
				<?php } ?>
			</ul><!--/.telefon menüsü -->
		</div><!--/#menu- -navbar -->
	</nav>
</div><!--/.menu- -navbar-wrapper -->
<div class="mobile-sticky js__menu_sticky">
	<div class="container">
		<div class="left-side">
			<a href="index.php" class="logo"><img src="http://localhost/proje/login/upload/sitelogo/site.png" alt="" /></a>
		</div>
		<div class="right-side">
			<button type="button" class="menumobile-toggle js__menu_toggle">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
	</div>
</div>
<div id="wrapper">
	<header class="header">
		<div class="top">
			<div class="container">
				<div class="right-side">
				
					<ul class="menu">
						<li><a href="index.php?do=hakkimda">Hakkımızda</a></li>
						<li><a href="index.php?do=iletisim">İletişim</a></li>
						<li><a href="#">Kayıt Ol</a></li>
						<li><a href="tema/default/giris.php">Oturum Aç</a></li>
					</ul>
					
				</div><!--/.right-side -->
			</div><!--/.container -->
		</div><!--/.top -->
		<div class="container">
			<div class="middle middle-ver-2">
				<a href="index.php" class="logo"><img src="<?php echo SİTE_URL; ?>login/upload/sitelogo/<?php echo $satir["site_logo"]; ?>" alt=""></a><!--site Logo kodları -->
				<div class="main-menu-wrap-2">
					<div class="main-menu-wrap js__auto_correct_sub_menu">
						<ul class="menu">
							<li class="current-menu-item"><a href="index.php">Anasayfa</a></li>
							<?php 
							$kategori=mysqli_query($baglan, "select * from ust_kategori");
							while($kategorigelen=mysqli_fetch_array($kategori)){
							$kategori_ust_id=$kategorigelen["kategori_ust_id"];
							?>
							<li class="menu-item-has-children mega-menu-wrap"><a href="index.php?do=urun&uk=<?php echo $kategori_ust_id; ?>&uid=<?php echo $kategori_ust_id; ?>"><?php echo $kategorigelen["kategori_ust_adi"]; ?></a>
								<div class="mega-menu js__background_image js__background_position js__background_repeat" 
								data-background-image="url(<?php echo SİTE_URL; ?>login/upload/kategori/<?php echo $kategorigelen["kategori_ust_acilir_foto"]; ?>)" 
								data-background-position="right bottom" data-background-repeat="no-repeat">
									<div class="row">
										<div class="col-md-7">
											<div class="row">
											<?php 
											//ust kategori id göre alt kategori sayısını getirir
											$altkategorisayisi=mysqli_num_rows(mysqli_query($baglan, "select * from alt_kategori where kategori_ust_id=$kategori_ust_id"));
											//her sütünda 6 tane kategori olması için yazılmıştır
											$veribaslangic=0;
											$veribitis=6;
											//eğer altıdan fazla geliyorsa gelen veriyi 6 ya bölerek her bir sütuna 6 tane gelmesini sağlar 7 de bir diyer sütuna geçer.
											for($i=0; $i<=$altkategorisayisi/6; $i++){
											?>
												<div class="col-md-4">
													<ul class="sub-menu">
													    <?php
														//ust kategori id göre her sütunda 6 kategori getirir
														$altkategori=mysqli_query($baglan, "select * from alt_kategori where kategori_ust_id=$kategori_ust_id LIMIT $veribaslangic,$veribitis");														
														while($altkategorigelen=mysqli_fetch_array($altkategori)){
															$kategori_alt_id=$altkategorigelen["kategori_alt_id"];
															echo '<li><a href="index.php?do=urun&ak='.$kategori_alt_id.'&uid='.$kategori_ust_id.'">'.$altkategorigelen["kategori_alt_adi"].'</a></li>';
														}
														//eğer 1 sütunda 6 daha az kategori varsa o sütunu 6 ya tamamlar
														if($altkategorisayisi<6){
															for($j=0; $j<(6-$altkategorisayisi); $j++){
																echo '<li><a href="#" id="boscontent"></a></li>';
															}
														}
														?>
													</ul>
												</div><!--/col -->
											<?php 
											//gelen kategorilerin devamının gelmesi için veri başlangıç değeri veri bitiş değeri kadar artırılıyor 
											$veribaslangic+=$veribitis;
											} ?>
											</div><!--/.row -->
										</div><!--col -->
										<div class="col-md-5">
										</div><!--col -->
									</div><!--/.row -->
								</div><!--/.menu-mega -->
							</li>
							<?php } ?>
							<li class="menu-item-has-children mega-menu-wrap"><a href="index.php?do=urun&islem=indirim">İNDİRİM</a>
								<div class="mega-menu js__background_image js__background_position js__background_repeat" data-background-image="url(<?php echo SİTE_URL; ?>login/upload/kategori/indirim.png)" data-background-position="right bottom" data-background-repeat="no-repeat">
									<div class="row">
										<div class="col-md-7">
											<div class="row">
											<?php 
											//indirimli olan ürünün alt kategori id göre alt kategorisi alt kategorideki üst kategori id göre üst kategori getirilmiştir. group by üst kategorileri gruplandırılmıştır. grpup by 1 sütundaki aynı olan şeyleri gruplandırır. 
												$indirimli_ust_kategori=mysqli_query($baglan, "select ust_kategori.kategori_ust_id,ust_kategori.kategori_ust_adi from urunler inner join alt_kategori on urunler.kategori_alt_id=alt_kategori.kategori_alt_id inner join ust_kategori ON alt_kategori.kategori_ust_id=ust_kategori.kategori_ust_id where indirimli_urun=1 GROUP BY ust_kategori.kategori_ust_adi");
												while($indirimli_ust_kategori_getir=mysqli_fetch_array($indirimli_ust_kategori)){
													$kategori_ust_id=$indirimli_ust_kategori_getir["kategori_ust_id"];
											?>
												<div class="col-md-4">
														<h3 class="title"><a href="index.php?do=urun&islem=indirim&iuk=<?php echo $kategori_ust_id; ?>"><?php echo $indirimli_ust_kategori_getir["kategori_ust_adi"]; ?></a></h3>
													<ul class="sub-menu">
													<?php 
													//indirimli olan ve üst kategori id ust kategorinin üst kategori id göre ürünleri getiriyor. ürünlerin alt kategori id göre alt kategorisini getiriyor ve group by ile alt kategori isimlerini gruplandırıyor.
														$indirimli_alt_kategori=mysqli_query($baglan, "select alt_kategori.kategori_alt_adi,alt_kategori.kategori_alt_id from urunler inner join alt_kategori on urunler.kategori_alt_id=alt_kategori.kategori_alt_id  where kategori_ust_id=$kategori_ust_id and indirimli_urun=1 GROUP BY alt_kategori.kategori_alt_adi");
														while($indirimli_alt_kategori_getir=mysqli_fetch_array($indirimli_alt_kategori)){
															//urun sayfasına işlem değeri indirim olucak şekilde ve iak(indirimli alt kategori) değerinede alt kategorisini gönderir
															echo '<li><a href="index.php?do=urun&islem=indirim&iak='.$indirimli_alt_kategori_getir["kategori_alt_id"].'">'.$indirimli_alt_kategori_getir["kategori_alt_adi"].'</a></li>';
														}
														if(mysqli_num_rows($indirimli_alt_kategori)<6){
															for($j=0; $j<(6-mysqli_num_rows($indirimli_alt_kategori)); $j++){
																echo '<li><a href="#" id="boscontent"></a></li>';
															}
														}
														  ?>
													</ul>
												</div><!--/col -->
												<?php } ?>
											</div><!--/.row -->
										</div><!--col -->
										<div class="col-md-5"></div><!--col -->
									</div><!--/.row -->
								</div><!--/.menu-mega -->
							</li>
						</ul><!--/.menu -->
					</div><!--/.main-menu-wrap -->
				</div><!--/.main-menu-wrap-2 -->
				<ul class="right-side">
					<li class="js__drop_down search-toggle">
						<a href="#" class="fa fa-search js__drop_down_button"></a>
						<div class="search-container">
							<form action="#">
								<input type="search" class="inp-search" placeholder="Kategori, ürün veya marka Yazın...">
								<button type="submit" class="btn-submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</li>
					<li class="user-wrap"><a href="#" class="fa fa-user"></a></li>
					<li>
						<a href="index.php?do=sepet" class="fa fa-shopping-cart"><span class="num sepet_toplam_adet"><?php echo (isset($_SESSION["alisveris_karti"]))? $_SESSION["alisveris_karti"]["siparis_özeti"]["toplam_adet"]:0; ?></span></a>
					</li>
					<li class="menumobile-toggle-wrap">
						<button type="button" class="menumobile-toggle js__menu_toggle">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</li>
				</ul><!--/.right-side -->
			</div><!--/.middle -->
		</div><!--/.container -->
	</header><!--/.header -->
	
		<?php tema_icerik($baglan); ?>
		
	<div class="section-common section-services" style="margin-bottom:5%;">
		<div class="container">
			<ul class="row margin-top--30">
				<li class="col-md-4">
					<a class="item-service with-number" data-number="01">
						<i class="fa fa-truck thumb"></i>
						<h2 class="title">Ücretsiz Kargo</h2>
						<p>300 ₺ üzerindeki tüm siparişlerde ücretsiz gönderim yapıyoruz</p>
					</a>
				</li><!--- .col -->
				<li class="col-md-4">
					<a class="item-service with-number" data-number="02">
						<i class="fa thumb fa-clock-o"></i>
						<h2 class="title">Hızlı Teslimat</h2>
						<p>Siparişlerinizi 3 günden kısa sürede alacaksınız</p>
					</a>
				</li><!--- .col -->
				<li class="col-md-4">
					<a class="item-service with-number" data-number="03">
						<i class="fa thumb fa-users"></i>
						<h2 class="title">24/7 Müşteri Hizmetleri</h2>
						<p>Profesyonel ve güler yüzlü bir destek departmanımız var</p>
					</a>
				</li><!--- .col -->
			</ul><!--- .row -->
		</div><!--- .container -->
	</div><!--- .section-services -->

	<footer class="footer">
		<div class="container">
			<div class="top">
				<div class="row">
					<div class="col-md-2 col-sm-4">
						<div class="widget widget_nav_menu">
							<h3 class="title">Yardım</h3>
							<ul class="menu">
								<li><a href="#">SSS</a></li>
								<li><a href="#">Gizlilik Politikası</a></li>
								<li><a href="#">Şartlar & Koşullarımız</a></li>
								<li><a href="index.php?do=iletisim">İletişim</a></li>
								<li><a href="#">Online Yardım</a></li>
							</ul>
						</div>
					</div><!-- col -->
					<div class="col-md-2 col-sm-4">
						<div class="widget widget_nav_menu">
							<h3 class="title">Hesap</h3>
							<ul class="menu">
								<li><a href="#">Hesabım</a></li>
								<li><a href="#">İstek Listesi</a></li>
								<li><a href="#">Şiparişlerim</a></li>
								<li><a href="#">Favorilerim</a></li>
								<li><a href="#">Kuponlarım</a></li>
							</ul>
						</div>
					</div><!-- col -->
					<div class="col-md-2 col-sm-4">
						<div class="widget widget_nav_menu">
							<h3 class="title">Quick Links</h3>
							<ul class="menu">
								<li><a href="#">Best Sellers</a></li>
								<li><a href="#">Featured Products</a></li>
								<li><a href="#">Hot Products</a></li>
								<li><a href="#">Top Rated</a></li>
								<li><a href="#">Blog</a></li>
								<li><a href="#">Contact Us</a></li>
							</ul>
						</div>
					</div><!-- col -->
					<div class="col-md-3 col-sm-6">
						<div class="widget widget_text">
							<h3 class="title">İletişim</h3>
							<p>Yardıma mı ihtiyacınız var. Hemen bizimle iletişime geçin.</p>
							<ul class="contact-list">
								<li><a href="mailto:<?php echo $satir["site_eposta"]; ?>"><i class="fa fa-envelope-o"></i><?php echo $satir["site_eposta"]; ?></a></li>
								<li><a href="tel:<?php echo $satir["site_iletisimno"]; ?>"><i class="fa fa-phone"></i><?php echo $satir["site_iletisimno"]; ?></a></li>
								<li><i class="fa fa-map-marker"></i><?php echo $satir["site_adres"]; ?></li>
							</ul>
						</div>
					</div><!-- col -->
					<div class="col-md-3 col-sm-6">
						<div class="widget widget_subscribe">
							<ul class="social-list" style="margin-top:40%;">
								<li><a target="_blank" href="<?php echo $satir["site_twitter"]; ?>" class="fa fa-twitter"></a></li>
								<li><a target="_blank" href="<?php echo $satir["site_instagram"]; ?>" class="fa fa-instagram"></a></li>
							</ul>
						</div>
					</div><!-- col -->
				</div><!-- .row -->
			</div><!-- .top -->
		</div><!-- .container -->
		<div class="bottom">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="copyright">Copyright &copy; 2019 - <?php echo date("Y"); ?> Black Yazılım. Tüm Hakları Saklıdır</div>
					</div><!-- col -->
					<div class="col-sm-6">
						<ul class="payment-list">
							<li><a href="#"><img src="<?php echo TEMA_URL; ?>assets/images/payment1.jpg" alt=""></a></li>
							<li><a href="#"><img src="<?php echo TEMA_URL; ?>assets/images/payment2.jpg" alt=""></a></li>
							<li><a href="#"><img src="<?php echo TEMA_URL; ?>assets/images/payment3.jpg" alt=""></a></li>
							<li><a href="#"><img src="<?php echo TEMA_URL; ?>assets/images/payment4.jpg" alt=""></a></li>
							<li><a href="#"><img src="<?php echo TEMA_URL; ?>assets/images/payment6.jpg" alt=""></a></li>
						</ul>
					</div><!-- col -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .bottom -->
	</footer><!--/.footer -->
</div><!--/#wrapper -->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/script/html5shiv.min.js"></script>
	<script src="assets/script/respond.min.js"></script>
	<![endif]-->
	<!-- 
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?php echo TEMA_URL; ?>assets/scripts/jquery.min.js"></script>
	<!-- BEGIN Revolution Slider Scripts -->
	<script type="text/javascript" src="<?php echo TEMA_URL; ?>assets/plugin/rev/js/jquery.themepunch.tools.min.js"></script>
	<script type="text/javascript" src="<?php echo TEMA_URL; ?>assets/plugin/rev/js/jquery.themepunch.revolution.min.js"></script>
	<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->

	<script type="text/javascript" src="<?php echo TEMA_URL; ?>assets/plugin/rev/js/extensions/revolution.extension.actions.min.js"></script>
	<script type="text/javascript" src="<?php echo TEMA_URL; ?>assets/plugin/rev/js/extensions/revolution.extension.carousel.min.js"></script>
	<script type="text/javascript" src="<?php echo TEMA_URL; ?>assets/plugin/rev/js/extensions/revolution.extension.kenburn.min.js"></script>
	<script type="text/javascript" src="<?php echo TEMA_URL; ?>assets/plugin/rev/js/extensions/revolution.extension.layeranimation.min.js"></script>
	<script type="text/javascript" src="<?php echo TEMA_URL; ?>assets/plugin/rev/js/extensions/revolution.extension.migration.min.js"></script>
	<script type="text/javascript" src="<?php echo TEMA_URL; ?>assets/plugin/rev/js/extensions/revolution.extension.navigation.min.js"></script>
	<script type="text/javascript" src="<?php echo TEMA_URL; ?>assets/plugin/rev/js/extensions/revolution.extension.parallax.min.js"></script>
	<script type="text/javascript" src="<?php echo TEMA_URL; ?>assets/plugin/rev/js/extensions/revolution.extension.slideanims.min.js"></script>
	<script type="text/javascript" src="<?php echo TEMA_URL; ?>assets/plugin/rev/js/extensions/revolution.extension.video.min.js"></script>
	
	<!-- END Revolution Slider Scripts -->
	<script src="<?php echo TEMA_URL; ?>assets/scripts/jquery.inview.min.js"></script>
	<script src="<?php echo TEMA_URL; ?>assets/scripts/modernizr.min.js"></script>
	<script src="<?php echo TEMA_URL; ?>assets/scripts/jquery.scrollTo.min.js"></script>
	<script src="<?php echo TEMA_URL; ?>assets/plugin/select2/js/select2.min.js"></script>
	<script src="<?php echo TEMA_URL; ?>assets/scripts/isotope.pkgd.min.js"></script>
	<script src="<?php echo TEMA_URL; ?>assets/scripts/cells-by-row.min.js"></script>
	<script src="<?php echo TEMA_URL; ?>assets/scripts/packery-mode.pkgd.min.js"></script>
	<script src="<?php echo TEMA_URL; ?>assets/plugin/slick/slick.min.js"></script>
	<script src="<?php echo TEMA_URL; ?>assets/scripts/jquery.parallax-1.1.3.min.js"></script>
	<script src="<?php echo TEMA_URL; ?>assets/scripts/nouislider.min.js"></script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD84ST3FIRNNVS1CEm_IE9KoR-lAIw8OPo" type="text/javascript"></script>
	<script src="<?php echo TEMA_URL; ?>assets/scripts/main.min.js"></script>
	<script type="text/javascript" src="<?php echo TEMA_URL; ?>assets/plugin/rev/js/jquery.revolution.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
	// js ile sepet işlemlerinin  sepet ekle ve sepeten ürün silme 
		$(document).ready(function() {
			$(".sepete_ekle").click(function() {
				var url = "http://localhost/proje/tema/default/sepet_islemleri.php";
				var data = {
					islem: "Ekle",
					urun_id: $(this).attr("urun_id")
				};
				$.post(url, data, function(yanit) {
					//alert(yanit)
					$(".sepet_toplam_adet").text(yanit);
				});
			});
			$(".sepet_sil").click(function() {
				var url = "http://localhost/proje/tema/default/sepet_islemleri.php";
				var data = {
					islem: "Sil",
					urun_id: $(this).attr("urun_id")
				};
				$.post(url, data, function(yanit) {
					window.location.reload();
				});
			});
		});
	</script>
</body>
</html>