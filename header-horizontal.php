<?php
/**
 *	Template part: Header Vertical 
 *	vertical template for header - float left with fixed position
 */
global $of_cypress, $cypress_woo_is_active, $cypress_wc_version, $border_decor;
?>

<header id="site-menu" class="horizontal">
	

	<div class="grid-container clearfix">

	<?php 
	
	if( isset( $of_cypress['horiz_header_blocks']['enabled'] ) ) {
	
		$headblocks = $of_cypress['horiz_header_blocks']['enabled'];
		
		foreach ( $headblocks as $block ) {
		
			$block_array_check =  strpos( $block, "|");
			// if are saved as resizable
			if( $block_array_check ) {
			
				$bl =  explode("|", $block ); // $bl[0] - block name, $bl[1] - block width
				
				switch ( $bl[0] ) {
				
					case 'Border block' :
					
					echo '<div class="menu-border '.$border_decor.'"></div>';
					
					break;
					//////////////////////////////////////////
					case 'Shopping cart' :
					
					/**
					 *	IF WOOCOMMERCE is ACTIVATED
					 *
					 */
					if ( $cypress_woo_is_active ) {
											
						echo '<div style="width:'.$bl[1].'%; position: relative;">';
						
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

						<?php echo $cart_count ? '</a>' : '</div>';
						
						echo '<div id="mini-cart-list"><span class="arrow-up"></span><div class="widget_shopping_cart_content">';
							
							wc_get_template_part('mini','cart');
							
						echo '</div></div>';
						
						echo '</div>';
						
					} // endif $cypress_woo_is_active
					
					
					break;
					//////////////////////////////////////////
					case 'Site title or logo' :
					?>
					<div id="site-title" style="width:<?php echo $bl[1]; ?>%;">
			
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> | <?php bloginfo( 'description' );?>" rel="home">
						
						
						<h1>
						
							<?php 
							$logo		= $of_cypress['site_logo'];
							$logo_on	= !empty ( $of_cypress['logo_desc']['logo_on'] );
							$desc_on	= !empty ( $of_cypress['logo_desc']['desc_on'] );
							if ( $logo_on &&  $logo  ) {
							?>
								<img src="<?php echo $logo ; ?>" title="<?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' );?>" <?php echo ( isset($logo_size)  ?  'height='. intval($logo_size)  :  '' ); ?> alt="<?php bloginfo( 'name' ); ?>" />
							
							<?php } else { ?>
							
								<span><?php bloginfo( 'name' ); ?></span>
								
							<?php } ?>
						
						</h1>
						
						</a>
						
						<?php if ( $desc_on ) { ?>
							<div id="site-description"><?php bloginfo( 'description' ); ?></div>
						<?php } ?>
						
					</div>
					
					<?php 
					
					break;
					//////////////////////////////////////////
					case 'Menu one' :
					?>
					<nav id="main-nav-wrapper" style="width:<?php echo $bl[1]; ?>%;">
								
						<?php 
						$walker = new My_Walker;
						wp_nav_menu( array( 
								'theme_location'	=> 'main-horizontal',
								//'menu'			=> 'Main menu',
								'walker'			=> $walker,
								'link_before'		=> '',
								'link_after'		=>'',
								'menu_id'			=> 'main-nav',
								'menu_class'		=> 'navigation ',
								'container'			=> false
								) 
							);
						?>
						
					</nav>
					<div class="clearfix"></div>
					
					
					<?php 
					break;
					//////////////////////////////////////////
					case 'Simple search' :
						
						echo '<div style="width:'.$bl[1].'%;">';
						
							get_template_part('searchform','menu');
						
						echo '</div>';
					
					break;
					//////////////////////////////////////////
					
					case 'Social block' :
					
					?>
					<div id="social" class="social" style="width:<?php echo $bl[1]; ?>%;">

						<?php
						$target = $of_cypress['soc_rss'] ? ' target="_blank" ' : '';
						
						echo ( $of_cypress['soc_rss'] ? '<div><a href="'.get_bloginfo('url').'/feed" title="RSS" class="fs" aria-hidden="true" data-icon="&#xe112;"'.$target.'></a></div>' : '' );
						echo ( $of_cypress['soc_facebook'] ? '<div><a href="'.$of_cypress['soc_facebook'].'" title="Facebook" class="fs" aria-hidden="true" data-icon="&#xe10d;"'.$target.'></a></div>' : '' );
						echo ( $of_cypress['soc_twitter'] ? '<div><a href="'.$of_cypress['soc_twitter'].'" title="Twitter" class="fs" aria-hidden="true" data-icon="&#xe111;"'.$target.'></a></div>' : '' );			echo ( $of_cypress['soc_linkedin'] ? '<div><a href="'.$of_cypress['soc_linkedin'].'" title="LinkedIn" class="fs" aria-hidden="true" data-icon="&#xe141;"'.$target.'></a></div>' : '' );
						echo ( $of_cypress['soc_gplus'] ? '<div><a href="'.$of_cypress['soc_gplus'].'" title="Google plus" class="fs" aria-hidden="true" data-icon="&#xe109;"'.$target.'></a></div>' : '' );
						echo ( $of_cypress['soc_youtube'] ? '<div><a href="'.$of_cypress['soc_youtube'].'" title="You Tube" class="fs" aria-hidden="true" data-icon="&#xe115;"'.$target.'></a></div>' : '' );
						echo ( $of_cypress['soc_flickr'] ? '<div><a href="'.$of_cypress['soc_flickr'].'" title="Flickr" class="fs" aria-hidden="true" data-icon="&#xe11e;"'.$target.'></a></div>' : '' );
						echo ( $of_cypress['soc_vimeo'] ? '<div><a href="'.$of_cypress['soc_vimeo'].'" title="Vimeo" class="fs" aria-hidden="true" data-icon="&#xe118;"'.$target.'></a></div>' : '' );
						echo ( $of_cypress['soc_pinterest'] ? '<div><a href="'.$of_cypress['soc_pinterest'].'" title="Pinterest" class="fs" aria-hidden="true" data-icon="&#xe148;"'.$target.'></a></div>' : '' );
						echo ( $of_cypress['soc_dribbble'] ? '<div><a href="'.$of_cypress['soc_dribbble'].'" title="Dribbble" class="fs" aria-hidden="true" data-icon="&#xe123;"'.$target.'></a></div>' : '' );
						echo ( $of_cypress['soc_forrst'] ? '<div><a href="'.$of_cypress['soc_forrst'].'" title="Forrst" class="fs" aria-hidden="true" data-icon="&#xe125;"'.$target.'></a></div>' : '' );
						echo ( $of_cypress['soc_instagram'] ? '<div><a href="'.$of_cypress['soc_instagram'].'" title="Instagram" class="fs" aria-hidden="true" data-icon="&#xe10e;"'.$target.'></a></div>' : '' );
						echo ( $of_cypress['soc_github'] ? '<div><a href="'.$of_cypress['soc_github'].'" title="Github" class="fs" aria-hidden="true" data-icon="&#xe12c;"'.$target.'></a></div>' : '' );
						echo ( $of_cypress['soc_picassa'] ? '<div><a href="'.$of_cypress['soc_picassa'].'" title="Picassa" class="fs" aria-hidden="true" data-icon="&#xe11f;"'.$target.'></a></div>' : '' );
						echo ( $of_cypress['soc_skype'] ? '<div><a href="'.$of_cypress['soc_skype'].'" title="Skype" class="fs" aria-hidden="true" data-icon="&#xe13f;"'.$target.'></a></div>' : '' );
						?>
					</div>
					<?php
					
					break;
					//////////////////////////////////////////
					case 'Products search' :
					
						echo '<div style="width:'.$bl[1].'%;">';
						
							$cypress_woo_is_active ? as_get_product_search_form() : null;
						
						echo '</div>';
						
					break;
					//////////////////////////////////////////
					case 'Widgets block' :
					
					if ( is_active_sidebar( 'sidebar-header' ) ) {
						
						dynamic_sidebar( 'sidebar-header' ); 
						
					}
					
					break;
					//////////////////////////////////////////
					case 'Widgets block 2' :
					
					if ( is_active_sidebar( 'sidebar-header-2' ) ) {
						
						dynamic_sidebar( 'sidebar-header-2' ); 
						
					}
					
					break;
					//////////////////////////////////////////
					case 'Widgets block 3' :
					
					if ( is_active_sidebar( 'sidebar-header-3' ) ) {
						
						dynamic_sidebar( 'sidebar-header-3' ); 
						
					}
					
					break;
				}
			}
		}
	
	}
		
	?>
		
	<?php // if( wp_style_is('owl-theme', 'queue') ) { echo 'yes';} // if style is enqueued ?>
	
	
	</div><!-- .grid-container -->
	
</header>