<div class="content">
<?php

if($_SESSION["uye_yetki"]<2 ){
		$id=$_GET["id"];
		$slider_sayisi=mysqli_num_rows(mysqli_query($baglan,"SELECT * FROM slider"));
		$slider_id=mysqli_num_rows(mysqli_query($baglan,"SELECT slider_id FROM slider WHERE slider_id='$id'"));
		if($slider_sayisi<3){
		if($slider_id==0){
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
						message("warning","exclamation-triangle"," Hatalı", "Slider için Belirtilen dosya yüklenemedi.");
					}
					
				}
				
				$yeniadresi=implode(",",$slider_gorsel);
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
					message("warning","exclamation-triangle"," Hatalı", "Arka Plan için Belirtilen dosya yüklenemedi.");
				}
				
				$slidersql="INSERT INTO slider SET
				slider_id='$id',
				slider_ust_baslik='$slider_ust_baslik',
				slider_alt_baslik='$slider_alt_baslik',
				slider_satinal_link='$slider_satinal_link',
				slider_gorsel='$yeniadresi',
				slider_arkaplan='$yeniadresi2',
				uye_id='$uye_id'
				";
				
			$sliderekle=mysqli_query($baglan, $slidersql);
			echo mysqli_error($baglan);
			
				if($sliderekle){
					message("success","check"," Başarılı", "Başarılı bir şekilde eklenmiştir.");
					header("Refresh:10; url = http://localhost/proje/login/yonetici.php?do=slider_islemleri", true, 303);
				
				}else{
					message("warning","exclamation-triangle"," Başarısız", "Slider ekleme başarısızdır, lütfen daha sonra tekrar deneyiniz.");
				}
			 }
?>
<div class="row">
<div class="col-md-12">
<div class="card card-primary mt-4">
              <div class="card-header">
                <h3 class="card-title">Slider Ekle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
				  
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Slider Üst Başlık</label>
                    <input type="text" class="form-control" name="slider_ust_baslik" maxlength="40" value="<?php if($_POST) { echo $slider_ust_baslik; } ?>" required>
                  </div>
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Slider Alt Başlık</label>
                    <input type="text" class="form-control" name="slider_alt_baslik" maxlength="20" value="<?php if($_POST) { echo $slider_alt_baslik; } ?>" required>
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
                    <input type="text" class="form-control" name="slider_satinal_link" value="<?php if($_POST) { echo $slider_satinal_link; } ?>" required>
                  </div>
				  <div class="form-group">
                    <label class="col-form-label">Şifrenizi Giriniz</label>
                    <input type="password" class="form-control" name="sifre" placeholder="Şifrenizi Giriniz." required>
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
			} else {
			message("danger","ban"," Başarısız", $id." Slider zaten bulunmaktadır. ".$id." Numaralı sliderı düzenleye bilir ya da sile bilirsiniz.");
			header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=slider_islemleri", true, 303);
		}
			} else {
			message("danger","ban"," Başarısız", "Slider ekleme limitini aştınız lütfen bekleyiniz yönlendirliyorsunuz");
			header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=slider_islemleri", true, 303);
		}
		} else {
		message("danger","ban"," Başarısız", "Bu Sayfa İşlem Yapmak İçin Yetkiniz Yok. Lütfen bekleyiniz Yönetici sayfasını yönlendirliyorsunuz");
		header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=anasayfa", true, 303);
    }
?>
</div>