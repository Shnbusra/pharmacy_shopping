<!DOCTYPE html>
<?php
    require_once "../sistem/ayar.php";
    require_once "../sistem/sistem.php";
?>
<html lang="tr-TR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $satir["site_baslik"]; ?> | Admin Paneli</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script> <!-- Sayafa Çalışması için gerekli javascipt kodu -->
</head>
<body class="hold-transition login-page">
<div class="login-box w-75">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h2"><b>Admin|</b>Kayıt Ol</a>
    </div>
    <div class="card-body">
    <?php
        if($_POST){
			$adi=trim(mb_convert_case($_POST["adi"], MB_CASE_TITLE, "utf-8"));
			$soyadi=case_converter($_POST["soyadi"]);
			$adi_soyadi=$adi." ".$soyadi;
			$cinsiyet=$_POST["cinsiyet"];
			$dogum_tarihi=$_POST["dogum_tarihi"];
			$eposta=$_POST["e-posta"];
            $kullanici_adi=$_POST["kullanici_adi"];
            $sifre=md5($_POST["sifre"]);
            $sifre2=md5($_POST["sifre2"]);
            $response=$_POST["g-recaptcha-response"];  // Yanıt 
            $secret="6LeKFZsaAAAAAKPc1-9EXmYjQo4loZBQraPXgBTN"; // Gizli Anahtar KOdu
            $remoteip=$_SERVER["REMOTE_ADDR"]; // Kullanıcının İp Adresini Alma
            $captcha=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip"); // yukarıdaki değişkenleri file get methodu ile gönderiyoruz
            $result=json_decode($captcha); // Gönderdiğimiz dosya json değerler olduğu için json decode işlemi yapıyoruz ve değişkene aktarıyoruz 
                if($result->success==1){ // json decode işleminden sonra succes değeri eğer 1 ise yani true işlem başarılı mesajı veriyoruz eğer değeri 0 ise yani false ise hata mesjaı veriyoruz
                                    
                if($kullanici_adi!= "" && $sifre!= "" && $sifre2 != "" && $eposta != ""){
                if($sifre == $sifre2){
                    $kullanici_kontrol = "SELECT * FROM uyeler WHERE kullanici_adi = '$kullanici_adi'";
                    $kullanici_kontrol_sonuc = mysqli_query($baglan,$kullanici_kontrol);
                    $kontrol = mysqli_num_rows($kullanici_kontrol_sonuc);
                if ($kontrol == 0){         
					$kullanici_kontrol = "SELECT * FROM uyeler WHERE uye_eposta='$eposta'";
                    $kullanici_kontrol_sonuc = mysqli_query($baglan,$kullanici_kontrol);
                    $kontrol = mysqli_num_rows($kullanici_kontrol_sonuc);
                if ($kontrol == 0){
					if($cinsiyet){
						$yeniadresi="erkek.png";
					}else{
						$yeniadresi="kadin.png";
					}
                    $sql="INSERT INTO uyeler SET adi_soyadi='$adi_soyadi', cinsiyet='$cinsiyet', dogum_tarihi='$dogum_tarihi', kullanici_adi='$kullanici_adi', 
					kullanici_sifre='$sifre', uye_profilfoto='$yeniadresi', uye_eposta='$eposta', uye_yetki='5'";
                    $sonuc=mysqli_query($baglan,$sql);
                if($sonuc == 1){
                message("success","check"," Başarılı", "Kaydınız başarılı bir şekilde alınmıştır. Lütfen yöneticinin onaylamasını bekleyiniz.");
				header("Refresh:3; url = http://localhost/proje/login", true, 303);
                }else{
					message("warning","exclamation-triangle"," Başarısız", "Kaydınız alınamamıştır. Lütfen tekrar deneyiniz.");
				}
				}else {
					message("warning","exclamation-triangle"," Hatalı", "E-posta Adresi daha önce alınmıştır. 
				Lütfen başka bir E-posta adresi ile tekrar deneyiniz.");
				}
				}else{
					message("warning","exclamation-triangle"," Başarısız", "Kullanıcı Adı daha önce alınmıştır. 
				Lütfen başka bir Kullanıcı Adı ile tekrar deneyiniz.");
				}
				}else{
					message("warning","exclamation-triangle"," Başarısız", "Şifreler Uyuşmuyor tekrar giriniz.");
				}
				}else{
					message("warning","exclamation-triangle"," Başarısız", "Tüm alanları doldurunuz.");
				}
                }else{
					message("warning","exclamation-triangle"," Başarısız", "Lütfen güvenligi dogrulayınız");
                }
            }
    ?>
      <form action="<?php $_SERVER["PHP_SELF"];?>" method="post">
	  <div class="row">
        <div class="form-group col-6">
		<label>Adınız</label>
          <input type="text" class="form-control" name="adi" value="<?php if($_POST) { echo $adi; } ?>" placeholder="Adınızı Giriniz" required>
        </div>
        <div class="form-group col-6">
		<label>Soyadınız</label>
          <input type="text" class="form-control" name="soyadi" value="<?php if($_POST) { echo $soyadi; } ?>" placeholder="Soyadınızı Giriniz" required>
        </div>
	</div>
	  <div class="row">
        <div class="form-group col-6">
		<label>Kullanızı Adınız</label>
          <input type="text" class="form-control" name="kullanici_adi" value="<?php if($_POST) { echo $kullanici_adi; } ?>" placeholder="Kullanıcı Adınızı Giriniz"required>
	  </div>
        <div class="form-group col-6">
		<label>Doğum Tarihiniz</label>
          <input type="date" class="form-control" name="dogum_tarihi" value="<?php if($_POST) {echo $dogum_tarihi;} ?>" required>
	  </div>
		</div>
	  <div class="row">
        <div class="form-group col-6">
		<label>E-Posta Adresiniz</label>
			<div class="input-group">
          <input type="email" class="form-control" name="e-posta" value="<?php if($_POST) {echo $eposta;} ?>" placeholder="E-posta Adresinizi Giriniz"required>
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>
		  </div>
	  </div>
        <div class="form-group col-6">
		<label>Cinsiyetiniz</label>
            <select class="form-control" name="cinsiyet">
                    <option value="0" <?php if($_POST){ if($cinsiyet == 0){echo "selected"; }}?> > Kadın </option>
                    <option value="1" <?php if($_POST){ if($cinsiyet == 0){echo "selected"; }}?> > Erkek </option>
            </select>
	  </div>
		</div>
	  <div class="row">
        <div class="form-group col-6">
		<label>Şifreniz</label>
        <div class="input-group">
          <input type="password" class="form-control" name="sifre" placeholder="Şifre Giriniz" required>
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
        </div>
		</div>
		<div class="form-group col-6">
		<label>Tekrar Şifreniz</label>
		<div class="input-group">
          <input type="password" class="form-control" name="sifre2" placeholder="Şifrenizi tekrar Giriniz" required>
          <div class="input-group-append"><div class="input-group-text"> <span class="fas fa-lock"></span></div></div>
        </div>
		</div>
		</div>
        <div class="row">
			<div class="col-md-6"><div class="g-recaptcha"  style="padding-left:20%;" data-sitekey="6LeKFZsaAAAAAGPwOBBuKCyscEUXqJTIqdo989Kh"></div></div><!-- Onay Kutusu  -->
          <div class="col-6 btn-group" style="padding: 2% 0;">
			<button type="submit" class="btn btn-primary  " >Kayıt Ol</button>
			<a href="index.php" type="submit" class="btn btn-danger  ">Vazgeç</a>
		</div>
        </div>
      </form>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
