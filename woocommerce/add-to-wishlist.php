<?php
/**
 * Add to wishlist template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.0
 */
if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly

global $product, $yith_wcwl, $atts;

$icon_added 		= '<span class="icon-heart"></span>';
$title_added		= __( 'Product added! Browse Wishlist','cypress' );
$title_in_wishlist	= __( 'The product is already in the wishlist! Browse Wishlist','cypress' );

// 3.0.0 < Fallback conditional :
$product_id	= apply_filters( 'cypress_wc_version', '3.0.0'  ) ? $product->get_id() : $product->id;

$exists = YITH_WCWL()->is_product_in_wishlist( $product_id	, false );
$wishlist_url = YITH_WCWL()->get_wishlist_url();
$available_multi_wishlist = false;
?>

<div class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr( $product_id ); ?>">
    
	<div class="yith-wcwl-add-button <?php echo ( $exists && ! $available_multi_wishlist ) ? 'hide': 'show' ?>" style="display:<?php echo ( $exists && ! $available_multi_wishlist ) ? 'none': 'block' ?>">

        <?php yith_wcwl_get_template( 'add-to-wishlist-button.php', $atts ); ?>

    </div>

    <?php // ---- IF just added to wishlist : ?>
	
	<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                
		<a href="<?php echo esc_url( $wishlist_url ); ?>" class="button" title="<?php echo $title_added; ?>" data-tooltip><?php echo $icon_added; ?></a>

    </div>
	
	<?php // ---- If already in wishlist (added before) : ?>

    <div class="yith-wcwl-wishlistexistsbrowse <?php echo ( $exists && ! $available_multi_wishlist ) ? 'show' : 'hide' ?>" style="display:<?php echo ( $exists && ! $available_multi_wishlist ) ? 'block' : 'none' ?>">
		
		<a href="<?php echo esc_url( $wishlist_url ) ?>" class="button" title="'<?php echo $title_in_wishlist; ?> " data-tooltip><?php echo $icon_added; ?></a>

    </div>

    <div style="clear:both"></div>
    <div class="yith-wcwl-wishlistaddresponse"></div>

</div>

<div class="clear"></div>

<script type="text/javascript">
    if( jQuery( '#yith-wcwl-popup-message' ).length == 0 ) {
        var message_div = jQuery( '<div>' )
                .attr( 'id', 'yith-wcwl-message' ),
            popup_div = jQuery( '<div>' )
                .attr( 'id', 'yith-wcwl-popup-message' )
                .html( message_div )
                .hide();

        jQuery( 'body' ).prepend( popup_div );
    }
</script>