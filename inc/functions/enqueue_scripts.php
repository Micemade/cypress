<?php 
/**
 * SCRIPTS : ENQUEUE AND REGISTER
 *
 */
function theme_js()
{
	global $of_cypress;
	
	$t_url = get_template_directory_uri(); 
	//
	//
	wp_enqueue_script('jquery', '','','',true);
	
	/* registering */
	wp_register_script('plugins', $t_url.'/js/plugins.min.js');
	wp_register_script('as-waypoints', $t_url.'/js/waypoints.min.js');
	wp_register_script('shuffle', $t_url.'/js/jquery.shuffle.min.js');
	wp_register_script('owl-carousel', $t_url.'/js/owl.carousel.js');
	wp_register_script('nicescroll', $t_url.'/js/jquery.nicescroll.js');
	wp_register_script('retina', $t_url.'/js/retina.js');
	
	wp_register_script('as_custom', $t_url.'/js/as_custom.js');
	
	/* enqueuing  */
	wp_enqueue_script('plugins', $t_url.'/js/plugins.min.js', array('jQuery'), '1.0', true);
	wp_enqueue_script('as-waypoints', $t_url.'/js/waypoints.min.js', array('jQuery'), '1.0', true);
	wp_enqueue_script('shuffle', $t_url.'/js/jquery.shuffle.min.js', array('jQuery'), '1.0', true);
	wp_enqueue_script('owl-carousel', $t_url.'/js/owl.carousel.js', array('jQuery'), '1.0', true);
	wp_enqueue_script('nicescroll', $t_url.'/js/jquery.nicescroll.js', array('jQuery'), '1.0', true);
	wp_enqueue_script('retina', $t_url.'/js/retina.js', array('jQuery'), '1.0', true);
	
	wp_enqueue_script('as_custom', $t_url.'/js/as_custom.js', array('jQuery'), '1.0', true);
	//
	//
	
	
	### THEME OPTIONS CSS AND JAVACRIPTS
	$dynamic_css_js = isset($of_cypress['dynamic_css_js']) && $of_cypress['dynamic_css_js'];
	if( $dynamic_css_js ) {
	
		//DYNAMIC (AJAX) THEME OPTIONS JAVASCRIPT:
		wp_enqueue_script('options_js', admin_url('admin-ajax.php') . '?action=dynamic_js',array(), '1.0.0', 'all');
		
	}else{
	
		$uploads		= wp_upload_dir();
		$theme_data 	= wp_get_theme(); // get theme info
		$theme			= sanitize_title( $theme_data ); // make slug from theme name
		
		$as_upload_dir	= trailingslashit($uploads['basedir']) .$theme.'-options'; // in "wp-content/uploads" directory
		$as_upload_url	= trailingslashit($uploads['baseurl']) .$theme.'-options'; // url to uploads
		
		$as_upload_dir_exists = is_dir( $as_upload_dir );
		
		if( $as_upload_dir_exists ){
			
			wp_register_script('options_js', $as_upload_url . '/theme_options_js.js');
			wp_enqueue_script('options_js', $as_upload_url . '/theme_options_js.js', array('jQuery'), '1.0', true);
			
		}else{
		
			wp_register_script('options_js', get_stylesheet_directory_uri() . '/admin_save_options/theme_options_js.js');
			wp_enqueue_script('options_js', get_stylesheet_directory_uri().'/admin_save_options/theme_options_js.js', array('jQuery'), '1.0', true);	
			
		}
	
	}
	
	// Localize the script with our data.
	$translation_array = array( 
		'loading_qb' => __( 'Loading quick view','cypress' )

	);
	wp_localize_script( 'options_js', 'options_translate', $translation_array );
	
	
} // END FUNC. theme_js()
add_action('wp_enqueue_scripts', 'theme_js');
//
//
/**
 *	DYNAMIC JS - AJAX 
 *
 */
function dynamic_js() {
	require(get_template_directory().'/admin_save_options/theme_options_js.php');
	exit;
}
add_action('wp_ajax_dynamic_js', 'dynamic_js');
add_action('wp_ajax_nopriv_dynamic_js', 'dynamic_js');
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
/**
 *	TYPEKIT scripts.
 *
 */
$google_typekit_toggle = $of_cypress['google_typekit_toggle'];
if( $google_typekit_toggle == 'typekit' ) {

	function theme_typekit() {
	
		global $of_cypress;
		
		$typekit_id =  $of_cypress['typekit_id'];
		wp_enqueue_script( 'theme_typekit', '//use.typekit.net/'. $typekit_id .'.js');
	}
	add_action( 'wp_enqueue_scripts', 'theme_typekit' );

	function theme_typekit_inline() {
	  if ( wp_script_is( 'theme_typekit', 'done' ) ) {
	?>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<?php }
	}
	add_action( 'wp_head', 'theme_typekit_inline' );
} //endif
?>