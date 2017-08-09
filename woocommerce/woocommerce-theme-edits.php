<?php
//
/** 
 *	WOOCOMMERCE check plugin existence
 *
 *	
 */
$cypress_woo_is_active = false;
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
	$cypress_woo_is_active = true; // using as global variable in theme for on/off woo functions and hooks
	
	if( defined('WOOCOMMERCE_VERSION') ) {
		$cypress_wc_version = WOOCOMMERCE_VERSION ;
	}
	
	$run_once = new run_once;
	if ($run_once->run('init_woo_theme_values')){
		init_woo_theme_values();
	}
	
}// endif
function cypress_wc_version_f( $vers_to_check ) {
	global $cypress_wc_version, $cypress_woo_is_active;
	if( ! $cypress_woo_is_active ) return;
	$version_is_higher = false;
	if ( version_compare( $cypress_wc_version, $vers_to_check ) >= 0 ) {
		$version_is_higher = true;
	}
	return $version_is_higher;
}
add_filter( 'cypress_wc_version','cypress_wc_version_f', 10, 1 );
// add major "WC 3.0.0" update class
function cypress_wc2_7( $classes ) {
	if( apply_filters( 'cypress_wc_version', '3.0.0' ) ) {
		$classes[] = "WC2.7";
	}
	return $classes;
}
add_filter('body_class', 'cypress_wc2_7' );

/**
 *	YITH WISHLIST check plugin existence 
 *
 */
$wishlist_is_active = false;
if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || class_exists( 'YITH_WCWL' ) ) {
	
	$wishlist_is_active = true; 
	
}

	function init_woo_theme_values() {
		//
		$shop_catalog_image_size = array(
			'width' => 300,
			'height' => 180,
			'crop' => 1
		);
		$shop_single_image_size = array(
			'width' => 300,
			'height' => 300,
			'crop' => 1
		);
		$shop_thumbnail_image_size = array(
			'width' => 80,
			'height' => 80,
			'crop' => 1
		);
		update_option('shop_catalog_image_size', $shop_catalog_image_size );
		update_option('shop_single_image_size', $shop_single_image_size );
		update_option('shop_thumbnail_image_size', $shop_thumbnail_image_size );
		//
		update_option( 'woocommerce_frontend_css','no' ); // IMPORTANT - theme's WOO template CSS instead of plugin's
		update_option( 'woocommerce_menu_logout_link','no' ); // remove "Logout" menu item	
		update_option( 'woocommerce_prepend_shop_page_to_urls','yes' );
		update_option( 'woocommerce_prepend_shop_page_to_products','yes' ); 
		update_option( 'woocommerce_prepend_category_to_products','yes' );
		//
	};
	
