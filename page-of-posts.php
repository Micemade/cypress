<?php
/**
 * Template Name: Page of posts
 *
 * Page to display posts archive
 *
 * @since cypress1.0
 **/
get_header(); 
// 
global $of_cypress, $cypress_woo_is_active;
//
$header_icons			= $of_cypress['header_icons'];
$layout 				= $of_cypress['layout'];
// CUSTOM META:
$hide_title =  get_post_meta( get_the_ID() ,'as_hide_title', true);
// VARS FOR FULL WIDTH AND/OR SHOP:
if( $cypress_woo_is_active ) {
	$is_shop = ( is_shop() || is_woocommerce() || is_cart() || is_checkout() || is_account_page()) ? true : false ;
}else{
	$is_shop = false;
}
?>

<?php if( !$hide_title  ) { ?>				
<header class="page-header">

	<?php	
	$shop_title_bcktoggle = $of_cypress['shop_title_bcktoggle'];
	$shop_title_backimg = $of_cypress['shop_title_backimg'];
	
	if( $shop_title_bcktoggle && $shop_title_backimg && $is_shop ) {
		
		$image =  $shop_title_backimg;
		
		echo'<div class="header-background" style="background-image: url('.$image.');"></div>';
		
	}elseif( has_post_thumbnail() ) {
		// get image by attachment id:
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'as-landscape' );
		$image = $image[0];
		
		echo'<div class="header-background" style="background-image: url('.$image.');"></div>';
	}else{
		$image = '';
	}
	?>
	
	<div class="grid-container">
	
		<div class="grid-100">
		
			<h1 class="page-title"><?php esc_html(the_title()); ?></h1>
		
		</div>
		
	</div><!-- /.grid-container -->

</header>

<?php if( $image ) { ?>
<div class="grid-container">
	
	<div class="grid-100"><span class="title-border<?php echo !$header_icons ? '-no-icon' : null; ?>"></span></div>
	
</div>

<?php 
} // end if $image 
 
} // end if !hide_title
?>



<div class="grid-container">
	
	<div id="primary" class="grid-<?php echo ( $layout =='full_width' ) ? '100' : '75'; ?> <?php echo $layout ? $layout : null; ?> tablet-grid-100 mobile-grid-100" role="main">

		
		<?php while ( have_posts() && get_the_content() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

		<?php endwhile;  ?>

		<?php

		//$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		if ( get_query_var('paged') ) { 
			$paged = get_query_var('paged'); 
		}elseif ( get_query_var('page') ) { 
			$paged = get_query_var('page'); 
		}else { 
			$paged = 1;
		}

		$args = array(
				//'post_type' => 'post',
				'paged' => $paged,
				'orderby' => 'date',
				'order' => 'DESC',
				'ignore_sticky_posts' => 1
				);
		query_posts( $args );
		?>
		
		
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
			
				<?php get_template_part( 'content', get_post_format() ); ?>
				
			<?php endwhile; 
			
				as_show_pagination() ? as_pagination( 'nav-below' ) : null;
			
			else : 
			?>

			<article id="post-0" class="post no-results not-found">

			<?php if ( current_user_can( 'edit_posts' ) ) :
				// Show a different message to a logged-in user who can add posts.
			?>
					
				<h2 class="post-title"><?php _e( 'No posts to display', 'cypress' ); ?></h2>

				<div class="post-content">
				
					<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'cypress' ), admin_url( 'post-new.php' ) ); ?></p>
					
				</div><!-- .entry-content -->

			<?php else :
				// Show the default message to everyone else.
			?>
				
				<h2 class="post-title"><?php _e( 'No posts found on this site', 'cypress' ); ?></h2>
				

				<div class="post-content">
				
					<p><?php _e( 'We are sorry, but no results were found. Try search ti find a related post.', 'cypress' ); ?></p>
					
					<?php get_search_form(); ?>
				
				</div><!-- .entry-content -->
				
			<?php endif; // end current_user_can() ?>

			</article><!-- #post-0 -->

		<?php endif; // end have_posts() ?>

	</div><!-- #primary -->

	<?php
	if( $layout != 'full_width' ) {
		
		$is_shop ? do_action('woocommerce_sidebar') : get_sidebar();
	}
	?>
	
</div><!-- .grid-container -->

<?php get_footer(); ?>