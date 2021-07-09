<?php 
$uk=@$_GET["uk"]; 
$ak=@$_GET["ak"]; 
$islem=@$_GET["islem"];
$iuk=@$_GET["iuk"];
$iak=@$_GET["iak"];
$uid=@$_GET["uid"];
// get ile linkdeki değerler alınıyor.
if(!empty($uk)){
	// eğer gelen üst kategori değeri boş değilse üst kategoriye göre ürünleri getirir 
	$urunler=mysqli_query($baglan,"select * from urunler INNER JOIN alt_kategori ON urunler.kategori_alt_id=alt_kategori.kategori_alt_id INNER JOIN ust_kategori ON alt_kategori.kategori_ust_id=ust_kategori.kategori_ust_id WHERE ust_kategori.kategori_ust_id=$uk");
}else if(!empty($ak)){
	// eğer gelen alt kategori değeri boş değilse alt kategoriye göre ürünleri getirir 
	$urunler=mysqli_query($baglan,"select * from urunler INNER JOIN alt_kategori ON urunler.kategori_alt_id=alt_kategori.kategori_alt_id INNER JOIN ust_kategori ON alt_kategori.kategori_ust_id=ust_kategori.kategori_ust_id WHERE alt_kategori.kategori_alt_id=$ak");
}else if(!empty($islem)){
	if(!empty($iuk)){
		//eğer indirimli kategori ise ve üst kategori id boş değilse indirimli olan ürünleri üst kategoriye göre getirir 
		$urunler=mysqli_query($baglan,"select * from urunler INNER JOIN alt_kategori ON urunler.kategori_alt_id=alt_kategori.kategori_alt_id INNER JOIN ust_kategori ON alt_kategori.kategori_ust_id=ust_kategori.kategori_ust_id WHERE urunler.indirimli_urun=1 AND ust_kategori.kategori_ust_id=$iuk");// tırnaknaksız olma sebebi int olarak gelmesi
	}else if(!empty($iak)){
		//eğer indirimli kategori ise ve alt kategori id boş değilse indirimli olan ürünleri alt kategoriye göre getirir.
		$urunler=mysqli_query($baglan,"select * from urunler INNER JOIN alt_kategori ON urunler.kategori_alt_id=alt_kategori.kategori_alt_id INNER JOIN ust_kategori ON alt_kategori.kategori_ust_id=ust_kategori.kategori_ust_id WHERE urunler.indirimli_urun=1 AND alt_kategori.kategori_alt_id=$iak");
	}else{
		// eğer indirimli kategori ise ama üst kategori ve alt kategori id boş ise bütün indirimli ürünleri getirir
		$urunler=mysqli_query($baglan,"select * from urunler INNER JOIN alt_kategori ON urunler.kategori_alt_id=alt_kategori.kategori_alt_id INNER JOIN ust_kategori ON alt_kategori.kategori_ust_id=ust_kategori.kategori_ust_id WHERE urunler.indirimli_urun=1");
	}
}
?>
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-xs-12 section-common">
			<?php if($uid){
				$foto=mysqli_fetch_object(mysqli_query($baglan,"select reklam_urun from ust_kategori where kategori_ust_id=$uid"));
			?>
				<a class="light-effect adv-main-content"><img src="<?php echo SİTE_URL; ?>login/upload/kategori/<?php echo $foto->reklam_urun; ?>" alt=""></a>
			<?php } ?>
				<div class="products row row-inline-block text-center">
				<?php 
				while($urungetir=mysqli_fetch_object($urunler)){
				?>
					<div class="col-md-4 col-sm-6 col-ip-6 col-xs-12">
						<div class="product-grid">
							<div class="thumb">
								<a href="index.php?do=urundetay&urun_id=<?php echo $urungetir->urun_id; ?>"><img src="<?php echo SİTE_URL; ?>login/upload/urunfotolari/<?php echo $urungetir->urun_gorsel; ?>" alt="">
									<ul class="attribute-list">
									<!-- ürünün ekleme tarihi tarihfarkı fonksiyonu ile ne kadar önce eklendi süreyi hesaplar eğer bu süre 7 gün ve altında ise resmin sol üst köşesine yeni etiketini koyar. -->
										<?php if(tarihfarki(date_format(date_create($urungetir->urun_tarih),"d-m-Y")) <= 7){ ?>
												<li><span class="label-blue">Yeni</span></li>
										<?php }
									    // eğer ürün indirimli ise ürünün indirim oranını yazar
										 if($urungetir->indirimli_urun){ ?>
												<li><span class="label-red">-<?php echo $urungetir->indirim_oran; ?>%</span></li>
										<?php } ?>
									</ul>
								</a>
								<?php if($urungetir->indirimli_urun){ ?>
								<!-- date-date-now değeri şuanın tarih ve saatini alır orda +1 olmasının sebbei 1 saat öncesini aldığı için üstüne 1 saat eklenir, data-data-then ürünün indirim bitiş saatini ve tarihini belirler eğer şuanki zaman indirim bitiş tarihini ve saatini geçti ise indirim süresi bölümünde 0 yazar. -->
								<div id="countbox_1" class="js__count_down_box timer-view" data-date-now="<?php echo date('m/d/y H:i',strtotime('+1 hour')); ?>" data-date-then="<?php echo date_format(date_create($urungetir->indirim_bitis),"m/d/y H:i"); ?>"></div>
								<?php } ?>
								<button urun_id="<?php echo $urungetir->urun_id; ?>" class="add_to_cart_button sepete_ekle"></button>
							</div>
							<div>
							<a href="index.php?do=urundetay&urun_id=<?php echo $urungetir->urun_id; ?>"><h2 class="title"><?php echo $urungetir->urun_adi; ?></h2></a>
							<a href="index.php?do=urun&uk=<?php echo $urungetir->kategori_ust_id; ?>&uid=<?php echo $urungetir->kategori_ust_id; ?>"><span class="category"><?php echo $urungetir->kategori_ust_adi; ?></span></a><br />
							<a href="index.php?do=urun&ak=<?php echo $urungetir->kategori_alt_id; ?>&uid=<?php echo $urungetir->kategori_ust_id; ?>"><span class="category"><?php echo $urungetir->kategori_alt_adi; ?></span></a>
							<a href="index.php?do=urundetay&urun_id=<?php echo $urungetir->urun_id; ?>"><span class="price">
							<?php
							//eğer ürün indirimli ise indirimli ürünü hesaplatıp eski fiyatı üstü çizili şekilde. yeni fiyatın yeni eklenmiş şeklinde gösteriliyor.
								if($urungetir->indirimli_urun){
									$indirimli_fiyat=$urungetir->urun_fiyat-($urungetir->urun_fiyat/100*$urungetir->indirim_oran);
								?>
									<del><span class="amount">₺<?php echo $urungetir->urun_fiyat; ?></span></del>
									<ins><span class="amount">₺<?php echo number_format($indirimli_fiyat, 2, '.', ','); ?></span></ins>
								<?php }else{ ?>
									<span class="amount">₺<?php echo $urungetir->urun_fiyat; ?></span>
								<?php } ?>
							</span>
							</a>
							</div>
						</div>
					</div><!-- product -->
				<?php } ?>
				</div><!-- products -->
			</div><!-- col -->
			<div class="col-md-3 col-xs-12 section-common sidebar">
				<aside class="widget widget_categories">
				<?php 
				if(!empty($uid)){
					//eğer uid (üst kategori id) boş değilse gelen üst kategori id göre üst kategori ve lat kategori bilgilerini getiriyor ve üst kategorisine göre grup (group by) yapılarak o kategorideki ürün sayısı getiriliyor 
					$urunler=mysqli_query($baglan,"select COUNT(urun_id) as urun_sayisi,ust_kategori.*,alt_kategori.* from urunler INNER JOIN alt_kategori ON urunler.kategori_alt_id=alt_kategori.kategori_alt_id INNER JOIN ust_kategori ON alt_kategori.kategori_ust_id=ust_kategori.kategori_ust_id Where ust_kategori.kategori_ust_id=$uid  GROUP BY ust_kategori.kategori_ust_id");
				}else if(!empty($islem)){
					//işlem değeri boş değilse indirimli ürünlerin alt kategori ve üst kategori bilgilerini getiriyor o kategorilerdeki ürün sayısını getiriyor.
						$urunler=mysqli_query($baglan,"select COUNT(urun_id) as urun_sayisi,ust_kategori.*,alt_kategori.* from urunler INNER JOIN alt_kategori ON urunler.kategori_alt_id=alt_kategori.kategori_alt_id INNER JOIN ust_kategori ON alt_kategori.kategori_ust_id=ust_kategori.kategori_ust_id WHERE urunler.indirimli_urun=1");
				}
				$kategorigetir=mysqli_fetch_object($urunler);
					if(empty($islem)){?>
				    <!--eğer işlem değeri boşsa bu bölüm çalışır -->
					<h2 class="widget-title section-title"><a href="index.php?do=urun&uk=<?php echo $kategorigetir->kategori_ust_id; ?>&uid=<?php echo $kategorigetir->kategori_ust_id; ?>"><?php echo $kategorigetir->kategori_ust_adi; ?></a></h2>
					<div class="clear"></div>
					<ul>
						<li><a href="index.php?do=urun&uid=<?php echo $kategorigetir->kategori_ust_id; ?>&uk=<?php echo $kategorigetir->kategori_ust_id; ?>">Tüm Ürünler</a> (<?php echo $kategorigetir->urun_sayisi; ?>)</li>
						<?php
							$kategori_ust_id=$kategorigetir->kategori_ust_id;
							//kategori üst id göre getirilen ve alt kategori adına göre gruplandırılarak alt kategori bilgileri ve alt kategori ürün sayısı getiriliyor 
							$alt_kategori=mysqli_query($baglan, "select alt_kategori.kategori_alt_adi,alt_kategori.kategori_alt_id,COUNT(alt_kategori.kategori_alt_id) as alt_urun_sayisi from urunler inner join alt_kategori on urunler.kategori_alt_id=alt_kategori.kategori_alt_id  where kategori_ust_id=$kategori_ust_id GROUP BY alt_kategori.kategori_alt_adi");
							while($alt_kategori_getir=mysqli_fetch_object($alt_kategori)){
							echo '<li><a href="index.php?do=urun&ak='.$alt_kategori_getir->kategori_alt_id.'&uid='.$kategori_ust_id.'">'.$alt_kategori_getir->kategori_alt_adi.'</a> ('.$alt_kategori_getir->alt_urun_sayisi.')</li>';
							} ?>
					</ul>
					<?php }else{ ?>
					<h2 class="widget-title section-title" style="font-size:25px !important;"><a href="index.php?do=urun&islem=indirim">İndirim</a></h2><br><br><br>
					<ul>
						<li><a href="index.php?do=urun&islem=indirim">Tüm Ürünler</a> (<?php echo $kategorigetir->urun_sayisi; ?>)</li>
					</ul>
					<?php 
					//eğer işlem değeri boş değilse bu bölüm çalışır ve indirimli olan ürünleri üst kategori id göre gruplandırarak üst kategori bilgilerini ve o kategorideki ürün sayısını getirir 
						$indirimli_ust_kategori=mysqli_query($baglan, "select ust_kategori.kategori_ust_id,ust_kategori.kategori_ust_adi,COUNT(alt_kategori.kategori_ust_id) as ust_urun_sayisi from urunler inner join alt_kategori on urunler.kategori_alt_id=alt_kategori.kategori_alt_id inner join ust_kategori ON alt_kategori.kategori_ust_id=ust_kategori.kategori_ust_id where indirimli_urun=1 GROUP BY ust_kategori.kategori_ust_adi");
						while($indirimli_ust_kategori_getir=mysqli_fetch_object($indirimli_ust_kategori)){
							$kategori_ust_id=$indirimli_ust_kategori_getir->kategori_ust_id;
					?>
					<h2 class="widget-title section-title"><a href="index.php?do=urun&islem=indirim&iuk=<?php echo $kategori_ust_id; ?>"><?php echo $indirimli_ust_kategori_getir->kategori_ust_adi; ?></a></h2>
					<div class="clear"></div>
					<ul>
						<li><a href="index.php?do=urun&islem=indirim&iuk=<?php echo $kategori_ust_id; ?>">Tüm Ürünler</a> (<?php echo $indirimli_ust_kategori_getir->ust_urun_sayisi; ?>)</li>
						<?php
						//üst kategori id göre ve indirimli olan ürünlere göre alt kategori adları gruplandırarak alt kategori bilgileri ve alt kategorideki ürün sayısı getiriliyor 
							$indirimli_alt_kategori=mysqli_query($baglan, "select alt_kategori.kategori_alt_adi,alt_kategori.kategori_alt_id,COUNT(alt_kategori.kategori_alt_id) as alt_urun_sayisi from urunler inner join alt_kategori on urunler.kategori_alt_id=alt_kategori.kategori_alt_id  where kategori_ust_id=$kategori_ust_id and indirimli_urun=1 GROUP BY alt_kategori.kategori_alt_adi");
							while($indirimli_alt_kategori_getir=mysqli_fetch_object($indirimli_alt_kategori)){
							echo '<li><a href="index.php?do=urun&islem=indirim&iak='.$indirimli_alt_kategori_getir->kategori_alt_id.'">'.$indirimli_alt_kategori_getir->kategori_alt_adi.'</a> ('.$indirimli_alt_kategori_getir->alt_urun_sayisi.')</li>';
							} ?>
					</ul>
						<?php } } ?>
				</aside><!-- .widget_categories -->
			</div><!-- col -->
		</div><!-- .row -->
	</div><!-- .container -->