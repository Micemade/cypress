<?php
/**
 *	The template part used for displaying page content in page.php.
 *
 *	@since Cypress 1.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//
global $border_decor;
//
$has_content = get_the_content();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php echo ( !$has_content ? 'style="margin-bottom:0;"' : '' ); ?>>

	<div class="post-content">	
	
		<?php the_content(); ?>
			
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'cypress' ), 'after' => '</div>' ) ); ?>
						
	</div>
	
	<div class="clearfix"></div>
	
	<div class="article-border <?php echo $border_decor; ?>"></div>

</article><!-- #post-<?php the_ID(); ?> -->
