<?php
/**
 *	The template for displaying Category pages.
 *
 *	@since Cypress 1.0
 */

get_header();
// 
global $of_cypress;
$header_icons = $of_cypress['header_icons'];
$layout = $of_cypress['layout'];
?>
		
<header class="archive-header">

	<?php	
	$blog_cat_title_bcktoggle = $of_cypress['blog_cat_title_bcktoggle'];
	$blog_cat_title_backimg = $of_cypress['blog_cat_title_backimg'];
	if( $blog_cat_title_bcktoggle ) {
		
		$image =  $blog_cat_title_backimg;
		
		echo'<div class="header-background" style="background-image: url('.$image.');"></div>';
	}else{
		$image = '';
	}
	?>
	
	<div class="grid-container">
	
		<div class="grid-100">
		
		<h1 class="archive-title">
			<?php echo single_cat_title( '', false ); ?>
		</h1>

		<?php if ( category_description() ) : ?>
			<div class="term-description"><?php echo category_description(); ?></div>
		<?php endif; ?>
				
		</div>

	</div><!-- /.container -->		

</header><!-- .archive-header -->

<?php if( $image ) { ?>
<div class="grid-container">
	
	<div class="grid-100"><span class="title-border<?php echo !$header_icons ? '-no-icon' : null; ?>"></span></div>
	
</div>	
<?php } ?>	

<div class="grid-container">

	<div id="primary" class="grid-<?php echo (  $layout =='full_width' ) ? '100' : '75'; ?> <?php echo $layout ? $layout : null; ?> tablet-grid-100 mobile-grid-100" role="main">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		
			get_template_part( 'content', get_post_format() );
		
		endwhile;

			as_show_pagination() ? as_pagination( 'nav-below' ) : null;
		
		else :
		
			get_template_part( 'content', 'empty' );
		
		endif; ?>

	</div><!-- /#primary -->

	<?php get_sidebar(); ?>
	
</div><!-- /.container -->

<?php get_footer(); ?>