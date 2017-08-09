<?php
/**
 *	The Blank footer template.
 *
 *	@since Cypress 1.0
 */
?>

</div><!-- end #page -->

<?php global $of_cypress; ?>
	
<footer id="footer" style="margin: 0; padding: 0; border: none;"></footer>

<?php 
// SOME WOOCOMMERCE STUFF:
global $woocommerce, $cypress_woo_is_active, $cypress_wc_version;

if( $cypress_woo_is_active ) {

	if( function_exists( 'wc_notice_count' ) ) {
		
		if( wc_notice_count() ) {
			echo '<div class="theme-shop-message">';
			do_action( 'woocommerce_before_single_product' );
			echo '</div>';
		}
		
	}else{
		// backward  < 2.1 compatibility:
		if( $woocommerce->error_count() > 0 || $woocommerce->message_count() > 0 ) {
			echo '<div class="theme-shop-message">';
			do_action( 'woocommerce_before_single_product' );
			echo '</div>';
		}
	}
	
}
?>

<?php wp_footer(); ?>	


</body>

</html>