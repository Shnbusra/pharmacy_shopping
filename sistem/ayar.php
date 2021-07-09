<?php
	# html En Üstünde Kullanılır #
	session_start();
	ob_start();
	//error_reporting(0);
	
    # Bağlantı Değişkenleri #
    
	$host="localhost";
	$kullanici="root";
	$sifre="";
	$veritabaniadi="proje";
	
	# MYSQL Bağlantısı #
	
	$baglan= mysqli_connect($host,$kullanici,$sifre,$veritabaniadi) or die(mysql_error());
    	
	# Ayarlar Tablosundaki Verileri Çektim #
	
	$query = mysqli_query($baglan, "select * from ayarlar");
	
	# Veri tabanındaki ayarlar tablosunda verileri dizi şeklinde satır değişkenine aktardı. #
	$satir = mysqli_fetch_array($query);
	
	mysqli_set_charset($baglan,"UTF-8");
	
	define ("TEMA_URL", $satir["site_url"]."/tema/".$satir["site_tema"]."/");
	define ("SİTE_URL", $satir["site_url"]."/");
?>