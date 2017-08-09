<?php
/**
 * AJAX LOAD STUFF.
 *
 * - load ajax url
 * - loading items from product categories ( has special product features).
 * - loading items from posts, portfolio or categories ( has common features for selected post types).
 */
function cypress_ajax_url_var() {
	echo '<script type="text/javascript">var cypress_ajaxurl = "'. admin_url("admin-ajax.php") .'"</script>';
}
add_action('wp_head', 'cypress_ajax_url_var' );
/**
 *   PRODUCT CATEGORIES:
 *  
 */
add_action( 'wp_ajax_nopriv_load-filter', 'ajax_load_product_categories' ); // for NOT logged in users
add_action( 'wp_ajax_load-filter', 'ajax_load_product_categories' );// for logged in users

function ajax_load_product_categories () {
	
	global $post, $cypress_woo_is_active, $product, $woocommerce_loop, $wp_query, $woocommerce;
	
	if( $cypress_woo_is_active ) {
	
	// get variables using $_POST
	$tax_term = $_POST[ 'termID' ];
	$taxonomy = $_POST[ 'tax' ];
	$post_type = $_POST[ 'post_type' ];
	$total_items = $_POST[ 'total_items' ];
	$filters = $_POST[ 'filters' ];
	$in_row = $_POST[ 'in_row' ];
	$use_slider = $_POST[ 'use_slider' ];
	$img_format = $_POST[ 'img_format' ];
	$in_slide = $_POST[ 'in_slide' ];
	$shop_assets = $_POST[ 'shop_assets' ];
	//
	$grid = round( 100 / $in_row );
	//
	// PRODUCT FILTERS:
	if ( $filters == 'featured' ){
		
		$args_filters = array( 
			'meta_key' => '_featured',
			'meta_value' => 'yes'
		);
		remove_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
		
	}elseif( $filters == 'best_sellers' ){
		
		$args_filters = array( 
			'meta_key' 	 => 'total_sales'
		);
		remove_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
	
	}elseif( $filters == 'best_rated' ){
		
		$args_filters = array();
		add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
		
	}elseif( $filters == 'latest' ){
		
		$args_filters = array();
		remove_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
	
	}elseif( $filters == 'random' ){
		
		$order_rand	= true;
		$args_filters = array();
		remove_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
	}
	
	//
	
	if( !empty($tax_term) ) {

		$tax_term = explode(",", $tax_term); // back to array
		
		$tax_filter_args = array('tax_query' => array(
							array(
								'taxonomy' => $taxonomy,
								'field' => 'slug', // can be 'slug' too
								'operator' => 'IN', // NOT IN to exclude
								'terms' => $tax_term
							)
						)
					);
	}else{
		$tax_filter_args = array();
	}
	$main_args = array(
		'no_found_rows' => 1,
		'post_status' => 'publish',
		'post_type' => $post_type,
		'post_parent' => 0,
		'suppress_filters' => false,
		'orderby'     => 'menu_order date',
		'order'       => 'ASC',
		'numberposts' => $total_items
	);
	$all_args = array_merge( $main_args, $args_filters, $tax_filter_args );
	
	$content = get_posts($all_args);
	
	ob_start ();

	$i = 0;
	
	if( empty($content) ) {
	
		echo '<h4 class="no-category-item">'.__('No product was found for this category.','cypress').'</h4>';
		
	} 
	
	if( count( $content ) == 1 ) {
		$oe = '100';
	}elseif( $in_row % 2 == 0 ){ // more then 1 item and even
		$oe = '50';
	}else{		// more then 1 item and odd
		$oe = '33';
	};
	
	foreach ( $content as $post ) {
		setup_postdata( $post );
		
		global $product, $yith_wcwl;
		
		if ($i++%$in_slide==0): ?>
						
		<ol class="itemgroup">
			
		<?php endif;  ?>	
			
			<li class="grid-<?php echo $grid ? $grid : '50'; ?> item scroll tablet-grid-<?php echo $oe; ?> mobile-grid-100">
				
				<?php
				$id = get_the_ID();
				$link = get_permalink($id);
				
				
				// DATA for back image
				// 3.0.0 < Fallback conditional
				if( apply_filters( 'cypress_wc_version', '3.0.0' )	) {
					$attachment_ids   = $product->get_gallery_image_ids();
				}else{
					$attachment_ids   = $product->get_gallery_attachment_ids();
				}
				if ( $attachment_ids ) {
					$image_url = wp_get_attachment_image_src( $attachment_ids[0], 'large'  );
					$img_url = $image_url[0];
					// IMAGE SIZES:
					$imgSizes = all_image_sizes(); // as custom fuction
					$img_width = $imgSizes[$img_format]['width'];
					$img_height = $imgSizes[$img_format]['height'];
				}
				// end DATA
				
				$prod_title = '<h4><a href="'. $link .'" title="'.esc_attr(get_the_title()).'"> ' . esc_attr(get_the_title()) .'</a></h4>';
				
				?>
		
				<div class="item-content"><?php // item-content - wrapper for flip effect ?>
				
				<?php 
				if( $shop_assets == 'product_buttons' ) { 
					
					do_action( 'woocommerce_after_shop_loop_item' ); 
				
				}elseif( $shop_assets ==  'quick_view' ) {
					
					echo '<div class="quick-view-holder"><a href="#qv-holder" class="button quick-view"   title="'. esc_attr(strip_tags(get_the_title())) .'" data-id="'.$id.'">'.__('Quick view','cypress').'</a>';
					
					do_action('as_wishlist_button');
					
					echo '</div>';
					
					if ( !wp_script_is( 'wc-add-to-cart-variation', 'enqueued' )) {
					
						wp_register_script( 'wc-add-to-cart-variation', WP_PLUGIN_DIR . '/woocommerce/assets/frontend/add-to-cart-variation.min.js');
						wp_enqueue_script( 'wc-add-to-cart-variation' );
						
					}
					
				}
				?>
				
				<div class="item-img">
					
					<div class="front">
													
						<?php function_exists('woocommerce_show_product_loop_sale_flash') ? woocommerce_show_product_loop_sale_flash() : '';
						
						echo as_image( $img_format ); ?>

					</div>
					
					<div class="back">
					
						<div class="item-overlay"></div>
						
						<?php 
						echo $prod_title; 
						woocommerce_template_loop_price();
						function_exists('woocommerce_template_loop_rating') ? woocommerce_template_loop_rating() : '';
						?>
						
						<?php 
						// backimage for flipping effect
						if ($attachment_ids ) {
							echo '<img src="'. fImg::resize( $img_url , $img_width, $img_height, true  ) .'" alt="'. esc_attr(get_the_title()) .'" class="back-image" />';
						}else{
							echo as_image( $img_format );
						}
							
						echo '<div class="back-buttons">';
														
						echo '<a href="'.as_get_full_img_url().'" class="button" data-rel="prettyPhoto" title="'. esc_attr(get_the_title()) .'"><div class="fs" aria-hidden="true" data-icon="&#xe022;"></div></a>';
						
						echo '<a href="'.$link.'" class="button" title="'. esc_attr(get_the_title()) .'"><div class="fs" aria-hidden="true" data-icon="&#xe065;"></div></a>';
						
						echo '</div>';
						
						?>
					
					</div>
					
				</div>
				
				<div class="clearfix"></div>
				
				</div><!-- /.item-content -->
				

			
			</li>

			<?php if ($i%$in_slide==0 || $i==count($content)): ?>

		</ol>
						
		<?php 
		
		endif; // $i%$in_slide==0
		
	}// END foreach

	/* reset, clean buffer and respond with content */
	wp_reset_postdata();
	$response = ob_get_contents();
	ob_end_clean();

	echo $response;
	die(1);

	}else{
		echo '<h5 class="no-woo-notice">' . __('AJAX PRODUCTS BLOCK DISABLED.<br> Sorry, it seems like WooCommerce is not active. Please install and activate last version of WooCommerce.','cypress') . '</h5>';
			return;
	} // if $cypress_woo_is_active
	
}
//
//
/** 
 *	POSTS, PORTFOLIO or PRODUCT CATEGORIES.
 *
 *	primarily for posts and portfolios, but can be used for products (product image gallery?)
 */
