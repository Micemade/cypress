<?php
/* ======= ADMIN FUNCTIONS ======= */
//
// ADD ADMIN TOOLBAR LINK TO THEME DOCUMENTATION
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    // REMOVE MENU ITEM, like the Comments link, just by knowing the right $id
    //$wp_admin_bar->remove_menu('comments');
    // REMOVING SUBMENU like New Link.
    //$wp_admin_bar->remove_menu('new-link', 'new-content');
    // we can add a submenu item too
    $wp_admin_bar->add_menu( array(
        //'parent' => 'new-content',
        'id'	=> 'theme_documentation',
        'title'	=> __('<span><img src="'.get_template_directory_uri().'/img/admin_icon.png" /></span>Theme documentation'),
        'href'	=> get_template_directory_uri().'/documentation/',
		'meta'	=>  array( 
				//'html'		=> '',
				'class'		=> 'theme_documentation',
				//'onclick'	=> '',
				'target'	=> '_blank',
				'title'		=> 'Open theme documentation in new window/tab'
				)
    ) );
}
// and we hook our function via
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );
//
//
// FIXED NAVBAR MOVE DOWN IF THERE IS  WP TOOLBAR
function WP_toolbar_check () {
	if ( is_admin_bar_showing() ) {
		echo '<style>';
		echo '#site-menu, .vertical-layout .mega-clone, .mobile-sticky.stuck { top:32px !important; }';
		echo '@media screen and (max-width: 784px) { .mobile-sticky.stuck { top:46px !important; } }';
		echo '@media screen and (max-width: 600px) { .mobile-sticky.stuck { top:0 !important; } }';
		echo '</style>';
	}
}
add_action( 'wp_head', 'WP_toolbar_check' );
//
// PLUGIN INCLUDED - UNATTACH
//
/*************************************************************************
Plugin Name:  Unattach
Plugin URI:   http://outlandishideas.co.uk/blog/2011/03/unattach/
Description:  Allows detaching images and other media from posts, pages and other content types.
Version:      1.0.1
Author:       tamlyn
**************************************************************************/
//
//filter to add button to media library UI
function unattach_media_row_action( $actions, $post ) {
	if ($post->post_parent) {
		$url = admin_url('tools.php?page=unattach&noheader=true&&id=' . $post->ID);
		$actions['unattach'] = '<a href="' . esc_url( $url ) . '" title="' . __( "Unattach this media item.","cypress") . '">' . __( 'Unattach','cypress') . '</a>';
	}
	return $actions;
}
//action to set post_parent to 0 on attachment
function unattach_do_it() {
	global $wpdb;
	if (!empty($_REQUEST['id'])) {
		$wpdb->update($wpdb->posts, array('post_parent'=>0), array('id'=>$_REQUEST['id'], 'post_type'=>'attachment'));
	}
	wp_redirect(admin_url('upload.php'));
	exit;
}
//set it up
add_action( 'admin_menu', 'unattach_init' );
function unattach_init() {
	if ( current_user_can( 'upload_files' ) ) {
		add_filter('media_row_actions',  'unattach_media_row_action', 10, 2);
		//this is hacky but couldn't find the right hook
		add_submenu_page('tools.php', 'Unattach Media', 'Unattach', 'upload_files', 'unattach', 'unattach_do_it');
		remove_submenu_page('tools.php', 'unattach');
	}
}
//
//
//
/**
 *	CONTACT FORM FUNCTIONS
 *
 */
function hexstr($hexstr) {
	  $hexstr = str_replace(' ', '', $hexstr);
	  $hexstr = str_replace('\x', '', $hexstr);
	  $retstr = pack('H*', $hexstr);
	  return $retstr;
}
function strhex($string) {
	$hexstr = unpack('H*', $string);
	return array_shift($hexstr);
}
/**
 *	EDITOR IN META BOX ( PUT OTHER META BOXES ABOVE EDITOR)
 *
 */
