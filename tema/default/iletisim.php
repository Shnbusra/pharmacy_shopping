<?php 
$iletisim=mysqli_fetch_object(mysqli_query($baglan, "select * from ayarlar"));
?>
<div id="wrapper">
	<div class="section-common section-last">
		<div class="container">
			<div class="row text-center">
				<div class="col-md-3 col-sm-6 col-ip-6 col-xs-12">
					<div class="item-contact">
						<div class="item-icon"><img src="<?php echo TEMA_URL; ?>assets/images/icon-map-marker.png" alt=""></div>
						<p><?php echo $iletisim->site_adres; ?></p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-ip-6 col-xs-12">
					<div class="item-contact">
						<div class="item-icon"><img src="<?php echo TEMA_URL; ?>assets/images/icon-telephone.png" alt=""></div>
						<p><a href="tel:<?php echo $iletisim->site_iletisimno; ?>"><?php echo $iletisim->site_iletisimno; ?></a></p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-ip-6 col-xs-12">
					<div class="item-contact">
						<div class="item-icon"><img src="<?php echo TEMA_URL; ?>assets/images/icon-envelope.png" alt=""></div>
						<p><a href="mailto:<?php echo $iletisim->site_eposta; ?>"><?php echo $iletisim->site_eposta; ?></a></p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-ip-6 col-xs-12">
					<div class="item-contact">
						<div class="item-icon"><img src="<?php echo TEMA_URL; ?>assets/images/icon-share.png" alt=""></div>
						<ul class="item-square-social-list">
							<li><a target="_blank" href="<?php echo $iletisim->site_twitter; ?>" class="fa fa-twitter"></a></li>
							<li><a target="_blank" href="<?php echo $iletisim->site_instagram; ?>" class="fa fa-instagram"></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div><!-- .container -->
	</div><!-- section contact -->
	
	<div class="section-map js__map_wrap">
		<div id="js__map_1" class="map-absolute js__map js__map_absolute" data-lat="41.08912" data-lng="29.03495"></div>
		<div class="container">
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-8 js__map_target">
					<form action="#" class="contact-form">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-contact-row">
									<input type="text" placeholder="Ad Soyad" class="input-contact-text" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-contact-row">
									<input type="email" placeholder="E-Posta Adresi" class="input-contact-text" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-contact-row">
									<input type="tel" placeholder="Telefon Numarası" class="input-contact-text" />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-contact-row">
									<input type="text" placeholder="Konu" class="input-contact-text" />
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-contact-row">
									<textarea placeholder="Mesajınız..." class="input-contact-text"></textarea>
								</div>
								<input class="button-normal button-green" type="submit" value="gönder" />
							</div>
						</div>
					</form>
				</div>
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .section-map -->