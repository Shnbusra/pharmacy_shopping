<div class="content">
<?php

if($_SESSION["uye_yetki"]<2 ){
	if($_POST){
		        $kategori_ust_id=$_POST["kategori_ust_id"];
				$kategori_alt_adi=$_POST["kategori_alt_adi"];
				$kategori_alt_ekleyen=$k_adi;
				$alt_kategori_sql="INSERT INTO alt_kategori SET
				kategori_alt_adi='$kategori_alt_adi',
				kategori_ust_id='$kategori_ust_id',
				kategori_alt_ekleyen='$kategori_alt_ekleyen'";
				
			$alt_kategori_ekle=mysqli_query($baglan, $alt_kategori_sql);
				if($alt_kategori_ekle){
					//Sistem Kayıt Kodu
			
					$aciklama=$girissatir["kullanici_adi"]." adlı kullanıcının kaydı güncellendi. ";
					$sistemkayitsql="INSERT INTO sistemkayitlari SET aciklama='$aciklama',
					yapilanislem='Kayıt Güncellendi', uye_id='$uye_id'";
					$sistemkayit=mysqli_query($baglan, $sistemkayitsql);
					message("success","check"," Başarılı", "Başarılı bir şekilde eklenmiştir.");
					header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=alt_kategori_islemleri", true, 303);
				
				}else{
					message("warning","exclamation-triangle"," Başarısız", "Alt kategori ekleme başarısızdır, lütfen daha sonra tekrar deneyiniz.");
				}
			 }
             	
?>
<div class="row">
<div class="col-md-12">
<div class="card card-primary mt-4">
              <div class="card-header">
                <h3 class="card-title">Alt Kategori Ekle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
				  <div class="form-group">
                   <label>Üst Kategori</label>
                   <select class="custom-select" name="kategori_ust_id">
				   <?php
				   $query=mysqli_query($baglan, "select kategori_ust_id,kategori_ust_adi from ust_kategori");
				   while($sorgu_satir = mysqli_fetch_array($query)){
				   ?>
                    <option value="<?php echo $sorgu_satir["kategori_ust_id"]; ?>" <?php if($_POST)
					{if($sorgu_satir["kategori_ust_id"]==$kategori_ust_id){echo"selected";}} ?> > <?php echo $sorgu_satir["kategori_ust_adi"]; ?></option>
					 <?php }?>
                   </select>
				  </div>
				  
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Alt Kategori Adı</label>
                    <input type="text" class="form-control" name="kategori_alt_adi" maxlength="40" value="<?php if($_POST) { echo $kategori_alt_adi; } ?>" required>
                  </div>
				  
				  <div class="form-group">
                    <label class="col-form-label">Şifrenizi Giriniz</label>
                    <input type="password" class="form-control" name="sifre" placeholder="Şifrenizi Giriniz." required>
                  </div>
				  
                </div>
                <!-- /.card-body -->
                <div class="card-footer" align="right">
                  <button type="submit" class="btn btn-primary">Ekle</button>
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