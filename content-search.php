<?php
/**
 *	The template part for search results.
 *
 *	@since Cypress 1.0 
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//
global $of_cypress, $border_decor;
//
// POST META theme options:
$of_pm				= isset( $of_cypress['post_meta'] ) ? $of_cypress['post_meta'] : array();
$date_author		= isset($of_pm['date_author']) ? true : false;
$link				= isset($of_pm['link']) ? true : false;
$categories_tags	= isset($of_pm['categories_tags']) ? true : false;
$comments			= isset($of_pm['comments']) ? true : false;
// other theme options:
$post_format_icons = $of_cypress['post_format_icons'];
//
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<a href="<?php the_permalink(); ?>" class="post-link" title="<?php echo get_the_title() ?>" >
		
		<?php echo $post_format_icons ? as_post_format_icon() : null; ?>

		<div class="search-text">
		
			<h2 class="post-title"><?php the_title(); ?></h2>	
			
		</div>
	</a>
	
	<div class="post-content">
	
		<p><?php echo apply_filters('as_custom_excerpt', 120, true); ?></p>
		
	</div>
	
	<div class="clearfix"></div>
	
	<div class="article-border <?php echo $border_decor; ?>"></div>
	
</article><!-- #post-<?php the_ID(); ?> -->



<div class="clearfix"></div>