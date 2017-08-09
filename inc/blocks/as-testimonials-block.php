<?php
/* Aqua Testimonials Block */
if(!class_exists('AS_Testimonials')) {
	
	class AS_Testimonials extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Testimonials',
				'size' => 'span6',
			);
			
			//create the widget
			parent::__construct('AS_Testimonials', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_item_add_new', array($this, 'add_testimonial'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'main_title'	=> '',
				'title_style'	=> 'center',
				'items'		=> array(
						1 => array(
							'image'		=> '',
							'title'		=> 'New Testimonial',
							'content'	=> '',
							'name'	=> ''
							
						)
					),
				'image_style'=> 'square',
				'slider_navig'		=> true,
				'slider_pagin'		=> true,
				'slider_timing'		=> '',
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			
			<div class="description">
					
				<label for="<?php echo $this->get_field_id('main_title') ?>">Testimonials Block Title </label><br/>
						
				<?php echo aq_field_input('main_title', $block_id, $main_title) ?>
					
			</div>
			
			<div class="description">
				<label for="<?php echo $this->get_field_id('title_style') ?>">
					Title style
				</label>	<br/>
				<?php
				$img_formats = array(
					'center'		=> 'Center',
					'float_left'	=> 'Float left',
					'float_right'	=> 'Float right'
					);
				echo aq_field_select('title_style', $block_id, $img_formats, $title_style); 
				?>	
			</div>
			
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
				
				<a href="#" rel="item" class="aq-sortable-add-new button">Add New Testimonial</a>
				
				
			</div>
			
			<div class="description">
				<label for="<?php echo $this->get_field_id('image_style') ?>">Images style</label><br/>
					
				<?php 
				$img_styles = array(
					'square'=> 'Square',
					'round' => 'Round',
					);
				echo aq_field_select('image_style', $block_id, $img_styles, $image_style) ?>
				
			</div>
			
			<div class="description">
			
				<label for="<?php echo $this->get_field_id('slider_pagin') ?>">Slider pagination</label><br />
				<?php echo aq_field_checkbox('slider_pagin', $block_id, $slider_pagin); ?>
				
				<div class="clearfix clear"></div>
						
				<label for="<?php echo $this->get_field_id('slider_navig') ?>">Slider navigation</label><br />
				<?php echo aq_field_checkbox('slider_navig', $block_id, $slider_navig); ?>
				<div class="clearfix clear"></div>
					
				<label for="<?php echo $this->get_field_id('slider_timing') ?>">Slider timing</label><br />
				<?php echo aq_field_input('slider_timing', $block_id, $slider_timing, $size = 'min');	?>
			
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
					
					<div class="tab-desc description">
				
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
			
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title">
							Testimonial Title<br/>
							<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][title]" value="<?php echo $item['title'] ?>" />
						</label>
					</p>
					
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content">
							Testimonial Content<br/>
							<textarea id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $item['content'] ?></textarea>
						</label>
					</p>
					
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-name">
							Name<br/>
							<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-name" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][name]" value="<?php echo $item['name'] ?>" />
						</label>
					</p>					
					
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
					
				</div>
				
			</li>
			<?php
		}
		
		function block($instance) { // frontend output
			
			global $border_decor;
			
			extract($instance);
						
			$output = '';
			
			$output .= '<div id="aq_block_items_'. rand(1, 100) .'" class="aq_block_items cb-4">';
				
				$output .= $main_title ? '<h2 class="block-title '.$title_style .'">'.$main_title.'</h2><div class="block-title-border '.$border_decor.' '. $title_style .'"></div>' : null;
				
				$output .= '<input type="hidden" class="slides-config" data-navigation="'. $slider_navig .'" data-pagination="'. $slider_pagin .'" data-auto="'.$slider_timing.'" />';
				
				$output .= '<ul class="testimonials'. (count($items) > 1 ? ' contentslides' : null) .'">';
				
				$i = 1;
				foreach( $items as $item ){
					
					$img = $item['image'];
					
					$output .= '<li class="testimonial-item">';
					if( $item['image'] ) { 
					$output .= '<div class="image '. $image_style .'">';
						
						$attr = array(
							'class' => 'attachment-image',
							'title'	=> $item['title'] ? $item['title'] : null,
							'alt'	=> $item['title'] ? $item['title'] : null
						);
						
						$output .= wp_get_attachment_image( $img, 'thumbnail', false,  $attr ); 
					
						$output .= '<div class="arrow-left"></div>';
						$output .= '</div>';
					};
					$output .= '<div class="content" '. ( !$img ? 'style="width: 100%;"' : '' ).'>';
					$output .= $item['title'] ? '<h4>' .$item['title'] .'</h4>' : null;	
					$output .= '<p>'. wpautop(do_shortcode(htmlspecialchars_decode($item['content']))) .'</p>';
					$output .= $item['name'] ? '<h6>' .$item['name'] .'</h6>' : null;	
					$output .= '</div>';
					$output .= '</li>';
					$i++;
				}
				
				$output .= '</ul>';
				
			
			$output .= '</div>';
			
			echo $output;
			
		}
		
		/* AJAX add tab */
		function add_testimonial() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the tab
			$item = array(
				'image'		=> '',
				'title'		=> 'New Testimonial',
				'content'	=> '',
				'name'	=> ''
			);
			
			if($count) {
				$this->create_item($item, $count);
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
