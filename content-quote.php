<?php
/**
 *	The template part used for displaying page content - QUOTE template.
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
// POST CUSTOM  META:
$quote_author	= get_post_meta( get_the_ID(),'as_quote_author', true);
$quote_url		= get_post_meta( get_the_ID(),'as_quote_author_url', true);
$avatar			= get_post_meta( get_the_ID(),'as_avatar_email', true);
//
$hide_title		= get_post_meta( get_the_ID(),'as_hide_archive_titles', true);
$hide_feat_img	= get_post_meta( get_the_ID(), 'as_hide_featured_image', true);
//
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
		
	<?php if( !$hide_title ) {?>
	<a href="<?php esc_attr(the_permalink());?>" title="<?php esc_attr(the_title());?>" class="post-link">
	
		<h2 class="post-title"><?php the_title(); ?></h2>
		
		<?php echo $post_format_icons ? as_post_format_icon() : null; ?>
	</a>
	<?php } ?>
	
	
	<div class="post-content">
		
		<?php if( $avatar || has_post_thumbnail() ) {?>
		<div class="avatar-img">
		
			<?php 
			$no_image = '';
			
			echo $quote_url ? '<a href="'.$quote_url.'" title="'. $quote_author .'">' : '';
			if( $avatar ) {
				echo get_avatar( $avatar , 120 );
			}elseif( has_post_thumbnail() ){
				the_post_thumbnail('thumbnail');
			}
			
			echo $quote_url ? '</a>' : '';
			?>
			
			<div class="arrow-left"></div>
			
		</div>
		<?php 
		}else{
			$no_image = ' no-image';
		};
		?>
	
		<div class="quote<?php echo $no_image; ?>">	
			
			<?php 
			echo '<p>' . apply_filters('as_custom_excerpt','full') . '</p>';
			echo $quote_url ? '<a href="'.$quote_url.'" title="'. $quote_author .'">' : '';
			echo $quote_author ? '<h5>'.$quote_author.'</h5>' : '';
			echo $quote_url ? '</a>' : '';
			?>
			
		</div>
	
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