<?php
/**
 * The template for displaying Taxonomy pages.
 *
 * @since Cypress 1.0
 */

get_header();
// 
global $of_cypress;
$header_icons	= $of_cypress['header_icons'];
$layout			= $of_cypress['layout'];
?>


		
<header class="archive-header">

	<?php	
	$portfolio_title_bcktoggle	= $of_cypress['portfolio_title_bcktoggle'];
	$portfolio_title_backimg	= $of_cypress['portfolio_title_backimg'];
	
	if( $portfolio_title_bcktoggle ) {
		
		$image =  $portfolio_title_backimg;
		
		echo'<div class="header-background" style="background-image: url('.$image.');"></div>';
	}else{
		$image = '';
	}
	?>
	
	<div class="grid-container">		

		<div class="grid-100">
		
		<h1 class="archive-title">
		
			<small>
				<?php 
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				echo ucfirst( str_replace('_',' ',$term->taxonomy) );
				?> :
			</small>

			<?php echo $term->name; ?>
		
		</h1>

		<?php if ( category_description() ) : ?>
			<div class="term-description"><?php echo category_description(); ?></div>
		<?php endif; ?>
		
		</div>
		
	</div><!-- /.container -->	
	
</header><!-- .archive-header -->

<?php if( $image ) { ?>
<div class="grid-container<?php echo !$header_icons ? '-no-icon' : null; ?>">
	
	<div class="grid-100"><span class="title-border"></span></div>
	
</div>	
<?php } ?>		
	
<div class="grid-container">

	<div id="primary" class="grid-<?php echo (  $layout =='full_width' ) ? '100' : '75'; ?> <?php echo $layout ? $layout : null; ?> tablet-grid-100 mobile-grid-100" role="main">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<?php get_template_part( 'content', get_post_format() );

			endwhile;

			as_show_pagination() ? as_pagination( 'nav-below' ) : null;
			
		else :
		
			get_template_part( 'content', 'empty' );
		
		endif; ?>

	</div><!-- /#primary -->

	<?php get_sidebar(); ?>

	
</div><!-- /.container -->

<?php get_footer(); ?>