<?php

/* if ( !class_exists('JMO_Custom_Nav')) {
    class JMO_Custom_Nav {
        public function add_nav_menu_meta_boxes() {
        	add_meta_box(
        		'mega_menu',
        		__('Mega menu'),
        		array( $this, 'nav_menu_link'),
        		'nav-menus',
        		'side',
        		'low'
        	);
        }
        public function nav_menu_link() { ?>
        	<div id="posttype-wl-login" class="posttypediv">
        		<div id="tabs-panel-wishlist-login" class="tabs-panel tabs-panel-active">
        			<ul id ="wishlist-login-checklist" class="categorychecklist form-no-clear">
        				<li>
        					<label class="menu-item-title">
        						<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1"> Login/Logout Link
        					</label>
        					<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
        					<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="Login">
        					<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="<?php bloginfo('wpurl'); ?>/wp-login.php">
        					<input type="hidden" class="menu-item-classes" name="menu-item[-1][menu-item-classes]" value="wl-login-pop">
        				</li>
        			</ul>
        		</div>
        		<p class="button-controls">
        			<span class="list-controls">
        				<a href="/wordpress/wp-admin/nav-menus.php?page-tab=all&amp;selectall=1#posttype-page" class="select-all">Select All</a>
        			</span>
        			<span class="add-to-menu">
        				<input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-post-type-menu-item" id="submit-posttype-wl-login">
        				<span class="spinner"></span>
        			</span>
        		</p>
        	</div>
        <?php }
    }
}
 
$custom_nav = new JMO_Custom_Nav;
add_action('admin_init', array($custom_nav, 'add_nav_menu_meta_boxes'));
 */
/**
 *	CUSTOM MENU FIELDS
 *
 */
add_action( 'init', array( 'AS_Nav_Custom_Fields', 'setup' ) );
class AS_Nav_Custom_Fields {
		
	static $options = array();

	static function setup() {
		
		self::$options['fields'] = array(
			
			'mega'			=>array(
				'name'				=> 'megamenu',
				'label'				=> __('Mega menu holder', 'cypress'),
				'container_class'	=> 'mega-menu',
				'input_type' 		=> 'checkbox'
			),
			'clear'			=> array(
				'name'				=> 'clear',
				'label'				=> __('Clear for row ?', 'cypress'),
				'container_class'	=> 'mega-menu-clear',
				'input_type'		=> 'checkbox'
			),
			'image'			=> array(
				'name'				=> 'image',
				'label'				=> __('Custom image', 'cypress'),
				'container_class'	=> 'mega-menu-image',
				'input_type'		=> 'image'
			),
			'post_thumb'	=> array(
				'name'				=> 'post_thumb',
				'label'				=> __('Post thumb and excerpt ?', 'cypress'),
				'container_class'	=> 'mega-menu-postthumb',
				'input_type'		=> 'checkbox'
			)
		);
 
		/* add_filter( 'wp_edit_nav_menu_walker', function () {
			return 'AS_Walker_Nav_Menu_Edit';
		}); */
		
		add_filter( 'wp_edit_nav_menu_walker',	array( __CLASS__, '_as_walker_menu_edit' ));
		add_filter( 'as_nav_additional_fields',	array( __CLASS__, '_add_fields' ), 10, 6 );
		add_action( 'save_post',				array( __CLASS__, '_save_post' ) );
	}
	
	static function _as_walker_menu_edit() {
		return 'AS_Walker_Nav_Menu_Edit';
	}
	
	
	static function get_fields_schema() {
		$schema = array();
		foreach(self::$options['fields'] as $name => $field) {
			if (empty($field['name'])) {
				$field['name'] = $name;
			}
			$schema[] = $field;
		}
		return $schema;
	}
 
