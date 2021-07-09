<?php
$hakkimda2_id=$_GET["id"];
?>
<div class="content">
<?php
$silsql="Delete from hakkimda2 where  hakkimda2_id='$hakkimda2_id'";
$sil=mysqli_query($baglan, $silsql);
if($sil){
	
		message("success","check"," Başarılı", "Silme işlemini başarılı bir şekilde gerçekleştirdiniz. Lütfen bekleyiniz yönlendiriliyorsunuz");
			header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=hakkimda2_islemleri", true, 303);
		}else{
			message("warning","exclamation-triangle"," Başarısız", " Seçilen kullanıcı silinememiştir. Lütfen tekrar deneyiniz.  ");
		}	
?>
</div>