<?php
if($_SESSION["uye_yetki"]< 2){

	if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }
		$limit=7;
		$start_from = ($page-1) * $limit;
		$query = mysqli_query($baglan, "SELECT * FROM uyeler LIMIT $start_from, $limit");
		$query_number = mysqli_affected_rows($baglan);
		$query_number_records = mysqli_num_rows(mysqli_query($baglan, "SELECT * FROM uyeler"));  //kayıt sayısı
		$total_pages = ceil($query_number_records / $limit);
		if($page==1){
			$baslangic=1;
			if($limit>$query_number_records){
				$end=$query_number_records;
			}else{
				$end=$limit;
			}
		}else{
			$baslangic=1;
			for($i=1; $i<$page; $i++){
				$baslangic+=$limit;
			}
			if($page==$total_pages){
				if($limit>=$query_number){
					$end=$query_number_records;
				}
			}else{
				if($limit>$query_number_records){
					$end=$query_number_records;
				}else{
					$end=$page*$limit;
				}
			}
		}

?>


 <!-- Content Wrapper. Contains page content -->
 
    <!-- Main content -->
    <div class="content">
     <div class="container-fluid">
	 <div class="row">
      <!-- Default box -->
	  <div class="col-md-12">
      <div class="card mt-4">
        <div class="card-body p-0" style="border:2px solid #CCC !important">
          <table class="table table-striped projects text-center">
              <thead style="font-size:13px !important;">
                  <tr>
                      <th>
                          İD
                      </th>
                      <th>
                          Kullanıcı Adı
                      </th>
                      <th>
                          Profil Fotoğrafı
                      </th>
                      <th>
                          Üye eposta
                      </th>
                      <th>
                          Üye durumu
                      </th>
                      <th>
					      Üye yetki
                      </th>
					  <th>
					      Üye kayıt zamanı
                      </th>
					  <th>
					      İşlemler
                      </th>
                  </tr>
              </thead>
              <tbody style="font-size:15px !important;">
			  <?php while($sorgu_satir = mysqli_fetch_array($query)){
				  if($sorgu_satir['uye_id']!=$uye_id){
				  ?>
			  <tr>
                            <td><?php echo $sorgu_satir["uye_id"]; ?></td>
                            <td><?php echo $sorgu_satir["kullanici_adi"]; ?></td>
							<td><a target="_blank" href="upload/profilfotolari/<?php echo $sorgu_satir["uye_profilfoto"]; ?>">
									<img src="upload/profilfotolari/<?php echo $sorgu_satir["uye_profilfoto"]; ?>" width="50" height="50" />
								</a></td>
                            <td><?php echo $sorgu_satir["uye_eposta"] ?></td>
                            <td>
                                <?php 
                                    if($sorgu_satir["uye_durum"] == 1){
                                        echo"<span class='badge badge-pill badge-success'>Onaylı</span>";
                                    }else{
                                        echo"<span class='badge badge-pill badge-danger'>Onaylı değil</span>";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                     if($sorgu_satir["uye_yetki"] == 0){
                                        echo"<span class='badge badge-pill badge-success'>Kurucu</span>";
                                     }else if($sorgu_satir["uye_yetki"] == 1){
                                        echo"<span class='badge badge-pill badge-primary'>Site yöneticisi</span>";
                                     }else if($sorgu_satir["uye_yetki"] == 2){
                                        echo"<span class='badge badge-pill badge-danger'>Editör</span>";
                                     }else if($sorgu_satir["uye_yetki"] == 3){
                                        echo"<span class='badge badge-pill badge-info'>Yazar</span>";
                                     }else if($sorgu_satir["uye_yetki"] == 4){
                                        echo"<span class='badge badge-pill badge-warning'>Okur</span>";
                                     }
                                 ?>
                            </td>
                            <td><?php echo $sorgu_satir["kayit_tarih"] ?></td>
                      <td class="project-actions text-right">
                          <a class="btn btn-info btn-sm" href="yonetici.php?do=uye_duzenle&id=<?php echo $sorgu_satir['uye_id']; ?>
								&k_adi=<?php echo $sorgu_satir['kullanici_adi']; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Düzenle
                          </a>
                          <a class="btn btn-danger btn-sm" onclick="return del();" href="yonetici.php?do=uye_sil&id=<?php echo $sorgu_satir['uye_id']; ?>
								&k_adi=<?php echo $sorgu_satir['kullanici_adi']; ?>&yetki=<?php echo $sorgu_satir['uye_yetki']; ?>">
                              <i class="fas fa-trash">
                              </i>
                              Sil
                          </a>
                      </td>
                  </tr>
			  <?php } }?>
              </tbody>
          </table>
			<div class="col-md-12 text-center my-3">
		<?php echo'<span class="float-left mt-3">'.$baslangic.' - '.$end.' / '.$query_number_records.' gösteriliyor</span>'; ?>
		<div class="btn-group">
		<?php if($page!=1){
				echo'<a type="button" class="btn btn-info" href="yonetici.php?do=uye_islemleri&page=1"><i class="fa fa-fast-backward"></i></a>';
				}
				for ($i=1; $i<=$total_pages; $i++){
					echo'<a type="button" class="btn btn-info" href="yonetici.php?do=uye_islemleri&page='.$i.'">'.$i.'</a>';
				}
				if($page!=$total_pages){
					echo'<a type="button" class="btn btn-info" href="yonetici.php?do=uye_islemleri&page='.$total_pages.'"><i class="fa fa-fast-forward">
					</i></a>';
				}
		?>
		</div>
	</div>

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