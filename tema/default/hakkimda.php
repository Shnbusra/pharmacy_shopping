<?php 
$hakkimda=mysqli_fetch_object(mysqli_query($baglan, "select * from hakkimda"));
$hakkimda2=mysqli_query($baglan, "select * from hakkimda2");
?>
<div id="wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-7 col-xs-12 section-common">
				<img src="<?php echo SİTE_URL,"login/upload/hakkimda/",$hakkimda->hakkimda_gorsel; ?>" alt="">
			</div><!-- col -->
			<div class="col-md-5 col-xs-12 section-common">
				<h2 class="section-title small-spacing"><?php echo $hakkimda->hakkimda_baslik; ?></h2>
				<div class="clear"></div>
				<div class="text-content">
					<p><?php echo $hakkimda->hakkimda_aciklama; ?></p>
				</div>
			</div><!-- col -->
			<div class="col-md-12 col-xs-12 section-common">
				<h2 class="section-title center">Neden Biz?</h2>
				<div class="clear"></div>
				<div class="why-choose-us" style="padding:0;">
					<div class="row row-inline-block">
					<?php 
					while($hakkimda2getir=mysqli_fetch_object($hakkimda2)){
					?>
						<div class="col-sm-6 col-xs-12">
							<div class="item-why-choose-us">
								<div class="thumb"><image class="item" src="<?php echo SİTE_URL,"login/upload/hakkimda/",$hakkimda2getir->hakkimda2_gorsel; ?>"></image></div>
								<h2 class="title"><?php echo $hakkimda2getir->hakkimda2_baslik; ?></h2>
								<p><?php echo $hakkimda2getir->hakkimda2_aciklama; ?></p>
							</div>
						</div>
						<?php } ?>
					</div><!-- .row -->
				</div><!-- .why-choose-us -->
			</div><!-- col -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!--/#wrapper -->