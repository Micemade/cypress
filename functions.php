<?php
/**
 *	The MAIN FUNCTIONS FILE - includes all the neccesary additional theme functions, classes etc.
 *
 *	@since Cypress 1.0
 */
//
//
/*
 *	OPTIONS FRAMEWORK - INCLUDED FROM "ADMIN" FOLDER
 *
 **/
// Paths to admin functions :
define('ADMIN_PATH', get_template_directory() . '/admin/');
define('ADMIN_DIR', get_template_directory_uri() . '/admin/');
define('LAYOUT_PATH', ADMIN_PATH . '/layouts/');
//
//
//
$themedata = wp_get_theme();
define('THEMENAME', $themedata);
define('OPTIONS', 'of_cypress'); // Name of the database row where your options are stored
//
// Build Options
require_once (ADMIN_PATH . 'admin-interface.php');		// Admin Interfaces 
require_once (ADMIN_PATH . 'theme-options.php'); 		// Options panel settings and custom settings
require_once (ADMIN_PATH . 'admin-functions.php'); 		// Theme actions based on options settings
require_once (ADMIN_PATH . 'medialibrary-uploader.php'); // Media Library Uploader
/* end Options Framework */
// 
//
/**
 * HTTP or HTTPS protocol
 */
if ( is_ssl() ) {
	$as_protocol = "https";
}else{
	$as_protocol = "http";
}
//
//
global $of_cypress; // set global theme options variable containg theme options array
//
/**
 *	GLOBALS AND CONSTANTS 
 *
 *	const PLACEHOLDER_IMAGE - used on all the places where no thumbnail image is not set.
 *	var $delimiter - used in breadcrumbs ( in directories inc/functions and woocommerce/shop)
 */
define ('PLACEHOLDER_IMAGE', $of_cypress['placeholder_image'] );
$delimiter   = '<span class="delimiter"> &#xe170; </span>'; // delimiter between crumbs  
$border_decor = $of_cypress['border_icon']['decoration'];
//
//
/**
 *	MAIN INITIALIZATIONS: .
 *
 */
if ( ! function_exists( 'cypress_setup' ) ):
function cypress_setup() {
	// MAX MEDIA WIDTH
	if ( ! isset( $content_width ) ) $content_width = 1400;
	// TRANSLATIONS:
	load_theme_textdomain( 'cypress', get_template_directory() . '/languages' );
	// HTML TITLE META TAG:
	add_theme_support( 'title-tag' );
	// FEEDS:
	add_theme_support( 'automatic-feed-links' );
	// POST FORMATS:
	add_theme_support( 'post-formats', array( 'audio', 'video', 'gallery','image', 'quote' ) );
	//	POST THUMBNAIL SUPPORT:
	add_theme_support( 'post-thumbnails', array( 'post', 'page', 'product', 'portfolio','slide' ) );
	//
	// MENUS:
	add_theme_support( 'menus' );
	register_nav_menu( 'main', 'Main menu' );
	register_nav_menu( 'main-horizontal', 'Main horizontal menu' );
	register_nav_menu( 'main-mobile', 'Main mobile menu' );
	register_nav_menu( 'secondary', 'Secondary menu' );
	//
	//
	/*************** IMAGES ******************/
	//
	// IMAGE RESIZING SCRIPT
	require_once('inc/functions/freshizer.php');
	//
	// IMAGE SIZES (AS = Aligator Studio)
	// - custom portrait and landscape formats
	//
	add_image_size( 'as-portrait', 500, 700, true );
	add_image_size( 'as-landscape', 1200 ,680, true );
	//
	add_filter('image_size_names_choose', 'as_image_sizes_mediapopup', 11, 1);
	//
	/************ end IMAGES  ***************/
	//
	// ENABLE SHORTCODES ON REGULAR TEXT WIDGET
	add_filter('widget_text', 'do_shortcode'); // te enable shortcodes in widgets
	//
	add_editor_style();
	//
	//
	// THEME WIDGETS
	include('inc/widgets/widget_latest_images.php');
	include('inc/widgets/widget_featured_images.php');
	include('inc/widgets/widget_social.php');
	include('inc/widgets/latest-custom-posts.php');
	//
	//
	// CUSTOM META BOXES
	require_once( 'inc/Custom-Meta-Boxes/custom-meta-boxes.php' );
	require_once( 'inc/functions/as-meta-boxes.php' );
	//
	//
}
endif;// cypress_setup
add_action( 'after_setup_theme', 'cypress_setup' );
//
//
//
/**
 * MENU FUNCTIONS:
 */
