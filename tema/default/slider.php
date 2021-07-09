<?php 
$slider1=mysqli_fetch_array(mysqli_query($baglan, "select * from slider where slider_id=1"));
$slider2=mysqli_fetch_array(mysqli_query($baglan, "select * from slider where slider_id=2"));
$slider3=mysqli_fetch_array(mysqli_query($baglan, "select * from slider where slider_id=3"));
// slider 3 bölme sebebimiz farklı olması bir birinden
$slider2_gorsel=explode(",",$slider2["slider_gorsel"]); // veritabanından gelen slider görselinin parçalama işlemini yapmaktadır.
$slider3_gorsel=explode(",",$slider3["slider_gorsel"]);	
 ?>
<div id="rev_slider_3_1_wrapper" class="rev_slider_wrapper rev_no_pag fullwidthbanner-container" data-alias="amaza">
		<!-- slider başlangıç -->
		<div id="rev_slider_3_1" class="rev_slider fullwidthabanner" data-version="5.1.6">
			<ul>	
				<!-- SLIDE  1-->
				<li data-index="rs-6" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" 
				data-easeout="default" data-masterspeed="300"  data-thumb=""  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" 
				data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
					<img class="js__background_color rev-slidebg" src="assets/images/slides/transparent.png" data-background-color='#333333' alt=""  data-bgposition="center center" 
					data-bgfit="cover" data-bgrepeat="no-repeat" data-no-retina>
						<!-- Arka plan slider -->
						<div class="tp-caption   tp-resizeme" id="slide-6-layer-2" data-x=""  data-y="143" data-width="['none','none','none','none']" 
						data-height="['none','none','none','none']" data-transform_idle="o:1;" data-transform_in="s:100;e:Power2.easeInOut;" data-transform_out="s:300;s:300;" 
						data-start="500" data-responsive_offset="on">
							<img src="<?php echo SİTE_URL,"login/upload/sliderfoto/",$slider1["slider_arkaplan"]; ?>" alt="" width="665" height="153" data-ww="665px" 
							data-hh="153px" data-no-retina> 
						</div>
						<!-- ön plan slider -->
						<div class="tp-caption   tp-resizeme" id="slide-6-layer-3" data-x="32" data-y="25" data-width="['none','none','none','none']" data-height="['none','none','none','none']" data-transform_idle="o:1;" data-transform_in="x:left;s:600;e:Power0.easeIn;" data-transform_out="opacity:0;s:300;s:300;" data-start="500" data-responsive_offset="on">
							<img src="<?php echo SİTE_URL,"login/upload/sliderfoto/",$slider1["slider_gorsel"]; ?>" alt="" width="448" height="427" data-ww="448px" data-hh="427px" data-no-retina> 
						</div>
						<!-- Sabit yazı -->
						<div class="tp-caption   tp-resizeme shop-deal-2 title-border-bottom-2"  id="slide-6-layer-4" data-x="center" data-hoffset="264" data-y="108" 
						data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="y:-50px;opacity:0;s:500;e:Power2.easeInOut;" 
						data-transform_out="opacity:0;s:300;s:300;" data-start="800" data-splitin="none" data-splitout="none" data-responsive_offset="on">ALIŞVERİŞ FIRSATLARI</div>
						<!-- slider üst başlık -->
						<div class="tp-caption   tp-resizeme big-sale-title-2 text-wrap" style="font-size:20px !important" id="slide-6-layer-5" data-x="center" data-hoffset="264" data-y="164" data-width="['auto']" 
						data-height="['auto']" data-transform_idle="o:1;" data-transform_in="x:-50px;opacity:0;s:500;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;"
						data-start="800" data-splitin="none" data-splitout="none" data-responsive_offset="on"><?php echo $slider1["slider_ust_baslik"]; ?></div>
						<!-- slider alt başlık -->
						<div class="tp-caption   tp-resizeme p-text-2" id="slide-6-layer-6" data-x="center" data-hoffset="264" data-y="235" data-width="['auto']" 
						data-height="['auto']" data-transform_idle="o:1;" data-transform_in="x:50px;opacity:0;s:500;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;" 
						data-start="800" data-splitin="none" data-splitout="none" data-responsive_offset="on"><?php echo $slider1["slider_alt_baslik"]; ?></div>
						<!-- slider link -->
						<a href="<?php echo $slider1["slider_satinal_link"]; ?>" target="_blank"><div class="tp-caption rev-btn  tp-resizeme btn-check-it-out-2" id="slide-6-layer-8" data-x="center" data-hoffset="264" data-y="289" data-width="['auto']" 
						data-height="['auto']" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:0;e:Linear.easeNone;" 
						data-style_hover="c:rgba(0, 0, 0, 1.00);bg:rgba(255, 255, 255, 1.00);bc:rgba(0, 0, 0, 1.00);" data-transform_in="y:50px;opacity:0;s:500;e:Power2.easeInOut;" 
						data-transform_out="opacity:0;s:300;s:300;" data-start="800" data-splitin="none" data-splitout="none" data-responsive_offset="on">
						HEMEN SATIN AL</div></a>
				</li>
				<!-- SLIDE 2 -->
				<li data-index="rs-7" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" 
				data-masterspeed="300"  data-thumb=""  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" 
				data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
					<!-- Arka plan slider -->
					<img src="<?php echo SİTE_URL,"login/upload/sliderfoto/",$slider2["slider_arkaplan"]; ?>"  alt=""  width="1920" height="604" data-bgposition="center center" 
					data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
						<!-- Sağ ön plan slider -->
						<div class="tp-caption   tp-resizeme" id="slide-7-layer-10" data-x="right" data-hoffset="80" data-y="23" data-width="['none','none','none','none']" 
						data-height="['none','none','none','none']" data-transform_idle="o:1;" data-transform_in="x:50px;opacity:0;s:500;e:Power2.easeInOut;" 
						data-transform_out="opacity:0;s:300;s:300;" data-start="1580" data-responsive_offset="on"><img src="<?php echo SİTE_URL,"login/upload/sliderfoto/",$slider2_gorsel[0]; ?>" 
						alt="" width="228" height="467" data-ww="228px" data-hh="467px" data-no-retina></div>
						<!-- Sabit yazı -->
						<div class="tp-caption   tp-resizeme  title-border-bottom-2 shop-deal-2" id="slide-7-layer-4"  data-x="center" data-hoffset="" data-y="108" 
						data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;"  data-transform_in="y:-50px;opacity:0;s:500;e:Power2.easeInOut;" 
						data-transform_out="opacity:0;s:300;s:300;" data-start="800" data-splitin="none" data-splitout="none" data-responsive_offset="on">ALIŞVERİŞ FIRSATLARI</div>
						<!-- slider üst başlık -->
						<div class="tp-caption   tp-resizeme big-sale-title-2" id="slide-7-layer-5" data-x="center" data-hoffset="" data-y="164" data-width="['auto']" 
						data-height="['auto']" data-transform_idle="o:1;" data-transform_in="opacity:0;s:500;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;" 
						data-start="800" data-splitin="none" data-splitout="none" data-responsive_offset="on"><?php echo $slider2["slider_ust_baslik"]; ?></div>
						<!-- slider alt başlık -->
						<div class="tp-caption   tp-resizeme p-text-2" id="slide-7-layer-6" data-x="center" data-hoffset="" data-y="235" data-width="['auto']" data-height="['auto']" 
						data-transform_idle="o:1;" data-transform_in="y:50px;opacity:0;s:500;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;" data-start="800" 
						data-splitin="none" data-splitout="none" data-responsive_offset="on"><?php echo $slider2["slider_alt_baslik"]; ?></div>
						<!-- slider link -->
						<a href="<?php echo $slider2["slider_satinal_link"]; ?>" target="_blank"><div class="tp-caption rev-btn  tp-resizeme btn-check-it-out-2" id="slide-7-layer-8" data-x="center" data-hoffset="" data-y="289" data-width="['auto']" 
						data-height="['auto']" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:0;e:Linear.easeNone;" 
						data-style_hover="c:rgba(0, 0, 0, 1.00);bg:rgba(255, 255, 255, 1.00);bc:rgba(0, 0, 0, 1.00);" data-transform_in="y:50px;opacity:0;s:500;e:Power2.easeInOut;" 
						data-transform_out="opacity:0;s:300;s:300;" data-start="800" data-splitin="none" data-splitout="none" data-responsive_offset="on">HEMEN SATIN AL</div></a>
						<!-- Sol ön plan slider  -->
						<div class="tp-caption   tp-resizeme" id="slide-7-layer-9" data-x="59" data-y="26" data-width="['none','none','none','none']" 
						data-height="['none','none','none','none']" data-transform_idle="o:1;" data-transform_in="x:-50px;opacity:0;s:500;e:Power2.easeInOut;" 
						data-transform_out="opacity:0;s:300;s:300;" data-start="1580" data-responsive_offset="on"><img src="<?php echo SİTE_URL,"login/upload/sliderfoto/",$slider2_gorsel[1]; ?>" 
						alt="" width="260" height="437" data-ww="260px" data-hh="437px" data-no-retina></div>
				</li>
				<!-- SLIDE 3 -->
				<li data-index="rs-5" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" 
				data-easeout="default" data-masterspeed="300"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" 
				data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
					<!-- Arka plan slider -->
					<img src="<?php echo SİTE_URL,"login/upload/sliderfoto/",$slider3["slider_arkaplan"]; ?>"  alt=""  width="1920" height="450" data-bgposition="center center" data-bgfit="cover" 
					data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
						<!-- arka planda kalan slider -->
						<div class="tp-caption   tp-resizeme" id="slide-5-layer-2" data-x="262" data-y="15" data-width="['none','none','none','none']" 
						data-height="['none','none','none','none']" data-transform_idle="o:1;" data-transform_in="x:50px;opacity:0;s:400;e:Power4.easeInOut;" 
						data-transform_out="opacity:0;s:300;s:300;" data-start="500" data-responsive_offset="on">
							<img src="<?php echo SİTE_URL."login/upload/sliderfoto/".$slider3_gorsel[1]; ?>" alt="" width="228" height="467" data-ww="228px" data-hh="467px" data-no-retina> 
						</div>
						<!-- ön plan slider -->
						<div class="tp-caption   tp-resizeme" id="slide-5-layer-1" data-x="75" data-y="13" data-width="['none','none','none','none']" 
						data-height="['none','none','none','none']" data-transform_idle="o:1;" data-transform_in="x:-50px;opacity:0;s:200;e:Linear.easeNone;" 
						data-transform_out="x:-50px;opacity:0;s:300;s:300;" data-start="500" data-responsive_offset="on">
							<img src="<?php echo SİTE_URL,"login/upload/sliderfoto/",$slider3_gorsel[0]; ?>" alt="" width="260" height="437" data-ww="260px" data-hh="437px" data-no-retina>
						</div>
						<!-- Sabit yazı -->
						<div class="tp-caption tp-resizeme title-border-bottom shop-deal" id="slide-5-layer-3" data-x="550" data-y="80" data-width="['auto']" 
						data-height="['auto']" data-transform_idle="o:1;" data-transform_in="y:-50px;opacity:0;s:500;e:Linear.easeNone;" data-transform_out="opacity:0;s:300;s:300;"
						data-start="870" data-splitin="none" data-splitout="none" data-responsive_offset="on">ALIŞVERİŞ FIRSATLARI</div>
						<!-- slider üst başlık -->
						<div class="tp-caption tp-resizeme big-sale-title" style="font-size:32px !important" id="slide-5-layer-4" data-x="550" data-y="150" data-height="['auto']" data-transform_idle="o:1;" 
						data-transform_in="x:50px;opacity:0;s:300;e:Power2.easeInOut;" data-transform_out="x:-50px;opacity:0;s:300;s:300;" data-start="970" data-splitin="none" 
						data-splitout="none" data-responsive_offset="on"><?php echo $slider3["slider_ust_baslik"]; ?></div>
						<!-- slider alt başlık -->
						<div class="tp-caption tp-resizeme p-text" style="font-size:32px !important" id="slide-5-layer-6" data-x="550" data-y="240" data-width="['auto']" data-height="['auto']" 
						data-transform_idle="o:1;" data-transform_in="y:50px;opacity:0;s:300;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;" 
						data-start="870" data-splitin="none" data-splitout="none" data-responsive_offset="on"><?php echo $slider3["slider_alt_baslik"]; ?></div>
						<!-- slider link -->
						<a href="<?php echo $slider3["slider_satinal_link"]; ?>" target="_blank"><div class="tp-caption rev-btn  tp-resizeme btn-check-it-out" id="slide-5-layer-7" 
						data-x="550" data-y="308" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:0;e:Linear.easeNone;" 
						data-style_hover="c:rgba(74, 74, 74, 1.00);bg:rgba(255, 205, 2, 1.00);" data-transform_in="opacity:0;s:500;e:Power2.easeInOut;" 
						data-transform_out="opacity:0;s:300;s:300;" data-start="870" data-splitin="none" data-splitout="none" data-responsive_offset="on">HEMEN SATIN AL</div></a>
				</li>
			</ul>
			<div class="tp-bannertimer tp-bottom"></div>
		</div>
	</div><!-- SLIDER bitiş-->