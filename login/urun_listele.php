<div class="content">
<?php
if($_SESSION["uye_yetki"]<2){
	$query=mysqli_query($baglan,"Select * from  urunler");
	if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }
		$limit=7;
		$start_from = ($page-1) * $limit;
		$query = mysqli_query($baglan, "SELECT * FROM  urunler LIMIT $start_from, $limit");
		$query_number = mysqli_affected_rows($baglan);
		$query_number_records = mysqli_num_rows(mysqli_query($baglan, "SELECT * FROM  urunler"));  //kayıt sayısı
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
     <div class="content">
     <div class="container-fluid">
	 <div class="row">
	  <div class="col-md-12">
      <div class="card mt-4">
        <div class="card-body p-0" style="border:2px solid #CCC !important">
          <table class="table table-striped projects text-center text-nowrap">
              <thead style="font-size:12px !important;">
                  <tr>
					  <th>
                          Alt Kategori Bilgisi
                      </th>
                      <th>
                          Ürün Adı
                      </th>
					  <th>
						  Ürün Görseli
					  </th>
                      <th>
                          Ürün Fiyatı
                      </th>
                      <th>
					      Ürün Detay Bilgisi
                      </th>
					  <th>
					      Ürün Stok Bilgisi
                      </th>
					  <th>
					      Ürün Tarih
                      </th>
					  <th>
					      İşlemler
                      </th>
                  </tr>
              </thead>
              <tbody style="font-size:12px !important;">
			  <?php while($sorgu_satir = mysqli_fetch_array($query)){
				  ?>
			  <tr>
							<td><?php echo $sorgu_satir["kategori_alt_id"]; ?></td>
                            <td><?php echo $sorgu_satir["urun_adi"]; ?></td>
							<td><!-- urun fotoğraf olarak getirme kodları -->
								<a target="_blank" href="upload/urunfotolari/<?php echo $sorgu_satir["urun_gorsel"]; ?>">
									<img src="upload/urunfotolari/<?php echo $sorgu_satir["urun_gorsel"]; ?>" width="50" height="50" />
								</a>
							</td>
							<td><?php echo $sorgu_satir["urun_fiyat"] ?></td>
                            <td class="text-wrap"><?php echo $sorgu_satir["urun_detaybilgisi"] ?></td>
							<td><?php echo $sorgu_satir["urun_stokbilgisi"] ?></td>
							<td class="text-wrap"><?php echo $sorgu_satir["urun_tarih"] ?></td>
                            
                      <td class="project-actions text-wrap">
                          <a class="btn btn-info btn-sm mb-1 w-75"  href="yonetici.php?do=urun_duzenle&id=<?php echo $sorgu_satir['urun_id']; ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Düzenle
                          </a>
                          <a class="btn btn-danger btn-sm w-75" onclick="return del();" href="yonetici.php?do=urun_sil&id=<?php echo $sorgu_satir['urun_id']; ?>">
                              <i class="fas fa-trash">
                              </i>
                              Sil
                          </a>
                      </td>
                  </tr>
			  <?php }?>
              </tbody>
          </table>
		  <div class="col-md-12 text-center my-3" style="<?php if($total_pages<=1){ echo "display:none"; }?>">
		<?php echo'<span class="float-left mt-3">'.$baslangic.' - '.$end.' / '.$query_number_records.' gösteriliyor</span>'; ?>
		<div class="btn-group">
		<?php if($page!=1){
				echo'<a type="button" class="btn btn-info" href="yonetici.php?do=urun_listele&page=1"><i class="fa fa-fast-backward"></i></a>';
				}
				for ($i=1; $i<=$total_pages; $i++){
					echo'<a type="button" class="btn btn-info" href="yonetici.php?do=urun_listele&page='.$i.'">'.$i.'</a>';
				}
				if($page!=$total_pages){
					echo'<a type="button" class="btn btn-info" href="yonetici.php?do=urun_listele&page='.$total_pages.'"><i class="fa fa-fast-forward">
					</i></a>';
				}
		?>
		</div>
	</div>
        </div>
      </div>
    </div>
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