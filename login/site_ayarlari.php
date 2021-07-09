<div class="content">
<?php
if($_SESSION["uye_yetki"]<2 ){
    $sql="select * from ayarlar";
	$sqlsonuc=mysqli_query($baglan, $sql);
	$sitegelen=mysqli_fetch_array($sqlsonuc);
	
	if ($_POST) {
		$site_url=$_POST["site_url"];
		$site_baslik=$_POST["site_baslik"];
		$site_anahtarkelimeler=$_POST["site_anahtarkelimeler"];
		$site_aciklama=$_POST["site_aciklama"];
		$site_durum=$_POST["site_durum"];
		$site_tema=$_POST["site_tema"];
		$site_iletisimno=$_POST["site_iletisimno"];
		$site_eposta=$_POST["site_eposta"];
		$site_adres=$_POST["site_adres"];
		$site_instagram=$_POST["site_instagram"];
		$site_twitter=$_POST["site_twitter"];
		//Admin logo fotoğraf kodu 
		if(is_uploaded_file($_FILES["admin_logo"]["tmp_name"])){
			    $adminlogo=pathinfo($_FILES["admin_logo"]["name"]);
				$gelenuzanti=$adminlogo["extension"];
				if ($gelenuzanti=="png" || $gelenuzanti=="PNG" || $gelenuzanti=="jpg" || $gelenuzanti=="JPG" || $gelenuzanti=="jpeg" ||
				$gelenuzanti=="JPEG" ){
				
				    $admindosyaadi="admin_".uniqid(true);
					$yenikonum="upload/adminlogo/".$admindosyaadi.".".$gelenuzanti;
				if (move_uploaded_file($_FILES["admin_logo"]["tmp_name"], $yenikonum)){
						if($sitegelen["admin_logo"]){
							unlink("upload/adminlogo/".$sitegelen["admin_logo"]);
						}
				    $adminadresi=$admindosyaadi.".".$gelenuzanti;
					
				}else{
					message("warning","exclamation-triangle"," Başarısız", "Admin Logo yüklenemedi!!");
				}
				
				}else{
					message("warning","exclamation-triangle"," Başarısız", "Lütfen belirtilen uzantılara (jpg,jpeg,png) uygun Admin Logo yükleyiniz.");
				}
		    }else{
				$adminadresi=$sitegelen["admin_logo"];
			}
			//site logo fotoğraf kodu 
		if(is_uploaded_file($_FILES["site_logo"]["tmp_name"])){
			    $sitelogo=pathinfo($_FILES["site_logo"]["name"]);
				$gelenuzanti=$sitelogo["extension"];
				if ($gelenuzanti=="png" || $gelenuzanti=="PNG" || $gelenuzanti=="jpg" || $gelenuzanti=="JPG" || $gelenuzanti=="jpeg" ||
				$gelenuzanti=="JPEG" ){
				
				    $sitedosyaadi="sitelogo_".uniqid(true);
					$yenikonum="upload/sitelogo/".$sitedosyaadi.".".$gelenuzanti;
				if (move_uploaded_file($_FILES["site_logo"]["tmp_name"], $yenikonum)){
				    if($sitegelen["site_logo"]){
						unlink("upload/sitelogo/".$sitegelen["site_logo"]);
					}
				    $siteadresi=$sitedosyaadi.".".$gelenuzanti;
					
				}else{
					message("warning","exclamation-triangle"," Başarısız", "Profil fotoğrafı yüklenemedi!!");
				}
				
				}else{
					message("warning","exclamation-triangle"," Başarısız", "Lütfen belirtilen uzantılara (jpg,jpeg,png) uygun profil fotoğrafı yükleyiniz.");
				}
		    }else{
				$siteadresi=$sitegelen["site_logo"];
			}
			//site icon fotoğraf kodu 
		if(is_uploaded_file($_FILES["site_ikon"]["tmp_name"])){
			    $siteikon=pathinfo($_FILES["site_ikon"]["name"]);
				$gelenuzanti=$siteikon["extension"];
				if ($gelenuzanti=="png" || $gelenuzanti=="PNG" || $gelenuzanti=="jpg" || $gelenuzanti=="JPG" || $gelenuzanti=="jpeg" ||
				$gelenuzanti=="JPEG" ){
				
				    $ikondosyaadi="siteikon_".uniqid(true);
					$yenikonum="upload/sitelogo/".$ikondosyaadi.".".$gelenuzanti;
				if (move_uploaded_file($_FILES["site_ikon"]["tmp_name"], $yenikonum)){
				    if($sitegelen["site_ikon"]){
						unlink("upload/sitelogo/".$sitegelen["site_ikon"]);
					}
				    $ikonadresi=$ikondosyaadi.".".$gelenuzanti;
					
				}else{
					message("warning","exclamation-triangle"," Başarısız", "Profil fotoğrafı yüklenemedi!!");
				}
				
				}else{
					message("warning","exclamation-triangle"," Başarısız", "Lütfen belirtilen uzantılara (jpg,jpeg,png) uygun profil fotoğrafı yükleyiniz.");
				}
		    }else{
				$ikonadresi=$sitegelen["site_ikon"];
			}
		$sql2="UPDATE ayarlar SET
					  admin_logo='$adminadresi',
		              site_ikon='$ikonadresi',
					  site_logo='$siteadresi',
		              site_url='$site_url',
		              site_baslik='$site_baslik',
					  site_anahtarkelimeler='$site_anahtarkelimeler',
		              site_aciklama='$site_aciklama',
					  site_aciklama='$site_aciklama',
					  site_durum='$site_durum',
					  site_tema='$site_tema',
					  site_iletisimno='$site_iletisimno',
					  site_eposta='$site_eposta',
					  site_adres='$site_adres',
					  site_instagram='$site_instagram',
					  site_twitter='$site_twitter'
					  ";
		$sqlsonuc2=mysqli_query($baglan, $sql2);
	
	if ($sqlsonuc2){
				
				//Sistem Kayıt Kodu güncelleme yapılmadı dedi sor
			
				$aciklama="Site ayarları güncellendi. ";
				$sistemkayitsql="INSERT INTO sistemkayitlari SET aciklama='$aciklama',
				yapilanislem='Site Ayarları Güncellendi', uye_id='$uye_id'";
				$sistemkayit=mysqli_query($baglan, $sistemkayitsql);
				
					message("success","check"," Başarılı", "Başarılı bir şekilde güncellenmiştir. Lütfen bekleyiniz yönlendiriliyorsunuz.");
					
				header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=site_ayarlari", true, 303);
				
			} else {
				message("danger","ban"," Başarısız", "Güncelleme yapılamadı tekrar deneyiniz.");
			}
	}
    
				
?>
<div class="row" >
<div class="col-md-12">
<div class="card card-primary mt-4">
              <div class="card-header">
                <h3 class="card-title">Site Ayarları/Düzenle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
				 <div class="form-group">
                    <label>Site URL</label>
					<div class="input-group">
                    <input type="text" class="form-control" name="site_url" value="<?php echo $sitegelen["site_url"];?>" required>
                  </div>
                 </div>
                  <div class="form-group">
                    <label>Site Başlığı</label>
					<div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-clipboard-check"></i></span>
                    </div>
                    <input type="text" class="form-control" name="site_baslik" value="<?php echo $sitegelen["site_baslik"];?>">
                  </div>
                  </div>
				  <div class="form-group">
                    <label>Site Anahtar Kelimeler</label>
					<div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="text" class="form-control" name="site_anahtarkelimeler" value="<?php echo $sitegelen["site_anahtarkelimeler"];?>">
                  </div>
                  </div>
				  <div class="form-group">
                    <label>Site Açıklama</label>
					<div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" name="site_aciklama" value="<?php echo $sitegelen["site_aciklama"];?>">
                  </div>
                  </div>
				  <div class="form-group">
                   <label for="exampleSelectRounded0">Site Durum</label>
				   <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-toggle-off"></i></span>
                    </div>
                   <select class="custom-select rounded-0" id="exampleSelectRounded0" name="site_durum">
                    <option value="0" <?php if($sitegelen["site_durum"]==0){echo"selected";}?> > Kapalı </option>
                    <option value="1" <?php if($sitegelen["site_durum"]==1){echo"selected";}?> > Açık </option>
                   </select>
				  </div>
				  </div>
				  <div class="form-group">
                   <label for="exampleSelectRounded0">Site Tema</label>
				   <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-exchange-alt"></i></span>
                    </div>
                   <select class="custom-select rounded-0" id="exampleSelectRounded0" name="site_tema">
                    <option value="default" >  Default </option>
                   </select>
				  </div>
				  </div>
				   <div class="form-group">
				   <label>Site İletişim Numarası</label>
				    <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control" name="site_iletisimno" value="<?php echo $sitegelen["site_iletisimno"];?>">
                  </div>
                  </div>
				  <div class="form-group">
				   <label>Site Adres</label>
				    <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" name="site_adres" value="<?php echo $sitegelen["site_adres"];?>">
                  </div>
                  </div>
				  <div class="form-group">
                    <label for="exampleInputEmail1">Site E-posta Adresi</label>
					<div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                    </div>
                    <input type="email" class="form-control" name="site_eposta" value="<?php echo $sitegelen["site_eposta"];?>">
                  </div>
                  </div>
				   <div class="form-group">
                    <label>Site İnstagram Adresi</label>
					<div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-instagram-square"></i></span>
                    </div>
                    <input type="text" class="form-control" name="site_instagram" value="<?php echo $sitegelen["site_instagram"];?>">
                  </div>
                  </div>
				   <div class="form-group">
                    <label>Site Twitter Adresi</label>
					<div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-twitter-square"></i></span>
                    </div>
                    <input type="text" class="form-control" name="site_twitter" value="<?php echo $sitegelen["site_twitter"];?>">
                  </div>
                  </div>
				  <div class="form-group">
                    <label for="exampleInputFile">Site İkon</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="site_ikon" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Dosya Seçin</label>
                      </div>
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="exampleInputFile">Site Logo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="site_logo" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Dosya Seçin</label>
                      </div>
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="exampleInputFile">Admin Logo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="admin_logo" id="exampleInputFile">
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
	
		} else {
		message("danger","ban"," Başarısız", "Bu Sayfa İşlem Yapmak İçin Yetkiniz Yok. Lütfen bekleyiniz Yönetici sayfasını yönlendirliyorsunuz");
		header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=anasayfa", true, 303);
    }
		
?>
</div>
