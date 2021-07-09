<?php if($_SESSION["uye_yetki"]<2){
		
		$uye_id=$_GET["id"];
		$kullanici_adi=$_GET["k_adi"];
		$yetki=$_GET["yetki"];
?>
<div class="content">
<?php
    if($_SESSION["uye_yetki"]>=$yetki & $_SESSION["uye_id"]!=$uye_id){
		message("warning","exclamation-triangle"," Başarısız", " Bu kullanıcı düzenlenemez!");
		header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=uye_islemleri", true, 303);
	}else {
		$silsql="Delete from uyeler where uye_id='$uye_id'";

		$sil=mysqli_query($baglan, $silsql);
		
		if($sil){
			
			//Sistem Kayıt Kodu
			
			$aciklama=$kullanici_adi." kullanıcının kaydı silindi. ";
			$k_adi=$_SESSION["k_adi"];
			$sistemkayitsql="INSERT INTO sistemkayitlari SET aciklama='$aciklama',
			yapilanislem='Kayıt Silindi', uye_id='$uye_id'";
			$sistemkayit=mysqli_query($baglan, $sistemkayitsql);
			
			message("success","check"," Başarılı", "Silme işlemini başarılı bir şekilde gerçekleştirdiniz. Lütfen bekleyiniz yönlendiriliyorsunuz");
			header("Refresh:15; url = http://localhost/proje/login/yonetici.php?do=uye_islemleri", true, 303);
			
		}else{
			message("warning","exclamation-triangle"," Başarısız", " Seçilen kullanıcı silinememiştir. Lütfen tekrar deneyiniz. ");
			header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=uye_islemleri", true, 303);
		}
		
	}
?>
</div>
<?php
    } else {
		message("danger","ban"," Başarısız", "Bu Sayfa İşlem Yapmak İçin Yetkiniz Yok. Lütfen bekleyiniz Yönetici sayfasını yönlendirliyorsunuz");
		header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=anasayfa", true, 303);
    }
?>