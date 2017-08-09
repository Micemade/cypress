<?php

if(!class_exists('AS_Images_Slider')) {

	class AS_Images_Slider extends AQ_Block {
	
		function __construct() {
		
			$block_options = array (
				'name' => 'Images slider',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('AS_Images_Slider', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_image_add_new', array($this, 'add_image'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'main_title'	=> '',
				'title_style'	=> 'center',
				'items'			=> array(
									1 => array(
										'image'		=> '',
										'title'		=> 'New Image',
										'content'	=> '',
										'name'	=> ''
										
									)
								),
				'img_format'	=> 'thumbnail',
				'image_shape'	=> 'square',
				'slider_navig'	=> true,
				'slider_pagin'	=> true,
				'slider_timing'	=> '',
				'transition'	=> 'none',
				'items_desktop'	=>  4,
				'items_desktop_small' => 3,
				'items_tablet'	=>	2,
				'items_mobile'	=> 1
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			
			<div class="description half">
					
				<label for="<?php echo $this->get_field_id('main_title') ?>">Images Slider Block Title</label> <br/>
						
				<?php echo aq_field_input('main_title', $block_id, $main_title) ?>
					
			</div>
			
			<div class="description half last">
				
				<label for="<?php echo $this->get_field_id('title_style') ?>">Title style</label><br/>
				<?php
				$img_formats = array(
					'center'		=> 'Center',
					'float_left'	=> 'Float left',
					'float_right'	=> 'Float right'
					);
				echo aq_field_select('title_style', $block_id, $img_formats, $title_style); 
				?>	
			
			</div>
			
			<hr>
			
			<div class="description cf">
				
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$items = is_array($items) ? $items : $defaults['items'];
					$count = 1;
					foreach($items as $item) {	
						$this->create_item($item, $count);
						$count++;
					}
					?>
				</ul>
				
				<a href="#" rel="image" class="aq-sortable-add-new button">Add new image</a>
				
				
			</div>
			
			<hr>
			
			<div class="description half">
				
				<label for="<?php echo $this->get_field_id('img_format') ?>">Images format</label><br/>

				
				<?php
				$img_format_array = array(
					'thumbnail'		=> 'Thumbnail',
					'medium'		=> 'Medium',
					'as-portrait'	=> 'Cypress portrait',
					'as-landscape'	=> 'Cypress landscape',
					'large'			=> 'Large',
					'full'			=> 'Full'
					);
				echo aq_field_select('img_format', $block_id, $img_format_array, $img_format); 
				?>	
				
				<div class="clearfix"></div>
				
				<label for="<?php echo $this->get_field_id('image_shape') ?>">Images shape</label><br/>
				
				<p class="description">Applicable to "thumbnail" image format</p>
				
				<?php 
				$img_styles = array(
					'square'=> 'Square',
					'round' => 'Round',
					);
				echo aq_field_select('image_shape', $block_id, $img_styles, $image_shape) ?>
				
			</div>
			
			<div class="description half last">
			
				<label for="<?php echo $this->get_field_id('slider_pagin') ?>">Slider pagination</label><br />
				<?php echo aq_field_checkbox('slider_pagin', $block_id, $slider_pagin); ?>
				
				<div class="clearfix clear"></div>
						
				<label for="<?php echo $this->get_field_id('slider_navig') ?>">Slider navigation</label><br />
				<?php echo aq_field_checkbox('slider_navig', $block_id, $slider_navig); ?>
				<div class="clearfix clear"></div>
					
				<label for="<?php echo $this->get_field_id('slider_timing') ?>">Slider timing</label><br />
				<?php echo aq_field_input('slider_timing', $block_id, $slider_timing, $size = 'min');	?>
			
				<p class="description">Timing for auto sliding. Enter value in miliseconds (1sec=1000msec.). If left empty the slider won't auto slide.</p>
				
				<hr>
				
				<label for="<?php echo $this->get_field_id('transition') ?>">CSS transitions</label><br />
				<?php 
				$transitions = array(
					'none'		=> 'None',
					'fade'		=> 'Fade',
					'backSlide'	=> 'Back Slide',
					'goDown'	=> 'Go Down',
					'fadeUp'	=> 'Fade Up',
					);
				echo aq_field_select('transition', $block_id, $transitions, $transition) ?>
				
				<p class="description">NOTE: CSS transitions will automatically set item to 1, or to single item per slide.</p>
			
			</div>
			
			<hr>
			
			<p class="description"><strong>RESPONSIVE SETTINGS</strong> - set number of items for responsiveness (adaptive to mobile devices ):</p>
			
			<div class="description fourth">
			
				<label for="<?php echo $this->get_field_id('items_desktop') ?>">Items in desktop width</label><br />
				<?php echo aq_field_input('items_desktop', $block_id, $items_desktop, $size="min"); ?>
			
			</div>
			
			<div class="description fourth">
			
				<label for="<?php echo $this->get_field_id('items_desktop_small') ?>">Items in desktop smaller</label><br />
				<?php echo aq_field_input('items_desktop_small', $block_id, $items_desktop_small, $size="min"); ?>
			
			</div>
			
			<div class="description fourth">
			
				<label for="<?php echo $this->get_field_id('items_tablet') ?>">Items in tablet view</label><br />
				<?php echo aq_field_input('items_tablet', $block_id, $items_tablet, $size="min"); ?>
			
			</div>
			
			<div class="description fourth last">
			
				<label for="<?php echo $this->get_field_id('items_mobile') ?>">Items in mobile view</label><br />
				<?php echo aq_field_input('items_mobile', $block_id, $items_mobile, $size="min"); ?>
			
			</div>
			
			
			<?php
		}
		
		function create_item($item = array(), $count = 0) {
				
			?>
			<li id="<?php echo $this->get_field_id('items') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $item['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					
					<div class="tab-desc description half">
				
						<div class="screenshot member-image">
						
							<input type="hidden" class="placeholder" value="<?php echo PLACEHOLDER_IMAGE; ?>" />
							<a href="#" class="remove-media"><img src="<?php echo get_template_directory_uri(); ?>/admin/images/icon-delete.png" /></a>
							<?php
							if( !empty($item['image']) ) {					
								$imgurl = wp_get_attachment_image_src( $item['image'], 'thumbnail' );
								echo '<img src="'. $imgurl[0] .'" class="att-image" />';
							}else{
								echo '<img src="'. PLACEHOLDER_IMAGE .'" class="att-image" />';
							}
							?>
							
						</div>
						<br />
						
						<?php $thisID = $this->get_field_id('items') . '-' . $count .'-image'; ?>
						
						<label for="<?php echo $thisID; ?>">
							
							<?php //echo as_field_upload( $thisID , $thisID, $item['image'], 'thumbnail'); ?>
							<input type="hidden" id="<?php echo $thisID; ?>" class="input-full input-upload" value="<?php echo $item['image'] ?>" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][image]" data-size="thumbnail">
						
			
							<a href="#" class="aq_upload_button button" rel="image">Upload</a>
						
						
						</label>
						
					</div>	
			
					<div class="tab-desc description half last">
					
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title">
							Image title<br/>
							<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][title]" value="<?php echo $item['title'] ?>" />
						</label>
					
					<div class="clearfix"></div>
					
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content">
							Image caption<br/>
							<textarea id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $item['content'] ?></textarea>
						</label>
					</div>
				
					
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
					
				</div>
				
			</li>
			<?php
		}
		
		function block($instance) { // frontend output
			
			global $border_decor;
			
			$transition = 'none';
			
			extract($instance);
						
			$output = '';
			
			$output .= '<div id="aq_block_items_'. rand(1, 100) .'" class="aq_block_items">';
				
				$output .= $main_title ? '<h2 class="block-title '.$title_style .'">'.$main_title.'</h2><div class="block-title-border '.$border_decor.' '. $title_style .'"></div>' : null;
				
				$output .= '<input type="hidden" class="simpleslides-config" data-navigation="'. $slider_navig .'" data-pagination="'. $slider_pagin .'" data-auto="'.$slider_timing.'" data-desktop="'.$items_desktop.'" data-desktop-small="'.$items_desktop_small.'" data-tablet="'.$items_tablet.'" data-mobile="'.$items_mobile.'" '. (($transition != 'none') ? 'data-trans="'.$transition.'"' : '') . '/>';
				
				$output .= '<div class="image-slides'. (count($items) > 1 ? ' simpleslides' : null) .'">';
				
				$i = 1;
				
				foreach( $items as $item ) {
					
					$img = $item['image'];
					
					$output .= '<div class="single-slide '. $image_shape .'">';
					
					if( $item['image'] ) { 
					$output .= '<div class="image">';
						
						$attr = array(
							'class' => 'attachment-image',
							'title'	=> $item['title'] ? $item['title'] : null,
							'alt'	=> $item['title'] ? $item['title'] : null
						);
						
						$output .= wp_get_attachment_image( $img, $img_format, false,  $attr ); 

						$output .= '</div>';
					};
					
					$output .= '<div class="back"><div class="item-overlay">';
					
					$output .= '<div class="content" '. ( !$img ? 'style="width: 100%;"' : '' ).'>';
					$output .= ( $item['title'] && $item['title'] != 'New Image' ) ? '<h4>' .$item['title'] .'</h4>' : null;	
					$output .= '<p>'. $item['content'] .'</p>';
					$output .= '</div>'; // content
					
					$output .= '</div></div>'; // back, item-overlay
					
					$output .= '</div>'; // single-slide
					$i++;
				}
				
				$output .= '</div>';
				
			
			$output .= '</div>';
			
			echo $output;
			
		}
		
		/* AJAX add tab */
		function add_image() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the tab
			$image = array(
				'image'		=> '',
				'title'		=> 'New Image',
				'content'	=> '',
				'name'	=> ''
			);
			
			if($count) {
				$this->create_item($image, $count);
			} else {
				die(-1);
			}
			
			die();
		}
		
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}
}
