<!DOCTYPE html>
<!-- sistem dosyasından ayar.php çekiyor 
session kullanıcı adını kontrol ediyor 
doluysa yonetici.php yönlendiriyor-->
<?php
    require_once "../sistem/ayar.php";
	require_once "../sistem/sistem.php";
	if(@$_SESSION["k_adi"] != ""){
		header("location: yonetici.php");
    }
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
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index2.html" class="h2"><b>Yönetici </b>Paneli</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Oturumunuzu Açın</p>
<?php
        if($_POST){
            $kullanici_adi=$_POST["kullanici_adi"];
            $kullanici_sifre =md5($_POST["kullanici_sifre"]);
			
            $response=$_POST["g-recaptcha-response"];  // Yanıt 
            $secret="6LeKFZsaAAAAAKPc1-9EXmYjQo4loZBQraPXgBTN"; // Gizli Anahtar KOdu
            $remoteip=$_SERVER["REMOTE_ADDR"]; // Kullanıcının İp Adresini Alma
            $captcha=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip"); // yukarıdaki değişkenleri file get methodu ile gönderiyoruz
            $result=json_decode($captcha); // Gönderdiğimiz dosya json değerler olduğu için json decode işlemi yapıyoruz ve değişkene aktarıyoruz 
                
				if($result->success==1){ // json decode işleminden sonra succes değeri eğer 1 ise yani true işlem başarılı mesajı veriyoruz eğer değeri 0 ise yani false ise hata mesjaı veriyoruz
                    
					$sql="SELECT * FROM uyeler WHERE kullanici_adi='$kullanici_adi' AND kullanici_sifre='$kullanici_sifre'";
                    $sonuc=mysqli_query($baglan,$sql);//kontrol ediyor gelen kişiyi
                    $donen_satir=mysqli_num_rows($sonuc);
                    
					if($donen_satir == 1){
                        $uye_sorgu = mysqli_query($baglan, $sql);
                        $uye_gelen_sorgu = mysqli_fetch_array($uye_sorgu);
                        
						if($uye_gelen_sorgu["uye_durum"] == 1){
                            $_SESSION["uye_id"] = $uye_gelen_sorgu["uye_id"];
                            $_SESSION["k_adi"] = $uye_gelen_sorgu["kullanici_adi"];
                            $_SESSION["uye_durum"] = $uye_gelen_sorgu["uye_durum"];
                            $_SESSION["uye_yetki"] = $uye_gelen_sorgu["uye_yetki"];
							message("success","check"," Başarılı", "Kullanıcı giriş başarıyla gerçekleşti");
                            $_SESSION["login_zaman"] = time();
							header("Refresh:3; url = http://localhost/proje/login/yonetici.php", true, 303);
                        }else{
							message("warning","exclamation-triangle"," Başarısız", "Site yönetici tarafından hesabınız onaylanmamıştır. 
							Lütfen hesabınızın onaylanmasını bekleyiniz");
                        } 
                    } else{
						message("warning","exclamation-triangle"," Başarısız", "Kullanıcı adı veya şifreniz hatalı...");
                    }
                }else{
					message("warning","exclamation-triangle"," Başarısız", "Lütfen güvenligi dogrulayınız");
                }
            }
?>
      <form action="<?php $_SERVER["PHP_SELF"];?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="kullanici_adi" placeholder="Kullanıcı Adı">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-alt"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="kullanici_sifre" placeholder="Şifre">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
		<div class="g-recaptcha ml-2" data-sitekey="6LeKFZsaAAAAAGPwOBBuKCyscEUXqJTIqdo989Kh"></div><!-- Onay Kutusu  -->
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Beni Hatırla
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Giriş</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">Şifremi unutum</a>
      </p>
      <p class="mb-0">
        <a href="kayitol.php" class="text-center">Kayıt ol</a>
      </p>
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
