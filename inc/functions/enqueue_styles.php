<?php
/**
 *	REGISTER AND ENQUEUE ADMIN STYLES
 *
 */
function customAdminCSS() {
	wp_register_style('cypress-admin-css', get_template_directory_uri(). '/css/admin_styles.css', 'style');
	wp_enqueue_style( 'cypress-admin-css');
}
add_action('admin_head', 'customAdminCSS');
//
/**
 *	REGISTER AND ENQUEUE THEME STYLES
 *
 */
function theme_styles()  
{ 
	global $of_cypress, $as_protocol;
	
	$t_url = get_template_directory_uri();
	
	$gooFontHeads = str_replace(' ','+',$of_cypress['google_headings']['face']);
	$gooFontBody = str_replace(' ','+',$of_cypress['google_body']['face']);

	// REGISTER GOOGLE FONTS
	wp_register_style('google-font-headings', $as_protocol .'://fonts.googleapis.com/css?family='.$gooFontHeads.':300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );
	wp_register_style('google-font-body', $as_protocol .'://fonts.googleapis.com/css?family='.$gooFontBody.':300,400,600,700,800,400italic,700italic&subset=latin,latin-ext'  );
	
	/* REGISTER STYLES*/
	wp_register_style( 'reset', $t_url.'/css/reset.css' );
	wp_register_style( 'grid',$t_url . '/css/unsemantic-grid-responsive.css','' ,'' , 'all' );
	wp_register_style( 'grid-tablet',$t_url . '/css/unsemantic-grid-responsive-tablet.css','' ,'' , 'all' );
	wp_register_style( 'glyphs',$t_url . '/css/glyphs.css','' ,'' , 'all' );
	wp_register_style( 'prettyPhoto', $t_url . '/css/prettyPhoto.css','' , '', 'all' );
	wp_register_style( 'cypress-main-css', $t_url . '/style.css', '', '', 'all' );
	wp_register_style( 'woocommerce-as', $t_url . '/woocommerce/woocommerce.css', '', '', 'all' );
	wp_register_style( 'owl-carousel',$t_url . '/css/owl.carousel.css','', '', 'all' );
	
	/* ENQUEUE STYLES */
	wp_enqueue_style( 'google-font-headings' );
	wp_enqueue_style( 'google-font-body' );
	wp_enqueue_style( 'reset' );
	wp_enqueue_style( 'grid' );
	wp_enqueue_style( 'grid-tablet' );
	wp_enqueue_style( 'glyphs' );
	wp_enqueue_style( 'prettyPhoto' );
	wp_enqueue_style( 'cypress-main-css' );
	wp_enqueue_style( 'woocommerce-as' );
	wp_enqueue_style( 'owl-carousel' );

	
	/* SPECIAL FORMS STLYES - theme options */
	if( $of_cypress['buttons_style'] == 'default' ) {
		wp_register_style( 'formalize', $t_url . '/css/formalize_01.css', '', '', 'all' );
		wp_enqueue_style ( 'formalize' );
	}elseif( $of_cypress['buttons_style'] == 'style2' ) {
		wp_register_style( 'formalize', $t_url . '/css/formalize_02.css', '', '', 'all' );
		wp_enqueue_style ( 'formalize' );
	}
	
	
	### THEME OPTIONS CSS AND JAVACRIPTS
	$dynamic_css_js = isset($of_cypress['dynamic_css_js']) && $of_cypress['dynamic_css_js'];
	if( $dynamic_css_js ) {
	
		//DYNAMIC (AJAX) THEME OPTIONS CSS:
		wp_enqueue_style('options-styles', admin_url('admin-ajax.php') . '?action=dynamic_css',array(), '1.0.0', 'all');
		
	}else{
	
		$uploads		= wp_upload_dir();
		$theme_data 	= wp_get_theme(); // get theme info
		$theme			= sanitize_title( $theme_data ); // make slug from theme name

		$as_upload_dir	= trailingslashit($uploads['basedir']) .$theme.'-options'; // in "wp-content/uploads" directory
		$as_upload_url	= trailingslashit($uploads['baseurl']) .$theme.'-options'; // url to uploads
		
		$as_upload_dir_exists = is_dir( $as_upload_dir );
			
		/* THEME OPTIONS CSS */
		if( $as_upload_dir_exists ){
			
			wp_register_style('options-styles', $as_upload_url . '/theme_options_styles.css', 'style');
			
		}else{
		
			wp_register_style('options-styles', get_stylesheet_directory_uri() . '/admin_save_options/theme_options_styles.css', 'style');
		}
		wp_enqueue_style( 'options-styles');
	
	}
	
	
}
add_action('wp_enqueue_scripts', 'theme_styles');
//
/**
 *	DYNAMIC CSS - AJAX 
 *
 */
function dynamic_css() {
	require( get_template_directory().'/admin_save_options/theme_options_styles.php' );
	exit;
}
add_action('wp_ajax_dynamic_css', 'dynamic_css');
add_action('wp_ajax_nopriv_dynamic_css', 'dynamic_css');
//
//
?>