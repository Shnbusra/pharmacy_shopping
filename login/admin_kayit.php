<div class="content">
<?php
if($_SESSION["uye_yetki"]<2 ){
             if($_POST){
				$adi=trim(mb_convert_case($_POST["adi"], MB_CASE_TITLE, "utf-8"));
				$soyadi=case_converter($_POST["soyadi"]);
				$adi_soyadi=$adi." ".$soyadi;
				$cinsiyet=$_POST["cinsiyet"];
				$dogum_tarihi=$_POST["dogum_tarihi"];
                $kullanici_adi=$_POST["kullanici_adi"];
                $sifre=$_POST["sifre"];
                $sifre2 = $_POST["sifre2"]; 
                $eposta=$_POST["e-posta"];
                $rol = $_POST["rol"];
                
                if($kullanici_adi!= "" && $sifre!= "" && $sifre2 != "" && $eposta != ""){
					
					$sifre=md5($_POST["sifre"]);
					$sifre2 = md5($_POST["sifre2"]);

                if($sifre == $sifre2){
                        
                    $kullanici_kontrol = "SELECT * FROM uyeler WHERE kullanici_adi = '$kullanici_adi'";
                    $kullanici_kontrol_sonuc = mysqli_query($baglan,$kullanici_kontrol);
                    $kontrol = mysqli_num_rows($kullanici_kontrol_sonuc);
                            
                if ($kontrol == 0){
				if(is_uploaded_file($_FILES["profilfoto"]["tmp_name"])){
			    $profilfoto=pathinfo($_FILES["profilfoto"]["name"]);
				$gelenuzanti=$profilfoto["extension"];
				if ($gelenuzanti=="png" || $gelenuzanti=="PNG" || $gelenuzanti=="jpg" || $gelenuzanti=="JPG" || $gelenuzanti=="jpeg" ||
				$gelenuzanti=="JPEG" ){
				
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
					if($cinsiyet){
						$yeniadresi="erkek.png";
					}else{
						$yeniadresi="kadin.png";
					}
				}
                    $sql="INSERT INTO uyeler SET adi_soyadi='$adi_soyadi', cinsiyet='$cinsiyet', dogum_tarihi='$dogum_tarihi', kullanici_adi='$kullanici_adi', 
					kullanici_sifre='$sifre', uye_profilfoto='$yeniadresi', uye_eposta='$eposta', uye_yetki = '$rol'";
                    $sonuc=mysqli_query($baglan,$sql);
                
                if($sonuc == 1){
					
					//Sistem Kayıt Kodu
					$aciklama=$kullanici_adi." adında yeni bir kayıt oluşturuldu.";
					$k_adi=$_SESSION["k_adi"];
					$sistemkayitsql="INSERT INTO sistemkayitlari SET aciklama='$aciklama',
					yapilanislem='Kayıt Eklendi', uye_id='$uye_id'";
					$sistemkayit=mysqli_query($baglan, $sistemkayitsql);

                message("success","check"," Başarılı", "Kaydınız başarılı bir şekilde alınmıştır. Lütfen yöneticinin onaylamasını bekleyiniz.");
				header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=uye_islemleri", true, 303);
                }else{
					message("warning","exclamation-triangle"," Başarısız", "Kaydınız alınamamıştır. Lütfen tekrar deneyiniz.");
            }
		}else {
			message("warning","exclamation-triangle"," Hatalı", "Kullanıcı adı veya E-posta Adresi daha önce alınmıştır. 
					Lütfen başka bir kullanıcı adı veya E-posta adresi ile tekrar deneyiniz.");
        }
	}else{
		message("warning","exclamation-triangle"," Başarısız", "Girdiğiniz şifreler uyuşmuyor. Lütfen tekrar deneyiniz.");
    }
}else{
	message("warning","exclamation-triangle"," Başarısız", "Tüm alanları eksiksiz doldurunuz lütfen.");
}
			 }
?>
<div class="row">
<div class="col-md-12">
<div class="card card-primary mt-4">
              <div class="card-header">
                <h3 class="card-title">Yeni Üye Ekle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
				  <div class="form-group">
                    <label>Adı</label>
                    <input type="text" class="form-control" name="adi" value="<?php if($_POST) { echo $adi; } ?>" placeholder="Adınızı Giriniz" required>
                  </div>
				  <div class="form-group">
                    <label>Soyadı</label>
                    <input type="text" class="form-control" name="soyadi" value="<?php if($_POST) { echo $soyadi; } ?>" placeholder="Soyadınızı Giriniz" required>
                  </div>
                  <div class="form-group">
                    <label>Kullanıcı Adı Giriniz</label>
                    <input type="text" class="form-control" name="kullanici_adi" value="<?php if($_POST) { echo $kullanici_adi; } ?>" placeholder="Kullanıcı Adınızı Giriniz">
                  </div>
				  <div class="form-group">
                   <label for="exampleSelectRounded0">Cinsiyet</label>
				   <div class="input-group">
                   <select class="custom-select rounded-0" id="exampleSelectRounded0" name="cinsiyet">
                    <option value="0" <?php if($_POST){ if($cinsiyet == 0){echo "selected"; }}?> > Kadın </option>
                    <option value="1" <?php if($_POST){ if($cinsiyet == 0){echo "selected"; }}?> > Erkek </option>
                   </select>
				  </div>
				  </div>
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Doğum Tarihi</label>
                    <input type="date" class="form-control" name="dogum_tarihi" value="<?php if($_POST) {echo $dogum_tarihi;} ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Şifrenizi Giriniz</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="sifre" placeholder="Şifrenizi Giriniz"required>
                  </div>
				  <div class="form-group">
                    <label for="exampleInputPassword1">Şifrenizi Tekrar Giriniz</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="sifre2" placeholder="Tekrar Şifre Giriniz"required>
                  </div>
				  <div class="form-group">
                    <label for="exampleInputEmail1">E-Posta Adresi</label>
                    <input type="email" class="form-control" name="e-posta" value="<?php if($_POST) {echo $eposta;} ?>" placeholder="E-posta Adresinizi Giriniz"required>
                  </div>
				  <div class="form-group">
                   <label for="exampleSelectRounded0">Hangi Rol</label>
                   <select class="custom-select rounded-0" id="exampleSelectRounded0" name="rol"required>
                    <option value="1" <?php if($_POST){ if($rol == 1){echo "selected"; }} ?> > Site Yöneticisi </option>
					<option value="2" <?php if($_POST){ if($rol == 2){echo "selected"; }} ?> > Editör </option>
					<option value="3" <?php if($_POST){ if($rol == 3){echo "selected"; }} ?> > Yazar </option>
                    <option value="4" <?php if($_POST){ if($rol == 4){echo "selected"; }} ?> > Okur </option>
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
                </div>
                <!-- /.card-body -->

                <div class="card-footer" align="right">
                  <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
              </form>
    </div>
</div>
</div>
<?php 
	}else{
        message("danger","ban"," Başarısız", "Bu Sayfa İşlem Yapmak İçin Yetkiniz Yok. Lütfen bekleyiniz Yönetici sayfasını yönlendirliyorsunuz");
        header("Refresh:3; url = http://localhost/proje/login/yonetici.php", true, 303);
    }
		
?>
</div>