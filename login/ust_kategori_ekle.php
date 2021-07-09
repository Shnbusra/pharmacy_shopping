<div class="content">
<?php

if($_SESSION["uye_yetki"]<2 ){
             if($_POST){
				$kategori_ust_adi=$_POST["kategori_ust_adi"];
				$kategori_ust_ekleyen=$k_adi;
				/*kategori açılır menüdeki fotoğraf*/
				if(is_uploaded_file($_FILES["dosya1"]["tmp_name"])){
					
					$dosya1=pathinfo($_FILES["dosya1"]["name"]);
					$uzanti1=$dosya1["extension"];
				if($uzanti1=="png" || $uzanti1=="PNG" || $uzanti1=="jpg" || $uzanti1=="JPG" || $uzanti1=="jpeg" ||$uzanti1=="JPEG" )
				{
					$ust_k_foto=str_replace(" ","_",OzelKarakterTemizle($kategori_ust_adi))."_ust_".uniqid(true);
					$yenikonum1="upload/kategori/".$ust_k_foto.".".$uzanti1;
					if(move_uploaded_file($_FILES["dosya1"]["tmp_name"], $yenikonum1)){
				
						$yeniadresi=$ust_k_foto.".".$uzanti1;
					
					}else{
						message("warning","exclamation-triangle"," Başarısız", "Kategori fotoğrafı yüklenemedi!!");
					}
				}else{
					message("warning","exclamation-triangle"," Hatalı", "Lütfen kategori görseli için JPG, JPEG ve PNG şeklinde dosya yükleyiniz.");
				}
				}else{
					message("warning","exclamation-triangle"," Hatalı", "Kategori için Belirtilen dosya yüklenemedi.");
				}
				/*slider altındaki kategori fotoğraf*/
				if(is_uploaded_file($_FILES["dosya2"]["tmp_name"])){
					
					$dosya2=pathinfo($_FILES["dosya2"]["name"]);
					$uzanti2=$dosya2["extension"];
				if($uzanti2=="png" || $uzanti2=="PNG" || $uzanti2=="jpg" || $uzanti2=="JPG" || $uzanti2=="jpeg" ||$uzanti2=="JPEG" )
				{
					$ust_s_foto=str_replace(" ","_",OzelKarakterTemizle($kategori_ust_adi))."_ust_".uniqid(true);
					$yenikonum2="upload/kategori/".$ust_s_foto.".".$uzanti2;
					if(move_uploaded_file($_FILES["dosya2"]["tmp_name"], $yenikonum2)){
				
						$yeniadresi2=$ust_s_foto.".".$uzanti2;
					
					}else{
						message("warning","exclamation-triangle"," Başarısız", "Slider altındaki fotoğraf yüklenemedi!!");
					}
				}else{
					message("warning","exclamation-triangle"," Hatalı", "Lütfen Slider altındaki görsel için JPG, JPEG ve PNG şeklinde dosya yükleyiniz.");
				}
				}else{
					message("warning","exclamation-triangle"," Hatalı", "Slider altındaki Belirtilen dosya yüklenemedi.");
				}
				/*urun sayfasındaki kategori fotoğrafı*/
				if(is_uploaded_file($_FILES["dosya3"]["tmp_name"])){
					
					$dosya3=pathinfo($_FILES["dosya3"]["name"]);
					$uzanti3=$dosya3["extension"];
				if($uzanti3=="png" || $uzanti3=="PNG" || $uzanti3=="jpg" || $uzanti3=="JPG" || $uzanti3=="jpeg" ||$uzanti3=="JPEG" )
				{
					$u_k_foto=str_replace(" ","_",OzelKarakterTemizle($kategori_ust_adi))."_urun_".uniqid(true);
					$yenikonum3="upload/kategori/".$u_k_foto.".".$uzanti3;
					if(move_uploaded_file($_FILES["dosya3"]["tmp_name"], $yenikonum3)){
				
						$yeniadresi3=$u_k_foto.".".$uzanti3;
					
					}else{
						message("warning","exclamation-triangle"," Başarısız", "Ürün sayfası fotoğrafı yüklenemedi!!");
					}
				}else{
					message("warning","exclamation-triangle"," Hatalı", "Lütfen Ürün sayfası için görsel için JPG, JPEG ve PNG şeklinde dosya yükleyiniz.");
				}
				}else{
					message("warning","exclamation-triangle"," Hatalı", "Ürün sayfası için Belirtilen dosya yüklenemedi.");
				}
				
				$ust_kategori_sql="INSERT INTO ust_kategori SET
				kategori_ust_adi='$kategori_ust_adi',
				kategori_ust_acilir_foto='$yeniadresi',
				kategori_ust_foto='$yeniadresi2',
				reklam_urun='$yeniadresi3',
				kategori_ust_ekleyen='$kategori_ust_ekleyen'";
				
			$ust_kategori_ekle=mysqli_query($baglan, $ust_kategori_sql);
			
				if($ust_kategori_ekle){
					//Sistem Kayıt Kodu
			
					$aciklama=$girissatir["kullanici_adi"]." adlı kullanıcının kaydı güncellendi. ";
					$sistemkayitsql="INSERT INTO sistemkayitlari SET aciklama='$aciklama',
					yapilanislem='Kayıt Güncellendi', uye_id='$uye_id'";
					$sistemkayit=mysqli_query($baglan, $sistemkayitsql);
					message("success","check"," Başarılı", "Başarılı bir şekilde eklenmiştir.");
					header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=ust_kategori_islemleri", true, 303);
				
				}else{
					message("warning","exclamation-triangle"," Başarısız", "Üst kategori ekleme başarısızdır, lütfen daha sonra tekrar deneyiniz.");
				}
			 }
             	
?>
<div class="row">
<div class="col-md-12">
<div class="card card-primary mt-4">
              <div class="card-header">
                <h3 class="card-title">Üst Kategori Ekle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
				  
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Üst Kategori Adı</label>
                    <input type="text" class="form-control" name="kategori_ust_adi" maxlength="40" value="<?php if($_POST) { echo $kategori_ust_adi; } ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Üst Kategori Açılır Menü Fotoğrafı</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="dosya1" id="exampleInputFile" multiple>
                        <label class="custom-file-label" for="exampleInputFile">Dosya Seçin</label>
                      </div>
                    </div>
					<small class="text-muted">Üst kategori için fotoğraf boyutlarına dikkat ediniz.(Genişlik:453&nbsp;-&nbsp;Yükseklik:370)</small>
                  </div>
				   <div class="form-group">
                    <label for="exampleInputFile">Slider Altındaki Kategori Fotoğrafı</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="dosya2" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Dosya Seçin</label>
                      </div>
                    </div>
					<small class="text-muted">Slider Altındaki Kategori Fotoğraflarındaki boyutlara dikkat ediniz.(Genişlik:115&nbsp;-&nbsp;Yükseklik:162)</small>
                  </div>
				  <div class="form-group">
                    <label for="exampleInputFile">Ürün Sayfası İçin Kategori Fotoğrafı</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="dosya3" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Dosya Seçin</label>
                      </div>
                    </div>
					<small class="text-muted">Ürün Sayfası İçin Kategori Fotoğraflarındaki boyutlara dikkat ediniz.(Genişlik:870&nbsp;-&nbsp;Yükseklik:370)</small>
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