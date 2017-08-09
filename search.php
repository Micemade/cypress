<?php
/**
 * The template for displaying Search results.
 *
 * @since Cypress 1.0
 */

get_header();
//
global $of_cypress;
$header_icons = $of_cypress['header_icons'];
$layout = $of_cypress['layout'];
?>	
		
<header class="archive-header">

	<?php	
	$blog_title_bcktoggle = $of_cypress['blog_title_bcktoggle'];
	$blog_title_backimg = $of_cypress['blog_title_backimg'];
	if( $blog_title_bcktoggle ) {
		
		$image =  $blog_title_backimg;
		
		echo'<div class="header-background" style="background-image: url('.$image.');"></div>';
	}
	?>
	
	<div class="grid-container">
			
		<h1 class="archive-title">
		
			<?php echo get_search_query(); ?>
			
		</h1>
		
		<div class="tagline"><?php echo __( 'Search result:', 'cypress' ); ?></div>
		
	</div><!-- /.grid-container -->	

</header><!-- .archive-header -->
				

<div class="grid-container">
	
	<div class="grid-100"><span class="title-border<?php echo !$header_icons ? '-no-icon' : null; ?>"></span></div>
	
</div>			

<div class="grid-container">

	<div id="primary" class="grid-<?php echo (  $layout =='full_width' ) ? '100' : '75'; ?> <?php echo $layout ? $layout : null; ?> " role="main">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 

			get_template_part( 'content', 'search' );
		
		endwhile;

			as_show_pagination() ? as_pagination( 'nav-below' ) : null;
		
		else :
		
		?>
		
		<article>
		
			<div class="search-notfound-text">
			
				<h3 class="mag_button"><?php echo __('Your search "','cypress') . get_search_query() . __('" did not return any result.','cypress'); ?></h3>
				
				<h5>
					<?php echo __('<ul><li>Please, try to:</li><li>click browser "Back" button,</li><li>use search to find what are you looking for,</li><li>use menu to browse our site,</li><li>or use sitemap bellow this message.</li></ul> ','cypress') ?>
				</h5>
				
				<?php get_template_part('site','map'); ?>
			
			</div>
		
		</article><!-- #primary -->
		
		
		
		<?php endif; ?>

	</div><!-- /#primary -->

	<?php get_sidebar(); ?>
	
</div><!-- /.grid-container -->
	

<?php get_footer(); ?>