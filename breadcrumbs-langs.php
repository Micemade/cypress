<?php
/**
 *	Template part to display breadcrumbs and/or languages selector in header.
 *
 *	@since Cypress 1.0
 */
global $of_cypress, $cypress_woo_is_active;
$orientation = $of_cypress['orientation'];
?>
<div class="breadcrumbs-lang" >	

	<div class="grid-container">
	
		<div class="grid-50">
			
			<?php 

			if( $of_cypress['show_breadcrumbs'] && !is_home() ) {
				
				$post_type = get_post_type();
				
				if( $cypress_woo_is_active ) {
					$is_shop = ( is_shop() || is_woocommerce() || is_cart() || is_checkout()) ? true : false ;
				}else{
					$is_shop = false;
				}
				
				if ( $post_type != 'product' && !$is_shop ) {
				
					if (function_exists('dimox_breadcrumbs')  ) {					
						
						dimox_breadcrumbs();
					}
				}else{
				
					do_action('woocommerce_before_main_content'); // to hook woocommerce breadcrumb
				
				}
			}
			?>
		</div>
		
		<div class="grid-50 float-right">
						
			<?php
			/**
			 *  WMPL support:
			 */
			$lang_sel = isset($of_cypress['lang_sel']) ? $of_cypress['lang_sel'] : null;
			if ( function_exists('languages_list') && $lang_sel  ) { 
				languages_list();
			}
			?>
			
			
			<?php if ( has_nav_menu( 'secondary' ) ) { ?>
			
			<div class="menu-toggler small"><a href="#" title="<?php echo __('Toggle menu','cypress') ;?>" class="button"><span class="fs" data-icon="&#xe05a;"></span></a></div>

			<nav id="secondary-nav">

				<?php 
				$walker = new My_Walker;
				wp_nav_menu( array( 
						'theme_location' => 'secondary',
						//'menu' => 'Main menu',
						'walker' =>$walker,
						'link_before' =>'',
						'link_after' =>'',
						'menu_class' => 'navigation',
						'container' => false 
						) 
					);
				?>
				
			</nav>

			<?php } ?>	
			
		</div>
		
	</div>

</div>