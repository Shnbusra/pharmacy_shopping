<div class="content">
<?php
if($_SESSION["uye_yetki"]<2 ){
	
             if($_POST){
				$hakkimda2_baslik=$_POST["hakkimda2_baslik"];
				$hakkimda2_aciklama=$_POST["hakkimda2_aciklama"];
				/*neden biz fotoğrafı*/
				if(is_uploaded_file($_FILES["dosya1"]["tmp_name"])){
					
					$dosya1=pathinfo($_FILES["dosya1"]["name"]);
					$uzanti1=$dosya1["extension"];
				if($uzanti1=="png" || $uzanti1=="PNG" || $uzanti1=="jpg" || $uzanti1=="JPG" || $uzanti1=="jpeg" ||$uzanti1=="JPEG" )
				{
					$hakkimda_icon=str_replace(" ","_",OzelKarakterTemizle($hakkimda2_baslik))."_foto_".uniqid(true);
					$yenikonum1="upload/hakkimda/".$hakkimda_icon.".".$uzanti1;
					if(move_uploaded_file($_FILES["dosya1"]["tmp_name"], $yenikonum1)){
				
						$yeniadresi=$hakkimda_icon.".".$uzanti1;
					
					}else{
						message("warning","exclamation-triangle"," Başarısız", "Hakkımda fotoğrafı yüklenemedi!!");
					}
				}else{
					message("warning","exclamation-triangle"," Hatalı", "Lütfen Hakkımda görseli için JPG, JPEG ve PNG şeklinde dosya yükleyiniz.");
				}
				}else{
					message("warning","exclamation-triangle"," Hatalı", "Hakkımda için Belirtilen dosya yüklenemedi.");
				}
				$hakkimda_sql="INSERT INTO hakkimda2 SET
				hakkimda2_baslik='$hakkimda2_baslik',
				hakkimda2_aciklama='$hakkimda2_aciklama',
				hakkimda2_gorsel='$yeniadresi',
				hakkimda2_ekleyen='$k_adi'";
				
			$hakkimda_ekle=mysqli_query($baglan, $hakkimda_sql);
			
				if($hakkimda_ekle){
					//Sistem Kayıt Kodu
			
					$aciklama="Hakkımda bölümü güncellendi.";
					$sistemkayitsql="INSERT INTO sistemkayitlari SET aciklama='$aciklama',
					yapilanislem='Hakkımda bölümü Güncellendi', uye_id='$uye_id'";
					$sistemkayit=mysqli_query($baglan, $sistemkayitsql);
					message("success","check"," Başarılı", "Başarılı bir şekilde eklenmiştir.");
					header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=hakkimda2_islemleri", true, 303);
				
				}else{
					message("warning","exclamation-triangle"," Başarısız", "Hakkımdızda ekleme başarısızdır, lütfen daha sonra tekrar deneyiniz.");
				}
			 }
             	
?>
<div class="row">
<div class="col-md-12">
<div class="card card-primary mt-4">
              <div class="card-header">
                <h3 class="card-title">Neden Biz?</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
				  
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Neden Biz Başlık</label>
                    <input type="text" class="form-control" name="hakkimda2_baslik" maxlength="50" value="<?php if($_POST) { echo $hakkimda2_baslik; } ?>" required>
                  </div>
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Neden Biz Açıklama</label>
                    <input type="text" class="form-control" name="hakkimda2_aciklama" maxlength="500" value="<?php if($_POST) { echo $hakkimda2_aciklama; } ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Neden Biz İcon</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="dosya1" id="exampleInputFile" multiple>
                        <label class="custom-file-label" for="exampleInputFile">Dosya Seçin</label>
                      </div>
                    </div>
					<small class="text-muted">Neden Biz için fotoğraf boyutlarına dikkat ediniz.(Genişlik:21&nbsp;-&nbsp;Yükseklik:24)</small>
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