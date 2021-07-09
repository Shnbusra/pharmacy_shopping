<?php
$urun_id=$_GET["urun_id"];
//ürün id üst ve alt kategori bilgileri ve ürün bilgileri getiriliyor 
$urundetay=mysqli_fetch_object(mysqli_query($baglan,"select ust_kategori.kategori_ust_adi, alt_kategori.kategori_alt_id, alt_kategori.kategori_alt_adi, urunler.* from urunler inner join alt_kategori on urunler.kategori_alt_id=alt_kategori.kategori_alt_id inner join ust_kategori on alt_kategori.kategori_ust_id=ust_kategori.kategori_ust_id where urun_id=$urun_id"));
?>
<div id="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 section-common">
				<div class="row">
					<div class="col-md-5">
						<a target="_blank" href="<?php echo SİTE_URL; ?>login/upload/urunfotolari/<?php echo $urundetay->urundetay_gorsel; ?>">
						<img src="<?php echo SİTE_URL; ?>login/upload/urunfotolari/<?php echo $urundetay->urundetay_gorsel; ?>" alt="" />
						</a><!-- .woocommerce-main-image -->		
					</div><!-- col -->
					<div class="col-md-6">
						<div class="summary summary-single">
							<h2 class="product_title"><?php echo $urundetay->urun_adi; ?></h2>
							<p class="price">
							<?php 
								if($urundetay->indirimli_urun){ 
							       $indirimli_fiyat_urundetay=$urundetay->urun_fiyat-($urundetay->urun_fiyat/100*$urundetay->indirim_oran);//İndirim için kod

							?>
								<del style="color:#9E9E9E; font-weight:100 !important; font-size:22px;">
									<span style="color:#9E9E9E; font-weight:100 !important; " class="amount">
										₺<?php echo $urundetay->urun_fiyat; ?>
									</span>
								</del>&nbsp;
								<span class="amount" style="font-size:35px;">₺<?php echo number_format($indirimli_fiyat_urundetay, 2, '.', ','); ?></span>								
							<?php }else{ ?>
								<span class="amount" style="font-size:35px;">₺<?php echo $urundetay->urun_fiyat; ?></span>
							<?php } ?>
							</p>
							<ul class="product_meta">
								<li><span>Stok Durumu:</span><?php echo ($urundetay->urun_stokbilgisi)?"Stokta Var":"Stokta Yok"; ?></li>
								
							</ul>
							<div class="description">
								<p><?php echo $urundetay->urun_detaybilgisi; ?></p>
							</div>
							<div class="cart">
								<button urun_id="<?php echo $urundetay->urun_id; ?>" class="single_add_to_cart_button sepete_ekle">Sepete Ekle</button>
							</div>
						</div><!-- .summary -->
					</div><!-- col -->
					<div class="col-xs-12 section-featured-product section-common upsells">
						<h2 class="section-title">Benzer Ürünler</h2>
						<div class="clear"></div>
						<div class="slick-wrap">
							<div class="products products-grid slick-middle-arrow js__slickslider" data-arrows="true" data-dots="false" data-show="4" data-responsive="{'992':2,'650':1}">
								<?php 
								//detayı gösterilen ürünün alt kategorisinde bulunan benzer ürünlerin ürün bilgileri ve alt kategori üst kategori bilgileri getiriliyor
									$benzerurun=mysqli_query($baglan, "select ust_kategori.kategori_ust_adi, ust_kategori.kategori_ust_id, alt_kategori.kategori_alt_adi, alt_kategori.kategori_alt_id,urunler.* from urunler inner join alt_kategori on urunler.kategori_alt_id=alt_kategori.kategori_alt_id inner join ust_kategori on alt_kategori.kategori_ust_id=ust_kategori.kategori_ust_id where alt_kategori.kategori_alt_id=$urundetay->kategori_alt_id");
									while($benzerurungetir=mysqli_fetch_object($benzerurun)){
								?>
								<div class="slick-slide">
							<div class="product-grid with-timer">
								<div class="thumb">
									<a href="index.php?do=urundetay&urun_id=<?php echo $benzerurungetir->urun_id; ?>">
										<img src="<?php echo SİTE_URL; ?>login/upload/urunfotolari/<?php echo $benzerurungetir->urun_gorsel; ?>" alt="">
										<ul class="attribute-list">
										<?php if($benzerurungetir->indirimli_urun){?>
											<li><span class="label-blue">-<?php echo $benzerurungetir->indirim_oran; ?>%</span></li>
										<?php } if(tarihfarki(date_format(date_create($benzerurungetir->urun_tarih),"d-m-Y")) <= 7){ ?>
												<li><span class="label-blue">Yeni</span></li>
											<?php } ?>
										</ul>
									</a>
									<?php if($benzerurungetir->indirimli_urun){ ?>
									<div id="countbox_1" class="js__count_down_box timer-view" data-date-now="<?php echo date('m/d/y H:i',strtotime('+1 hour')); ?>" data-date-then="<?php echo date_format(date_create($benzerurungetir->indirim_bitis),"m/d/y H:i"); ?>"></div><!--ay gün yıl saat dk-->
									<?php } ?>
									<button urun_id="<?php echo $benzerurungetir->urun_id; ?>" class="add_to_cart_button sepete_ekle"></button>
								</div>
								<div>
									<a  href="index.php?do=urundetay&urun_id=<?php echo $benzerurungetir->urun_id; ?>" ><h2 class="title"><?php echo $benzerurungetir->urun_adi; ?></h2></a>
									<a href="index.php?do=urun&uk=<?php echo $benzerurungetir->kategori_ust_id; ?>&uid=<?php echo $benzerurungetir->kategori_ust_id; ?>"><span class="category"><?php echo $benzerurungetir->kategori_ust_adi; ?></span></a> &infin; <a href="index.php?do=urun&ak=<?php echo $benzerurungetir->kategori_alt_id; ?>&uid=<?php echo $benzerurungetir->kategori_ust_id; ?>"><span class="category"><?php echo $benzerurungetir->kategori_alt_adi; ?></span></a>
									<a  href="index.php?do=urundetay&urun_id=<?php echo $benzerurungetir->urun_id; ?>" >
										<span class="price">
												<?php
													if($benzerurungetir->indirimli_urun){
														$indirimli_fiyat_benzer=$benzerurungetir->urun_fiyat-($benzerurungetir->urun_fiyat/100*$benzerurungetir->indirim_oran);//İndirim için kod
													?>
														<del><span class="amount">₺<?php echo $benzerurungetir->urun_fiyat; ?></span></del>
														<ins><span class="amount">₺<?php echo number_format($indirimli_fiyat_benzer, 2, '.', ','); ?></span></ins>
													<?php }else{ ?>
														<span class="amount">₺<?php echo $benzerurungetir->urun_fiyat; ?></span>
													<?php } ?>
										</span>
									</a>
								</div>
							</div>
						</div><!--product -->
												<?php } ?>
							</div><!-- .products -->	
						</div><!-- .slick-wrap -->		
					</div><!-- col -->
				</div><!-- .row -->
			</div><!-- col -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!--/#wrapper -->