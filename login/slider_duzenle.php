<div class="content">
<?php
$gelenid=$_GET["id"];
	if($_SESSION["uye_yetki"]<2 ){
	$duzenlesorgusql="Select * from slider where slider_id='$gelenid'";
	$duzenlesorgu=mysqli_query($baglan,$duzenlesorgusql);
	$duzenlesatir=mysqli_fetch_array($duzenlesorgu);
	
	if($_POST){
		
		$slider_ust_baslik=$_POST["slider_ust_baslik"];
		$slider_alt_baslik=$_POST["slider_alt_baslik"];
		$slider_satinal_link=$_POST["slider_satinal_link"];
		/*slider büyük foto ekleme kodu*/
		for($i=0; $i<count($_FILES["dosya1"]["tmp_name"]); $i++){
					if(is_uploaded_file($_FILES["dosya1"]["tmp_name"][$i])){
						
						$dosya1=pathinfo($_FILES["dosya1"]["name"][$i]);
						$uzanti=$dosya1["extension"];
							if($uzanti=="png" || $uzanti=="PNG" || $uzanti=="jpg" || $uzanti=="JPG" || $uzanti=="jpeg" || $uzanti=="JPEG" )
							{
								$slideradi=str_replace(" ","_",OzelKarakterTemizle($slider_ust_baslik))."_ön_".$i."_".uniqid(true);
								$yenikonum="upload/sliderfoto/".$slideradi.".".$uzanti;
									if(move_uploaded_file($_FILES["dosya1"]["tmp_name"][$i], $yenikonum)){
									$slider_gorsel[]=$slideradi.".".$uzanti;
								}else{
									message("warning","exclamation-triangle"," Başarısız", "Slider fotoğrafı yüklenemedi!!");
								}
							}else{
								message("warning","exclamation-triangle"," Hatalı", "Slider görseli için JPG, JPEG ve PNG şeklinde dosya yükleyiniz.");
							}
					}else{
						$yeniadresi2=$duzenlesatir["slider_gorsel"];
					}
					
				}
				if(isset($slider_gorsel)){
					$yeniadresi=implode(",",$slider_gorsel);
				}else{
					$yeniadresi=$duzenlesatir["slider_gorsel"];
				}
			/*arka plan görsel kodu*/
					if(is_uploaded_file($_FILES["dosya2"]["tmp_name"])){
						$dosya2=pathinfo($_FILES["dosya2"]["name"]);
						$uzanti2=$dosya2["extension"];
							if($uzanti2=="png" || $uzanti2=="PNG" || $uzanti2=="jpg" || $uzanti2=="JPG" || $uzanti2=="jpeg" ||$uzanti2=="JPEG" )
							{
								$arkaplan=str_replace(" ","_",OzelKarakterTemizle($slider_ust_baslik))."_arka_".uniqid(true);
								$yenikonum2="upload/sliderfoto/".$arkaplan.".".$uzanti2;
									if(move_uploaded_file($_FILES["dosya2"]["tmp_name"], $yenikonum2)){
										$yeniadresi2=$arkaplan.".".$uzanti2;
					
									}else{
										message("warning","exclamation-triangle"," Başarısız", "Arka plan fotoğrafı yüklenemedi!!");
									}
							}else{
								message("warning","exclamation-triangle"," Hatalı", "Lütfen arka plan görseli için JPG, JPEG ve PNG şeklinde dosya yükleyiniz.");
							}
						}else{
							$yeniadresi2=$duzenlesatir["slider_arkaplan"];
						}
		
		$guncellesql="UPDATE slider SET slider_ust_baslik='$slider_ust_baslik',slider_alt_baslik='$slider_alt_baslik',
		slider_gorsel='$yeniadresi', slider_arkaplan='$yeniadresi2', slider_satinal_link='$slider_satinal_link' where slider_id='$gelenid'";
		$guncellesorgu=mysqli_query($baglan,$guncellesql);
		
		if($guncellesorgu){
			
			//Sistem Kayıt Kodu
			$aciklama="Slider Güncellendi.";
			$sistemkayitsql="INSERT INTO sistemkayitlari SET aciklama='$aciklama',
			yapilanislem='Kayıt Güncellendi',uye_id='$uye_id'";
			$sistemkayit=mysqli_query($baglan,$sistemkayitsql);
			message("success","check"," Başarılı", "Güncelleme Başarılı");
			header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=slider_islemleri", true, 303);
		}else{
			message("warning","exclamation-triangle"," Başarısız", "Güncelleme Başarısız");
		}
	}
?>
<div class="row">
<div class="col-md-12">
<div class="card card-primary mt-4">
              <div class="card-header">
                <h3 class="card-title">Slider Güncelle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
				  
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Slider Üst Başlık</label>
                    <input type="text" class="form-control" name="slider_ust_baslik" maxlength="40" value="<?php echo $duzenlesatir["slider_ust_baslik"]; ?>" required>
                  </div>
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Slider Alt Başlık</label>
                    <input type="text" class="form-control" name="slider_alt_baslik" maxlength="20" value="<?php echo $duzenlesatir["slider_alt_baslik"]; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Ön Slider Görseli</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="dosya1[]" id="exampleInputFile" multiple>
                        <label class="custom-file-label" for="exampleInputFile">Dosya Seçin</label>
                      </div>
                    </div>
                  </div>
				   <div class="form-group">
                    <label for="exampleInputFile">Arka plan Slider Görseli</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="dosya2" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Dosya Seçin</label>
                      </div>
                    </div>
                  </div>
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Slider Satın Al Link</label>
                    <input type="text" class="form-control" name="slider_satinal_link" value="<?php echo $duzenlesatir["slider_satinal_link"]; ?>" required>
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