	static function get_menu_item_postmeta_key($name) {
		return '_menu_item_' . $name;
	}
	
 
	/**
	 * Inject the 
	 * @hook {action} save_post
	 */
	static function _add_fields($new_fields, $item_output, $item, $depth, $args, $current_object_id) {
		
		wp_enqueue_script('media-upload');
		wp_enqueue_media();
		
		$schema = self::get_fields_schema($item->ID);
		
		$new_fields = '';
		
		foreach($schema as $field) {
			
			$field['value'] = get_post_meta($item->ID, self::get_menu_item_postmeta_key($field['name']), true);
			$field['id'] = $item->ID;
						
			$new_fields .= '<div class="additional-menu-field-'.$field['name'].' description description-thin custom-menu-'.$field['name'].'">';
			$new_fields .= '<label for="edit-menu-item-'.$field['name'].'-'.$field['id'].'">'.$field['label'].'<br />';
			
			if( $field['input_type'] == 'image') {
				
				$field_id = 'edit-menu-item-'.$field['name'].'-'.$field['id'];
				$field_class = 'widefat code edit-menu-item-'.$field['name'];
				$field_name = 'menu-item-'.$field['name'].'['.$field['id'].']';
				
				
				$new_fields .= '<div class="image-holder">';
				$new_fields .= '<input type="hidden" class="placeholder" value="'. PLACEHOLDER_IMAGE .'" />';
				$new_fields .= '<a href="#" class="remove-media"><img src="'. get_template_directory_uri() .'/admin/images/icon-delete.png" /></a>';
							
					if( $field['value'] ) {					
						$imgurl = wp_get_attachment_image_src( $field['value'], 'thumbnail' );
						$new_fields .= '<img src="'. $imgurl[0] .'" class="att-image" />';
					}else{
						$new_fields .= '<img src="'. PLACEHOLDER_IMAGE .'" class="att-image" />';
					}
				
				$new_fields .= '<input type="hidden" id="'.$field_id.'" class="input-full input-upload '.$field_class.'" value="'.$field['value'].'" name="'.$field_name.'" data-size="thumbnail" />';
				
				$new_fields .= '<a href="#" class="as_upload_button button" rel="image">upload</a>';
				
				$new_fields .= '</div>';
				
			}else{
			
				$new_fields .= '<input type="'.$field['input_type'].'" ';
				$new_fields .= 'id="edit-menu-item-'.$field['name'].'-'.$field['id'].'"';
				$new_fields .= 'class="widefat code edit-menu-item-'.$field['name'].'"';
				$new_fields .= 'name="menu-item-'.$field['name'].'['.$field['id'].']"';
				
				
				if( $field['input_type'] == 'checkbox'){
					
					$new_fields .= 'value="1" '. checked( $field['value'], 1, false ) .' />';
				
				}else{
					$new_fields .= 'value="'.$field['value'].'" />';
				}
			
			}
			
			$new_fields .= '</label>';
			$new_fields .= '</div>';
			
		}
		return $new_fields;
	}
 
	/**
	 * Save the newly submitted fields
	 * @hook {action} save_post
	 */
	static function _save_post($post_id) {
		if (get_post_type($post_id) !== 'nav_menu_item') {
			return;
		}
		$fields_schema = self::get_fields_schema($post_id);
		foreach($fields_schema as $field_schema) {
			$form_field_name = 'menu-item-' . $field_schema['name'];
			$key = self::get_menu_item_postmeta_key($field_schema['name']);
			$value = isset( $_POST[$form_field_name][$post_id] ) ? stripslashes($_POST[$form_field_name][$post_id]) : '';				
			update_post_meta($post_id, $key, $value);
		}
	}
	

}
 
require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
class AS_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
	function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {
		$item_output = '';
		parent::start_el($item_output, $object, $depth, $args = array(), $current_object_id = 0);
		$new_fields = apply_filters( 'as_nav_additional_fields', '', $item_output, $object, $depth, $args, $current_object_id );
		// Inject $new_fields before: <div class="menu-item-actions description-wide submitbox">
		if ($new_fields) {
			$item_output = preg_replace('/(?=<div[^>]+class="[^"]*submitbox)/', $new_fields, $item_output);
		}
		$output .= $item_output;
	}
}

/**
 *	CUSTOM MENU LAYOUT
 *
 */
class My_Walker extends Walker_Nav_Menu
{	
	
	private $curItem;
	
	function start_lvl( &$output, $depth = 0, $args=array() ) {
		
		$currentItem = $this->curItem;
	
		$item_meta = get_post_meta($currentItem->ID);
		// CUSTOM MENU FIELDS -	megamenu: 
		if ( isset($item_meta['_menu_item_megamenu'][0]) || !empty($item_meta['_menu_item_megamenu'][0]) ) {
			$is_mega =  $item_meta['_menu_item_megamenu'][0];
		}else{
			$is_mega = '';
		}
		
		$output .= '<ul class="sub-menu'. ( $is_mega ? ' sf-mega' : '' ). '">';
	}
	
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		
		global $of_cypress;
		
