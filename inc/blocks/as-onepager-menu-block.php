<?php
/* 
 * Aligator Studio One Pager Menu block 
 */
if(!class_exists('AS_Onepager_Menu')) {
	
	class AS_Onepager_Menu extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Onepager menu',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('AS_Onepager_Menu', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_menu_item_add_new', array($this, 'add_menu_item'));
			
		}
		
		function form($instance) {
		
			if ( !wp_script_is( 'select2', 'enqueued' )) {
				
				wp_register_script( 'select2', get_template_directory_uri() . '/inc/blocks/select2/select2.min.js');
				wp_enqueue_script( 'select2' );
				
				wp_register_style( 'select2-css',get_template_directory_uri() . '/inc/blocks/select2/select2.css','', '', 'all' );
				wp_enqueue_style( 'select2-css' );
			}
			
			
			
			$defaults	= array(
				'menu_items'	=> array(
					1 => array(
						'title'		=> 'New menu item',
						'content'	=> '',
						'external'	=> false,
						'icon'		=> ''
					)
				),
				'sticky'		=> true,
				'margin'		=> '',
				'clone'			=> false,
				'back_color'	=> '',
				'menu_style'	=> 'style1',
				'menu_align'	=> 'centered',
				'attach_id'		=> '',
				'img_format'	=> 'thumbnail'
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			
			?>
			<div class="description cf">
				
				<p class="description notice"><strong>Copy the ROW ID value ( from the top of each row block ) AFTER you save the template, to "Menu item anchor link".</strong></p>
				
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$menu_items = is_array($menu_items) ? $menu_items : $defaults['menu_items'];
					$count = 1;
					foreach($menu_items as $menu_item) {	
						$this->create_menu_item($menu_item, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="menu_item" class="aq-sortable-add-new button"><?php _e('Add new menu item','cypress'); ?></a>
				<p></p>
			</div>
			
			<hr>
			
			<div class="description third">
			
				<label for="<?php echo $this->get_field_id('sticky') ?>"><?php _e('Make menu sticky ?','cypress');?><br><small>Not applied if copied to side menu/header menu</small></label>
				
				<?php echo aq_field_checkbox('sticky', $block_id,  $sticky) ;?>
				
				
				<div class="clearfix"></div>

				
				<label for="<?php echo $this->get_field_id('clone') ?>"><?php _e('Copy menu to side menu / header menu ?','cypress');?></label><br />
				
				<?php //echo aq_field_checkbox('clone', $block_id,  $clone) ;?>
				<?php
				$clone_arr = array(
					''			=> '',
					'above'		=> 'Above the main menu',
					'bellow'	=> 'Bellow the main menu',
					'replace'	=> 'Replace the main menu'
					);
				echo aq_field_select('clone', $block_id, $clone_arr, $clone); 
				?>
			
			</div>
			
			<div class="description third">
			
				<label for="<?php echo $this->get_field_id('back_color') ?>"><?php _e('Background color','cypress'); ?>
				</label><br />
				<?php echo aq_field_color_picker('back_color', $this->block_id, $back_color ) ?>
				
				<p class="description">This color value overrides default and (if set) the body background color value (set in Theme options) </p>
			
			</div>
			
			<div class="description third last">
				<label for="<?php echo $this->get_field_id('menu_style') ?>"><?php _e('Menu style','cypress'); ?></label>
				<br/>
				<?php
				$menu_style_arr = array(
					'style1'	=> 'Style 1 (default)',
					'style2'	=> 'Style 2'
					);
				echo aq_field_select('menu_style', $block_id, $menu_style_arr, $menu_style); 
				?>

				<div class="clearfix"></div>
			
				<label for="<?php echo $this->get_field_id('menu_align') ?>"><?php _e('Menu aligment','cypress'); ?></label>
				<br/>
				<?php
				$menu_align_arr = array(
					'left'		=> 'Align left',
					'right'		=> 'Align right',
					'centered'	=> 'Centered'
					);
				echo aq_field_select('menu_align', $block_id, $menu_align_arr, $menu_align); 
				?>
				
				<div class="clearfix"></div>
				
				<label for="<?php echo $this->get_field_id('margin') ?>"><?php _e('Menu margin (in pixels)','cypress'); ?></label><br>
				<?php echo aq_field_input('margin', $block_id, $margin, $size = 'min') ?> px
			</div>
			

			
			
			<?php
		}
		
		function icons_array() {
			
			//ob_start();
			include ('as-icon-glyphs-select.php');
			//$icons_arr = ob_get_clean();
			return $icons_arr;

		}
		
		function create_menu_item($menu_item = array(), $count = 0) {
				
			?>
			<li id="<?php echo $this->get_field_id('menu_items') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $menu_item['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('menu_items') ?>-<?php echo $count ?>-title">
							Menu item label<br/>
							<input type="text" id="<?php echo $this->get_field_id('menu_items') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('menu_items') ?>[<?php echo $count ?>][title]" value="<?php echo $menu_item['title'] ?>" />
						</label>
					</p>
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('menu_items') ?>-<?php echo $count ?>-content">
							Menu item anchor link<br/>
							
							<input type="text" id="<?php echo $this->get_field_id('menu_items') ?>-<?php echo $count ?>-content" class="input-full" name="<?php echo $this->get_field_name('menu_items') ?>[<?php echo $count ?>][content]" value="<?php echo $menu_item['content'] ?>" />
							
							
						</label>
						
						
					</p>
					
					<div class="clearfix"></div>
					
					<div class="description half">
						<label for="<?php echo $this->get_field_id('external') ?>-<?php echo $count ?>-external"><?php _e('External link (not anchored)','cypress');?><br><small>For linking outside the one pager</small></label>
				
						<input type="checkbox" id="<?php echo $this->get_field_id('menu_items') ?>-<?php echo $count ?>-external" class="" name="<?php echo $this->get_field_name('menu_items') ?>[<?php echo $count ?>][external]"  <?php echo checked( 1, isset($menu_item['external']), false ); ?> value="1"/>
					</div>
					
					<div class="description half last">
					
						<label for="<?php echo $this->get_field_id('icons') ?>"><?php _e('Item icon','cypress'); ?></label>
						<br/>
						<?php 
						
						$icons_arr = $this->icons_array();
						$options = is_array($icons_arr) ? $icons_arr : array();
						?>
						
						<select id="<?php echo $this->get_field_id('menu_items') ?>-<?php echo $count ?>-icon" name="<?php echo $this->get_field_name('menu_items') ?>[<?php echo $count ?>][icon]" class="select-icons">
						
						<?php 
						$output = '';
						foreach( $options as $key=>$value ) {
							$output .= '<option value="'.$key.'" '.selected( $menu_item['icon'], $key, false ).'>'.htmlspecialchars($value). '</option>';
						}
						echo $output;
						
						?>
						</select>
						
				
						<script>
						<?php $select = $this->get_field_id('menu_items').'-'. $count .'-icon'; ?>
						jQuery(document).ready(function() { 
							
							function format(state) {
								if (!state.id) return state.text; // optgroup
								return "<span class='" + state.id.toLowerCase() + "'></span> " + state.text;
							}
							
							
							jQuery("#<?php echo $select; ?>").select2({
								formatResult: format,
								formatSelection: format,
								escapeMarkup: function(m) { return m; }
							}); 
						
						});
						</script>
					
						
					</div>
					
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			
			
			<?php
		}
		
		function before_block($instance) {
	 		
			extract($instance);
	 		
	 		
	 		echo '<div id="aq-block-'.$template_id.'-'.$number.'" class="aq-block aq-block-'.$id_base.' aq_'.$size.'  clearfix">';
	 	}
		
		
		
		function block($instance) {
			extract($instance);
			
			//wp_enqueue_script('jquery-ui-tabs');
			
			echo '<style>';
			if( $back_color ) {
			
				echo '#'.$block_id.' { background-color: rgba('.hex2rgb( $back_color ).', 0.9) !important; }';

			}
			echo '</style>';
			$sticky_class = ( $sticky && !$clone ) ? ' sticky-block' : '' ;
			
			$output = '';
			
			$output .= '<div id="'.$block_id.'" class="aq_block_onepager_menu '.$sticky_class.'">';
			
				$style = $margin ? 'style="margin:' . $margin .'px;"' : null;
				
				$to_header = $clone ? 'to-header' : null;
				
				$output .= '<div class="menu-toggler"><a href="#" title="'.__('Toggle categories','cypress').'" class="button iconized-button"><span class="fs" data-icon="&#xe05a;"></span></a></div>';
				
				$output .= '<ul class="taxonomy-menu onepager-menu '.$menu_style.' '.$menu_align.' '.$to_header. ' ' . $clone . '" id="onepager-'.$block_id.'" '. $style .'>';
				
				$i = 1;
				foreach( $menu_items as $menu_item ){
					
					if( isset($menu_item['external']) && $menu_item['external'] ) {
						$link = $menu_item['content'];
					}else{
						$link = '#' . sanitize_title( $menu_item['content'] );
					}
					
					$output .= '<li class="one-pager-item"><a href="'. $link . '"><div class="item-label"><span class="' . $menu_item['icon'] . '"></span> ' . $menu_item['title'] . '</div></a></li>';
					$i++;
				}
				
				$output .= '</ul>';
			
			$output .= '<div class="clearfix"></div></div>';

			$output .= '
			<script>
			jQuery(document).ready(function(){
				
				jQuery(function (){
				
					var navEl = jQuery("#onepager-'.$block_id.'");
					
					// IF IS TO BE MOVED TO SITE MENU / HEADER MENU:
					if( navEl.hasClass("to-header") ) {
					
						navEl.each( function () {
							
							var cloner = jQuery(this).parent().clone();
							
							// REPLACE MAIN MENU
							if( navEl.hasClass("replace") ) {
								jQuery( "#main-nav-wrapper" ).empty();
								cloner.prependTo( "#main-nav-wrapper" );
							}
							// PUT CLONE ABOVE MAIN MENU :
							if( navEl.hasClass("above") ) {
								cloner.prependTo( "#main-nav-wrapper" );
							}
							// PUT CLONE BELLOW THE MAIN MENU :
							if( navEl.hasClass("bellow") ) {
								cloner.appendTo( "#main-nav-wrapper" );
							}
							
							jQuery(this).parent().parent().remove(); // REMOVE ORIGINAL
							
							navEl = cloner; // now the cloned nav element is navEl object
								
						});
					
					}
					
					// ADDITIONAL OFFSET (based on menu s height):
					
					var mainParent			= navEl.parent(),
						
						addHeight			= mainParent.outerHeight(true),
						
						classesZeroOffset	= navEl.hasClass("to-header") || !mainParent.hasClass("sticky-block") ? true : false,
						
						offset		=  classesZeroOffset ?  0 : addHeight;
					
					// INITIALIZE THE ONEPAGE NAV PLUGIN:
					navEl.onePageNav({
						currentClass : "current",
						changeHash : false,
						scrollSpeed : 750,
						scrollOffset : 100,
						offsetPlus: offset

					});
					
				});
				
			});
			</script>
			';
		
		echo $output;
			
		}
		
		/* AJAX add tab */
		function add_menu_item() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the tab
			$menu_item = array(
				'title'		=> 'New Menu Item',
				'content'	=> '',
				'external'	=> false,
				'icon'		=> ''
			);
			
			if($count) {
				$this->create_menu_item($menu_item, $count);
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
