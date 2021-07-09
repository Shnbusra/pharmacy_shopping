<?php
$urun_id=$_GET["id"];
?>
<div class="content">
<?php
$silsql="Delete from urunler where  urun_id='$urun_id'";
$sil=mysqli_query($baglan, $silsql);
if($sil){
			message("success","check"," Başarılı", "Silme işlemini başarılı bir şekilde gerçekleştirdiniz. Lütfen bekleyiniz yönlendiriliyorsunuz");
			header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=urun_listele", true, 303);
		}else{
			message("warning","exclamation-triangle"," Başarısız", " Seçilen kullanıcı silinememiştir. Lütfen tekrar deneyiniz.  ");
		}
?>
</div>