<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php
	if( apply_filters( 'cypress_wc_version', '3.0.0' ) ) {
		// Show WC categories 2.7.x
		$cats_html = wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in"><span class="icon-folder meta-icon"></span>' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'cypress' ) . ' ', '</span>' );
		echo wp_kses_post($cats_html);
		// Show WC tags 2.7.x
		$tags_html = wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as"><span class="icon-price-tags meta-icon"></span> ' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'cypress' ) . ' ', '</span>' );
		echo wp_kses_post($tags_html);
	
	}else{
		
		$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
		echo $product->get_categories( ', ', '<span class="posted_in"><span class="icon-folder meta-icon"></span> ' . _n( 'Category:', 'Categories:', $size, 'woocommerce' ) . ' ', '.</span>' );
	
		$size = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
		echo $product->get_tags( ', ', '<span class="tagged_as"><span class="icon-tags meta-icon"></span> ' . _n( 'Tag:', 'Tags:', $size, 'woocommerce' ) . ' ', '.</span>' );
		
	}		
	?>
	
	
	
	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></span>.</span>

	<?php endif; ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>