<?php
/**
 *	The Blank footer with widgets template.
 *
 *	@since Cypress 1.0
 */
?>

</div><!-- end #page -->

<?php

global $of_cypress;

?>
	
<footer id="footer" style="margin: 0; padding: 0; border: none;">

	<?php // FOOTER WIDGETS //////////////////////////////// ?>
	
	<?php if ( is_active_sidebar( 'footer-widgets-1' ) || is_active_sidebar( 'footer-widgets-2' ) || is_active_sidebar( 'footer-widgets-3' ) ) : ?>

		<div id="footerwidgets">
			
			<div class="grid-container">		
									
				<?php 
				if ( is_active_sidebar( 'footer-widgets-1' ) ) {
					echo '<div>';
					dynamic_sidebar( 'footer-widgets-1' ); 
					echo '</div>';
				}
				if ( is_active_sidebar( 'footer-widgets-2' ) ){
					echo '<div>';
					dynamic_sidebar( 'footer-widgets-2' ); 
					echo '</div>';
				}		
				if ( is_active_sidebar( 'footer-widgets-3' ) ) {
					echo '<div>';
					dynamic_sidebar( 'footer-widgets-3' ); 
					echo '</div>';
				}
				if ( is_active_sidebar( 'footer-widgets-4' ) ) {
					echo '<div>';
					dynamic_sidebar( 'footer-widgets-4' ); 
					echo '</div>';
				}	
				?>
						
			</div><!-- / .grid-container -->
		
		</div>

		<div class="grid-container"><div class="footer-border clearfix grid-100"></div></div>
	
	<?php endif; ?>
	

</footer>

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

<!-- <script type="text/javascript">
function noError(){return true;}
window.onerror = noError;
</script>
-->

</body>

</html>