include('inc/functions/menus.php');
include('inc/functions/menus-expand.php');
//
/**
 *	WIDGETS FUNCTIONS:
 */
include('inc/functions/widgets.php');
//
/**
 *	BREADCRUMBS:
 */
include('inc/functions/breadcrumbs.php');
//
/**
 *	PAGINATION:
 */
include('inc/functions/pagination.php');
//
/**
 *	RUN ONCE class:
 */
include('inc/functions/run_once_class.php');
//
/*
 *	COMMENTS:
 */
include('inc/functions/comments.php');
//
/**
 *	AUDIO / VIDEO: 
 */
include('inc/functions/audio-video.php');
//
/**
 *	IMAGE / GALLERY:
 */
include('inc/functions/image-gallery.php');
//
/**
 *	AQUA PAGE BUILDER - BLOCKS, CSS, JS:
 */
include('inc/functions/page_builder.php');
//
/**
 *	ENQUEUE THEME STYLES:
 */
include('inc/functions/enqueue_styles.php');
//
/**
 *	ENQUEUE THEME SCRIPTS:
 */
include('inc/functions/enqueue_scripts.php');
//
/** 
 *	POST META:
 */
include('inc/functions/post-meta.php');
//
/**
 *	MISCELANEUOUS POST FUNCTIONS:
 */
include('inc/functions/misc_post_functions.php');
//
/**
 *	WP Filesystem wrapper class: 
 */
include_once( trailingslashit( get_template_directory() ) . 'inc/functions/wp-filesystem.php' );
/**
 *	ADMIN FUNCTIONS:
 */
include('inc/functions/admin_functions.php');
//
/**
 *	PLUGINS:
 */
include('inc/functions/theme_inc_plugins.php');
//
/**
 *	WOOCOMMERCE
 */
include('woocommerce/woocommerce-theme-edits.php');
//
/**
 *	AJAX functions - used in custom blocks (prefixed with AS) created for Aqua Page Builder plugin
 */
 include('inc/functions/ajax.php'); //
//
//
/*end TYPEKIT*/
//
//
/* 
if(headers_sent()) {
	print_r( "<strong>Headers already sent</strong>");
}
else{
	print_r("<strong>Headers NOT sent</strong>");
}*/
remove_filter('archive_product_title','');
/**
 *  Remove srcset from wp_get_attachment_image
 */
//add_filter( 'wp_get_attachment_image_attributes', 'cypress_removesrcet_func', PHP_INT_MAX  );
//add_filter( 'cypress_srcset_filters_removal', 'cypress_srcset_filters_removal_func' );
function cypress_removesrcet_func( $attr ) {
	
	if( isset( $attr['sizes'] ) )
		unset( $attr['sizes'] );

	if( isset( $attr['srcset'] ) )
		unset( $attr['srcset'] );

	return $attr;

 };
function cypress_srcset_filters_removal_func() {
	// Override the calculated image sizes
	add_filter( 'wp_calculate_image_sizes', '__return_false',  PHP_INT_MAX );

	// Override the calculated image sources
	add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );

	// Remove the reponsive stuff from the content
	remove_filter( 'the_content', 'wp_make_content_images_responsive' );
	
}
?>