<div class="content">
<?php
if ($_POST){
			
			$eskisifref=md5($_POST["eskisifre"]);
			$sifref=md5($_POST["sifre"]);
			$sifref2=md5($_POST["sifre2"]);
			if($eskisifref==$girissatir["kullanici_sifre"]){
				if($sifref==$sifref2){
				
			$guncellesql="UPDATE uyeler SET kullanici_sifre='$sifref' where uye_id='$uye_id'";
			$guncellesorgu=mysqli_query($baglan, $guncellesql);
			
			if ($guncellesorgu){
				
				//Sistem Kayıt Kodu
			
				$aciklama="Profil Şifresi güncellendi.";
				$sistemkayitsql="INSERT INTO sistemkayitlari SET aciklama='$aciklama',
				yapilanislem='Profil Güncellendi', uye_id='$uye_id'";
				$sistemkayit=mysqli_query($baglan, $sistemkayitsql);
				
				message("success","check"," Başarılı", "Şifreniz başarılı bir şekilde güncellenmiştir.");
				header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=sifre_guncelle", true, 303);
				
			} else {
					message("warning","exclamation-triangle"," Başarısız", "Güncelleme yapılamadı tekrar deneyiniz.");
			}
		}else{
			message("warning","exclamation-triangle"," Başarısız", "Şifreleriniz uyuşmuyor lütfen kontrol ediniz.");
		}
	}else {
		message("warning","exclamation-triangle"," Başarısız", "Eski Şifrenizi hatalı girdiniz lütfen tekrar giriniz.");
	}
	
}
?>
<div class="row">
<div class="col-md-12">
<div class="card card-primary mt-4">
              <div class="card-header">
                <h3 class="card-title">Şifre Güncelle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST">
                <div class="card-body">
				  <div class="form-group">
                    <label class="col-form-label">Eski Şifrenizi Giriniz</label>
                    <input type="password" class="form-control" name="eskisifre" placeholder="Eski Şifrenizi Giriniz." required>
                  </div>
				  <div class="form-group">
                    <label class="col-form-label">Yeni Şifrenizi Giriniz</label>
                    <input type="password" class="form-control" name="sifre" placeholder="Yeni Şifrenizi Giriniz." required>
                  </div>
				  <div class="form-group">
                    <label class="col-form-label">Tekrar Yeni Şifrenizi Giriniz</label>
                    <input type="password" class="form-control" name="sifre2" placeholder="Yeni Şifrenizi Giriniz." required>
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