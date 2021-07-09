(function($) {
	"use strict"; 
	
	var fixed_top = 0,
		lastScrollTop = 0,
		check_top = true,
		Core = {};
	
	$(document).ready(function(){
		Core.menu.init();
		Core.plugin.init();
		Core.module.init();
		return false;
	});
	
	$(window).bind("load",function(){
		Core.menu.autoCorrectSubMenu();
		Core.plugin.isotope.init();
		Core.plugin.parallax();
		Core.module.countDown();
		Core.plugin.map();
		return false;
	});
	
	$(window).on("resize",function(){
		Core.menu.autoCorrectSubMenu();
		Core.plugin.mapResize();
		return false;
	});
	
	$(window).on("scroll",function(){
		if ($(".js__menu_sticky").length){
			Core.menu.sticky(
				$(".js__menu_sticky"),
				$(".header").outerHeight(),
				$(this).scrollTop()
			);
		}
		return false;
	});
	
	Core.menu = {
		pageX : 0,
		pageY : 0,
		init : function(){
			Core.menu.button();
			$('.js__menu_close').on("click",function(){
				Core.menu.mobile.close();
				return false;
			});
			Core.menu.touch();
			Core.menu.mobile.toggleSubMenu();
			return false;
		},
		autoCorrectSubMenu : function(){
			if ($(".js__auto_correct_sub_menu").length){
				if( $(window).height() * 1.2 < $("#wrapper").height()){
					$(".js__auto_correct_sub_menu .menu > .simple-menu > .sub-menu").each(function(){
						var current_left = $(this).offset().left,
							window_width = $(window).width(),
							current_width = Core.func.childReturnWidth($(this),$(this).outerWidth());
						if (current_left + current_width > window_width){
							if (current_left < window_width - current_left){
								$(this).addClass("js__sub_menu_right");
							}else{
								$(this).addClass("js__sub_menu_left");
							}
						}else{
							$(this).addClass("js__sub_menu_right");
						}
					});
				}
			}
			return false;
		},
		button : function(){
			$('.js__menu_toggle').on( "click", function(){
				if ($('.js__menu_mobile').hasClass('js__menu_active')){
					Core.menu.mobile.close();
				}else{
					Core.menu.mobile.open();
				}
				return false;
			});
			return false;
		},
		sticky : function(selector,height,currentScrollTop){
			if (currentScrollTop > (height + 50)) {
				if (currentScrollTop > lastScrollTop){
					selector.removeClass("js__active");
				}else{
					selector.addClass("js__active");
				}
			} else {
				if (check_top === true){
					selector.removeClass("js__active");
				}
			}
			lastScrollTop = currentScrollTop;
			return false;
		},
		touch : function(){
			$(document).on("touchstart",function(event){
				var touch = event.originalEvent.touches[0] || event.originalEvent.changedTouches[0];
				Core.menu.pageX = touch.pageX;
				Core.menu.pageY = touch.pageY;
			});
			$(document).on("touchend",function(event){
				var touch = event.originalEvent.touches[0] || event.originalEvent.changedTouches[0];
				if (Core.menu.pageX + 100 < touch.pageX){
					Core.menu.mobile.close();
				}
				Core.menu.pageX = 0;
				Core.menu.pageY = 0;
			});
			return false;
		},
		mobile : {
			close : function(){
				$('.js__menu_mobile').removeClass('js__menu_active');
				$('html').removeClass('js__menu_active');
				$('#wrapper').css({
					"top" : 0
				});
				window.scrollTo(0,fixed_top);
				check_top = true;
				return false;
			},
			open : function(){
				check_top = false;
				fixed_top = window.scrollY;
				$('.js__menu_mobile').addClass('js__menu_active');
				$('html').addClass('js__menu_active');
				$('#wrapper').css({
					"top" : -fixed_top
				});
				return false;
			},
			toggleSubMenu : function(){
				$(".js__menu_drop").on("click",function(){
					$(this).toggleClass("js__active");
					$(this).next().stop().slideToggle(400);
					return false;
				});
				return false;
			}
		}
	}
	
	Core.module = {
		mcTimer : -1,
		DisplayFormat : "<div class='timer-day box'><span class='day timer-number'>%%D%%</span><span class='date-title'>Days</span></div><div class='timer-hour box'><span class='timer-number hour'>%%H%%</span><span class='date-title'>Hours</span></div><div class='timer-min box'><span class='min timer-number'>%%M%%</span><span class='date-title'>Mins</span></div><div class='timer-sec box'><span class='sec timer-number'>%%S%%</span><span class='date-title'>Secs</span></div>",
		CountStepper : -1,
		SetTimeOutPeriod : 0 ,
		
		init : function(){
			Core.module.SetTimeOutPeriod = (Math.abs(Core.module.CountStepper)-1)*1000 + 990;
			Core.module.dropDown("js__mobile_drop_down",true);
			Core.module.dropDown("js__drop_down",false);
			Core.module.css($(".js__background_image"),"background-image");
			Core.module.css($(".js__background_position"),"background-position");
			Core.module.css($(".js__background_repeat"),"background-repeat");
			Core.module.css($(".js__background_color"),"background-color");
			Core.module.css($(".js__opacity"),"opacity");
			Core.module.css($(".js__width"),"width");
			Core.module.tab(".js__tab","li");
			Core.module.popup.init();
			Core.module.gallery();
			Core.module.number();
			Core.module.toggleSlide();
			return false;
		},
		countDown : function(){
			if ($(".js__count_down_box").length){			
				$(".js__count_down_box").each(function(){
					var dthen = new Date($(this).attr("data-date-then"));
					var start_date = Date.parse($(this).attr("data-date-now"));
					var dnow = new Date(start_date);
					var ddiff = new Date((dthen)-(dnow));
					var gsecs = Math.floor(ddiff.valueOf()/1000);
					var iid = $(this).attr("id");
					Core.func.CountBack(gsecs,$(this), Core.module.mcTimer);
					Core.module.mcTimer++;
				});
			}
			return false;
		},
		css : function(selector,name,data){
			if (!data){
				data = name;
			}
			selector.each(function(){
				var raw = $(this).data(data);
				if (raw){
					var dict = {};
					dict[name] = raw
					$(this).css(dict);
				}
			});
			return false;
		},
		dropDown : function(selectorTxt,isMobile){
			var selector = $("." + selectorTxt);
			selector.each(function(){
				var current_selector = $(this);
				current_selector.on("click",".js__drop_down_button",function(event){
					event.preventDefault();
					if ($(window).width() < 1025 || isMobile == false){
						if (current_selector.hasClass("js__active")){
							current_selector.removeClass("js__active");
						}else{
							selector.removeClass("js__active");
							current_selector.addClass("js__active");
						}
					}
					return false;
				});
			});
			$("#wrapper").on("click",function(event){
				var selector = $(event.target);
				if (!(selector.hasClass(selectorTxt) || selector.parents("." + selectorTxt).length)){
					$("." + selectorTxt + ".js__active").removeClass("js__active");
				}
			});
			return false;
		},
		gallery : function(){
			$(".js__gallery").each(function(){
				var selector = $(this);
				selector.on("click",".js__thumb",function(event){
					event.preventDefault();
					if(!($(this).hasClass("js__active"))){
						var target = selector.find(".js__zoom_popup");
						target.children("img").prop("src",$(this).data("images"));
						target.data("zoom",$(this).data("zoom"));
						selector.find(".js__thumb").removeClass("js__active");
						$(this).addClass("js__active");
					}
					return false;
				});
			});
		},
		number : function(){
			$(".js__number").each(function(){
				var selector = $(this);
				selector.on("click",".js__plus",function(){
					var value = parseInt(selector.find(".js__target").val(),10);
					selector.find(".js__target").val(value + 1);
					return false;
				});
				selector.on("click",".js__minus",function(){
					var value = parseInt(selector.find(".js__target").val(),10);
					if (value > 0){
						selector.find(".js__target").val(value - 1);
					}
					return false;
				});
			});
			return false;
		},
		popup : {
			init : function(){
				$(".js__popup_open").on("click",function(event){
					event.preventDefault();
					Core.module.popup.open($($(this).data("target")));
					return false;
				});
				$(".js__popup_close").on("click",function(event){
					event.preventDefault();
					Core.module.popup.close($($(this).parents(".js__popup")));
					return false;
				});
				$(".js__zoom_popup").on("click",function(event){
					event.preventDefault();
					var images = $(this).data("zoom"),
						target = $($(this).data("target"));
					target.find(".js__popup_images").html('<img src="' + images + '" alt="" />');
					Core.module.popup.open(target);
					return false;
				});
				return false;
			},
			open : function(target){
				target.addClass("js__active");
				$("html").addClass("js__popup_opening");
				return false;
			},
			close : function(target){
				target.removeClass("js__active");
				if (!($(".js__popup.js__active").length)){
					$("html").removeClass("js__popup_opening");
				}
				return false;
			}
		},
		tab: function(name,index_name){
			$(".js__tab").each(function(){
				var selector = $(this);
				selector.on("click",".js__tab_control",function(event){
					var target = $(this).data("target");
					event.preventDefault();
					selector.find(".js__tab_content").removeClass("js__active");
					selector.find(".js__tab_control").removeClass("js__active");
					$(this).addClass("js__active");
					if (target){
						$(target).addClass("js__active");
					}else{
						var index;
						if (index_name){
							index = $(this).parents(index_name).first().index()
						}else{
							index = $(this).index()
						}
						
						selector.find(".js__tab_content").eq(index).addClass("js__active");
					}
					return false;
				});
			});
			return false;
		},
		toggleSlide: function(){
			$(".js__toggle_slide").each(function(){
				var selector = $(this);
				selector.on("click",".js__toggle_slide_control",function(){
					if (!($(this).hasClass("js__active"))){
						selector.find(".js__toggle_slide_content.js__active").slideUp(400);
						$($(this).data("target")).slideDown(400);
						$($(this).data("target")).addClass("js__active");
						selector.find(".js__toggle_slide_control.js__active").removeClass("js__active");
						$(this).addClass("js__active");
					}
					return false;
				});
			});
			return false;
		}
	}
	
	Core.func = {
		childReturnWidth : function(selector,current_width){
			if (selector.children("li").children(".sub-menu").length){
				var max_width = 0;
				selector.children("li").children(".sub-menu").each(function(){
					var this_width = Core.func.childReturnWidth($(this),current_width + $(this).outerWidth());
					if (this_width > max_width){
						max_width = this_width;
					}
				});
				return max_width;
			}else{
				return current_width;
			}
		},
		CountBack : function(secs,iid,mcTimer){
			var DisplayStr;
			if (secs < 0) {
				document.getElementById(iid).innerHTML = "";
				return;
			}
			DisplayStr = Core.module.DisplayFormat.replace(/%%D%%/g, Core.func.calcage(secs,86400,100000));
			DisplayStr = DisplayStr.replace(/%%H%%/g, Core.func.calcage(secs,3600,24));
			DisplayStr = DisplayStr.replace(/%%M%%/g, Core.func.calcage(secs,60,60));
			DisplayStr = DisplayStr.replace(/%%S%%/g, Core.func.calcage(secs,1,60));
			iid.html(DisplayStr);
			setTimeout(function(){Core.func.CountBack((secs + Core.module.CountStepper),iid,mcTimer)}, Core.module.SetTimeOutPeriod);
		},
		calcage : function(secs, num1, num2) {
			var s = ((Math.floor(secs/num1)%num2)).toString();
			if (s.length < 2) s = "0" + s;
			return "<b>" + s + "</b>";
		},
		getResponsiveSettings: function(selector){
			var responsive = selector.data("responsive"),
				json = [];
			if (responsive){
				while(responsive.indexOf("'") > -1){
					responsive = responsive.replace("'",'"');
				}
				var json_temp = JSON.parse(responsive);
				$.each(json_temp, function (key, data) {
					json[json.length] = {
						breakpoint: key,
						settings: {
							slidesToShow: data,
							slidesToScroll: data,
						}
					}
				});
			}
			return json;
		}
	}
	
	Core.plugin = {
		init : function(){
			Core.plugin.select2();
			Core.plugin.noUiSlider();
			Core.plugin.isotope.filter();
			Core.plugin.slick.init();
			return false;
		},
		select2 : function(){
			$(".js__select2").each(function(){
				var minResults = $(this).data("min-results"),
					classContainer = $(this).data("container-class");
				if (minResults){
					if (minResults == "Infinity"){
						$(this).select2({
							minimumResultsForSearch: Infinity,
						});
					}else{
						$(this).select2({
							minimumResultsForSearch: parseInt(minResults,10)
						});
					}
					if (classContainer){
						$(this).on("select2:open", function(){
							$(".select2-container--open").addClass(classContainer);
							return false;
						});
					}
				}else{
					$(this).select2();
				}
			});
			return false;
		},
		isotope : {
			init : function(){
				setTimeout(function(){
					$(".js__filter_isotope").each(function(){
						var selector = $(this);
						selector.find(".js__isotope_items").isotope({
							itemSelector: ".js__isotope_item",
							layoutMode: 'cellsByRow'
						});
					});
				},100);
				
				setTimeout(function(){
					$(".js__isotope_layout").each(function(){
						var selector = $(this);
						selector.isotope({
							itemSelector: ".js__isotope_item",
							layoutMode: 'packery'
						});
					});
				},100);
				return false;
			},
			filter : function(){
				$(".js__filter_isotope").each(function(){
					var selector = $(this);
					selector.on("click",".js__filter_control",function(event){
						event.preventDefault();
						if (!($(this).hasClass(".js__active"))){
							selector.find(".js__filter_control").removeClass("js__active");
							$(this).addClass("js__active");
							selector.find(".js__isotope_items").isotope({
								filter : $(this).data("filter")
							});
						}
						return false;
					});
				});
				return false;
			}
		},
		map: function(){
			if ($(".js__map").length){
				$(".js__map").each(function(){
					var id = $(this).attr("id"),
						lat = parseFloat($(this).data("lat")),
						lng = parseFloat($(this).data("lng"));
					
					if ($(this).hasClass("js__map_absolute")){
						var mapWidth = $(this).parents(".js__map_wrap").find(".js__map_target").offset().left;
						$(this).css({
							"width" : mapWidth
						})
					}
					
					var point = new google.maps.LatLng(lat, lng);
					
					var map = new google.maps.Map(document.getElementById(id), {
						zoom: 15,
						center: point
					});

					var image = 'assets/images/icon-map.png';
					var beachMarker = new google.maps.Marker({
						//position: {lat: lat, lng: lng},
						position: point,
						map: map,
						icon: image
					 });
					
				});
			}
			return false;
		},
		mapResize: function(){
			$(".js__map_absolute").each(function(){
				var mapWidth = $(this).parents(".js__map_wrap").find(".js__map_target").offset().left;
				$(this).css({
					"width" : mapWidth
				});
			});
			return false;
		},
		noUiSlider: function(){
			if ($(".js__slider_price").length){
				$(".js__slider_price").each(function(){
					var marginSlider = $(this).get(0),//return DOM Element
						output = $(this).data("output"),
						max = 	parseInt($(this).data("max"),10),
						start = parseInt($(this).data("start"),10),
						end = 	parseInt($(this).data("end"),10),
						min = 	parseInt($(this).data("min"),10);
					noUiSlider.create(marginSlider, {
						start: [ start, end ],
						margin: 30,
						step: 1,
						connect: true,
						range: {
							'min': min,
							'max': max
						}
					});
					if (output === "yes"){
						var wrap = $(this).parents(".js__slider_price_wrap");
						marginSlider.noUiSlider.on('update', function( values, handle ){
							var currency = wrap.find(".js__slider_price").data("currency");
							if (!(wrap.find(".js__text_min").length)){
								wrap.find(".noUi-handle-lower").append('<span class="js__text_min"></span>')
							}
							if (!(wrap.find(".js__text_max").length)){
								wrap.find(".noUi-handle-upper").append('<span class="js__text_max"></span>')
							}
							if (handle){
								wrap.find(".js__text_max").text(currency + parseInt(values[handle],10));
								wrap.find(".js__input_max").val(parseInt(values[handle],10));
							}else{
								wrap.find(".js__text_min").text(currency + parseInt(values[handle],10));
								wrap.find(".js__input_min").val(parseInt(values[handle],10));
							}
							return false;
						});
					}
				});
			}
		},
		parallax: function () {
			$('.js__parallax').each(function(){
				$(this).bind('inview', function (event, isInView, visiblePartX, visiblePartY) {
					if(isInView) {
						$(this).parallax();
					} else {
						$(this).css('background-position','');
					}
					return false;
				});
			});
			return false;
		},
		slick: {
			init : function(){
				$(".js__slickslider").each(function(){
					var arrow = ($(this).data("arrows") == true) ? true : false,
						dot = 	($(this).data("dots") == true) ? true : false;
					$(this).slick({
						arrows: arrow,
						dots: dot,
						slidesToShow: parseInt($(this).data("show"),10),
						slidesToScroll: parseInt($(this).data("show"),10),
						responsive: Core.func.getResponsiveSettings($(this))
					});
				});
				Core.plugin.slick.testimonials();
			},
			testimonials: function(){
				$(".js__testimonials_slickslider").each(function(){
					var main_slider = $(this).find(".js__main_slickslider"),
						thumb_slider = $(this).find(".js__thumb_slickslider");
					main_slider.slick({
						arrows: false,
						dots: true,
						asNavFor: '.js__thumb_slickslider'
					});
					thumb_slider.slick({
						arrows: true,
						dots: false,
						vertical: true,
						verticalSwiping: true,
						asNavFor: '.js__main_slickslider',
						slidesToShow: 3,
						slidesToScroll: 1
					});
					thumb_slider.on("click",".js__thumb",function(event){
						var index = $(this).data("index");
						event.preventDefault();
						main_slider.slick("slickGoTo",index);
						thumb_slider.slick("slickGoTo",index);
						return false;
					});
				});
				return false;
			}
		}
	}
	
})(jQuery);