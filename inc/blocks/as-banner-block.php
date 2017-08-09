<?php
if(!class_exists('AS_Banner_Block')) {
	
	class AS_Banner_Block extends AQ_Block {

		function __construct() {

			$block_options = array (
				'name' => 'Banner',
				'size' => 'span6',
			);
			
			parent::__construct('as_banner_block', $block_options);

		}
		
		function form($instance) {
	
			global $post;
			
			// default key/values array
			$defaults = array(
				'padding'			=> '60',
				'img_format'		=> 'medium',
				'back_size'			=> 'cover',
				'back_position'		=> 'center',
				'attach_id'			=> '',
				'title' 			=> '',
				'subtitle' 			=> '',
				'text'				=> '',
				'wp_autop'			=> 0,
				'title_size'		=> 'large',
				'text_color'		=> '#333333',
				'text_align'		=> 'center',
				'disable_invert'	=> false,
				'overlay'			=> '#ffffff',
				'overlay_opacity'	=> '',
				'block_opacity'		=> '',
				'border'			=> 'solid',
				'button_label'		=> '',
				'link'				=> ''
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
				
				<div class="clearfix"></div>
				
				<label for="<?php echo $this->get_field_id('img_format') ?>">Image format</label><br/>	
				<?php
				$img_formats = array(
					'thumbnail'		=> 'Thumbnail',
					'medium'		=> 'Medium',
					'as-portrait'	=> 'Cypress portrait',
					'as-landscape'	=> 'Cypress landscape',
					'large'			=> 'Large'
					);
				echo aq_field_select('img_format', $block_id, $img_formats, $img_format); 
				?>
				<label for="<?php echo $this->get_field_id('back_size') ?>"> Background size:</label> <br />
					<?php
					$back_size_arr = array(
						'' => '',
						'50%'=> '50%',
						'100% 100%'=> '100%',
						'cover'=> 'Cover',
						'contain'=> 'Contain'
					);
					echo aq_field_select('back_size', $this->block_id, $back_size_arr, $defaults['back_size']); 
					?>
					
				<label for="<?php echo $this->get_field_id('back_position') ?>">Background position</label><br/>
				<?php echo aq_field_input('back_position', $block_id, $back_position) ?>
			
			</div>	
			
			
			<div class="description half last">
				
				<label for="<?php echo $this->get_field_id('block_opacity') ?>"><?php echo __('Block opacity','cypress'); ?></label><br/>	
				<?php echo aq_field_input('block_opacity', $block_id, $block_opacity, 'min') ?> %
				
				<p class="description"><?php _e('If zero or empty, it will be ignored','cypress'); ?></p><hr>
				
				<div class="clearfix"></div>
				
				<label for="<?php echo $this->get_field_id('padding') ?>">Padding</label><br/>	
				<?php echo aq_field_input('padding', $block_id, $padding, 'min') ?> px
				
				<div class="clearfix"></div>
				
				<label for="<?php echo $this->get_field_id('overlay') ?>"><?php echo __('Overlay color','cypress'); ?>
				</label><br />
				<?php echo aq_field_color_picker('overlay', $this->block_id, $overlay, $defaults['overlay']) ?>	
				
				
				<div class="clearfix"></div>
				
				<label for="<?php echo $this->get_field_id('overlay_opacity') ?>"><?php echo __('Overlay opacity','cypress'); ?></label><br/>	
				<?php echo aq_field_input('overlay_opacity', $block_id, $overlay_opacity, 'min') ?> %
				
				<p class="description"><?php _e('If zero or empty, it will be ignored','cypress'); ?></p><hr>
				
				<div class="clearfix"></div>
				
				<label for="<?php echo $this->get_field_id('border') ?>">Border style</label><br/>	
				<?php
				$border_arr = array(
					'none'		=> 'None',
					'solid'		=> 'Solid',
					'dashed'	=> 'Dashed',
					'dotted'	=> 'Dotted',
					'double'	=> 'Double'
					);
				echo aq_field_select('border', $block_id, $border_arr, $border); 
				?>
				
			
			</div>
			
			<hr>
			
			<div class="clearfix"></div>
			
			<div class="description half">
				
				<label for="<?php echo $this->get_field_id('title') ?>">Title</label><br/>	
				<?php echo aq_field_input('title', $block_id, $title) ?>
			
				<label for="<?php echo $this->get_field_id('title_size') ?>">Title size</label><br/>
				<?php
				$title_sizes = array(
					'normal'		=> 'Normal',
					'medium'		=> 'Medium',
					'large'			=> 'Large',
					'extra_large'	=> 'Extra large',
					);
				echo aq_field_select('title_size', $block_id, $title_sizes, $title_size); 
				?>
				
				<label for="<?php echo $this->get_field_id('subtitle') ?>">Subtitle</label><br/>	
				<?php echo aq_field_input('subtitle', $block_id, $subtitle) ?>
			
			
			</div>	
			
			<div class="description half last">
			
				<label for="<?php echo $this->get_field_id('text') ?>">Text</label><br/>
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
				
				<div class="clearfix"></div>
				
				<label for="<?php echo $this->get_field_id('wp_autop') ?>">
				<?php echo aq_field_checkbox('wp_autop', $block_id, $wp_autop) ?>
				Do not create the paragraphs automatically. <code>"wpautop"</code> disable.
				</label>
				<br/>
				
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
				
				<div class="clearfix"></div>
				
				<label for="<?php echo $this->get_field_id('disable_invert') ?>">
				<?php echo aq_field_checkbox('disable_invert', $block_id, $disable_invert) ?>
				Disable invert colors on hover effect ?
				</label>
				
			
			</div>

			<hr>
			
			<div class="description half">
				
				<label for="<?php echo $this->get_field_id('button_label') ?>">Button label</label><br/>
				<?php echo aq_field_input('button_label', $block_id, $button_label) ?>
			
			</div>
			<div class="description half last">
				
				<label for="<?php echo $this->get_field_id('link') ?>">Button link</label><br/>
				<?php echo aq_field_input('link', $block_id, $link) ?>
			
			</div>
			
			<p class="description">The button will display only if BOTH label and link are set. If no label is set the link will apply to the whole block.</p>
			
			<div class="clearfix"></div>
			
			<?php
			} // function form
					
			function block($instance) {

				// default key/values array
				$defaults = array(
					'padding'			=> '60',
					'img_format'		=> 'medium',
					'back_size'			=> 'cover',
					'back_position'		=> 'center',
					'attach_id'			=> '',
					'title' 			=> '',
					'subtitle' 			=> '',
					'text'				=> '',
					'wp_autop'			=> 0,
					'title_size'		=> 'large',
					'text_color'		=> '#333333',
					'text_align'		=> 'center',
					'disable_invert'	=> false,
					'overlay'			=> '#ffffff',
					'overlay_opacity'	=> '',
					'block_opacity'		=> '',
					'border'			=> 'solid',
					'button_label'		=> '',
					'link'				=> ''
				);

				// set default values (if not yet defined)
				$instance = wp_parse_args($instance, $defaults);

				// import each array key as variable with defined values
				extract($instance);
			
			?>
			<style>
			<?php if( $attach_id ) {
				$img_data = wp_get_attachment_image_src( $attach_id, $img_format , false );
				$img_url = $img_data[0];
				echo '#'. $block_id.' { background-image: url('. $img_url .');';
				echo $back_position ? 'background-position: '.$back_position.';' : '';
				echo $back_size ? 'background-size: '.$back_size.';' : '';
				echo '}';
				};
			
				echo '#'.$block_id.', #'.$block_id.' h3, #'.$block_id.' .text, #'.$block_id.' .block-subtitle { color: '.$text_color.'; text-align: '. $text_align.';} ';
				
				
				$o_opacity = $overlay_opacity ? $overlay_opacity : 75;
				
				echo $overlay ? '#'.$block_id.' .overlay { 
					background-color: '.$overlay.'; 
					opacity:'. $o_opacity / 100 .'; 
					filter: alpha(opacity='. $o_opacity .');
					-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity='. $o_opacity .')";} ' : '';
				
				$double_border = ($border == 'double') ? 'border-width: 4px;' : null;
				echo '#'.$block_id.'.banner-block:before { border-style: '.$border.'; '.$double_border.'  }';

				
				echo $block_opacity ? '#'.$block_id.' { 
					opacity:'. $block_opacity / 100 .'; 
					filter: alpha(opacity='. $block_opacity .');
					-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity='. $block_opacity .')";} ' : '';
				
				
				
			?>
			</style>
			
			<?php echo (  $link && !$button_label ) ? '<a href="'.esc_url( $link ).'">' : null; ?>
			
			<div id="<?php echo $block_id; ?>" class="banner-block inner-wrapper<?php echo $disable_invert ? ' disable-invert' : null; ?>">
			
				<input type="hidden" class="varsHolder" data-boxColor = "<?php echo $overlay; ?>"  data-fontColor = "<?php echo $text_color; ?>" />
				
				<div class="overlay"></div>
				
				<?php
				$padd_add = $text ? 20 : null;
				$padd = 'style="padding:'.$padding.'px; "';//. ( $text ? 'padding-top:80px ;"' : '"' );
				
				echo '<div class="text-holder '. $text_align .'" '. $padd .'>';
				
				echo $title ? '<h3 class="'. $title_size .'">'. esc_html( $title ).'</h3>' :  null; 
				
				echo $subtitle ? '<div class="block-subtitle">'. esc_html( $subtitle ).'</div>' :  null; 
				
				//echo $text ? '<div class="text">'. esc_html( $text ).'</div>' :  null;
				
				echo $text ? '<div class="text">' : null; 

					$wp_autop = ( isset($wp_autop) ) ? $wp_autop : 0;
					if( $wp_autop == 1 ){
						echo do_shortcode(htmlspecialchars_decode($text));
					}
					else {
						echo wpautop(do_shortcode(htmlspecialchars_decode($text)));
					}
				
				echo $text ? '</div>' : null; 
				
				
				if ( $button_label && $link ) {
					
					echo '<div class="clearfix"></div>';
					echo '<a href="'.esc_url( $link ).'" title="'.esc_attr( $button_label ).'" class="button">';
					echo esc_html( $button_label );
					echo '</a>';
				} 				
				echo '</div>';
			
				?>

			</div>
			
			<?php echo (  $link && !$button_label ) ? '</a>' : null; ?>
			
			
		<?php 

		} // function block
	
	} // class
	
}// if !class_exists
?>