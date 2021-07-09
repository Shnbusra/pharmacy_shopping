<?php 
							foreach($sepet as $urunler){ 
							array_push($urunler_toplamtutar,$urunler->toplam_tutar);
						?>
							<tr class="cart_item">
								<td class="product-thumbnail">
									<a href="#"><img src="<?php echo SİTE_URL; ?>login/upload/urunfotolari/elbise_photo_160648ee7b2e2d.jpg<?php echo $urunler->urun_gorsel; ?>" alt="" class="thumb"/></a>
								</td>
								<td class="product-name">
									<div class="product-name-wrap">
										<a href="#" class="title">Siyah V Yaka Elbise<?php echo $urunler->urun_adi; ?></a>
										<p>Model Kodu : 066372-900 KAPŞİONLU SWEATSHİRT siyah <b> Ürün Kodu : 5002603519_001<?php echo $urunler->urun_detaybilgisi; ?></p>
									</div>
								</td>
								<td class="product-quantity" data-title="Quantity">
									<div class="quantity js__number"><input type="number" class="js__target" value="<?php echo $urunler->adet=3; ?>" /><button type="button" class="js__plus fa-plus fa"></button><button type="button" class="js__minus fa-minus fa"></button></div>
								</td>
								<td class="product-price" data-title="Price">
									<span class="amount">95<?php echo $urunler->urun_fiyat; ?></span>
								</td>
								<td class="product-subtotal" data-title="Subtotal">
									<span class="amount">285<?php echo $urun_toplamtutar=($urunler->toplam_tutar = $urunler->adet * $urunler->urun_fiyat; ?></span>
								</td>
							</tr><!-- .cart_item-->
						<?php } ?> 