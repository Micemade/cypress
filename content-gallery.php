<?php
/**
 *	The template part used for displaying page content - GALLERY template
 *
 *	@since Cypress 1.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $of_cypress, $border_decor; // $border_decor defined in functions.php
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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
	
	
	<?php 
	// WP GALLERY shortcode img id's
	$wpgall_ids = apply_filters('as_wpgallery_ids','ids_wp_gallery');
	//
	// AS GALLERY POST META:
	//
	$gall_img_array		= get_post_meta( get_the_ID(),'as_gallery_images' );
	$gall_image_format	= get_post_meta( get_the_ID(),'as_gall_image_format', true ) ; 
	$slider_thumbs		= get_post_meta( get_the_ID(),'as_slider_thumbs', true ); 
	$thumb_columns		= get_post_meta( get_the_ID(),'as_thumb_columns', true ) ; 
	// image ID's from meta:
	$images_ids = '';
	
	
	if( !empty( $gall_img_array ) ) {
		foreach ( $gall_img_array as $gall_img_id ){
			$images_ids .= $gall_img_id .','; 
		}
	}
	if( !empty($wpgall_ids) ) {
		$images_ids = implode(', ', $wpgall_ids); // get images from WP gallery
	}else{
		$images_ids = implode(', ', $gall_img_array); // get images from AS gallery
	}
	
	
	// function to display images with link to larger:
	echo gallery_output( get_the_ID(), $images_ids, $slider_thumbs, $thumb_columns, $gall_image_format );
	
	?>
	
		
	<?php if( !$hide_title ) {?>
	<a href="<?php esc_attr(the_permalink());?>" title="<?php esc_attr(the_title());?>" class="post-link">
	
		<h2 class="post-title"><?php the_title(); ?></h2>
		
		<?php echo $post_format_icons ? as_post_format_icon() : null; ?>
	</a>	
	<?php } ?>
	
	
	<div class="post-content">
	
		<?php
		
		echo apply_filters('as_custom_excerpt', 150, true) ; 
		
		$wlp_args = array( 
				'before'		=> '<div class="page-link"><p>' . __( 'Pages:', 'cypress' ) . '</p>',
				'after'			=> '</div>',
				'link_before'	=> '<span>',
				'link_after'	=> '</span>',
			);
		
		wp_link_pages( $wlp_args );
		?>
	
	
	</div>
				
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