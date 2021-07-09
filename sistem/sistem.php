<?php
function tema_icerik($baglan){
	
		@$do=$_GET["do"];
		switch ($do){
			case "urun";
				require_once "tema/default/urun.php";
				break;
			case "urundetay";
				require_once "tema/default/urundetay.php";
				break;
			case "sepet";
				require_once "tema/default/sepet.php";
				break;
			case "iletisim";
				require_once "tema/default/iletisim.php";
				break;
			case "hakkimda";
				require_once "tema/default/hakkimda.php";
				break;
			default:
				require_once "tema/default/default.php";
				break;
	}
	}
	function message($message_pattern,$icon,$top_header_message,$message){ // mesaj şekilleri -> warning -- danger -- success iconlar ->(warning)exclamation-triangle -- (danger)ban -- (success)check
		echo'<div class="alert alert-'.$message_pattern.' alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fas  fa-'.$icon.'"></i> '.$top_header_message.'</h4>
			'.$message.'
		</div>';
	}
	function case_converter( $keyword){ // bütün harfleri büyütür
		$low = array('a','b','c','ç','d','e','f','g','ğ','h','ı','i','j','k','l','m','n','o','ö','p','r','s','ş','t','u','ü','v','y','z','q','w','x');
		$upp = array('A','B','C','Ç','D','E','F','G','Ğ','H','I','İ','J','K','L','M','N','O','Ö','P','R','S','Ş','T','U','Ü','V','Y','Z','Q','W','X');
		$keyword = str_replace( $low, $upp, $keyword );
		$keyword = function_exists( 'mb_strtoupper' ) ? mb_strtoupper( $keyword ) : $keyword;
		return $keyword;
	}
	function OzelKarakterTemizle($veri)
{
$veri =str_replace("`","",$veri);
$veri =str_replace("=","",$veri);
$veri =str_replace("&","",$veri);
$veri =str_replace("%","",$veri);
$veri =str_replace("!","",$veri);
$veri =str_replace("#","",$veri);
$veri =str_replace("<","",$veri);
$veri =str_replace(">","",$veri);
$veri =str_replace("*","",$veri);
$veri =str_replace("And","",$veri);
$veri =str_replace("'","",$veri);
$veri =str_replace("chr(34)","",$veri);
$veri =str_replace("chr(39)","",$veri);
return $veri;
}
function tarihfarki($tarih_gir){
	///girilecek olan tarihimizin arasındaki "-" işaretinin olması lazım.Örnek olarak 02-12-2006 gibi
$yeni_tarih=explode("-",$tarih_gir);
$ilk_gun=$yeni_tarih[0];
$ilk_ay=$yeni_tarih[1];
$ilk_yil=$yeni_tarih[2];
$son_gun=date("d");
$son_ay=date("m");
$son_yil=date("Y");
///burada aylarımızın kaç gün çektiğini değişkenlere aktarıyoruz
$ek[1]=31;
$ek[2]=28;
$ek[3]=31;
$ek[4]=30;
$ek[5]=31;
$ek[6]=30;
$ek[7]=31;
$ek[8]=31;
$ek[9]=30;
$ek[10]=31;
$ek[11]=30;
$ek[12]=31;

///önce yıl farkı varsa bundan doğan farkı GÜN olarak hesaplayalım
$yil_fark=($son_yil-$ilk_yil) * 365 ;
////for döngüsüyle ayları topluyorum
 for($i=1;$i<$son_ay;$i++){
  	@$son_ay_toplam=$son_ay_toplam+$ek[$i];
}
///şimdiki  gün ve ay  toplamımız
$toplam_son_gun=$son_ay_toplam+$son_gun;
////girilen ay'ı hesaplayalım
for($m=1;$m<$ilk_ay;$m++){
	@$ilk_ay_toplam=$ilk_ay_toplam+$ek[$m];
}
 ////girilen ay ve günü hesaplayalım
$toplam_ilk_gun=$ilk_ay_toplam+$ilk_gun;
return $toplam_son_gun-$toplam_ilk_gun+$yil_fark;
}
$indirim=mysqli_query($baglan, "select urun_id,indirim_bitis from urunler where indirimli_urun=1");
while($indirim_array=mysqli_fetch_array($indirim)){
	$urun_id=$indirim_array["urun_id"];
	if(date('d.m.Y H:i',strtotime('+1 hour'))>=date_format(date_create($indirim_array["indirim_bitis"]),"d.m.Y H:i"))
	{
		mysqli_query($baglan,"UPDATE urunler SET indirimli_urun=0, indirim_bitis='null', indirim_oran=0 where urun_id=$urun_id");
	}
}

?>