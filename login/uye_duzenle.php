<div class="content">
<?php
	$gelenial=$_GET["id"];
	$kullanici_adi=$_GET["k_adi"];
	if($_SESSION["uye_yetki"]<2 ){
	
		$duzenlesorgusql="Select * from uyeler where uye_id='$gelenial'";
		$duzenlesorgu=mysqli_query($baglan,$duzenlesorgusql);
		$duzenlesatir= mysqli_fetch_array($duzenlesorgu); 
		$adi_soyadi=explode(" ",$duzenlesatir["adi_soyadi"]); 
		$vt_soyadi=array_reverse($adi_soyadi)[0]; 
		array_pop($adi_soyadi); 
		$vt_adi=implode(" ",$adi_soyadi); 
	if($_SESSION["uye_yetki"]>=$duzenlesatir["uye_yetki"] and $_SESSION["uye_id"]!=$duzenlesatir["uye_id"]){
			message("warning","exclamation-triangle"," Başarısız", "Bu kullanıcıyı düzenleyemesiniz. Lütfen bekleyiniz yönlendiriliyorsunuz.");
			header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=uye_islemleri", true, 303); 
	}else {
		if ($_POST){
			$adi=trim(mb_convert_case($_POST["adi"], MB_CASE_TITLE, "utf-8"));
			$soyadi=case_converter($_POST["soyadi"]);
			$adi_soyadi=$adi." ".$soyadi;
			$cinsiyet=$_POST["cinsiyet"];
			$dogum_tarihi=$_POST["dogum_tarihi"];
			$kullanici_adif=$_POST["kullanici_adi"];
			$sifref=$_POST["sifre"];
			$uye_epostaf = $_POST["uye_eposta"]; 
			$uye_durumf=$_POST["uye_durum"];
			$uye_yetkif=$_POST["uye_yetki"];
			
			if($sifref==""){
				
				$sifref=$duzenlesatir["kullanici_sifre"];//boşsa veri tabanındaki şifreyi aktar
			}else {
				$sifref=md5($sifref);//girilen şifreyi md5 çevirerek aktar
			}
		    if(is_uploaded_file($_FILES["profilfoto"]["tmp_name"])){
			    $profilfoto=pathinfo($_FILES["profilfoto"]["name"]);
				$gelenuzanti=$profilfoto["extension"];
				if ($gelenuzanti=="png" || $gelenuzanti=="PNG" || $gelenuzanti=="jpg" || $gelenuzanti=="JPG" || $gelenuzanti=="jpeg" || $gelenuzanti=="JPEG" ){
				    $profildosyaadi=$kullanici_adi."_".uniqid(true);
					$yenikonum="upload/profilfotolari/".$profildosyaadi.".".$gelenuzanti;
					if (move_uploaded_file($_FILES["profilfoto"]["tmp_name"], $yenikonum)){
				
				    $yeniadresi=$profildosyaadi.".".$gelenuzanti;
					
					}else{
					message("warning","exclamation-triangle"," Başarısız", "Profil fotoğrafı yüklenemedi!!");
					}
				
				}else{
				message("warning","exclamation-triangle"," Hatalı", "Lütfen belirtilen uzantılara (jpg,jpeg,png) uygun profil fotoğrafı yükleyiniz.");
				}
			}else{
				$yeniadresi=$duzenlesatir["uye_profilfoto"];
			}
			$guncellesql="UPDATE uyeler SET adi_soyadi='$adi_soyadi', cinsiyet='$cinsiyet', dogum_tarihi='$dogum_tarihi', kullanici_adi='$kullanici_adif', 
			kullanici_sifre='$sifref',uye_eposta='$uye_epostaf', uye_durum='$uye_durumf', 
			uye_yetki='$uye_yetkif', uye_profilfoto='$yeniadresi' where uye_id='$gelenial'";
			$guncellesorgu=mysqli_query($baglan, $guncellesql);
			
			if ($guncellesorgu){
				
				//Sistem Kayıt Kodu
			
				$aciklama=$kullanici_adi." adlı kullanıcının kaydı güncellendi. ";
				$k_adi=$_SESSION["k_adi"];
				$sistemkayitsql="INSERT INTO sistemkayitlari SET aciklama='$aciklama',
				yapilanislem='Kayıt Güncellendi', uye_id='$uye_id'";
				$sistemkayit=mysqli_query($baglan, $sistemkayitsql);
				
				message("success","check"," Başarılı", "Kayıt başarılı bir şekilde güncellenmiştir. Lütfen bekleyiniz yönlendiriliyorsunuz");
				header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=uye_islemleri", true, 303);
				
			} else {
				 message("warning","exclamation-triangle"," Başarısız", "Güncelleme yapılamadı tekrar deneyiniz.");
				 header("Refresh:3; url = http://localhost/proje/login/uye_duzenle", true, 303);
			}
		
		}
				
?>
<div class="row" >
<div class="col-md-12">
<div class="card card-primary mt-4">
              <div class="card-header">
                <h3 class="card-title">Üye Güncelleme</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Adı</label>
                    <input type="text" class="form-control" name="adi" value="<?php echo $vt_adi; ?>" required>
                  </div>
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Soyadı</label>
                    <input type="text" class="form-control" name="soyadi" value="<?php echo $vt_soyadi; ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Kullanıcı Adı</label>
                    <input type="text" class="form-control" name="kullanici_adi" value="<?php echo $duzenlesatir["kullanici_adi"]; ?>" 
					placeholder="Site Başlığını Giriniz"required>
                  </div>
				   <div class="form-group">
                   <label for="exampleSelectRounded0">Cinsiyet</label>
				   <div class="input-group">
                   <select class="custom-select rounded-0" id="exampleSelectRounded0" name="cinsiyet"required>
                    <option value="0" <?php if($duzenlesatir["cinsiyet"]==0){echo"selected";}?> > Kadın </option>
                    <option value="1" <?php if($duzenlesatir["cinsiyet"]==1){echo"selected";}?> > Erkek </option>
                   </select>
				  </div>
				  </div>
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Doğum Tarihi</label>
                    <input type="date" class="form-control" name="dogum_tarihi" value="<?php echo $duzenlesatir["dogum_tarihi"]; ?>" required>
                  </div>
				  <div class="form-group">
                    <label for="exampleInputPassword1">Şifre</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="sifre" placeholder="Yeni Şifre Giriniz.">
                  </div>
				 
				  <div class="form-group">
                    <label for="exampleInputEmail1">E-Posta Adresi</label>
                    <input type="email" class="form-control" name="uye_eposta" value="<?php echo $duzenlesatir["uye_eposta"]; ?>" 
					placeholder="E-posta Adresinizi Giriniz."required>
                  </div>
				  
				  <div class="form-group">
                   <label for="exampleSelectRounded0">Üye Durum</label>
                   <select class="custom-select rounded-0" id="exampleSelectRounded0" name="uye_durum"required>
                    <option value="1" <?php if ($duzenlesatir["uye_durum"]==1 ) {echo "selected";}?> > Onaylı </option>
                    <option value="0" <?php if ($duzenlesatir["uye_durum"]==0 ) {echo "selected";}?> > Onaylı Değil </option>
                   </select>
				  </div>
				  
				  <div class="form-group">
                   <label for="exampleSelectRounded0">Üye Yetki</label>
                   <select class="custom-select rounded-0" id="exampleSelectRounded0" name="uye_yetki"required>
                    <option value="1" <?php if ($duzenlesatir["uye_yetki"]==1 ) {echo "selected";}?> > Site Yöneticisi </option>
					<option value="2" <?php if ($duzenlesatir["uye_yetki"]==2 ) {echo "selected";}?> > Editör </option>
					<option value="3" <?php if ($duzenlesatir["uye_yetki"]==3 ) {echo "selected";}?> > Yazar </option>
                    <option value="4" <?php if ($duzenlesatir["uye_yetki"]==4 ) {echo "selected";}?> > Okur </option>
                   </select>
				  </div>
				  <div class="form-group">
                    <label for="exampleInputFile">Dosya Girişi</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="profilfoto" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Dosya Seçin</label>
                      </div>
                    </div>
                  </div>
				  <div class="form-group">
                    <label class="col-form-label">Şifrenizi Giriniz</label>
                    <input type="password" class="form-control" name="sifre" placeholder="Şifrenizi Giriniz." required>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" align="right">
                  <button type="submit" class="btn btn-primary">Güncelle</button>
                </div>
              </form>
			</div>
		</div>
    </div>
<?php 
	}
		} else {
		message("danger","ban"," Başarısız", "Bu Sayfa İşlem Yapmak İçin Yetkiniz Yok. Lütfen bekleyiniz Yönetici sayfasını yönlendirliyorsunuz");
		header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=anasayfa", true, 303);
    }
		
?>
</div>