add_action( 'wp_ajax_nopriv_load-filter2', 'ajax_load_cat_posts' );// for NOT logged in users
add_action( 'wp_ajax_load-filter2', 'ajax_load_cat_posts' );// for logged in users

function ajax_load_cat_posts () {
	
	global $post;
	
	// get all variables using $_POST
	$block_id = $_POST[ 'block_id' ];
	$tax_term = $_POST[ 'termID' ];
	$taxonomy = $_POST[ 'tax' ];
	$post_type = $_POST[ 'post_type' ];
	$img_format = $_POST[ 'img_format' ];
	$block_style = $_POST[ 'block_style' ];
	$tax_menu_style = $_POST[ 'tax_menu_style' ];
	$custom_img_width = $_POST[ 'custom_img_width' ];
	$custom_img_height = $_POST[ 'custom_img_height' ];
	$total_items = $_POST[ 'total_items' ];
	$in_row = $_POST[ 'in_row' ];
	$only_featured = $_POST[ 'only_featured' ];
	$use_slider = $_POST[ 'use_slider' ];
	$display_excerpt = $_POST[ 'display_excerpt' ];
	$display_postmeta = $_POST[ 'display_postmeta' ];
	$in_slide = $_POST[ 'in_slide' ];

	//
	$grid = round( 100 / $in_row );
	$sticky_array = get_option( 'sticky_posts' );
	$total_items = $total_items ? $total_items : -1;
	//
	/*
	 *	IF POSTS, PORTFOLIOS OR PRODUCTS SHOULD BE ONLY FEATURED (STICKY)
	 *
	 */
	if ( $post_type == 'post' && $only_featured ) {
		$args_only_featured = array('post__in' => $sticky_array);
	}elseif ( $post_type == 'portfolio' && $only_featured ){
		$args_only_featured = array( 
			'meta_key' => 'as_featured_item',
			'meta_value' => 1
		);
	}elseif ( $post_type == 'product' && $only_featured ){
		$args_only_featured = array( 
			'meta_key' => '_featured',
			'meta_value' => 'yes'
		);
	}else{
		$args_only_featured = array();
	}
	
	if( !empty($tax_term) ) {

		$tax_term = explode(",", $tax_term); // back to array
		
		$tax_filter_args = array('tax_query' => array(
							array(
								'taxonomy' => $taxonomy,
								'field' => 'slug', // can be 'slug' too
								'operator' => 'IN', // NOT IN to exclude
								'terms' => $tax_term
							)
						)
					);
	}else{
		$tax_filter_args = array();
	}
	$main_args = array(
		'no_found_rows' => 1,
		'post_status' => 'publish',
		'post_type' => $post_type,
		'post_parent' => 0,
		'suppress_filters' => false,
		'orderby'     => 'post_date',
		'order'       => 'DESC',
		'numberposts' => $total_items
	);
	$all_args = array_merge( $main_args, $args_only_featured, $tax_filter_args );
	
	$content = get_posts($all_args);
				
				if( $custom_img_width || $custom_img_height ) {
					$img_width = $custom_img_width ? $custom_img_width : 450;
					$img_height = $custom_img_height ? $custom_img_height : 300;
				}else{
					// REGISTERED IMAGE SIZES:
					$imgSizes = all_image_sizes(); // as custom fuction
					$img_width = $imgSizes[$img_format]['width'];
					$img_height = $imgSizes[$img_format]['height'];
				}	
	ob_start ();
	
	$i = 0;
	
	if( count( $content ) == 1 ) {
		$oe = '100';
	}elseif( $in_row % 2 == 0 ){ // more then 1 item and even
		$oe = '50';
	}else{		// more then 1 item and odd
		$oe = '33';
	};
	
	foreach ( $content as $post ) {
		
		setup_postdata( $post );
		
		if ($i++%$in_slide==0): ?>
						
		<ol class="itemgroup">
			
		<?php endif;  ?>	
			
			<li class="grid-<?php echo $grid ? $grid : '50'; ?> item scroll tablet-grid-<?php echo $oe; ?> mobile-grid-100<?php echo ' '.$block_style; ?>"  <?php echo ( $i%$in_row  == 1 ) ? 'style="clear: both;"': null ?>>
				
				<?php
				$post_id		= $post->ID;
				$link			= get_permalink($post_id);
				$post_format	= get_post_format();
				$pP_rel			= '';
				//
				
				if( $post_format == 'video' ) { // <---------- GALLERY POST VIDEO
				
					$featured_or_thumb	= get_post_meta($post_id,'as_video_thumb', true);
					$video_host			= get_post_meta($post_id,'as_video_host', true);
					$video_id			= get_post_meta($post_id,'as_video_id', true);
					$width				= get_post_meta($post_id,'as_video_width', true);
					$height				= get_post_meta($post_id,'as_video_height', true);
					
					$img_url = get_template_directory_uri() . '/inc/blocks/ajax_video.php?video_host='.$video_host.'&video_id='.$video_id.'&vid_width='.$width.'&vid_height='.$height.'&ajax=true&width=80%';
					
					if ( $featured_or_thumb == 'host_thumb' ) { // if thumbs from video hosts
					
						$img = video_thumbs();
						$image_output = '<div class="entry-image"><img src="'. fImg::resize( $img , $img_width, $img_height, true  ) .'" alt="'. esc_attr(strip_tags(get_the_title())) .'" /></div>';
					
					}else{
					
						$img = as_get_full_img_url();
						$image_output = '<div class="entry-image"><img src="'. fImg::resize( $img , $img_width, $img_height, true  ) .'" alt="'. esc_attr(strip_tags(get_the_title())) .'" /></div>';
						
					}
					$pP_rel = '[ajax-'.$post_id.'-'.$block_id.']';
					$img_urls_gallery = ''; // avoid duplicate gallery image urls
					
				}elseif( $post_format == 'gallery' ) { // <------------- GALLERY POST FORMAT
					
					// WP gallery img id's:
					$wpgall_ids 	= apply_filters('as_wpgallery_ids','ids_wp_gallery');
					// AS gallery img id's (from custom meta):
					$gall_img_array = get_post_meta( get_the_ID(),'as_gallery_images');
												
					$img_urls_gallery = '';
					$n = 0;
					if( !empty($wpgall_ids) ) {
						
						foreach ( $wpgall_ids as $wpgall_img_id ){
							
							if( $n == 0 ) {
								$img_url = as_get_full_img_url( $wpgall_img_id );
							}else{
								$img_urls_gallery .= '<a href="' .as_get_full_img_url( $wpgall_img_id ) .'" class="invisible-gallery-urls" data-rel="prettyPhoto[pp_gal-'.$post_id.'-'.$block_id.']"></a>';
							}
							$n++;
						}
						$image_output = get_unattached_image( $wpgall_ids[0], $img_format, $img_width, $img_height );
						
					}elseif( !empty($gall_img_array) ) {
						foreach ( $gall_img_array as $gall_img_id ){
							
							if( $n == 0 ) {
								$img_url = as_get_full_img_url( $gall_img_id );
							}else{
								$img_urls_gallery .= '<a href="' .as_get_full_img_url( $gall_img_id ) .'" class="invisible-gallery-urls" data-rel="prettyPhoto[pp_gal-'.$post_id.'-'.$block_id.']"></a>';
							}
							$n++;
						}
						$image_output = as_image( $img_format,1, $img_width, $img_height );
					}
					
					
					$pP_rel			= '[pp_gal-'.$post_id.'-'.$block_id.']';
				
				}elseif( $post_format == 'audio' ){ // <--------------AUDIO POST FORMAT
					
					$audio_file_id		= get_post_meta($post_id,'as_audio_file', true);
					$audio_file			= wp_get_attachment_url( $audio_file_id );	
					
					$large_image		= as_get_full_img_url();
					$img_url			= get_template_directory_uri() . '/inc/blocks/ajax_audio.php?audio_file='.$audio_file.'&large_image='.$large_image.'&post_id='.$post_id.'&ajax=true';
					
					$image_output		= as_image( $img_format,1, $img_width, $img_height );
					$pP_rel				= '';
					$img_urls_gallery	= ''; // avoid duplicate gallery image urls
					
					//wp_enqueue_style( 'wp-mediaelement' );
					//wp_enqueue_script( 'wp-mediaelement' );
					
				}elseif( $post_format == 'quote' ){ // <---------------- QUOTE POST FORMAT
					
					$quote_author	= get_post_meta($post_id,'as_quote_author', true);
					$quote_url		= get_post_meta($post_id,'as_quote_author_url', true);
					$avatar			= get_post_meta($post_id,'as_avatar_email', true);
					
					$quote_html = '<div class="quote-inline format-quote">';
					
					if( $avatar || has_post_thumbnail() ) {
						
					$quote_html		.= '<div class="avatar-img">';
						
						$quote_html .= $quote_url ? '<a href="'.$quote_url.'" title="'. $quote_author .'">' : '';
						if( $avatar ) {
							$quote_html .= get_avatar( $avatar , 120 );
						}elseif( has_post_thumbnail() ){
							$quote_html .= get_the_post_thumbnail('thumbnail');
						}
						$quote_html		.= $quote_url ? '</a>' : '';
						
						$quote_html		.= '<div class="arrow-left"></div></div>';

					}; 
				
					$quote_html .= '<div class="quote">';
						
						$quote_html		.= '<p>'. get_the_content() .'</p>'; 
						$quote_html		.=  $quote_url ? '<a href="'.$quote_url.'" title="'. $quote_author .'">' : '';
						$quote_html		.=  $quote_author ? '<h5>'.$quote_author.'</h5>' : '';
						$quote_html		.=  $quote_url ? '</a>' : '';

					$quote_html .= '</div></div>';
					
					$img_url			= '#quote-'.$post_id;
					$image_output		= as_image( $img_format,1, $img_width, $img_height );
					$pP_rel				= '[inline-'.$post_id.'-'.$block_id.']';
					$img_urls_gallery	= ''; // avoid duplicate gallery image urls
					
				}else{ // <---------------- STANDARD POST FORMAT
					
					$img_url			= as_get_full_img_url();
					$image_output		= as_image( $img_format,1, $img_width, $img_height );
					$pP_rel				= '';
					$img_urls_gallery	= ''; // avoid duplicate gallery image urls
					
				}
				?>

				<?php if( $block_style != 'style1') { ?>
						<h4><a href="<?php echo $link; ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php echo esc_html( strip_tags(get_the_title()) ); ?></a></h4>
				<?php } ?>
				
				
				<div class="item-images">
					
					<div class="item-img">
					
						<?php
						
						echo '<div class="front">' . $image_output ; 
						
						if( $block_style == 'style1' ) {
									
							echo '<h4><a href="'. $link.'" title="'. esc_attr(get_the_title()).'">'. esc_html( strip_tags(get_the_title()) ) .'</a></h4>';
						
							if( $display_excerpt ) {
								
								echo '<div class="excerpt">';
							
								echo '<p>' . apply_filters('as_custom_excerpt',80, false) . '</p>';
									
								echo '</div>';
							}
						
						}

						echo '<div class="clearfix"></div></div>'; 
						
						echo '<div class="back">';
						
						echo $image_output;
						
						echo '<div class="item-overlay"></div><div class="back-buttons">';
						
						echo '<a href="'.$img_url.'" class="button" data-rel="prettyPhoto'.$pP_rel.'" title="'. esc_attr(strip_tags(get_the_title())) .'">'.as_post_format_icon_action().'</a>';
						
						echo '<a href="'.$link.'" class="button" title="'. esc_attr(strip_tags(get_the_title())) .'"><div class="fs" aria-hidden="true" data-icon="&#xe065;"></div></a>';
						
						
						echo '</div></div>';
						
						echo $img_urls_gallery ? $img_urls_gallery : null; // for usage with prettPhoto
						
						echo $post_format == 'quote' ? '<div class="hidden-quote" id="quote-'.$post_id.'">'. $quote_html .'</div>' : null;

						?>
					
					</div>
					
					
				</div><!-- /.item-content -->
				
				<?php if( $display_excerpt && $block_style != 'style1'  ) {?>	
				<div class="item-text">
					
					<div class="excerpt">
						
						<?php echo '<p>' . apply_filters('as_custom_excerpt',80, true) . '</p>'; ?>
						
					</div>

				</div>

				<?php  };  ?>
				
				<?php if( $display_postmeta && $block_style != 'style1'  ) { // post meta
				
					echo '<div class="clearfix"></div>';
					echo '<div class="post-meta-bottom">';
					entryMeta_comments();
					entryMeta_dateUser();
					entryMeta_cats_tags();
					echo '</div>';
				}
				?>	
			
			</li>

			<?php if ($i%$in_slide==0 || $i==count($content)): ?>

		</ol>
		
		
		<?php 
		
		endif; // $i%$in_slide==0
				
	}// END foreach
	
	/* reset, clean buffer and respond with content */
	wp_reset_postdata();
	$response = ob_get_contents();
	ob_end_clean();

	echo $response;
	die(1);

}
/**
 *	QUICK VIEW - Products popup
 *
 */
