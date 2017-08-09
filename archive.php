<?php
/**
 *	The template for displaying Archive pages.
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
	$blog_title_bcktoggle = $of_cypress['blog_title_bcktoggle'];
	$blog_title_backimg = $of_cypress['blog_title_backimg'];
	if( $blog_title_bcktoggle ) {
		
		$image = $blog_title_backimg;
		
		echo'<div class="header-background" style="background-image: url('.$image.');"></div>';
	}else{
		$image = '';
	}
	?>
	
	<div class="grid-container">
		
		<div class="grid-100">
		
		<h1 class="archive-title">
		<?php
			if ( is_day() ) :
				printf( __( 'Daily Archives: %s', 'cypress' ), '<span>' . get_the_date() . '</span>' );
			elseif ( is_month() ) :
				printf( __( 'Monthly Archives: %s', 'cypress' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'cypress' ) ) . '</span>' );
			elseif ( is_year() ) :
				printf( __( 'Yearly Archives: %s', 'cypress' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'cypress' ) ) . '</span>' );
			else :
				_e( 'Archives', 'cypress' );
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

</div><!-- /.grid-container -->

<?php get_footer(); ?>