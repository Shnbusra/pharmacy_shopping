<div class="content">
<?php
if($_SESSION["uye_yetki"]<2){
		$query = mysqli_query($baglan, "SELECT slider.*,uyeler.kullanici_adi FROM slider INNER JOIN uyeler ON slider.uye_id=uyeler.uye_id");
?>
     <div class="content">
     <div class="container-fluid">
	 <div class="row">
      <!-- Default box -->
	  <div class="col-md-12">
      <div class="card mt-4">
        <div class="card-body p-0" style="border:2px solid #CCC !important">
          <table class="table table-striped projects text-center text-nowrap">
              <thead style="font-size:13px !important;">
                  <tr>
					  <th>
                          Slider<br />Sırası
                      </th>
                      <th>
                          Üst Başlık
                      </th>
                      <th>
                          Alt Başlık
                      </th>
                      <th>
                          Satın Al
                      </th>
                      <th>
                          Slider Ön Görsel
                      </th>
                      <th>
					      Arka Plan Görseli
                      </th>
					  <th>
					      Ekleyen
                      </th>
					  <th>
					      Slider Tarih
                      </th>
					  <th>
					      İşlemler
                      </th>
                  </tr>
              </thead>
              <tbody style="font-size:13px !important;">
			  <?php while($sorgu_satir = mysqli_fetch_array($query)){
				  ?>
			  <tr>
							<td><?php echo $sorgu_satir["slider_id"]; ?></td>
                            <td><?php echo $sorgu_satir["slider_ust_baslik"]; ?></td>
							<td><?php echo $sorgu_satir["slider_alt_baslik"]; ?></td>
                            <td><?php echo $sorgu_satir["slider_satinal_link"]; ?></td>
                            <td><!-- slider işlemlerinde ön görseleri fotopraf olarak getirme kodları -->
								<?php
									$slider_gorsel=explode(",",$sorgu_satir["slider_gorsel"]);
									for($j=0; $j<count($slider_gorsel); $j++){
										echo '<a target="_blank" href="upload/sliderfoto/'.$slider_gorsel[$j].'">
												<img src="upload/sliderfoto/'.$slider_gorsel[$j].'" width="50" height="50" style="margin-right:1%;" />
											</a>';
									}
								?>
							</td>
							<td><!-- slider işlemlerinde arka görseleri fotopraf olarak getirme kodları -->
								<a target="_blank" href="upload/sliderfoto/<?php echo $sorgu_satir["slider_arkaplan"]; ?>">
									<img src="upload/sliderfoto/<?php echo $sorgu_satir["slider_arkaplan"]; ?>" width="50" height="50" />
								</a>
							</td>
                            <td><?php echo $sorgu_satir["kullanici_adi"] ?></td>
							<td class="text-wrap"><?php echo $sorgu_satir["slider_tarih"] ?></td>
                            
                      <td class="project-actions text-wrap">
                          <a class="btn btn-info btn-sm mb-1 w-75"  href="yonetici.php?do=slider_duzenle&id=<?php echo $sorgu_satir['slider_id']; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Düzenle
                          </a>
                          <a class="btn btn-danger btn-sm w-75" onclick="return del();" href="yonetici.php?do=slider_sil&id=<?php echo $sorgu_satir['slider_id']; ?>">
                              <i class="fas fa-trash">
                              </i>
                              Sil
                          </a>
                      </td>
                  </tr>
			  <?php }?>
              </tbody>
          </table>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  </div>
    </div>
<?php 
	
		} else {
		message("danger","ban"," Başarısız", "Bu Sayfa İşlem Yapmak İçin Yetkiniz Yok. Lütfen bekleyiniz Yönetici sayfasını yönlendirliyorsunuz");
		header("Refresh:3; url = http://localhost/proje/login/yonetici.php?do=anasayfa", true, 303);
    }
		
?>
</div>