add_action( 'wp_ajax_nopriv_load-filter3', 'quick_view' );// for NOT logged in users
add_action( 'wp_ajax_load-filter3', 'quick_view' );// for logged in users

function quick_view () {

	global $post, $product, $woocommerce_loop, $wp_query, $woocommerce;
	
	$productID	= $_POST[ 'productID' ];
	$lang 		= isset($_POST[ 'lang' ]) ? $_POST[ 'lang' ] : '';
		
	$prodID = $lang ? icl_object_id( $productID, 'product', false, $lang ) : $productID;
	
	$display_args = array(
			'no_found_rows'		=> 1,
			'post_status'		=> 'publish',
			'post_type'			=> 'product',
			'post_parent'		=> 0,
			'suppress_filters'	=> false,
			'numberposts'		=> 1,
			'include'			=> $prodID
		);
			
	$content = get_posts($display_args);
	
	ob_start ();
	
	foreach ( $content as $post ) {
			
		setup_postdata( $post );
	
		global $post, $product, $woocommerce, $wp_query;
		
		$postClassarr = get_post_class();
		$postClass = implode(" ", $postClassarr );
		
		echo '<div itemscope itemtype="http://schema.org/Product" id="product-'. $productID .'" class="'. $postClass .' product">';
			
		/**
		 * woocommerce_show_product_images hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		// do_action( 'woocommerce_before_single_product_summary' ); // discarded
		
		do_action( 'product_quick_view_images' );
	

		echo '<div class="summary entry-summary">';

		echo '<h4><a href="' .get_permalink(). '" title="'.get_the_title().'">' . get_the_title() .'</a></h4>';
		
		/**
		 * woocommerce_single_product_summary hook
		 *
		 * @hooked woocommerce_template_single_title - 5 // discarded
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 */
		 
		// DON'T DO SHARETHIS ON QUICK VIEW
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
		
		do_action( 'woocommerce_single_product_summary' );

		
		
		echo '</div>'; // end .summary

		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		//do_action( 'woocommerce_after_single_product_summary' );


	echo '<div class="clearfix"></div></div>';

	}
	?>
	<script>
	jQuery(document).ready(function ($) {
		/* Get those variations forms to work ;) : */
		
		
		$(function() {
			// wc_add_to_cart_variation_params is required to continue, ensure the object exists
			if ( typeof wc_add_to_cart_variation_params === 'undefined' )
				return false;
			$('.variations_form').wc_variation_form();
			$('.variations_form .variations select').change();
		});
		
		/*	Quantity buttons:	*/
		$("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").addClass('buttons_added').append('<input type="button" value="+" class="plus" />').prepend('<input type="button" value="-" class="minus" />');
		
		/*	OWL Carousel:	*/
		var images = $('#qv-holder').find('.images')
		if( images.hasClass("productslides") ) {
			images.owlCarousel({
						singleItem			: true,
						autoPlay			: false,
						navigation			: true,
						pagination			: false,
						autoHeight 			: true,
						mouseDrag			: true,
						rewindNav			: true,
						paginationNumbers	: false,
						navigationText		:["&#xe16d;","&#xe170;"]
					});
			cs_navig = cs_pagin = cs_auto = "";
		}
		
		/*	QUICK VIEW WINDOW VERTICAL CENTER POSITION :	*/

		$(window).resize(function() {
		
			var qv_holder		= $('#qv-holder'),
				qv_height	= qv_holder.outerHeight(true),
				qv_overlay	= $('.qv-overlay'),
				qv_overlay_h= qv_overlay.outerHeight(true);
		
			var	qv_top		= (qv_overlay_h / 2) - (qv_height/2);
			
			qv_holder.stop(true,false).delay(200).animate({'top': qv_top },{ duration:400, easing: 'easeOutQuart'} );
			
		});//.trigger('resize')
		 
		$('.item-img:first-child img').on('load',function() {
			
			$(window).trigger('resize');
			
		});
		
		if ( $.isFunction( window.variableProductImages ) ) {
			var variableProductImages = window.variableProductImages();
		}
	});
	
	</script>
	<?php 
	
	
	/* reset, clean buffer and respond with content */
	wp_reset_postdata();
	$response = ob_get_contents();
	ob_end_clean();

	echo $response;
	die(1);
}

/**
 *	VARIATION IMAGES change for MAGNIFIER
 *
 */
add_action( 'wp_ajax_nopriv_var-image', 'variation_image' );// for NOT logged in users
add_action( 'wp_ajax_var-image', 'variation_image' );// for logged in users

function variation_image () {
	
	$varID	= $_POST[ 'var_id' ];
	
	$var_img_id 	= get_post_thumbnail_id( $varID );
	$var_img_src	= wp_get_attachment_image_src( $var_img_id, "full" );
	$var_img_url	= $var_img_src[0];
	
	echo $var_img_url;
	
	die(1);
}
/**
 * end AJAX LOAD STUFF
 */