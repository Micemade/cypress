<?php
/* AS Social Block */
if(!class_exists('AS_Social')) {
	
	class AS_Social extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Social',
				'size' => 'span6',
			);
			
			//create the widget
			parent::__construct('AS_Social', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_field_add_new', array($this, 'add_field'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'main_title'	=> '',
				'subtitle'		=> '',
				'block_float'	=> 'center',
				'horiz_vert'	=> 'horiz',
				'items'		=> array(
							1 => array(
								'type'		=> 'phone',
								'title'		=> 'New Field',
								'content'	=> ''
							)
					),
				'facebook'		=> '',
				'twitter' 		=> '',
				'google'		=> '',
				'youtube'		=> '',
				'flickr'		=> '',
				'linkedin'		=> '',
				'vimeo'			=> '',
				'pinterest'		=> '',
				'dribbble'		=> '',
				'forrst'		=> '',
				'instagram'		=> '',
				'github'		=> '',
				'picassa'		=> '',
				'skype'			=> ''
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			
			<div class="description half">
					
				<label for="<?php echo $this->get_field_id('main_title') ?>">Social Block Title </label><br/>
						
				<?php echo aq_field_input('main_title', $block_id, $main_title) ?>
					
			</div>
			
			<div class="description half last">
					
				<label for="<?php echo $this->get_field_id('subtitle') ?>">Block subtitle (optional)</label>
				
				<?php echo aq_field_input('subtitle', $block_id, $subtitle, $size = 'full') ?>
					
			</div>
			
			<div class="description half">
				<label for="<?php echo $this->get_field_id('block_float') ?>">
					Title and block elements float
				</label>	<br/>
				<?php
				$img_formats = array(
					'center'		=> 'Center',
					'float_left'	=> 'Float left',
					'float_right'	=> 'Float right'
					);
				echo aq_field_select('block_float', $block_id, $img_formats, $block_float); 
				?>	
			</div>
			
			<div class="description half last">
				<label for="<?php echo $this->get_field_id('horiz_vert') ?>">
					Horizontal or vertical
				</label>	<br/>
				<?php
				$horiz_vert_arr = array(
					'horiz'	=> 'Horizontal',
					'vert'	=> 'Vertical'
					);
				echo aq_field_select('horiz_vert', $block_id, $horiz_vert_arr, $horiz_vert); 
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
				
				<a href="#" rel="field" class="aq-sortable-add-new button">Add New Field</a>
				
			</div>
			
			<div class="clearfix"></div>

			<a href="#" class="toggle-social button" rel="image">Social networks</a>
			
			<hr>
			
			<div class="social-fields">
			
				
				<div class="description fourth">
					
					<label for="<?php echo $this->get_field_id('facebook') ?>">Facebook</label><br/>
						
					<?php echo aq_field_input('facebook', $block_id, $facebook) ?>
					
				</div>
				
				<div class="description fourth">
					
					<label for="<?php echo $this->get_field_id('twitter') ?>">Twitter</label><br/>
						
					<?php echo aq_field_input('twitter', $block_id, $twitter) ?>
					
				</div>

				<div class="description fourth ">
					
					<label for="<?php echo $this->get_field_id('linkedin') ?>">LinkedIn</label><br/>
						
					<?php echo aq_field_input('linkedin', $block_id, $linkedin) ?>
					
				</div>			
				
				<div class="description fourth last">
				
					<label for="<?php echo $this->get_field_id('google') ?>">Google Plus</label><br/>
						
					<?php echo aq_field_input('google', $block_id, $google) ?>
					
				</div>
				
				
				<div class="clearfix"></div>
				<hr>
				
				
				<div class="description fourth">
				
					<label for="<?php echo $this->get_field_id('youtube') ?>">YouTube</label><br/>
						
					<?php echo aq_field_input('youtube', $block_id, $youtube) ?>
					
				</div>	
				
				<div class="description fourth">
					
					<label for="<?php echo $this->get_field_id('flickr') ?>">Flickr</label><br/>
						
					<?php echo aq_field_input('flickr', $block_id, $flickr) ?>
					
				</div>


				<div class="description fourth">
				
					<label for="<?php echo $this->get_field_id('vimeo') ?>">Vimeo</label><br/>
						
					<?php echo aq_field_input('vimeo', $block_id, $vimeo) ?>
					
				</div>	

					
				<div class="description fourth last">
					
					<label for="<?php echo $this->get_field_id('pinterest') ?>">Pinterest</label><br/>
						
					<?php echo aq_field_input('pinterest', $block_id, $pinterest) ?>
					
				</div>
				
				
				<div class="clearfix"></div>
				<hr>
				
				
				<div class="description fourth">
					
					<label for="<?php echo $this->get_field_id('dribbble') ?>">Dribbble</label><br/>
						
					<?php echo aq_field_input('dribbble', $block_id, $dribbble) ?>
					
				</div>
			
		
				<div class="description fourth">
				
					<label for="<?php echo $this->get_field_id('forrst') ?>">Forrst</label><br/>
						
					<?php echo aq_field_input('forrst', $block_id, $forrst) ?>
					
				</div>	
				
				<div class="description fourth">
					
					<label for="<?php echo $this->get_field_id('instagram') ?>">Instagram</label><br/>
						
					<?php echo aq_field_input('instagram', $block_id, $instagram) ?>
					
				</div>	
				
							
				
				<div class="description fourth last">
					
					<label for="<?php echo $this->get_field_id('github') ?>">Github</label><br/>
						
					<?php echo aq_field_input('github', $block_id, $github) ?>
					
				</div>
				
				
				<div class="clearfix"></div>
				<hr>

				
				<div class="description fourth ">
					
					<label for="<?php echo $this->get_field_id('picassa') ?>">Picassa</label><br/>
						
					<?php echo aq_field_input('picassa', $block_id, $picassa) ?>
					
				</div>
							
				<div class="description fourth last">
					
					<label for="<?php echo $this->get_field_id('skype') ?>">Skype</label><br/>
						
					<?php echo aq_field_input('skype', $block_id, $skype) ?>
					
				</div>
				
				<div class="clearfix"></div>
				<hr>	
				
			</div><!-- end social-fields -->
			
			<?php
		}
		
		function create_item($item = array(), $count = 0) {
				
			?>
			<li id="<?php echo $this->get_field_id('items') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $item['type'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					
					<div class="tab-desc description">
				
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-type">Field type</label><br/>	
						<?php
						$types_array = array(
							'any'			=> 'Any type',
							'phone'			=> 'Phone',
							'mobile'		=> 'Mobile',
							'email'			=> 'Email',
							'website'		=> 'Website',
							'address'		=> 'Address',
							'separator'		=> '-- Separator --'
							);	
							
						$options = is_array($types_array) ? $types_array : array();
						?>
						
						<select id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-type" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][type]">
						
						<?php 
						$output = '';
						foreach( $options as $key=>$value ) {
							$output .= '<option value="'.$key.'" '.selected( $item['type'], $key, false ).'>'.htmlspecialchars($value).'</option>';
						}
						echo $output;
						
						?>
						</select>
						
					</div>	
			
					<p class="tab-desc description">
						
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content">
							Field content</label><br/>
						<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-content" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][content]" value="<?php echo $item['content'] ?>" />
						
					
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
			
			$output .= '<div id="aq_block_items_'. rand(1, 100) .'" class="aq_block_items social-block '.$block_float .' '.$horiz_vert.'">';
				
				$output .= $subtitle ? '<div class="block-subtitle '. $block_float .' above">' . $subtitle . '</div>' : null;
				
				$output .= $main_title ? '<h2 class="block-title '.$block_float .'">'.$main_title.'</h2><div class="block-title-border '.$border_decor.' '. $block_float .'"></div>' : null;
			
				$output .= count($items) ? '<ul class="social-fields">' : null;
				
				$i = 1;
				foreach( $items as $item ){

					$cont = $item['content'];
					
					if( $cont ) {
					
						$output .= '<li class="field-item">';
					
						if( $item['type'] == 'phone'  ) {
						
							$output .= '<div class="fs" aria-hidden="true" data-icon="&#x5d;"> '.$cont.'</div>';
						
						}elseif( $item['type'] == 'mobile' ){
						
							$output .= '<div class="fs" aria-hidden="true" data-icon="&#x75;"> '.$cont.'</div>';
						
						}elseif( $item['type'] == 'email' ){
						
							$output .= '<div class="fs" aria-hidden="true" data-icon="&#xe102;"> <a href="mailto:'.$cont.'">'.$cont.'</a></div>';
						
						}elseif( $item['type'] == 'website' ){
						
							$output .= '<div class="fs" aria-hidden="true" data-icon="&#xe063;"> <a href="'.$cont.'">'.$cont.'</a></div>';
						
						}elseif( $item['type'] == 'address' ){
						
							$output .= '<div class="fs" aria-hidden="true" data-icon="&#x24;"> '.$cont.'</div>';
						
						}elseif( $item['type'] == 'any' ){
						
							$output .= $cont;
						
						}elseif( $item['type'] == 'separator' ){
						
							$output .= '<div class="field-separator" aria-hidden="true"></div>';
						
						}
						
						$output .= '</li>';
					
					}
					
					$i++;
				}
				
				$output .= count($items) ? '</ul>' : null;
				
				$output .=  '<div class="social-block-icons">';
				
				$output .=  $facebook ? '<div><a href="'.$facebook.'" title="Facebook" class="fs" aria-hidden="true" data-icon="&#xe10d;"></div></a>' : '';
				
				$output .=  $twitter ? '<div><a href="'.$twitter.'" title="Twitter" class="fs" aria-hidden="true" data-icon="&#xe111;"></div></a>' : '';
				
				$output .=  $linkedin ? '<div><a href="'.$linkedin.'" title="LinkedIn" class="fs" aria-hidden="true" data-icon="&#xe141;"></div></a>' : '';
				
				$output .=  $google ? '<div><a href="'.$google.'" title="Google plus" class="fs" aria-hidden="true" data-icon="&#xe109;"></div></a>' : '';
				
				$output .=  $youtube ? '<div><a href="'.$youtube.'" title="You Tube" class="fs" aria-hidden="true" data-icon="&#xe115;"></div></a>' : '';
				
				$output .=  $flickr ? '<div><a href="'.$flickr.'" title="Flickr" class="fs" aria-hidden="true" data-icon="&#xe11e;"></div></a>' : '';
				
				$output .=  $vimeo ? '<div><a href="'.$vimeo.'" title="Vimeo" class="fs" aria-hidden="true" data-icon="&#xe118;"></div></a>' : '';
				
				$output .=  $pinterest ? '<div><a href="'.$pinterest.'" title="Pinterest" class="fs" aria-hidden="true" data-icon="&#xe148;"></div></a>' : '';
				
				$output .=  $dribbble ? '<div><a href="'.$dribbble.'" title="Dribbble" class="fs" aria-hidden="true" data-icon="&#xe123;"></div></a>' : '';
				
				$output .=  $forrst ? '<div><a href="'.$forrst.'" title="Forrst" class="fs" aria-hidden="true" data-icon="&#xe125;"></div></a>' : '';
				
				$output .=  $instagram ? '<div><a href="'.$instagram.'" title="Instagram" class="fs" aria-hidden="true" data-icon="&#xe10e;"></div></a>' : '';
				
				$output .=  $github ? '<div><a href="'.$github.'" title="Github" class="fs" aria-hidden="true" data-icon="&#xe12c;"></div></a>' : '';
				
				$output .=  $picassa ? '<div><a href="'.$picassa.'" title="Picassa" class="fs" aria-hidden="true" data-icon="&#xe11f;"></div></a>' : '' ;
				
				$output .=  $skype ? '<div><a href="'.$skype.'" title="Skype" class="fs" aria-hidden="true" data-icon="&#xe13f;"></div></a>' : '' ;
				
				$output .=  '</div>'; // member-social
			
			
			$output .= '</div>';
			
			echo $output;
			
		}
		
		/* AJAX add tab */
		function add_field() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the tab
			$field = array(
				'type'		=> 'phone',
				'title'		=> 'New Field',
				'content'	=> ''
			);
			
			if($count) {
				$this->create_item($field, $count);
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
