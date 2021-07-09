<div class="content">
<?php
if($_SESSION["uye_yetki"]<2 ){
    $sitek="select * from sitekapali";
	$siteksonuc=mysqli_query($baglan, $sitek);
	$sitekgelen=mysqli_fetch_array($siteksonuc);
	if ($_POST) {
		$sitek_baslik=$_POST["sitek_baslik"];
		$sitek_aciklama=$_POST["sitek_aciklama"];
		$sitek_tarih=$_POST["sitek_tarih"];
		$sitek2="UPDATE sitekapali SET
		              sitek_baslik='$sitek_baslik',
					  sitek_aciklama='$sitek_aciklama',
		              sitek_tarih='$sitek_tarih'";
		$siteksonuc2=mysqli_query($baglan, $sitek2);
		if ($siteksonuc2){
				
				//Sistem Kayıt Kodu güncelleme yapılmadı dedi sor
			
				$aciklama="Bakım Ayarları güncellendi. ";
				$sistemkayitsql="INSERT INTO sistemkayitlari SET aciklama='$aciklama',
				yapilanislem='Kayıt Güncellendi', uye_id='$uye_id'";
				$sistemkayit=mysqli_query($baglan, $sistemkayitsql);
				
					message("success","check"," Başarılı", "Başarılı bir şekilde güncellenmiştir. Lütfen bekleyiniz yönlendiriliyorsunuz.");
					
				header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=bakimsayfasi", true, 303);
				
			} else {
				message("danger","ban"," Başarısız", "Güncelleme yapılamadı tekrar deneyiniz.");
			}
	}
    
				
?>
<div class="row" >
<div class="col-md-12">
<div class="card card-primary mt-4">
              <div class="card-header">
                <h3 class="card-title">Bakım Ayarları</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
        <form method="POST">
            <div class="card-body">
				<div class="form-group">
                    <label>Başlık</label>
					<div class="input-group">
                    <input type="text" class="form-control" name="sitek_baslik" value="<?php echo $sitekgelen["sitek_baslik"];?>" required>
					</div>
				</div>
				<div class="form-group">
                    <label>Açıklama</label>
					<div class="input-group">
                    <input type="text" class="form-control" name="sitek_aciklama" value="<?php echo $sitekgelen["sitek_aciklama"];?>" required>
					</div>
				</div>
				<div class="form-group">
                    <label>Tarih</label>
					<div class="input-group">
                    <input type="date" class="form-control" name="sitek_tarih" value="<?php echo $sitekgelen["sitek_tarih"];?>" required>
					</div>
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