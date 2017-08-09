<?php
/**
 *	The main template file for blog posts.
 *
 *	@since Cypress 1.0 
 */

get_header();
//
global $of_cypress;
$header_icons	= $of_cypress['header_icons'];
$layout			= $of_cypress['layout'];
$index_title	= $of_cypress['index_title'];
?>

<header class="archive-header">

	<?php	
	$index_title_bcktoggle = $of_cypress['index_title_bcktoggle'];
	$index_title_backimg = $of_cypress['index_title_backimg'];
	if( $index_title_bcktoggle ) {
		
		$image =  $index_title_backimg;
		
		echo'<div class="header-background" style="background-image: url('.$image.');"></div>';
	}
	?>
	<div class="grid-container">
		
		<?php if( $index_title ) { ?>
		<div class="grid-100">
		
			<h1 class="archive-title"><?php bloginfo( 'name' );?></h1>
		
			<div class="tagline"><?php bloginfo( 'description' );?></div>
		
		</div>
		<?php }else{ ?>
			
			<div style="height:80px; display: block; background: none;"></div>
		
		<?php } ?>
		
	</div><!-- /.grid-container -->	
	

</header><!-- .archive-header -->


<div class="grid-container">
	
	<div class="grid-100"><span class="title-border<?php echo !$header_icons ? '-no-icon' : null; ?>"></span></div>
	
</div>	
<div class="grid-container">
	
	<div id="primary" class="grid-<?php echo ( $layout =='full_width' ) ? '100' : '75'; ?> <?php echo $layout ? $layout : null; ?> tablet-grid-100 mobile-grid-100" role="main">

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

	<?php get_sidebar(); ?>
	
</div><!-- .grid-container -->

<?php get_footer(); ?>