if( $cypress_woo_is_active ) {

	function wooc_init () {

		global $cypress_wc_version;
		
		add_theme_support( 'woocommerce' );
		
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
		
		if( is_admin() ) {
			
			function dequeue_select2() {
				wp_dequeue_style( 'select2' );
				wp_deregister_style( 'select2' );
			}
			add_action( 'wp_enqueue_scripts', 'dequeue_select2' );
			
		} 
		
	}
	add_action('init','wooc_init');	

	/**
	 *	NUMBER OF PRODUCTS ON PRODUCTS PAGE:
	 *
	 */
	add_filter('loop_shop_per_page', 'products_per_page' );
	if (!function_exists('products_per_page')) {
		function products_per_page () {
			global $of_cypress;
			$products_page_settings = !empty($of_cypress['products_page_settings']) ? $of_cypress['products_page_settings'] : '';
			$products_number =  $products_page_settings['Products per page'] ? $products_page_settings['Products per page'] : 6;
			return $products_number;
		}
	}
	/**
	 *	NUMBER OF COLUMNS IN PRODUCTS AND PROD. TAXNOMIES PAGE
	 *
	 */
	add_filter('loop_shop_columns', 'loop_columns');
	if (!function_exists('loop_columns')) {
		
		function loop_columns() {
			global $of_cypress;
			$products_page_settings = !empty($of_cypress['products_page_settings']) ? $of_cypress['products_page_settings'] : '';
			$columns =  $products_page_settings['Products columns'] ? $products_page_settings['Products columns'] : 4;
			
			return $columns;

		}
	}
	/**
	 *	NUMBERS FOR RELATED PRODUCTS
	 *
	 **/
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
	add_action( 'woocommerce_after_single_product_summary', 'cypress_output_related_products', 20);
	if ( ! function_exists( 'cypress_output_related_products' ) ) {
		function cypress_output_related_products() {
		
			global $of_cypress, $cypress_wc_version;
			
			$products_page_settings = !empty($of_cypress['products_page_settings']) ? $of_cypress['products_page_settings'] : '';
			
			$related_total =  $products_page_settings['Related total'] ? $products_page_settings['Related total'] : 4;
			$related_columns =  $products_page_settings['Related columns'] ? $products_page_settings['Related columns'] : 4;
			
			if ( version_compare( $cypress_wc_version, "2.1" ) >= 0 ) {
			
				$args = array(
					'posts_per_page' => $related_total,
					'columns' => $related_columns,
					'orderby' => 'rand'
				);
				woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
				
			} else {
				woocommerce_related_products( $related_total, $related_columns ); // Display 3 products in rows of 3
			}
		}
	}
	
	/**
	 *	NUMBERS FOR UPSELL PRODUCTS
	 *
	 **/
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15 );
	 
	if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
		function woocommerce_output_upsells() {
		
			global $of_cypress;
			$total	= $of_cypress['upsell_total'] ? $of_cypress['upsell_total'] : 3;
			$in_row	= $of_cypress['upsell_in_row'] ? $of_cypress['upsell_in_row'] : 3;
			
			woocommerce_upsell_display( $total, $in_row);
		}
	}
	
	//
	/**
	 *	AJAX UPDATER OF CART
	 *
	 */
	add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
				
		ob_start();
		$cart_count = WC()->cart->cart_contents_count;
		$cart_link = get_permalink( wc_get_page_id( 'cart' ));
		echo $cart_count ? '<a href="'. $cart_link .'" class="header-cart button" id="header-cart">' : '<div class="header-cart button" id="header-cart">';
		?>
			<div class="fs" aria-hidden="true" data-icon="&#x56;"></div>
			
			<span class="cart-contents">
			<?php 
			echo sprintf(_n('<span class="count">%d</span>', '<span class="count">%d</span>', WC()->cart->cart_contents_count, 'cypress'), WC()->cart->cart_contents_count);?>
			<?php echo WC()->cart->get_cart_total(); ?>
			</span>
			<div class="clearfix"></div>
			
		<?php
		echo $cart_count ? '</a>' : '</div>';
		$fragments['.header-cart'] = ob_get_clean();
		
		return $fragments;
	}
	/**
	 *	PRODUCTS / PROD.ARCHIVE PAGE IMAGE:
	 *
	 */
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'cypress_loop_product_thumbnail', 20 );
	//
	if ( ! function_exists( 'cypress_loop_product_thumbnail' ) ) {

		function cypress_loop_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
			
			global $post, $product, $yith_wcwl, $of_cypress;
			
			$products_settings = !empty($of_cypress['products_settings']) ? $of_cypress['products_settings'] : '';
			
			// get image format from theme options:
			$of_imgformat = $of_cypress['shop_image_format'];
			if( $of_imgformat == 'as-portrait' ||  $of_imgformat == 'as-landscape' ){
				$img_format = $of_imgformat;
			}else{
				$img_format = 'shop_catalog';
			}
			
			$title = apply_filters( 'archive_product_title', '<a href="' . get_permalink(). '" title="'. esc_attr( $post->post_title ) .'"><h3>'. get_the_title(). '</h3></a>' );
			
			
			echo '<div class="front">';
			
			function_exists('woocommerce_show_product_loop_sale_flash') ? woocommerce_show_product_loop_sale_flash() : '';
				
			echo as_image( $img_format ); 
			
			echo '</div>';
			
			echo '<div class="back">';
			
				echo '<div class="item-overlay"></div>';
				
				echo $title;
				
				function_exists('woocommerce_template_loop_rating') ? woocommerce_template_loop_rating() : '';
				
				do_action( 'woocommerce_after_shop_loop_item_title' );
			
				// 3.0.0 < Fallback conditional
				if( apply_filters( 'cypress_wc_version', '3.0.0' )	) {
					$attachment_ids   = $product->get_gallery_image_ids();
				}else{
					$attachment_ids   = $product->get_gallery_attachment_ids();
				}
		
				
				if ( !empty( $attachment_ids ) ) {
					$image_url	= wp_get_attachment_image_src( $attachment_ids[0], 'large'  );
					$img_url	= $image_url[0];
					$imgSizes	= all_image_sizes(); // as custom fuction
					$img_width	= $imgSizes[$img_format]['width'];
					$img_height = $imgSizes[$img_format]['height'];
					
					echo '<img src="'. fImg::resize( $img_url ,$img_width, $img_height, true  ) .'" alt="'. esc_attr($post->post_title) .'" class="back-image" />';
										
				}else{
					echo as_image( $img_format );
				}
		
				echo '<div class="back-buttons">';
					
					if( !isset($products_settings['disable_zoom_button']) ) {
						echo '<a href="'.as_get_full_img_url().'" class="button" data-rel="prettyPhoto" title="'. esc_attr($post->post_title) .'"><div class="fs" aria-hidden="true" data-icon="&#xe022;"></div></a>';
					}
					if( !isset($products_settings['disable_link_button']) ) {
						echo '<a href="'. get_permalink() .'" class="button" title="'. esc_attr($post->post_title) .'"><div class="fs" aria-hidden="true" data-icon="&#xe065;"></div></a>';
					}
					
				
				echo '</div>';
				
			echo '</div>';

		}
	}
	/**
	 *	CHANGE WOOCOMMERCE PLACEHOLDER IMAGE
	 *
	 */
	remove_filter('woocommerce_placeholder_img_src','woocommerce_placeholder_img_src');
	add_filter('woocommerce_placeholder_img_src','cypress_placeholder_img_src');
	function cypress_placeholder_img_src () {
		global $of_cypress;
		return $of_cypress['placeholder_image'];
	}
	/**
	 *	REMOVE WOO TITLE from PRIMARY div to head (like blog single page title)
	 *	
	 */
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	add_action( 'as_single_product_summary', 'woocommerce_template_single_title', 5 );
	//
	/**
	 *	DEQUEUE PRETTYPHOTO FROM WOOC. PLUGIN IN FAVOUR OF THEME'S PRETTYPHOTO
	 *	
	 */

	function prettyPhoto_dequeue () {
		
		wp_dequeue_style('woocommerce_prettyPhoto_css');
		wp_deregister_style('woocommerce_prettyPhoto_css');
		
		wp_dequeue_script('prettyPhoto');
		wp_dequeue_script('prettyPhoto-init');
	}
	add_action( 'wp_enqueue_scripts','prettyPhoto_dequeue', 1000 );

	/**
	 * Changing order in single product
	 *
	 */
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );

	/**
	 *	Quick view images
	 *
	 */
	add_action( 'product_quick_view_images', 'quick_view_images', 25 );
	function quick_view_images() {
		
		global $post, $woocommerce, $product, $of_cypress;
		
		// get image format from theme options:
		$of_imgformat = $of_cypress['quick_view_image_format'];
		if( $of_imgformat == 'as-portrait' ||  $of_imgformat == 'as-landscape' ){
			$img_format = $of_imgformat;
		}else{
			$img_format = 'shop_single';
		}
		
		// 3.0.0 < Fallback conditional
		if( apply_filters( 'cypress_wc_version', '3.0.0' )	) {
			$attachment_ids   = $product->get_gallery_image_ids();
		}else{
			$attachment_ids   = $product->get_gallery_attachment_ids();
		}
		
		echo '<div class="images'. ($attachment_ids ? ' productslides'  : '') .'">';
		
		/* Main product image - post thumbnail (featured image etc.)*/
		if ( has_post_thumbnail() ) {
			
			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', $img_format ), array(
				'title' => $image_title
				) );
			$attachment_count   = count( $attachment_ids );
			$product_link		= esc_attr( get_permalink() );

			echo apply_filters( 'woocommerce_single_product_image_html',sprintf('<div class="item-img"><a href="%4$s" class="woocommerce-main-image zoom" itemprop="image">%3$s</a></div>',
			
			 $image_link,	// 1
			 $image_title,	// 2
			 $image,		// 3
			 $product_link	// 4
			 ),  $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ) );

		}
		
		/* Product gallery images*/
		if ( $attachment_ids ) {

			$loop = 0;
			$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

			foreach ( $attachment_ids as $attachment_id ) {

				$classes = array( 'zoom' );

				if ( $loop == 0 || $loop % $columns == 0 )
					$classes[] = 'first';

				if ( ( $loop + 1 ) % $columns == 0 )
					$classes[] = 'last';

				$image_link = wp_get_attachment_url( $attachment_id );

				if ( ! $image_link )
				
					continue;
				$image_title = esc_attr( get_the_title( $attachment_id ) );
				$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', $img_format ), array(
					'title' => $image_title
					));
				$image_class = esc_attr( implode( ' ', $classes ) );
				

				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="item-img">
	%4$s</div>', 
				$image_link, 
				$image_class, 
				$image_title, 
				$image ), $attachment_id, $post->ID, $image_class );
				
				$loop++;
			}

		}
		echo '</div>';//. images
	}

	/**
	 *	Single product display images
	 *
	 *	- used in as-single-product-block.php and content-single.product.php
	 */
	add_action( 'do_single_product_images', 'single_product_images', 25, 1 );
	function single_product_images( $img_format = 'shop_single') {
		
		global $post, $woocommerce, $product, $of_cypress;
		
		
		// get image format from theme options for SINGLE PRODUCT:
		$of_imgformat = $of_cypress['single_product_image_format'];
		
		if( is_product()) { /* if on single product page: */
		
			if( $of_imgformat == 'plugin' ) {
				$img_format = 'shop_single';
			}else{
				$img_format = $of_imgformat;
			}
			
		}else{ /* if not on single product (single block or quick view):*/
			
			$img_format = $img_format;
		}
		
		// 3.0.0 < Fallback conditional
		if( apply_filters( 'cypress_wc_version', '3.0.0' )	) {
			$attachment_ids   = $product->get_gallery_image_ids();
		}else{
			$attachment_ids   = $product->get_gallery_attachment_ids();
		}
		
		echo '<div class="'. ($attachment_ids ? 'owl-carousel singleslides'  : '') .' images">';
		
		/* Main product image - post thumbnail (featured image etc.)*/
		if ( has_post_thumbnail() ) {
		
			$post_thumb_id				= get_post_thumbnail_id();
			$default_product_image_src	= wp_get_attachment_image_src( $post_thumb_id, $img_format );
			$default_product_image_url  = $default_product_image_src[0];

			$image_link  		= wp_get_attachment_url( $post_thumb_id );
			$image_class 		= 'attachment-' . $post_thumb_id ;
			$image_title 		= strip_tags( get_the_title( $post_thumb_id ) ) ;
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', $img_format ), array(
				'title' => esc_attr( $image_title ),
				'alt'	=> esc_attr( $image_title ),
				'class'	=> esc_attr( $image_class. ' featured' )
				) );
			$full_image			= as_get_full_img_url();
			$product_title		= esc_attr( strip_tags(get_the_title()));
			$product_link		= esc_attr( get_permalink() );

			echo apply_filters( 'woocommerce_single_product_image_html',sprintf('<div class="item-content"><div class="item-img"><div class="front">%1$s</div><div class="back"><div class="item-overlay"></div><div class="back-buttons"><a href="%2$s" data-o_href="%2$s" data-zoom-image="%4$s" class="larger-image-link button woocommerce-main-image zoom" itemprop="image" data-rel="prettyPhoto[pp_gal-'.$post->ID.']" title="%3$s"><div class="fs" aria-hidden="true" data-icon="&#xe022;"></div></a></div></div></div></div>',
			
				$image,						// %1$s
				$full_image,				// %2$s
				$product_title,				// %3$s
				$default_product_image_url	// %4$s

			),  $post->ID );

		} else {
			
			$image						= wc_placeholder_img_src ();
			$full_image					= as_get_full_img_url();
			$product_title				= esc_attr( strip_tags(get_the_title()));
			$default_product_image_url	= wc_placeholder_img_src ();
			
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="item-content"><div class="item-img"><div class="front"><img src="%1$s" class="featured"></div><div class="back"><div class="item-overlay"></div><div class="back-buttons"><a href="%2$s" data-o_href="%2$s" data-zoom-image="%4$s" class="larger-image-link button woocommerce-main-image zoom" itemprop="image" data-rel="prettyPhoto[pp_gal-'.$post->ID.']" title="%3$s"><div class="fs" aria-hidden="true" data-icon="&#xe022;"></div></a></div></div></div></div>', 
				$image,						// %1$s
				$full_image,				// %2$s
				$product_title,				// %3$s
				$default_product_image_url	// %4$s
			) );

		}
		
		/**
		 *	Product gallery images
		 *
		 */
		if ( $attachment_ids ) {

			$loop = 0;
			$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

			foreach ( $attachment_ids as $attachment_id ) {

				$classes = array( 'zoom' );

				if ( $loop == 0 || $loop % $columns == 0 )
					$classes[] = 'first';

				if ( ( $loop + 1 ) % $columns == 0 )
					$classes[] = 'last';

				$image_link = wp_get_attachment_url( $attachment_id );

				if ( ! $image_link )
					continue;
				$image_class	= esc_attr( implode( ' ', $classes ) );
				$image_title	= esc_attr( get_the_title(  ) );
				$image			= wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', $img_format ), array(
					'title' => $image_title
					));
				$attachment_src = wp_get_attachment_image_src( $attachment_id, 'large' );
				
				$full_image		= $attachment_src[0];
				$product_title	= esc_attr(get_the_title());
				$product_link	= esc_attr( get_permalink() );
				
				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="item-content"><div class="item-img"><div class="front">%4$s</div><div class="back"><div class="item-overlay"></div><div class="back-buttons"><a href="%5$s" class="button" data-rel="prettyPhoto[pp_gal-'.$post->ID.']" title="%6$s"><div class="fs" aria-hidden="true" data-icon="&#xe022;"></div></a> %7$s </div></div></div></div>', 
					$image_link,	// 1
					$image_class,	// 2
					$image_title,	// 3
					$image,			// 4
					$full_image,	// 5
					$product_title,	// 6
					is_product() ? null : '<a href="'.$product_link .'" class="button" title="%6$s"><div class="fs" aria-hidden="true" data-icon="&#xe065;"></div></a>'	// 7
					
				), $attachment_id, $post->ID, $image_class );
				
				$loop++;
			}

		}
		echo '</div>';//. images
	}
	if ( ! function_exists( 'as_get_product_search_form' ) ) {

		/**
		 * Output Product search forms - AS edit.
		 *
		 * @access public
		 * @param bool $echo (default: true)
		 * @return void
		 */
		function as_get_product_search_form( $echo = true  ) {
			do_action( 'as_get_product_search_form'  );

			$search_form_template = locate_template( 'product-searchform.php' );
			if ( '' != $search_form_template  ) {
				require $search_form_template;
				return;
			}

			$form = '<div class="searchform-menu"><form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">

					<input type="search" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search for:', 'woocommerce' ) . '" />
					<button type="submit" class="icon-search" id="searchsubmit"></button>
					<input type="hidden" name="post_type" value="product" />
				
			</form></div>';

			if ( $echo  )
				echo apply_filters( 'as_get_product_search_form', $form );
			else
				return apply_filters( 'as_get_product_search_form', $form );
		}
	}
	
	/**
	 *	SHOP META BOX handling
	 *
	 *	- removing shop meta box if current page is not registered in WooCommerce as shop base
	 *	always removing "catalog-pre" meta box, EXCEPT if:  current edited page id == shop base page id
	 *	
	 *	admin hooks: load-"ADMIN-PAGE"
	 */
	add_action( 'load-post.php', 'only_shop_page_meta' );
	function only_shop_page_meta() {

		$shop_base_id	= wc_get_page_id('shop');
		
		if( isset($_GET['post']) && $_GET['post'] != $shop_base_id  ) {
		
			remove_meta_box( 'catalog-page-meta-box', 'page', 'normal' );
		}
		
	}
	add_action( 'load-post-new.php', 'remove_shop_page_meta' );
	function remove_shop_page_meta() {

		remove_meta_box( 'catalog-page-meta-box', 'page', 'normal' );
	
	}
	
	
	/**
	 *	AS WISHLIST - extending and changing YITH WISHLIST plugin ( plugin must be installed )
	 */
	if( class_exists( 'YITH_WCWL_UI' ) ) {
			
		add_action('as_wishlist_button','as_wishlist_button_func', 10);
		function as_wishlist_button_func() {
				
			yith_wcwl_get_template( 'add-to-wishlist.php' );
	
		}
		
		/* end AS WISHLIST */
		
		/*
		 *	REMOVE ANNONYMOUS YITH HOOKS
		 *	
		 *	- remove single product yith wishlist button, which is created
		 *  with anonymous function
		 */
		
		add_action('remove_YITH_wishlist_hooks', 'remove_anonymous_YITH_hooks');
		function remove_anonymous_YITH_hooks() {
			
			remove_anonymous_function_filter(
				'woocommerce_single_product_summary',
				YITH_WCWL_DIR . 'class.yith-wcwl-init.php',
				31
			);
			remove_anonymous_function_filter(
				'woocommerce_product_thumbnails',
				YITH_WCWL_DIR . 'class.yith-wcwl-init.php',
				21
			);
			remove_anonymous_function_filter(
				'woocommerce_after_single_product_summary',
				YITH_WCWL_DIR . 'class.yith-wcwl-init.php',
				11
			);
			
		}
		
		function dequeue_yith_styles() {
			wp_dequeue_style( 'yith-wcwl-font-awesome');
			wp_dequeue_style( 'yith-wcwl-font-awesome-ie7' );
		}

		add_action( 'wp_enqueue_scripts', 'dequeue_yith_styles' );

	}
	/**
	 *	end YITH WISHLIST related functions
	 */
	
	/**
	 *	LIMIT FOR VARIATIONS BEFORE AJAX 
	 */
	function as_wc_ajax_variation_threshold( $qty, $product ) {
		return 70;
	}
	add_filter( 'woocommerce_ajax_variation_threshold', 'as_wc_ajax_variation_threshold', 10, 2 );
	
	/**
	 *	REMOVE FIRST / LAST CLASSES IN PRODUCTS PAGE
	 *
	 *	hook to post_class to remove css classes "first"/"last" which dissrupt theme grid system
	 */
	function as_remove_first_last( $classes ) {
		
		if( is_woocommerce() || is_active_widget( false,false,'woocommerce_products' ) ) {
			$classes = array_diff( $classes, array('first') );	
			$classes = array_diff( $classes, array('last') );
			
		}
		
		return $classes;
		
	}	
	add_filter( 'post_class','as_remove_first_last',100 );

	
} // end if $cypress_woo_is_active
/**
 *
 *  END OF WOOCOMMECE
 */
//
?>