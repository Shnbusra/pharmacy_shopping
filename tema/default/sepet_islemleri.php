<?php
require_once("../../sistem/ayar.php");
function sepete_ekle($urun_bilgileri)
{
	if (isset($_SESSION["alisveris_karti"])) {
		$alisveris_karti = $_SESSION["alisveris_karti"];
		$urunler = $alisveris_karti["urunler"];
	} else {
		$urunler = array();
	}
	if (array_key_exists($urun_bilgileri->urun_id, $urunler)) {
		$urunler[$urun_bilgileri->urun_id]->adet++;
	} else {
		$urunler[$urun_bilgileri->urun_id] = $urun_bilgileri;
	}
	$toplam_tutar = 0;
	$toplam_adet = 0;
	foreach ($urunler as $urun) {
		//number format sondan iki virgülden sonra iki karakter alıyor ondalık kısmı nokta ile ayırıyor binlik kısmıda virgüle ayırıyor 
		// 1,152.15
		$urun->toplam_tutar = $urun->adet * number_format($urun->urun_fiyat-($urun->urun_fiyat/100*$urun->indirim_oran), 2, '.', ',');
		$toplam_tutar += $urun->toplam_tutar;
		$toplam_adet += $urun->adet;
	}
	$siparis_özeti["toplam_tutar"] = $toplam_tutar;
	$siparis_özeti["toplam_adet"] = $toplam_adet;
	$_SESSION["alisveris_karti"]["urunler"] = $urunler;
	$_SESSION["alisveris_karti"]["siparis_özeti"] = $siparis_özeti;
	//print_r($_SESSION["alisveris_karti"]);
	return $toplam_adet;
}
function sepet_sil($urun_id)
{
	if (isset($_SESSION["alisveris_karti"])) {
		$alisveris_karti = $_SESSION["alisveris_karti"];
		$urunler = $alisveris_karti["urunler"];
		if(array_key_exists($urun_id,$urunler)){
			unset($urunler[$urun_id]);
		}
		$toplam_tutar = 0;
		$toplam_adet = 0;
		foreach ($urunler as $urun) {
			$urun->toplam_tutar = $urun->adet * number_format($urun->urun_fiyat-($urun->urun_fiyat/100*$urun->indirim_oran), 2, '.', ',');
			$toplam_tutar += $urun->toplam_tutar;
			$toplam_adet += $urun->adet;
		}
		$siparis_özeti["toplam_tutar"] = $toplam_tutar;
		$siparis_özeti["toplam_adet"] = $toplam_adet;
		$_SESSION["alisveris_karti"]["urunler"] = $urunler;
		$_SESSION["alisveris_karti"]["siparis_özeti"] = $siparis_özeti;
		//print_r($_SESSION["alisveris_karti"]);
		return true;
	}
	
}
if (isset($_POST["islem"])) {
	$islem = $_POST["islem"];
	if ($islem == "Ekle") {
		@$adet=$_POST["adet"];
		$urun_id = $_POST["urun_id"];
		//object nesne olarak getirir arraysa dizi olarak getirir object kullanmamın sebebi cift tırnak ve köşeli parantez yerine okla kısa kodla haledilmiş oluyor. 
		$urun_getir = mysqli_fetch_object(mysqli_query($baglan, "SELECT urun_id,urun_fiyat,indirimli_urun,indirim_oran,urun_gorsel,urun_adi,urun_detaybilgisi FROM urunler WHERE urun_id='$urun_id'"));
		$urun_getir->adet = 1;
		
		echo sepete_ekle($urun_getir);
	} else if ($islem == "Sil") {
		$urun_id = $_POST["urun_id"];
		echo sepet_sil($urun_id);
		
	}
}
?>