
var $c = jQuery.noConflict();

$c(document).ready(function() {	
	
	//var ajaxurl = "wp-admin/admin-ajax.php";
	var ajaxurl = "http://alen-pc/cypress/wp-admin/admin-ajax.php";
	
	/**
	 * AJAX - PRODUCT CATEGORIES
	 * 
	 */
	var prettyPhotoMarkup = "<div class=\"pp_pic_holder\"> \
					<div class=\"ppt\">&nbsp;</div> \
					<div class=\"pp_top\"> \
						<div class=\"pp_left\"></div> \
						<div class=\"pp_middle\"></div> \
						<div class=\"pp_right\"></div> \
					</div> \
					<div class=\"pp_content_container\"> \
						<div class=\"pp_left\"> \
						<div class=\"pp_right\"> \
							<div class=\"pp_content\"> \
								<div class=\"pp_loaderIcon\"></div> \
								<div class=\"pp_fade\"> \
									<a href=\"#\" class=\"pp_expand\" title=\"Expand the image\"></a> \
									<div class=\"pp_hoverContainer\"> \
										<a class=\"pp_next\" href=\"#\"></a> \
										<a class=\"pp_previous\" href=\"#\"></a> \
									</div> \
									<div id=\"pp_full_res\"></div> \
									<div class=\"pp_details\"> \
										<div class=\"pp_nav\"> \
											<a href=\"#\" class=\"pp_arrow_previous\"></a> \
											<p class=\"currentTextHolder\">0/0</p> \
											<a href=\"#\" class=\"pp_arrow_next\"></a> \
										</div> \
										<p class=\"pp_description\"></p> \
										{pp_social} \
										<a class=\"pp_close\" href=\"#\"></a> \
									</div> \
								</div> \
							</div> \
							<div class=\"clearfix\"></div>\
						</div> \
						</div> \
					</div> \
					<div class=\"pp_bottom\"> \
						<div class=\"pp_left\"></div> \
						<div class=\"pp_middle\"></div> \
						<div class=\"pp_right\"></div> \
					</div> \
				</div> \
				<div class=\"pp_overlay\"></div>";
	
	
	$c(document).on("click", "a.ajax-products", function(e) {

		e.preventDefault();
		
		var aLink			= $c(this);
		var parentblock		= aLink.parent().parent().parent();
		var parentVars		= parentblock.find(".varsHolder");
		var block			= parentblock.find(".content-block");
		var cat_content		= block.find(".category-content");
		var cat_title		= block.find(".cat-title");
		var load_anim		= parentblock.find(".loading-animation");
		
		var t_ID			= aLink.attr("data-id");
		var taxonomy		= parentVars.attr("data-tax");
		var tax_name		= aLink.find(".term").text();
		var ptype			= parentVars.attr("data-ptype");
		var totitems		= parentVars.attr("data-totitems");
		var data_filters	= parentVars.attr("data-filters");
		var row				= parentVars.attr("data-row");
		var slider			= parentVars.attr("data-slider");
		var img				= parentVars.attr("data-img");
		var inslide			= parentVars.attr("data-inslide");
		var shop_assets		= parentVars.attr("data-shop_assets");
		
		// START ACTION:
		
		// 1 - remove all classes "current":
		$c("a.ajax-products").parent().removeClass("current"); // remove all "current" classes
		
		load_anim.slideToggle(300);
		// 2 - hide the cat title:		
		cat_title.delay(300).slideUp(
			300, 
			function() {
				
				$c(this).find(".wrap").html("<h3 class=\"ajax-category\">" + tax_name + "</h3>");
				
				block.stop(false,true).slideUp( 300, function() {
					
					$c(this).find(cat_content).empty();
					
					aLink.parent().addClass("current");

				});
			}
		);
		
		
		$c.ajax({
			type: "POST",
			url: ajaxurl,
			data: {"action": "load-filter", termID: t_ID, tax: taxonomy, post_type: ptype, total_items: totitems, filters: data_filters, in_row: row, use_slider: slider, img_format: img, in_slide: inslide, shop_assets: shop_assets  },
			success: function(response) {
				
				load_anim.slideToggle(300);
				
				if(tax_name) {
					cat_title.slideDown(300);
					var del = 300;
				}else{
					var del = 0;
				}
				// FILL UP WITH NEW CONTENT
				cat_content.html(response);		
				
				// SLIDE BACK DOWN:
				
				block.delay(del).slideDown("slow" , function() {
					$c.waypoints("refresh");
				});
				
				/*
				var contentHeight = cat_content.height();
				var firstChildHeight = cat_content.find(" > ol").height();
				 
				if( !cat_content.hasClass("contentslides") ) {
					block.stop(false,true).animate({"height": contentHeight,"opacity":1 },{duration: 600, easing: "easeOutQuart"});
				
				}else if( cat_content.hasClass("contentslides") ){
					
					block.stop(false,true).animate({"height": firstChildHeight,"opacity":1 },{duration: 600, easing: "easeOutQuart"});
				} */
				
				/* ****  SUPPORT FOR PLUGINS AND FUNCTIONS AFTER AJAX LOAD ***** */
				
				// HOVER EFFECT ON PROD. IMAGES:
				$c(function () {
		
					var itemImg = $c(".item-content").find(".item-img");
					
					$c("html").removeClass("csstransforms3d");
					
					itemImg.find(".back").css("opacity", 0 );
					
					itemImg.hover(
						function (event) {
							$c(this).find(".back").stop().animate({opacity: 1}, 500, "easeOutCubic");
						},
						function (event) {
							$c(this).find(".back").stop().animate({opacity: 0 }, 500, "easeOutCubic");			
						}
					);

				});
				
				// PRETTYPHOTO :
				$c("a[data-rel]").each(function() {
					$c(this).attr("rel", $c(this).data("rel"));
				});		
				$c("a[class^=\"prettyPhoto\"], a[rel^=\"prettyPhoto\"]").prettyPhoto(
					{	theme: "light_square",
						slideshow:5000, 
						social_tools: "",
						autoplay_slideshow:false,
						deeplinking: false,
						markup: prettyPhotoMarkup
					});
				
				// OWL CAROUSEL
				 
				if( cat_content.hasClass("contentslides") ) {
				
					var cs_navig	= cat_content.prev("input.slides-config").attr("data-navigation");
					var cs_pagin	= cat_content.prev("input.slides-config").attr("data-pagination");
					var cs_auto		= cat_content.prev("input.slides-config").attr("data-auto");
					
					cat_content.owlCarousel({
								singleItem			: true,
								autoPlay			: cs_auto == 0 ? false : true,
								stopOnHover			: true,
								navigation			: cs_navig == 1 ? true : false,
								pagination			: cs_pagin == 1 ? true : false,
								addClassActive		: false,
								autoHeight 			: true,
								mouseDrag			: true,
								rewindNav			: true,
								paginationNumbers	: false,
								navigationText		: ["&#xe16d;","&#xe170;"]
							});
					cs_navig = cs_pagin = cs_auto = "";
					
				}
				
				/**
				 * Wishlist / compare hover
				 * Temporary disabled
				 
				$c(".wishlist-compare > div").hover(function() {
		
						var parent = $c(this).parent();
						var hoverBox = $c(this).find(".hover-box");
						var leftPos = - ( hoverBox.outerWidth(true)/2 - $c(this).outerWidth(true)/2 );
						
						if( $c(this).hasClass("left") || parent.hasClass("left") ) {
							hoverBox.css("left", 0);
						}else if( $c(this).hasClass("right") || parent.hasClass("right") ) {
							hoverBox.css("left", "auto").css("right", 0);
						}else{
							hoverBox.css("left", leftPos);
						}
						
						hoverBox.fadeToggle(400);
					},
					function () {
						var hoverBox = $c(this).find(".hover-box");

						hoverBox.fadeToggle(150);
					}
				);
				*/
				

				return false;
				
			}
		});
			

	}); 
	$c(document).on("click", "a.ajax-posts", function(e) {

		e.preventDefault();
		
		var aLink			= $c(this);
		var parentblock		= aLink.parent().parent().parent();
		var parentVars		= parentblock.find(".varsHolder");
		var block			= parentblock.find(".content-block");
		var cat_content		= block.find(".category-content");
		var cat_title		= block.find(".cat-title");
		var load_anim		= block.find(".loading-animation");
		
		
		var t_ID			= aLink.attr("data-id");
		var taxonomy		= parentVars.attr("data-tax");
		var tax_name		= aLink.find(".term").text();
		var ptype			= parentVars.attr("data-ptype");
		var totitems		= parentVars.attr("data-totitems");
		var feat			= parentVars.attr("data-feat");
		var row				= parentVars.attr("data-row");
		var slider			= parentVars.attr("data-slider");
		var img				= parentVars.attr("data-img");
		var inslide			= parentVars.attr("data-inslide");
		var custom_img_w	= parentVars.attr("data-custom-img-w");
		var custom_img_h	= parentVars.attr("data-custom-img-h");
		var icons			= parentVars.attr("data-icons");
		var excerpt			= parentVars.attr("data-excerpt");
		var postmeta		= parentVars.attr("data-postmeta");
		var bl_style		= parentVars.attr("data-blockstyle");
		var taxmenu_style	= parentVars.attr("data-taxmenustlye");
		var blockID			= parentVars.attr("data-block-id");
		
		// START ACTION:
		
		// 1 - remove all classes "current":
		$c("a.ajax-posts").parent().removeClass("current"); // remove all "current" classes
		
		load_anim.slideToggle(300);
		// 2 - hide the cat title:		
		cat_title.delay(300).slideUp(
			300, 
			function() {
				
				$c(this).find(".wrap").html("<h3 class=\"ajax-category\">" + tax_name + "</h3>");
				
				block.stop(false,true).slideUp( 300, function() {
					
					$c(this).find(cat_content).empty();
					
					aLink.parent().addClass("current");

				});
			}
		);
		
		$c.ajax({
				type: "POST",
				url: ajaxurl,
				data: {"action": "load-filter2", termID: t_ID, tax: taxonomy, post_type: ptype, total_items: totitems, only_featured: feat, in_row: row, use_slider: slider, img_format: img, in_slide: inslide, custom_img_width: custom_img_w , custom_img_height: custom_img_h, display_icons: icons, display_excerpt: excerpt, display_postmeta: postmeta, block_style: bl_style, tax_menu_style: taxmenu_style, block_id: blockID  },
				success: function(response) {
					
				
					if(tax_name) {
						cat_title.slideDown(300);
						var del = 300;
					}else{
						var del = 0;
					}
					// FILL UP WITH NEW CONTENT
					cat_content.html(response);		
					
					// SLIDE BACK DOWN:
					
					block.delay(del).slideDown("slow" , function() {
						$c.waypoints("refresh");
					});
					
					
					
					
					/* SLIDE BACK DOWN:
					//var theSlider =  cat_content.parent();
					var contentHeight = cat_content.height();
					var firstChildHeight = cat_content.find(" > ol").height();
					if( !cat_content.hasClass("contentslides") ) {
						block.stop(false,true).animate({"height": contentHeight,"opacity":1 },{duration: 600, easing: "easeOutQuart"});
					}else if( cat_content.hasClass("contentslides") ){
						block.stop(false,true).animate({"height": firstChildHeight,"opacity":1 },{duration: 600, easing: "easeOutQuart"});
					}
					*/
					
					
					/*  SUPPORT FOR PLUGINS AND FUNCTIONS AFTER AJAX LOAD */
					
					// FLIPPING EFFECT ON ITEMS IMAGES:
					$c(function () {
			
						var itemImg = $c(".item-images").find(".item-img");
						
						$c("html").removeClass("csstransforms3d");
						
						itemImg.find(".back").css("opacity", 0 );
						
						itemImg.hover(
							function (event) {
								$c(this).find(".back").stop().animate({opacity: 1}, 500, "easeOutCubic");
							},
							function (event) {
								$c(this).find(".back").stop().animate({opacity: 0 }, 500, "easeOutCubic");			
							}
						);

					});
					
					
					// PRETTYPHOTO :
					$c("a[data-rel]").each(function() {
						$c(this).attr("rel", $c(this).data("rel"));
					});		
					$c("a[class^=\"prettyPhoto\"], a[rel^=\"prettyPhoto\"]").prettyPhoto(
						{	theme: "light_square",
							slideshow:5000, 
							social_tools: "",
							autoplay_slideshow:false,
							deeplinking: false,
							markup: prettyPhotoMarkup,
							ajaxcallback: function(){
								$c("video,audio").mediaelementplayer();
							}
						});
					
					// OWL CAROUSEL :
					if( cat_content.hasClass("contentslides") ) {
					var cs_navig	= cat_content.prev("input.slides-config").attr("data-navigation");
					var cs_pagin	= cat_content.prev("input.slides-config").attr("data-pagination");
					var cs_auto		= cat_content.prev("input.slides-config").attr("data-auto");
					
					cat_content.owlCarousel({
								singleItem			: true,
								autoPlay			: cs_auto == 0 ? false : true,
								stopOnHover			: true,
								navigation			: cs_navig == 1 ? true : false,
								pagination			: cs_pagin == 1 ? true : false,
								addClassActive		: false,
								autoHeight 			: true,
								mouseDrag			: true,
								rewindNav			: true,
								paginationNumbers	: false,
								navigationText		:["&#xe16d;","&#xe170;"]
							});
					cs_navig = cs_pagin = cs_auto = "";
					}
					/**
					 *	POST META and NAV TOGGLER: 
					 *
					 */
						
					$c(".post-meta-bottom .date_meta, .post-meta-bottom .user_meta, .post-meta-bottom .permalink, .post-meta-bottom .cat_meta ,.post-meta-bottom .tag_meta, .post-meta-bottom .comments_meta, .nav-single a").hover(function() {
							
							var parent = $c(this).parent();
							var hoverBox = $c(this).find(".hover-box");
							var leftPos = - ( hoverBox.outerWidth(true)/2 - $c(this).outerWidth(true)/2 );
							
							if( $c(this).hasClass("left") || parent.hasClass("left") ) {
								hoverBox.css("left", 0);
							}else if( $c(this).hasClass("right") || parent.hasClass("right") ) {
								hoverBox.css("left", "auto").css("right", 0);
							}else{
								hoverBox.css("left", leftPos);
							}
							
							hoverBox.fadeToggle(400);
						},
						function () {
							var hoverBox = $c(this).find(".hover-box");

							hoverBox.fadeToggle(150);
						}
					
					);
						
					$c.waypoints("refresh");
					
					return false;
					
				}
			});
			
			
			
	});
	
	$c(document).on("click", "a.quick-view", function(e) {

		e.preventDefault();
		
		$c("body").append("<div class=\"qv-overlay\"><div class=\"qv-holder woocommerce\" id=\"qv-holder\"><div class=\"loading-animation\">Loading quick view</div></div></div>");
		
		var aLink		= $c(this);
		var	prod_ID		= aLink.attr("data-id");
		var	qv_holder	= $c("#qv-holder");
		var qv_overlay	= $c(".qv-overlay");
		var	images		= qv_holder.find(".images");
		var load_anim	= qv_holder.find(".loading-animation");
		
		qv_overlay.fadeIn();
		
		qv_holder.fadeIn();
		
		// REMOVING ACTIONS:
		qv_holder.parent().on("click", function(e) {
			if(e.target == this) $c(this).fadeOut("slow", function() { this.remove(); });
		});
		
		$c.ajax({
		
			type: "POST",
			url: ajaxurl,
			data: { "action": "load-filter3", productID: prod_ID  },
			success: function(response) {
				
				load_anim.fadeToggle(500);
				
				// fill with response from server:
				qv_holder.html(response);
				
				
				// add QV window remover:
				qv_holder.append("<div class=\"message-remove\"></div>");
						
				// REMOVING ACTIONS:
				qv_holder.find(".message-remove").on("click", function(e) {
					qv_overlay.fadeOut("slow", function() { qv_overlay.remove(); });
				});
				
			} 
		});

	});
/**
 * end AJAX
 *
 */
 }) // end (document).ready; 