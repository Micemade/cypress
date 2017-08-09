<?php
if(!class_exists('AS_Image_Block')) {
	
	class AS_Image_Block extends AQ_Block {

		function __construct() {

			$block_options = array (
				'name' => 'Image',
				'size' => 'span6',
			);
			
			parent::__construct('as_image_block', $block_options);

		}
		
		function form($instance) {
	
			global $post;
			
			// default key/values array
			$defaults = array(
				'img_format'		=> 'medium',
				'attach_id'			=> '',
				'caption_title' 	=> '',
				'caption_title_size'=> 'large',
				'text'				=> '',
				'text_color'		=> '#333333',
				'text_align'		=> 'center',
				'img_width'			=> '',
				'img_height'		=> ''
			);

			// set default values (if not yet defined)
			$instance = wp_parse_args($instance, $defaults);

			// import each array key as variable with defined values
			extract($instance);
			

			
			?>
			
			<div class="description half">
				
				<div class="screenshot member-image">
				
					<input type="hidden" class="placeholder" value="<?php echo PLACEHOLDER_IMAGE; ?>" />
					
					<a href="#" class="remove-media"><img src="<?php echo get_template_directory_uri(); ?>/admin/images/icon-delete.png" /></a>
					
					<?php
					if( $attach_id ) {					
						$imgurl = wp_get_attachment_image_src( $attach_id, 'thumbnail' );
						echo '<img src="'. $imgurl[0] .'" class="att-image" />';
					}else{
						echo '<img src="'. PLACEHOLDER_IMAGE .'" class="att-image" />';
					}
					?>
					
				</div>
				<br />
				<label for="<?php echo $this->get_field_id('attach_id') ?>">
					<?php echo as_field_upload('attach_id', $block_id, $attach_id, 'thumbnail'); ?>
				</label>
			</div>	
			
			<div class="description half last">
				
				<label for="<?php echo $this->get_field_id('img_format') ?>">Image format</label><br/>	
				<?php
				$img_formats = array(
					'thumbnail'		=> 'Thumbnail',
					'medium'		=> 'Medium',
					'as-portrait'	=> 'Portrait',
					'as-landscape'	=> 'Landscape',
					'large'			=> 'Large'
					);
				echo aq_field_select('img_format', $block_id, $img_formats, $img_format); 
				?>
				
				<hr>
				
				<label for="<?php echo $this->get_field_id('img_width') ?>">Image width</label><br/>
				<?php echo aq_field_input('img_width', $block_id, $img_width ) ?>
				
				<div class="clearfix"></div>
					
				<label for="<?php echo $this->get_field_id('img_height') ?>">Image height</label><br/>
				<?php echo aq_field_input('img_height', $block_id, $img_height ) ?>

				
				<p class="description">If left empty, the image format settings will be used.</p>
			
			</div>	
			
			<hr>
			
			<div class="clearfix"></div>
			
			<div class="description half">
				
				<label for="<?php echo $this->get_field_id('caption_title') ?>">Caption title</label><br/>	
				<?php echo aq_field_input('caption_title', $block_id, $caption_title) ?>
			
				<label for="<?php echo $this->get_field_id('title_size') ?>">Caption title size</label><br/>
				<?php
				$caption_title_sizes = array(
					'normal'		=> 'Normal',
					'medium'		=> 'Medium',
					'large'			=> 'Large',
					'extra_large'	=> 'Extra large',
					);
				echo aq_field_select('caption_title_size', $block_id, $caption_title_sizes, $caption_title_size); 
				?>

		
			
			</div>	
			
			<div class="description half last">
			
				<label for="<?php echo $this->get_field_id('text') ?>">Text</label><br/>
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
				
				
				<div class="clearfix"></div>
				
				<label for="<?php echo $this->get_field_id('text_color') ?>">Text and title color
				</label><br />
				<?php echo aq_field_color_picker('text_color', $this->block_id, $text_color, $defaults['text_color']) ?>
				
				<label for="<?php echo $this->get_field_id('text_align') ?>">Text float</label><br/>	
				<?php
				$text_aligns = array(
					'center'	=> 'Center',
					'left'		=> 'Left',
					'right'		=> 'Right'
					);
				echo aq_field_select('text_align', $block_id, $text_aligns, $text_align); 
				?>
				
				
			
			</div>

			
			
			<div class="clearfix"></div>
			
			<?php
			} // function form
					
			function block($instance) {

			// import each array key as variable with defined values
				extract($instance);
			
			?>
			<style>
			<?php 
			// Title and text color and align
			echo '#'.$block_id.', #'.$block_id.' h3, #'. $block_id. ' .text { ';
			echo $text_color ? 'color: '. $text_color. ';' : null;
			echo $text_align ? 'text-align: '. $text_align. ';' : null;
			echo '}';
			

			?>
			</style>
			

			
			<div id="<?php echo $block_id; ?>" class="image-block inner-wrapper item">
			
				
				<div class="item-images">
				<div class="item-img">
				
					<div class="front">
				
						<?php
						echo get_unattached_image( $attach_id, $img_format, $img_width, $img_height, $caption_title  );
						?>
						
					</div>
					
					
					<div class="back">
					
						<div class="item-overlay"></div>
						
						<?php
						$padd_add	= $text ? 20 : null;
						
						echo '<div class="text-holder '. $text_align .'">';
						
						echo $caption_title ? '<h3 class="'. $caption_title_size .'">'. esc_html( $caption_title ).'</h3>' :  null; 
										
						echo $text ? '<div class="text">'. esc_html( $text ).'</div>' :  null; 
						
						if( $attach_id ) {
						
							$big_img_data = wp_get_attachment_image_src( $attach_id, 'full', false );
							$big_img_url = $big_img_data[0];
						
							if( $caption_title || $text ) {
							
								echo '<a href="'.$big_img_url.'" class="button tiny radius iconized-button" data-rel="prettyPhoto" title="'. esc_attr($caption_title ) .'">'.as_post_format_icon_action().'</a>';
								
							}
						}
						
						echo '</div>';
						
						if( !$caption_title && !$text ) {
							
							if( $attach_id ) {
						
								$big_img_data = wp_get_attachment_image_src( $attach_id, 'full', false );
								$big_img_url = $big_img_data[0];
								
								echo '<a href="'.$big_img_url.'" class="button centered tiny radius iconized-button" data-rel="prettyPhoto" title="'. esc_attr($caption_title ) .'">'.as_post_format_icon_action().'</a>';
						
							}
						}
						?>
					</div>
				
				</div><!-- item-img-->
				</div><!-- item-images-->
				
				<div class="clearfix"></div>

			</div>
						
			<div class="clearfix"></div>
			
		<?php 

		} // function block
	
	} // class
	
}// if !class_exists
?>