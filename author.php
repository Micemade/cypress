<?php
/**
 *	The template for displaying Author Archive pages.
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
	$blog_author_title_bcktoggle = $of_cypress['blog_author_title_bcktoggle'];
	$blog_author_title_backimg = $of_cypress['blog_author_title_backimg'];
	if( $blog_author_title_bcktoggle ) {
		
		$image =  $blog_author_title_backimg;
		
		echo'<div class="header-background" style="background-image: url('.$image.');"></div>';
	}else{
		$image = '';
	}
	?>
	
	<div class="grid-container">
	
		<div class="grid-100">
		
		<h1 class="archive-title">
		<?php 
		if ( have_posts() ): the_post();
		printf( __( '<small>Author Archives:</small> %s', 'cypress' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
		endif;
		?>
		</h1>
		
		</div>
		
	</div><!-- /.grid-container -->		
		
</header><!-- .archive-header -->

<?php if( $image ) { ?>
<div class="grid-container">
	
	<div class="grid-100"><span class="title-border<?php echo !$header_icons ? '-no-icon' : null; ?>"></span></div>
	
</div>			
<?php } ?>

<div class="grid-container">

	<div id="primary" class="grid-<?php echo ( $layout =='full_width' ) ? '100' : '75'; ?> <?php echo $layout ? $layout : null; ?> tablet-grid-100 mobile-grid-100" role="main">

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