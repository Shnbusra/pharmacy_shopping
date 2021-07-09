<div class="content">
<?php
					$adi_soyadi=explode(" ",$girissatir["adi_soyadi"]); // veritabanından gelen adı ve soyadını parçalara ayırır ve dizi şeklimnde degişkene atar
					$vt_soyadi=array_reverse($adi_soyadi)[0]; //diziyi ters çevirir ve ilk elemanını degişkene atar
					array_pop($adi_soyadi); //dizinin son elemanını siler
					$vt_adi=implode(" ",$adi_soyadi); //dizideki kalan elemanları aralarında boşluk olucak şekilde birleştirerek degişkene atar

		
		if ($_POST){
			$adi=trim(mb_convert_case($_POST["adi"], MB_CASE_TITLE, "utf-8"));
			$soyadi=case_converter($_POST["soyadi"]);
			$adi_soyadi=$adi." ".$soyadi;
			$cinsiyet=$_POST["cinsiyet"];
			$dogum_tarihi=$_POST["dogum_tarihi"];
			$kullanici_adif=$_POST["kullanici_adi"];
			$sifref=md5($_POST["sifre"]);
			$uye_epostaf = $_POST["uye_eposta"]; 
			
			if($sifref==$girissatir["kullanici_sifre"]){
				
			if(is_uploaded_file($_FILES["profilfoto"]["tmp_name"])){
			    $profilfoto=pathinfo($_FILES["profilfoto"]["name"]);
				$gelenuzanti=$profilfoto["extension"];
				if ($gelenuzanti=="png" || $gelenuzanti=="PNG" || $gelenuzanti=="jpg" || $gelenuzanti=="JPG" || $gelenuzanti=="jpeg" ||
				$gelenuzanti=="JPEG" ){
				
				    $profildosyaadi=$k_adi."_".uniqid(true);
					$yenikonum="upload/profilfotolari/".$profildosyaadi.".".$gelenuzanti;
				if (move_uploaded_file($_FILES["profilfoto"]["tmp_name"], $yenikonum)){
				
				    $yeniadresi=$profildosyaadi.".".$gelenuzanti;
					
				}else{
					message("warning","exclamation-triangle"," Başarısız", "Profil fotoğrafı yüklenemedi!!");
				}
				
				}else{
					message("warning","exclamation-triangle"," Başarısız", "Lütfen belirtilen uzantılara (jpg,jpeg,png) uygun profil fotoğrafı yükleyiniz.");
				}
		    }else{
				$yeniadresi=$girissatir["uye_profilfoto"];
			}
			$guncellesql="UPDATE uyeler SET adi_soyadi='$adi_soyadi', cinsiyet='$cinsiyet', dogum_tarihi='$dogum_tarihi', kullanici_adi='$kullanici_adif', uye_eposta='$uye_epostaf', uye_profilfoto='$yeniadresi' where uye_id='$uye_id'";
			$guncellesorgu=mysqli_query($baglan, $guncellesql);
			echo mysqli_error($baglan);
			if ($guncellesorgu){
				
				//Sistem Kayıt Kodu
			
				$aciklama=$girissatir["kullanici_adi"]." adlı kullanıcının Profili güncellendi. ";
				$sistemkayitsql="INSERT INTO sistemkayitlari SET aciklama='$aciklama',
				yapilanislem='Kayıt Güncellendi', uye_id='$uye_id'";
				$sistemkayit=mysqli_query($baglan, $sistemkayitsql);
				
				message("success","check"," Başarılı", "Profiliniz başarılı bir şekilde güncellenmiştir.");
				header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=profilim", true, 303);
				
			} else {
					message("warning","exclamation-triangle"," Başarısız", "Güncelleme yapılamadı tekrar deneyiniz.");
			}
		
		}else {
					message("warning","exclamation-triangle"," Hatalı", "Şifrenizi hatalı girdiniz lütfen tekrar giriniz.");
		}
	}
				
?>
<div class="row">
    <div class="col-md-3">
<!-- Profil fotoğraf köşesi kodları -->
            <div class="card card-primary card-outline mt-4">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="upload/profilfotolari/<?php echo $girissatir["uye_profilfoto"];?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $girissatir["kullanici_adi"];?></h3>
                <h3 class="profile-username text-center"><?php echo $girissatir["adi_soyadi"];?></h3>
				<p class="text-center m-0">
				<?php 
					if($girissatir["uye_yetki"] == 0){
						echo"<span class='badge badge-pill badge-success'>Kurucu</span>";
					 }else if($girissatir["uye_yetki"] == 1){
						echo"<span class='badge badge-pill badge-primary'>Site yöneticisi</span>";
					 }else if($girissatir["uye_yetki"] == 2){
						echo"<span class='badge badge-pill badge-danger'>Editör</span>";
					 }else if($girissatir["uye_yetki"] == 3){
						echo"<span class='badge badge-pill badge-info'>Yazar</span>";
					 }else if($girissatir["uye_yetki"] == 4){
						echo"<span class='badge badge-pill badge-warning'>Okur</span>";
					 }
					if($girissatir["cinsiyet"] == 0){
						echo"<span class='badge badge-pill badge-success'>Kadın</span>";
					}else{
						echo"<span class='badge badge-pill badge-info'>Erkek</span>";
					}
                ?>
				</p>
                <p class="text-center m-0"><?php echo date_format(date_create($girissatir["dogum_tarihi"]),'d.m.Y');?></p>
				 <p class="text-center text-muted m-0"><?php echo $girissatir["uye_eposta"];?></p>
				
              </div>
              <!-- /.card-body -->
            </div>
	</div>
<!-- Profilimi Güncelle kodları -->
<div class="col-md-9">
<div class="card card-primary mt-4">
              <div class="card-header">
                <h3 class="card-title">Profilimi Güncelle</h3>
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
                    <label class="col-form-label" for="inputSuccess">Kullanıcı Adı</label>
                    <input type="text" class="form-control" name="kullanici_adi" value="<?php echo $girissatir["kullanici_adi"]; ?>" required>
                  </div>
				  <div class="form-group">
                   <label for="exampleSelectRounded0">Cinsiyet</label>
				   <div class="input-group">
                   <select class="custom-select rounded-0" id="exampleSelectRounded0" name="cinsiyet">
                    <option value="0" <?php if($girissatir["cinsiyet"]==0){echo"selected";}?> > Kadın </option>
                    <option value="1" <?php if($girissatir["cinsiyet"]==1){echo"selected";}?> > Erkek </option>
                   </select>
				  </div>
				  </div>
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Doğum Tarihi</label>
                    <input type="date" class="form-control" name="dogum_tarihi" value="<?php echo $girissatir["dogum_tarihi"]; ?>" required>
                  </div>
				  <div class="form-group">
                    <label class="col-form-label" for="exampleInputEmail1">E-Posta Adresi</label>
                    <input type="email" class="form-control" name="uye_eposta" value="<?php echo $girissatir["uye_eposta"]; ?>" id="inputSuccess" required>
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
</div>