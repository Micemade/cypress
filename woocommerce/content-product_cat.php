<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
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
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product, $woocommerce_loop,  $of_cypress;
/* 
// Store loop count we're currently on ( DISABLED BY THEME)
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;
*/
// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) 
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', loop_columns() );

// Increase loop count ( DISABLED BY THEME)
//$woocommerce_loop['loop']++;

// Extra post classes - ADD FIRST AND LAST
$classes = array();
//
/*  ( DISABLED BY THEME)
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
*/

// Cypress theme edit: set grid by columns number
$classes[] = 'grid-' . floor(100 / $woocommerce_loop['columns']) ;

// Cypress theme edit: add grid css and hover effect css (for jQuery)
$classes[] = 'product-category as-hover category-image item tablet-grid-50 scroll';
$classes_final	= implode( " ", $classes );
?>
<div <?php wc_product_cat_class( $classes_final, $category ); ?>>

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

		<div class="item-overlay"></div>
		
		<h4>
			<?php
				echo $category->name;
				
				if ( $category->count > 0 )
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
			?>
		</h4>		
		
		<?php
		/**
		 * woocommerce_before_subcategory_title hook
		 *
		 * @hooked woocommerce_subcategory_thumbnail - 10
		 */
		//do_action( 'woocommerce_before_subcategory_title', $category ); 
		//
		$small_thumbnail_size  	= apply_filters( 'single_product_small_thumbnail_size', 'thumbnail' );
		$dimensions    			= wc_get_image_size( $small_thumbnail_size );
		$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

		if ( $thumbnail_id ) {
			$image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size  );
			$image = $image[0];
			echo '<img src="' . $image . '" alt="' . $category->name . '" width="' . $dimensions['width'] . '" height="' . $dimensions['height'] . '" />';
		} else {
			$image = woocommerce_placeholder_img_src();
			echo '<img src="' . fImg::resize( PLACEHOLDER_IMAGE , $dimensions['width'], $dimensions['height'], true  ). '" alt="" />';
		}
		?>

		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	</a>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</div>