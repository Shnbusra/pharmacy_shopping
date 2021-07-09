<!DOCTYPE html>
<?php
    require_once "../sistem/ayar.php";
    require_once "../sistem/sistem.php";
    if($_SESSION["k_adi"]==""){
        header("location: index.php");
    }else{
        if(isset($_SESSION["k_adi"])){
            header("Refresh:5401",true);
            if(time() - $_SESSION["login_zaman"] > 6000){ //salise üzerinden 60 yazdıgın zaman 1 dk olur
                session_destroy();
                header("location: index.php");
            }
        }
    $k_adi=$_SESSION["k_adi"];
	$uye_id=$_SESSION["uye_id"];
	
	$girissorgusql="Select * from uyeler where uye_id='$uye_id'";
	$girissorgu=mysqli_query($baglan,$girissorgusql);
	$girissatir= mysqli_fetch_array($girissorgu); 
	@$do=$_GET["do"];
	
?>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="tr-TR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $satir["site_baslik"]; ?> | Admin Paneli</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="yonetici.php?do=anasayfa" class="nav-link">Anasayfa</a>
      </li>
    </ul>

   <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="yonetici.php?do=yonetici" class="brand-link">
      <img src="upload/adminlogo/<?php echo $satir["admin_logo"]; ?>" alt="Site Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Paneli</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="upload/profilfotolari/<?php echo $girissatir["uye_profilfoto"];?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="yonetici.php?do=profilim" class="d-block"><?php echo $k_adi; ?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item <?php if($do=="admin_kayit" or $do=="uye_islemleri" or $do=="uye_duzenle" or $do=="uye_sil"){ echo'menu-open'; }?>">
            <a href="#" class="nav-link <?php if($do=="admin_kayit" or $do=="uye_islemleri" or $do=="uye_duzenle" or $do=="uye_sil"){ echo'active'; }?>">
              <i class="fas fa-address-card"></i>
              <p>
                Üye İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="yonetici.php?do=admin_kayit" class="nav-link <?php if($do=="admin_kayit"){ echo'active'; }?>">
                  <i class="fas fa-user-plus"></i>
                  <p>Yeni Üye Ekle</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="yonetici.php?do=uye_islemleri" class="nav-link <?php if($do=="uye_islemleri" or $do=="uye_duzenle" or $do=="uye_sil"){ echo'active'; }?>">
                  <i class="fas fa-user-slash"></i>
                  <p>Düzenle/Sil</p>
                </a>
              </li>
            </ul>
          </li>
		  <li class="nav-item">
            <a href="yonetici.php?do=sistem_kayitlari" class="nav-link <?php if($do=="sistem_kayitlari"){ echo'active'; }?> m-0">
              <i class="nav-icon fas fa-clipboard m-0"></i>
              <p>
                Sistem Kayıtları
              </p>
            </a>
          </li>
		  <li class="nav-item <?php if($do=="ust_kategori_ekle" or $do=="ust_kategori_islemleri"){ echo'menu-open'; }?>">
            <a href="#" class="nav-link <?php if($do=="ust_kategori_ekle" or $do=="ust_kategori_islemleri"){ echo'active'; }?>">
              <i class="fas fa-list"></i>
              <p>
                Üst Kategori İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
				<a href="yonetici.php?do=ust_kategori_ekle" class="nav-link <?php if($do=="ust_kategori_ekle"){ echo'active'; }?>">
				  <i class="nav-icon fas fa-plus"></i>
				   <p>
				  Üst Kategori Ekle
				   </p>
				</a>
			</li>
              <li class="nav-item">
                <a href="yonetici.php?do=ust_kategori_islemleri" class="nav-link <?php if($do=="ust_kategori_islemleri"){ echo'active'; }?>">
                  <i class="fas fa-cogs"></i>
                  <p>
				  Üst Kategori Ayarları
				  </p>
                </a>
              </li>
            </ul>
          </li>
		  <li class="nav-item <?php if($do=="alt_kategori_ekle" or $do=="alt_kategori_islemleri"){ echo'menu-open'; }?>">
            <a href="#" class="nav-link <?php if($do=="alt_kategori_ekle" or $do=="alt_kategori_islemleri"){ echo'active'; }?>">
              <i class="fas fa-list"></i>
              <p>
                Alt Kategori İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
				<a href="yonetici.php?do=alt_kategori_ekle" class="nav-link <?php if($do=="alt_kategori_ekle"){ echo'active'; }?>">
				  <i class="nav-icon fas fa-plus"></i>
				   <p>
				  Alt Kategori Ekle
				   </p>
				</a>
			</li>
              <li class="nav-item">
                <a href="yonetici.php?do=alt_kategori_islemleri" class="nav-link <?php if($do=="alt_kategori_islemleri"){ echo'active'; }?>">
                  <i class="fas fa-cogs"></i>
                  <p>
				  Alt Kategori Ayarları
				  </p>
                </a>
              </li>
            </ul>
          </li>
		  <li class="nav-item <?php if($do=="urun_ekle" or $do=="urun_listele"){ echo'menu-open'; }?>">
            <a href="#" class="nav-link <?php if($do=="urun_ekle" or $do=="urun_listele"){ echo'active'; }?>">
              <i class="fas fa-list"></i>
              <p>
                Ürün İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
				<a href="yonetici.php?do=urun_ekle" class="nav-link <?php if($do=="urun_ekle"){ echo'active'; }?>">
				  <i class="nav-icon fas fa-plus"></i>
				   <p>
				  Ürün Ekle
				   </p>
				</a>
			</li>
              <li class="nav-item">
                <a href="yonetici.php?do=urun_listele" class="nav-link <?php if($do=="urun_listele"){ echo'active'; }?>">
                  <i class="fas fa-tags"></i>
                  <p>
				  Ürün Listesi
				  </p>
                </a>
              </li>
            </ul>
          </li>
		  <li class="nav-item <?php if($do=="slider_ekle" or $do=="slider_islemleri"){ echo'menu-open'; }?>">
            <a href="#" class="nav-link <?php if($do=="slider_ekle" or $do=="slider_islemleri"){ echo'active'; }?>">
              <i class="fas fa-sliders-h"></i>
              <p>
                Slider İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
				<a href="yonetici.php?do=slider_ekle&id=1" class="nav-link <?php if($do=="slider_ekle" and $_GET["id"]==1){ echo'active'; }?>">
				  <i class="nav-icon fas fa-plus"></i>
				   <p>
				  Slider 1 Ekle
				   </p>
				</a>
			</li>
			<li class="nav-item">
				<a href="yonetici.php?do=slider_ekle&id=2" class="nav-link <?php if($do=="slider_ekle" and $_GET["id"]==2){ echo'active'; }?>">
				  <i class="nav-icon fas fa-plus"></i>
				   <p>
				  Slider 2 Ekle
				   </p>
				</a>
			</li>
			<li class="nav-item">
				<a href="yonetici.php?do=slider_ekle&id=3" class="nav-link <?php if($do=="slider_ekle" and $_GET["id"]==3){ echo'active'; }?>">
				  <i class="nav-icon fas fa-plus"></i>
				   <p>
				  Slider 3 Ekle
				   </p>
				</a>
			</li>
              <li class="nav-item">
                <a href="yonetici.php?do=slider_islemleri" class="nav-link <?php if($do=="slider_islemleri"){ echo'active'; }?>">
                  <i class="fas fa-cogs"></i>
                  <p>
				  Slider Ayarları
				  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if($do=="hakkimda_duzenle" or $do=="hakkimda2_duzenle"){ echo'menu-open'; }?>">
            <a href="#" class="nav-link <?php if($do=="hakkimda_duzenle" or $do=="hakkimda2_duzenle"){ echo'active'; }?>">
              <i class="fas fa-chalkboard-teacher"></i>
              <p>
                Hakkımızda İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
				<a href="yonetici.php?do=hakkimda_duzenle" class="nav-link <?php if($do=="hakkimda_duzenle"){ echo'active'; }?>">
				  <i class="nav-icon fas fa-cog"></i>
				   <p>
				  Hakkımızda Düzenle
				   </p>
				</a>
			</li>
              <li class="nav-item  <?php if($do=="hakkimda2_ekle" or $do=="hakkimda2_islemleri" or $do=="hakkimda2_duzenle" or $do=="hakkimda2_sil"){ echo 'menu-open'; } ?>">
				<a href="#" class="nav-link <?php if($do=="hakkimda2_ekle" or $do=="hakkimda2_islemleri" or $do=="hakkimda2_duzenle" or $do=="hakkimda2_sil"){ echo 'active'; } ?>">
					<i class="nav-icon fas fa-home"></i>
					<p>Neden Biz Ayarları<i class="right fas fa-angle-left"></i></p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="yonetici.php?do=hakkimda2_ekle" class="nav-link  <?php if($do=="hakkimda2_ekle"){ echo 'active'; } ?>">
							<i class="nav-icon fas fa-plus"></i>&nbsp;&nbsp;
							<p>Neden Biz Ekle</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="yonetici.php?do=hakkimda2_islemleri" class="nav-link <?php if($do=="hakkimda2_islemleri"){ echo 'active'; } ?>">
						<i class="nav-icon fas fa-cogs"></i>
						<p>Neden Biz İşlemleri</p>
						</a>
					</li>
				</ul>
			</li>
            </ul>
          </li>
		  <li class="nav-item <?php if($do=="site_ayarlari" or $do=="bakimsayfasi"){ echo'menu-open'; }?>">
            <a href="#" class="nav-link <?php if($do=="site_ayarlari" or $do=="bakimsayfasi"){ echo'active'; }?>">
              <i class="fas fa-globe"></i>
              <p>
                Site İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
				<a href="yonetici.php?do=site_ayarlari" class="nav-link <?php if($do=="site_ayarlari"){ echo'active'; }?>">
				  <i class="nav-icon fas fa-cog"></i>
				   <p>
				  Site Ayarları
				   </p>
				</a>
			</li>
              <li class="nav-item">
                <a href="yonetici.php?do=bakimsayfasi" class="nav-link <?php if($do=="bakimsayfasi"){ echo'active'; }?>">
                  <i class="fas fa-cogs"></i>
                  <p>
				  Bakım Ayarları
				  </p>
                </a>
              </li>
            </ul>
          </li>
		  <li class="nav-item <?php if($do=="profilim" or $do=="sifre_guncelle"){ echo'menu-open'; }?>">
            <a href="#" class="nav-link <?php if($do=="profilim" or $do=="sifre_guncelle"){ echo'active'; }?>">
              <i class="fas fa-user-alt"></i>
              <p>
                Profil İşlemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
				<a href="yonetici.php?do=profilim" class="nav-link <?php if($do=="profilim"){ echo'active'; }?>">
				  <i class="nav-icon fas fa-user-cog"></i>
				   <p>
				  Profil
				   </p>
				</a>
			</li>
              <li class="nav-item">
                <a href="yonetici.php?do=sifre_guncelle" class="nav-link <?php if($do=="sifre_guncelle"){ echo'active'; }?>">
                  <i class="fas fa-key"></i>
                  <p>Şifre Güncelle</p>
                </a>
              </li>
            </ul>
          </li>
		 
          <li class="nav-item">
            <a href="yonetici.php?do=cikis_yap" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Çıkış Yap
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<?php
        @$do=$_GET["do"];
        if(file_exists("{$do}.php")){ //bu sayfa varmı?
            require("{$do}.php"); //sayfayı getir
        }else{
            require("anasayfa.php");//eger sayfa yoksa anasayfaya yönlendir 
        }
?>
    <!-- Main content -->
    
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer">
    
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 - <?php echo date("Y"); ?> <a href="#">Black Yazılım</a>,</strong> Tüm hakları saklıdır.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
    function del(){
        var agree=confirm("Bu içeriği silmek istediğinizden emin misiniz?\nBu işlem geri alınamaz!");
        if(agree){ 
            return true; 
        } else{ 
            return false;
        } 
    }
	function indirim() {
    if(document.getElementById('indirimli_urun').checked){
      document.getElementById('indirim_bitis').style.display = 'block';
      document.getElementById('indirim_oran').style.display = 'block';
    }else{
			document.getElementById('indirim_bitis').style.display = 'none';
		  document.getElementById('indirim_oran').style.display = 'none';
	  }
  }
</script>
</body>
</html>
<?php } ?>