<?php
/**
 *	The template part used for displaying page content - GALLERY template.
 *
 *	@since Cypress 1.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//
global $of_cypress, $border_decor;
//
// POST META:
$of_pm = isset( $of_cypress['post_meta'] ) ? $of_cypress['post_meta'] : array();
$date_author = isset($of_pm['date_author']) ? true : false;
$link = isset($of_pm['link']) ? true : false;
$categories_tags = isset($of_pm['categories_tags']) ? true : false;
$comments = isset($of_pm['comments']) ? true : false;
$post_format_icons = $of_cypress['post_format_icons'];
//
// CUSTOM META:
$hide_title		= get_post_meta( get_the_ID(),'as_hide_archive_titles', true);
$hide_feat_img	= get_post_meta( get_the_ID(), 'as_hide_featured_image', true);
//
$has_content = get_the_content();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php echo ( !$has_content ? 'style="margin-bottom:0;"' : '' ); ?>>
		
	
	<?php if( !$hide_title ) {?>	
	<a href="<?php esc_attr(the_permalink());?>" title="<?php esc_attr(the_title());?>" class="post-link">
	
		<h2 class="post-title"><?php the_title(); ?></h2>
		
		<?php echo $post_format_icons ? as_post_format_icon() : null; ?>
	</a>
	<?php }?>
	
	
	<a href="<?php esc_attr(the_permalink());?>" title="<?php esc_attr(the_title());?>" class="post-image-link">
		
		<?php
		echo as_image( 'as-landscape' );
		
		echo '<div class="caption">' ;
		echo '<h5>' . esc_html( get_the_title() ) .'</h5>';
		echo '<p>' . esc_html( post_thumbnail_caption() ) .'</p>';
		echo '</div>';
		
		?>
	
	</a>
	
	<?php 
	echo '<div class="post-content">';
	
	echo apply_filters('as_custom_excerpt', 150, true); 
	
	echo '</div>';


	$wlp_args = array( 
			'before'		=> '<div class="page-link"><p>' . __( 'Pages:', 'cypress' ) . '</p>',
			'after'			=> '</div>',
			'link_before'	=> '<span>',
			'link_after'	=> '</span>',
		);
	
	wp_link_pages( $wlp_args );
	?>
					
	<div class="clearfix"></div>
	
	<?php if( $link || $categories_tags || $comments ) {?>
	<div class="post-meta-bottom">
	
		<?php
		$link ? entryMeta_permalink() : null;
		$date_author ? entryMeta_dateUser() : null; 
		$comments ? entryMeta_comments() : null;
		
		if( ( has_category() || has_tag() || has_term( '', 'portfolio_category' ) || has_term( '', 'portfolio_tag' ))  && $categories_tags ) {
		entryMeta_cats_tags();
		}
		?>
		
	</div>
	<?php } ?>
	
	<div class="article-border <?php echo $border_decor; ?>"></div>

</article><!-- #post-<?php the_ID(); ?> -->