		$this->curItem = $item;
		//	
		$wp_query;
		//		
		if( is_object($args) ) {
			
			$item_meta = get_post_meta($item->ID);
			/**
			 *	CUSTOM MENU FIELDS
			 *
			 */
			// megamenu: 
			if ( isset($item_meta['_menu_item_megamenu'][0]) || !empty($item_meta['_menu_item_megamenu'][0]) ) {
				$is_mega =  $item_meta['_menu_item_megamenu'][0];
			}else{
				$is_mega = '';
			}
			// megamenu new row: 
			if ( isset($item_meta['_menu_item_clear'][0]) || !empty($item_meta['_menu_item_clear'][0]) ) {
				$new_row =  $item_meta['_menu_item_clear'][0];
			}else{
				$new_row = '';
			}
			// megamenu image: 
			if ( isset($item_meta['_menu_item_image'][0]) || !empty($item_meta['_menu_item_image'][0]) ) {
				$image =  $item_meta['_menu_item_image'][0];
			}else{
				$image = '';
			}
			// megamenu post thumb: 
			if ( isset($item_meta['_menu_item_post_thumb'][0]) || !empty($item_meta['_menu_item_post_thumb'][0]) ) {
				$post_thumb =  $item_meta['_menu_item_post_thumb'][0];
			}else{
				$post_thumb = '';
			}
			// end getting post (nav_menu_item) meta

			
			/* Current item has any children? */
			$has_children = get_posts( array('post_type' => 'nav_menu_item', 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID) ); 
			$has_parent = get_post_ancestors( $item->ID );
			//
			//$indent = ( $depth ) ? str_repeat( "\t", $depth ) : ''; // disabled for eventual future use
			$indent ='';
			//
			$class_names = $value = '';
			//
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			//
			$class_names = array_shift($classes); // remove first class ( from menu editor - optional css )
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="'. esc_attr( $class_names ) . '"';
			$class_names = $has_children ? rtrim($class_names, '"').' dropdown"' : $class_names; 
			$class_names = $is_mega ? rtrim($class_names, '"').' mega-parent"' : $class_names;
			$class_names = $new_row ? rtrim($class_names, '"').' new-row"' : $class_names;
			$class_names = ( $image || $post_thumb ) ? rtrim($class_names, '"').' with-image"' : $class_names;
			
			//		
			
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
			
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			//$attributes .= ! empty( $item->classes[0] ) ? ' class="'  . esc_attr( $item->classes[0] ) .'"' : '';
			$attributes .= ! empty( $has_children ) 	? ' class="dropdown"' : '';
			
			if( ! empty( $item->classes[0] ) ) {
				
			}
			
			
			// start collecting item output:
			$item_output  = $args->before ? $args->before : '';
			$item_output .= '<a'. $attributes .'>' ;
			$item_output .= ! empty( $item->classes[0] ) ? '<span class="'.$item->classes[0].'"></span>' : null ;
			
			$item_output .= '<span>'.$args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after .'</span>';
			
			//
			/* DISPLAY DESCRIPTION ( menu additional fields )
			if( $item->description ) { 
				$item_output .= '<span class="desc">'. $item->description . '</span>';
			}else{
				$item_output .= '<span style="margin:0;padding:0; height:0; width:0" ></span>';	
			};
			$arrow = $depth >= 1 ? ' arrow-down' : ' arrow-right';
			*/
			
			if( !empty( $has_children ) ){
				
				if( $of_cypress['orientation'] == 'default' ) {
					$arrow = ' <span class="arrow arrow-right"></span>';
				}else{
					$arrow = ' <span class="arrow arrow-down"></span>';
				}
			
			}else{
				$arrow = '';
			}
			
			$item_output .= $arrow ? $arrow : '';
						
			$item_output .= '</a>';
			
			$item_output .= $args->after;
			//
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );	
			
			
			if( $image ) {
				$imgurl = wp_get_attachment_image_src( $image, 'thumbnail' );
				$output .= '<a href="'.esc_attr( $item->url ).'" class="menu-img-link"><img src="'. $imgurl[0] .'" class="att-image" /></a>';
			}

			if ( $depth >= 1 && $post_thumb ) {
				$output .= '<a href="'.esc_attr( $item->url ).'" class="menu-img-link">'. get_the_post_thumbnail( $item->object_id , 'thumbnail' ) .'</a>';
				
				$post_text = get_post( $item->object_id ); 
				$output .= '<div class="menu-post-excerpt">';
				
				$final_txt = $post_text->post_excerpt ? $post_text->post_excerpt :  $post_text->post_content;
				
				$output .= apply_filters( 'as_menu_excerpt', $final_txt, 50 ) . '<br />';
				
				$output .= '<a href="'.esc_attr( $item->url ).'" class="button">'. __('Read more','cypress') .'</a>';
				
				$output .= '</div>';
				
			}
		}
	}
}
/*
 *	MENU CLASSES REPLACEMENTS
 *
 */
function roots_wp_nav_menu($text) {
$replace = array(
		//'sub-menu'     => 'dropdown-menu',
		'current-menu-item'     => 'active',
		'current-menu-parent'   => 'active',
		'menu-item-type-post_type' => '',
		'menu-item-object-page' => '',
	);
	$text = str_replace(array_keys($replace), $replace, $text);
	return $text;
}
add_filter('wp_nav_menu', 'roots_wp_nav_menu');
//
?>