<?php
    require_once ("sistem/ayar.php");
	require_once ("sistem/sistem.php");
	if ($satir["site_durum"]=="1"){
		require"tema/default/index.php";
		
	}else{
		require"tema/default/sitekapali.php";
	}
?>