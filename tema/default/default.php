<?php 
require_once "slider.php";
?>
	<div class="section-adv section-common">
		<div class="container">
			<div class="row margin-top--30">
			<?php 
						$kategori=mysqli_query($baglan, "select * from ust_kategori");
						while($kategorigelen=mysqli_fetch_array($kategori)){
			?>
				<div class="col-md-4">
					<a href="index.php?do=urun&uk=<?php echo $kategorigelen["kategori_ust_id"]; ?>&uid=<?php echo $kategorigelen["kategori_ust_id"]; ?>" class="item-adv">
						<img class="thumb" src="<?php echo SİTE_URL; ?>login/upload/kategori/<?php echo $kategorigelen["kategori_ust_foto"]; ?>" alt="">
						<div class="content">
							<h2 class="title"><?php echo $kategorigelen["kategori_ust_adi"]; ?></h2>
							<br>
							<span class="btn-common">İNCELE</span>
						</div>
					</a><!--- .item-adv -->
				</div><!--- .col -->
				<?php } ?>
				<div class="col-md-4">
					<a href="index.php?do=urun&islem=indirim" class="item-adv">
						<img class="thumb" src="<?php echo SİTE_URL; ?>login/upload/kategori/indirimalt.png" alt="">
						<div class="content">
							<h2 class="title">İNDİRİM</h2>
							<br>
							<span class="btn-common">İNCELE</span>
						</div>
					</a><!--- .item-adv -->
				</div><!--- .col -->
			</div><!--- .row -->
		</div><!--- .container -->
	</div><!--- .section-adv -->
	<div class="section-featured-product section-common">
		<div class="container tab-product-wrap js__tab">
			<h2 class="section-title">İndirimli ürünler</h2>
			<div class="clear"></div>
			<div class="tab-contents">
				<div class="tab-content js__tab_content js__active">
					<div class="products products-grid slick-middle-arrow js__slickslider" data-arrows="true" data-dots="false" data-show="4" data-responsive="{'992':2,'650':1}">
					<?php 
					//indirimli olan ürün bilgileri alt ve üst kategori bilgileri getiriliyor
						$indirimli_urunler=mysqli_query($baglan, "select urunler.*,alt_kategori.kategori_alt_adi,ust_kategori.kategori_ust_id,ust_kategori.kategori_ust_adi from urunler inner join alt_kategori on urunler.kategori_alt_id=alt_kategori.kategori_alt_id inner join ust_kategori ON alt_kategori.kategori_ust_id=ust_kategori.kategori_ust_id where indirimli_urun=1");
						while($indirimli_urungetir=mysqli_fetch_array($indirimli_urunler)){
							//indirim hesaplama kodu urun fiyatı 100 bölerek * indirim oranı yapılarak indirimli fiyata ulaşılır
							$indirimli_fiyat=$indirimli_urungetir["urun_fiyat"]-($indirimli_urungetir["urun_fiyat"]/100*$indirimli_urungetir["indirim_oran"]);//İndirim için kod
					?>
						<div class="slick-slide">
							<div class="product-grid with-timer">
								<div class="thumb">
									<a href="index.php?do=urundetay&urun_id=<?php echo $indirimli_urungetir["urun_id"]; ?>">
										<img src="<?php echo SİTE_URL; ?>login/upload/urunfotolari/<?php echo $indirimli_urungetir["urun_gorsel"]; ?>" alt="">
										<ul class="attribute-list">
											<li><span class="label-blue">-<?php echo $indirimli_urungetir["indirim_oran"]; ?>%</span></li>
											<?php if(tarihfarki(date_format(date_create($indirimli_urungetir["urun_tarih"]),"d-m-Y")) <= 7){ ?>
												<li><span class="label-blue">Yeni</span></li>
											<?php } ?>
										</ul>
									</a>
									<!-- indirim süresini hesaplayan ve gösteren-->
									<div id="countbox_1" class="js__count_down_box timer-view" data-date-now="<?php echo date('m/d/y H:i',strtotime('+1 hour')); ?>" data-date-then="<?php echo date_format(date_create($indirimli_urungetir["indirim_bitis"]),"m/d/y H:i"); ?>"></div><!--ay gün yıl saat dk-->
									<button urun_id="<?php echo $indirimli_urungetir["urun_id"]; ?>" class="add_to_cart_button sepete_ekle"></button>
								</div>
								<div>
									<a  href="index.php?do=urundetay&urun_id=<?php echo $indirimli_urungetir["urun_id"]; ?>" ><h2 class="title"><?php echo $indirimli_urungetir["urun_adi"]; ?></h2></a>
									<a href="index.php?do=urun&uk=<?php echo $indirimli_urungetir["kategori_ust_id"]; ?>&uid=<?php echo $indirimli_urungetir["kategori_ust_id"]; ?>"><span class="category"><?php echo $indirimli_urungetir["kategori_ust_adi"]; ?></span></a> &infin; <a href="index.php?do=urun&ak=<?php echo $indirimli_urungetir["kategori_alt_id"]; ?>&uid=<?php echo $indirimli_urungetir["kategori_ust_id"]; ?>"><span class="category"><?php echo $indirimli_urungetir["kategori_alt_adi"]; ?></span></a>
									<a  href="index.php?do=urundetay&urun_id=<?php echo $indirimli_urungetir["urun_id"]; ?>" >
										<span class="price">
											<del><span class="amount">₺<?php echo $indirimli_urungetir["urun_fiyat"]; ?></span></del>
											<ins><span class="amount">₺<?php echo number_format($indirimli_fiyat, 2, '.', ','); ?></span></ins>
										</span>
									</a>
								</div>
							</div>
						</div><!--product -->
						<?php } ?>
					</div><!-- .products -->
				</div><!--- .tab-content -->
			</div><!--- .tab-contents -->
		</div><!--- .tab-product-wrap -->
	</div><!--- .section-featured-product -->
		<div class="section-isotope-product section-common tab-product-wrap">
		<div class="container js__filter_isotope">
			<h2 class="section-title">Yeni Ürünler</h2>
			<div class="clear"></div>
			<div class="products products-grid row row-inline-block js__isotope_items">
				<?php 
						$yeni_urunler=mysqli_query($baglan, "select urunler.*,alt_kategori.kategori_alt_adi,ust_kategori.kategori_ust_id,ust_kategori.kategori_ust_adi from urunler inner join alt_kategori on urunler.kategori_alt_id=alt_kategori.kategori_alt_id inner join ust_kategori ON alt_kategori.kategori_ust_id=ust_kategori.kategori_ust_id where urun_tarih >(NOW()-INTERVAL 7 DAY)");// şuandan 7 gün çıkararak ürün tarihten düşük olan zamanları 
						while($yeni_urungetir=mysqli_fetch_array($yeni_urunler)){
					?>
				<div class="col-md-3 col-sm-6 col-ip-6 col-xs-12 js__isotope_item kid">
					<div class="product-grid">
						<div class="thumb">
							<a href="index.php?do=urundetay&urun_id=<?php echo $yeni_urungetir["urun_id"]; ?>"><img src="<?php echo SİTE_URL; ?>login/upload/urunfotolari/<?php echo $yeni_urungetir["urun_gorsel"]; ?>" alt="">
								<ul class="attribute-list">
								<?php if($yeni_urungetir["indirimli_urun"]){ ?>
									<li><span class="label-red">-<?php echo $yeni_urungetir["indirim_oran"]; ?>%</span></li>
								<?php } ?>
								</ul>
							</a>
							<?php if($yeni_urungetir["indirimli_urun"]){ ?>
								<div id="countbox_1" class="js__count_down_box timer-view" data-date-now="<?php echo date('m/d/y H:i',strtotime('+1 hour')); ?>" data-date-then="<?php echo date_format(date_create($yeni_urungetir["indirim_bitis"]),"m/d/y H:i"); ?>"></div>
							<?php } ?>
							<button urun_id="<?php echo $yeni_urungetir["urun_id"]; ?>" class="add_to_cart_button sepete_ekle"></button>
						</div>
						<div>
							<a href="index.php?do=urundetay&urun_id=<?php echo $yeni_urungetir["urun_id"]; ?>"><h2 class="title"><?php echo $yeni_urungetir["urun_adi"]; ?></h2></a>
							<a href="index.php?do=urun&uk=<?php echo $yeni_urungetir["kategori_ust_id"]; ?>&uid=<?php echo $yeni_urungetir["kategori_ust_id"]; ?>" ><span class="category"><?php echo $yeni_urungetir["kategori_ust_adi"]; ?></span></a><br />
							<a href="index.php?do=urun&ak=<?php echo $yeni_urungetir["kategori_alt_id"]; ?>&uid=<?php echo $yeni_urungetir["kategori_ust_id"]; ?>" ><span class="category"><?php echo $yeni_urungetir["kategori_alt_adi"]; ?></span></a>
							<a href="index.php?do=urundetay&urun_id=<?php echo $yeni_urungetir["urun_id"]; ?>">
							<span class="price">
							<?php
								if($yeni_urungetir["indirimli_urun"]){
									$indirimli_fiyat=$yeni_urungetir["urun_fiyat"]-($yeni_urungetir["urun_fiyat"]/100*$yeni_urungetir["indirim_oran"]);//İndirim için kod
								?>
									<del><span class="amount">₺<?php echo $yeni_urungetir["urun_fiyat"]; ?></span></del>
									<ins><span class="amount">₺<?php echo number_format($indirimli_fiyat, 2, '.', ','); ?></span></ins>
								<?php }else{ ?>
									<span class="amount">₺<?php echo $yeni_urungetir["urun_fiyat"]; ?></span>
								<?php } ?>
							</span></a>
						</div>
					</div>
				</div><!-- product -->
						<?php } ?>
			</div><!-- .products -->
		</div><!--- .container -->
	</div><!--- .section-isotope-product -->