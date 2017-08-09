<?php
/**
 * The Sidebar containing the main widget area.
 */
global $wp_query, $of_cypress;
$layout			= $of_cypress['layout'];
$empty_sidebar	= $of_cypress['empty_sidebar_meta'];
?>

<?php if( $layout != 'full_width' ) { ?>

<span class="push-<?php echo $layout == 'float_left' ? '70' : '25' ?> sections-border<?php echo $layout == 'float_right' ? ' float_left' : null ?>"></span>

<?php }; 

$grid_perc = ( $layout == 'full_width' ) ? '100' : '25';
?>

<div id="secondary" class="widget-area grid-<?php echo $grid_perc; ?> <?php echo $layout == 'float_right' ? ' float_left' : null ?> tablet-grid-100 mobile-grid-100" role="complementary">
	
	<?php if (  is_active_sidebar( 'sidebar-shop' ) )  {
	
		dynamic_sidebar( 'sidebar-shop' );
	
	
	}else{ 
	
		if( $empty_sidebar == 'meta_login' ) { ?>
		
		<aside id="meta" class="widget">
		
			<h4 class="widget-title"><?php _e( 'Meta', 'cypress' ); ?></h4>
			<ul>
				<?php wp_register(); ?>
				<aside><?php wp_loginout(); ?></aside>
				<?php wp_meta(); ?>
			</ul>
			
		</aside>
		
	<?php
		
		}elseif( $empty_sidebar == 'empty_notice' ){
		
			echo '<p class="empty-sidebar">'. __("You haven't set any widget for Shop Sidebar. Please, add some widgets or choose Full width page in theme options or page custom meta settings.",'cypress') .'</p>';
		
		}
		?>

	<?php }; // end sidebar widget area ?>
	
	
</div><!-- #secondary .widget-area -->

<div class="clearfix"></div>	