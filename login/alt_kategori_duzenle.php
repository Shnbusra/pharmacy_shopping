<div class="content">
<?php
$gelenid=$_GET["id"];
	if($_SESSION["uye_yetki"]<2 ){
	$duzenlesorgusql="Select * from alt_kategori where kategori_alt_id='$gelenid'";
	$duzenlesorgu=mysqli_query($baglan,$duzenlesorgusql);
	$duzenlesatir=mysqli_fetch_array($duzenlesorgu);
	if($_POST){
		$kategori_ust_id=$_POST["kategori_ust_id"];
		$kategori_alt_adi=$_POST["kategori_alt_adi"];
		$guncellesql="UPDATE alt_kategori SET kategori_alt_adi='$kategori_alt_adi', kategori_ust_id='$kategori_ust_id' where kategori_alt_id='$gelenid'";
		$guncellesorgu=mysqli_query($baglan,$guncellesql);
		
		if($guncellesorgu){
			
			//Sistem Kayıt Kodu
			$aciklama="Alt Kategori güncellendi.";
			$sistemkayitsql="INSERT INTO sistemkayitlari SET aciklama='$aciklama',
			yapilanislem='Kayıt Güncellendi',uye_id='$uye_id'";
			$sistemkayit=mysqli_query($baglan,$sistemkayitsql);
			message("success","check"," Başarılı", "Güncelleme Başarılı");
			header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=alt_kategori_islemleri", true, 303);
		}else{
			message("warning","exclamation-triangle"," Başarısız", "Güncelleme Başarısız");
		}
	}
?>
<div class="row">
<div class="col-md-12">
<div class="card card-primary mt-4">
              <div class="card-header">
                <h3 class="card-title">Alt Kategori Düzenle</h3>
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
				   while($duzenlesatir = mysqli_fetch_array($query)){
				   ?>
                    <option value="<?php echo $duzenlesatir["kategori_ust_id"]; ?>" <?php if($_POST)
					{if($duzenlesatir["kategori_ust_id"]==$kategori_ust_id){echo"selected";}} ?> > <?php echo $duzenlesatir["kategori_ust_adi"]; ?></option>
					 <?php }?>
                   </select>
				  </div>
				  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess">Alt Kategori Adı</label>
                    <input type="text" class="form-control" name="kategori_alt_adi" maxlength="40" value="<?php echo $duzenlesatir["kategori_alt_adi"]; ?>" required>
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