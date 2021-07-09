<?php
    if($_SESSION["uye_yetki"] < 2){
?>
<div class="content">
  <div class="container-fluid">
     <div class="row">
          <div class="col-md-12">
            <div class="card mt-4">
              <div class="card-body">
			  <?php
                        $kayit_sorgu = mysqli_query($baglan, "SELECT * FROM sistemkayitlari inner join uyeler on sistemkayitlari.uye_id=uyeler.uye_id");// limitli kayıt
                        
              ?>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Açıklama</th>
                    <th>Yapılan İşlem</th>
                    <th>Yapan Kişi</th>
                    <th>Yapılan zaman</th>
                  </tr>
                  </thead>
					<?php while($sorgu_satir = mysqli_fetch_array($kayit_sorgu)){ ?>
                        <tr>
                            <td><?php echo $sorgu_satir["kayit_id"]; ?></td>
                            <td><?php echo $sorgu_satir["aciklama"]; ?></td>
                            <td><?php echo $sorgu_satir["yapilanislem"]; ?></td>
                            <td><?php echo $sorgu_satir["kullanici_adi"]; ?></td>
                            <td><?php echo $sorgu_satir["tarih"]; ?></td>
                        </tr>
                    <?php } ?>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>  
	  </div>
	</div>  
<?php
    }else{
        message("danger","ban"," Başarısız", "Bu Sayfa İşlem Yapmak İçin Yetkiniz Yok. Lütfen bekleyiniz Yönetici sayfasını yönlendirliyorsunuz");
        header("Refresh:3; url = http://localhost/proje/login/yonetici.php", true, 303);
    }
?>