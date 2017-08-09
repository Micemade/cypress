<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $woocommerce, $product, $of_cypress;

$magnifier = false; 
if( $of_cypress['single_product_images'] == 'magnifier' ) {
	$magnifier = true; 
};


$of_img_format = $of_cypress['single_product_image_format'];
if( $of_img_format == 'plugin' ) {
	$img_format = 'shop_single';
}else{
	$img_format = $of_img_format;
}

?>
<div class="images item">

	<div class="item-content">
	
	<?php
	if ( has_post_thumbnail() ) {

			$post_thumb_id		= get_post_thumbnail_id();
			$props				= wc_get_product_attachment_props( $post_thumb_id, $post );

			// Default (featured) image
			$default_product_image_src	= wp_get_attachment_image_src( $post_thumb_id, $img_format );
			$default_product_image_url  = $default_product_image_src[0];

			$image_class 		= esc_attr( 'attachment-' . $post_thumb_id ).' featured';
			$full_image			= as_get_full_img_url();
			$product_title		= the_title_attribute(array('echo' => 0));
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', $img_format ), array(
				'title'	=> $props['title'],
				'alt'	=> $props['alt'],
				'class'	=> $image_class,
				'id'	=> 'prod-image-'.$post->ID
			) );
							
			// 3.0.0 < Fallback conditional
			if( apply_filters( 'cypress_wc_version', '3.0.0' )	) {
				$attachment_ids   = $product->get_gallery_image_ids();
			}else{
				$attachment_ids   = $product->get_gallery_attachment_ids();
			}
			
			$attachment_count   = count( $attachment_ids );
			if ( $attachment_count > 0 ) {
				$gallery = '[pp_gal-'.$post->ID.']';
			} else {
				$gallery = '';
			}

			
			if( !$magnifier ) {
			
				echo apply_filters( 'woocommerce_single_product_image_html',sprintf('<div class="item-img"><div class="front">%1$s</div><div class="back"><div class="item-overlay"><div class="back-buttons"><a href="%2$s" data-o_href="%2$s" data-zoom-image="%4$s" class="larger-image-link button woocommerce-main-image zoom" itemprop="image" title="%3$s" rel="prettyPhoto' . $gallery . '"><div class="fs" aria-hidden="true" data-icon="&#xe022;"></div></a></div></div></div></div>',
			
					$image,						// %1$s
					$full_image,				// %2$s
					$product_title,				// %3$s
					$default_product_image_url	// %4$s
					
				), $post->ID );

			}else{
			
				
				echo apply_filters( 'woocommerce_single_product_image_html',sprintf('
				
					<div class="item-img">

						<a href="%2$s" data-o_href="%2$s" data-zoom-image="%4$s" class="larger-image-link woocommerce-main-image zoom" itemprop="image" title="%3$s" rel="prettyPhoto">
							
							<div class="front">%1$s</div>
						
						</a>
						
					</div>
				',
			
					$image,						// %1$s
					$full_image,				// %2$s
					$product_title,				// %3$s
					$default_product_image_url	// %4$s
					
				), $post->ID );
			
			}

		
	} else {

		$image						= wc_placeholder_img_src ();
		$full_image					= as_get_full_img_url();
		$product_title				= esc_attr( strip_tags(get_the_title()));
		$default_product_image_url	= wc_placeholder_img_src ();
		
		echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="item-img"><a href="%2$s" data-o_href="%2$s" data-zoom-image="%4$s" class="larger-image-link woocommerce-main-image zoom" itemprop="image" data-rel="prettyPhoto[pp_gal-'.$post->ID.']" title="%3$s"><div class="front"><img src="%1$s" class="featured" id="%5$s"></div></a></div>', 
			$image,						// %1$s
			$full_image,				// %2$s
			$product_title,				// %3$s
			$default_product_image_url,	// %4$s
			'prod-image-'.$post->ID		// %5$s
		) );

	}
		
	if( $magnifier ) {
		// LOAD MAGNIFIER SCRIPTS
		if ( !wp_script_is( 'eZoom', 'enqueued' )) {
			
			wp_register_script( 'eZoom', get_template_directory_uri() . '/js/jquery.elevatezoom.js');
			wp_enqueue_script( 'eZoom' );
			
		}
		
		echo '
		<style>.zoomContainer {z-index: 10;}</style>
		
		<script type="text/javascript">
			 
			jQuery(document).ready(function() {

				jQuery("#prod-image-'.$post->ID .'").elevateZoom({
					gallery				: "gallery-'.$post->ID.'",
					zoomType			: "window",
					cursor				: "pointer", 
					galleryActiveClass	: "active",
					imageCrossfade		: true,
					loadingIcon			: "'. get_template_directory_uri() .'/img/ajax-loader.gif",
					zoomWindowPosition	: "magnifier-container",
					zoomWindowWidth		: 300,
					zoomWindowHeight	: 300,
					zoomWindowFadeIn	: 500,
					zoomWindowFadeOut	: 500,
					lensFadeIn			: 500,
					lensFadeOut			: 500,
					responsive			: true,
					scrollZoom			: true,
					constrainType		:"width",
					borderSize			: 1,
					borderColour		: "#999"

				}); 

			}); // end doc ready

		</script>
		';
		
	}
	?>
	
	<div id="magnifier-container"></div>
	
	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

	</div>
	
	
</div>