add_action( 'add_meta_boxes', 'action_add_meta_boxes', 0 );
function action_add_meta_boxes() {
	global $post, $_wp_post_type_features;
	
	if( $post->post_type == 'page' )
		return;
		
	foreach ($_wp_post_type_features as $type => &$features) {
		if (isset($features['editor']) && $features['editor']) {
			unset($features['editor']);
			add_meta_box(
				'description',
				__('Content'),
				'content_metabox',
				$type, 'normal', 'default'
			);
		}
	}
	add_action( 'admin_head', 'action_admin_head'); //white background
}
function action_admin_head() {
	?>
	<style type="text/css">
		.wp-editor-container{background-color:#fff;}
	</style>
	<?php
}
function content_metabox( $post ) {
	echo '<div class="wp-editor-wrap">';
	//the_editor is deprecated in WP3.3, use instead:
	wp_editor($post->post_content, 'content', array('dfw' => true, 'tabindex' => 1) );
	echo '</div>';
}

/**
 *	WPML STUFF: 
 *
 */
if( class_exists('SitePress') ) {

	define( 'WPML_ON', true );
	
	if ( ! function_exists( 'languages_list' ) ) {
	function languages_list(){
		if(function_exists('icl_get_languages')) {
			$languages = icl_get_languages('skip_missing=0&orderby=code');
		}
		if(!empty($languages)){
			echo '<div id="language_list"><ul>';
			foreach($languages as $l){
				echo '<li>';
				if($l['country_flag_url']){
					if(!$l['active']) echo '<a href="'.$l['url'].'">';
					echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
					if(!$l['active']) echo '</a>';
				}
				/* // Language name:
				if(!$l['active']) echo '<a href="'.$l['url'].'">';
				echo icl_disp_language($l['native_name'], $l['translated_name']);
				if(!$l['active']) echo '</a>';
				*/
				echo '</li>';
			}
			echo '</ul></div>';
		}
	}
	}
	//
	//Custom theme WPML Translation Shortcode:
	function as_wpml_lang_shortcode( $atts, $content = null ) {
		extract(shortcode_atts(array('lang'      => '',), $atts));
		$lang_active = ICL_LANGUAGE_CODE;   
		if($lang == $lang_active){
			return $content;
		}
	}
	add_shortcode('wpml_translate', 'as_wpml_lang_shortcode');

}
/**
 *	end WPML STUFF
 *
 */

 
/**
 *	GRID CLASS DEPENDING ON NUMBER OF WIDGETS IN WIDGET AREA (SIDEBAR):
 *
 */
function product_widgets_params($params) {
	
	$sidebar_id = $params[0]['id'];

    if ( $sidebar_id == 'product-filters-widgets' ) {

        $total_widgets		= wp_get_sidebars_widgets();
        $sidebar_widgets	= count($total_widgets[$sidebar_id]);
		$grid_width			= floor(100 / $sidebar_widgets);

        $classes 	= array();
		$classes[] 	= 'grid-' . $grid_width ;
		$classes[]	= 'tablet-grid-'. $grid_width . ' mobile-grid-100';
		$class		= implode(' ', $classes );
		
		$params[0]['before_widget'] = str_replace('aside class="', 'aside class="'. $class .' ', $params[0]['before_widget']);

    }
    return $params;
}
add_filter('dynamic_sidebar_params','product_widgets_params');
/**
 *	FUNCTION HEX TO RGB - NEEDED FOR CSS BACKGROUND COLOR STYLES
 *
 */
function hex2rgb( $colour ) {
	
	if( !isset($colour[0]) )
		return;
	if ( $colour[0] == '#' ) {
			$colour = substr( $colour, 1 );
	}
	if ( strlen( $colour ) == 6 ) {
			list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
	} elseif ( strlen( $colour ) == 3 ) {
			list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
	} else {
			return false;
	}
	$r = hexdec( $r );
	$g = hexdec( $g );
	$b = hexdec( $b );
	//return array( 'red' => $r, 'green' => $g, 'blue' => $b );
	return $rgb = $r.', '. $g .', ' . $b ;	    
} 
/* end hex2rgb */


function wpa82718_scripts() {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script(
        'iris',
        admin_url( 'js/iris.min.js' ),
        array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ),
        false,
        1
    );
    wp_enqueue_script(
        'wp-color-picker',
        admin_url( 'js/color-picker.min.js' ),
        array( 'iris' ),
        false,
        1
    );
    $colorpicker_l10n = array(
        'clear' => __( 'Clear' ),
        'defaultString' => __( 'Default' ),
        'pick' => __( 'Select Color' )
    );
    wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n ); 

}
add_action( 'wp_enqueue_scripts', 'wpa82718_scripts', 100 );
//
/**
 *	LIST CUSTOM IMAGE SIZES IN MEDIA UPLOAD
 *
*/  
function as_image_sizes_mediapopup( $sizes ) {
	$new_sizes = array();
	$added_sizes = get_intermediate_image_sizes();
	foreach( $added_sizes as $key => $value) {
		$new_sizes[$value] = $value;
	}
	$new_sizes = array_merge( $new_sizes, $sizes );
	return $new_sizes;
}

/**
 * REMOVE AN ANONYMOUS FUNCTION FILTER.
 *
 * @param string $tag      Hook name.
 * @param string $filename The file where the function was declared.
 * @param int $priority    Optional. Hook priority. Defaults to 10.
 * @return bool
 */
if ( !function_exists('remove_anonymous_function_filter') ) {
    
    function remove_anonymous_function_filter($tag, $filename, $priority = 10) {
        $filename = plugin_basename($filename);
 
        if ( !isset($GLOBALS['wp_filter'][$tag][$priority]) ) {
            return false;
        }
        $filters = $GLOBALS['wp_filter'][$tag][$priority];
 
        foreach ($filters as $callback) {
            if ( ($callback['function'] instanceof Closure) || is_string($callback['function']) ) {
                $function = new ReflectionFunction($callback['function']);
 
                $funcFilename = plugin_basename($function->getFileName());
                $funcFilename = preg_replace('@\(\d+\)\s+:\s+runtime-created\s+function$@', '', $funcFilename);
 
                if ( $filename === $funcFilename ) {
                    return remove_filter($tag, $callback['function'], $priority);
                }
            }
        }
 
        return false;
    }
}
/**
 *  REMOVE DEPRECATED FILES
 *   
 *  @details delete files (mostly WC templates) not needed anymore (reducing WC templates)
 *  for easier WC / theme compatiblity and maintenance
 */
function cypress_remove_deprecated_templates() {
	
	$files_to_remove = array( 
		// since cypress 1.3.0 , these files are redundant:
		'inc/tgm-plugin-activation/theme_inc_plugins.php',
		'inc/tgm-plugin-activation/example.php',
	);
	
	if( empty( $files_to_remove ) ) return;
	
	$wpfilesys = new DBI_Filesystem(); 	// inc/functions/wp-filesystem.php
	
	foreach( $files_to_remove as $file_to_remove ) {
		
		$file =  trailingslashit( get_template_directory() ) . $file_to_remove;
		if( $wpfilesys->file_exists( $file ) ) {
			$wpfilesys->unlink( $file );
		}
	}
	
}
add_action('admin_init', 'cypress_remove_deprecated_templates');