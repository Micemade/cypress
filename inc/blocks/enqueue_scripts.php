<?php 
/**
 * SCRIPTS : ENQUEUE AND REGISTER
 *
 */
function theme_js()
{
	global $of_cypress, $is_IE;
	
	$t_url = get_template_directory_uri(); 
	//
	//
	wp_enqueue_script('jquery', '','','',true);
	
	/* registering */
	wp_register_script('plugins', $t_url.'/js/plugins.min.js');
	wp_register_script('waypoints', $t_url.'/js/waypoints.min.js');
	wp_register_script('shuffle', $t_url.'/js/jquery.shuffle.min.js');
	wp_register_script('owl-carousel', $t_url.'/js/owl.carousel.min.js');
	wp_register_script('nicescroll', $t_url.'/js/jquery.nicescroll.js');
	
	wp_register_script('as_custom', $t_url.'/js/as_custom.js');
	
	/* enqueuing  */
	wp_enqueue_script('plugins', $t_url.'/js/plugins.min.js', array('jQuery'), '1.0', true);
	wp_enqueue_script('waypoints', $t_url.'/js/waypoints.min.js', array('jQuery'), '1.0', true);
	wp_enqueue_script('shuffle', $t_url.'/js/jquery.shuffle.min.js', array('jQuery'), '1.0', true);
	wp_enqueue_script('owl-carousel', $t_url.'/js/owl.carousel.min.js', array('jQuery'), '1.0', true);
	wp_enqueue_script('nicescroll', $t_url.'/js/jquery.nicescroll.js', array('jQuery'), '1.0', true);
	
	wp_enqueue_script('as_custom', $t_url.'/js/as_custom.js', array('jQuery'), '1.0', true);
	//
	//
	/* THEME OPTIONS JS */
	if(is_multisite()){
		$uploads = wp_upload_dir();
		wp_register_script('theme_options', trailingslashit($uploads['baseurl']) . 'theme_options_js.js');
		wp_enqueue_script('theme_options', trailingslashit($uploads['baseurl']) . 'theme_options_js.js', array('jQuery'), '1.0', true);	
	}else{
		wp_register_script('theme_options', get_stylesheet_directory_uri() . '/admin_save_options/theme_options_js.js');
		wp_enqueue_script('theme_options', get_stylesheet_directory_uri().'/admin_save_options/theme_options_js.js', array('jQuery'), '1.0', true);	
	}
	
} // END FUNC. theme_js()
add_action('wp_enqueue_scripts', 'theme_js');
//
//
/*
 *	ADD SOME ADMIN JS (and/or css)
 *
 */
function customAdminCode() {
	wp_register_script('as-admin-js', get_template_directory_uri(). '/js/admin.js');
	wp_enqueue_script( 'as-admin-js', get_template_directory_uri(). '/js/admin.js', array('jQuery'), '1.0', true );
}
add_action('admin_head', 'customAdminCode');
/*
function IE_stuff () {	
}
add_action('wp_head', 'IE_stuff');
*/
?>