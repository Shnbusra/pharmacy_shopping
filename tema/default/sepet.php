<div id="wrapper">
	<div class="section-common">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h2 class="section-title">Sepet İşlemleri</h2>
					<div class="clear"></div>
					<?php 
					if(!isset($_SESSION["alisveris_karti"])){
						?>
						<div style="background-color:#FFEB3B; border-bottom-right-radius:1% 10%; border-bottom-left-radius:1% 10%; border-top-right-radius:1% 10%; border-top-left-radius:1% 10%; padding:5% 10% 10%; ">
							<span style="float:left; margin-right:3%"><img src="<?php echo TEMA_URL; ?>images/dikkat_ikon.svg" width="100%" /></span>
							<div>
								<font style="font-size:60px; color:#000;"><b>DİKKAT</b></font><br />
								<a href="index.php" style="text-decoration:none; color:#000; font-size:20px">Sepetinizde ürün bulunmamaktadır. Hemen alışverişe başlamak için tıklayınız.</a>
							</div>
						
						</div>
						<?php 
				    }else{
						$sepet=$_SESSION["alisveris_karti"]["urunler"];
						$urunler_toplamtutar=array();
					?>
					<!-- ürünlerin toplam tutarlarını ekleye bileceği bir array oluşturuyor -->
					<table class="shop_table cart shop-cart-table">
						<thead>
							<tr>
								<th class="product-name" colspan="2">Ürün Adı</th>
								<th class="product-price">Ürün Fiyat</th>
								<th class="product-quantity">Adet</th>
								<th class="product-subtotal">Toplam Tutar</th>
								<th class="product-shipping">Kargo Durumu</th>
								<th class="product-remove">Sil</th>
							</tr>
						</thead>
						<tbody>
						<!-- ürünlerin toplam tutarlarını arraya ekliyor  -->
						<?php 
							foreach($sepet as $sepeturunler){ 
							array_push($urunler_toplamtutar,$sepeturunler->toplam_tutar);
						?>
							<tr class="cart_item">
								<td class="product-thumbnail">
									<a href="#"><img src="<?php echo SİTE_URL; ?>login/upload/urunfotolari/<?php echo $sepeturunler->urun_gorsel; ?>" alt="" class="thumb"/></a>
								</td>
								<td class="product-name">
									<div class="product-name-wrap">
										<a href="#" class="title"><?php echo $sepeturunler->urun_adi; ?></a>
										<p><?php echo $sepeturunler->urun_detaybilgisi; ?></p>
									</div>
								</td>
								<td class="product-price" data-title="Price"><!-- birim fiyatı -->
								    <!--eğer sepete eklenmiş ürün indirimli ise indirimli fiyatı yazar, eğer değilse de normal fiyatı yazar  -->
									<span class="amount">₺<?php echo ($sepeturunler->indirimli_urun)? number_format($sepeturunler->urun_fiyat-($sepeturunler->urun_fiyat/100*$sepeturunler->indirim_oran), 2, '.', ',') : $sepeturunler->urun_fiyat; ?></span>
								</td>
								<td class="product-quantity" data-title="Quantity">
									<div class="quantity js__number"><input type="number" class="js__target" value="<?php echo $sepeturunler->adet; ?>" /><button type="button" class="js__plus fa-plus fa"></button><button type="button" class="js__minus fa-minus fa"></button></div>
								</td>
								<td class="product-subtotal" data-title="Subtotal"><!-- toplam fiyatı -->
								<!-- eğer ürün indirimli ise ürünün indirimli fiyatını adeti ile çarpar eğer değilse normal fiyatı ile adeti çarpar ve ürün toplam değişkenine aktarır-->
									<span class="amount">₺<?php echo $urun_toplamtutar=($sepeturunler->indirimli_urun)? number_format($sepeturunler->urun_fiyat-($sepeturunler->urun_fiyat/100*$sepeturunler->indirim_oran), 2, '.', ',')*$sepeturunler->adet:$sepeturunler->urun_fiyat*$sepeturunler->adet; ?></span>
								</td>
								<td class="product-shipping" data-title="Shipping">
									<?php echo ($urun_toplamtutar>=300)? "Ücretsiz":"Ücretli"; ?>
								</td>
								<td class="product-remove">
									<button urun_id="<?php echo $sepeturunler->urun_id; ?>" class="remove sepet_sil" style="border:none;" title="Remove this item"></button> 
								</td>
							</tr><!-- .cart_item-->
						<?php } ?>
						</tbody>
					</table><!-- .shop-cart-table -->					
				</div><!-- .col -->
				<div class="col-md-6 col-xs-12 section-common pull-right">
					<h2 class="section-title small-spacing">Sipariş Tutarı</h2>
					<div class="clear"></div>
					<div class="shop-cart-total">
						<table class="shop_table shop-cart-total-table">
							<tr class="cart-subtotal">
								<th>Toplam</th>
								<td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₺</span><?php echo $sepet_toplamtutar=$_SESSION["alisveris_karti"]["siparis_özeti"]["toplam_tutar"]; ?></span></td>
							</tr>
							<tr class="cart-shipping">
								<th>Kargo Ücreti</th>
								<!-- foreach burda sepete eklenmiş ürünleri tek tek kontrol ediyor toplam tutar 300 küçük ürün varsa ürün toplam say tutarını 1 artırıyor eğer 300 büyükse hiç bir işlem yapmaz.  eğer ürün toplam say değeri 1 veya daha büyükse sepet toplam tutarın %5 kadar kargo tutarı hesaplanıyor, eğer ürün toplam say değeri 0 kargo tutarını 0 olarak veriyor.-->               
								<td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₺</span><?php foreach($urunler_toplamtutar as $u_toplamtutar){($u_toplamtutar<300)? @$urun_toplamtutarsay++ : ""; } echo $kargo_tutar=(@$urun_toplamtutarsay)? number_format($sepet_toplamtutar*0.05, 2, '.', ','): 0; ?></span></td>
							</tr>
							<tr class="cart-grand-total">
								<th>Toplam Tutar</th>
								<td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₺</span><?php echo $sepet_toplamtutar+$kargo_tutar; ?></span></td>
							</tr>
						</table><!-- .shop-cart-total-table -->
					</div><!-- .shop-cart-total -->
					<a href="#" class="button-green button-normal">Ödeme</a>
					<?php } ?>
				</div><!-- .col -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .section-common -->
</div><!--/#wrapper -->