<?php
/**
 *	The template part used for displaying SINGLE portfolio item.
 *
 *	@since Cypress 1.0
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//
global $border_decor;
/**
 *	CUSTOM META FIELDS
 *
 */
// GENERAL CUSTOM META:
$hide_title		= get_post_meta( get_the_ID(),'as_hide_archive_titles' );
$hide_feat_img	= get_post_meta( get_the_ID(),'as_hide_featured_image' );
//
// PORTFOLIO META:
$image_format			= get_post_meta( get_the_ID(),'as_feat_port_image_format', true  );
$related_items_number	= get_post_meta( get_the_ID(),'as_related_portfolios', true  );
$button_url				= get_post_meta( get_the_ID(),'as_button_url', true  );
$button_label			= get_post_meta( get_the_ID(),'as_button_label', true  );
$single_layout			= get_post_meta( get_the_ID(),'as_single_layout', true );
//
//
// POST HAS CONTENT:
$has_content	= get_the_content();
// POST FORMAT VAR
$format			= get_post_format( get_the_ID() );
?>

<div class="portfolio-single">
	
	<?php 
	
	if( $single_layout == 'float_left' ){
	
		$grid_content	= 'grid-40';
		$grid_media 	= 'grid-60';
		
	}elseif( $single_layout == 'float_right' ){
	
		$grid_content	= 'grid-40 float_right';
		$grid_media 	= 'grid-60 float_right';
		
	}elseif( $single_layout == 'centered' ){
	
		$grid_content	= 'grid-100';
		$grid_media 	= 'grid-100';
		
	}else{
	
		$grid_content	= 'grid-40';
		$grid_media 	= 'grid-60';
		
	}	
	
	/************** IF STANDARD  ***************/
	if ( $format == '' ) { 
	
		if( has_post_thumbnail() && !$hide_featured_image ) {
			
			echo '<div class="'.$grid_media.'">';
					echo as_image( $image_format );
			echo '</div>';

		}
	/************** IF IMAGE  ***************/	
	}elseif( $format == 'image' ) {
		
		echo '<div class="'.$grid_media.'">';
		
		echo as_image( $image_format );
		
		echo '</div>';

	/************** IF GALLERY  ***************/
	}elseif( $format == 'gallery' ) {
	?>
		
	<div class="<?php echo $grid_media; ?>">
	
		<?php
		
		// WP GALLERY shortcode img id's
		$wpgall_ids			= apply_filters('as_wpgallery_ids','ids_wp_gallery');
		//
		// AS GALLERY POST META:
		//
		$gall_img_array		= get_post_meta( get_the_ID(),'as_gallery_images');
		$gall_image_format	= get_post_meta( get_the_ID(),'as_gall_image_format', true) ; 
		$slider_thumbs		= get_post_meta( get_the_ID(),'as_slider_thumbs', true); 
		$thumb_columns		= get_post_meta( get_the_ID(),'as_thumb_columns', true); 
		
		// image ID's from meta:
		$images_ids = '';
		if( !empty($wpgall_ids) ) {
			$images_ids = implode(', ', $wpgall_ids); // get images from WP gallery
		}else{
			$images_ids = implode(', ', $gall_img_array); // get images from AS gallery
		}
		
		// function to display images with link to larger:
		echo gallery_output( get_the_ID(), $images_ids, $slider_thumbs, $thumb_columns, $gall_image_format );
		?>
	
	</div>

	<?php	

	/************** IF AUDIO  ***************/	
	}elseif( $format == 'audio' ) {
		
	?>
		<div class="<?php echo $grid_media; ?>">
				
			<?php
			if( has_post_thumbnail() && !$hide_featured_image ) {
				
				echo as_image( $image_format );
				
			} 
			?>
			
			<div class="post-content" >
			<?php
			$audio_file_id	= get_post_meta( get_the_ID(),'as_audio_file', true);
			$audio_file		= wp_get_attachment_url( $audio_file_id );
			
			if( $audio_file ){
			
				$attr = array(
					'src'      => $audio_file,
					'loop'     => false,
					'autoplay' => false,
					'preload'  => 'none'
				);
				
				echo wp_audio_shortcode($attr);
			} 
			?>
			</div>
			
		</div>
		
			
	<?php
	/************** IF VIDEO  ***************/	
	}elseif( $format == 'video' ) { 
		
		$video_host	= get_post_meta( get_the_ID(),'as_video_host', true);
		$video_id	= get_post_meta( get_the_ID(),'as_video_id', true);
		$w			= get_post_meta( get_the_ID(),'as_video_width', true);
		$h			= get_post_meta( get_the_ID(),'as_video_height', true);
		?>
		<div class="<?php echo $grid_media; ?>">
			
			<div class="post-content" >
			<?php
			if( $video_host ){
				do_action('as_embed_video_action', $video_host, $video_id, $w, $h );
			};
			?>
			</div>
			
		</div>
		
		
	<?php	
	/************** IF QUOTE  ***************/
	}elseif( $format == 'quote' ) {

		$quote_author	= get_post_meta( get_the_ID(),'as_quote_author');
		$quote_url		= get_post_meta( get_the_ID(),'as_quote_author_url');
		$avatar			= get_post_meta( get_the_ID(),'as_avatar_email');
		$grid_content	= "grid-100";
		
	?>
	<div class="grid-100">
			
		<div class="post-content" >
		
			<?php 
			if( $avatar || has_post_thumbnail() ) {?>
			<div class="avatar-img">
			
				<?php 
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
				the_content(); 
				echo $quote_url ? '<a href="'.$quote_url.'" title="'. $quote_author .'">' : '';
				echo $quote_author ? '<h5>'.$quote_author.'</h5>' : '';
				echo $quote_url ? '</a>' : '';
				?>

			</div>
		
		</div>
		
	</div>
		
		
		<?php

	}	// endif	
	?>

	<div class="<?php echo isset($grid_content) ? $grid_content : 'grid-50'; ?>">
	
		<?php if( $format != 'quote') { ?>
		<div class="post-content">
		
			<?php $has_content ? the_content() : null; ?>
			
		</div><!--post-content -->	
		<?php }; ?>
		
		
		<?php if( $button_url && $button_label ) {?>
			<div class="button-holder"><a class="button" target="_blank" href="<?php echo esc_attr($button_url); ?>" title="<?php echo esc_attr($button_label); ?>" ><?php echo esc_html($button_label); ?></a></div>
		<?php }; ?>
		
		
		<?php
		// LINK BACK TO PORTFOLIO TEMPLATE PAGE
		if( isset( $_SESSION['template'] ) ) {
			$template = $_SESSION['template'];
		}else{
			$template = '';
		}
		echo $template ? '<div class="button-holder"><a href="'. $template . '" target="_self" class="button">'. __('&laquo; Back to portfolio','cypress') .'</a></div>' : '';
		// end LINK BACK
		?>


		<div class="clearfix"></div>
	
	</div>

<div class="clearfix"></div>

<div class="article-border"></div>	

<?php 
if( $related_items_number ) {

	get_template_part('portfolio','related');

}; 
?>

<div class="article-border <?php echo $border_decor; ?>"></div>	