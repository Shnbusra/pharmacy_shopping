<div class="content">
<?php
if($_SESSION["uye_yetki"]<2 ){
	
             if($_POST){
                
				$kategori_alt_id=$_POST["kategori_alt_id"];
				$urun_adi=$_POST["urun_adi"];
				$urun_stokbilgisi=$_POST["urun_stokbilgisi"];
				$urun_fiyat=$_POST["urun_fiyat"];
				$urun_detaybilgisi=htmlspecialchars(strip_tags($_POST["urun_detaybilgisi"]), ENT_QUOTES);
				@$indirimli_urun=$_POST["indirimli_urun"];
				$indirim_bitis=$_POST["indirim_bitis"];
				$indirim_oran=$_POST["indirim_oran"];
				
				
				/*urun küçük foto ekleme kodu*/
				if(is_uploaded_file($_FILES["urun_gorsel"]["tmp_name"])){
					
					$urun_gorsel=pathinfo($_FILES["urun_gorsel"]["name"]);
					$uzanti=$urun_gorsel["extension"];
				if($uzanti=="png" || $uzanti=="PNG" || $uzanti=="jpg" || $uzanti=="JPG" || $uzanti=="jpeg" ||$uzanti=="JPEG" )
				{
					$urunadi="urun"."_".uniqid(true);
					$yenikonum="upload/urunfotolari/".$urunadi.".".$uzanti;
					if(move_uploaded_file($_FILES["urun_gorsel"]["tmp_name"], $yenikonum)){
				
						$yeniadresi=$urunadi.".".$uzanti;
					
					}else{
						message("danger","ban"," Başarısız", "Ürün fotoğrafı yüklenemedi!!");
					}
				}else{
					message("warning","exclamation-triangle"," Hatalı", "Lütfen JPG, JPEG ve PNG şeklinde dosya yükleyiniz.");
				}
				}else{
					message("warning","exclamation-triangle"," Hatalı", "Belirtilen dosya yüklenemedi.");
				}
				/*urun büyük foto ekleme kodu*/
				if(is_uploaded_file($_FILES["urundetay_gorsel"]["tmp_name"])){
					
					$urundetay_gorsel=pathinfo($_FILES["urundetay_gorsel"]["name"]);
					$uzanti1=$urundetay_gorsel["extension"];
				if($uzanti1=="png" || $uzanti1=="PNG" || $uzanti1=="jpg" || $uzanti1=="JPG" || $uzanti1=="jpeg" ||$uzanti1=="JPEG" )
				{
					$urunadi1="urun_detay_".uniqid(true);
					$yenikonum1="upload/urunfotolari/".$urunadi1.".".$uzanti1;
					if(move_uploaded_file($_FILES["urundetay_gorsel"]["tmp_name"], $yenikonum1)){
				
						$yeniadresi1=$urunadi1.".".$uzanti1;
					
					}else{
						message("danger","ban"," Başarısız", "Ürün fotoğrafı yüklenemedi!!");
					}
				}else{
					message("warning","exclamation-triangle"," Hatalı", "Lütfen JPG, JPEG ve PNG şeklinde dosya yükleyiniz.");
				}
				}else{
					message("warning","exclamation-triangle"," Hatalı", "Belirtilen dosya yüklenemedi.");
				}
				
				
				$urunsql="INSERT INTO urunler SET
				kategori_alt_id='$kategori_alt_id',
				urun_adi='$urun_adi',
				urun_stokbilgisi='$urun_stokbilgisi',
				urun_fiyat='$urun_fiyat',
				urun_detaybilgisi='$urun_detaybilgisi',
				urun_gorsel='$yeniadresi',
				urundetay_gorsel='$yeniadresi1',
				indirimli_urun='$indirimli_urun',
				indirim_bitis='$indirim_bitis',
				indirim_oran='$indirim_oran'
				";
				
			$urunekle=mysqli_query($baglan, $urunsql);
			echo mysqli_error($baglan);
			
				if($urunekle){
					message("success","check"," Başarılı", "Başarılı bir şekilde eklenmiştir.");
					header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=urun_listele", true, 303);
					
				}else{
					message("danger","exclamation-triangle"," Başarısız", "Ürün eklme başarısızdır, lütfen daha sonra tekrar deneyiniz.");
				}
			 }
				
?>
<div class="row">
<div class="col-md-12">
<div class="card card-primary mt-4">
              <div class="card-header">
                <h3 class="card-title">Ürün Ekle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
				  
				  <div class="form-group">
                   <label>Alt Kategori Bilgisi</label>
                   <select class="custom-select" name="kategori_alt_id">
				   <?php
				    $query_ust=mysqli_query($baglan, "select kategori_ust_id,kategori_ust_adi from ust_kategori");
				   while($sorgu_satir_ust = mysqli_fetch_array($query_ust)){
					   $kategori_ust_id=$sorgu_satir_ust["kategori_ust_id"];
					   $kategori_ust_adi=$sorgu_satir_ust["kategori_ust_adi"];
					   echo'<optgroup label="'.$kategori_ust_adi.'"></optgorup>';
				   $query=mysqli_query($baglan, "select kategori_alt_id,kategori_alt_adi from alt_kategori WHERE kategori_ust_id=$kategori_ust_id");
				   while($sorgu_satir = mysqli_fetch_array($query)){
				   ?>
                    <option value="<?php echo $sorgu_satir["kategori_alt_id"]; ?>" <?php if($_POST)
					{if($sorgu_satir["kategori_alt_id"]==$kategori_alt_id){echo"selected";}} ?> > <?php echo $sorgu_satir["kategori_alt_adi"]; ?></option>
				   <?php } }?>
                   </select>
				  </div>
				  
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Ürün Adı</label>
                    <input type="text" class="form-control" name="urun_adi" maxlength="100" value="<?php if($_POST) { echo $urun_adi; } ?>" required>
                  </div>
				  
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Ürün Fiyatı</label>
                    <input type="text" class="form-control" name="urun_fiyat" maxlength="40" value="<?php if($_POST) { echo $urun_fiyat; } ?>" required>
                  </div>
				  <div class="form-group">
				  <label>İndirimli Ürün</label><br />
					<input type="checkbox" id="indirimli_urun" name="indirimli_urun" value="1" onChange="indirim();" <?php if($_POST){ if($indirimli_urun){ echo "checked"; } } ?>>&nbsp;&nbsp;İndirim Tanımla
				  </div>
				  <div class="form-group" id="indirim_bitis"  style="<?php if($_POST){ if($indirimli_urun){ echo 'display: block;'; }else{ echo 'display: none;'; } }else{ echo 'display: none;'; } ?>">
                    <label>İndirim Bitiş Tarihi</label>
                    <input type="datetime-local" min="<?php echo date('Y-m-d')."T".date('H:i'); ?>" class="form-control" name="indirim_bitis" value="<?php if($_POST) { echo $indirim_bitis; } ?>">
                  </div>
				  <div class="form-group" id="indirim_oran"  style="<?php if($_POST){ if($indirimli_urun){ echo 'display: block;'; }else{ echo 'display: none;'; } }else{ echo 'display: none;'; } ?>">
                    <label>İndirim oranı</label>
					<div class="input-group">
						<div class="input-group-prepend"><span class="input-group-text"><b>%</b></span></div>
						<input type="text" class="form-control" name="indirim_oran" value="<?php if($_POST) { echo $indirim_oran; } ?>">
					</div>
                  </div>
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Ürün Detay Bilgisi</label>
                    <input type="text" class="form-control" name="urun_detaybilgisi" maxlength="500" value="<?php if($_POST) { echo $urun_detaybilgisi; } ?>" required>
                  </div>
				  
				  <div class="form-group">
                   <label for="exampleSelectRounded0">Ürün Stok Bilgisi</label>
                   <select class="custom-select rounded-0" id="exampleSelectRounded0" name="urun_stokbilgisi">
                    <option value="1" <?php if($_POST){ if($urun_stokbilgisi == 1){echo "selected"; }} ?> >Var </option>
                    <option value="0" <?php if($_POST){ if($urun_stokbilgisi == 0){echo "selected"; }} ?> >Tükendi </option>
                   </select>
				  </div>
				
                  <div class="form-group">
                    <label for="exampleInputFile">Ürün Görseli</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="urun_gorsel" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Dosya Seçin</label>
                      </div>
                    </div>
					<small>Seçilecek görselin belirtilen boyutlarda olmasına dikkat ediniz. (Genişlik:270 x Yükseklik:350)</small>
                  </div>
				  <div class="form-group">
                    <label for="exampleInputFile">Ürün Detay Görseli</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="urundetay_gorsel" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Dosya Seçin</label>
                      </div>
                    </div>
					<small>Seçilecek görselin belirtilen boyutlarda olmasına dikkat ediniz. (Genişlik:435 x Yükseklik:590)</small>
                  </div> 
				  <div class="form-group">
                    <label class="col-form-label">Şifrenizi Giriniz</label>
                    <input type="password" class="form-control" name="sifre" placeholder="Şifrenizi Giriniz." required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer" align="right">
                  <button type="submit" class="btn btn-primary">Ekle</button>
                </div>
              </form>
    </div>
  </div>
</div>

<?php
} else {
		message("danger","ban"," Başarısız", "Bu Sayfa İşlem Yapmak İçin Yetkiniz Yok. Lütfen bekleyiniz Yönetici sayfasını yönlendirliyorsunuz");
		header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=anasayfa", true, 303);
    }
?>
</div>